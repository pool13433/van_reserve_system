<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

/*
 * สร้างตัวแปรเพื่อเก็บค่า
 */
$pvp_id = '';
$pvp_name = '';
$pv_id = '';
$pvp_updatedate = '';
$pvp_updateby = '';

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM province_place WHERE pvp_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $pvp_id = $result->pvp_id;
    $pvp_name = $result->pvp_name;
    $pv_id = $result->pv_id;
    $pvp_updatedate = $result->pvp_updatedate;
    $pvp_updateby = $result->pvp_updateby;
}
?>

<form class="form-horizontal" id="form_province_place"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการสถานที่ในจังหวัดในประเทศไทย
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-province_place" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div id="error-message-wrapper"> </div>

            <div class="form-group">
                <label for="place_name" class="col-sm-2 control-label">ชื่อสถานที่ในจังหวัด</label>
                <div class="col-sm-10">
                    <input type="hidden" name="id" 
                           value="<?= $pvp_id ?>"/>
                    <input type="text" class="form-control" name="place_name" placeholder="ชื่อสถานที่ในจังหวัด" 
                           required data-bv-notempty-message="กรุณากรอกชื่อสถานที่ในจังหวัด" 
                           value="<?= $pvp_name ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="province" class="col-sm-2 control-label">สังกัดในจังหวัด</label>
                <div class="col-sm-10">
                    <?php
                    $stmt = $pdo->conn->prepare('SELECT * FROM province ORDER BY pv_name ASC');
                    $stmt->execute();
                    $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <select class="form-control" name="province">
                        <?php foreach ($provinces as $index => $province) { ?>
                            <?php if ($pv_id == $province->pv_id) { ?>
                                <option value="<?= $province->pv_id ?>" selected><?= $province->pv_name ?></option>
                            <?php } else { ?>
                                <option value="<?= $province->pv_id ?>"><?= $province->pv_name ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
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
        var formId = 'form_province_place';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm(formId, '../actionDb/province_place.php?action=create');
        });
    });
</script>