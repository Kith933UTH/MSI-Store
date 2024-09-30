<div class="main-content">
    <h1 class="title">Latest products</h1>
    <div class="product-wrapper">
        <?php
        $sqlPro = "SELECT proId, proName, proImg, proDesc FROM product WHERE proVisible = '1' ORDER BY proId DESC LIMIT 6";
        $listPro = $mysqli->query($sqlPro);
        while ($rowPro = $listPro->fetch_object()) {
        ?>
            <div class="product-item">
                <a href="index.php?product=<?php echo $rowPro->proId ?>" class="product-link">
                    <img src="./admincp/upload/<?php echo $rowPro->proImg ?>" class="product-img" />
                    <div class="product-name"><?php echo $rowPro->proName ?></div>
                </a>
                <div class="product-description">
                    <?php echo strip_tags($rowPro->proDesc) ?>
                </div>
            </div>

        <?php } ?>
    </div>
</div>