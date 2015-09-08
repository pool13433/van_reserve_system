<?php include '../mysql_con/PDOMysql.php'; ?>
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
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="reserve_code" class="col-sm-5 control-label">รหัสใบจอง</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="reserve_code" placeholder="รหัสใบจอง">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <label for="reserve_customer" class="col-sm-5 control-label">ชื่อผู้จอง</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="reserve_customer" placeholder="ชื่อผู้จอง">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <label for="reserve_code" class="col-sm-5 control-label">รหัสใบจอง</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="reserve_code" placeholder="รหัสใบจอง">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="reserve_date" class="col-sm-5 control-label">วันที่จอง</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="reserve_date" placeholder="วันที่จอง">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="reserve_status" class="col-sm-6 control-label">สถานะการจอง</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reserve_status" placeholder="สถานะการจอง">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <label for="reserve_status" class="col-sm-6 control-label">สถานะการจอง</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="reserve_status" placeholder="สถานะการจอง">
                        </div>
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
                        <th>ชื่อ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pdo = new PDOMysql();
                    $pdo->conn = $pdo->open();
                    $stmt = $pdo->conn->prepare('SELECT * FROM company');
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php foreach ($result as $key => $value) { ?>
                        <tr>
                            <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                            <td><?= $value->c_name ?></td>
                            <td style="width: 8%;">
                                <a href="index.php?page=form-company&id=<?= $value->c_id ?>" class="btn btn-warning btn-sm">
                                    <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                                </a>
                            </td>
                            <td style="width: 8%;">
                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_data(<?= $value->c_id ?>, '../actionDb/province.php?action=delete')">
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