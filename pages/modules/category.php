<?php
$keyword = "";
if (isset($_GET["category"])) {
    $category = $_GET["category"];
}
if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
}

$ram = "";
$screen = "";
$cpu = "";
$drive = "";
$max = 150000000;
$min = 5000000;
$sort = "product.proId DESC";

if (isset($_SESSION["ram"])) {
    $ram = $_SESSION["ram"];
}
if (isset($_SESSION["screen"])) {
    $screen = $_SESSION["screen"];
}
if (isset($_SESSION["cpu"])) {
    $cpu = $_SESSION["cpu"];
}
if (isset($_SESSION["drive"])) {
    $drive = $_SESSION["drive"];
}
if (isset($_SESSION["min"])) {
    $min = $_SESSION["min"];
}
if (isset($_SESSION["max"])) {
    $max = $_SESSION["max"];
}
if (isset($_SESSION["sort"])) {
    $sort = $_SESSION["sort"];
}

if (isset($_POST["ram"])) {
    $ram = $_POST["ram"];
}
if (isset($_POST["screen"])) {
    $screen = $_POST["screen"];
}
if (isset($_POST["cpu"])) {
    $cpu = $_POST["cpu"];
}
if (isset($_POST["drive"])) {
    $drive = $_POST["drive"];
}
if (isset($_POST["min"])) {
    $min = $_POST["min"];
}
if (isset($_POST["max"])) {
    $max = $_POST["max"];
}
if (isset($_POST["sort"])) {
    if ($_POST["sort"] == "DESC") {
        $sort = "(product.proPrice * (100 - product.proDiscount)) DESC";
    } else if ($_POST["sort"] == "ASC") {
        $sort = "(product.proPrice * (100 - product.proDiscount)) ASC";
    } else if ($_POST["sort"] == "discount") {
        $sort = "product.proDiscount DESC";
    }
}

$_SESSION["ram"] = $ram;
$_SESSION["screen"] = $screen;
$_SESSION["cpu"] = $cpu;
$_SESSION["drive"] = $drive;
$_SESSION["min"] = $min;
$_SESSION["max"] = $max;
$_SESSION["sort"] = $sort;

if (isset($_POST["clear"]) && $_POST["clear"] == "clear") {
    unset($_SESSION["ram"]);
    unset($_SESSION["screen"]);
    unset($_SESSION["cpu"]);
    unset($_SESSION["drive"]);
    unset($_SESSION["min"]);
    unset($_SESSION["max"]);
    unset($_SESSION["sort"]);
    $ram = "";
    $screen = "";
    $cpu = "";
    $drive = "";
    $max = 150000000;
    $min = 5000000;
    $sort = "product.proId DESC";
}


if ($category == "all") {
    $cateName = "All";
    if ($keyword == "") {
        $sqlPro = "SELECT proId, proName, proImg, proPrice, proDiscount, proCpu, proRam, proScreen, proGCard, proWeight, proBattery, proHardDrive
            FROM product WHERE proVisible = '1' ORDER BY $sort";
    } else {
        $sqlPro = "SELECT proId, proName, proImg, proPrice, proDiscount, proCpu, proRam, proScreen, proGCard, proWeight, proBattery, proHardDrive
            FROM product WHERE proVisible = '1' AND proName LIKE '%" . $keyword . "%' ORDER BY $sort";
    }
} else {
    $cateName = $mysqli->query("SELECT categoryName FROM category WHERE categoryId = $category LIMIT 1")->fetch_object()->categoryName;
    $sqlPro = "SELECT proId, proName, proImg, proPrice, proDiscount, proCpu, proRam, proScreen, proGCard, proWeight, proBattery, proHardDrive
         FROM product, category WHERE proVisible = '1' AND product.categoryId = category.categoryId AND product.categoryId = $category ORDER BY $sort";
}
function checkAttr($string, $array)
{
    $check = false;
    if (is_array($array)) {
        foreach ($array as $value) {
            if (stripos($string, $value) !== false) {
                return true;
            }
        }
    } else {
        return true;
    }
    return $check;
}
function checkPrice($price, $max, $min)
{
    return ($price <= $max) && ($price >= $min);
}

function checkPro($pro)
{
    $checkPro = true;
    global $ram, $screen, $cpu, $drive, $max, $min;
    if (!checkAttr($pro->proRam, $ram)) {
        return false;
    }
    if (!checkAttr($pro->proScreen, $screen)) {
        return false;
    }
    if (!checkAttr($pro->proCpu, $cpu)) {
        return false;
    }
    if (!checkAttr($pro->proHardDrive, $drive)) {
        return false;
    }
    if (!checkPrice($pro->proPrice * (100 - $pro->proDiscount) * 0.01, (float)$max, (float)$min)) {
        return false;
    }
    return $checkPro;
}

