<?php
if(isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
}
header("Location: ../../index.php?category=all&keyword=".$keyword);
?>