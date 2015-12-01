<?php 
require_once '../../assets/MPDF57/mpdf.php';
require_once '../../mysql_con/PDOMysql.php';
require_once '../../actionDb/variableGlobal.php';


$status = $_GET['status'];
$sql = ' select rs.rs_code, concat(per.fname ,\' \',per.lname) as name, rp.vp_paydate,rp.vp_paytime,rp.vp_paymoney,rp.vp_status '; 
$sql .= ' from reserve rs,reserve_pay rp, person per ';
$sql .= ' WHERE rs.rs_id = rp.rs_id ';
$sql .= ' AND rs.cus_id = per.id ';
$sql .= ' AND rp.vp_status = '. $status;


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

<!--วาด html-->
<h2 style="text-align: center">รายงานข้อมูลการแจ้งการชำระเงิน</h2>
<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>เลขที่ใบจอง</th>
            <th>ชื่อ-สกุล</th>
            <th>วันที่และเวลาชำระเงิน</th>
            <th>จำนวนเงิน</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataArray as $index => $obj) { ?>
            <tr>
                <td><?= ($index + 1) ?></td>
                <td><?= $obj->rs_code ?></td>
                <td><?= $obj->name ?></td>
                <td><?= $obj->vp_paydate . '   ' . $obj->vp_paytime ?></td>
                <td><?= $obj->vp_paymoney ?></td>
                <td><?= getDataListByKey($obj->vp_status, arrayPaymentStatus(), 'NAME') ?></td>
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