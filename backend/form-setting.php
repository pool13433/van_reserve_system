<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();


/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
$stmt = $pdo->conn->prepare('SELECT * FROM van_setting WHERE vs_id =:id');
$stmt->execute(array(':id' => 1));
$result = $stmt->fetch(PDO::FETCH_OBJ);

/*
 * เซตค่าใส่ตัวแปร
 */
$vs_id = $result->vs_id;
$vs_name = $result->vs_name;
$vs_desc = $result->vs_desc;
$vs_value = $result->vs_value;
?>

<form class="form-horizontal" id="form_setting"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มตั้งค่าค่าบริการ
            </h4>
        </div>
        <div class="panel-body">
            <div id="error-message-wrapper"> </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <div class="alert alert-info"><?=$vs_desc?></div>
                </div>
            </div>
            <div class="form-group">
                <label for="setting_value" class="col-sm-2 control-label">ค่าบริการ</label>
                <div class="col-sm-2">
                    <input type="hidden" name="id" 
                           value="<?= $vs_id ?>"/>
                    <input type="text" class="form-control" name="setting_value"
                           value="<?= $vs_value ?>"/>
                </div>
                <label class="col-sm-2 control-label">ต่อ 1 กิโลเมตร</label>
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
                        <button type="button" id="btnReset" class="btn btn-danger">
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
        var formId = 'form_setting';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm(formId, '../actionDb/van_setting.php?action=update');
        });
        $('#btnReset').on('click',function(){
            $('input[name=setting_value]').val('');
        });
    });
</script>