<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

/*
 * สร้างตัวแปรเพื่อเก็บค่า
 */
$pv_id = '';
$pv_name = '';
$pv_updatedate = '';
$pv_updateby = '';

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM province WHERE pv_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $pv_id = $result->pv_id;
    $pv_name = $result->pv_name;
    $pv_updatedate = $result->pv_updatedate;
    $pv_updateby = $result->pv_updateby;
}
?>

<form class="form-horizontal" id="form_province"
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
                <a href="index.php?page=list-province" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div id="error-message-wrapper"> </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ชื่อจังหวัด</label>
                <div class="col-sm-10">
                    <input type="hidden" name="id" 
                           value="<?= $pv_id ?>"/>
                    <input type="text" class="form-control" name="province_name" placeholder="ชื่อจังหวัด" 
                           required data-bv-notempty-message="กรุณากรอกชื่อจังหวัด" 
                           value="<?= $pv_name ?>"/>
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
        var formId = 'form_province';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm(formId, '../actionDb/province.php?action=create');
        });
    });
</script>