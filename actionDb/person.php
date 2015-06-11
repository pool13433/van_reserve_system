<?php

session_start();
require '../actionDb/variableGlobal.php';
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $id = $_POST['id'];
        $code = $_POST['code'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $idcard = $_POST['idcard'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
//        $updatedate =$_POST['updatedate'];
//        $updateby = $_POST['updateby'];
        $status = $_POST['status'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':fb_id' => '',
                ':code' => $code,
                ':fname' => $fname,
                ':lname' => $lname,
                ':username' => $username,
                ':password' => $password,
                ':idcard' => $idcard,
                ':mobile' => $mobile,
                ':email' => $email,
                ':by' => 1,
                ':status' => $status,
            );
            if (empty($_POST['id'])) {
                $sql = ' INSERT INTO `person`( `fb_id`, `code`, `fname`,';
                $sql .= ' `lname`, `username`, `password`, `idcard`, `mobile`, ';
                $sql .= ' `email`, `updatedate`, `updateby`, `status`) ';
                $sql .= ' VALUES (';
                $sql .= ' :fb_id,:code,:fname,';
                $sql .= ' :lname,:username,:password,:idcard,:mobile,';
                $sql .= ' :email,NOW(),:by,:status)';
            } else {
                $sql = ' UPDATE `person` SET ';
                $sql .= ' `fb_id`=:fb_id,`code`=:code,';
                $sql .= ' `fname`=:fname,`lname`=:lname,`username`=:username,';
                $sql .= ' `password`=:password,`idcard`=:idcard,`mobile`=:mobile,';
                $sql .= ' `email`=:email,`updatedate`=NOW(),`updateby`=:by,';
                $sql .= ' `status`=:status ';
                $sql .= ' WHERE id =:id';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-person&status=' . $status);
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'register':
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $idcard = $_POST['idcard'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
//        $updatedate =$_POST['updatedate'];
//        $updateby = $_POST['updateby'];
        $status = CUSTOMER_ID;
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':fb_id' => '',
                ':code' => $pdo->createPersonSerialCode($status),
                ':fname' => $fname,
                ':lname' => $lname,
                ':username' => $username,
                ':password' => $password,
                ':idcard' => $idcard,
                ':mobile' => $mobile,
                ':email' => $email,
                ':by' => 1,
                ':status' => $status,
            );
            $sql = ' INSERT INTO `person`( `fb_id`, `code`, `fname`,';
            $sql .= ' `lname`, `username`, `password`, `idcard`, `mobile`, ';
            $sql .= ' `email`, `updatedate`, `updateby`, `status`) ';
            $sql .= ' VALUES (';
            $sql .= ' :fb_id,:code,:fname,';
            $sql .= ' :lname,:username,:password,:idcard,:mobile,';
            $sql .= ' :email,NOW(),:by,:status)';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                $per_id = $pdo->getLastInsertId();
                $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE id=:person_id');
                $stmt->execute(array(
                    ':person_id' => $per_id,
                ));
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                $person = $_SESSION['person'] = $result;

                echo $pdo->returnJson(true, 'สมัครสมาชิก', 'สมัครสมาชิก สำเร็จ', './index.php?page=home');
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
    case 'login':
        try {
            $pdo = new PDOMysql();
            $pdo->conn = $pdo->open();
            $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE username =:username AND password =:password');
            $stmt->execute(
                    array(
                        ':username' => $_POST['username'],
                        ':password' => $_POST['password'],
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if (empty($result)) {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ไม่พบข้อมูลผู้ใช้งานในระบบ [ ' . $sql . ' ]', '');
            } else {
                $url = './index.php?page=list-province';
                $_SESSION['person'] = $result;
                //var_dump($result->status);
                if ($result->status == EMPLOYEE_ID || $result->status == ONWER_ID) {
                    $url = '../backend/index.php?page=list-province';
                } else {
                    $url = './index.php?page=list-province';
                }
                echo $pdo->returnJson(true, 'แจ้งสถานะเข้าระบบ', 'แจ้งสถานะเข้าระบบสำเร็จ', $url);
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'logout':
        if (!empty($_SESSION['person'])) {
            unset($_SESSION['person']);
            echo $pdo->returnJson(true, 'ออกจากระบบเรียบร้อย', 'ออกจากระบบเรียบร้อย', '../index.html');
        }
        break;
    case 'checkUsername':
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':username' => $_GET['username'],
            );
            $sql = ' SELECT * FROM person WHERE username= =:username';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
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

function getPersonById($id) {
    $pdo = new PDOMysql();
    $pdo->conn = $pdo->open();
    $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}
