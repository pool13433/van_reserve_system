<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $van_time_id = $_POST['van_time_id'];
        $van_id = $_POST['van_id'];
        $van_driver = $_POST['van_driver'];
        $van_drive_start = $_POST['van_drive_start'];
        $van_drive_end = $_POST['van_drive_end'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':van_id' => $van_id,
                ':van_driver' => $van_driver,
                ':van_drive_start' => $van_drive_start,
                ':van_drive_end' => $van_drive_end
            );
            if (empty($_POST['van_time_id'])) {
                $sql = " INSERT INTO `van_time`(`v_id`, `vt_drivestart`, `vt_driveend`, `vt_driver`, `vt_updatedate`)";
                $sql .= " VALUES (:van_id,:van_drive_start,:van_drive_end,:van_driver,NOW())";
            } else {
                $sql = ' UPDATE `van_time` SET ';
                $sql .= ' `v_id`=:van_id,';
                $sql .= ' `vt_drivestart`=:van_drive_start,`vt_driveend`=:van_drive_end,';
                $sql .= ' `vt_driver`=:van_driver,`vt_updatedate`=NOW()';
                $sql .= ' WHERE `vt_id`=:van_time_id';
                $values['van_time_id'] = $van_time_id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-van_time&van_id=' . $van_id);
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'delete':
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM van_time WHERE vt_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-van_time');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getVanTimeById';
        try {
            $pdo->conn = $pdo->open();
            $sql = 'SELECT * FROM van_time WHERE vt_id =:van_time_id ';
            $stmt = $pdo->conn->prepare($sql);
            $stmt->execute(array(':van_time_id' => $_GET['van_time_id']));
            $drivers = $stmt->fetch(PDO::FETCH_OBJ);
            echo json_encode($drivers);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    default:
        break;
}


