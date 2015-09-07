<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
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
        $van_id = $_GET['van_id'];
        // url test : http://localhost/van/actionDb/van_chair.php?action=getChairsByVanId&id=9
        try {
            $values = array(
                ':van_id' => $van_id,
            );
            $sql = " SELECT * FROM van v";
            $sql .= " LEFT JOIN van_chair vc ON vc.v_id = v.v_id";
            $sql .= " WHERE 1=1";
            $sql .= " AND v.v_id =:van_id";
            //echo 'sql ::==' . $sql;

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


