<?php include '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการแสดงสถานที่ในจังหวัดในประเทศไทย
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-van" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable dt-responsive">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อสายเดินรถ</th>
                    <th>บริษัท</th>
                    <th>ระยะทาง</th>
                    <th>ระยะเวลาออก</th>
                    <th>ระยะเวลาถึง</th>
                    <th>พนักงานขับรถ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new PDOMysql();
                $pdo->conn = $pdo->open();
                $sql = 'SELECT * FROM van v';
                $sql .= ' LEFT JOIN company c ON c.c_id = v.v_company ';
                $sql .= ' LEFT JOIN person p ON p.id = v.v_driver ';
                $sql .= ' ORDER BY v.v_id ASC';
                $stmt = $pdo->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($result as $key => $value) { ?>
                    <tr>
                        <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                        <td><?= $value->v_name ?></td>
                        <td><?= $value->c_name ?></td>
                        <td><?= $value->v_roadlength ?></td>
                        <td><?= $value->v_drivestart ?></td>
                        <td><?= $value->v_driveend ?></td>
                        <td><?= $value->fname . ' ' . $value->lname ?></td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-van&id=<?= $value->v_id ?>" class="btn btn-warning">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->v_id ?>, '../actionDb/van.php?action=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>