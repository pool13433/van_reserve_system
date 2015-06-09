<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $id = $_POST['id'];
        $c_name = $_POST['company_name'];
        $c_onwer = $_POST['company_onwer'];
        $c_mobile = $_POST['company_mobile'];
        $c_address = $_POST['company_address'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':name' => $c_name,
                ':onwer' => $c_onwer,
                ':mobile' => $c_mobile,
                ':address' => $c_address,
                ':by' => 1
            );
            if (empty($_POST['id'])) {
                $sql = 'INSERT INTO company (c_name,c_onwer,c_mobile,c_address,c_updatedate,c_updateby) ';
                $sql .= ' VALUES (';
                $sql .= ' :name,:onwer,:mobile,:address,NOW(),:by)';
            } else {                
                $sql = ' UPDATE `company` SET ';
                $sql .= ' `c_name`=:name,';
                $sql .= ' `c_onwer`=:onwer,`c_address`=:address,';
                $sql .= ' `c_mobile`=:mobile,`c_updatedate`=NOW(),';
                $sql .= ' `c_updateby`=:by ';
                $sql .= ' WHERE `c_id`=:id';                               
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-company');
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
            $sql = 'DELETE FROM company WHERE c_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-company');
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


