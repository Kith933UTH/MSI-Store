<?php
include("./config/connect.php");
$sql = "SELECT categoryId, categoryName, categoryOrder FROM category ORDER BY categoryOrder";
$list = $mysqli->query($sql);
?>


<h2 class="content-title">Category list</h2>

<div class="main-content">
    <div class="category-list">
        <div class="category-list-item heading">
            <div>Order</div>
            <div>Category name</div>
            <div>Management</div>
        </div>
        <?php
        $i = 0;
        while ($row = $list->fetch_object()) {
        ?>
            <div class="category-list-item <?php if ($i++ % 2 == 0) {
                                                echo "mark";
                                            } ?>">
                <div><?php echo $row->categoryOrder ?></div>
                <div><?php echo $row->categoryName ?></div>
                <div>
                    <a href="?action=categories&query=edit&editId=<?php echo $row->categoryId ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a> |
                    <a href="modules/cateManager/control.php?delete=<?php echo $row->categoryId ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>