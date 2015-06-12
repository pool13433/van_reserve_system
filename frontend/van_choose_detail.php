
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <ol class="breadcrumb">
            <li><a href="index.php?page=van_search">ค้นหาเส้นทางการเดินรถ</a></li>
            <li ><a href="./index.php?page=van_search_result&go_start=<?= $_GET['go_start'] ?>&go_start_place=<?= $_GET['go_start_place'] ?>&go_end=<?= $_GET['go_end'] ?>&go_end_place=<?= $_GET['go_end_place'] ?>">เลือกรถที่ให้บริการ</a></li>
            <li class="active"><a href="#">เลือกจุดขึ้น-ลง และที่นั่ง</a></li>
        </ol>
    </div>
    <div class="panel-body">
        <?php if (!empty($_GET['van_id'])) { ?>
            <?php $van_id = $_GET['van_id']; ?>
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-4">
                        <?php
                        require_once '../mysql_con/PDOMysql.php';
                        $pdo = new PDOMysql();
                        $pdo->conn = $pdo->open();
                        $sql = 'SELECT * FROM van v ';
                        $sql .= ' LEFT JOIN person p ON p.id = v.v_driver';
                        $sql .= ' LEFT JOIN company c ON c.c_id = v.v_company';
                        $sql .= ' WHERE v_id =:v_id';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute(array(':v_id' => $van_id));
                        $result = $stmt->fetch(PDO::FETCH_OBJ);
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
                                    <td>ชื่อพนักงานขับรถ</td>
                                    <td><?= $result->fname . '   ' . $result->lname ?></td>
                                </tr>
                                <tr>
                                    <td>บริษัท</td>
                                    <td><?= $result->c_name ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">เลือกจุดขึ้นและลง ตารางด้านล่างนี้<i class="glyphicon glyphicon-arrow-down"></i></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul class="list-group" id="areaPlace">
                                            <?php
                                            $sql = 'SELECT vp.vp_id,vp.vp_kilomate,pvp.pvp_name';
                                            $sql .= ' ,(SELECT vs_value FROM van_setting) as price';
                                            $sql .= ' FROM van_place vp ';
                                            $sql .= ' LEFT JOIN province_place pvp ON pvp.pvp_id = vp.pvp_id ';
                                            $sql .= ' WHERE vp.v_id =:van_id';
                                            $stmt = $pdo->conn->prepare($sql);
                                            //echo '<pre> sql ::=='.$sql.'</pre>';
                                            $stmt->execute(array(':van_id' => $van_id));
                                            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($results as $index => $place) {
                                                ?>
                                                <li class="list-group-item">
                                                    <label class="btn btn-info btn-block">
                                                        <input type="checkbox" id="<?= $place->vp_id ?>" 
                                                               name="<?= ($place->price * $place->vp_kilomate) ?>" 
                                                               alt="<?= $place->pvp_name ?>"
                                                               onclick="addPlaceCart(this)"/>
                                                        <?= $place->pvp_name ?><span class="badge alert-danger"><?= ($index + 1) ?></span>
                                                    </label>                                
                                                </li>
                                            <?php } ?>
                                        </ul>
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
                        <button type="button" class="btn btn-primary btn-block btn-lg" onclick="confirmReserveVan()" id="btnReserveVan" disabled>
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
    $(document).ready(function () {
        var van_id = '<?= $van_id ?>';
        setLoadVanChair(van_id);
    });
    function setLoadVanChair(van_id) {
        var arrayChairs = [];
        var arrayPlace = [];
        // Load Chairs
        $.get('../actionDb/van_chair.php?action=getChairsByVanId', {
            id: van_id
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
                            console.log('\n set chair_.v_status::==' + chair_.vc_cusid);
                            var element = '';
                            if (chair_.vc_cusid === '') {
                                element += '<label class="btn btn-primary btn-largn">';
                                element += '<input type="checkbox" name="' + chair_.vc_label + '" value="' + chair_.vc_id + '" onClick="addChairInCart()"> ' + chair_.vc_label;
                                element += '</label>';
                                $(chair).replaceWith(element);
                            } else {
                                $(chair).replaceWith('<button type="button" class="btn btn-danger">จองแล้ว</button>');
                            }
                        }
                    });
                    if (indexX > 0) {
                        $(chair).replaceWith('<button type="button" class="btn btn-default btn-lg"></button>');
                    }
                });
            });
        }, 'json');
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
        arrayPlaceLabel = [];
        arrayPlaceChoose = [];
        var place_choose = $('#areaPlace').find('input[type=checkbox]:checked');
        $.each(place_choose, function (index, checkbox) {
            var checkbox = $(checkbox);
            var objectPlace = {};
            objectPlace.vp_id = checkbox.attr('id'); // van_place
            var price = checkbox.attr('name'); // van_price
            totalPrice = price;
            objectPlace.price = price;
            objectPlace.label = checkbox.attr('alt');
            arrayPlaceLabel.push(objectPlace.label);

            console.log('place ::==' + print_properties_in_object(objectPlace));
            arrayPlaceChoose.push(objectPlace);
        });
        return arrayPlaceChoose;
    }
    function confirmReserveVan() {
        var arrayChair = getChairs();
        if (arrayChair.length > 0) {
            $('#dialog_reserve_van').modal('show');
            $('#road').html('<h3><label class="label label-info">' + arrayPlaceLabel.toString() + '</label></h3>');
            $('#chair').html('<h3><label class="label label-success">' + arrayChairLabel.toString() + '</label></h3>');
            $('#price').html('<h3><label class="label label-primary">' + (totalPrice * arrayChairLabel.length) + '</label></h3>');
        } else {
            alert('กรุณาเลือกที่นั่งบนรถก่อน');
        }
    }
    function saveReserveChairVan() {
        var isConf = confirm('ยืนยันการจองและชำระเงิน');
        if (isConf) {
            $.post('../actionDb/reserve.php?action=create', {
                'jsonListChairs': arrayObjectToJsonString(arrayChairsChoose),
                'jsonListPlaces': arrayObjectToJsonString(arrayPlaceChoose),
                'van_id': '<?= $result->v_id ?>',
                'price': totalPrice,
            }, function (jsonReturn) {
                if (jsonReturn.status) {
                    alert(jsonReturn.message);
                    redirectDelay(jsonReturn.url);
                }
            }, 'json');
            return false;
        }
    }
</script>