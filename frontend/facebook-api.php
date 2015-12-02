<?php
require '../actionDb/variableGlobal.php';
require '../assets/sdk/facebook.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user_profile = null;
$user = null;


$facebook = new Facebook(array(
    'appId' => '1654504254828466',
    'secret' => '2d095e218104e0f814fb15fdd8d08996',
        ));
// Get User ID
$user = $facebook->getUser();

if ($user) {
    try {
        $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,birthday,gender,name,name_format');
        //$user_profile = $facebook->api('/me?fields=*');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl();
}

// Save to mysql
if (empty($_GET["action"]) && $user) {

    require_once '../mysql_con/PDOMysql.php';
    $pdo = new PDOMysql();
    if (!empty($_GET["code"])) {
        $facebookId = $user_profile["id"];
        $pdo->conn = $pdo->open();
        $isEmpty = checkEmptyUserProfile($pdo, $facebookId);
        if (!$isEmpty) {
            $exe = createUserProfile($pdo, $user_profile);
            if (!$exe) {
                echo 'insert facebook profile to database ERROR !!';
                exit();
            }
        }
        echo '<meta http-equiv="refresh" content="0; url=' . $url_redirect . '" />';
        sesSessionUserProfile($pdo, $facebookId);
        exit();
    }
}

// Logout
if (!empty($_GET["action"]) && $_GET["action"] == "logout") {
    $facebook->destroySession();
    echo '<meta http-equiv="refresh" content="0; url=http://localhost/van/frontend/home.php" />';
    exit();
}

function checkEmptyUserProfile($pdo, $facebookId) {
    $sql = 'SELECT * FROM person WHERE fb_id=:facebookId';
    $stmt = $pdo->conn->prepare($sql);
    $exe = $stmt->execute(array(
        'facebookId' => $facebookId
    ));
    $count = $stmt->rowCount();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function createUserProfile($pdo, $user_profile) {
    $values = array(
        ':facebookId' => trim($user_profile["id"]),
        ':code' => genUserCode($pdo),
        ':fname' => trim($user_profile["first_name"]),
        ':lname' => trim($user_profile["last_name"]),
        ':username' => '',
        ':password' => '',
        ':idcard' => '',
        ':mobile' => '',
        ':email' => trim((empty($user_profile["email"]) ? '' : $user_profile["email"])),
        ':updateby' => 1,
        ':status' => 3,
    );

    $sql = 'INSERT INTO `person`(`fb_id`, `code`, `fname`, `lname`, `username`, `password`,';
    $sql .= ' `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status`) ';
    $sql .= ' VALUES (:facebookId,:code,:fname,:fname,:username,:password,';
    $sql .= ' :idcard,:mobile,:email,NOW(),:updateby,:status)';

    $stmt = $pdo->conn->prepare($sql);
    $exe = $stmt->execute($values);
    return $exe;
}

function genUserCode($pdo){
    $code =  $pdo->createPersonSerialCode(CUSTOMER_ID);
    return $code;
}

function sesSessionUserProfile($pdo, $facebookId) {
    $sql = 'SELECT * FROM person WHERE fb_id=:facebookId';
    $stmt = $pdo->conn->prepare($sql);
    $exe = $stmt->execute(array(
        'facebookId' => $facebookId
    ));
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['person'] = $result;
    exit();
}
