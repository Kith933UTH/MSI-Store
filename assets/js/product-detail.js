import "./mousewheel.js";
// product img
const owl = $(".owl-carousel");
owl.owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa-solid fa-chevron-left control-left'></i>",
    "<i class='fa-solid fa-chevron-right control-right'></i>",
  ],
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    },
  },
});

owl.on("mousewheel", ".owl-stage", function (e) {
  if (e.deltaY > 0) {
    owl.trigger("next.owl");
  } else {
    owl.trigger("prev.owl");
  }
  e.preventDefault();
});

owl.on("changed.owl.carousel", function (event) {
  document
    .querySelector(".owl-carousel .owl-dots .owl-dot.active")
    .scrollIntoView({
      block: "nearest",
      behavior: "smooth",
      inline: "nearest",
    });
});

const listImg = document.querySelectorAll(
  ".owl-carousel .owl-stage-outer .owl-stage .owl-item:not(.cloned) .item img"
);
const dotControlList = document.querySelectorAll(
  ".owl-carousel .owl-dots .owl-dot span"
);

dotControlList.forEach((e, index) => {
  e.classList.add("list");
  e.style.backgroundImage = "url('" + listImg[index].getAttribute("src") + "')";
});
