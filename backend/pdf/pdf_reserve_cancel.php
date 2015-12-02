<?php 
require_once '../../assets/MPDF57/mpdf.php';
require_once '../../mysql_con/PDOMysql.php';
require_once '../../actionDb/variableGlobal.php';
$params = array();
$reserve_start = $_GET['reserve_date_begin'];
$reserve_end = $_GET['reserve_date_end'];
$sql = ' select rs.rs_code, concat(per.fname ,\' \',per.lname) as name, rs.rs_usabledate, rs.rs_status '; 
$sql .= ' from reserve rs,reserve_pay rp, person per ';
$sql .= ' WHERE rs.cus_id = per.id ';
$sql .= ' AND rs.cus_id = per.id ';
$sql .= ' AND rs.rs_status = 2';

if(!empty($reserve_start) && !empty($reserve_end)){
    $sql .= ' AND rs.rs_usabledate between :reserve_begin and :reserve_end';
    $params['reserve_begin'] = $reserve_start;
    $params['reserve_end'] = $reserve_end;
}


$pdo = new PDOMysql();
$pdo->conn = $pdo->open();
$stmt = $pdo->conn->prepare($sql);
$stmt->execute($params);
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
<h2 style="text-align: center">รายงานข้อมูลการยกเลิกการจอง</h2>
<table>
    <thead>
        <tr>
           <th>เลขที่ใบจอง</th>
            <th>ชื่อ-สกุล</th>
            <th>วันที่จอง</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataArray as $index => $obj) { ?>
            <tr>
                <td><?= $obj->rs_code ?></td>
                <td><?= $obj->name ?></td>
                <td><?= $obj->rs_usabledate?></td>
                <td><?= getDataListByKey($obj->rs_status, arrayReserveStatus(), 'NAME') ?></td>
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