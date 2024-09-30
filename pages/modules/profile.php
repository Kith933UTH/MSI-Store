<?php
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
    $userSql = $mysqli->query("SELECT * FROM customer WHERE cusId = $userId LIMIT 1");
    if ($userSql->num_rows > 0) {
        $user = $userSql->fetch_object();
    }
} else {
    echo "<script>window.location.href = 'index.php'</script>";
}

$action = "update";
if (isset($_GET["profile"])) {
    $action = trim($_GET["profile"]);
}

if (isset($_SESSION["change-password"])) {
    if ($_SESSION["change-password"] == false) {
        echo "<script>alert('Your old password does not match! Try again.');</script>;";
    } else {
        unset($_SESSION["change-password"]);
        echo "<script>
                    alert('Password changed successfully.');
                    localStorage.removeItem('old-password');
                    localStorage.removeItem('new-password');
                    window.location.href = 'index.php?profile=update'
                </script>;";
    }
}

?>

<div class="main-content">

    <div class="profile-content">
        <div class="profile-select">
            <div class="profile-infor">
                <img class="profile-infor-avt" src="./admincp/upload/userAvt/<?php echo $user->cusAvt ?>" alt="Avt">
                <div class="profile-infor-name"><?php echo $user->cusName ?></div>
            </div>
            <ul class="profile-select-wrapper">
                <li class="profile-select-option <?php if ($action == 'update') {
                                                        echo "selected";
                                                    } ?>">
                    <a href="index.php?profile=update">My profile</a>
                </li>
                <li class="profile-select-option <?php if ($action == 'change-password') {
                                                        echo "selected";
                                                    } ?>">
                    <a href="index.php?profile=change-password">Change password</a>
                </li>
                <li class="profile-select-option <?php if ($action == 'order') {
                                                        echo "selected";
                                                    } ?>">
                    <a href="index.php?profile=order">My order</a>
                </li>
                <li class="profile-select-option">
                    <a href="./pages/control/customer-control.php?action=logout">Sign out</a>
                </li>
            </ul>
        </div>

        <div class="profile-main">
            <div class="profile-main-title">
                <?php if ($action == "update") { ?>
                    <div class="profile-title">
                        Profile of <span><?php echo $user->cusName ?></span>
                    </div>
                    <div class="profile-description">Change account information</div>
                <?php } else if ($action == "change-password") { ?>
                    <div class="profile-title">
                        Change password
                    </div>
                <?php } else if ($action == "order") { ?>
                    <div class="profile-title">
                        My order
                    </div>
                <?php } else { ?>
                    <div class="profile-title">
                        <span>Warning: the site is not secure</span>
                    </div>
                <?php } ?>
            </div>

            <!-- update information -->
            <?php if ($action == "update") { ?>
                <form class="profile-update-form" action="./admincp/modules/cusManager/main.php" method="POST" enctype="multipart/form-data">
                    <div class="profile-input-wrapper">
                        <div class="profile-input-infor">
                            <div class="input-box">
                                <span>Email:</span>
                                <div class="not-input"><?php echo $user->cusMail ?></div>
                            </div>
                            <div class="input-box">
                                <span>Full name:</span>
                                <div>
                                    <input type="text" id="profile-name" name="userName" value="<?php echo $user->cusName ?>" required />
                                    <label for="profile-name"><i class="fa-solid fa-pen-to-square"></i></label>
                                </div>
                            </div>
                            <div class="input-box">
                                <span>Phone number:</span>
                                <div>
                                    <input type="tel" id="profile-tel" pattern="[0-9]{10}" name="userTel" value="<?php echo $user->cusTel ?>" required />
                                    <label for="profile-tel"><i class="fa-solid fa-pen-to-square"></i></label>
                                </div>
                            </div>
                            <div class="input-box">
                                <span>Address:</span>
                                <div>
                                    <input type="text" id="profile-addr" name="userAddr" value="<?php echo $user->cusAddr ?>" required />
                                    <label for="profile-addr"><i class="fa-solid fa-pen-to-square"></i></label>
                                </div>
                            </div>

                            <div class="input-box">
                                <span>Sex:</span>
                                <div class="user-gender">
                                    <input type="radio" name="userGender" id="genderMale" value="m" <?php if ($user->cusGender == "m") echo "checked" ?> />
                                    <label for="genderMale">Male</label>
                                    <input type="radio" name="userGender" id="genderFemale" value="f" <?php if ($user->cusGender == "f") echo "checked" ?> />
                                    <label for="genderFemale">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="profile-input-img">
                            <img id="avt-tmp" class="profile-avt" src="./admincp/upload/userAvt/<?php echo $user->cusAvt ?>" alt="Avt">
                            <input id="profile-avt" accept=".jpg,.jpeg,.png" type="file" name="userAvt" />
                            <div class="chang-avt-btn-wrapper">
                                <label class="change-avt-btn" for="profile-avt">Change avatar</label>
                                <label id="reset-avt-btn" class="change-avt-btn reset"><i class="fa-solid fa-rotate-left"></i></label>
                            </div>
                            <p>Maximum file size is 1 MB</p>
                            <p>Accept: .JPEG, .PNG</p>
                        </div>

                    </div>
                    <button type="submit" id="save-submit" class="disable" name="action" value="update">Save</button>
                </form>

                <!-- change password  -->
            <?php } else if ($action == "change-password") { ?>
                <form class="profile-update-form" id="change-password-form" action="./admincp/modules/cusManager/main.php" method="POST">
                    <div class="profile-input-wrapper">
                        <div class="profile-input-infor change-password">
                            <div class="input-box">
                                <label for="old-password">Old password:</label>
                                <div>
                                    <input type="password" id="old-password" name="old-password" required />
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="new-password">New password:</label>
                                <div>
                                    <input type="password" id="new-password" name="new-password" required />
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="confirm-new-password">Confirm new password:</label>
                                <div>
                                    <input type="password" id="confirm-new-password" required />
                                </div>
                            </div>
                            <div class="input-box">
                                <div></div>
                                <p class="error-mes" id="error-mes">Mật khẩu không khớp</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="" name="action" value="change-password">Save</button>
                </form>
            <?php } else if ($action == "order") { ?>
                <div style="font-size: 3rem; color: red; padding: 2rem;">You don't have any orders yet.</div>
            <?php } else {
                echo "<div style='font-size: 3rem; color: white; padding: 2rem;'>This page is not available.</div>";
            } ?>

        </div>
    </div>
</div>