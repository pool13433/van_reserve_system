<?php
require_once '../../assets/MPDF57/mpdf.php';
require_once '../../mysql_con/PDOMysql.php';
require_once '../../actionDb/variableGlobal.php';
/*
 * *************** start data manage************
 */
$dataArray = array();
if (!empty($_GET)) {
    $sql = " SELECT `rs_id`, `cus_id`, `v_id`, `rs_price`, DATE_FORMAT(`rs_usabledate`,'%d-%m-%Y') rs_usabledate, ";
    $sql .= " `vp_idstart`, `vp_idend`, `rs_createdate`, `rs_updateby`, `rs_url`, `rs_status`, ";    
    $sql .=" `id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`,";
    $sql .= " `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status`";
    $sql .= " FROM `reserve` r";
    $sql .= " LEFT JOIN person p ON p.id = r.cus_id";
    $sql .= " ";
    $sql .= " WHERE 1 =1 ";
    if (!empty($_GET['place_begin']) && !empty($_GET['place_end'])) {
        $place_begin = $_GET['place_begin'];
        $place_end = $_GET['place_end'];
        $sql .= " AND vp_idstart = $place_begin AND vp_idend = $place_end";
    }
    if (!empty($_GET['reserve_date_begin']) && !empty($_GET['reserve_date_end'])) {
        $date_start = $_GET['reserve_date_begin'];
        $date_end = $_GET['reserve_date_end'];
        $sql .= " AND (rs_usabledate BETWEEN STR_TO_DATE('$date_start','%Y-%m-%d')";
        $sql .= " AND STR_TO_DATE('$date_end','%Y-%m-%d')";
        $sql .= ") ";
    }
    $pdo = new PDOMysql();
    $pdo->conn = $pdo->open();
    $stmt = $pdo->conn->prepare($sql);
    $stmt->execute();
    $dataArray = $stmt->fetchAll(PDO::FETCH_OBJ);
}
/*
 * *************** end data manage************
 */


ob_start(); // เริ่ม วาด html
//echo 'sql ::==' . $sql;
//echo '<br/>';
//echo 'begin ::==' . $_GET['reserve_date_begin'];
//echo '<br/>';
//echo 'end ::==' . $_GET['reserve_date_end'];
?>
<h2 style="text-align: center">รายงาน ผู้ใช้งานในระบบ</h2>
<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ-สกุล</th>
            <th>วันที่สั่งจองตั๋ว</th>
            <th>จุดขึ้น-จุดลง</th>
            <th>เวลาออก</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataArray as $index => $obj) { ?>
            <tr>
                <td><?= ($index + 1) ?></td>
                <td><?= $obj->fname . '   ' . $obj->lname ?></td>
                <td><?= $obj->rs_usabledate ?></td>
                <td><?= $obj->mobile ?></td>
                <td><?= getDataListByKey($obj->status, arrayPersonStatus(), 'NAME') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$html = ob_get_contents(); // รับ html ที่วาดทั้งหมด
ob_end_clean(); // ล้าง html ทั้งหมด

/*
 * *************** start mpdf lib ************
 */
$mpdf = new mPDF('UTF-8');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetAutoFont();
/*
 * L or landscape: Landscape
  P or portrait: Portrait
 */
$mpdf->AddPage('L');

$stylesheet = file_get_contents('../../css/report_style.css'); // external css
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);

$mpdf->Output();
/*
 * *************** end mpdf lib ************
 */