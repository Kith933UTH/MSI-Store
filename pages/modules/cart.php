<?php
if (!str_contains($_SERVER["HTTP_REFERER"], "cart")) {
    $_SESSION['previous-page'] = $_SERVER["HTTP_REFERER"];
}
$cartList = null;
if (isset($_SESSION["cart"])) {
    $cartList = $_SESSION["cart"];
}
$total = 0;

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
    $user = $mysqli->query("SELECT cusMail, cusName, cusAddr, cusTel FROM customer WHERE cusId = $userId LIMIT 1")->fetch_object();
?>
    <script>
        if (!localStorage.getItem("cusName")) localStorage.setItem("cusName", "<?php echo $user->cusName ?>");
        if (!localStorage.getItem("cusAddr")) localStorage.setItem("cusAddr", "<?php echo $user->cusAddr ?>");
        if (!localStorage.getItem("cusTel")) localStorage.setItem("cusTel", "<?php echo $user->cusTel ?>");
        if (!localStorage.getItem("cusMail")) localStorage.setItem("cusMail", "<?php echo $user->cusMail ?>");
    </script>
<?php
}
?>


<div class="cart-container">
    <div class="shopping-cart">
        <div class="cart-title">
            <div class="cart-title-before"></div>
            <h3>Shopping cart</h3>
            <div class="cart-title-after"></div>
        </div>
        <button onclick="window.location = '<?php echo $_SESSION['previous-page'] ?>'" class="go-back">
            <i class="fa-solid fa-caret-left"></i> Back
        </button>

        <?php
        if ($cartList) {
            foreach ($cartList as $cartItem) {
                $total += ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 - ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 % 10000)) * $cartItem->proQuantity;
        ?>
                <div class="cart-product">
                    <div class="cart-product-image">
                        <div style="background-image: url('./admincp/upload/<?php echo $cartItem->proImg ?>')"></div>
                        <span onclick="if(confirm('Are you sure you want to delete <?php echo $cartItem->proName ?> from your shopping cart?')){window.location = './pages/control/cart-control.php?remove=<?php echo $cartItem->proId ?>'}" class="cart-remove-product"><i class="fa-solid fa-trash"></i> Delete</span>
                    </div>

                    <div class="cart-product-details">
                        <div class="cart-product-title"><?php echo $cartItem->proName ?></div>
                        <p class="cart-product-description"><?php echo $cartItem->proSum ?></p>
                    </div>

                    <div class="cart-product-price-quantity">
                        <div class="cart-product-price">
                            <div class="cart-product-current-price"><?php echo number_format($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 - ($cartItem->proPrice * (100 - $cartItem->proDiscount) * 0.01 % 10000), 0, ".", ".") ?>₫</div>
                            <div class="cart-product-old-price"><?php echo number_format($cartItem->proPrice, 0, ".", ".") ?>₫</div>
                        </div>
                        <div class="cart-product-quantity">
                            <a href="./pages/control/cart-control.php?delete=<?php echo $cartItem->proId ?>" class="product-quantity-change <?php if ($cartItem->proQuantity <= 1) {
                                                                                                                                                echo "disable";
                                                                                                                                            }  ?>"><i class="fa-solid fa-minus"></i></a>
                            <span><?php echo $cartItem->proQuantity ?></span>
                            <a href="./pages/control/cart-control.php?add=<?php echo $cartItem->proId ?>" class="product-quantity-change <?php if ($cartItem->proQuantity >= 5) {
                                                                                                                                                echo "disable";
                                                                                                                                            }  ?>"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>

            <?php }
        } else {
            ?>
            <div style="font-size: var(--big-size); color: var(--white-color); font-weight: 600; margin-left: 2rem;">The shopping cart has no products yet.</div>
        <?php } ?>

        <div class="totals">Total : <span><?php echo number_format($total, 0, ".", ".") ?>₫</span></div>
    </div>

    <?php if ($cartList) { ?>
        <div class="delivery-infor">
            <div class="cart-title">
                <div class="cart-title-before"></div>
                <h3>Shipping information</h3>
                <div class="cart-title-after"></div>
            </div>
            <div class="delivery-infor-content">
                <form action="index.php?payment" method="POST">
                    <div class="input-box">
                        <input type="text" name="cusName" id="cusName" onkeyup="saveValue(this);" spellcheck="false" required />
                        <label class="details" for="cusName">Full name</label>
                    </div>

                    <div class="input-box">
                        <input type="tel" name="cusTel" id="cusTel" onkeyup="saveValue(this);" pattern="[0-9]{10}" required />
                        <label class="details" for="cusTel">Phone number</label>
                    </div>

                    <div class="input-box">
                        <input type="email" name="cusMail" id="cusMail" onkeyup="saveValue(this);" spellcheck="false" required />
                        <label class="details" for="cusMail">Email</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="cusAddr" id="cusAddr" onkeyup="saveValue(this);" spellcheck="false" required />
                        <label class="details" for="cusAddr">Address</label>
                    </div>

                    <div class="input-box full-grid">
                        <input type="text" name="cusNote" id="cusNote" onkeyup="saveValue(this);" spellcheck="false" />
                        <label class="details" for="cusNote">Notes (if so)</label>
                    </div>
                    <div class="submit-btn">
                        <button type="submit" name="payment" value="true">Order</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</div>