<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $exe = true;
        $arrayPlace = [];
        $arrayChairs = [];
        $objectJson = $_POST['jsonParameter'];
        $obj_van_place = json_decode($objectJson, true);
        try {
            $pdo->conn = $pdo->open();
            //var_dump($obj_van_place);
            $name = $obj_van_place['name'];
            $driver = $obj_van_place['driver'];
            $company = $obj_van_place['company'];
            $chair = $obj_van_place['chair'];
            $arrayPlace = $obj_van_place['places'];
            $arrayChairs = $obj_van_place['arrayChairs'];
            $values = array(
                ':name' => $name,
                ':company' => $company,
                ':driver' => $driver,
                ':chair' => $chair,
                ':by' => 1
            );
            if (empty($_POST['id'])) {
                $sql = ' INSERT INTO `van_place`( `v_name`,';
                $sql .= ' `v_company`, `v_driver`, `v_chair`, `v_updatedate`,';
                $sql .= ' `v_updateby`) VALUES (';
                $sql .= ' :name,';
                $sql .= ' :company,:driver,:chair,NOW(),';
                $sql .= ' :by)';
            } else {
                $sql = 'UPDATE  van_place SET v_name = :name,`v_updateby` =:by,v_updatedate = NOW() WHERE v_id =:id  ';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-van_place');
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
            $sql = 'DELETE FROM van_place WHERE v_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-van_place');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'updateHierarchy':
        $exe = false;
        try {
            $pdo->conn = $pdo->open();
            $jsonString = $_POST['jsonparam'];
            $arrayObject = json_decode($jsonString, TRUE);
            //var_dump($arrayObject);
            foreach ($arrayObject as $index => $object) {
                /*
                 * Update province_place
                 */
                $sql = 'UPDATE  van_place SET ';
                $sql .= ' vp_hierarchy =:hierarchy,';
                $sql .= ' vp_kilomate =:kilomate';
                $sql .= ' WHERE vp_id =:id';
                $stmt = $pdo->conn->prepare($sql);
                $exe = $stmt->execute(array(
                    ':hierarchy' => intval($object['hierarchy']),
                    ':kilomate' => intval($object['kilomate']),
                    ':id' => intval($object['id'])
                ));
                /*
                 * Update province_place
                 */
            }
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'จัดลำดับสถานที่ขึ้นลงรถ สำเร็จ', './index.php?page=list-van_place');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'จัดลำดับสถานที่ขึ้นลงรถ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getPlacesByVanId':
        $ban_id = $_GET['id'];
        // url test : http://localhost/van/actionDb/van_place.php?action=getPlacesByVanId&id=9
        try {
            $pdo->conn = $pdo->open();
            $sql = 'SELECT * FROM van_place WHERE v_id =:id ORDER BY vp_hierarchy ASC';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $ban_id,
            ));
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            echo json_encode($result);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    default:
        break;
}

