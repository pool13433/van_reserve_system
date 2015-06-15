<div class="input-group">
    <label class="input-group-btn" for="date-fld">
        <span class="btn btn-default">
            เส้นทางจาก
        </span>
    </label>
    <!-- -->
    <?php
    $stmt = $pdo->conn->prepare('SELECT * FROM province ORDER BY pv_name ASC');
    $stmt->execute();
    $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
    ?>
    <select class="form-control" name="province_start">
        <?php foreach ($provinces as $index => $province) { ?>
            <?php if ($province_start == $province->pv_id) { ?>
                <option value="<?= $province->pv_id ?>" selected><?= $province->pv_name ?></option>
            <?php } else { ?>
                <option value="<?= $province->pv_id ?>"><?= $province->pv_name ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <!-- -->
    <label class="input-group-btn" for="date-fld">
        <span class="btn btn-default">
            ถึงเส้นทาง
        </span>
    </label>
    <!-- -->
    <?php
    $stmt = $pdo->conn->prepare('SELECT * FROM province ORDER BY pv_name ASC');
    $stmt->execute();
    $provinces = $stmt->fetchAll(PDO::FETCH_OBJ);
    ?>
    <select class="form-control" name="province_end">
        <?php foreach ($provinces as $index => $province) { ?>
            <?php if ($province_end == $province->pv_id) { ?>
                <option value="<?= $province->pv_id ?>" selected><?= $province->pv_name ?></option>
            <?php } else { ?>
                <option value="<?= $province->pv_id ?>"><?= $province->pv_name ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <!-- -->
    <label class="input-group-btn" for="date-fld">
        <button type="submit" class="btn btn-primary">
            <i class="glyphicon glyphicon-search"></i> ดูเส้นทาง
        </button>
    </label>
</div>


<!--- ฟอร์มเลือกสถานที่ในจังหวัด van_choose_detail.php---> 

<!--                                <tr>
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
                                </tr>-->