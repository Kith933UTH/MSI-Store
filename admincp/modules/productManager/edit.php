<?php
include("config/connect.php");
$editId = $_GET["editId"];
$sql = "SELECT * FROM product WHERE proId = $editId LIMIT 1";
$pro = $mysqli->query($sql)->fetch_object();
?>

<h2 class="content-title">Edit product information</h2>

<div class="main-content">
    <form method="POST" class="product-form" action="modules/productManager/control.php" enctype="multipart/form-data">
        <div class="form-item-wrapper">
            <div class="form-item">
                <label for="">Product name </label>
                <input type="text" name="proName" value="<?php echo $pro->proName ?>" required>
            </div>

            <div class="form-item">
                <label for="">Category </label>
                <select type="text" name="proCate" required>
                    <?php
                    $sqlCate = "SELECT * FROM category ORDER BY categoryOrder ASC";
                    $cateList = $mysqli->query($sqlCate);
                    while ($row = $cateList->fetch_object()) {
                    ?>
                        <option <?php if ($pro->categoryId == $row->categoryId) {
                                    echo 'selected';
                                } ?> value="<?php echo $row->categoryId ?>"> <?php echo $row->categoryName ?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-item">
                <label for="">Configuration summary </label>
                <input type="text" name="proSum" value="<?php echo $pro->proSum ?>" required>
            </div>

            <div class="form-item">
                <label for="">Price(VND) </label>
                <input type="number" name="proPrice" value="<?php echo $pro->proPrice ?>" required>
            </div>

            <div class="form-item">
                <label for="">Discount rate (0 -> 100) </label>
                <input type="number" name="proDiscount" value="<?php echo $pro->proDiscount ?>" required>
            </div>

            <div class="form-item">
                <label for="">Cpu</label>
                <input type="text" name="proCpu" value="<?php echo $pro->proCpu ?>" required>
            </div>

            <div class="form-item">
                <label for="">Ram</label>
                <input type="text" name="proRam" value="<?php echo $pro->proRam ?>" required>
            </div>

            <div class="form-item">
                <label for="">Hard drive</label>
                <input type="text" name="proHardDrive" value="<?php echo $pro->proHardDrive ?>" required>
            </div>

            <div class="form-item">
                <label for="">Screen</label>
                <input type="text" name="proScreen" value="<?php echo $pro->proScreen ?>" required>
            </div>

            <div class="form-item">
                <label for="">Graphic card</label>
                <input type="text" name="proGCard" value="<?php echo $pro->proGCard ?>" required>
            </div>

            <div class="form-item">
                <label for="">Connector</label>
                <input type="text" name="proConn" value="<?php echo $pro->proConn ?>" required>
            </div>

            <div class="form-item">
                <label for="">Operating system</label>
                <input type="text" name="proOs" value="<?php echo $pro->proOs ?>" required>
            </div>

            <div class="form-item">
                <label for="">Size</label>
                <input type="text" name="proSize" value="<?php echo $pro->proSize ?>" required>
            </div>

            <div class="form-item">
                <label for="">Weight</label>
                <input type="text" name="proWeight" value="<?php echo $pro->proWeight ?>" required>
            </div>

            <div class="form-item">
                <label for="">Battery</label>
                <input type="text" name="proBattery" value="<?php echo $pro->proBattery ?>" required>
            </div>

            <div class="form-item">
                <label for="">Webcam</label>
                <input type="text" name="proCam" value="<?php echo $pro->proCam ?>" required>
            </div>

            <div class="form-item">
                <label for="">Main image</label>
                <label class="choose-img-btn" for="input-product-main-img">Choose image</label>
                <input id="input-product-main-img" type="file" name="proImg" accept="image/*">
                <div id="input-product-main-img-tmp">
                    <img src="upload/<?php echo $pro->proImg ?>">
                </div>
            </div>

            <div class="form-item">
                <label for="">Image (multiple) </label>
                <label class="choose-img-btn" for="input-product-img">Choose image</label>
                <input id="input-product-img" type="file" name="proImgs[]" accept="image/*" multiple>
                <div id="input-product-img-tmp">
                    <?php
                    $images = $mysqli->query("SELECT * FROM image WHERE image.proId = $editId");
                    while ($image = $images->fetch_object()) { ?>
                        <img src="upload/<?php echo $image->image ?>">
                    <?php } ?>
                </div>
            </div>

            <div class="form-item text-area">
                <label for="">DETAIL DESCRIPTION: </label>
                <textarea type="text" name="proDesc" cols="100%" rows="10" required><?php echo $pro->proDesc ?></textarea>
            </div>
        </div>
        <button type="submit" name="edit" value="<?php echo $editId ?>">Submit</button>
    </form>
</div>