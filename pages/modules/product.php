<?php
$_SESSION['previous-page'] = "" . $_SERVER["HTTP_REFERER"];
if (isset($_GET["product"])) {
    $product = $_GET["product"];
}

$pro = $mysqli->query("SELECT * FROM product WHERE proId = $product LIMIT 1")->fetch_object();
$imgs = $mysqli->query("SELECT * FROM image WHERE proId = $product");
$cate = $mysqli->query("SELECT * FROM category WHERE categoryId = $pro->categoryId LIMIT 1")->fetch_object();

$fullQuantity = false;

if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $cartItem) {
        if ($cartItem->proId == $pro->proId && $cartItem->proQuantity >= 5) {
            $fullQuantity = true;
            break;
        }
    }
}
?>


<div class="main-content">
    <div class="path">
        <a href="index.php">Home</a>
        <span> / </span>
        <a href="index.php?category=<?php echo $cate->categoryId ?>"><?php echo $cate->categoryName ?></a>
        <span> / </span>
        <span class="current">
            <?php echo $pro->proName ?>
        </span>
    </div>
    <div class="detail-content">
        <div class="product-img">
            <div class="product-img-main-wrapper" id="product-img-main-wrapper">
                <!-- <img class="product-img-main" /> -->
                <div class="product-img">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="./admincp/upload/<?php echo $pro->proImg ?>" alt="" class="product-img-item" />
                        </div>
                        <?php
                        while ($img = $imgs->fetch_object()) {
                        ?>
                            <div class="item">
                                <img src="./admincp/upload/<?php echo $img->image ?>" alt="" class="product-img-item" />
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="product-detail price">
            <div class="product-detail-infor">
                <h1 class="product-detail-name"><?php echo $pro->proName ?></h1>
                <h3 class="product-detail-special"><?php echo $pro->proSum ?></h3>
                <span class="product-detail-old-price"><sup><?php echo "" . number_format($pro->proPrice, 0, ".", ".") ?>₫</sup> (-<?php echo $pro->proDiscount ?>%)
                </span>
                <span class="product-detail-current-price"><?php echo "" . number_format($pro->proPrice * (100 - $pro->proDiscount) * 0.01 - ($pro->proPrice * (100 - $pro->proDiscount) * 0.01 % 10000), 0, ".", ".") . "" ?>₫</span>
                <form method="GET" action="./pages/control/cart-control.php">
                    <?php if ($fullQuantity) { ?>
                        <button class="add-to-cart disable">
                            <i class="fa-solid fa-ban fa-beat"></i>Full
                        </button>
                        <span class="full-quantity-mess">Maximum quantity in cart</span>
                    <?php } else { ?>
                        <button class="add-to-cart" type="submit" name="add" value="<?php echo $pro->proId ?>">
                            <i class="fa-solid fa-cart-plus fa-bounce"></i>Add to cart
                        </button>
                    <?php } ?>
                </form>
            </div>
            <div class="product-detail-description">
                <?php echo $pro->proDesc ?>
            </div>
        </div>

        <?php
        $seeAlsoList = $mysqli->query("SELECT proImg, proId, proName FROM product WHERE proId <> $pro->proId AND categoryId = $cate->categoryId LIMIT 5");
        if ($seeAlsoList->num_rows > 0) {
        ?>
            <div class="see-also-wrapper">

                <h3 class="see-also-title">See also</h3>
                <div class="see-also-list">
                    <?php while ($also = $seeAlsoList->fetch_object()) { ?>
                        <div class="see-also-item-wrapper">
                            <a href="index.php?product=<?php echo $also->proId ?>">
                                <img src="./admincp/upload/<?php echo $also->proImg ?>" alt="" class="see-also-item" />
                            </a>
                            <p class="see-also-name"><?php echo $also->proName ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <div class="product-detail specifications">
            <div class="product-detail-specifications">
                <h3 class="product-specifications-title">Specifications</h3>
                <ul class="product-specifications-list">
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-microchip fa-beat"></i>
                        CPU: <?php echo $pro->proCpu ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-memory fa-beat"></i>
                        RAM: <?php echo $pro->proRam ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-hard-drive fa-beat"></i>
                        Memory: <?php echo $pro->proHardDrive ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-desktop fa-beat"></i>
                        Screen: <?php echo $pro->proScreen ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-gamepad fa-beat"></i>
                        Graphics card: <?php echo $pro->proGCard ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-brands fa-usb fa-beat"></i>
                        I/O ports: <?php echo $pro->proConn ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-brands fa-windows fa-beat"></i>
                        OS: <?php echo $pro->proOs ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-ruler-horizontal fa-beat"></i>
                        Dimension: <?php echo $pro->proSize ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-weight-hanging fa-beat"></i>
                        Weight: <?php echo $pro->proWeight ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-battery-three-quarters fa-beat"></i>
                        Battery: <?php echo $pro->proBattery ?>
                    </li>
                    <li class="product-specifications-item">
                        <i class="fa-solid fa-video fa-beat"></i>
                        Webcam: <?php echo $pro->proCam ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>