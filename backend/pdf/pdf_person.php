<?php
require_once '../../assets/MPDF57/mpdf.php';
require_once '../../mysql_con/PDOMysql.php';
require_once '../../actionDb/variableGlobal.php';
/*
 * *************** start data manage************
 */
$person_status = $_GET['person_status'];
$dataArray = array();

$sql = "SELECT `id`, `fb_id`, `code`, `fname`, `lname`, `username`, `password`,";
$sql .= " `idcard`, `mobile`, `email`, `updatedate`, `updateby`, `status` FROM `person`";
$sql .= " WHERE 1 =1";
if (!empty($person_status) | (is_numeric($person_status) && $person_status == '0')) {
    $sql .= " AND status = $person_status";
}
if (!empty($_GET['person_char'])) {
    $sql .= " AND (";
    $sql .= "fname LIKE '%" . $_GET['person_char'] . "%' ";
    $sql .= " OR ";
    $sql .= "lname LIKE '%" . $_GET['person_char'] . "%' ";
    $sql .= ")";
}
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();
$stmt = $pdo->conn->prepare($sql);
$stmt->execute();
$dataArray = $stmt->fetchAll(PDO::FETCH_OBJ);

/*
 * *************** end data manage************
 */


ob_start(); // เริ่ม วาด html

/*
 * DUBUG Code
 */
//echo 'sql ::==' . $sql;
?>
<h2 style="text-align: center">รายงาน ผู้ใช้งานในระบบ</h2>
<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ-สกุล</th>
            <th>รหัสบัตรประชาชน</th>
            <th>เบอร์-ติดต่อ</th>
            <th>ตำแหน่ง</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataArray as $index => $obj) { ?>
            <tr>
                <td><?= ($index + 1) ?></td>
                <td><?= $obj->fname . '   ' . $obj->lname ?></td>
                <td><?= $obj->idcard ?></td>
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
$mpdf->useDefaultCSS2 = true;

$stylesheet = file_get_contents('../../css/report_style.css'); // external css
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);

$mpdf->Output();
/*
 * *************** end mpdf lib ************
 */