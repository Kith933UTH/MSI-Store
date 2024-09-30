<?php
session_start();
include("../../config/connect.php");

if (isset($_SESSION["user"])) {
    $userId = $_SESSION["user"];
    $user = $mysqli->query("SELECT cusAvt, cusPassword FROM customer WHERE cusId = $userId LIMIT 1")->fetch_object();
}

$action = "";
if (isset($_POST["action"])) {
    $action = $_POST["action"];
}

if ($action == "update") {
    $userName = trim($_POST['userName']);
    $userAddr = trim($_POST['userAddr']);
    $userTel = trim($_POST['userTel']);
    $userGender = trim($_POST['userGender']);

    $sqlUpdate = "UPDATE customer SET cusName='$userName', cusTel='$userTel', cusAddr='$userAddr' , cusGender='$userGender' WHERE cusId = $userId";

    if (isset($_FILES["userAvt"]) && !$_FILES["userAvt"]["error"]) {
        $userAvt = time() . $_FILES["userAvt"]["name"];
        move_uploaded_file($_FILES["userAvt"]["tmp_name"], "../../upload/userAvt/" . $userAvt);
        unlink("../../upload/userAvt/" . $user->cusAvt);
        $sqlUpdate = "UPDATE customer SET cusName='$userName', cusTel='$userTel', cusGender='$userGender',cusAvt='$userAvt' WHERE cusId = $userId";
    }

    $mysqli->query($sqlUpdate);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

if ($action == "change-password") {
    $oldPass = md5($_POST["old-password"]);
    $newPass = md5($_POST["new-password"]);

    if ($user->cusPassword != $oldPass) {
        $_SESSION["change-password"] = false;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        $mysqli->query("UPDATE customer SET cusPassword='$newPass' WHERE cusId = $userId AND cusPassword = '$oldPass'");
        $_SESSION["change-password"] = true;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
