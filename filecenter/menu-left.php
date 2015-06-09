<!--<style type="text/css">
    //body{margin-top:50px;}
    .glyphicon { margin-right:10px; }
    .panel-body { padding:0px; }
    .panel-body table tr td { padding-left: 15px }
    .panel-body .table {margin-bottom: 0px; }
</style>-->
<?php require '../actionDb/variableGlobal.php'; ?>
<div class="panel-group" id="accordion">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <span class="glyphicon glyphicon-folder-close">
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
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
                    </span>เมนูเกี่ยวกับการจองรถตู้</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=list-">จัดการคิวรถตู้</a>
                        </td>
                    </tr>
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=">จัดการเส้นทางการเดินรถ</a>   
                        </td>
                    </tr>
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=">ข้อมูลการจองรถตู้</a>
                        </td>
                    </tr>
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=">ข้อมูลตารางการจองรตู้</a>
                        </td>
                    </tr>
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=">ข้อมูลการยกเลิกการจอง</a>
                        </td>
                    </tr>
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=">ข้อมูลสถานะการชำระเงิน</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
                    </span>เมนูเกี่ยวกับระบบ</a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=list-province">จัดการจังหวัด</a>
                        </td>
                    </tr>   
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=list-province_place">จัดการสถานที่ในแต่ละจังหวัด</a>
                        </td>
                    </tr> 
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=form-van_place">ฟอร์มจัดการค่าบริการรถตู้</a>
                        </td>
                    </tr> 
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=list-company">จัดการบริษัทเดินรถ</a>
                        </td>
                    </tr> 
                    <tr>
                        <td onclick="setAccordion(this)">
                            <a href="index.php?page=list-van">ฟอร์มจัดรถตู้</a>
                        </td>
                    </tr> 
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                    </span>รายงาน</a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
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
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + getCookie('accordion')).prop('class', 'panel-collapse collapse in');
    });
</script>