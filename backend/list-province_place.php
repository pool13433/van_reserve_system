<?php include '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการแสดงสถานที่ในจังหวัดในประเทศไทย
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-province_place" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable dt-responsive">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>จังหวัด</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new PDOMysql();
                $pdo->conn = $pdo->open();
                $sql = 'SELECT * FROM province_place pvp ';
                $sql .= ' LEFT JOIN province pv ON pv.pv_id = pvp.pv_id ';
                $sql .= ' ORDER BY pvp.pv_id ASC';
                //echo 'sql ::=='.$sql;
                $stmt = $pdo->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($result as $key => $value) { ?>
                    <tr>
                        <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                        <td><?= $value->pvp_name ?></td>
                        <td><?= $value->pv_name ?></td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-province_place&id=<?= $value->pvp_id ?>" class="btn btn-warning">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->pvp_id ?>, '../actionDb/province_place.php?action=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>