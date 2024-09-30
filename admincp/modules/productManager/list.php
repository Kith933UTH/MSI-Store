<?php
include("./config/connect.php");

$maxPerPage = 4;
$currentPage = $_GET["page"];
$_SESSION["page"] = $currentPage;

if (isset($_GET['search']) && $_GET['search'] != "") {
    $searchValue = $_GET['search'];
    $quantity = $mysqli->query("SELECT COUNT(proId) AS quantity FROM product WHERE product.proName LIKE '%" . $searchValue . "%'")->fetch_object()->quantity;
    $pageLength = ceil($quantity / $maxPerPage);
    $startIndex = ($currentPage - 1) * $maxPerPage;
    $sqlPro = "SELECT * FROM product,category WHERE product.categoryId=category.categoryId AND product.proName LIKE '%" . $searchValue . "%' ORDER BY product.proId DESC LIMIT $startIndex, 4";
} else {
    $searchValue = "";
    $quantity = $mysqli->query("SELECT COUNT(proId) AS quantity FROM product")->fetch_object()->quantity;
    $pageLength = ceil($quantity / $maxPerPage);
    $startIndex = ($currentPage - 1) * $maxPerPage;
    $sqlPro = "SELECT * FROM product,category WHERE product.categoryId=category.categoryId ORDER BY product.proId DESC LIMIT $startIndex, 4";
}






$listPro = $mysqli->query($sqlPro);

?>

<div class="content-title">
    <h2>Product list</h2>
    <form class="search-form" method="GET">
        <input type="text" placeholder="Search" name="search-product" required>
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>


<div class="main-content">
    <div class="product-list">
        <div class="product-list-item heading">
            <div>Management</div>
            <div>Show</div>
            <div>Order</div>
            <div>Name</div>
            <div>Category</div>
            <div>Configuration summary</div>
            <div>Image</div>
            <div>Price</div>
            <div>Discount rate</div>
            <div>CPU</div>
            <div>Ram</div>
            <div>Hard drive</div>
            <div>Screen</div>
            <div>Graphic card</div>
            <div>Connector</div>
            <div>Operating system</div>
            <div>Size</div>
            <div>Weight</div>
            <div>Battery</div>
            <div>Cam</div>
            <div>Description</div>
        </div>
        <?php
        if ($listPro->num_rows > 0) {
            $i = 0 + $maxPerPage * ($currentPage - 1);
            while ($row = $listPro->fetch_object()) {
        ?>
                <div class="product-list-item <?php if ($i++ % 2 != 0) {
                                                    echo "mark";
                                                } ?>">

                    <div>
                        <a href="?action=products&query=edit&editId=<?php echo $row->proId ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        |
                        <a class="delete-product-btn" href="modules/productManager/control.php?delete=<?php echo $row->proId ?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <div><a class="checkbox-btn <?php echo $row->proVisible == "1" ? "checked" : "" ?>" href="<?php echo $row->proVisible == "1" ? "modules/productManager/control.php?hide=$row->proId" : "modules/productManager/control.php?show=$row->proId" ?> "><i class="fa-solid fa-check"></i></a></div>
                    <div><?php echo $i ?></div>
                    <div><?php echo $row->proName ?></div>
                    <div><?php echo $row->categoryName ?></div>
                    <div><?php echo $row->proSum ?></div>
                    <div class="img-wrapper">
                        <img class="main-img" width="100px" src="upload/<?php echo $row->proImg ?>">
                        <div class="sub-img-list"><?php
                                                    $images = $mysqli->query("SELECT * FROM image WHERE image.proId = $row->proId");
                                                    while ($image = $images->fetch_object()) { ?>
                                <img width="100px" src="upload/<?php echo $image->image ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div><?php echo $row->proPrice ?></div>
                    <div><?php echo $row->proDiscount ?></div>
                    <div><?php echo $row->proCpu ?></div>
                    <div><?php echo $row->proRam ?></div>
                    <div><?php echo $row->proHardDrive ?></div>
                    <div><?php echo $row->proScreen ?></div>
                    <div><?php echo $row->proGCard ?></div>
                    <div><?php echo $row->proConn ?></div>
                    <div><?php echo $row->proOs ?></div>
                    <div><?php echo $row->proSize ?></div>
                    <div><?php echo $row->proWeight ?></div>
                    <div><?php echo $row->proBattery ?></div>
                    <div><?php echo $row->proCam ?></div>
                    <div><?php echo substr(strip_tags($row->proDesc), 0, 100) . "..." ?></div>
                </div>
            <?php }
        } else { ?>
            <div style="text-align: center;grid-template-columns: 100%;font-weight:600;padding: 20px;font-size: 20px;" class="users-list-item">
                PRODUCT DOES NOT EXIST YET
            </div>
        <?php } ?>
    </div>

    <?php
    if ($listPro->num_rows > 0) {
        include("./modules/productManager/pagination.php");
    }
    ?>
</div>

<script>
    const deleteProductBtn = document.querySelectorAll(".delete-product-btn");
    deleteProductBtn.forEach(btn => {
        btn.onclick = (e) => {
            if (!confirm("Are you sure you want to delete this product?")) {
                e.preventDefault()
            }
        }
    })
</script>