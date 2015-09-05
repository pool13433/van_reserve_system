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
            <?php
            require_once '../mysql_con/PDOMysql.php';
            $pdo = new PDOMysql();
            $pdo->conn = $pdo->open();
            $sql = ' SELECT  rs.*,p.*,v.*,vt.*,';
            $sql .= ' (SELECT pvp.pvp_name FROM van_place vp LEFT JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id ';
            $sql .=' WHERE vp.vp_id = rs.vp_idstart) as place_start,';
            $sql .= ' (SELECT pvp.pvp_name FROM van_place vp LEFT JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id';
            $sql .=' WHERE vp.vp_id = rs.vp_idend) as place_end';
            $sql .= ' FROM reserve rs';
            $sql .= ' LEFT JOIN van v ON v.v_id = rs.v_id';
            $sql .= ' LEFT JOIN van_time vt ON vt.v_id = v.v_id';
            $sql .= ' LEFT JOIN person p ON p.id = rs.cus_id';
            $sql .= ' WHERE rs_id = ' . $_GET['reserve_id'];
            //echo 'sql ::==' . $sql;
            $stmt = $pdo->conn->prepare($sql);
            $stmt->execute(array(':authen_id' => $authen->id));
            $reserve = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($reserve);
            ?>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td><h2>ชื่อสายรถ</h2></td>
                        <td><?= $reserve->v_name ?></td>
                    </tr>
                    <tr>
                        <td><h2>เส้นทาง</h2></td>
                        <td>ขึ้นจาก <?= $reserve->place_start ?> ไปลงที่ <?= $reserve->place_end ?></td>
                    </tr>
                    <tr>
                        <td><h2>ที่นั่ง</h2></td>
                        <td>
                            <ul>
                                <?php
                                $sql = 'SELECT * FROM van_chair  vc ';                                
                                $sql .= ' WHERE vc.vc_cusid =:customer_id';
                                //echo 'sql ::=='.$sql.' customer_id ::=='. $reserve->id;
                                $stmt = $pdo->conn->prepare($sql);
                                $stmt->execute(array(':customer_id' => $reserve->id));
                                $places = $stmt->fetchAll(PDO::FETCH_OBJ);
                                foreach ($places as $index => $place) {
                                    ?>
                                    <li><?= $place->vc_label ?></li>
                                <?php } ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><h2>ราคารวม</h2></td>
                        <td><?=$reserve->rs_price?> บาท</td>
                    </tr>
                    <tr>
                        <td><h2>เวลารถออก</h2></td>
                        <td><?= $reserve->vt_drivestart ?></td>
                    </tr>
                    <tr>
                        <td><h2>เวลารถถึง</h2></td>
                        <td><?= $reserve->vt_driveend ?></td>
                    </tr>
                    <tr>
                        <td><h2>วันที่ต้องชำระเงินก่อน</h2></td>
                        <td><?= $reserve->v_driveend ?></td>
                    </tr>
                </tbody>
            </table>

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