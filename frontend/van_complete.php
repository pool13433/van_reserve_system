<div class="panel panel-primary">
    <div class="panel-heading">
        <!--        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                    <i class="glyphicon glyphicon-list-alt"></i> ค้นหาเส้นทางเดินรถ
                </h4>-->
        <ol class="breadcrumb">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0)">ค้นหาเส้นทางการเดินรถ</a></li>
                <li ><a href="javascript:void(0)">เลือกรถที่ให้บริการ</a></li>
                <li><a href="javascript:void(0)">เลือกจุดขึ้น-ลง และที่นั่ง</a></li>
                <li class="active"><a href="#">เสร็จสิ้นการจองรถ</a></li>
            </ol>
        </ol>
    </div>
    <div class="panel-body">
        <h1>เสร็จสิ้นการจองรถ</h1>
        <p>กรุณาชำระเงินภายในระยะเวลาที่กำหนดไม่เช่นนั้นระบบจะถือว่าท่านยกเลิกการเดินทาง</p>
    </div>
    <div class="panel-footer">
        <a href="#" class="btn btn-primary" onclick="printInvoice()">
            <i class="glyphicon glyphicon-print"></i> ปริ้นใบจ่ายเงินเลย            
        </a>
        <script type="text/javascript">
            function printInvoice() {
//                var news_group = $('#group_id').val();
//                var news_status = $('#news_status').val();
//                var startdate = $('#startdate').val();
//                var enddate = $('#enddate').val();
                var url = 'http://localhost/van/report/invoice.php';
//                url += '&news_status=' + news_status;
//                url += '&startdate=' + startdate;
//                url += '&enddate=' + enddate;
                popupWindown(url, 75);
            }
        </script>
    </div>
</div>
