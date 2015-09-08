<?php
if (!isset($_SESSION)) {
    session_start();
}
$authen = (empty($_SESSION['person']) ? '' : $_SESSION['person']);
require_once '../filecenter/check_session_timeout.php';

include '../mysql_con/PDOMysql.php';
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการจองรถทั้งหมด
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable dt-responsive">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสการจอง</th>
                    <th>ชื่อเส้นทาง</th>
                    <th>วันที่จอง</th>
                    <th>จุดขึ้น</th>
                    <th>จุดลง</th>
                    <th>เวลาขึ้นรถ</th>
                    <th>เวลารถถึงที่หมาย</th>
                    <th>ราคา</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new PDOMysql();
                $pdo->conn = $pdo->open();
                /*
                 * query sql
                 */
                $sql = " SELECT  `rs_id`,rs_code,";
                $sql .= " (SELECT CONCAT(fname, ' ', lname) FROM person p WHERE p.id = r.cus_id) customer_name,";
                $sql .= " v.v_id,`rs_price`,";
                $sql .= " DATE_FORMAT(`rs_usabledate`,'%d-%m-%Y') usableddate,";
                $sql .= " (SELECT pvp_name FROM province_place pvp WHERE pvp.pvp_id = r.vp_idstart) place_begin_name,";
                $sql .= " (SELECT pvp_name FROM province_place pvp WHERE pvp.pvp_id = r.vp_idend) place_end_name,";
                $sql .= " vt.vt_id,";
                $sql .= " DATE_FORMAT(`rs_createdate`,'%d-%m-%Y') reserve_date,";
                $sql .= " `rs_updateby`,`rs_status`,";
                $sql .= " `v_name`,`v_detail`,`v_company`,`v_chair`,`v_roadlength`,";
                $sql .= " `v_updatedate`,`v_updateby`,vt.vt_id,`vt_drivestart`,`vt_driveend`,";
                $sql .= " `vt_driver`,`vt_updatedate`";
                $sql .= " FROM reserve r";
                $sql .= " LEFT JOIN van v ON v.v_id = r.v_id";
                $sql .= " LEFT JOIN van_time vt ON vt.vt_id = r.vt_id";
                $sql .= " WHERE r.cus_id =:authen_id";
                /*
                 * query sql
                 */
                //echo '<pre> sql ::==' . $sql . '</pre>';
                $stmt = $pdo->conn->prepare($sql);
                $stmt->execute(array(':authen_id' => $authen->id));
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($result as $key => $value) { ?>
                    <tr>
                        <td style="width: 5%;"><?= ($key + 1) ?></td>                                                                            
                        <td nowrap><?= $value->rs_code ?></td>                 
                        <td nowrap><?= $value->v_name ?></td>                        
                        <td nowrap><?= $value->reserve_date ?></td>
                        <td><?= $value->place_begin_name ?></td>
                        <td><?= $value->place_end_name ?></td>
                        <td><?= $value->vt_drivestart ?></td>
                        <td><?= $value->vt_driveend ?></td>
                        <td><?= $value->rs_price ?></td>
                        <td>
                            <span class="label label-<?= getDataListByKey($value->rs_status, arrayReserveStatus(), 'BGCOLOR') ?>">
                                <?= getDataListByKey($value->rs_status, arrayReserveStatus(), 'NAME') ?>
                            </span>                            
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    การกระทำ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php if ($value->rs_status != intval(RS_RESERVE_CANCLE)) { ?>
                                        <li>
                                            <a href="javascript:void(0)" onclick="cancleReserve(<?= $value->rs_id ?>)">
                                                <i class="glyphicon glyphicon-remove"></i> ยกเลิกการจอง      
                                            </a>    
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="#" onclick="printInvoiceByCase(<?= $value->rs_id ?>)">
                                            <i class="glyphicon glyphicon-print"></i> ปริ้นใบจ่ายเงิน      
                                        </a>   
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" onclick="editReserve(<?= $value->rs_id ?>)">
                                            <i class="glyphicon glyphicon-pencil"></i> แก้ไข
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function printInvoiceByCase(reserve_id) {
        //                var news_group = $('#group_id').val();
        //                var news_status = $('#news_status').val();
        //                var startdate = $('#startdate').val();
        //                var enddate = $('#enddate').val();
        var url = 'http://localhost/van/report/invoice.php?reserve_id=' + reserve_id;
        //                url += '&news_status=' + news_status;
        //                url += '&startdate=' + startdate;
        //                url += '&enddate=' + enddate;
        popupWindown(url, 75);
    }
    function cancleReserve(id) {
        console.log(' id ::== ' + id);
        var isConf = confirm('ยืนยันการ ยกเลิกการจองตั๋วรถ \nถ้ายกเลิกการจองแล้วจะไม่สามารถ คืนสถานะการจองได้ \nใช่[OK]||ไม่ใช่[Cancel]');
        if (isConf) {
            $.post('../actionDb/reserve.php?action=cancelReserve', {id: id}, function (response) {
                if (response) {
                    alert(response.message);
                    redirectDelay(response.url, 1);
                }
            }, 'json');
            return false;
        }
    }
    function editReserve(reserve_id){
        $.get('../actionDb/reserve.php?action=setSessionEditReserve',{reserve_id:reserve_id},function(response){
            if(response.status){
                redirectDelay(response.url,1);
            }else{
                alert(response.message);
            }
        },'json');
    }
</script>