const openNavBtn = document.getElementById("open-user-menu");
const closeNavBtn = document.getElementById("close-user-menu");
const navigation = document.querySelector(".login-navigation");
const app = document.getElementById("app");

openNavBtn.addEventListener("click", () => {
  navigation.classList.add("show-nav");
  app.classList.add("show-nav");
});

closeNavBtn.addEventListener("click", () => {
  navigation.classList.remove("show-nav");
  app.classList.remove("show-nav");
});

const dropdownContent = document.getElementById("user-dropdown");
const dropdownBtn = document.getElementById("greet-btn");

dropdownBtn.addEventListener("click", () => {
  dropdownContent.classList.toggle("show");
});

window.addEventListener("click", function (event) {
  if (!event.target.matches("#greet-btn")) {
    if (dropdownContent.classList.contains("show")) {
      dropdownContent.classList.remove("show");
    }
  }
});
