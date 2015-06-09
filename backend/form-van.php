<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();

/*
 * สร้างตัวแปรเพื่อเก็บค่า
 */
$v_id = '';
$v_name = '';
$v_detail = '';
$v_company = '';
$v_driver = '';
$v_chair = '0';
$v_drivestart = '';
$v_driveend = '';
$v_updatedate = '';
$v_updateby = '';

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM van WHERE v_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $v_id = $result->v_id;
    $v_name = $result->v_name;
    $v_detail = $result->v_detail;
    $v_company = $result->v_company;
    $v_driver = $result->v_driver;
    $v_chair = $result->v_chair;
    $v_drivestart = $result->v_drivestart;
    $v_driveend = $result->v_driveend;
    $v_updatedate = $result->v_updatedate;
    $v_updateby = $result->v_updateby;
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
                <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการข้อมูลรถให้บริการ
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-van" class="btn btn-info">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div id="error-message-wrapper"> </div>

                <div class="form-group">
                    <label for="v_name" class="col-sm-2 control-label">ชื่อสายรถ</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id" id="id"
                               value="<?= $v_id ?>"/>
                        <input type="text" class="form-control" name="v_name" id="v_name" placeholder="ชื่อสายรถ" 
                               required data-bv-notempty-message="กรุณากรอกชื่อสายรถ" 
                               value="<?= $v_name ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="v_name" class="col-sm-2 control-label">รายละเอียดรถ</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" placeholder="รายละเอียดรถ" name="v_detail"
                                  required data-bv-notempty-message="กรุณากรอกรายละเอียดรถ" ><?= $v_detail ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="v_driver" class="col-sm-2 control-label">พนักงานขับรถ</label>
                    <div class="col-sm-10">
                        <?php
                        $sql = 'SELECT * FROM person WHERE status = ' . DRIVER_ID;
                        $sql .= ' ORDER BY fname ASC';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $drivers = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="v_driver" id="v_driver">
                            <?php foreach ($drivers as $index => $driver) { ?>
                                <?php if ($v_driver == $driver->id) { ?>
                                    <option value="<?= $driver->id ?>" selected><?= $driver->fname ?></option>
                                <?php } else { ?>
                                    <option value="<?= $driver->id ?>"><?= $driver->fname ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="v_place" class="col-sm-2 control-label">รายการเส้นทางการเดินรถ</label>
                    <div class="col-sm-10">
                        <?php
                        $sql = 'SELECT * FROM province ORDER BY pv_name ASC';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                        //var_dump($provinces);
                        ?>
                        <select class="selectpicker form-control btn-info" name="v_place" id="v_place" 
                                multiple style="height: 100px;">
                                    <?php foreach ($provinces as $index => $province) { ?>
                                <optgroup label="<?= $province->pv_name ?>">
                                    <?php
                                    $sql = 'SELECT * FROM province_place WHERE pv_id =:province_id ORDER BY pvp_name ASC';
                                    $stmt = $pdo->conn->prepare($sql);
                                    $stmt->execute(array('province_id' => $province->pv_id));
                                    $provincePlaces = $stmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($provincePlaces as $index => $place) {
                                        ?>
                                        <option value="<?= $place->pvp_id ?>"><?= $place->pvp_name ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="v_company" class="col-sm-2 control-label">บริษัทเดินรถ</label>
                    <div class="col-sm-10">
                        <?php
                        $sql = 'SELECT * FROM company ';
                        $sql .= ' ORDER BY c_id ASC';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $companys = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="v_company" id="v_company">
                            <?php foreach ($companys as $index => $company) { ?>
                                <?php if ($v_company == $company->c_id) { ?>
                                    <option value="<?= $company->c_id ?>" selected><?= $company->c_name ?></option>
                                <?php } else { ?>
                                    <option value="<?= $company->c_id ?>"><?= $company->c_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>   
                <div class="form-group">
                    <label for="v_company" class="col-sm-2 control-label">เวลารถออก</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" placeholder="h:m"  name="drive_start" value="<?=$v_drivestart?>"/>
                    </div>
                    <label for="v_company" class="col-sm-2 control-label">เวลารถถึงที่หมาย</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" placeholder="h:m" name="drive_end" value="<?=$v_driveend?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="v_chair" class="col-sm-2 control-label">สร้างผังที่นั่ง</label>
                    <?php require './map_van_chair.php'; ?>
                </div>
                <div class="form-group">
                    <label for="v_chair" class="col-sm-2 control-label">จำนวนที่นั่ง</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="v_chair" id="v_chair" placeholder="จำนวนที่นั่ง" 
                               required data-bv-notempty-message="กรุณากรอกจำนวนที่นั่ง" readonly
                               value="<?= $v_chair ?>"/>
                    </div>
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
                        <button type="button" class="btn btn-danger" onclick="getFormValue()">
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
        //$('#v_chair').val(0);
        var formId = 'form_province_place';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            /*
             * postForm
             */
            var places = [];
            places = $('.selectpicker').selectpicker('val');
            var v_place = $('#v_place').val();
            if (v_place === null || places.length < 2) {  //ต้องมีตั้งแต่ 2 ขึ้นไป เพราะต้องมี จุดเริ่มและจุด สิ้นสุด                 
                alert('กรุณาเลือกสถานที่ ตั้งแต่ 2 ที่ขึ้นไปด้วย ระบบไม่ให้เลือกแค่ 1 สถานที่ กรุณาตรวจสอบ');
            } else {
                var arrayChair = [];
                arrayChair = getChair().length;
                //console.log('arrayChair ::==' + arrayChair);
                if (arrayChair === 0) {
                    alert('กรุณาสร้างที่นั่ง ตั้งแต่ 1 ที่นั่งขึ้นไป กรุณาตรวจสอบ');
                } else {
                    var isConfirm = confirm('ยืนยันการบันทึกการจัดการสายเดินทางรถ ใช่[OK] || ยกเลิก[Cancle]');
                    if (isConfirm) {
                        $.ajax({
                            'url': '../actionDb/van.php?action=create',
                            dataType: 'json',
                            data: {
                                'jsonParameter': arrayObjectToJsonString(getFormValue()),
                            },
                            type: 'post',
                            success: function (jsonReturn) {
                                console.log('jsonReturn ::==' + jsonReturn);
                                if (jsonReturn.status) {
                                    alert(jsonReturn.message);
                                    redirectDelay(jsonReturn.url, 1);
                                }
                            },
                        });
                        return false;
                    }
                }
            }
        });

        /*
         * http://www.jqueryrain.com/?pYw7weSs
         */
        $('.selectpicker').selectpicker({
            style: 'btn-info'
        });
        if ($('#id').val() !== '') {
            setLoadVanForm();
        }
    });
    function getFormValue() {
        var places = $('.selectpicker').selectpicker('val');
        var van_id = $('#id').val();
        var name = $('#v_name').val();
        var driver = $('#v_driver').val();
        var drive_start = $('input[name=drive_start]').val();
        var drive_end = $('input[name=drive_end]').val();
        var detail = $('textarea[name=v_detail]').val();
        //console.log('drive ::=='+driver);
        //var place = $('#v_place').val();
        var company = $('#v_company').val();
        var chair = $('#v_chair').val();
        //console.log('places ::==' + places);
        var obj = new Object();
        obj.van_id = van_id;
        obj.name = name;
        obj.places = places;
        obj.drive_start = drive_start;
        obj.drive_end = drive_end;
        obj.driver = driver;
        obj.detail = detail;
        obj.company = company;
        obj.chair = chair;
        obj.arrayChairs = getChair();
        //console.log('print_properties_in_object(obj); ::=='+print_properties_in_object(obj));
        return obj;// "{'name' : " + name + ",'places' : " + places + ",'drive':" + drive + ",'company':" + company + ",'chair':" + chair + " }";
    }
    function getChair() {
        var arrayChairs = [];
        var parentChair = $('#areaChair');
        var chidrenChairs = parentChair.find('tr');
        $.each(chidrenChairs, function (indexY, object) {
            var chairs = $(object).find('input');
            var div_col2s = $(object).find('div.col-lg-2'); // div class="col-lg-2"
            var chairY_index = chairs.index();
            //console.log('chairY_index ::==' + chairY_index);
            console.log('div_col2s ::==' + div_col2s.length);
            $.each(div_col2s, function (indexX, obj_div) {
                var chair = $(obj_div).find('input');
                var is_input = chair.is('input');
                console.log('is_input ::==' + is_input);
                if (is_input) {
                    var value = chair.val();
                    arrayChairs.push({'chair_x': indexX, 'chair_y': indexY, 'value': value});
                }
            });
//            $.each(chairs, function (indexX, chair) {
//                var value = $(chair).val();                
//                console.log('value ' + indexX + ' ::==' + value);
//                arrayChairs.push({'chair_x': indexX, 'chair_y': indexY, 'value': value});
//            });
//                var input1= $(object).find('input').eq('0').val();
//                var input2= $(object).find('input').eq('1').val();
//                var input3= $(object).find('input').eq('2').val();
            //console.log('input1 ::=='+input1+' input2 ::=='+input2+' input3 ::=='+input3);            
        });
        //console.log('arrayChairs ::' + print_properties_in_object(arrayChairs[4]));
        return arrayChairs;
    }
    function replaceInput(button) {
        $(button).replaceWith('<input type="text" class="form-control" name=""/>');
        var countInput = $('#areaChair').find('input[type=text]').length;
        $('#v_chair').val(countInput);
    }
    function reStartInput() {
        $('#v_chair').val(0);
        var chairs = $('#areaChair').find('tr');
        $.each(chairs, function (indexTr, objectTr) {
            var chairTrs = $(objectTr).find('input[type=text]');
            $.each(chairTrs, function (indexTd, objectTd) {
                $(objectTd).replaceWith('<button type="button" class="btn btn-primary btn-lg" onclick="replaceInput(this)"><i class="glyphicon glyphicon-plus-sign"></i></button>');
            });
        });
    }
    function setLoadVanForm() {
        var arrayChairs = [];
        var arrayPlace = [];
        var id = $('#id').val();
        // Load Chairs
        $.get('../actionDb/van_chair.php?action=getChairsByVanId', {
            id: id
        }, function (jsonChairs) {
            $.each(jsonChairs, function (index, objectChair) {
                arrayChairs.push(objectChair);
            });

            var parentChair = $('#areaChair');
            var chidrenChairs = parentChair.find('tr');
            $.each(chidrenChairs, function (indexY, object) {
                var chairs = $(object).find('button');
                $.each(chairs, function (indexX, chair) {
                    var value = $(chair).val();
                    //console.log('\n indexX ::==' + indexX + ' indexY ::==' + indexY);
                    $.each(arrayChairs, function (index, chair_) {
                        if (chair_.vc_x == indexX && chair_.vc_y == indexY) {
                            console.log('\n set value ');
                            $(chair).replaceWith('<input type="text" class="form-control" name="" value="' + chair_.vc_label + '"/>');
                        }
                    });
                });
            });
        }, 'json');

        //Load Place
        $.get('../actionDb/van_place.php?action=getPlacesByVanId', {
            id: id
        }, function (jsonChairs) {
            $.each(jsonChairs, function (index, objectChair) {
                arrayPlace.push(objectChair.pvp_id);
            });
            $('.selectpicker').selectpicker('val', arrayPlace);
        }, 'json');

        //http://www.jqueryrain.com/?B83aD_dg
    }
</script>