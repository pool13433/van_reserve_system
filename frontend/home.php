<?php
session_start();
$url_redirect = 'http://localhost/van/frontend/index.php?page=van_search';

require_once '../frontend/facebook-api.php';
if ($user) { // Login 
    echo '<meta http-equiv="refresh" content="0; url=' . $url_redirect . '" />';
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ยินดีต้อนรับเข้าสู่โปรแกรมจองตั๋วรถตู้ออนไลน์</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include '../filecenter/includeCssJs.php'; ?>
    </head>
    <body>

        <!-- Page Content -->
        <div class="container">

            <!-- Portfolio Item Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ยินดีต้อนรับเข้าสู่โปรแกรมจองรถตู้ออนไลน์
                        <small>สะดวก รวดเร็ว ทันใจ</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Portfolio Item Row -->
            <div class="row">

                <div class="col-md-8">
                    <img class="img-responsive" src="http://placehold.it/750x500" alt="">
                </div>

                <div class="col-md-4">
                    <h3>ระบบจองรถตู้ออนไลน์</h3>
                    <p>ระบบจองรถตู้ออนไลน์ สามารถจองที่ไหนก้ได้ เพียงท่านมี ข้อมูลการเข้าใช้งาน Facebook หรือสมัครสมาชิกระบบ ก็สามารถเข้าใช้งานได้ทันทีโดยไม่มีค่าใช้จ่ายในการสมัคร ใด ๆทั้งสิ้น</p>
                    <h3>ความสามารถของโปรแกรม</h3>
                    <ul>
                        <li>ผู้ใช้งานทุกเพศทุกวัย สามารถใช้งานได้</li>
                        <li>ใช้งานง่ายรวดเร็ว</li>
                        <li>สะดวกมากสำหรับการสั่งจอง โดยไม่ต้องเดินทางมาจองเพียงเข้าเว็บไซต์เราก็จองได้ทันที</li>
                        <li>สามารถติดตามดูข้อมูลย้อนหลังได้</li>
                    </ul>
                    <a href="index.php?page=van_search" class="btn btn-primary btn-block">
                        <i class="glyphicon glyphicon-shopping-cart"></i> เริ่มการสั่งจองได้ทันที</a>
                    <a href="่#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#loginModal">
                        <i class="glyphicon glyphicon-log-in"></i> ล็อกอิน
                    </a>

                    <a href="่#" class="btn btn-info btn-block" data-toggle="modal" data-target="#registerModal">
                        <i class="glyphicon glyphicon-registration-mark"></i> สมัครสมาชิก
                    </a>
                    <?php require '../dialog/dialog_register.php'; ?>
                    <?php require '../dialog/dialog_login.php'; ?>
                </div>

            </div>
            <!-- /.row -->

            <!-- Related Projects Row -->
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header">หน้าจอการใช้งาน บางส่วน</h3>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="#">
                        <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    </a>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="#">
                        <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    </a>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="#">
                        <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    </a>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="#">
                        <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    </a>
                </div>

            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

    </body>
</html>
