<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $id = $_POST['id'];
        $province_name = $_POST['province_name'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':name' => $province_name,
                ':by' => 1
            );
            if (empty($_POST['id'])) {
                $sql = 'INSERT INTO province (pv_name,pv_updatedate,pv_updateby) VALUES (:name,NOW(),:by)';
            } else {
                $sql = 'UPDATE  province SET pv_name = :name,`pv_updateby` =:by,pv_updatedate = NOW() WHERE pv_id =:id  ';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-province');
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
            $sql = 'DELETE FROM province WHERE pv_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-province');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    default:
        break;
}

