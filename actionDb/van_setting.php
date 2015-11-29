<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'update':
        $id = $_POST['id'];
        $v_value = $_POST['setting_value'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':value' => $v_value,
                ':by' => 1,
                'id' => $id
            );
            $sql = ' UPDATE `van_setting` SET ';
            $sql .= ' `vs_value`=:value,';
            $sql .= ' `vs_updatedate`=NOW(),';
            $sql .= ' `vs_updateby`=:by ';
            $sql .= ' WHERE `vs_id`=:id';

            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=setting');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
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