$prosResult = [];
$pros = $mysqli->query($sqlPro);
if (mysqli_num_rows($pros) > 0) {
    while ($row = $pros->fetch_object()) {
        $prosResult[] = $row;
    }
}

foreach ($prosResult as $key => $value) {
    if (!checkPro($value)) {
        unset($prosResult[$key]);
    }
}

?>

<div class="main-content">
    <div class="category-content">
        <?php if ($keyword == "") { ?>
            <div class="category-select">
                <h2><i class="fa-solid fa-square"></i> Series</h2>
                <ul class="category-select-wrapper">
                    <li class="category-option <?php if ($category == 'all') {
                                                    echo "selected";
                                                } ?>">
                        <a href="?category=all">All</a>
                    </li>
                    <?php
                    $sql = "SELECT categoryId, categoryName FROM category ORDER BY categoryOrder";
                    $list = $mysqli->query($sql);
                    while ($row = $list->fetch_object()) {
                    ?>
                        <li class="category-option <?php if ($category == $row->categoryId) {
                                                        echo "selected";
                                                    } ?>">
                            <a href="?category=<?php echo $row->categoryId ?>"><?php echo $row->categoryName ?></a>
                        </li>

                    <?php } ?>
                </ul>
                <?php if (!($keyword != "" && count($prosResult) <= 0)) {
                    include("./pages/modules/filter.php");
                } ?>
            </div>
        <?php } ?>
        <div class="category-product">
            <?php if ($keyword == "") { ?>
                <div class="category-product-img" style="background-image: url('./assets/img/category2.jpeg')"></div>
            <?php } ?>
            <div class="title-wrapper category-title-wrapper">
                <div class="path path-category">
                    <?php if ($keyword == "") { ?>
                        <a href="index.php">Home</a>
                        <span> / </span>
                        <span class="current">
                            <?php echo $cateName ?>
                        </span>
                    <?php } else { ?>
                        Search results for:
                        <span class="current" style="font-size: var(--big-size);">
                            <?php echo $keyword ?>
                        </span>
                    <?php } ?>

                </div>
                <h1 class="category-name title"><?php echo $cateName ?> (<?php echo count($prosResult) ?>)</h1>
            </div>
            <?php
            if (count($prosResult) > 0) {
                foreach ($prosResult as $pro) {
            ?>
                    <div class="product-item">
                        <span class="product-item-sale-off">Sale off</span>
                        <a href="index.php?product=<?php echo $pro->proId ?>" class="product-link">
                            <img src="admincp/upload/<?php echo $pro->proImg ?>" class="product-img" />
                            <div class="product-name"><?php echo $pro->proName ?></div>
                        </a>
                        <div class="product-price-wrapper">
                            <span class="old-price"><sup><?php echo "" . number_format($pro->proPrice, 0, ".", ".") ?>₫</sup> (-<?php echo $pro->proDiscount ?>%)</span>
                            <span class="current-price"><?php echo "" . number_format($pro->proPrice * (100 - $pro->proDiscount) * 0.01 - ($pro->proPrice * (100 - $pro->proDiscount) * 0.01) % 10000, 0, ".", ".") . "" ?><sup>₫</sup></span>
                        </div>
                        <ul class="product-description">
                            <li>CPU: <?php echo $pro->proCpu ?></li>
                            <li>RAM: <?php echo $pro->proRam ?></li>
                            <li>Screen: <?php echo $pro->proScreen ?></li>
                            <li>Card: <?php echo $pro->proGCard ?></li>
                            <li>Memory: <?php echo $pro->proHardDrive ?></li>
                            <li>Weight: <?php echo $pro->proWeight ?></li>
                        </ul>
                    </div>

            <?php }
            } else {
                echo "<div style='
                    width:100%;
                    height:100%;
                    color:var(--primary-color);
                    display:flex;
                    font-size:var(--big-size);
                    margin-top: 2rem;
                    '>No suitable products were found</div>";
            }
            ?>
        </div>
    </div>
    <!-- <button class="show-more-btn" id="show-more-btn">Show more<i class="fa-solid fa-caret-down"></i></button> -->
    <?php if (count($prosResult) > 0) { ?>
        <div class="pagination-wrapper">
            <button id="page-prev"><i class="fa-solid fa-angle-left"></i>Prev </button>
            <div id="page-items-wrapper"></div>
            <button id="page-next">Next<i class="fa-solid fa-angle-right"></i></button>
        </div>
    <?php } ?>
</div>