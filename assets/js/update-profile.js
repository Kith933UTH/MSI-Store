const imgInp = document.getElementById("profile-avt");
const blah = document.getElementById("avt-tmp");
const oldAvt = blah.src;
const resetAvtBtn = document.getElementById("reset-avt-btn");
const saveSubmitBtn = document.getElementById("save-submit");

const userNameInput = document.getElementById("profile-name");
const userAddrInput = document.getElementById("profile-addr");
const userTelInput = document.getElementById("profile-tel");
const userMaleRadio = document.getElementById("genderMale");
const userFemaleRadio = document.getElementById("genderFemale");

const checkList = [
  { element: userNameInput, value: userNameInput.value },
  { element: userAddrInput, value: userAddrInput.value },
  { element: userTelInput, value: userTelInput.value },
  { element: userMaleRadio, value: userMaleRadio.checked },
  { element: userFemaleRadio, value: userFemaleRadio.checked },
  { element: imgInp, value: blah.src },
];

// console.log(checkList);

checkList.forEach((item, index, list) => {
  item.element.addEventListener("change", () => {
    setSaveBtnStatus(list);
  });
});

const setSaveBtnStatus = (list) => {
  if (isInputChanged(list)) {
    saveSubmitBtn.classList.remove("disable");
  } else {
    saveSubmitBtn.classList.add("disable");
  }
};

const isInputChanged = (list) => {
  let changed = false;
  list.forEach((item) => {
    if (
      (item.element.type == "text" || item.element.type == "tel") &&
      !changed
    ) {
      changed = item.element.value != item.value;
    }
    if (item.element.type == "radio" && !changed) {
      changed = item.element.checked != item.value;
    }
    if (item.element.type == "file" && !changed) {
      changed = item.element.value != "";
    }
  });
  return changed;
};

const checkChangeAvt = (bool) => {
  if (bool) {
    resetAvtBtn.style.display = "block";
  } else {
    resetAvtBtn.style.display = "none";
    imgInp.value = null;
    blah.src = oldAvt;
  }
};

resetAvtBtn.onclick = () => {
  checkChangeAvt(false);
  setSaveBtnStatus(checkList);
};
imgInp.onchange = (evt) => {
  const [file] = imgInp.files;
  if (file) {
    blah.src = URL.createObjectURL(file);
  }
  checkChangeAvt(blah.src != oldAvt);
};
