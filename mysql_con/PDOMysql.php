<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PDOMysql {

    private static $DSN = "mysql:host=localhost;dbname=db_van";
    private static $USERNAME = "root";
    private static $PASSWORD = "";
    private static $OPTIONS = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    public $conn = null;
    private $RESULT_ARRAY = array();
    private $RESULT_OBJECT = null;

    public function __construct() {
        /* try {
          $this->conn = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
          } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
          } */
    }

    public function open() {
        try {
            $this->conn = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }

    public function returnJson($status, $title, $message, $url) {
        return json_encode(array(
            'status' => $status,
            'title' => $title,
            'message' => $message,
            'url' => $url
        ));
    }

    function format_date($format, $date) {
        if ($date == null) {
            //return date('d/m/Y');
            return '-';
        } else if ($date == '0000-00-00') {
            return date('d-m-Y');
        } else {
            $date_format = new DateTime($date);
            $new_date = $date_format->format($format);
            return $new_date;
        }
    }

    function createPersonSerialCode($personStatus) {
        $pdo = new PDOMysql();
        $pdo->conn = $pdo->open();
        //SELECT LPAD(CONVERT(RIGHT(`code`, 4),UNSIGNED INTEGER),4,0) as newnumber FROM `person`         
        $sql = ' SELECT RIGHT((LEFT(CURDATE(),4)+543),2) as year_ad,'; // 58
        $sql .= ' CASE status ';
        $sql .= ' WHEN 1 THEN \'EMP\'';
        $sql .= ' WHEN 2 THEN \'ONW\'';
        $sql .= ' WHEN 3 THEN \'CUS\'';
        $sql .= ' WHEN 4 THEN \'DRI\'';
        $sql .= ' WHEN 0 THEN \'GEN\'';
        $sql .= ' ELSE \'ERR\'';
        $sql .= ' END prefix_status,';
        $sql .= ' LEFT(`code`,3) as prefix,'; // DRI,EMP,CUS,ONW
        $sql .= ' LPAD(CONVERT(RIGHT(`code`, 4),UNSIGNED INTEGER)+1,4,0) as new_runnumber,';
        $sql .= ' RIGHT(`code`, 4) as runnumber';
        $sql .= ' FROM person WHERE status =:status';
        $sql .= ' ORDER BY RIGHT(`code`, 4) DESC LIMIT 0,1 ';
        //echo 'sql ::=='.$sql;

        $stmt = $pdo->conn->prepare($sql);
        $stmt->execute(array(':status' => $personStatus));
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $prefix = $result->prefix;
        $runnumber = $result->runnumber;
        $year_ad = $result->year_ad;
        $newrunnumber = $result->new_runnumber;
        return $prefix . $year_ad . $newrunnumber;
    }

    public function createReserveVanCode() {
        $pdo = new PDOMysql();
        $pdo->conn = $pdo->open();

        $sql = " SELECT LEFT(rs_code,3) rs_prefix, ";
        $sql .= " LPAD(CONVERT(RIGHT(`rs_code`, 7),UNSIGNED INTEGER)+1,7,0) rs_number";
        $sql .= " FROM reserve";
        $sql .= " ORDER BY RIGHT(rs_code,7) DESC";
        $sql .= " LIMIT 0,1";

        $stmt = $pdo->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $prefix = $result->rs_prefix;
        $new_number = $result->rs_number;
        return $prefix . $new_number;
    }

    function getPriceInKilomate() {
        $pdo = new PDOMysql();
        $pdo->conn = $pdo->open();
        $stmt = $pdo->conn->prepare('SELECT vs_value FROM van_setting WHERE vs_id = 1');
        $stmt->execute(array());
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return intval($result->vs_value);
    }

    // ################### upload config #############
    public static $PATH_UPLOAD = "/images/uploads/";
    public static $PATH_UNZIP = "/images/unzip/";
    public static $EX_FILEZIP_NAME = "99999-20141231-01.zip";
    public static $EX_FILEZIP_LENGTH = 21;
    public static $ACCEPTED_FILES = 'application/zip';
    public static $MAX_FILE_SIZE = 20;
    public static $MUTI_UPLOAD = 1;  // 1 = Signgle, > 1 = Muti
    //
    public static $FILE_NAME_COUNT = "OPD";

    // ################### upload config #############
}
