//filter
const filters = document.querySelectorAll(".filter-form .filter-item");
const filterForm = document.getElementById("filter-form");
const clearFilterBtn = document.getElementById("clear-filter");
let min = 5000000;
let max = 150000000;

function check(list) {
  let check = "";
  list.forEach((item) => {
    if (item.checked == true && check == "") {
      check += item.nextElementSibling.innerText;
    } else if (item.checked == true && check != "") {
      check += ", " + item.nextElementSibling.innerText;
    }
  });
  return check;
}

function checkRange(list) {
  let check = ["", ""];
  list.forEach((item) => {
    if (item.id == "rangeMin") {
      check[0] = item.value;
    }
    if (item.id == "rangeMax") {
      check[1] = item.value;
    }
    if ((check[0] == item.min && check[1]) == item.max) check = null;
  });
  return check == null
    ? ""
    : check.map((value) => value / 1000000 + "M").join(" - ");
}

function formatMoney(number, decSep) {
  if (number < 1000) return number;
  let string = "";
  (number + "")
    .split("")
    .reverse()
    .forEach((item, index) => {
      if (index != 0 && index % 3 === 0) {
        string = item + decSep + string;
      } else {
        string = item + string;
      }
    });
  return string;
}

function calcLeftPosition(value) {
  return ((150000000 / (150000000 - 5000000)) * (value - 5000000)) / 1500000;
}

function setFilter() {
  const filtersJSON = JSON.parse(localStorage.getItem("filters"));
  if (filtersJSON) {
    filtersJSON.forEach((item) => {
      if (Object.keys(item)[0].toString() == "rangeMin") {
        document.getElementById(Object.keys(item)[0].toString()).value =
          Object.values(item)[0];
        document.getElementById("thumbMin").style.left =
          calcLeftPosition(parseInt(Object.values(item)[0])) + "%";
        document.getElementById("min").innerHTML =
          formatMoney(parseInt(Object.values(item)[0]), ".") + "đ";
        min = parseInt(Object.values(item)[0]);
        document.getElementById("line").style.left =
          calcLeftPosition(min) + "%";
      } else if (Object.keys(item)[0].toString() == "rangeMax") {
        document.getElementById(Object.keys(item)[0].toString()).value =
          Object.values(item)[0];
        document.getElementById("thumbMax").style.left =
          calcLeftPosition(parseInt(Object.values(item)[0])) + "%";
        document.getElementById("max").innerHTML =
          formatMoney(parseInt(Object.values(item)[0]), ".") + "đ";
        max = parseInt(Object.values(item)[0]);
        document.getElementById("line").style.right =
          100 - calcLeftPosition(max) + "%";
      } else {
        document.getElementById(Object.keys(item)[0].toString()).checked =
          Object.values(item)[0];
      }
    });
  }

  // filters.forEach((item) => {
  //   const inputs = item.querySelectorAll("input[type='checkbox']");
  //   const radios = item.querySelectorAll("input[type='radio']");
  //   const ranges = item.querySelectorAll("input[type='range']");
  //   const defaultValue = item.querySelector(".filter-item-title").innerHTML;
  //   inputs.forEach((input) => {
  //     let value = check(inputs);
  //     if (value) {
  //       item.querySelector(".filter-item-title").innerHTML = value;
  //       item.classList.add("active");
  //     } else {
  //       item.querySelector(".filter-item-title").innerHTML = defaultValue;
  //       item.classList.remove("active");
  //     }
  //   });

  //   if (ranges) {
  //     ranges.forEach((input) => {
  //       let value = checkRange(ranges);
  //       if (value) {
  //         item.querySelector(".filter-item-title").innerHTML = value;
  //         item.classList.add("active");
  //       } else {
  //         item.querySelector(".filter-item-title").innerHTML = defaultValue;
  //         item.classList.remove("active");
  //       }
  //     });
  //   }

  //   if (radios) {
  //     radios.forEach((input) => {
  //       let value = check(radios);
  //       if (value && value != "Default") {
  //         item.querySelector(".filter-item-title").innerHTML = value;
  //         item.classList.add("active");
  //       } else {
  //         item.querySelector(".filter-item-title").innerHTML = defaultValue;
  //         item.classList.remove("active");
  //       }
  //     });
  //   }
  // });
}
function saveFilter(e) {
  const valuesChecked = [];
  e.querySelectorAll("input").forEach((input) => {
    let tmp = {};
    if (input.id == "rangeMin" || input.id == "rangeMax") {
      tmp[`${input.id}`] = input.value;
    } else {
      tmp[`${input.id}`] = input.checked;
    }
    valuesChecked.push(tmp);
  });
  localStorage.setItem("filters", JSON.stringify(valuesChecked));
}

