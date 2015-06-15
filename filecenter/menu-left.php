<?php
if (empty($_SESSION)) {
    session_start();
}
$authen = $_SESSION['person'];
?>
<div class="panel-group" id="accordion">
    <?php if ($authen->status == EMPLOYEE_ID || $authen->status == ONWER_ID) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <span class="glyphicon glyphicon-user">
                        </span>เมนูผู้ใช้งาน</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-pencil text-primary"></span>
                                <a href="index.php?page=list-person&status=<?= EMPLOYEE_ID ?>">จัดการเจ้าหน้าที่ดูแลระบบ</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-flash text-success"></span>                        
                                <a href="index.php?page=list-person&status=<?= CUSTOMER_ID ?>">จัดการลูกค้า</a>    
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-file text-info"></span>
                                <a href="index.php?page=list-person&status=<?= DRIVER_ID ?>">จัดการพนักงานขับรถ</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTow">
                        <span class="glyphicon glyphicon glyphicon-th-large">
                        </span>เมนูจัดการข้อมูลพื้นฐาน</a>
                </h4>
            </div>
            <div id="collapseTow" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=list-company">จัดการบริษัทเดินรถ</a>
                            </td>
                        </tr>   
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=list-province">จัดการจังหวัดของแต่ละสถานที่</a>
                            </td>
                        </tr>                                                 
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <span class="glyphicon glyphicon glyphicon-th">
                        </span>เมนูตั้งค่าข้อมูลรถตู้</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=list-province_place">จัดการสถานที่ในแต่ละจังหวัด</a>
                            </td>
                        </tr> 
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=list-van">ฟอร์มจัดรถตู้</a>
                            </td>
                        </tr> 
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=form-van_place">ฟอร์มจัดการระยะทางของสถานที่</a>
                            </td>
                        </tr>                                               
                    </table>
                </div>
            </div>
        </div>
    <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        <span class="glyphicon glyphicon glyphicon-tasks">
                        </span>เมนูการจองรถตู้</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=list-reserve">จัดการจองรถ</a>
                            </td>
                        </tr>                                                                 
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                        <span class="glyphicon glyphicon-file">
                        </span>รายงาน</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-usd"></span>
                                <a href="index.php?page=">รายงานข้อมูลสมาชิก</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-user"></span>
                                <a href="index.php?page=">รายงานข้อมูลการจองรถตู้</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-tasks"></span>
                                <a href="index.php?page=">รายงานข้อมูลการจองตั๋วรถตู้</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <a href="index.php?page=">รายงานข้อมุลการแจ้งยกเลิกการจองรถตู้</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <a href="index.php?page=">รายงานข้อมูลการจองตั๋วรถตู้</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <a href="index.php?page=">รายงานข้อมูลการแจ้งการชำระเงิน</a>
                            </td>
                        </tr>
                        <tr>
                            <td onclick="setAccordion(this)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <a href="index.php?page=">รายงานยอดขายของพนักงาน</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
                        </span>เมนูเกี่ยวกับระบบ</a>
                </h2>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=van_search">
                                    <h4><i class="glyphicon glyphicon-search"></i> เริ่มค้นหาสายเดินรถ</h4>
                                </a>
                            </td>
                        </tr>     
                        <tr>
                            <td onclick="setAccordion(this)">
                                <a href="index.php?page=history_reserve">
                                    <h4><i class="glyphicon glyphicon-list-alt"></i> รายการจองรถทั้งหมด</h4>
                                </a>
                            </td>
                        </tr>   
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + getCookie('accordion')).prop('class', 'panel-collapse collapse in');
    });
</script>