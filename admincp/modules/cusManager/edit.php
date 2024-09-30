<?php
include("config/connect.php");
$editId = $_GET["editId"];
$sqlGetUser = "SELECT * FROM customer WHERE cusId = $editId LIMIT 1";
$user = $mysqli->query($sqlGetUser)->fetch_object();
?>

<h2 class="content-title">Edit user profile</h2>

<div class="main-content">
    <form method="POST" class="user-form" action="modules/cusManager/control.php" enctype="multipart/form-data">
        <div class="form-item-wrapper">
            <div class="form-item">
                <label for="">Full name: </label>
                <input type="text" name="cusName" placeholder="Ex: John Doe" required value="<?php echo $user->cusName ?>" />
            </div>

            <div class="form-item">
                <label for="">Phone number: </label>
                <input type="tel" pattern="[0-9]{10}" name="cusTel" placeholder="Ex: 0811004003" required value="<?php echo $user->cusTel ?>" />
            </div>

            <div class="form-item">
                <label for="">Email: </label>
                <input type="email" name="cusMail" placeholder="Ex: kith933@contact.msi" required value="<?php echo $user->cusMail ?>" />
            </div>

            <div class="form-item">
                <label for="">Address: </label>
                <input type="text" name="cusAddr" placeholder="Ex: District 12, Ho Chi Minh City" required value="<?php echo $user->cusAddr ?>" />
            </div>

            <div class="form-item">
                <label for="">Password (leave blank to use current password): </label>
                <input type="password" name="cusPassword" placeholder="Your password" />
            </div>

            <div class="form-item form-avt">
                <label for="">Avatar: </label>
                <div>
                    <input type="file" style="padding: 0;" accept="image/*" name="cusAvt" id="input-avt">
                    <label for="input-avt">Choose image</label>
                    <img width="100px" style="display: block;" src="upload/userAvt/<?php echo $user->cusAvt ?>" id="input-avt-tmp">
                </div>
            </div>

            <div class="form-item form-radio">
                <label for="" style="margin-bottom: 16px; display: block;">Sex: </label>
                <div class="radio-wrapper">
                    <input type="radio" name="cusGender" id="m" value="m" <?php echo $user->cusGender == "m" ? "checked" : "" ?> />
                    <label for="m">Male</label>
                </div>
                <div class="radio-wrapper">
                    <input type="radio" name="cusGender" id="f" value="f" <?php echo $user->cusGender == "f" ? "checked" : "" ?> />
                    <label for="f">Female</label>
                </div>
            </div>
        </div>

        <button type="submit" name="edit" value="<?php echo $editId ?>">Submit</button>
    </form>

</div>