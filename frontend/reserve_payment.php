<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

$sql = ' SELECT ';
$sql .= ' `rs_id`, `rs_code`, `cus_id`, `v_id`, `rs_price`, `rs_usabledate`, `vp_idstart`, `vp_idend`, `vt_id`, `rs_createdate`, `rs_updateby`, `rs_status`';
$sql .= ' FROM reserve';
$sql .= ' WHERE rs_id =:id';

$stmt = $pdo->conn->prepare($sql);
$stmt->execute(array(':id' => $_GET['id']));
$result = $stmt->fetch(PDO::FETCH_OBJ);
$rs_id = $result->rs_id;
$rs_code = $result->rs_code;
$cus_id = $result->cus_id;
$v_id = $result->v_id;
$rs_price = $result->rs_price;
$rs_usabledate = $result->rs_usabledate;
$vp_idstart = $result->vp_idstart;
$vp_idend = $result->vp_idend;
$vt_id = $result->vt_id;
$rs_createdate = $result->rs_createdate;
$rs_updateby = $result->rs_updateby;
$rs_status = $result->rs_status;
?>
<form class="form-horizontal" id="form_payment"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" 
      enctype="multipart/form-data" method="POST">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มแจ้งการชำระเงิน
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
                <label for="code" class="col-sm-2 control-label">เลขการจอง</label>
                <div class="col-sm-2">
                    <input type="hidden" name="id" 
                           value="<?= $rs_id ?>"/>
                    <input type="text" class="form-control" name="reserve_code" readonly
                           value="<?= $rs_code ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="slipe" class="col-sm-2 control-label">ไฟล์สลิป</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="reserve_slip" placeholder="ไฟล์สลิป" 
                           required data-bv-notempty-message="กรุณากรอก ไฟล์สลิป" 
                           value="<?= $c_onwer ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="payment_money" class="col-sm-2 control-label">จำนวนเงิน</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="payment_money" placeholder="เวลา ชำระเงิน" 
                           required data-bv-notempty-message="กรุณากรอก จำนวนเงิน" />
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label">วันที่ ชำระเงิน</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="date" id="date" placeholder="วันที่ ชำระเงิน" 
                           required data-bv-notempty-message="กรุณากรอก วันที่ ชำระเงิน" />
                    <input type="hidden" name="payment_date" id="payment_date" />
                </div>
            </div>
            <div class="form-group">
                <label for="payment_time" class="col-sm-2 control-label">เวลา ชำระเงิน</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="payment_time" placeholder="เวลา ชำระเงิน" 
                           required data-bv-notempty-message="กรุณากรอก เวลา ชำระเงิน" />
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
        $('#date').daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            format: 'DD-MM-YYYY',
            locale: DATEPICKER_LOCAL,
        }).on('apply.daterangepicker', function (ev, picker) {
            var date_apply = picker.startDate.format('YYYY-MM-DD');
            console.log(date_apply);
            $('#payment_date').val(date_apply);
        });

        var formId = 'form_payment';
        $('#' + formId).bootstrapValidator({
            fields: {
                reserve_slip: {
                    validators: {
                        file: {
                            extension: 'jpeg,png,pdf,jpg,gif',
                            type: 'image/jpeg,image/png,application/pdf,image/jpeg,image/gif',
                            maxSize: 2048 * 1024, // 2 MB
                            message: 'กรุณาเลือกไฟล์ สลิปการชำระเงิน'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            console.log(e.target);
            e.preventDefault();
            var formData = new FormData(e.target);
            $.ajax({
                url: '../actionDb/reserve_pay.php?action=create',
                type: 'POST',
                data: formData,
                dataType : 'JSON',
                mimeType:"multipart/form-data",
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('สถานะแจ้งการแจ้งการชำระเงิน '+response.message);
                    if(response.status){                        
                        redirectDelay(response.url,1);
                    }
                },
                error: function () {
                    alert("error in ajax form submission");
                }
            })
        });
    });
</script>