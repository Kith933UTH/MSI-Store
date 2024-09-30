<div class="register-full-container" id="register-container">
  <div class="overlay"></div>
  <div class="register-container">
    <div class="register-title">Create an account</div>
    <div class="register-cancel"><i class="fa-solid fa-xmark"></i></div>
    <div class="register-content">
      <form action="./pages/control/customer-control.php" method="POST" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full name</span>
            <input type="text" name="cusName" placeholder="Ex: John Doe" required />
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="cusMail" placeholder="Ex: kith933@contact.msi" required />
          </div>
          <div class="input-box">
            <span class="details">Phone number</span>
            <input type="tel" pattern="[0-9]{10}" name="cusTel" placeholder="Ex: 0811004003" required />
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="cusAddr" placeholder="Ex: District 12, Ho Chi Minh City" required />
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" onkeyup="checkPassword()" name="cusPassword" id="passWord" placeholder="Your password" required />
          </div>
          <div class="input-box">
            <span class="details">Confirm password</span>
            <input type="password" id="confirmPassword" placeholder="Your password again" onkeyup="checkPassword()" required />
            <span id="passMess" style="padding:1rem;font-size:var(--small-size);color:red;display:none;">Password incorrect</span>
          </div>
          <div class="input-box">
            <span class="details">Avatar</span>
            <img id="avt-register-img" src="#" alt="your image" />
            <label id="choose-avt-button" for="avt">Choose image</label>
            <input type="file" id="avt" name="cusAvt" accept="image/*" required style="display:none;" />
          </div>
          <div class="gender-details">
            <input type="radio" name="cusGender" id="dot-1" value="m" checked />
            <input type="radio" name="cusGender" id="dot-2" value="f" />
            <span class="gender-title">Sex</span>
            <div class="category">
              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
              </label>
            </div>
          </div>
        </div>

        <div class="button">
          <button type="submit" id="registerBtn" name="action" value="register">Create now</button>
        </div>
      </form>
    </div>
    <div class="switch">
      Already have an account? <label id="switch-to-login">Sign in now!</label>
    </div>
  </div>
</div>