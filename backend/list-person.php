<?php
require_once '../mysql_con/PDOMysql.php';
$status = (empty($_GET['status']) ? '' : $_GET['status']);
$person_title = array(
    '1' => 'จัดการเจ้าหน้าที่ดูแลระบบ',
    '2' => '',
    '3' => 'จัดการลูกค้า',
    '4' => 'จัดการพนักงานขับรถ',
);
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> รายการแสดง<?php echo $person_title[$status] ?>
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-person&status=<?= $status ?>" class="btn btn-info">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ-สกุล</th>
                    <th>รหัสบัตรขับรถ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new PDOMysql();
                $pdo->conn = $pdo->open();
                $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE status = ' . $status);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($result as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>                            
                        <td><?= $value->fname . '   ' . $value->lname ?></td>
                        <td><?= $value->code ?></td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-person&status=<?= $status ?>&id=<?= $value->id ?>" class="btn btn-warning">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->id ?>, '../actionDb/person.php?action=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>