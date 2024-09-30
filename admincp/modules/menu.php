<?php
include("./config/connect.php");

$adId = $_SESSION["admin"];
$sql = "SELECT * FROM `admin` WHERE adId = $adId LIMIT 1";
$admin = $mysqli->query($sql)->fetch_object();

?>

<div class="sidebar-wrapper">
    <h1><i class="fa-solid fa-user-tie"></i> ADMIN MSI STORE</h1>
    <h2><a href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></h2>


    <ul class="menu">
        <div class="menu-item">
            <label for="cate" class="menu-item-title">
                <i class="fa-solid fa-list"></i>
                <p>Categories</p>
                <i class="fa-solid fa-chevron-down"></i>
            </label>
            <input type="checkbox" id="cate" name="manager">
            <ul class="menu-item-sub-menu">
                <li class="sub-menu"><a href="index.php?action=categories&query=insert">Add a category</a></li>
                <li class="sub-menu"><a href="index.php?action=categories&query=list">Category list</a></li>
            </ul>
        </div>

        <div class="menu-item">
            <label for="product" class="menu-item-title">
                <i class="fa-solid fa-laptop-file"></i>
                <p>Products</p>
                <i class="fa-solid fa-chevron-down"></i>
            </label>
            <input type="checkbox" id="product" name="manager">
            <ul class="menu-item-sub-menu">
                <li class="sub-menu"><a href="index.php?action=products&query=insert">Add a product</a></li>
                <li class="sub-menu"><a href="index.php?action=products&query=list&page=1">Product list</a></li>
            </ul>
        </div>

        <div class="menu-item">
            <label for="user" class="menu-item-title">
                <i class="fa-solid fa-users"></i>
                <p>Users</p>
                <i class="fa-solid fa-chevron-down"></i>
            </label>
            <input type="checkbox" id="user" name="manager">
            <ul class="menu-item-sub-menu">
                <li class="sub-menu"><a href="index.php?action=users&query=insert">Add a user</a></li>
                <li class="sub-menu"><a href="index.php?action=users&query=list">User list</a></li>
            </ul>
        </div>
    </ul>


    <div class="admin-profile">
        <div>
            <img class="admin-avt" src="upload/adminAvt/<?php echo $admin->adAvt ?>" alt="">
            <h2><?php echo $admin->adName ?></h2>
        </div>
        <form method="POST" action="./modules/admin-login.php">
            <button type="submit" name="action" value="logout" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </form>
    </div>
</div>

<div class="sidebar-wrapper-under"></div>