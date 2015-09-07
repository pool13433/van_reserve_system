<?php
/*
 * เงื่อนไขกรณี แก้ไข ข้อมูล
 */
$reserve_step_1 = 'index.php?page=van_search';
$reserve_step_2 = "./index.php?page=van_search_result&go_start=" . $_GET['go_start'] . "&go_start_place=" . $_GET['go_start_place'] . "&go_end=" . $_GET['go_end'] . "&go_end_place=" . $_GET['go_end_place'];
$reserve_step_3 = "javascript:void(0)";
$van_id = $_GET['van_id'];
$province_start_id = $_GET['go_end'];
$place_start_id = $_GET['go_end_place'];
$province_end_id = $_GET['go_end'];
$place_end_id = $_GET['go_end_place'];
$reserve_date = (empty($_GET['reserve_date']) ? date('d/m/Y') : $_GET['reserve_date']);
$van_time_start_time = (empty($_GET['van_time_start']) ? date('h:i') : $_GET['van_time_start']);

if (!empty($_GET['cmd']) && $_GET['cmd'] == 'edit') {
    $reserve_step_1 = "javascript:void(0)";
    $reserve_step_2 = "javascript:void(0)";
}
/*
 * จบ เงื่อนไขกรณี แก้ไข ข้อมูล
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <ol class="breadcrumb">
            <li><a href="<?= $reserve_step_1 ?>">ค้นหาเส้นทางการเดินรถ</a></li>
            <li ><a href="<?= $reserve_step_2 ?>">เลือกรถที่ให้บริการ</a></li>
            <li class="active"><a href="<?= $reserve_step_3 ?>">เลือกจุดขึ้น-ลง และที่นั่ง</a></li>
        </ol>
    </div>
    <div class="panel-body">
        <?php if (!empty($_GET['van_id'])) { ?>
            <?php
            require_once '../mysql_con/PDOMysql.php';
            $pdo = new PDOMysql();
            $pdo->conn = $pdo->open();
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="hidden" name="page" value="van_choose_detail" />
                                    <input type="hidden" name="van_id" value="<?= $van_id ?>" />
                                    <input type="hidden" name="go_start" value="<?= $province_start_id ?>" />
                                    <input type="hidden" name="go_start_place" value="<?=$place_start_id  ?>" />
                                    <input type="hidden" name="go_end" value="<?= $province_end_id ?>" />
                                    <input type="hidden" name="go_end_place" value="<?= $place_end_id ?>" />  
                                    <input type="hidden" name="van_time_id" id="van_time_id"/>  
                                    <input type="hidden" name="van_time_start" id="van_time_start" value="<?= $van_time_start_time ?>"/>

                                    <span class="input-group-addon" for="date-fld">
                                        วันที่ต้องการใช้บริการ
                                    </span>
                                    <input type="text" class="form-control" name="reserve_date" id="reserve_date" value="<?= $reserve_date ?>"/>                                    
                                </div> 
                            </div>
                            <div class="col-sm-7" id="box_van_time">                                
                                <?php
                                $sql_time = "SELECT * FROM van_time WHERE v_id =:van_id";
                                $stmt_time = $pdo->conn->prepare($sql_time);
                                $stmt_time->execute(array(':van_id' => $van_id));
                                $timeArray = $stmt_time->fetchAll(PDO::FETCH_OBJ);
                                foreach ($timeArray as $index => $time) {
                                    ?>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"> 
                                                <input type="radio" name="van_time_start" id="<?= $time->vt_id ?>"
                                                       value="<?= $time->vt_drivestart ?>"  onclick="getRadioVanTimeValueToHiddenInput(this)"
                                                       class="<?= $time->vt_driveend ?>" <?= ($index == 0 ? 'checked' : '') ?>
                                                       <?= ($time->vt_drivestart == $van_time_start_time ? 'checked' : '' ) ?>/>     
                                            </span>
                                            <span class="input-group-addon">     
                                                <span>รถออก</span>
                                            </span>
                                            <input type="text" class="form-control" value="<?= $time->vt_drivestart ?>">
                                            <span class="input-group-addon">     
                                                <span>ถึง</span>
                                            </span>
                                            <input type="text" class="form-control" value="<?= $time->vt_driveend ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-2">
                                <span class="input-group-btn" for="date-fld">
                                    <button type="submit" class="btn btn-primary"> ค้นหาเที่ยวรถ</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-4">
                        <?php
                        $sql = ' SELECT * FROM van v ';
                        $sql .= ' LEFT JOIN company c ON c.c_id = v.v_company';
                        $sql .= ' WHERE v_id =:v_id';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute(array(':v_id' => $van_id));
                        $result = $stmt->fetch(PDO::FETCH_OBJ);


                        $price_kilomate = $pdo->getPriceInKilomate();
                        ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ชื่อสายรถ</th>
                                    <th><?= $result->v_name ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>รายละเอียด</td>
                                    <td><?= $result->v_detail ?></td>
                                </tr>
                                <tr>
                                    <td>บริษัท</td>
                                    <td><?= $result->c_name ?></td>
                                </tr>                                
                                <tr>
                                    <td colspan="2">เลือกจุดขึ้นและลง ตารางด้านล่างนี้<i class="glyphicon glyphicon-arrow-down"></i></td>
                                </tr>
                                <?php
                                $sql = 'SELECT vp.vp_id,vp.vp_kilomate,pvp.pvp_name,vp.vp_hierarchy,';
                                $sql .= ' (SELECT vs_value FROM van_setting) as price';
                                $sql .= ' FROM van_place vp ';
                                $sql .= ' LEFT JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id ';
                                $sql .= ' WHERE vp.v_id =:van_id';
                                $sql .= ' ORDER BY vp.vp_hierarchy ASC';
                                $stmt = $pdo->conn->prepare($sql);
                                //echo '<pre> sql ::=='.$sql.'</pre>';
                                $stmt->execute(array(':van_id' => $van_id));
                                $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                                ?>
                                <tr>
                                    <td>จุดขึ้นรถ</td>
                                    <td>                                        
                                        <select class="form-control" name="place_begin" id="place_begin" onchange="findPlace(this, '<?= PLACE_BEGIN ?>')">
                                            <?php foreach ($results as $index => $place) { ?>
                                                <option value="<?= $place->vp_id ?>" class="<?= $place->price ?>" 
                                                        itemprop="<?= $place->vp_kilomate ?>" title="<?= $place->vp_hierarchy ?>">
                                                            <?= $place->pvp_name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>จุดลงรถ</td>
                                    <td>
                                        <select class="form-control" name="place_end" id="place_end" onchange="findPlace(this, '<?= PLACE_END ?>')">
                                            <?php foreach ($results as $index => $place) { ?>
                                                <option value="<?= $place->vp_id ?>" class="<?= $place->price ?>" 
                                                        itemprop="<?= $place->vp_kilomate ?>" title="<?= $place->vp_hierarchy ?>">
                                                            <?= $place->pvp_name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-sm-8">
                        <div class="col-lg-12 col-lg-offset-0">
                            <?php require './map_chair.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btn-block btn-lg" onclick="confirmReserveVan()" id="btnReserveVan">
                            <i class="glyphicon glyphicon-gift"></i> จองรถ
                        </button>
                    </div>
                </div>
            </div>
            <?php require '../dialog/dialog_reserve_van.php'; ?>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    var arrayPlaceChoose = [];
    var arrayChairsChoose = [];
    var totalPrice = 0;
    var arrayPlaceLabel = [];
    var arrayChairLabel = [];
    var parentChair = $('#areaChair');
    var objectPlace = {};
    $(document).ready(function () {
        var van_id = '<?= $van_id ?>';
        initVanChair(van_id);
        initDatePicker();
        getRadioVanTimeValueToHiddenInput($(':radio[name=van_time_start]'));
    });
    function initDatePicker() {
        //http://www.daterangepicker.com/#ex5
        var datepicker = $('#reserve_date');
        datepicker.prop('readOnly', true);
        datepicker.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'DD/MM/YYYY',
            locale: DATEPICKER_LOCAL,
        }, function (start, end, label) {
            var years = moment().diff(start, 'years');
            //alert("You are " + years + " years old.");
        });
    }
    function initVanChair(van_id) {
        var arrayChairs = [];
        // Load Chairs
        $.get('../actionDb/van_chair.php?action=getChairsByVanId', {
            van_id: van_id,
            van_time_start: $('#van_time_start').val(),
        }, function (jsonChairs) {
            $.each(jsonChairs, function (index, objectChair) {
                arrayChairs.push(objectChair);
            });
            var chidrenChairs = parentChair.find('tr');
            $.each(chidrenChairs, function (indexY, object) {
                var chairs = $(object).find('div.hidden');
                $.each(chairs, function (indexX, chair) {
                    var value = $(chair).val();
                    //console.log('\n indexX ::==' + indexX + ' indexY ::==' + indexY);
                    $.each(arrayChairs, function (index, chair_) {
                        if (chair_.vc_x == indexX && chair_.vc_y == indexY) {
                            //console.log('\n set chair_.v_status::==' + chair_.vc_cusid);
                            var element = '';
                            element += '<span class="btn btn-primary btn-sm" id="' + chair_.vc_id + '">';
                            element += '<input type="checkbox" name="' + chair_.vc_label + '" value="' + chair_.vc_id + '" onClick="addChairInCart()"> ' + chair_.vc_label;
                            element += '</span>';
                            $(chair).replaceWith(element);
                        }
                    });
                    if (indexX > 0) {
                        $(chair).replaceWith('<button type="button" class="btn btn-default btn-lg"></button>');
                    }
                });
            });
            setDisableChairsIsReserve();
        }, 'json');
    }
    function setDisableChairsIsReserve() {
        var arrayChairs = Array();
        $.get('../actionDb/reserve_chair.php?action=getChairsByReserveDate', {
            reserve_date: $('#reserve_date').val(),
        }, function (jsonChairs) {
            $.each(jsonChairs, function (index, objectChair) {
                arrayChairs.push(objectChair);
            });
            var chidrenChairs = parentChair.find('tr');
            $.each(chidrenChairs, function (indexY, object) {
                var chairs = $(object).find('span');
                $.each(chairs, function (indexX, chair) {
                    var value = $(chair).find('input').val();
                    //console.log('\n indexX ::==' + indexX + ' indexY ::==' + indexY);
                    $.each(arrayChairs, function (index, chair_) {
                        if (value == chair_.vc_id) {
                            console.log(' ************* จองแล้ว ************');
                            $(chair).replaceWith('<button type="button" class="btn btn-danger btn-sm">จองแล้ว</button>');
                        }
                    });
                });
            });
        }, 'json');
    }
    function getRadioVanTimeValueToHiddenInput(radio) {
        if ($(radio).is(':checked')) {
            var value = $(radio).attr('id');
            $(':input[name=van_time_id]').val(value);
        } else {
            $(':input[name=van_time_id]').val('');
        }
    }
    function addChairInCart() {
        var arrayChoose = getChairs();
        $('#chair_choose').val(arrayChoose.length);
    }
    function addPlaceCart(chekbox) {
        var arrayChoose = getPlaces();
        if (arrayChoose.length > 2) {
            $(chekbox).prop('checked', false);
            alert('ท่านเลือกสถานที่เกินกำหนด เลือกได้ไม่เกิิน 2 ที่ \n ที่แรกจุดขึ้น และจุดลง รวมเป็น 2 ที่เท่านั้น');
            $('#btnReserveVan').prop('disabled', false);
        } else if (arrayChoose.length === 2) {
            $('#btnReserveVan').prop('disabled', false);
        } else {
            $('#btnReserveVan').prop('disabled', true);
        }
    }
    function getChairs() {
        arrayChairLabel = [];
        arrayChairsChoose = [];
        var child = parentChair.find('input[type=checkbox]:checked');
        $.each(child, function (index, checkbox) {
            var value = $(checkbox).val();
            var label = $(checkbox).attr('name');
            arrayChairLabel.push(label);
            arrayChairsChoose.push({label: label, value: value});
        });
        return arrayChairsChoose;
    }
    function getPlaces() {
        totalPrice = 0;
        var placeDiffKilomate = 0;
        var priceKilomate = <?= $price_kilomate ?>;
        var objectPlace = {};
        var place_begin = $('#place_begin').find(":selected");
        var place_default_begin = $('#place_begin').find('option').eq('0');
        var place_end = $('#place_end').find(":selected");
        var place_default_end = $('#place_end').find('option').last();
        objectPlace.place_begin_id = place_begin.val();
        objectPlace.place_begin_price = place_begin.attr('class');
        objectPlace.place_begin_label = place_begin.text();
        objectPlace.place_begin_kilomate = place_begin.attr('itemprop');
        objectPlace.place_end_id = place_end.val();
        objectPlace.place_end_price = place_end.attr('class');
        objectPlace.place_end_label = place_end.text();
        objectPlace.place_end_kilomate = place_end.attr('itemprop');
        objectPlace.place_default_begin = place_default_begin.text();
        objectPlace.place_default_end = place_default_end.text();
        objectPlace.van_time_begin = $(':radio[name=van_time_start]').val();
        objectPlace.van_time_end = $(':radio[name=van_time_start]').attr('class');
        //console.log(objectPlace);
        /*
         *  cal price 
         */
