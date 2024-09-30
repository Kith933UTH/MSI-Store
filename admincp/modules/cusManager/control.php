<?php
include("../../config/connect.php");


if (isset($_POST["insert"])) {
    $cusName = trim($_POST["cusName"]);
    $cusTel = trim($_POST["cusTel"]);
    $cusMail = trim($_POST["cusMail"]);
    $cusAddr = trim($_POST["cusAddr"]);
    $cusGender = trim($_POST["cusGender"]);
    $cusPassword = md5(trim($_POST["cusPassword"]));

    if (isset($_FILES["cusAvt"]) && !$_FILES["cusAvt"]["error"]) {
        $cusAvt = time() . $_FILES["cusAvt"]["name"];
        move_uploaded_file($_FILES["cusAvt"]["tmp_name"], "../../upload/userAvt/$cusAvt");
    }

    $sql = "INSERT INTO customer(cusName, cusTel, cusMail, cusAddr, cusGender, cusPassword, cusAvt)
            VALUES ('$cusName','$cusTel','$cusMail','$cusAddr','$cusGender','$cusPassword','$cusAvt')";
    $mysqli->query($sql);

    header("Location: ../../index.php?action=users&query=list");
} else if (isset($_GET["delete"])) {
    $idDelete = $_GET["delete"];

    $sqlAvt = "SELECT cusAvt FROM customer WHERE cusId = $idDelete";
    $avt = $mysqli->query($sqlAvt)->fetch_object()->cusAvt;
    unlink("../../upload/userAvt/$avt");

    $sqlDeleteUser = "DELETE FROM customer WHERE cusId = $idDelete";
    $mysqli->query($sqlDeleteUser);

    header("Location: ../../index.php?action=users&query=list");
} else if (isset($_POST["edit"])) {
    $idEdit = $_POST["edit"];
    $cusName = trim($_POST["cusName"]);
    $cusTel = trim($_POST["cusTel"]);
    $cusMail = trim($_POST["cusMail"]);
    $cusAddr = trim($_POST["cusAddr"]);
    $cusGender = trim($_POST["cusGender"]);
    $cusPassword = trim($_POST["cusPassword"]);

    if (isset($_FILES["cusAvt"]) && !$_FILES["cusAvt"]["error"]) {
        $sqlAvt = "SELECT cusAvt FROM customer WHERE cusId = $idEdit";
        $avt = $mysqli->query($sqlAvt)->fetch_object()->cusAvt;
        unlink("../../upload/userAvt/$avt");

        $newCusAvt = time() . $_FILES["cusAvt"]["name"];
        move_uploaded_file($_FILES["cusAvt"]["tmp_name"], "../../upload/userAvt/$newCusAvt");
        $mysqli->query("UPDATE customer SET cusAvt='$newCusAvt' WHERE cusId = $idEdit");
    }

    if ($cusPassword != "") {
        $newCusPassword = md5($cusPassword);
        $sqlEdit = "UPDATE customer SET cusName='$cusName',cusTel='$cusTel',cusMail='$cusMail',cusAddr='$cusAddr',cusGender='$cusGender', cusPassword='$newCusPassword' WHERE cusId = $idEdit";
    } else {
        $sqlEdit = "UPDATE customer SET cusName='$cusName',cusTel='$cusTel',cusMail='$cusMail',cusAddr='$cusAddr',cusGender='$cusGender' WHERE cusId = $idEdit";
    }

    $mysqli->query($sqlEdit);
    header("Location: ../../index.php?action=users&query=list");
}

$mysqli->close();
