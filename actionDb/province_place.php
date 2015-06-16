<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $id = $_POST['id'];
        $place_name = $_POST['place_name'];
        $province = $_POST['province'];
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':name' => $place_name,
                ':province' => $province,
                ':by' => 1
            );
            if (empty($_POST['id'])) {
                $sql = 'INSERT INTO province_place (pvp_name,pv_id,pvp_updatedate,pvp_updateby) ';
                $sql .= 'VALUES (:name,:province,NOW(),:by)';
            } else {
                $sql = 'UPDATE  province_place  ';
                $sql .= ' SET pvp_name = :name,pv_id =:province,';
                $sql .= ' `pvp_updateby` =:by,pvp_updatedate = NOW() ';
                $sql .= ' WHERE pvp_id =:id ';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            //var_dump($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ ', './index.php?page=list-province_place');
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
            $sql = 'DELETE FROM province_place WHERE pvp_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-province_place');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getProvincePlaceByProvinceId':
        $province_id = $_GET['province_id'];
        try {
            $pdo->conn = $pdo->open();
            $sql = 'SELECT * FROM province_place WHERE pv_id =:province_id ';
            $stmt = $pdo->conn->prepare($sql);
            $stmt->execute(array(
                ':province_id' => intval($province_id),
            ));
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($results);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    default:
        break;
}

