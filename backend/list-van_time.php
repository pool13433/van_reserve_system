<?php include '../mysql_con/PDOMysql.php'; ?>
<?php
if (empty($_GET['van_id'])) {
    echo '<div class="alert alert-danger" role="alert"> *** กรุณาเลือก ชื่อสายรถตู้ก่อน ***</div>';
    exit();
} else {
    $pdo = new PDOMysql();
    $pdo->conn = $pdo->open();
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> รายการแสดงข้อมูล เวลาการเดินทางของรถตู้
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-van" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $sql_van = " SELECT `v_id`, `v_name`, `v_detail`, `v_company`,";
            $sql_van .= " `v_chair`, `v_roadlength`, DATE_FORMAT(`v_updatedate`,'%d-%m-%Y') v_updatedate, `v_updateby`";
            $sql_van .= " ,`c_id`, `c_name`, `c_onwer`, `c_address`, `c_mobile`, DATE_FORMAT(`c_updatedate`,'%d-%m-%Y') c_updatedate, `c_updateby` ";
            $sql_van .= " FROM `van` v";
            $sql_van .= ' LEFT JOIN company c ON c.c_id = v.v_company ';
            $sql_van .= " WHERE v_id =:van_id";
            $stmt_van = $pdo->conn->prepare($sql_van);
            $stmt_van->execute(array(':van_id' => $_GET['van_id']));
            $vanObj = $stmt_van->fetch(PDO::FETCH_OBJ);
            ?>
            <fieldset>
                <legend>รายละเอียดข้อมูลของรถตู้</legend>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td style="text-align: right;width: 15%">ชื่อสายรถ</td>
                            <td style="width: 35%"><?= $vanObj->v_name ?></td>
                            <td style="text-align: right;width: 15%">บริษัท</td>
                            <td style="width: 35%"><?= $vanObj->c_name ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right">รายละเอียด</td>
                            <td colspan="3"><?= $vanObj->v_detail ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right">ระยะทาง</td>
                            <td><?= $vanObj->v_roadlength ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: right">จำนวนที่นั่ง</td>
                            <td><?= $vanObj->v_chair ?></td>
                            <td style="text-align: right">วันที่สร้าง/แก้ไข</td>
                            <td><?= $vanObj->v_updatedate ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <hr/>

            <fieldset>
                <legend>รายละเอียดข้อมูลของรถตู้ ระยะเวลาการเดินทางของสายรถตู้
                    <div class="btn-group pull-right">
                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#model_van_time">
                            <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
                        </a>
                    </div>
                    <?php require_once '../dialog/dialog_form_van_time.php'; ?>
                </legend>
                <table class="table table-striped table-bordered dataTable dt-responsive">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ระยะเวลาออก</th>
                            <th>ระยะเวลาถึง</th>
                            <th>พนักงานขับรถ</th>
                            <th>วันที่สร้าง/แก้ไขข้อมูล</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT ';
                        $sql .= " `vt_id`, `vt_drivestart`, `vt_driveend`, DATE_FORMAT(`vt_updatedate`,'%d-%m-%Y') vt_updatedate";
                        $sql .= " ,vt_driver";
                        $sql .= " ,`id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`, `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status`";
                        $sql .= '  FROM van_time vt';
                        $sql .= " LEFT JOIN person p ON p.id = vt.vt_driver";
                        $sql .= ' WHERE vt.v_id =:van_id';
                        $sql .= ' ORDER BY vt.vt_drivestart,vt_driveend ASC';
                        //echo '<pre> sql ::=='.$sql.'</pre>';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute(array(':van_id' => $_GET['van_id']));
                        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach ($result as $key => $value) { ?>
                            <tr>
                                <td style="width: 8%;"><?= ($key + 1) ?></td>   
                                <td><?= $value->vt_drivestart ?></td>
                                <td><?= $value->vt_driveend ?></td>
                                <td><?= $value->fname . "   " . $value->lname ?></td>
                                <td><?= $value->vt_updatedate ?></td>
                                <td style="width: 8%;">
                                    <a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#model_van_time"
                                       onclick="setFormVanTime(<?= $value->vt_id ?>)">
                                        <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                                    </a>
                                </td>
                                <td style="width: 8%;">
                                    <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->vt_id ?>, '../actionDb/van_time.php?action=delete')">
                                        <i class="glyphicon glyphicon-trash"></i>ลบ
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
    <?php
}?>