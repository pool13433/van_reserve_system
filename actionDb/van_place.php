<?php

require './variableGlobal.php';
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
   
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
        $van_id = $_GET['van_id'];
        // url test : http://localhost/van/actionDb/van_place.php?action=getPlacesByVanId&id=9
        try {
            $pdo->conn = $pdo->open();
            $sql = 'SELECT * FROM van_place WHERE v_id =:id ORDER BY vp_hierarchy ASC';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $van_id,
            ));
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
//            $response = array();
//           
//            foreach ($result as $index => $values) {
//                $response = array(
//                    
//                );
//            }
            echo json_encode($result);
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getPlacesByHierarchy':
        $place_type = $_GET['place_type'];
        $van_id = $_GET['van_id'];
        $hierarchy = $_GET['hierarchy'];
        try {
            $pdo->conn = $pdo->open();
            $sql = 'SELECT vp.vp_id,vp.vp_kilomate,pvp.pvp_name,vp.vp_hierarchy,';
            $sql .= ' (SELECT vs_value FROM van_setting) as price,pvp.pvp_id';
            $sql .= ' FROM van_place vp ';
            $sql .= ' LEFT JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id ';
            $sql .= ' WHERE vp.v_id =:van_id';
            if ($place_type == PLACE_BEGIN) {
                $sql .= ' AND vp.vp_hierarchy > ' . $hierarchy;
            } else {
                $sql .= ' AND vp.vp_hierarchy < ' . $hierarchy;
            }
            $sql .= ' ORDER BY vp.vp_hierarchy ASC';
            $stmt = $pdo->conn->prepare($sql);
            //echo '<pre> sql ::=='.$sql.'</pre>';
            $stmt->execute(array(':van_id' => $van_id));
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

