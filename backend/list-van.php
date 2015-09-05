<?php include '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการแสดงข้อมูลรถตู้ทั้งหมด
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
                    <th>จัดการเวลาการเดินทาง</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new PDOMysql();
                $pdo->conn = $pdo->open();
                $sql = 'SELECT ';
                $sql .= " v.v_id, `v_name`, `v_detail`, `v_company`,`v_chair`, `v_roadlength`, `v_updatedate`, `v_updateby`";                
                $sql .= " ,`c_id`, `c_name`, `c_onwer`, `c_address`, `c_mobile`, `c_updatedate`, `c_updateby` ";
                $sql .= '  FROM van v';
                $sql .= ' LEFT JOIN company c ON c.c_id = v.v_company ';
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
                        <td style="width: 8%;">
                            <a href="index.php?page=list-van_time&van_id=<?= $value->v_id ?>" 
                               class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-time"></i> จัดการเวลากาเดินรถ
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-van&van_id=<?= $value->v_id ?>" class="btn btn-warning btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger btn-sm" 
                                    onclick="delete_data(<?= $value->v_id ?>, '../actionDb/van.php?action=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>