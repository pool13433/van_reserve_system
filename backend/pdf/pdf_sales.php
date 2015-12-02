<?php
require_once '../../assets/MPDF57/mpdf.php';
require_once '../../mysql_con/PDOMysql.php';
require_once '../../actionDb/variableGlobal.php';

$params = array();

$year = $_GET['year'];
$month = $_GET['month'];
$sql = ' SELECT sum(`rs_price`) sum_price, ';
$sql .= ' date_format(rs_createdate,\'%m\') as month, ';
$sql .= ' date_format(rs_createdate,\'%Y\') as year FROM `reserve` ';
$sql .= ' WHERE 1=1 ';
if (!empty($year)) {
    if (!empty($month)) {     
        $sql .= ' AND  date_format(rs_createdate,\'%Y-%m\') =:year_month';
        $sql .= ' group by date_format(`rs_createdate`,\'%Y-%m\') ';
        $params['year_month'] = $year.'-'.$month;
    } else {
        $sql .= ' AND  date_format(rs_createdate,\'%Y\') =:year';
        $sql .= ' group by date_format(rs_createdate,\'%Y\') ';
        $params['year'] = $year;
    }
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
//var_dump($dataArray);
//echo '<br/>';
//var_dump($params);
//echo '<br/>';
//echo 'sql ::==' . $sql; 
?>

<!--วาด html-->
<h2 style="text-align: center">รายงานข้อมูลยอดขาย</h2>
<table style="font-size: 16px;">
    <thead>
        <tr>
            <th>ปี</th>
            <th>เดือน</th>
            <th>ยอดขาย</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataArray as $index => $obj) { ?>
            <tr>
                <td style="text-align: center;"><?= $obj->year ?></td>
                <td style="text-align: center;"><?= $thai_month_arr[strval($obj->month)] ?></td>
                <td  style="text-align: center;"><?= $obj->sum_price ?></td>
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