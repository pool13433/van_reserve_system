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