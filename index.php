<?php
session_start();
include('./admincp/config/connect.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/icon/favicon.ico" type="image/vnd.microsoft.icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./assets/css/owl-carousel.css" />
  <link rel="stylesheet" href="./assets/css/owl-theme-default.css" />
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/category.css" />
  <link rel="stylesheet" href="./assets/css/detail.css" />
  <link rel="stylesheet" href="./assets/css/cart.css" />
  <link rel="stylesheet" href="./assets/css/payment.css" />
  <link rel="stylesheet" href="./assets/css/about.css" />
  <link rel="stylesheet" href="./assets/css/filter2.css" />
  <link rel="stylesheet" href="./assets/css/pagination.css" />
  <link rel="stylesheet" href="./assets/css/profile.css" />
  <link rel="stylesheet" href="./assets/css/warranty.css" />
  <link rel="stylesheet" href="./assets/css/contact.css" />
  <link rel="stylesheet" href="./assets/css/thanks.css" />
  <link rel="stylesheet" href="./assets/css/responsive.css" />
  <title>MSI Store</title>
</head>

<body>
  <div class="container">
    <?php include('./pages/modules/header.php') ?>
    <?php include('./pages/modules/register.php') ?>
    <?php include('./pages/modules/login.php') ?>
    <?php include('./pages/control/main.php') ?>
    <?php include('./pages/modules/footer.php') ?>

    <!-- js -->
    <script src="./assets/js/user-control.js"></script>
    <script src="./assets/js/search-form.js"></script>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- owl carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- js  -->
    <?php
    if (isset($_GET["category"])) {
    ?>
      <script src="./assets/js/filter.js"></script>
      <script src="./assets/js/category.js"></script>
    <?php
    } else if (isset($_GET["cart"])) { ?>
      <script src="./assets/js/cart.js"></script>
    <?php
    } else if (isset($_GET["product"])) { ?>
      <script type="module" src="./assets/js/product-detail.js"></script>
    <?php
    } else if (isset($_GET["payment"])) { ?>

    <?php
    } else if (isset($_GET["warranty"])) { ?>

    <?php
    } else if (isset($_GET["contact"])) { ?>

    <?php
    } else if (isset($_GET["thanks"])) { ?>

    <?php
    } else if (isset($_GET["profile"]) && $_GET["profile"] == "update") { ?>
      <script type="module" src="./assets/js/update-profile.js"></script>
    <?php
    } else if (isset($_GET["profile"]) && $_GET["profile"] == "change-password") { ?>
      <script type="module" src="./assets/js/change-password.js"></script>
    <?php } else { ?>
      <script src="./assets/js/slider.js"></script>
    <?php } ?>

    <!-- login logout  -->
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == "success") { ?>
      <script>
        if (confirm('Account successfully created! Sign in now?')) {
          document.getElementById("login-container").classList.add("active");
          document.getElementById("register-container").classList.remove("active");
        }
      </script>
    <?php
      unset($_SESSION["register"]);
    }; ?>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] == "success") {
      unset($_SESSION['login']);
      unset($_SESSION["cusMail"]);
    ?>
      <script>
        alert('Logged in successfully!')
      </script>
    <?php
    } else if (isset($_SESSION['login']) && $_SESSION['login'] == "false") { ?>
      <script>
        alert('Email or password is incorrect!');
        document.getElementById("login-container").classList.add("active");
        document.getElementById("cusMailLogin").value = '<?php if (isset($_SESSION['cusMail'])) {
                                                            echo $_SESSION['cusMail'];
                                                          } else {
                                                            echo "";
                                                          } ?>';
      </script>
    <?php
      unset($_SESSION["login"]);
      unset($_SESSION["cusMail"]);
    }; ?>

  </div>
</body>

</html>