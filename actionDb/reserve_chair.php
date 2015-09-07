<?php

session_start();
require_once '../actionDb/variableGlobal.php';
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$authen = (empty($_SESSION['person']) ? [] : $_SESSION['person']);
switch ($_GET['action']) {
    case 'create':
        $exe = true;
        $arrayPlace = [];
        $arrayChairs = [];
        $jsonListChairs = $_POST['jsonListChairs'];
        $jsonObjectPlaces = $_POST['jsonObjectPlace'];
        $van_id = $_POST['van_id'];
        $price = $_POST['price'];

        $arrayChairs = json_decode($jsonListChairs, true);
        $objPlace = json_decode($jsonObjectPlaces, true);
//        var_dump($arrayPlace[0]);
//        var_dump($arrayPlace[1]);
        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':cus_id' => $authen->id,
                ':van_id' => $van_id,
                ':price' => $price,
                ':place_begin' => $objPlace['place_begin_id'],
                ':place_end' => $objPlace['place_end_id'],
                ':by' => 1,
                ':status' => RS_RESERVE_SUCCESS,
            );
            if (empty($_POST['id'])) {
                $sql = ' INSERT INTO `reserve`(';
                $sql .=' `cus_id`, `v_id`, `rs_price`,';
                $sql .=' `vp_idstart`, `vp_idend`, `rs_createdate`, ';
                $sql .=' `rs_updateby`,rs_status) VALUES (';
                $sql .=' :cus_id,:van_id,:price,';
                $sql .=' :place_begin,:place_end,NOW(),';
                $sql .=' :by,:status)';
                $sql .= ' ';
            } else {
                $sql = 'UPDATE  reserve SET v_name = :name,`v_updateby` =:by,v_updatedate = NOW() WHERE v_id =:id  ';
                $values['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            $reserve_id = $pdo->getLastInsertId();
            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=van_complete&reserve_id=' . $reserve_id);
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
            $sql = 'DELETE FROM reserve WHERE v_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-reserve');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'getChairsByReserveDate':
        $reserve_date = $_GET['reserve_date'];
        // url test : http://localhost/van/actionDb/van_chair.php?action=getChairsByVanId&id=9
        try {
            $values = array(
                ':reserve_date' => $reserve_date,
            );
            $sql = " SELECT * FROM reserve rs";
            $sql .= " LEFT JOIN reserve_chair rsc ON rsc.rs_id = rs.rs_id ";
            $sql .= " LEFT JOIN van_chair vc ON vc.vc_id = rsc.vc_id";
            $sql .= " WHERE rs.rs_usabledate = STR_TO_DATE(:reserve_date, '%d/%m/%Y')";

            //echo 'sql ::=='.$sql;
            $pdo->conn = $pdo->open();
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
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

