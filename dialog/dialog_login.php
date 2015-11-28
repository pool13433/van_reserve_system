<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">เข้าระบบ จองรถตู้ออนไลน์</h1>
            </div>
            <div class="modal-body">
                <form id="form_login">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="username"
                               required data-bv-notempty-message="The password is required and cannot be empty"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="password"
                               required data-bv-notempty-message="The password is required and cannot be empty"
                               data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="The password and its confirm are not the same"
                               data-bv-different="true" data-bv-different-field="username" data-bv-different-message="The password cannot be the same as username"/>                        
                    </div>
                    <div class="form-group">
                        <h4><a href="javascript:void(0)" class="pull-right">
                                <i class="glyphicon glyphicon-lock"></i> ลืมรหัสผ่าน
                            </a>
                        </h4>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-lg btn-block">เข้าระบบ</button>     
                            </div>                               
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        
                        <a href="<?php echo $loginUrl; ?>" class="btn btn-primary btn-lg btn-block">ลงชื่อเข้าใช้งานด้วย Facebook ของท่าน</a>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form_login').bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            postForm('form_login', '../actionDb/person.php?action=login');
        });
    });
</script>