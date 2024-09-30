<?php

if (isset($_GET["category"])) {
    // $category = $_GET["category"];
    include("./pages/modules/category.php");
} else if (isset($_GET["product"])) {
    // $product = $_GET["product"];
    include("./pages/modules/product.php");
} else if (isset($_GET["cart"])) {
    include("./pages/modules/cart.php");
} else if (isset($_GET["payment"])) {
    include("./pages/modules/payment.php");
} else if (isset($_GET["profile"])) {
    include("./pages/modules/profile.php");
} else if (isset($_GET["about"])) {
    include("./pages/modules/about.php");
} else if (isset($_GET["warranty"])) {
    include("./pages/modules/warranty.php");
} else if (isset($_GET["contact"])) {
    include("./pages/modules/contact.php");
} else if (isset($_GET["thanks"])) {
    include("./pages/modules/thanks.php");
} else {
    include("./pages/modules/slider.php");
    include("./pages/modules/newProduct.php");
}