//        if (objectPlace.place_begin_id > objectPlace.place_end_id) { // แสดงว่า กลับลังลัง รถสายนั่งกลับมา
//            
//        } else {
//            //objectPlace.place_begin_id  objectPlace.place_end_id
//        }
        placeDiffKilomate = objectPlace.place_end_kilomate - objectPlace.place_begin_kilomate;
        totalPrice = parseNegativeIntToPositiveInt(placeDiffKilomate) * priceKilomate;
        //console.log('totalPrice ::==' + totalPrice);
        /*
         *  end cal price
         */
        //console.log('placeDiffKilomate ::==' + parseNegativeIntToPositiveInt(placeDiffKilomate));
        //console.log('print_properties_in_object ::==' + print_properties_in_object(objectPlace));
        return objectPlace;
    }
    function checkRoadInUserChoose(objectPlace) {
        if (objectPlace.place_begin_id < objectPlace.place_end_id) {
            return false;
        } else {
            return true;
        }
    }
    function confirmReserveVan() {
        var arrayChair = getChairs();
        objectPlace = getPlaces();
        var isChoosePlace = checkRoadInUserChoose(objectPlace);
        if (arrayChair.length === 0) {
            alert('กรุณาเลือกที่นั่งบนรถก่อน');
            return false;
        } else if (arrayChair.length > 0 && objectPlace.place_begin_id === objectPlace.place_end_id) {
            alert('กรุณาเลือก สถานที่ ขึ้นรถ - ลงรถคนละที่กันด้วย กรุณาตรวจสอบ');
            return false;
        }
//        else if (arrayChair.length > 0 && objectPlace.place_begin_id !== objectPlace.place_end_id
//                && !isChoosePlace) {
//            alert('ท่านกำลังเลือกสายการเดินทางที่ผิดรูปแบบ \n\
//                \n สายการเดินทางนี้คือการเดินทาง \n\
//                \n จาก ' + objectPlace.place_default_begin + ' \n\
//                เพื่อไป ' + objectPlace.place_default_end + '\n กรุณาตรวจสอบการเลือกเส้นทางอีกครั้ง');
//            return false;
//        } 
        else if (arrayChair.length > 0 && objectPlace.place_begin_id !== objectPlace.place_end_id) { //&& isChoosePlace
            $('#dialog_reserve_van').modal('show');
            $('#road_begin').html('<h3><label class="label label-info">' + objectPlace.place_begin_label + '</label></h3>');
            $('#road_end').html('<h3><label class="label label-info">' + objectPlace.place_end_label + '</label></h3>');
            $('#chair').html('<h3><label class="label label-success">' + arrayChairLabel.toString() + '</label></h3>');
            $('#price').html('<h3><label class="label label-primary">' + (totalPrice * arrayChairLabel.length) + '</label></h3>');
            $('#drive_time_begin').html('<h3><label class="label label-primary">' + objectPlace.van_time_begin + '</label></h3>');
            $('#drive_time_end').html('<h3><label class="label label-primary">' + objectPlace.van_time_end + '</label></h3>');
        }
    }
    function saveReserveChairVan() {
        var isConf = confirm('ยืนยันการจองและชำระเงิน');
        if (isConf) {
            $.post('../actionDb/reserve.php?action=create', {
                'jsonListChairs': arrayObjectToJsonString(arrayChairsChoose),
                //'jsonListPlaces': arrayObjectToJsonString(arrayPlaceChoose),
                'jsonObjectPlace': arrayObjectToJsonString(objectPlace),
                'van_id': '<?= $result->v_id ?>',
                'price': totalPrice,
                'reserve_date': $('#reserve_date').val(),
                'van_time_id': $('#van_time_id').val(),
            }, function (jsonReturn) {
                if (jsonReturn.status) {
                    alert(jsonReturn.message);
                    redirectDelay(jsonReturn.url);
                } else {
                    alert('สถานะการเข้าใช้งานโปรแกรม ' + jsonReturn.message);
                    if (jsonReturn.title == 'session_timeout') {
                        redirectDelay(jsonReturn.url);
                    }
                }
            }, 'json');
            return false;
        }
    }
    function findPlace(eleHierarchy, place_type) {
        var hierarchy = $(eleHierarchy).find('option').filter(":selected").attr('title');
        //console.log('hierarchy ::==' + hierarchy);
        if (hierarchy != '') {
            $.get('../actionDb/van_place.php?action=getPlacesByHierarchy', {
                'van_id': <?= $_GET['van_id'] ?>,
                'place_type': place_type,
                'hierarchy': hierarchy,
            }, function (jsonPlace) {
                var eleCombo;
                if (place_type === '<?= PLACE_BEGIN ?>') {
                    eleCombo = $('#place_end');
                } else if (place_type === '<?= PLACE_END ?>') {
                    eleCombo = $('#place_begin');
                }
                eleCombo.empty();
                $.each(jsonPlace, function (index, place) {
                    eleCombo.append('<option value="' + place.vp_id + '" class="' + place.price + '" itemprop="' + place.vp_kilomate + '" title="' + place.vp_hierarchy + '">' + place.pvp_name + '</option>');
                });
                var optionLength = eleCombo.find('option').length;
                if (optionLength === 0) {
                    alert('ท่านเลือกสถานที่ไม่ถูกต้อง กรุณาตรวจสอบ');
                }
            }, 'json');
        }
    }
</script>
