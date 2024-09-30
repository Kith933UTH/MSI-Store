<?php
include("../../config/connect.php");
session_start();
if (isset($_SESSION["page"])) {
    $page = $_SESSION["page"];
}

if (isset($_POST["insert"])) {
    $proName = $_POST["proName"];
    $proSum = $_POST["proSum"];
    $proPrice = $_POST["proPrice"];
    $proDiscount = $_POST["proDiscount"];
    $proCpu = $_POST["proCpu"];
    $proRam = $_POST["proRam"];
    $proHardDrive = $_POST["proHardDrive"];
    $proScreen = $_POST["proScreen"];
    $proGCard = $_POST["proGCard"];
    $proConn = $_POST["proConn"];
    $proOs = $_POST["proOs"];
    $proSize = $_POST["proSize"];
    $proWeight = $_POST["proWeight"];
    $proBattery = $_POST["proBattery"];
    $proCam = $_POST["proCam"];
    $proDesc = $_POST["proDesc"];
    $proCate = $_POST["proCate"];

    if (isset($_FILES["proImg"]) && !$_FILES["proImg"]["error"]) {
        $proImg = time() . $_FILES["proImg"]["name"];
        move_uploaded_file($_FILES["proImg"]["tmp_name"], "../../upload/$proImg");
    }

    $sql = "INSERT INTO product(proName, proSum, proImg, proPrice, proDiscount, proCpu, proRam, proHardDrive,
    proScreen, proGCard, proConn, proOs, proSize, proWeight, proBattery, proCam, proDesc, proVisible, categoryId) 
    VALUES ('$proName','$proSum','$proImg',' $proPrice','$proDiscount','$proCpu','$proRam','$proHardDrive',
    '$proScreen','$proGCard','$proConn','$proOs','$proSize','$proWeight',' $proBattery','$proCam',' $proDesc', '1','$proCate')";
    $mysqli->query($sql);

    $proId = $mysqli->insert_id;

    if (isset($_FILES["proImgs"])) {
        $time = time();
        $proImgs = $_FILES["proImgs"];
        $proImgsName = $proImgs["name"];
        foreach ($proImgsName as $key => $value) {
            $value = $time . $value;
            move_uploaded_file($proImgs["tmp_name"][$key], "../../upload/$value");
            $mysqli->query("INSERT INTO image(image, proId) VALUES ('$value','$proId')");
        }
    }
    header("Location: ../../index.php?action=products&query=list&page=1");
} else if (isset($_GET["delete"])) {
    $idDelete = $_GET["delete"];

    $sqlImg = "SELECT proImg FROM product WHERE proId = $idDelete";
    $img = $mysqli->query($sqlImg)->fetch_object()->proImg;
    unlink("../../upload/$img");

    $sqlImgs = "SELECT * FROM image WHERE proId = $idDelete";
    $imgs = $mysqli->query($sqlImgs);
    while ($img = $imgs->fetch_object()) {
        unlink("../../upload/$img->image");
        $mysqli->query("DELETE FROM image WHERE imgId = $img->imgId");
    }
    $sql = "DELETE FROM product WHERE proId = $idDelete";
    $mysqli->query($sql);
    header("Location: ../../index.php?action=products&query=list&page=$page");
} else if (isset($_POST["edit"])) {
    $idEdit = $_POST["edit"];
    $proName = $_POST["proName"];
    $proSum = $_POST["proSum"];
    $proPrice = $_POST["proPrice"];
    $proDiscount = $_POST["proDiscount"];
    $proCpu = $_POST["proCpu"];
    $proRam = $_POST["proRam"];
    $proHardDrive = $_POST["proHardDrive"];
    $proScreen = $_POST["proScreen"];
    $proGCard = $_POST["proGCard"];
    $proConn = $_POST["proConn"];
    $proOs = $_POST["proOs"];
    $proSize = $_POST["proSize"];
    $proWeight = $_POST["proWeight"];
    $proBattery = $_POST["proBattery"];
    $proCam = $_POST["proCam"];
    $proDesc = $_POST["proDesc"];
    $proCate = $_POST["proCate"];
    $time = time();
    $sql = "UPDATE product SET proName='$proName',proSum='$proSum',proPrice='$proPrice',
    proDiscount='$proDiscount',proCpu='$proCpu',proRam='$proRam',proHardDrive='$proHardDrive',proScreen='$proScreen',
    proGCard='$proGCard',proConn='$proConn',proOs='$proOs',proSize='$proSize',proWeight='$proWeight',proBattery='$proBattery',
    proCam='$proCam',proDesc='$proDesc',categoryId='$proCate' WHERE proId = $idEdit";

    if (isset($_FILES["proImg"]) && !$_FILES["proImg"]["error"]) {
        $sqlImg = "SELECT proImg FROM product WHERE proId = $idEdit LIMIT 1";
        $img = $mysqli->query($sqlImg)->fetch_object()->proImg;
        unlink("../../upload/$img");
        $proImg = $time . $_FILES["proImg"]["name"];
        move_uploaded_file($_FILES["proImg"]["tmp_name"], "../../upload/$proImg");
        $mysqli->query("UPDATE product SET proImg='$proImg' WHERE proId = $idEdit");
    }

    if (isset($_FILES["proImgs"]) && !$_FILES["proImgs"]["error"][0]) {
        print_r($_FILES);
        $sqlImgs = "SELECT * FROM image WHERE proId = $idEdit";
        $imgs = $mysqli->query($sqlImgs);
        while ($img = $imgs->fetch_object()) {
            unlink("../../upload/$img->image");
            $mysqli->query("DELETE FROM image WHERE imgId = $img->imgId");
        }

        $proImgs = $_FILES["proImgs"];
        $proImgsName = $proImgs["name"];
        foreach ($proImgsName as $key => $value) {
            $value = $time . $value;
            move_uploaded_file($proImgs["tmp_name"][$key], "../../upload/$value");
            $mysqli->query("INSERT INTO image(image, proId) VALUES ('$value','$idEdit')");
        }
    }

    $mysqli->query($sql);
    header("Location: ../../index.php?action=products&query=list&page=$page");
} else if (isset($_GET["show"])) {
    $proId = $_GET["show"];
    $mysqli->query("UPDATE product SET proVisible='1' WHERE proId = $proId");
    header("Location: ../../index.php?action=products&query=list&page=$page");
} else if (isset($_GET["hide"])) {
    $proId = $_GET["hide"];
    $mysqli->query("UPDATE product SET proVisible='0' WHERE proId = $proId");
    header("Location: ../../index.php?action=products&query=list&page=$page");
}

$mysqli->close();
