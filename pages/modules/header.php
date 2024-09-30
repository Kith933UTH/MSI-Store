<?php
$userAvt = "";
$userName = "";
if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user'];
  $userSql = $mysqli->query("SELECT cusName, cusAvt FROM customer WHERE cusId = $userId LIMIT 1");
  if ($userSql->num_rows > 0) {
    $user = $userSql->fetch_object();
    $userAvt = $user->cusAvt;
    $userName = $user->cusName;
  }
}

?>

<?php if (isset($_GET["category"])) { ?>
  <header class="header-category">
    <?php if (isset($_GET["category"])) { ?>
      <div class="header-img" style="background-image: url('./assets/img/category1.jpeg')"></div>
    <?php } ?>
    <div>
      <a class="logo" href="index.php">Home</a>

      <ul class="navbar">
        <li class="navbar-item sub-menu-holder">
          <a href="?category=all">Category</a>
          <ul class="category-list sub-menu">
            <li class="category-list-item">
              <a href="?category=all">All</a>
              <p class="category-item-desc">All Laptop In Store</p>
            </li>
            <?php
            $sql = "SELECT categoryId, categoryName, categoryDesc FROM category ORDER BY categoryOrder";
            $list = $mysqli->query($sql);
            while ($row = $list->fetch_object()) {
            ?>
              <li class="category-list-item">
                <a href="?category=<?php echo $row->categoryId ?>"><?php echo $row->categoryName ?></a>
                <p class="category-item-desc"><?php echo $row->categoryDesc ?></p>
              </li>
            <?php } ?>
          </ul>
        </li>
        <!-- <li class="navbar-item">
              <a href="#hightlight-product">Mới nhất</a>
            </li> -->
        <li class="navbar-item"><a href="index.php?contact">Contact</a></li>
        <li class="navbar-item"><a href="index.php?warranty">Warranty</a></li>
        <li class="navbar-item"><a href="index.php?about">About Us</a></li>
      </ul>

      <div class="header-icon">
        <div class="header-icon-item">
          <button id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
          <form action="./pages/control/search-control.php" method="GET" class="search-form" id="search-form">
            <input spellcheck="false" type="text" class="search-input" placeholder="Input keyword to search..." name="keyword" required />
            <button type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>
        <a id="cart" class="header-icon-item" href="?cart">
          <i class="fa-solid fa-bag-shopping"></i>
          <?php
          if (isset($_SESSION["cart"])) {
            $cartList = $_SESSION["cart"];
            $quantity = 0;
            foreach ($cartList as $cartItem) {
              $quantity = $quantity + $cartItem->proQuantity;
            }
            if ($quantity > 0) {
          ?>
              <span><?php echo $quantity ?></span>
          <?php }
          } ?>
        </a>

        <?php if (isset($_SESSION["user"])) { ?>
          <div class="header-icon-item sub-menu-holder" id="user">
            <a href="index.php?profile=update">
              <?php if ($userAvt != "") {
              ?>
                <img id="avt" src="./admincp/upload/userAvt/<?php echo $userAvt ?>" alt="avt">
              <?php } else { ?>
                <i class="fa-regular fa-user"></i>
              <?php } ?>
              <?php if ($userName != "") { ?>
                <div class="user-name"><?php echo $userName ?></div>
              <?php } ?>
              <ul class="category-list sub-menu">
                <?php if (isset($_SESSION["user"])) { ?>
                  <li class="category-list-item"><a href="index.php?profile=update">See my profile</a></li>
                  <li class="category-list-item"><a href="./pages/control/customer-control.php?action=logout">Sign out</a></li>
                <?php } else { ?>
                  <li class="category-list-item" id="login-btn">Sign in</li>
                  <li class="category-list-item" id="register-btn">Create an account</li>
                <?php } ?>
              </ul>
            </a>
          </div>
        <?php } else { ?>
          <div class="header-icon-item sub-menu-holder" id="user">
            <?php if ($userAvt != "") {
            ?>
              <img id="avt" src="./admincp/upload/userAvt/<?php echo $userAvt ?>" alt="avt">
            <?php } else { ?>
              <i class="fa-regular fa-user"></i>
            <?php } ?>
            <?php if ($userName != "") { ?>
              <div class="user-name"><?php echo $userName ?></div>
            <?php } ?>
            <ul class="category-list sub-menu">
              <?php if (isset($_SESSION["user"])) { ?>
                <li class="category-list-item"><a href="index.php?profile=update">See my profile</a></li>
                <li class="category-list-item"><a href="./pages/control/customer-control.php?action=logout">Sign out</a></li>
              <?php } else { ?>
                <li class="category-list-item" id="login-btn">Sign in</li>
                <li class="category-list-item" id="register-btn">Create an account</li>
              <?php } ?>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
  </header>
<?php } else { ?>
  <header class="header">
    <div>
      <a class="logo" href="index.php"></a>

      <ul class="navbar">
        <li class="navbar-item sub-menu-holder">
          <a href="?category=all">Category</a>
          <ul class="category-list sub-menu">
            <li class="category-list-item">
              <a href="?category=all">All</a>
              <p class="category-item-desc">All Laptop In Store</p>
            </li>
            <?php
            $sql = "SELECT categoryId, categoryName, categoryDesc FROM category ORDER BY categoryOrder";
            $list = $mysqli->query($sql);
            while ($row = $list->fetch_object()) {
            ?>
              <li class="category-list-item">
                <a href="?category=<?php echo $row->categoryId ?>"><?php echo $row->categoryName ?></a>
                <p class="category-item-desc"><?php echo $row->categoryDesc ?></p>
              </li>
            <?php } ?>
          </ul>
        </li>
        <!-- <li class="navbar-item">
              <a href="#hightlight-product">Mới nhất</a>
            </li> -->
        <li class="navbar-item"><a href="index.php?contact">Contact</a></li>
        <li class="navbar-item"><a href="index.php?warranty">Warranty</a></li>
        <li class="navbar-item"><a href="index.php?about">About Us</a></li>
      </ul>

      <div class="header-icon">
        <div class="header-icon-item">
          <button id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
          <form action="./pages/control/search-control.php" method="GET" class="search-form" id="search-form">
            <input spellcheck="false" type="text" class="search-input" placeholder="Input keyword to search..." name="keyword" required />
            <button type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>
        <a id="cart" class="header-icon-item" href="?cart">
          <i class="fa-solid fa-bag-shopping"></i>
          <?php
          if (isset($_SESSION["cart"])) {
            $cartList = $_SESSION["cart"];
            $quantity = 0;
            foreach ($cartList as $cartItem) {
              $quantity = $quantity + $cartItem->proQuantity;
            }
            if ($quantity > 0) {
          ?>
              <span><?php echo $quantity ?></span>
          <?php }
          } ?>
        </a>

        <?php if (isset($_SESSION["user"])) { ?>
          <div class="header-icon-item sub-menu-holder" id="user">
            <a href="index.php?profile=update">
              <?php if ($userAvt != "") {
              ?>
                <img id="avt" src="./admincp/upload/userAvt/<?php echo $userAvt ?>" alt="avt">
              <?php } else { ?>
                <i class="fa-regular fa-user"></i>
              <?php } ?>
              <?php if ($userName != "") { ?>
                <div class="user-name"><?php echo $userName ?></div>
              <?php } ?>
              <ul class="category-list sub-menu">
                <?php if (isset($_SESSION["user"])) { ?>
                  <li class="category-list-item"><a href="index.php?profile=update">See my profile</a></li>
                  <li class="category-list-item"><a href="./pages/control/customer-control.php?action=logout">Sign out</a></li>
                <?php } else { ?>
                  <li class="category-list-item" id="login-btn">Sign in</li>
                  <li class="category-list-item" id="register-btn">Create an account</li>
                <?php } ?>
              </ul>
            </a>
          </div>
        <?php } else { ?>
          <div class="header-icon-item sub-menu-holder" id="user">
            <?php if ($userAvt != "") {
            ?>
              <img id="avt" src="./admincp/upload/userAvt/<?php echo $userAvt ?>" alt="avt">
            <?php } else { ?>
              <i class="fa-regular fa-user"></i>
            <?php } ?>
            <?php if ($userName != "") { ?>
              <div class="user-name"><?php echo $userName ?></div>
            <?php } ?>
            <ul class="category-list sub-menu">
              <?php if (isset($_SESSION["user"])) { ?>
                <li class="category-list-item"><a href="index.php?profile=update">See my profile</a></li>
                <li class="category-list-item"><a href="./pages/control/customer-control.php?action=logout">Sign out</a></li>
              <?php } else { ?>
                <li class="category-list-item" id="login-btn">Sign in</li>
                <li class="category-list-item" id="register-btn">Create an account</li>
              <?php } ?>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
  </header>
<?php } ?>