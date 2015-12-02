<?php

define('APPLICATION_NAME', 'ระบบจองรถตู้ออนไลน์');
define('SESSION_TIMEOUT', 'session_timeout');
define('SESSION_TIMEOUT_MESSAGE', 'หมดเวลาการเชื่อมต่อ กรุณา เข้าระบบใหม่อีกครั้ง');

define('EMPLOYEE_ID', 1);
define('ONWER_ID', 2);
define('CUSTOMER_ID', 3);
define('DRIVER_ID', 4);
define('MANAGER_ID', 5);
define('GENARAL_ID', 0);


define('RS_RESERVE_SUCCESS', '0');
define('RS_PAY_SUCCESS', '1');
define('RS_RESERVE_CANCLE', '2');
define('RS_PAY_OVERTIME', '3');


define('PLACE_BEGIN', 'place_begin');
define('PLACE_END', 'place_end');

define('SESSON_PERSON_ID', 1);

$thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
    "" => "",
    "01" => "มกราคม",
    "02" => "กุมภาพันธ์",
    "03" => "มีนาคม",
    "04" => "เมษายน",
    "05" => "พฤษภาคม",
    "06" => "มิถุนายน",
    "07" => "กรกฎาคม",
    "08" => "สิงหาคม",
    "09" => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม"
);

function arrayPersonStatusId() {
    //สถานะ EMPLOYEE_ID=>1,ONWER_ID=>2,CUSTOMER_ID=>3 ,DRIVER_ID => 4,GENARAL_ID => 0,5=MANAGER
    return array('GEN', 'EMP', 'OWN', 'CUS', 'DRI', 'MAN');
}

function arrayPersonStatus() {
    return array(
        '0' => array(
            'DEFIND_ID' => 'GENARAL_ID',
            'NAME' => 'ผู้ใช้งานทั่วไป'
        ),
        '1' => array(
            'DEFIND_ID' => 'EMPLOYEE_ID',
            'NAME' => 'พนักงาน/เจ้าหน้าที่'
        ),
        '2' => array(
            'DEFIND_ID' => 'ONWER_ID',
            'NAME' => 'เจ้าของคิว/วิน'
        ),
        '3' => array(
            'DEFIND_ID' => 'CUSTOMER_ID',
            'NAME' => 'ลูกค้า'
        ),
        '4' => array(
            'DEFIND_ID' => 'DRIVER_ID',
            'NAME' => 'พนักงานขับรถ'
        ),
        '5' => array(
            'DEFIND_ID' => 'MANAGER_ID',
            'NAME' => 'ผู้จัดการ'
        ),
    );
}

function arrayReserveStatus() {
    return array(
        '0' => array(
            'BGCOLOR' => 'success',
            'NAME' => 'จองเรียบร้อย'
        ),
        '1' => array(
            'BGCOLOR' => 'success',
            'NAME' => 'จ่ายเงินเรียบร้อย'
        ),
        '2' => array(
            'BGCOLOR' => 'danger',
            'NAME' => 'ยกเลิกการจอง'
        ),
        '3' => array(
            'BGCOLOR' => 'warning',
            'NAME' => 'เกินระยะเวลาการชำระเงิน'
        ),
    );
}

function arrayPaymentStatus() {
    return array(
        '' => array(
            'BGCOLOR' => 'default',
            'NAME' => 'ทั้งหมด'
        ),
        '0' => array(
            'BGCOLOR' => 'warning',
            'NAME' => 'ไม่ชำระเงินตามกำหนด'
        ),
        '1' => array(
            'BGCOLOR' => 'success',
            'NAME' => 'ชำระเงินเรียบร้อย'
        ),
    );
}

function getDataList($params, $list) {
    $array = $list;
    if (isset($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == strval($params)):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}

function getDataListByKey($params, $list, $keyName) {
    $array = $list;
    if (isset($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == strval($params)) {
                $result = $value[$keyName];
            }
        endforeach;
        return $result;
    endif;
}

function arrayYear($lengths = 10) {
    $arrayYear = array();
    $years = date('Y');
    for ($i = $years; $i > ($years - $lengths); $i--) {
        $arrayYear[] = array(
            'BC' => intval($i),
            'AD' => intval($i + 543)
        );
    }
    return $arrayYear;
}


