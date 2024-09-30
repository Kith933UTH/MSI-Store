<?php
$prevPage = $currentPage - 1 <= 1 ? 1 : $currentPage - 1;
$nextPage = $currentPage + 1 >= $pageLength ? $pageLength : $currentPage + 1;
?>

<div class="pagination-wrapper">
    <!-- to first page -->
    <div class="pagination-item">
        <a href="index.php?action=products&query=list&page=1<?php echo $searchValue != "" ? "&search=$searchValue" : "" ?>">
            <i class="fa-solid fa-angles-left"></i>
        </a>
    </div>

    <!-- to next page -->
    <div class="pagination-item <?php echo $currentPage == 1 ? "disabled" : "" ?>">
        <a href="index.php?action=products&query=list&page=<?php echo $prevPage ?><?php echo $searchValue != "" ? "&search=$searchValue" : "" ?>">
            <i class="fa-solid fa-angle-left"></i>
        </a>
    </div>

    <!-- generate page number  -->
    <?php
    $i = 0;
    while ($i < ($pageLength)) { ?>
        <div class="pagination-item <?php echo ++$i == $currentPage ? "selected" : "" ?>">
            <a href="index.php?action=products&query=list&page=<?php echo $i ?><?php echo $searchValue != "" ? "&search=$searchValue" : "" ?>">
                <?php echo $i ?>
            </a>
        </div>
    <?php } ?>

    <!-- to previous page -->
    <div class="pagination-item <?php echo $currentPage == $pageLength ? "disabled" : "" ?>">
        <a href="index.php?action=products&query=list&page=<?php echo $nextPage ?><?php echo $searchValue != "" ? "&search=$searchValue" : "" ?>">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>

    <!-- to last page -->
    <div class="pagination-item">
        <a href="index.php?action=products&query=list&page=<?php echo $pageLength; ?><?php echo $searchValue != "" ? "&search=$searchValue" : "" ?>">
            <i class="fa-solid fa-angles-right"></i>
        </a>
    </div>
</div>