<?php
include("../../config/connect.php");


if (isset($_POST["insert"])) {
    $cateName = $_POST["cateName"];
    $cateOrder = $_POST["cateOrder"];
    $sql = "INSERT INTO category(categoryName, categoryOrder) VALUES ('$cateName', $cateOrder)";
    $mysqli->query($sql);
    header("Location: ../../index.php?action=categories&query=list");
} else if (isset($_GET["delete"])) {
    $idDelete = $_GET["delete"];
    $sql = "DELETE FROM category WHERE categoryId = $idDelete";
    $mysqli->query($sql);
    header("Location: ../../index.php?action=categories&query=list");
} else if (isset($_POST["edit"])) {
    $idEdit = $_POST["edit"];
    $cateName = $_POST["cateName"];
    $cateOrder = $_POST["cateOrder"];
    $sql = "UPDATE category SET categoryName = '$cateName', categoryOrder = $cateOrder WHERE categoryId = $idEdit;";
    $mysqli->query($sql);
    header("Location: ../../index.php?action=categories&query=list");
}




$mysqli->close();
