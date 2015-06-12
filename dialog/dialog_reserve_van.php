<!-- Modal -->
<div class="modal fade" id="dialog_reserve_van" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">หน้าจอรายละเอียดการจองที่นั่ง</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 30%">ชื่อสายรถ</th>
                            <th><h3><label class="label label-success"><?= $result->v_name ?></label></h3></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h2>เส้นทาง</h2></td>
                            <td id="road"></td>
                        </tr>
                        <tr>
                            <td><h2>ที่นั่ง</h2></td>
                            <td id="chair"></td>
                        </tr>
                        <tr>
                            <td><h2>ราคารวม</h2></td>
                            <td id="price"></td>
                        </tr>
                        <tr>
                            <td><h2>เวลาออก</h2></td>
                            <td><h3><label class="label label-info"><?= $result->v_drivestart ?></label></h3></td>
                        </tr>
                        <tr>
                            <td><h2>เวลาถึง</h2></td>
                            <td><h3><label class="label label-info"><?= $result->v_driveend ?></label></h3></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveReserveChairVan()">
                    <i class="glyphicon glyphicon-save"></i> ยืนยันการจอง
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>
</div>