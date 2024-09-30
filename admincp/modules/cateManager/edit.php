<?php
include("config/connect.php");
$editId = $_GET["editId"];
$sql = "SELECT categoryName, categoryOrder FROM category WHERE categoryId = $editId LIMIT 1";
$cate = $mysqli->query($sql)->fetch_object();
?>

<h2 class="content-title">Edit category</h2>

<div class="main-content">
    <form method="POST" name="insert" action="modules/cateManager/control.php">
        <div class="form-item">
            <label for="">Category name: </label>
            <input type="text" name="cateName" value="<?php echo $cate->categoryName ?>" required>
        </div>

        <div class="form-item">
            <label for="">Category order: </label>
            <input type="number" name="cateOrder" value="<?php echo $cate->categoryOrder ?>" required>
        </div>
        <button type="submit" name="edit" value="<?php echo $editId ?>">Submit</button>
    </form>
</div>