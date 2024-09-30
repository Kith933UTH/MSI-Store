const listDeliveryInput = document.querySelectorAll(
  ".delivery-infor-content form .input-box input:not(input[type='submit'])"
);

window.onload = () => {
  listDeliveryInput.forEach((item) => {
    if (item.value == "") {
      item.classList.remove("has-value");
    } else {
      item.classList.add("has-value");
    }
  });
};

listDeliveryInput.forEach((item) => {
  item.value = getSavedValue(item.id.toString());
  item.addEventListener("focusout", (e) => {
    if (e.target.value == "") {
      e.target.classList.remove("has-value");
    } else {
      e.target.classList.add("has-value");
    }
  });
});

function saveValue(e) {
  var id = e.id;
  var val = e.value;
  localStorage.setItem(id, val);
}

function getSavedValue(v) {
  if (!localStorage.getItem(v)) {
    return "";
  }
  return localStorage.getItem(v);
}
