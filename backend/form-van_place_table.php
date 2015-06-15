<style type="text/css">
    .box{        
        max-height: 50px;
        max-width: 50px;
        display:inline-block;
        //width:3.333333%; /* 100% divided by 30 divs */
        margin-left:-3px;
    }
    .input_primary {
        //color: rgb(255, 255, 255);
        //background-color: rgb(50, 118, 177);
        border-color: rgb(40, 94, 142);
    }
    .input_success {
        //color: rgb(255, 255, 255);
        //background-color: rgb(92, 184, 92);
        border-color: rgb(76, 174, 76);
    }
    .input_info {
        //color: rgb(255, 255, 255);
        //background-color: rgb(57, 179, 215);
        border-color: rgb(38, 154, 188);
    }
    .input_warning {
        //color: rgb(255, 255, 255);
        //background-color: rgb(240, 173, 78);
        border-color: rgb(238, 162, 54);
    }
    .input_danger {
        //color: rgb(255, 255, 255);
        //background-color: rgb(217, 83, 79);
        border-color: rgb(212, 63, 58);
    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-list-alt"></i> ฟอร์มจัดการค่าบริการรถตู้
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=list-province_place" class="btn btn-info">
                <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <div class="panel-body">        
        <div class="form-group">
            <div class="col-md-offset-0">                
                <button type="button" class="btn btn-primary" onclick="addRowBox()">
                    <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มสถานที่
                </button>
            </div>
        </div>
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody id="area_van_place">
                    <tr>
                        <td>
                            <div class="box"><input type="text" class="form-control input_success input-sm"/></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-saved"></i> บันทึก
                    </button>
                    <button type="button" class="btn btn-danger" onclick="clearChildren()">
                        <i class="glyphicon glyphicon-erase"></i> ล้างค่า
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var parent = $('#area_van_place');
    var indexRow = parent.find('tr').length;
    console.log('indexRow ::==' + indexRow);
    function addRowBox() {
        console.log('indexRow ::==' + indexRow);
        indexRow++;
        var html = '';
        html += ' <tr>';
        html += ' <td>';
        html += ' <div class="input-group input-group-sm">';
        for (var i = 0; i < indexRow; i++) {
            if (i == indexRow - 1) {
                html += ' <div class="box"><input type="text" class="form-control input_success input-sm"/></div>';
            } else {
                html += ' <div class="box"><input type="text" class="form-control input_info input-sm"/></div>';
            }
        }
//        html += ' <div class="box"><button type="submit" class="btn btn-success btn-sm">';
//        html += ' <i class="glyphicon glyphicon-plus"></i>';
//        html += ' </button></div>';        
        html += ' </div>';
        html += ' </td>';
        html += ' </tr>';
        parent.append(html);
        return html;
    }
    function clearChildren() {
        parent.find('tr').not(0).remove();
        indexRow = parent.find('tr').length;
    }
</script>