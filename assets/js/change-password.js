const oldPasswordInput = document.getElementById("old-password");
const newPasswordInput = document.getElementById("new-password");
const confirmPasswordInput = document.getElementById("confirm-new-password");

const formChangePassword = document.getElementById("change-password-form");

const setLocal = (e) => {
  localStorage.setItem(e.id, e.value);
};

const clearLocal = (key) => {
  localStorage.removeItem(key);
};

const showErrorMess = (mes, show = true) => {
  const errorMesElement = document.getElementById("error-mes");
  if (show) {
    errorMesElement.innerHTML = mes;
    errorMesElement.style.display = "block";
  } else {
    errorMesElement.style.display = "none";
  }
};

[newPasswordInput, confirmPasswordInput].forEach((item) => {
  item.addEventListener("input", () => {
    if (!checkMatchNewPass(newPasswordInput, confirmPasswordInput)) {
      showErrorMess("Confirmation password does not match!");
    } else {
      showErrorMess("", false);
    }
  });
});

const checkMatchNewPass = (pass, confirmPass) => {
  return pass.value == confirmPass.value;
};

formChangePassword.onsubmit = () => {
  setLocal(oldPasswordInput);
  setLocal(newPasswordInput);
};

window.onload = () => {
  oldPasswordInput.value = localStorage.getItem(oldPasswordInput.id);
  newPasswordInput.value = localStorage.getItem(newPasswordInput.id);
  confirmPasswordInput.value = localStorage.getItem(newPasswordInput.id);
  clearLocal(oldPasswordInput.id);
  clearLocal(newPasswordInput.id);
};
