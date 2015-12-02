<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">เข้าระบบ จองรถตู้ออนไลน์</h1>
            </div>
            <div class="modal-body">
                <form id="form_login" class="form-horizontal">
                    <div class="form-group">
                        <labal class="col-lg-3 control-label">Username</labal>
                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" name="username" placeholder="username"
                                   required data-bv-notempty-message="กรุณากรอก username ด้วยนะจร้า"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <labal class="col-lg-3 control-label">Username</labal>
                        <div class="col-lg-6">
                            <input type="password" class="form-control input-sm" name="password" placeholder="password"
                                   required data-bv-notempty-message="กรุณากรอก password ด้วยนะจร้า"
                                   data-bv-identical="true" data-bv-identical-field="confirmPassword" data-bv-identical-message="The password and its confirm are not the same"
                                   data-bv-different="true" data-bv-different-field="username" data-bv-different-message="The password cannot be the same as username"/>                        
                        </div>
                        <span class="col-lg-3">
                            <a href="javascript:void(0)" class="pull-right">
                                <i class="glyphicon glyphicon-lock"></i> ลืมรหัสผ่าน
                            </a>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block"><i class="glyphicon glyphicon-log-in"></i> เข้าระบบ</button>     
                            </div>                               
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="height: 2px; background-color: black; text-align: center">
                                    <span style="background-color: white; position: relative; top: -0.5em;">
                                        หรือ
                                    </span>
                                </div>           
                            </div>                 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?php echo $loginUrl; ?>" class="btn btn-primary btn-block">
                                    <i class="glyphicon glyphicon-user"></i> ลงชื่อเข้าใช้งานด้วย Facebook ของท่าน
                                </a> 
                            </div>
                        </div>
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