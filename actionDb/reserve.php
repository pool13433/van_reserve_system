<?php

session_start();
require_once '../actionDb/variableGlobal.php';
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$authen = (empty($_SESSION['person']) ? array() : $_SESSION['person']);
if (empty($_SESSION['person'])) {
    echo $pdo->returnJson(false, SESSION_TIMEOUT, SESSION_TIMEOUT_MESSAGE, 'index.php?page=login');
    exit();
}
switch ($_GET['action']) {
    case 'create':
        $exe = true;
        $arrayPlace = [];
        $arrayChairs = [];
        $jsonListChairs = $_POST['jsonListChairs'];
        $jsonObjectPlaces = $_POST['jsonObjectPlace'];
        $van_id = $_POST['van_id'];
        $price = $_POST['price'];
        $van_time_id = $_POST['van_time_id'];
        $reserve_date = $_POST['reserve_date'];


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
                ':reserve_date' => $reserve_date,
                ':van_time_id' => $van_time_id,
                ':reserve_code' => $pdo->createReserveVanCode(),
            );
            if (empty($_POST['id'])) {
                $sql = ' INSERT INTO `reserve`(';
                $sql .=' `cus_id`, `v_id`, `rs_price`,';
                $sql .=' `vp_idstart`, `vp_idend`, `rs_createdate`, ';
                $sql .=' `rs_updateby`,rs_status,rs_usabledate,vt_id,rs_code) VALUES (';
                $sql .=' :cus_id,:van_id,:price,';
                $sql .=' :place_begin,:place_end,NOW(),';
                $sql .=' :by,:status,STR_TO_DATE(:reserve_date,\'%d/%m/%Y\'),:van_time_id,:reserve_code)';
                $sql .= ' ';
                //STR_TO_DATE('06/06/2015', '%d/%m/%Y')
            } else {
                $sql = 'UPDATE  reserve_chair SET v_name = :name,`v_updateby` =:by,v_updatedate = NOW() WHERE v_id =:id  ';
                $values['id'] = $id;
            }
            //echo 'sql ::=='.$sql;
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            $reserve_chair_id = $pdo->getLastInsertId();
            if ($exe) {
                // update ที่นั่งใน เก้าอี้รถตู้
                foreach ($arrayChairs as $index => $chair) {
                    $sql = ' INSERT INTO `reserve_chair`(`vc_id`, `rs_id`,rsc_usabledate) VALUES (:vanplace_id,:reserve_id,STR_TO_DATE(:usabledate,\'%d/%m/%Y\'))';
                    $stmt = $pdo->conn->prepare($sql);
                    $exe = $stmt->execute(array(
                        ':vanplace_id' => $chair['value'],
                        ':reserve_id' => $reserve_chair_id,
                        ':usabledate' => $reserve_date,
                    ));
                }
            } else {
                
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        if ($exe) {
            echo $pdo->returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=van_complete&reserve_id=' . $reserve_chair_id);
        } else {
            echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
        }
        $pdo->close();
        break;
    case 'delete':
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM reserve_chair WHERE v_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-reserve_chair');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'cancelReserve':
        try {
            $reserve_id = $_POST['id'];
            $pdo->conn = $pdo->open();
            $sql = 'UPDATE reserve SET rs_status = ' . RS_RESERVE_CANCLE;
            $sql .= ' WHERE rs_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $reserve_id,
            ));
            if ($exe) {
                echo $pdo->returnJson(true, 'ยกเลิกการจองเรียบร้อย', 'ยกเลิกสำเร็จ', './index.php?page=history_reserve');
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ยกเลิก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;

    

    case 'setSessionEditReserve':
        try {
            $reserve_id = $_GET['reserve_id'];
            $pdo->conn = $pdo->open();
            $sql = 'SELECT ';
            $sql .= ' `rs_id`, `cus_id`, r.v_id, `rs_price`, `rs_usabledate`, ';
            $sql .= ' `vp_idstart`, `vp_idend`, `rs_createdate`, `rs_updateby`, `rs_status`,';
            $sql .= ' (SELECT pv.pv_id FROM province pv,province_place pvp WHERE pv.pv_id = pvp.pv_id AND pvp.pvp_id = r.vp_idstart) province_start_id,';
            $sql .= ' (SELECT pv.pv_id FROM province pv,province_place pvp WHERE pv.pv_id = pvp.pv_id AND pvp.pvp_id = r.vp_idstart) province_end_id,';
            $sql .= ' vt.vt_id,vt.vt_drivestart,vt.vt_driveend';
            $sql .= ' FROM reserve r';
            $sql .= ' LEFT JOIN van_time vt ON vt.vt_id = r.vt_id';
            $sql .= ' WHERE rs_id =:reserve_id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':reserve_id' => $reserve_id,
            ));
            $reserve = $stmt->fetch(PDO::FETCH_OBJ);
            if ($exe) {
                $_SESSION['RESERVE_EDIT'] = $reserve;
                $van_id = $reserve->v_id;
                $province_start_id = $reserve->province_start_id;
                $province_end_id = $reserve->province_end_id;
                $place_start_id = $reserve->vp_idstart;
                $place_end_id = $reserve->vp_idstart;
                $vt_drivestart = $reserve->vt_drivestart;

                $url_reserve_edit = './index.php?cmd=edit&page=van_choose_detail';
                $url_reserve_edit .= '&van_id=' . $van_id . '&go_start=' . $province_start_id;
                $url_reserve_edit .= ' &go_start_place=' . $place_start_id . '&go_end=' . $province_end_id;
                $url_reserve_edit .= ' &go_end_place=' . $place_end_id . '&van_time_start=' . $vt_drivestart;
                echo $pdo->returnJson(true, 'ยกเลิกการจองเรียบร้อย', 'ยกเลิกสำเร็จ', $url_reserve_edit);
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'ไปหน้าแก้ไข ไม่สำเร็จ [ ' . $sql . ' ]', '');
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