function clearFilter() {
  localStorage.removeItem("filters");
  setFilter();
}

$("#rangeMin").on("input", function (e) {
  const newValue = parseInt(e.target.value);
  if (newValue > max) {
    return;
  }
  min = newValue;
  document.getElementById("thumbMin").style.left =
    calcLeftPosition(newValue) + "%";

  document.getElementById("min").innerHTML = formatMoney(newValue, ".") + "đ";
  document.getElementById("line").style.left = calcLeftPosition(newValue) + "%";
  document.getElementById("line").style.right =
    100 - calcLeftPosition(max) + "%";
  // $("#thumbMin").css("left", calcLeftPosition(newValue) + "%");
  // $("#min").html(formatMoney(newValue, ".") + "đ");
  // $("#line").css({
  //   left: calcLeftPosition(newValue) + "%",
  //   right: 100 - calcLeftPosition(max) + "%",
  // });
});

$("#rangeMax").on("input", function (e) {
  const newValue = parseInt(e.target.value);
  if (newValue < min) {
    return;
  }
  max = newValue;
  document.getElementById("thumbMax").style.left =
    calcLeftPosition(newValue) + "%";
  document.getElementById("max").innerHTML = formatMoney(newValue, ".") + "đ";
  document.getElementById("line").style.left = calcLeftPosition(min) + "%";
  document.getElementById("line").style.right =
    100 - calcLeftPosition(newValue) + "%";
});

filters.forEach((item) => {
  const inputs = item.querySelectorAll("input[type='checkbox']");
  const radios = item.querySelectorAll("input[type='radio']");
  const ranges = item.querySelectorAll("input[type='range']");
  // const defaultValue = item.querySelector(".filter-item-title").innerHTML;
  inputs.forEach((input) => {
    input.addEventListener("change", (e) => {
      // let value = check(inputs);
      // if (value) {
      //   item.querySelector(".filter-item-title").innerHTML = value;
      //   item.classList.add("active");
      // } else {
      //   item.querySelector(".filter-item-title").innerHTML = defaultValue;
      //   item.classList.remove("active");
      // }
      saveFilter(filterForm);
    });
  });

  if (ranges) {
    ranges.forEach((input) => {
      input.addEventListener("input", (e) => {
        // let value = checkRange(ranges);
        // if (value) {
        //   item.querySelector(".filter-item-title").innerHTML = value;
        //   item.classList.add("active");
        // } else {
        //   item.querySelector(".filter-item-title").innerHTML = defaultValue;
        //   item.classList.remove("active");
        // }
        saveFilter(filterForm);
      });
    });
  }

  if (radios) {
    radios.forEach((input) => {
      input.addEventListener("change", (e) => {
        // let value = check(radios);
        // if (value && value != "Default") {
        //   item.querySelector(".filter-item-title").innerHTML = value;
        //   item.classList.add("active");
        // } else {
        //   item.querySelector(".filter-item-title").innerHTML = defaultValue;
        //   item.classList.remove("active");
        // }
        saveFilter(filterForm);
      });
    });
  }
});

clearFilterBtn.addEventListener("click", (e) => {
  clearFilter();
});

window.addEventListener("load", () => {
  setFilter();
});

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
