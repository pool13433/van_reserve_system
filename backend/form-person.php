<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

/*
 * สร้างตัวแปรเพื่อเก็บค่า
 */
$id = '';
$fname = '';
$lname = '';
$username = '';
$password = '';
$idcard = '';
$mobile = '';
$email = '';
$updatedate = '';
$updateby = '';
$status = (empty($_GET['status']) ? '' : $_GET['status']);
$code = $pdo->createPersonSerialCode($status);

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM person WHERE id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->id;
    $code = $result->code;
    $fname = $result->fname;
    $lname = $result->lname;
    $username = $result->username;
    $password = $result->password;
    $idcard = $result->idcard;
    $mobile = $result->mobile;
    $email = $result->email;
    $updatedate = $result->updatedate;
    $updateby = $result->updateby;
    $status = $result->status;
}
?>

<form class="form-horizontal" id="form_person"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการพนักงานขับรถ
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-person&status=<?=$status?>" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div id="error-message-wrapper"> </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="code" class="col-sm-4 control-label">รหัสบัตรพนักงาน</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="code" placeholder="รหัสบัตรพนักงาน" 
                               required data-bv-notempty-message="กรุณากรอกรหัสบัตรพนักงาน" 
                               value="<?= $code; ?>" readonly/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="idcard" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="idcard" placeholder="รหัสบัตรประชาชน" 
                               required data-bv-notempty-message="กรุณากรอกรหัสบัตรประชาชน" 
                               value="<?= $idcard; ?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="fname" class="col-sm-4 control-label">ชื่อเข้าใช้งานระบบ</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" placeholder="ชื่อเข้าใช้งานระบบ" 
                               required data-bv-notempty-message="กรุณากรอก username" 
                               value="<?= $username; ?>"/>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="lname" class="col-sm-4 control-label">รหัสผ่าน</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" 
                               required data-bv-notempty-message="กรุณากรอกpassword" 
                               value="<?= $password; ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lname" class="col-sm-4 control-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="ยืนยันรหัสผ่าน" 
                               required data-bv-notempty-message="กรุณากรอกpassword" 
                               value="<?= $password; ?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="fname" class="col-sm-4 control-label">ชื่อ</label>
                    <div class="col-sm-8">                        
                        <input type="text" class="form-control" name="fname" placeholder="ชื่อ" 
                               required data-bv-notempty-message="กรุณากรอกชื่อ" 
                               value="<?= $fname; ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lname" class="col-sm-4 control-label">สกุล</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="lname" placeholder="สกุล" 
                               required data-bv-notempty-message="กรุณากรอกสกุล" 
                               value="<?= $lname; ?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="fname" class="col-sm-4 control-label">อีเมลล์</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="email" placeholder="อีเมลล์" 
                               required data-bv-notempty-message="กรุณากรอกอีเมลล์" 
                               value="<?= $email; ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lname" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="mobile" placeholder="เบอร์โทรศัพท์" 
                               required data-bv-notempty-message="กรุณากรอกเบอร์โทรศัพท์" 
                               value="<?= $mobile; ?>"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden Field-->
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <input type="hidden" name="status" value="<?= $status ?>"/>
        <!-- Hidden Field-->


        <div class="panel-footer">
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-saved"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-danger">
                            <i class="glyphicon glyphicon-erase"></i> ล้างค่า
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var formId = 'form_person';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm(formId, '../actionDb/person.php?action=create');
        });
    });
</script>