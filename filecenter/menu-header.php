<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../actionDb/variableGlobal.php';
$authen = (empty($_SESSION['person']) ? '' : $_SESSION['person']);
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./home.php">ระบบจองรถตู้ออนไลน์</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="index.php?page=van_search">
                    <i class="glyphicon glyphicon-search"></i> เริ่มค้นหาสายเดินรถ
                </a>
            </li>
            <?php if (!empty($_SESSION['person'])) { ?>
                <li>
                    <a href="index.php?page=history_reserve">
                        <i class="glyphicon glyphicon-list-alt"></i> รายการจองรถทั้งหมด
                    </a>
                </li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (!empty($_SESSION['person'])) { ?>
                <li>
                    <?php
                    $_SESSION['person'];
                    ?>
                </li>
            <?php } ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">เมนูระบบ<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="glyphicon glyphicon-pencil"></i> แก้ไขข้อมูลส่วนตัว
                        </a>
                    </li>
                    <li>
                        <a href="../frontend/facebook-api.php?action=logout" onclick="return confirm('ยืนยันการออกจากระบบ')">
                            <i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>