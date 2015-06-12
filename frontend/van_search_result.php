<?php if (empty($_GET['go_start_place']) && empty($_GET['go_end_place'])) { ?>
    <script type="text/javascript">alert('กรุณาเลือก สถานที่ในจังหวัดก่อน');
        window.location.href = './index.php?page=van_search';
    </script>
<?php } else { ?>
    <?php require_once '../mysql_con/PDOMysql.php'; ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <ol class="breadcrumb">
                <li><a href="index.php?page=van_search">ค้นหาเส้นทางการเดินรถ</a></li>
                <li  class="active"><a href="#">เลือกรถที่ให้บริการ</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered dataTable dt-responsive">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>ที่นั่งทั้งหมด</th>
                        <th>เวลาออก</th>
                        <th>เวลาถึง</th>
                        <th>ที่นั่งว่าง</th>
                        <th>ที่นั่งเต็ม</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_GET['go_start']) && !empty($_GET['go_end'])) {
                        $pdo = new PDOMysql();
                        $pdo->conn = $pdo->open();

                        $go_start = $_GET['go_start'];
                        $go_start_place = $_GET['go_start_place'];
                        $go_end = $_GET['go_end'];
                        $go_end_place = $_GET['go_end_place'];

                        $sql = ' SELECT v.*,';
                        $sql .= ' (SELECT COUNT(*) FROM van_chair WHERE v_id = v.v_id AND vc_cusid = \'\') as chair_empty,';
                        $sql .= ' (SELECT COUNT(*) FROM van_chair WHERE v_id = v.v_id AND vc_cusid != \'\') as chair_full';
                        $sql .= ' FROM van v';
                        $sql .= ' WHERE EXISTS (SELECT \'x\' FROM van_place vp WHERE vp.v_id = v.v_id';                        
                        $sql .= ' AND (vp.pvp_id =:go_start_place OR ';
                        $sql .= ' vp.pvp_id =:go_end_place';
                        $sql .= ' ))';
                        echo '<pre>sql ::==' . $sql . '</pre>';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute(array(
                            ':go_start_place' => $go_start_place,
                            ':go_end_place' => $go_end_place,
                        ));
                        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach ($result as $key => $value) { ?>
                            <tr>
                                <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                                <td><?= $value->v_name ?></td>
                                <td><?= $value->v_chair ?></td>
                                <td><?= $value->v_drivestart ?></td>
                                <td><?= $value->v_driveend ?></td>
                                <td><?= $value->chair_empty ?></td>
                                <td><?= $value->chair_full ?></td>
                                <td style="width: 8%;">
                                    <a href="index.php?page=van_choose_detail&van_id=<?= $value->v_id ?>&go_start=<?=$_GET['go_start']?>&go_start_place=<?=$_GET['go_start_place']?>&go_end=<?=$_GET['go_end']?>&go_end_place=<?=$_GET['go_end_place']?>" class="btn btn-warning">
                                        <i class="glyphicon glyphicon-pencil"></i>เลือก
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>
