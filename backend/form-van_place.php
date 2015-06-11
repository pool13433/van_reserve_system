<?php require_once '../mysql_con/PDOMysql.php'; ?>
<?php
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();
$van_place = (empty($_GET['van_place'])) ? '' : $_GET['van_place'];
?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการค่าบริการรถตู้
        </h4>
<!--        <div class="btn-group pull-right">
            <a href="index.php?page=list-province_place" class="btn btn-info">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>-->
    </div>
    <div class="panel-body">    
        <div class="form-group">
            <form class="form-horizontal" action="index.php" method="get">
                <input type="hidden" name="page" value="form-van_place"/>
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn" for="date-fld">
                            <span class="btn btn-default">
                                บริษัทเดินรถ
                            </span>
                        </label>
                        <?php
                        $sql = 'SELECT * FROM van ';
                        $sql .= ' ORDER BY v_id ASC';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $van_places = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="van_place" id="van_place">
                            <?php foreach ($van_places as $index => $place) { ?>
                                <?php if ($van_place == $place->v_id) { ?>
                                    <option value="<?= $place->v_id ?>" selected><?= $place->v_name ?></option>
                                <?php } else { ?>
                                    <option value="<?= $place->v_id ?>"><?= $place->v_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <label class="input-group-btn" for="date-fld">
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-search"></i> ดูเส้นทาง
                            </button>
                        </label>
                    </div>                    
                </div>   
            </form>
        </div>
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ลำดับเส้นทาง</th>
                        <th>ชื่อจุดเส้นทาง</th>
                        <th>ลำดับขั้น</th>
                        <th>ระยะทางจากจุดเริ่มต้นทาง</th>
                    </tr>
                </thead>
                <tbody id="area_van_place">
                    <?php
                    $result = array();
                    if (!empty($van_place)) {
                        $sql = ' SELECT * FROM van v';
                        $sql .= ' LEFT JOIN van_place vp ON vp.v_id = v.v_id';
                        $sql .= ' JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id';
                        $sql .= ' WHERE v.v_id =:van_place';
                        //echo '<pre>sql ::=='.$sql.'</pre>';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute(array(
                            ':van_place' => $van_place,
                        ));
                        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                    }
                    ?>
                    <?php foreach ($result as $key => $value) { ?>
                        <tr>
                            <td style="width: 8%;"><?= ($key + 1) ?></td>                                                    
                            <td><?= $value->pvp_name ?></td>
                            <td style="width: 8%;">
                                <input type="hidden" name="" value="<?= $value->vp_id ?>"/>
                                <input type="text" class="form-control" name="hierarchy" value="<?= $value->vp_hierarchy ?>" />
                            </td>
                            <td style="width: 8%;">
                                <input type="text" class="form-control" name="kilomate" value="<?= $value->vp_kilomate ?>"/>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success" onclick="checkVanPlace()">
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
<script type="text/javascript">
    function changHierarchy(index, type, id) {
        $.get('../actionDb/province_place.php?action=changHierarchy', {
            type: type,
            id: id,
            index: index
        }, function (result) {
            //reloadDelay(1);
        }, 'json');
    }
    function checkVanPlace() {
        var arrayHierarchy = [];
        var arrayObjectHierarchy = [];
        var areaPlace = $('#area_van_place');
        var trAreaPlace = areaPlace.find('tr');
        $.each(trAreaPlace, function (index, object) {
            var td_number = $(object).find('td').eq('0').text();
            var td_name = $(object).find('td').eq('1').text();
            var td_inputHierarchy = $(object).find('td').eq('2').find('input[type=text]').val();
            var td_inputId = $(object).find('td').eq('2').find('input[type=hidden]').val();
            var td_inputKilomate = $(object).find('td').eq('3').find('input[type=text]').val();
            if (td_inputKilomate === '') {
                alert('กรุณากรอกระยะทางให้ครบด้วย');
                return false;
            } else {
                arrayHierarchy.push(parseInt(td_inputHierarchy));
                arrayObjectHierarchy.push({
                    'id': td_inputId,
                    'hierarchy': td_inputHierarchy,
                    'kilomate': td_inputKilomate
                });
            }
        });
        var arrayHierarchyNotDuplicate = find_duplicates(arrayHierarchy);
        if (trAreaPlace.length == arrayHierarchy.length) {
            if (arrayHierarchyNotDuplicate.length === 0) {
                var IsConfirm = confirm('ยืนยันการอัพเดทการจัดการสถานที่ ใช่[OK] || ยกเลิก[Cancle]');
                if (IsConfirm) {
                    saveVanPlace(arrayObjectHierarchy);
                }
            } else {
                // ลำดับขั้น
                alert('ท่านกรอกลำดับสถานที่ไม่ถูกต้องมีตัวเลขซ้ำกัน กรุณาตรวจสอบ');
            }
        } else {
            alert('ท่านกรอกระยะทางไม่ครบ กรุณาตรวจสอบ');
        }
    }
    function saveVanPlace(arrayObjectHierarchy) {
        $.post('../actionDb/van_place.php?action=updateHierarchy', {
            jsonparam: arrayObjectToJsonString(arrayObjectHierarchy),
        }, function (json) {
            if (json.status) {
                alert(json.message);
                reloadDelay(1);
            }
        }, 'json');
    }
</script>