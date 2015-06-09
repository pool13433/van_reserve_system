<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();

switch ($_GET['action']) {
    case 'create':
        $exe = true;
        $arrayPlace = [];
        $arrayChairs = [];
        $objectJson = $_POST['jsonParameter'];
        $obj_van = json_decode($objectJson, true);
        try {
            $pdo->conn = $pdo->open();
            //var_dump($obj_van);
            $van_id = $obj_van['van_id'];
            $name = $obj_van['name'];
            $driver = $obj_van['driver'];
            $company = $obj_van['company'];
            $detail = $obj_van['detail'];
            $drive_start = $obj_van['drive_start'];
            $drive_end = $obj_van['drive_end'];
            $chair = $obj_van['chair'];
            $arrayPlace = $obj_van['places'];
            $arrayChairs = $obj_van['arrayChairs'];
            $values = array(
                ':name' => $name,
                ':detail' => $detail,
                ':company' => $company,
                ':driver' => $driver,
                ':drivestart' => $drive_start,
                ':driveend' => $drive_end,
                ':chair' => $chair,
                ':by' => 1
            );
            if (empty($van_id)) {
                $sql = ' INSERT INTO `van`( `v_name`,`v_detail`,';
                $sql .= ' `v_drivestart`,`v_driveend`,';
                $sql .= ' `v_company`, `v_driver`, `v_chair`, `v_updatedate`,';
                $sql .= ' `v_updateby`) VALUES (';
                $sql .= ' :name,:detail,';
                $sql .= ' :drivestart,:driveend,';
                $sql .= ' :company,:driver,:chair,NOW(),';
                $sql .= ' :by)';
                $stmt = $pdo->conn->prepare($sql);
                $exe = $stmt->execute($values);
                $van_id = $pdo->getLastInsertId();

                /*
                 * 
                 */
            } else {                
                $sql = ' UPDATE `van` SET ';
                $sql .= ' `v_name`=:name,`v_detail`=:detail,';
                $sql .= ' `v_company`=:company,`v_driver`=:driver,';
                $sql .= ' `v_chair`=:chair,`v_drivestart`=:drivestart,';
                $sql .= ' `v_driveend`=:driveend,`v_updatedate`=NOW(),';
                $sql .= ' `v_updateby`=:by ';
                $sql .= ' WHERE `v_id`=:v_id';
                
                $values['v_id'] = $van_id;
                $stmt = $pdo->conn->prepare($sql);
                $exe = $stmt->execute($values);
            }

            if ($exe) {

                // ล้างค่า van_place เพื่อเพิ่ม insert ใหม่
                $stmt = $pdo->conn->prepare('DELETE FROM van_place WHERE v_id =:v_id');
                $exe = $stmt->execute(array(
                    'v_id' => $van_id,
                ));
                
                // ล้างค่า van_chair เพื่อเพิ่ม insert ใหม่
                $stmt = $pdo->conn->prepare('DELETE FROM van_chair WHERE v_id =:v_id');
                $exe = $stmt->execute(array(
                    'v_id' => $van_id,
                ));
                

//                    // อัพเดทลำดับของจุดสายเดินทาง
                if (count($arrayPlace) > 1) { // ต้องมีตั้งแต่ 2 ขึ้นไป เพราะต้องมี จุดเริ่มและจุด สิ้นสุด                                                
                    foreach ($arrayPlace as $index => $place) {
                        $sql = ' INSERT INTO `van_place`( ';
                        $sql .= ' `vp_hierarchy`, `vp_kilomate`, `pvp_id`,v_id,';
                        $sql .= ' `vp_updatedate`, `pvp_updateby`) VALUES (';
                        $sql .= ' :hierarchy,:kilomate,:province_place_id,:van_id,';
                        $sql .= ' NOW(),:by)';
                        //echo 'sql ::==' . $sql;
                        $stmt = $pdo->conn->prepare($sql);
                        $exe = $stmt->execute(array(
                            ':hierarchy' => intval($index) + 1,
                            ':kilomate' => 0,
                            ':province_place_id' => $place,
                            ':van_id' => $van_id,
                            ':by' => 1
                        ));
                    }
                }
                // เพิ่มที่นั่งบนรถตู้
                if (count($arrayChairs) > 0) { // ต้องมีที่นั่งด้วย
                    foreach ($arrayChairs as $index => $chair) {
                        $sql = ' INSERT INTO `van_chair`(`vc_x`,`vc_y`, ';
                        $sql .= ' `vc_label`, `v_id`, `vc_status`) VALUES (';
                        $sql .= ' :chair_x,:chair_y,';
                        $sql .= ' :label,:van_id,:status)';
                        $stmt = $pdo->conn->prepare($sql);
                        $exe = $stmt->execute(array(
                            ':chair_x' => $chair['chair_x'],
                            ':chair_y' => $chair['chair_y'],
                            ':label' => $chair['value'],
                            ':van_id' => $van_id,
                            ':status' => 0,
                        ));
                    }
                }
            }

            if ($exe) {
                echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-van');
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
            $sql = 'DELETE FROM van WHERE v_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-van');
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

function getPersonById($id) {
    $pdo = new PDOMysql();
    $pdo->conn = $pdo->open();
    $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}
