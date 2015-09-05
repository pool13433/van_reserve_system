<?php require_once '../actionDb/variableGlobal.php'; ?>
<?php require_once '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> กรองเงื่อนไขการออกรายงานเพิ่มเติมก่อนการออกรายงาน กรณีออกรายงาน ข้อมูลการจองรถ
        </h4>
        <div class="btn-group pull-right"></div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="pdf/pdf_reserve.php" method="get" target="_blank">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">วันที่สั่งจอง</label>
                <div class="col-sm-6">
                    <div class="input-group">        
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i> ตั้งแต่ - สิ้นสุด</span>
                        <input type="text" class="form-control" name="reserve_date" id="reserve_date"/>
                        <input type="hidden" name="reserve_date_begin" id="reserve_date_begin"/>
                        <input type="hidden" name="reserve_date_end" id="reserve_date_end"/>
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <label for="person_char" class="col-sm-2 control-label">จุดขึ้น-ลง</label>
                <div class="col-sm-8">
                    <div class="input-group">        
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i> จุดขึ้น</span>
                        <select class="form-control" name="place_begin" id="place_begin">
                            <option value="">-- เลือก --</option>
                            <?php
                            $pdo = new PDOMysql();
                            $pdo->conn = $pdo->open();
                            $stmt = $pdo->conn->prepare('SELECT * FROM province ORDER BY pv_name ASC');
                            $stmt->execute();
                            $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                            foreach ($provinces as $index => $objProvince) {
                                ?>
                                <optgroup label="<?= $objProvince->pv_name ?>">
                                    <?php
                                    $pdo = new PDOMysql();
                                    $pdo->conn = $pdo->open();
                                    $stmt = $pdo->conn->prepare('SELECT * FROM province_place WHERE pv_id =:id');
                                    $stmt->execute(array(
                                        ':id' => $objProvince->pv_id
                                    ));
                                    $provincePlaces = $stmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($provincePlaces as $index => $objPlace) {
                                        ?>
                                        <option value="<?= $objPlace->pvp_id ?>"><?= $objPlace->pvp_name ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i> จุดลง</span>
                        <select class="form-control" name="place_end" id="place_end">
                            <option value="">-- เลือก --</option>
                            <?php
                            $pdo = new PDOMysql();
                            $pdo->conn = $pdo->open();
                            $stmt = $pdo->conn->prepare('SELECT * FROM province ORDER BY pv_name ASC');
                            $stmt->execute();
                            $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
                            foreach ($provinces as $index => $objProvince) {
                                ?>
                                <optgroup label="<?= $objProvince->pv_name ?>">
                                    <?php
                                    $pdo = new PDOMysql();
                                    $pdo->conn = $pdo->open();
                                    $stmt = $pdo->conn->prepare('SELECT * FROM province_place WHERE pv_id =:id');
                                    $stmt->execute(array(
                                        ':id' => $objProvince->pv_id
                                    ));
                                    $provincePlaces = $stmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($provincePlaces as $index => $objPlace) {
                                        ?>
                                        <option value="<?= $objPlace->pvp_id ?>"><?= $objPlace->pvp_name ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-print"></i> ออกรายงานทันที
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        initDateRangPicker();
    });
    function initDateRangPicker() {
        //http://www.daterangepicker.com/#ex5
        /*
         *  DatePickerRang 1
         */
        var datepicker = $('#reserve_date');
        datepicker.prop('readOnly', true);
        datepicker.daterangepicker({
            showDropdowns: true,
            format: 'DD/MM/YYYY',
            locale: DATEPICKER_LOCAL,
        }, function (start, end, label) {
            $('#reserve_date_begin').val(start.format('YYYY-MM-DD'));
            $('#reserve_date_end').val(end.format('YYYY-MM-DD'));
        });
        datepicker.val('');
        datepicker.on('cancel.daterangepicker', function (ev, picker) {
            //do something, like clearing an input
            $('#reserve_date_begin').val('');
            $('#reserve_date_end').val('');
        });
    }
</script>