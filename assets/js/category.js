// const proList = document.querySelectorAll(".category-product .product-item");
// const showMoreBtn = document.getElementById("show-more-btn");
// let maxNumPro = 6;
// let productRemain = proList.length - maxNumPro;

// const showProduct = function (max) {
//   proList.forEach((item, index) => {
//     if (index > max - 1) {
//       item.style.display = "none";
//     } else {
//       item.style.display = "flex";
//     }
//   });
//   if (productRemain > 0) {
//     showMoreBtn.style.display = "block";
//     showMoreBtn.innerText = "Show more " + productRemain + " laptops";
//   } else {
//     showMoreBtn.style.display = "none";
//   }
// };

// const handleShowMoreClick = function () {
//   maxNumPro += 6;
//   productRemain -= 6;
//   showProduct(maxNumPro);
// };

// showMoreBtn.addEventListener("click", handleShowMoreClick);
// showProduct(maxNumPro);

// const $ = document.getElementById.bind(document);
// const $$ = document.querySelectorAll.bind(document);

const proList = document.querySelectorAll(".category-product .product-item");
const prevBtn = document.getElementById("page-prev");
const nextBtn = document.getElementById("page-next");
const selectPageWrapper = document.getElementById("page-items-wrapper");

const maxNumPro = 9;
let currentPage = 1;
const pagesNum = Math.ceil(proList.length / maxNumPro);

const showProduct = (pageNumber) => {
  proList.forEach((pro, index) => {
    if (
      index >= (pageNumber - 1) * maxNumPro &&
      index < pageNumber * maxNumPro
    ) {
      pro.style.display = "flex";
    } else {
      pro.style.display = "none";
    }
  });
  window.scrollTo({ top: 0, behavior: "smooth" });
};

const showSelectPage = (index) => {
  let html = "";
  for (let i = 1; i <= pagesNum; i++) {
    if (i == index) {
      html += `<div class="page-item">
                <label class="selected" value="${i}">${i}</label>
              </div>`;
    } else {
      html += `<div class="page-item">
                <label value="${i}">${i}</label>
              </div>`;
    }
  }
  selectPageWrapper.innerHTML = html;
};

const setSelectedPage = (select) => {
  selectPageWrapper.querySelectorAll("label").forEach((input) => {
    if (parseInt(input.getAttribute("value")) == select) {
      input.classList.add("selected");
    } else {
      input.classList.remove("selected");
    }
  });
};

const checkedPageButton = () => {
  if (currentPage == 1) {
    prevBtn.classList.add("disable");
    nextBtn.classList.remove("disable");
  } else if (currentPage == pagesNum) {
    nextBtn.classList.add("disable");
    prevBtn.classList.remove("disable");
  } else {
    prevBtn.classList.remove("disable");
    nextBtn.classList.remove("disable");
  }
};

const handleChangePage = () => {
  const pageInputs = selectPageWrapper.querySelectorAll("label");
  pageInputs.forEach((input) => {
    input.addEventListener("click", (e) => {
      currentPage = parseInt(e.target.getAttribute("value"));
      showProduct(currentPage);
      checkedPageButton();
      setSelectedPage(currentPage);
    });
  });
  prevBtn.addEventListener("click", () => {
    currentPage -= 1;
    showProduct(currentPage);
    checkedPageButton();
    setSelectedPage(currentPage);
  });
  nextBtn.addEventListener("click", () => {
    currentPage += 1;
    showProduct(currentPage);
    checkedPageButton();
    setSelectedPage(currentPage);
  });
};

window.onload = () => {
  showSelectPage(1);
  handleChangePage();
  showProduct(1);
  checkedPageButton();
};
