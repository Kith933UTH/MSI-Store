<?php
session_start();
include("../config/connect.php");

if (isset($_POST["action"]) && $_POST["action"] == "login") {
    $adUserName = trim($_POST['adUserName']);
    $adPassword = md5(trim($_POST['adPassword']));

    $sqlLogin = "SELECT adId, adUserName, adPassword FROM `admin` WHERE adUserName = '$adUserName' AND adPassword = '$adPassword' LIMIT 1";
    $admin = $mysqli->query($sqlLogin);

    if ($admin->num_rows > 0) {
        $adminObj = $admin->fetch_object();
        $_SESSION["admin"] = $adminObj->adId;
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Wrong password or user name!!!');</script>";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "logout") {
    print_r($_SESSION);
    unset($_SESSION['admin']);
    header("Location: ../index.php");
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Aldi Duzha" />
    <meta name="description" content="Free Bulma Login Template, part of Awesome Bulma Templates" />
    <meta name="keywords" content="bulma, login, page, website, template, free, awesome" />
    <link rel="canonical" href="https://aldi.github.io/bulma-login-template/" />
    <title>MSI Store | Administrator</title>
    <link rel="shortcut icon" href="../../assets/icon/favicon.ico" type="image/vnd.microsoft.icon">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-social@1/bin/bulma-social.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/login-admin.css" />
</head>

<body>
    <section class="hero is-fullheight login-container">
        <div class="hero-body ">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <div class="box">
                        <p class="subtitle is-4 login-title">Log in to access the admin page.</p>
                        <br />
                        <form method="POST">
                            <div class="field">
                                <p class="control has-icons-left has-icons-right">
                                    <input class="input is-medium" type="text" name="adUserName" placeholder="User name" required />
                                    <span class="icon is-medium is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control has-icons-left">
                                    <input class="input is-medium" type="password" name="adPassword" placeholder="Password" required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <button type="submit" name="action" value="login" class="button is-block is-info is-large is-fullwidth submit-btn">Login</button><br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>