<div class="content">
    <?php

    if (isset($_GET["action"]) && isset($_GET["query"])) {
        $action = $_GET["action"];
        $query = $_GET["query"];
    } else {
        $action = "";
        $query = "";
    }

    if (isset($_GET['search-user']) && $_GET['search-user'] != "") {
        $searchValue = $_GET['search-user'];
        header("Location: index.php?action=users&query=list&search=$searchValue");
    }

    if (isset($_GET['search-product']) && $_GET['search-product'] != "") {
        $searchValue = $_GET['search-product'];
        header("Location: index.php?action=products&query=list&page=1&search=$searchValue");
    }

    if ($action == "categories" && $query == "insert") {
        include('modules/cateManager/insert.php');
    } elseif ($action == "categories" && $query == "list") {
        include('modules/cateManager/list.php');
    } elseif ($action == "categories" && $query == "edit") {
        include('modules/cateManager/edit.php');
    } elseif ($action == "products" && $query == "insert") {
        include("modules/productManager/insert.php");
    } elseif ($action == "products" && $query == "list") {
        include('modules/productManager/list.php');
    } elseif ($action == "products" && $query == "edit") {
        include('modules/productManager/edit.php');
    } elseif ($action == "users" && $query == "insert") {
        include('modules/cusManager/insert.php');
    } elseif ($action == "users" && $query == "list") {
        include('modules/cusManager/list.php');
    } elseif ($action == "users" && $query == "edit") {
        include('modules/cusManager/edit.php');
    } else {
        include("modules/dashboard.php");
    }

    ?>
</div>