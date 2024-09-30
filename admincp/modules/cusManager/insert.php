<h2 class="content-title">Add a user</h2>

<div class="main-content">
    <form method="POST" class="user-form" action="modules/cusManager/control.php" enctype="multipart/form-data">
        <div class="form-item-wrapper">
            <div class="form-item">
                <label for="">Full name</label>
                <input type="text" name="cusName" placeholder="Ex: John Doe" required />
            </div>

            <div class="form-item">
                <label for="">Phone number</label>
                <input type="tel" pattern="[0-9]{10}" name="cusTel" placeholder="Ex: 0811004003" required />
            </div>

            <div class="form-item">
                <label for="">Email</label>
                <input type="email" name="cusMail" placeholder="Ex: kith933@contact.msi" required />
            </div>

            <div class="form-item">
                <label for="">Address</label>
                <input type="text" name="cusAddr" placeholder="Ex: District 12, Ho Chi Minh City" required />
            </div>

            <div class="form-item">
                <label for="">Password</label>
                <input type="password" name="cusPassword" placeholder="Your password" required />
            </div>

            <div class="form-item form-avt">
                <label for="">Avatar </label>
                <div>
                    <input type="file" style="padding: 0;" accept="image/*" id="input-avt" name="cusAvt" required>
                    <label for="input-avt">Choose image</label>
                    <img width="100px" id="input-avt-tmp" src="upload/userAvt/default-user-avt.png">
                </div>
            </div>

            <div class="form-item form-radio">
                <label for="" style="margin-bottom: 8px; display: block;">Sex: </label>
                <div class="radio-wrapper">
                    <input type="radio" name="cusGender" id="m" value="m" checked />
                    <label for="m">Male</label>
                </div>
                <div class="radio-wrapper">
                    <input type="radio" name="cusGender" id="f" value="f" />
                    <label for="f">Female</label>
                </div>
            </div>
        </div>

        <button type="submit" name="insert">Submit</button>
    </form>
</div>