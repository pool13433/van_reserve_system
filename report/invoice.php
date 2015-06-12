<?php
require '../assets/MPDF57/mpdf.php';
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />                
        <link href="../css/report_style.css" rel="stylesheet"/>
    </head>    
    <body>
        <div style="width:100%;font-size:14px;">
<!--            <div style="text-align:center"><img src="../upload/BuuLogo.png"  style="max-height: 100px;max-width: 100px"/></div>-->
            <h1 style="text-align: center">ใบเสร็จจ่ายค่าจองรถตู้</h1>
        </div>
        <div> 
            ใบจ่ายเงิน        
        </div>
    </body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF("UTF-8");
/* $mpdf->SetAutoFont();
  $mpdf->WriteHTML($html);
  $mpdf->Output(); */
$mpdf->SetFont('th_sarabun');
//$mpdf->SetAutoFont();
$mpdf->AddPage('L');
$mpdf->Write($stylesheet, 1);
$mpdf->WriteHTML($html);
//$mpdf->Output('รายงานการตอบข่าว.pdf', 'D');
$mpdf->Output();
?>