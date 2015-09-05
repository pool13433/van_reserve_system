<?php require_once '../actionDb/variableGlobal.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> กรองเงื่อนไขการออกรายงานเพิ่มเติมก่อนการออกรายงาน กรณีออกรายงาน ผู้ใช้งานในระบบ
        </h4>
        <div class="btn-group pull-right">

        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="pdf/pdf_person.php" method="get" target="_blank">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ประเภทของผู้ใช้งาน</label>
                <div class="col-sm-6">
                    <select class="form-control" name="person_status">
                        <option value="">-- ทั้งหมด -- </option>
                        <?php $personStatus = arrayPersonStatus() ?>
                        <?php foreach ($personStatus as $index => $value) { ?>
                            <option value="<?=$index?>"><?=$value['NAME']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="person_char" class="col-sm-2 control-label">คำ/ตัวอักษรในชื่อ หรือ สกุล</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="person_char" name="person_char">
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