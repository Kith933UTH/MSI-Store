<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: ./modules/admin-login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSI Store | Administrator</title>
    <link rel="shortcut icon" href="../assets/icon/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <?php include('./modules/menu.php') ?>
        <?php include('./modules/main.php') ?>
    </div>
</body>

<script>
    document.querySelectorAll(".sidebar-wrapper .menu .menu-item label").forEach(item => {
        item.addEventListener("click", (e) => {
            item.querySelector("i:last-child").classList.toggle("active");
        })
    })
</script>

<?php
if (isset($_GET['action'])) {
    if ($_GET["action"] == "users" && ($_GET["query"] == "insert" || $_GET["query"] == "edit")) {
?>
        <script>
            document.getElementById("input-avt").addEventListener("change", e => {
                const [file] = e.target.files;
                if (file) {
                    document.getElementById("input-avt-tmp").src = URL.createObjectURL(file);
                }
            })
        </script>
    <?php
    } else if ($_GET["action"] == "products" && ($_GET["query"] == "insert" || $_GET["query"] == "edit")) {
    ?>
        <script>
            document.getElementById("input-product-img").addEventListener("change", e => {
                let output = ""
                Array.from(e.target.files).map((file) => {
                    const blobUrl = window.URL.createObjectURL(file)
                    output += `<img src=${blobUrl}>`
                })
                document.getElementById("input-product-img-tmp").innerHTML = output
            })

            document.getElementById("input-product-main-img").addEventListener("change", e => {
                const [file] = e.target.files;
                if (file) {
                    document.getElementById("input-product-main-img-tmp").innerHTML = `<img src=${URL.createObjectURL(file)}>`;
                }
            })
        </script>
<?php }
} ?>

</html>