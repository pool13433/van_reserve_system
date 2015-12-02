<?php require_once '../actionDb/variableGlobal.php'; ?>
<?php require_once '../mysql_con/PDOMysql.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> กรองเงื่อนไขการออกรายงานเพิ่มเติมก่อนการออกรายงาน กรณีออกรายงาน xxx
        </h4>
        <div class="btn-group pull-right"></div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="pdf/pdf_payment.php" method="get" target="_blank">
<!--            <div class="form-group">
                <label for="person_char" class="col-sm-2 control-label">สถานะการชำระเงิน</label>
                <div class="col-sm-2">
                    <?php $listPaymentStatus = arrayPaymentStatus() ?>
                    <select class="form-control" name="status">
                        <?php foreach ($listPaymentStatus as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value['NAME'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>-->

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