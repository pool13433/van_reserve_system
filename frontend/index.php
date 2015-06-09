<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <title>ระบบจองรถตู้ออนไลน์ [VSM VanSystemManage]</title>
        <?php require '../filecenter/includeCssJs.php';?>
    </head>

    <body>
        <?php 
        if (!isset($_SESSION)) {
            session_start();
        }
        ?>
        <?php if (empty($_SESSION['person'])) { ?>
            <?php include './login.php'; ?>
        <?php } else { ?>
            <div class="container-fluid" style="margin-top: 100px;">                                     
                <div class="row clearfix">
                    <?php include '../filecenter/menu-header.php'; ?> 
                    <div class="col-md-3 column">
                        <?php include '../filecenter/menu-left.php'; ?>
                    </div>
                    <div class="col-md-9 column">
                        <?php
                        // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
                        if (!empty($_GET)) {  // มีค่า
                            $page = $_GET['page'] . '.php';
                            if (file_exists($page)) {
                                include $page;
                            } else {
                                // หน้าจอโปรแกรมกรณีเรียกหน้า้พจไม่ถูกต้อง 404
                                include '../filecenter/404.php';
                            }
                        } else {
                            // หน้าจอโปรแกรม default ที่เข้ามาจะเห็นหน้าแรก
                        }
                        /*
                         *  Load Modal
                         */
                        ?>

                    </div>
                </div>
                <?php include '../filecenter/footer.php'; ?>
            </div>
        <?php } ?>
    </body>
</html>
