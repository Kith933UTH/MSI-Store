//Login/register
const loginBtn = document.getElementById("login-btn");
const registerBtn = document.getElementById("register-btn");
const overLay = document.querySelectorAll(".overlay");
const loginContainer = document.getElementById("login-container");
const registerContainer = document.getElementById("register-container");
const switchToLoginBtn = document.getElementById("switch-to-login");
const switchToRegisterBtn = document.getElementById("switch-to-register");
const loginCancelBtn = document.querySelector(
  ".login-full-container .login-container .login-cancel"
);
const registerCancelBtn = document.querySelector(
  ".register-full-container .register-container .register-cancel"
);

const avtInput = document.getElementById("avt");

function activation(container, remove = false) {
  if (remove === false) {
    container.classList.add("active");
  } else if (container.classList.contains("active")) {
    container.classList.remove("active");
  }
}

//show
if (registerBtn && registerContainer) {
  registerBtn.addEventListener("click", () => activation(registerContainer));
}

if (loginBtn && loginContainer) {
  loginBtn.addEventListener("click", () => activation(loginContainer));
}

//cancel
if (loginCancelBtn && loginContainer) {
  loginCancelBtn.addEventListener("click", () =>
    activation(loginContainer, true)
  );
}
if (registerCancelBtn && loginContainer) {
  registerCancelBtn.addEventListener("click", () =>
    activation(registerContainer, true)
  );
}

//switch to
if (switchToRegisterBtn && loginContainer) {
  switchToRegisterBtn.addEventListener("click", () => {
    activation(loginContainer, true);
    activation(registerContainer);
  });
}

if (switchToLoginBtn && registerContainer) {
  switchToLoginBtn.addEventListener("click", () => {
    activation(registerContainer, true);
    activation(loginContainer);
  });
}

if (overLay) {
  overLay.forEach((item) => {
    item.addEventListener("click", () => {
      activation(loginContainer, true);
      activation(registerContainer, true);
    });
  });
}

//check password
function checkPassword() {
  if (
    document.getElementById("passWord").value ==
    document.getElementById("confirmPassword").value
  ) {
    document.getElementById("passMess").style.display = "none";
    document.getElementById("registerBtn").classList.remove("disable");
  } else {
    document.getElementById("passMess").style.display = "block";
    document.getElementById("registerBtn").classList.add("disable");
  }
}

avtInput.onchange = (evt) => {
  const [file] = avtInput.files;
  if (file) {
    document.getElementById("avt-register-img").style.display = "block";
    document.getElementById("avt-register-img").src = URL.createObjectURL(file);
  }
};
