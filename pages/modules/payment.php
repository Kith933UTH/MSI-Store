<?php
if (isset($_POST['payment']) && $_POST['payment'] == true) {
    $cusName = $_POST['cusName'];
    $cusTel = $_POST['cusTel'];
    $cusMail = $_POST['cusMail'];
    $cusAddr = $_POST['cusAddr'];
    $cusNote = $_POST['cusNote'];
}

$cartList = $_SESSION["cart"];
$total = 0;

?>


<div class="payment-container">
    <button onclick="history.back()" class="go-back">
        <i class="fa-solid fa-caret-left"></i> Back
    </button>
    <div class="delivery-cart-container">
        <div class="delivery-cart-title">
            <div class="delivery-cart-title-before"></div>
            <h3>Order and shipping information</h3>
            <div class="delivery-cart-title-after"></div>
        </div>

        <div class="payment-delivery-infor">
            <p>Full name:</p>
            <strong><?php echo $cusName ?></strong>
            <p>Email:</p>
            <strong><?php echo $cusMail ?></strong>
            <p>Phone number:</p>
            <strong><?php echo $cusTel ?></strong>
            <p>Address:</p>
            <strong><?php echo $cusAddr ?></strong>
            <p>Notes:</p>
            <strong><?php echo $cusNote ?></strong>
        </div>

        <div class="payment-cart">
            <h3>Your order</h3>

            <div class="payment-product head">
                <div class="payment-product-order">Ordinal number</div>
                <div class="payment-product-name">Product's name</div>
                <div class="payment-product-img">Product's image</div>
                <div class="payment-product-price">Price</div>
                <div class="payment-product-quantity">Quantity</div>
                <div class="payment-product-total">Total</div>
            </div>

            <?php
            if ($cartList) {
                foreach ($cartList as $key => $cartItem) {
                    $total += ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 - ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 % 10000)) * $cartItem->proQuantity;
            ?>
                    <div class="payment-product">
                        <div class="payment-product-order"><?php echo ++$key ?></div>
                        <div class="payment-product-name"><?php echo $cartItem->proName ?></div>
                        <div class="payment-product-img">
                            <div style="background-image: url('./admincp/upload/<?php echo $cartItem->proImg ?>')"></div>
                        </div>
                        <div class="payment-product-price"><?php echo number_format($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 - ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 % 10000), 0, ".", ".") ?>₫</div>
                        <div class="payment-product-quantity"><?php echo $cartItem->proQuantity ?></div>
                        <div class="payment-product-total"><?php echo number_format(($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 - ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 % 10000)) * $cartItem->proQuantity, 0, ".", ".") ?>₫</div>
                    </div>

            <?php }
            } ?>

        </div>
        <div class="totals">Totals : <span><?php echo number_format($total, 0, ".", ".") ?>₫</span></div>
    </div>

    <div class="payment-method-container">
        <div class="payment-method-title">Payment methods</div>
        <form class="payment-option-list" method="POST" action="./admincp/modules/orderManager/main.php">
            <input type="text" style="display:none;" name="cusName" value="<?php echo $cusName ?>">
            <input type="text" style="display:none;" name="cusMail" value="<?php echo $cusMail ?>">
            <input type="text" style="display:none;" name="cusTel" value="<?php echo $cusTel ?>">
            <input type="text" style="display:none;" name="cusAddr" value="<?php echo $cusAddr ?>">
            <input type="text" style="display:none;" name="cusNote" value="<?php echo $cusNote ?>">
            <input type="text" style="display:none;" name="total" value="<?php echo $total ?>">

            <div class="payment-option-item">
                <input type="radio" id="cod" name="payment-method" value="cod" checked />
                <label for="cod">Cash On Delivery (COD)</label>
            </div>
            <div class="payment-option-item">
                <input type="radio" id="vnpay" name="payment-method" value="vnpay" />
                <label for="vnpay">VNPay</label><br />
            </div>
            <button type="submit">Pay now</button>
        </form>
        <div class="payment-momo">
            <img src="./assets/img/momo-icon.png" alt="" />
            <a href="">Payment by Momo</a>
        </div>
    </div>
</div>