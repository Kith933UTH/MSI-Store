<div class="login-full-container" id="login-container">
    <div class="overlay"></div>
    <div class="login-container">
        <div class="login-title">Sign in</div>
        <div class="login-cancel"><i class="fa-solid fa-xmark"></i></div>
        <div class="login-content">
        <form action="./pages/control/customer-control.php" method="POST">
            <div class="user-details">
            <div class="input-box">
                <span class="details">Email</span>
                <input type="email" id="cusMailLogin" name="cusMail" placeholder="Your email" required />
            </div>
            <div class="input-box">
                <span class="details">Password</span>
                <input type="password" name="cusPassword" placeholder="Your password" required />
            </div>
            </div>
            <div class="button">
            <button type="submit" id="loginBtn" name="action" value="login">Login</button>
            </div>
        </form>
        </div>
        <div class="switch">
        Haven't had an account before?
        <label id="switch-to-register">Create an account now!</label>
        </div>
    </div>
</div>