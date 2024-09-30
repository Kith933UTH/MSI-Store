const imageWrapper = document.querySelector(".slider-wrapper");
const imageItems = document.querySelectorAll(".slider-wrapper > *");
const imageLength = imageItems.length;
const perView = 1;
let totalScroll = 0;
const delay = 3000;

imageWrapper.style.setProperty("--per-view", perView);
for (let i = 0; i < perView; i++) {
  imageWrapper.insertAdjacentHTML("beforeend", imageItems[i].outerHTML);
}
let autoScroll = setInterval(scrolling, delay);
function scrolling() {
  totalScroll++;
  if (totalScroll == imageLength + 1) {
    clearInterval(autoScroll);
    totalScroll = 1;
    imageWrapper.style.transition = "0s";
    imageWrapper.style.left = "0px";
    autoScroll = setInterval(scrolling, delay);
  }
  const widthEl = document.querySelector(
    ".slider-wrapper > :first-child"
  ).offsetWidth;
  imageWrapper.style.left = `-${totalScroll * widthEl}px`;
  imageWrapper.style.transition = "1s";
}
