<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

/*
 * สร้างตัวแปรเพื่อเก็บค่า
 */
$c_id = '';
$c_name = '';
$c_onwer = '';
$c_mobile = '';
$c_address = '';
$c_updatedate = '';
$c_updateby = '';

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM company WHERE c_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $c_id = $result->c_id;
    $c_name = $result->c_name;
    $c_onwer = $result->c_onwer;
    $c_mobile = $result->c_mobile;
    $c_address = $result->c_address;
    $c_updatedate = $result->c_updatedate;
    $c_updateby = $result->c_updateby;
}
?>

<form class="form-horizontal" id="form_company"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการจังหวัดในประเทศไทย
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-company" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div id="error-message-wrapper"> </div>

            <div class="form-group">
                <label for="company_name" class="col-sm-2 control-label">ชื่อบริษัทการเดินรถ</label>
                <div class="col-sm-10">
                    <input type="hidden" name="id" 
                           value="<?= $c_id ?>"/>
                    <input type="text" class="form-control" name="company_name" placeholder="ชื่อบริษัทการเดินรถ" 
                           required data-bv-notempty-message="กรุณากรอกชื่อบริษัทการเดินรถ" 
                           value="<?= $c_name ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="company_onwer" class="col-sm-2 control-label">ชื่อเจ้าของบริษัท</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="company_onwer" placeholder="ชื่อเจ้าของบริษัทเดินรถ" 
                           required data-bv-notempty-message="กรุณากรอกชื่อเจ้าของบริษัทเดินรถ" 
                           value="<?= $c_onwer ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="company_mobile" class="col-sm-2 control-label">เบอร์โทรติดต่อ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="company_mobile" placeholder="เบอร์โทรติดต่อ" 
                           required data-bv-notempty-message="กรุณากรอกเบอร์โทรติดต่อ" 
                           value="<?= $c_mobile ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="company_address" class="col-sm-2 control-label">ที่ตั้งบริษัท</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="company_address" placeholder="ที่ตั้งบริษัท" 
                           required data-bv-notempty-message="กรุณากรอกที่ตั้งบริษัท" 
                           ><?= $c_address ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    <div id="messages"></div>
                </div>
            </div>
        </div>
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
        var formId = 'form_company';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm(formId, '../actionDb/company.php?action=create');
        });
    });
</script>