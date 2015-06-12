<?php
require_once '../mysql_con/PDOMysql.php';
$pdo = new PDOMysql();
$pdo->conn = $pdo->open();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <!--        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                    <i class="glyphicon glyphicon-list-alt"></i> ค้นหาเส้นทางเดินรถ
                </h4>-->
        <ol class="breadcrumb">
            <li class="active"><a href="#">ค้นหาเส้นทางการเดินรถ</a></li>
        </ol>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            <form class="form-horizontal" action="index.php" method="get"> 

                <!-- Hidden -->
                <input type="hidden" name="page" value="van_search_result"/>
                <!-- Hidden -->

                <div class="form-group">
                    <label for="province" class="col-sm-2 control-label">จังหวัดเริ่มเดินทาง</label>
                    <div class="col-sm-4">
                        <?php
                        $sql = 'SELECT * ';
                        $sql .= ' FROM province p';
                        $sql .= ' WHERE  EXISTS (SELECT \'x\' FROM province_place pvp WHERE pvp.pv_id = p.pv_id)';
                        $sql .= ' ORDER BY pv_name ASC ';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="go_start" onchange="changeProvinceGo(this, 'go_start_place')">
                            <?php foreach ($provinces as $index => $province) { ?>
                                <?php if ($pv_id == $province->pv_id) { ?>
                                    <option value="<?= $province->pv_id ?>" selected><?= $province->pv_name ?></option>
                                <?php } else { ?>
                                    <option value="<?= $province->pv_id ?>"><?= $province->pv_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province" class="col-sm-2 control-label">สถานที่ในจังหวัด</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="go_start_place" id="go_start_place"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province" class="col-sm-2 control-label">จังหวัดปลายทาง</label>
                    <div class="col-sm-4">
                        <?php
                        $sql = 'SELECT * ';
                        $sql .= ' FROM province p';
                        $sql .= ' WHERE  EXISTS (SELECT \'x\' FROM province_place pvp WHERE pvp.pv_id = p.pv_id)';
                        $sql .= ' ORDER BY pv_name ASC ';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="go_end" onchange="changeProvinceGo(this, 'go_end_place')">
                            <?php foreach ($provinces as $index => $province) { ?>
                                <?php if ($pv_id == $province->pv_id) { ?>
                                    <option value="<?= $province->pv_id ?>" selected><?= $province->pv_name ?></option>
                                <?php } else { ?>
                                    <option value="<?= $province->pv_id ?>"><?= $province->pv_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province" class="col-sm-2 control-label">สังกัดในจังหวัด</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="go_end_place" id="go_end_place"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province" class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">               
                        <button type="submit" class="btn btn-primary">ค้นหาเส้นทางเดินรถ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //var
    });
    function changeProvinceGo(ele_select, child_d) {
        var value = $(ele_select).val();
        $.get('../actionDb/province_place.php?action=getProvincePlaceByProvinceId', {
            province_id: value,
        }, function (json) {
            var children = $('#' + child_d);
            $.each(json, function (index, objPlace) {
                children.append('<option value="' + objPlace.pvp_id + '">' + objPlace.pvp_name + '</option>');
            });
        }, 'json');
    }
</script>