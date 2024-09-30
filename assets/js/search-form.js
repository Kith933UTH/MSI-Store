const searchBtn = document.getElementById("search-btn");
const searchInput = document.getElementById("search-form");

searchBtn.onclick = () => {
  searchInput.classList.toggle("active");
  if (searchInput.classList.contains("active")) {
    searchBtn.innerHTML = "<i class='fa-solid fa-xmark'></i>";
  } else {
    searchBtn.innerHTML = "<i class='fa-solid fa-magnifying-glass'></i>";
  }
};
