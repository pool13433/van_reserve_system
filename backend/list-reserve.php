<?php require_once '../mysql_con/PDOMysql.php'; ?>
<?php require_once '../actionDb/variableGlobal.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการแสดงข้อมูลบริษัทเดินรถ
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-company" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </div>
    <div class="panel-body">
        <fieldset>
            <legend>ค้นหาใบจองโดย</legend>
            <form class="form-horizontal" method="GET">
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="reserve_code" class="col-sm-6 control-label">รหัส</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reserve_code" placeholder="รหัสใบจอง"
                                   value="<?= (empty($_GET['reserve_code']) ? '' : $_GET['reserve_code']) ?>"/>
                            <input type="hidden" class="form-control" name="page" value="<?= $_GET['page'] ?>"/>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="reserve_customer" class="col-sm-6 control-label">ชื่อ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reserve_customer" placeholder="ชื่อผู้จอง" 
                                   value="<?= (empty($_GET['reserve_customer']) ? '' : $_GET['reserve_customer']) ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="reserve_status" class="col-sm-6 control-label">สถานะการจอง</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="reserve_status">
                                <option value="">-- เลือก --</option>
                                <?php
                                $reserve_status = (is_numeric($_GET['reserve_status']) ? 0 : $_GET['reserve_status']);
                                $arrayReserveStatus = arrayReserveStatus();
                                foreach ($arrayReserveStatus as $index => $data) {
                                    ?>
                                    <?php if (strval($index) == $reserve_status) { ?>
                                        <option value="<?= $index ?>" selected><?= $data['NAME'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $index ?>"><?= $data['NAME'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="reserve_date" class="col-sm-4 control-label">วันที่จอง</label>
                        <div class="col-sm-7">
                            <div class="input-group">        
                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i> ตั้งแต่ - สิ้นสุด</span>
                                <input type="text" class="form-control" name="reserve_date" id="reserve_date"/>
                                <input type="hidden" name="reserve_date_begin" id="reserve_date_begin"
                                       value="<?= (empty($_GET['reserve_date_begin']) ? '' : $_GET['reserve_date_begin']) ?>"/>
                                <input type="hidden" name="reserve_date_end" id="reserve_date_end"
                                       value="<?= (empty($_GET['reserve_date_end']) ? '' : $_GET['reserve_date_end']) ?>"/>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-ok-sign"></i> ค้นหา
                        </button>
                        <button type="reset" class="btn btn-warning">
                            <i class="glyphicon glyphicon-erase"></i> ล้างค่า
                        </button>
                    </div>                    
                </div>
            </form>
        </fieldset>
        <hr/>
        <fieldset>
            <legend>ผลการค้นหาใบจอง</legend>
            <table class="table table-striped table-bordered dataTable dt-responsive">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>วันที่เดินทาง</th>
                        <th>ราคา</th>                       
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_GET['reserve_code']) || !empty($_GET['reserve_customer']) || !empty($_GET['reserve_date']) || isset($_GET['reserve_status'])) {
                        $pdo = new PDOMysql();
                        $pdo->conn = $pdo->open();
                        $sql = 'SELECT ';
                        $sql .= ' `rs_id`, `rs_code`, `cus_id`, `v_id`, `rs_price`, DATE_FORMAT(rs_usabledate,\'%d-%m-%Y\') rs_usabledate,';
                        $sql .= '  `vp_idstart`, `vp_idend`, `vt_id`, `rs_createdate`, `rs_updateby`, `rs_status` ';
                        $sql .= ' , `id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`,';
                        $sql .= ' `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status`';
                        $sql .= ' FROM reserve r';
                        $sql .= ' LEFT JOIN  person p ON p.id = r.cus_id ';
                        $sql .= ' WHERE 1=1';
                        if (!empty($_GET['reserve_code'])) {
                            $sql .= ' AND rs_code LIKE \'%' . $_GET['reserve_code'] . '%\' ';
                        }
                        if (!empty($_GET['reserve_customer'])) {
                            $sql .= ' AND p.fname LIKE \'%' . $_GET['reserve_customer'] . '%\' ';
                        }
                        if (is_numeric($_GET['reserve_status'])) {
                            $sql .= ' AND rs_status = ' . strval($_GET['reserve_status']);
                        }
                        if (!empty($_GET['reserve_date'])) {
                            $sql .= ' AND ( DATE_FORMAT(rs_createdate,\'%Y-%m-%d\') BETWEEN ';
                            $sql .= ' STR_TO_DATE(\'' . $_GET['reserve_date_begin'] . '\',\'%Y-%m-%d\') ';
                            $sql .= ' AND ';
                            $sql .= ' STR_TO_DATE(\'' . $_GET['reserve_date_end'] . '\',\'%Y-%m-%d\') ) ';
                        }
                        echo '<div class="well"> sql ==>> ' . $sql . '</div>';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach ($result as $key => $value) { ?>
                            <tr>
                                <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                                <td><?= $value->rs_code ?></td>
                                <td><?= $value->fname ?></td>
                                <td><?= $value->rs_usabledate ?></td>
                                <td><?= $value->rs_price ?></td>
                                <td>
                                    <span class="label label-<?= getDataListByKey($value->rs_status, arrayReserveStatus(), 'BGCOLOR') ?>">
                                        <?= getDataListByKey($value->rs_status, arrayReserveStatus(), 'NAME') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($value->rs_status != RS_RESERVE_CANCLE) { ?>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                จัดการ <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" onclick="cancleReserve(<?= $value->rs_id ?>)">
                                                        <i class="glyphicon glyphicon-erase"></i> ยกเลิก
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="glyphicon glyphicon-pencil"></i> แก้ไข
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                </tbody>
            </table>
        </fieldset>

    </div>
</div>
<script>
    $(document).ready(function () {
        initDateRangPicker();
        var reserve_date_begin = $('#reserve_date_begin').val();
        var reserve_date_end = $('#reserve_date_end').val();
        if (reserve_date_begin != '' && reserve_date_end != '') {
            reserve_date_begin = moment(reserve_date_begin).format('DD/MM/YYYY');
            reserve_date_end = moment(reserve_date_end).format('DD/MM/YYYY');
            $('#reserve_date').val(reserve_date_begin + ' - ' + reserve_date_end);
        }
    });
    function initDateRangPicker() {
        //http://www.daterangepicker.com/#ex5
        /*
         *  DatePickerRang 1
         */
        var datepicker = $('#reserve_date');
        datepicker.prop('readOnly', true);
        datepicker.daterangepicker({
            showDropdowns: true,
            format: 'DD-MM-YYYY',
            locale: DATEPICKER_LOCAL,
        }, function (start, end, label) {
            $('#reserve_date_begin').val(start.format('YYYY-MM-DD'));
            $('#reserve_date_end').val(end.format('YYYY-MM-DD'));
        });
        datepicker.val('');
        datepicker.on('cancel.daterangepicker', function (ev, picker) {
            //do something, like clearing an input
            $('#reserve_date_begin').val('');
            $('#reserve_date_end').val('');
        });
    }
    function cancleReserve(id) {
        var isConf = confirm('ยืนยันการ ยกเลิกการจองตั๋วรถ \nถ้ายกเลิกการจองแล้วจะไม่สามารถ คืนสถานะการจองได้ \nใช่[OK]||ไม่ใช่[Cancel]');
        if (isConf) {
            $.post('../actionDb/reserve.php?action=cancelReserve', {id: id}, function (response) {
                if (response) {
                    alert(response.message);
                    reloadDelay(1)
                }
            }, 'json');
            return false;
        }
    }
</script>