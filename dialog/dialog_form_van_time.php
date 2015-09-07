<!-- Modal -->
<form class="form-horizontal" id="form_van_time"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <div class="modal fade" id="model_van_time" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ฟอร์มจัดการ ระยะเวลาการเดินทางของสายรถตู้ </h4>
                </div>
                <div class="modal-body">
                    <div id="error-message-wrapper"> </div>

                    <div class="form-group">
                        <label for="v_driver" class="col-sm-2 control-label">พนักงานขับรถ</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="van_id" value="<?= $_GET['van_id'] ?>"/>
                            <input type="hidden" name="van_time_id"/>
                            <select class="form-control" name="van_driver" id="v_driver"
                                    required data-bv-notempty-message="กรุณาเลือก พนักงานขับรถ"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="v_company" class="col-sm-2 control-label">เวลารถออก</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control clockpicker" placeholder="h:m"  
                                       required data-bv-notempty-message="กรุณากรอกเวลารถออก" name="van_drive_start" id="drive_start"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div> 
                        </div>
                        <label for="v_company" class="col-sm-2 control-label">เวลารถถึงที่หมาย</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control clockpicker" placeholder="h:m" 
                                       required data-bv-notempty-message="กรุณากรอกเวลารถถึงที่หมาย" name="van_drive_end" id="drive_end"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div id="messages"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-saved"></i> บันทึก
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        initHtmlElement();
        var formId = 'form_van_time';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            var isConfirm = confirm('ยืนยันการบันทึกข้อมูลระยะเวลาการเดินรถ ใช่[OK] || ไม่ใช่[Cancel]');
            if (isConfirm) {
                postForm(formId, '../actionDb/van_time.php?action=create');
            }
            return;
        });
    });
    function initHtmlElement() {
        var combo_drive = $('#v_driver');
        combo_drive.empty().append('<option value=""> -- โปรดเลือก --</option>');
        $.get('../actionDb/person.php?action=getDriver', {}, function (response) {
            $.each(response, function (index, object) {
                combo_drive.append('<option value="' + object.id + '">' + object.fname + '   ' + object.lname + '</option>')
            });
        }, 'json');
    }
    function setFormVanTime(van_time_id) {
        $.get('../actionDb/van_time.php?action=getVanTimeById', {van_time_id: van_time_id}, function (response) {            
            $('#v_driver option').filter('[value="'+response.vt_driver+'"]').attr('selected', true)
            $('#form_van_time').find('input[name=van_time_id]').val(response.vt_id);
            $('#form_van_time').find('input[name=van_drive_start]').val(response.vt_drivestart);
            $('#form_van_time').find('input[name=van_drive_end]').val(response.vt_driveend);
        }, 'json');
    }    
</script>