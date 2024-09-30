<?php
include("config/connect.php");
$sql = "SELECT * FROM category ORDER BY categoryOrder ASC";
$cateList = $mysqli->query($sql);
?>

<h2 class="content-title">Add a product</h2>

<div class="main-content">
    <form method="POST" class="product-form" action="modules/productManager/control.php" enctype="multipart/form-data">
        <div class="form-item-wrapper">
            <div class="form-item">
                <label for="">Product name: </label>
                <input type="text" name="proName" required>
            </div>

            <div class="form-item">
                <label for="">Category</label>
                <select type="text" name="proCate" required>
                    <?php
                    while ($row = $cateList->fetch_object()) {
                    ?>
                        <option value="<?php echo $row->categoryId ?>"> <?php echo $row->categoryName ?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-item">
                <label for="">Configuration summary: </label>
                <input type="text" name="proSum" required>
            </div>

            <div class="form-item">
                <label for="">Price (VND): </label>
                <input type="number" name="proPrice" required>
            </div>

            <div class="form-item">
                <label for="">Discount rate (0 -> 100): </label>
                <input type="number" name="proDiscount" required>
            </div>

            <div class="form-item">
                <label for="">Cpu</label>
                <input type="text" name="proCpu" required>
            </div>

            <div class="form-item">
                <label for="">Ram</label>
                <input type="text" name="proRam" required>
            </div>

            <div class="form-item">
                <label for="">Hard drive</label>
                <input type="text" name="proHardDrive" required>
            </div>

            <div class="form-item">
                <label for="">Screen</label>
                <input type="text" name="proScreen" required>
            </div>

            <div class="form-item">
                <label for="">Graphic card</label>
                <input type="text" name="proGCard" required>
            </div>

            <div class="form-item">
                <label for="">Connector</label>
                <input type="text" name="proConn" required>
            </div>

            <div class="form-item">
                <label for="">Operating system</label>
                <input type="text" name="proOs" required>
            </div>

            <div class="form-item">
                <label for="">Size</label>
                <input type="text" name="proSize" required>
            </div>

            <div class="form-item">
                <label for="">Weight</label>
                <input type="text" name="proWeight" required>
            </div>

            <div class="form-item">
                <label for="">Battery</label>
                <input type="text" name="proBattery" required>
            </div>

            <div class="form-item">
                <label for="">Web cam </label>
                <input type="text" name="proCam" required>
            </div>

            <div class="form-item">
                <label for="">Main image</label>
                <label class="choose-img-btn" for="input-product-main-img">Choose image</label>
                <input id="input-product-main-img" type="file" name="proImg" accept="image/*" required>
                <div id="input-product-main-img-tmp"></div>
            </div>

            <div class="form-item">
                <label for="">Image (multiple)</label>
                <label class="choose-img-btn" for="input-product-img">Choose image</label>
                <input id="input-product-img" type="file" name="proImgs[]" accept="image/*" multiple required>
                <div id="input-product-img-tmp"></div>
            </div>

            <div class="form-item text-area">
                <label for="">DETAIL DESCRIPTION: </label>
                <textarea type="text" name="proDesc" cols="100%" rows="10" required></textarea>
            </div>
        </div>
        <button type="submit" name="insert">Submit</button>
    </form>
</div>