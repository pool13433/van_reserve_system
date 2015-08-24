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
        <a class="navbar-brand" href="../home.html">ระบบจองรถตู้ออนไลน์</a>
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
            <!--            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">One more separated link</a>
                                </li>
                            </ul>
                        </li>-->
        </ul>
        <!--        <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" />
                    </div> <button type="submit" class="btn btn-default">Submit</button>
                </form>-->
        <ul class="nav navbar-nav navbar-right">
            <!--            <li>
                            <a href="#">Link</a>
                        </li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">เมนูระบบ<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="glyphicon glyphicon-pencil"></i> แก้ไขข้อมูลส่วนตัว
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="logout('../actionDb/person.php?action=logout')">
                            <i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>