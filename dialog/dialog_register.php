<form class="form-horizontal" id="form_register" name="form_register" 
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ลงทะเบียนเข้าใช้งานระบบ</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">ชื่อเข้าใช้งาน</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="username"
                                       data-bv-message="ชื่อผู้ใช้ไม่ถูกต้อง" placeholder="ชื่อเข้าใช้งาน"
                                       required data-bv-notempty-message="ชื่อผู้ใช้จำเป็นต้องมีและต้องไม่ว่างเปล่า"
                                       pattern="^[a-zA-Z0-9]+$" data-bv-regexp-message="ชื่อผู้ใช้สามารถประกอบด้วยตัวอักษรและตัวเลข"
                                       data-bv-stringlength="true" data-bv-stringlength-min="6" data-bv-stringlength-max="30" data-bv-stringlength-message="ชื่อผู้ใช้ต้องมากกว่า 6 และน้อยกว่า 30 ตัวอักษร"
                                       data-bv-different="true" data-bv-different-field="password" data-bv-different-message="ชื่อผู้ใช้และรหัสผ่านที่ไม่สามารถเป็นเช่นเดียวกับคนอื่น ๆ"/>
                                <!--                                       data-bv-remote="true" data-bv-remote-url="../actionDb/person.php?action=checkUsername" data-bv-remote-message="ชื่อผู้ใช้ที่ไม่สามารถใช้ได้"-->

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">รหัสผ่าน</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน"
                                       required data-bv-notempty-message="รหัสผ่านที่จำเป็นและไม่สามารถเป็นที่ว่างเปล่า"
                                       data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="ใช้รหัสผ่านและยืนยันที่จะไม่เหมือนกัน"
                                       data-bv-different="true" data-bv-different-field="username" data-bv-different-message="รหัสผ่านที่ไม่สามารถเป็นเช่นเดียวกับชื่อผู้ใช้"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">ยืนยันรหัสผ่าน</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="confirmPassword" placeholder="ยืนยันรหัสผ่าน"
                                       required data-bv-notempty-message="ยืนยันรหัสผ่านที่จำเป็นและไม่สามารถเป็นที่ว่างเปล่า"
                                       data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="ใช้รหัสผ่านและยืนยันที่จะไม่เหมือนกัน"
                                       data-bv-different="true" data-bv-different-field="username" data-bv-different-message="รหัสผ่านที่ไม่สามารถเป็นเช่นเดียวกับชื่อผู้ใช้"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">รหัสบัตรประชาชน</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="idcard" placeholder="รหัสบัตรประชาชน" 
                                       required data-bv-notempty-message="กรุณากรอก รหัสบัตรประชาชน" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">ชื่อจริง</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="fname" placeholder="ชื่อจริง" 
                                       required data-bv-notempty-message="กรุณากรอก ชื่อจริง" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">นามสกุล</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="lname" placeholder="นามสกุล" 
                                       required data-bv-notempty-message="กรุณากรอก นามสกุล" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">เบอร์โทรศัพท์</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="mobile" placeholder="เบอร์โทรศัพท์" 
                                       required data-bv-notempty-message="กรุณากรอก เบอร์โทรศัพท์" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-lg-4">อีเมลล์</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="email" placeholder="อีเมลล์" 
                                       required data-bv-notempty-message="กรุณากรอก อีเมลล์" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label class="control-label col-lg-2">ที่อยู่</label>
                            <div class="col-lg-9">
                                <textarea type="text" class="form-control" name="address" placeholder="ที่อยู่" 
                                          required data-bv-notempty-message="กรุณากรอก ที่อยู่" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-saved"></i> สมัครสมาชิก
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove"></i> ปิด
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form_register').bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm('form_register', '../actionDb/person.php?action=register');
        });
    });
</script>

