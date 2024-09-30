<?php
include("./config/connect.php");

if (isset($_GET['search']) && $_GET['search'] != "") {
    $searchValue = $_GET['search'];
    $sqlCus = "SELECT * FROM customer WHERE customer.cusName LIKE '%" . $searchValue . "%' ORDER BY customer.cusId DESC";
} else {
    $sqlCus = "SELECT * FROM customer  ORDER BY customer.cusId DESC";
}

$listCus = $mysqli->query($sqlCus);


?>

<div class="content-title">
    <h2>User list</h2>
    <form class="search-form" method="GET">
        <input type="text" placeholder="Search" name="search-user" required>
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

<div class="main-content">
    <div class="users-list">
        <div class="users-list-item heading">
            <div>Management</div>
            <div>Order</div>
            <div>Name</div>
            <div>Phone</div>
            <div>Sex</div>
            <div>Email</div>
            <div>Address</div>
            <div>Image</div>
        </div>
        <?php
        if ($listCus->num_rows > 0) {
            $i = 0;
            while ($cus = $listCus->fetch_object()) {
        ?>
                <div class="users-list-item <?php if ($i++ % 2 != 0) {
                                                echo "mark";
                                            } ?>">
                    <div>
                        <a href="?action=users&query=edit&editId=<?php echo $cus->cusId ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a> |
                        <a class="delete-user-btn" href="modules/cusManager/control.php?delete=<?php echo $cus->cusId ?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <div><?php echo $i ?></div>
                    <div><?php echo $cus->cusName ?></div>
                    <div><?php echo $cus->cusTel ?></div>
                    <div><?php echo $cus->cusGender == "m" ? "Male" : "Female" ?></div>
                    <div><?php echo $cus->cusMail ?></div>
                    <div><?php echo $cus->cusAddr ?></div>
                    <div><img width="50px" height="50px" style="object-fit: cover;border-radius: 50%;" src="upload/userAvt/<?php echo $cus->cusAvt ?>"></div>
                </div>
            <?php }
        } else { ?>
            <div style="text-align: center;grid-template-columns: 100%;font-weight:600;padding: 20px;font-size: 20px;" class="users-list-item">
                USER DOES NOT EXIST YET
            </div>
        <?php } ?>
    </div>
</div>

<script>
    const deleteUserBtn = document.querySelectorAll(".delete-user-btn");
    deleteUserBtn.forEach(btn => {
        btn.onclick = (e) => {
            if (!confirm("Are you sure you want to delete this user?")) {
                e.preventDefault()
            }
        }
    })
</script>