<?php

define('APPLICATION_NAME', 'ระบบจองรถตู้ออนไลน์');

define('EMPLOYEE_ID', 1);
define('ONWER_ID', 2);
define('CUSTOMER_ID', 3);
define('DRIVER_ID', 4);
define('GENARAL_ID', 0);


define('RS_RESERVE_SUCCESS', '0');
define('RS_PAY_SUCCESS', '1');
define('RS_RESERVE_CANCLE', '2');
define('RS_PAY_OVERTIME', '3');


define('PLACE_BEGIN', 'place_begin');
define('PLACE_END', 'place_end');

define('SESSON_PERSON_ID', 1);

function arrayReserveStatus() {
    return array(
        '0' => 'จองเรียบร้อย',
        '1' => 'จ่ายเงินเรียบร้อย',
        '2' => 'ยกเลิกการจอง',
        '3' => 'เกินระยะเวลาการชำระเงิน'
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
