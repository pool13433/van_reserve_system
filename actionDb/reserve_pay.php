<?php

require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$title = 'สถานะการแจ้งการชำระเงิน';
$message = '';

switch ($_GET['action']) {
    case 'create':
        $id = $_POST['id'];
        $c_name = $_POST['reserve_code'];
        $fileslip = $_FILES['reserve_slip'];
        $payment_date = $_POST['payment_date'];
        $payment_time = $_POST['payment_time'];
        $payment_money = $_POST['payment_money'];

        /*
         * ********** File Upload *************
         */
        $target_dir = "../uploads/";
        $target_new_filename = date('H-i-s') . '_' . basename($_FILES["reserve_slip"]["name"]);
        $target_file = $target_dir . $target_new_filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["reserve_slip"]["size"] > 500000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $fileslip = $target_new_filename;
            if (move_uploaded_file($_FILES["reserve_slip"]["tmp_name"], $target_file)) {
                $message = "The file " . $target_new_filename . " has been uploaded.";
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
        /*
         * ********** File Upload *************
         */


        try {
            $pdo->conn = $pdo->open();
            $values = array(
                ':reserve_id' => $id,
                ':pay_date' => $payment_date,
                ':pay_time' => $payment_time,
                ':pay_money' => $payment_money,
                ':filename' => $fileslip
            );
            $sql = ' INSERT INTO `reserve_pay`(`rs_id`, `vp_paydate`,';
            $sql .= ' `vp_paytime`, `vp_paymoney`, `vp_filename`, `vp_createdate`, `vp_status`) ';
            $sql .= ' VALUES (:reserve_id,:pay_date,';
            $sql .= ' :pay_time,:pay_money,:filename,NOW(),1)';

            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($values);
            if ($exe) {
                $payment_status = 1;
                $exe = updateReserveStatus($payment_status, $id);
                if ($exe) {
                    $message = 'แจ้งการชำระเงินสำเร็จ';
                    echo $pdo->returnJson(true, $title, $message, './index.php?page=history_reserve');
                } else {
                    echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'แจ้งการชำระเงินสำเร็จ ไม่สำเร็จ [ ' . $sql . ' ]', '');
                }
            } else {
                echo $pdo->returnJson(false, 'เกิดข้อผิดพลาด', 'แจ้งการชำระเงินสำเร็จ ไม่สำเร็จ [ ' . $sql . ' ]', '');
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

function updateReserveStatus($status, $id) {
    $pdo = new PDOMysql();
    $pdo->conn = $pdo->open();
    $sql = 'UPDATE reserve SET rs_status =:rs_status WHERE rs_id = :rs_id';
    $stmt = $pdo->conn->prepare($sql);
    $exe = $stmt->execute(array(
        ':rs_status' => $status,
        ':rs_id' => $id
    ));
    $pdo->close();
    if ($exe) {
        return true;
    } else {
        return false;
    }
}
