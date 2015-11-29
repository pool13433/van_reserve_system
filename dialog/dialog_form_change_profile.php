<?php
$person = $_SESSION['person'];
$id = $person->id;
$code = $person->code;
$fname = $person->fname;
$lname = $person->lname;
$username = $person->username;
$password = $person->password;
$idcard = $person->idcard;
$email = $person->email;
$mobile = $person->mobile;
$address = $person->address;
?>
<form class="form-horizontal" id="form_change_profile" name="form_change_profile" 
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <!-- Modal -->
    <div class="modal fade" id="chaneProfileModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <div class="modal-body">
                    <div id="error-message-wrapper"> </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="code" class="col-sm-4 control-label">รหัสบัตรพนักงาน</label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" name="id" value="<?= $id ?>"/>
                                <input type="text" class="form-control" name="code" placeholder="รหัสบัตรพนักงาน" 
                                       required data-bv-notempty-message="กรุณากรอกรหัสบัตรพนักงาน" 
                                       value="<?= $code; ?>" readonly/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="idcard" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="idcard" placeholder="รหัสบัตรประชาชน" 
                                       required data-bv-notempty-message="กรุณากรอกรหัสบัตรประชาชน" maxlength="13"
                                       value="<?= $idcard; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="fname" class="col-sm-4 control-label">ชื่อเข้าใช้งานระบบ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="username" placeholder="ชื่อเข้าใช้งานระบบ" 
                                       required data-bv-notempty-message="กรุณากรอก username" readonly
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
                                <input type="text" class="form-control" name="mobile" placeholder="เบอร์โทรศัพท์ 10 หลัก" 
                                       required data-bv-notempty-message="กรุณากรอกเบอร์โทรศัพท์"  maxlength="10"
                                       value="<?= $mobile; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="fname" class="col-sm-2 control-label">อีเมลล์</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address"><?=$address?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-saved"></i> บันทึก
                                </button>
                                <a href="#" class="btn btn-danger" data-dismiss="modal">
                                    <i class="glyphicon glyphicon-remove-circle"></i> ปิด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form_change_profile').bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                url: '../actionDb/person.php?action=changeProfile',
                data: $('#form_change_profile').serialize(),
                type: 'post',
                dataType: 'json',
                success: function (data, textStatus, xhr) {
                    alert(data.message);
                    if (data.status) {
                        $('#chaneProfileModal').modal('hide');
                        reloadDelay(2);
                    }
                },
                error: function (xhr, status, error) {
                    //notifyShowing('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
                    alert('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
                },
                statusCode: {
                    404: function () {
                        alert("page not found");
                    }
                }
            }).done(function () {
                console.log('requrest http success');
            }).fail(function (jqXHR, textStatus) {
                alert("We could not subscribe you please try again or contact us if the problem persists (" + textStatus + ").");
            });
        });
    });
</script>

