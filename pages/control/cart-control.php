<?php 
session_start();
include("../../admincp/config/connect.php");

// add
if(isset($_GET["add"])){
    $idAdd = $_GET["add"];
    $pro = $mysqli->query("SELECT proId, proName, proImg, proSum, proPrice, proDiscount FROM product WHERE proId = $idAdd LIMIT 1")->fetch_object();
    if($pro){
        $newCartPro = $pro;
        $newCartPro->proQuantity = 1;

        if(isset($_SESSION["cart"])) {
            $found = false;
            foreach($_SESSION["cart"] as $cartItem) {
                if($cartItem->proId == $idAdd){
                    $cartItem->proQuantity++;
                    $found = true;
                }
            }
            if(!$found){$_SESSION["cart"][] = $newCartPro;}

        }else{
            $_SESSION["cart"] = array($newCartPro);
        }
    }
//decrease quantity
}else if(isset($_GET["delete"])) {
    $idDelete = $_GET["delete"];
    if(isset($_SESSION["cart"])) {
        foreach($_SESSION["cart"] as $cartItem) {
            if($cartItem->proId == $idDelete){
                $cartItem->proQuantity--;
            }
        }
    }
//remove
}else if(isset($_GET["remove"])) {
    $idRemove = $_GET["remove"];
    if(isset($_SESSION["cart"])) {
        foreach($_SESSION["cart"] as $key => $cartItem) {
            if($cartItem->proId == $idRemove){
                unset($_SESSION["cart"][$key]);
            }
        }
    }
}
header("Location: " . $_SERVER["HTTP_REFERER"]);
?>