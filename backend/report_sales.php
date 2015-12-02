<?php require_once '../actionDb/variableGlobal.php'; ?>
<?php require_once '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> กรองเงื่อนไขการออกรายงานเพิ่มเติมก่อนการออกรายงาน กรณีออกรายงานยอดขาย
        </h4>
        <div class="btn-group pull-right"></div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="pdf/pdf_sales.php" method="get" target="_blank">
          <div class="form-group">
                <label for="person_char" class="col-sm-2 control-label">ปี</label>
                <div class="col-sm-2">
                    <?php $listYears = arrayYear(15) ?>
                    <select class="form-control" name="year">
                        <?php foreach ($listYears as $key => $value) { ?>
                                <option value="<?= $value['BC'] ?>"><?= $value['AD'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label for="person_char" class="col-sm-2 control-label">เดือน</label>
                <div class="col-sm-2">
                    <select class="form-control" name="month">
                        <?php foreach ($thai_month_arr as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
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