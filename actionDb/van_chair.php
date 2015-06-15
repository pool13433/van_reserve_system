<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $exe = true;
        $arrayPlace = [];
        $arrayChairs = [];
        $objectJson = $_POST['jsonParameter'];
        $obj_van_chair = json_decode($objectJson, true);
        try {
            $pdo->conn = $pdo->open();
            //var_dump($obj_van_chair);
            $name = $obj_van_chair['name'];
            $driver = $obj_van_chair['driver'];
            $company = $obj_van_chair['company'];
            $chair = $obj_van_chair['chair'];
            $arrayPlace = $obj_van_chair['places'];
            $arrayChairs = $obj_van_chair['arrayChairs'];
            $values = array(
                ':name' => $name,
                ':company' => $company,
                ':driver' => $driver,
                ':chair' => $chair,
                ':by' => 1
            );
            if (empty($_POST['id'])) {
                $sql = ' INSERT INTO `van_chair`( `v_name`,';
                $sql .= ' `v_company`, `v_driver`, `v_chair`, `v_updatedate`,';
                $sql .= ' `v_updateby`) VALUES (';
                $sql .= ' :name,';
                $sql .= ' :company,:driver,:chair,NOW(),';
                $sql .= ' :by)';
            } else {
                $sql = 'UPDATE  van_chair SET v_name = :name,`v_updateby` =:by,v_updatedate = NOW() WHERE v_id =:id  ';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-van_chair');
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
            $sql = 'DELETE FROM van_chair WHERE v_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-van_chair');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getChairsByVanId':
        $ban_id = $_GET['id'];
        $reserve_date = $_GET['reserve_date'];
        // url test : http://localhost/van/actionDb/van_chair.php?action=getChairsByVanId&id=9
        try {
            $value = array(
                ':id' => $ban_id,
            );
            $pdo->conn = $pdo->open();
            $sql = ' SELECT vc.*,';
            $sql .= ' (SELECT r.rs_status FROM reserve r WHERE r.rs_id = rc.rs_id) as rs_status';
            $sql .= ' FROM';
            $sql .= ' van_chair vc';
            $sql .= ' LEFT JOIN';
            $sql .= ' reserve_chair rc ON rc.vc_id = vc.vc_id';
            if (!empty($reserve_date)) {
                $sql .= ' AND rc.rsc_usabledate = STR_TO_DATE(:reserve_date,\'%d/%m/%Y\')';
                $value['reserve_date'] = $reserve_date;
            }
            $sql .= ' ';

//           $sql .= ' LEFT JOIN';
//            $sql .= ' reserve r ON r.rs_id = rc.rs_id';
//             if (!empty($reserve_date)) {
//                $sql .= ' AND r.rs_usabledate = STR_TO_DATE(:reserve_date,\'%d/%m/%Y\')';
//                $value['reserve_date'] = $reserve_date;
//            }
            $sql .= ' WHERE 1=1 ';            
            $sql .= ' AND vc.v_id =:id';
            //echo 'sql ::==' . $sql;
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($value);
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


