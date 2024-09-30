<?php
session_start();
include("../../admincp/config/connect.php");

if (isset($_POST["action"]) && $_POST["action"] == "register") {
    $cusName = trim($_POST['cusName']);
    $cusMail = trim($_POST['cusMail']);
    $cusAddr = trim($_POST['cusAddr']);
    $cusTel = trim($_POST['cusTel']);
    $cusPassword = md5(trim($_POST['cusPassword']));
    $cusGender = $_POST['cusGender'];

    if (isset($_FILES["cusAvt"]) && !$_FILES["cusAvt"]["error"]) {
        $cusAvt = time() . $_FILES["cusAvt"]["name"];
        move_uploaded_file($_FILES["cusAvt"]["tmp_name"], "../../admincp/upload/userAvt/$cusAvt");
    }

    $sqlRegister = "INSERT INTO customer(cusName, cusTel, cusMail, cusAddr, cusGender, cusPassword, cusAvt)
                    VALUES ('$cusName','$cusTel','$cusMail', '$cusAddr','$cusGender','$cusPassword', '$cusAvt')";
    $mysqli->query($sqlRegister);

    $_SESSION['register'] = "success";

    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

if (isset($_POST["action"]) && $_POST["action"] == "login") {
    $cusMail = trim($_POST['cusMail']);
    $cusPassword = md5(trim($_POST['cusPassword']));

    $sqlLogin = "SELECT cusId, cusName, cusMail, cusTel FROM customer WHERE cusMail = '$cusMail' AND cusPassword = '$cusPassword' LIMIT 1";
    $cus = $mysqli->query($sqlLogin);

    if ($cus->num_rows > 0) {
        $cusFull = $cus->fetch_object();
        $_SESSION["user"] = $cusFull->cusId;
        $_SESSION["login"] = 'success';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        $_SESSION["login"] = 'false';
        $_SESSION['cusMail'] = $cusMail;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    unset($_SESSION['user']);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
