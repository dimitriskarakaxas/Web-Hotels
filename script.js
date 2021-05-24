const openLoginFormBtn = document.getElementById("login-btn");
const loginFormEl = document.getElementById("login-form");
const closeLoginFormBtn = document.getElementById("close-login-form");
const openRegisterFormBtn = document.getElementById("register-btn");
const registerFormEl = document.getElementById("register-form");
const closeRegisterFormBtn = document.getElementById("close-register-form");
const createAccountBtn = document.querySelector(".create-account");
const loginAccountBtn = document.querySelector(".login");
const backdropEl = document.getElementById("backdrop");
console.log(createAccountBtn);

function openLoginFormHandler() {
  loginFormEl.classList.add("visible");
  toggleBackdrop();
}

function closeLoginFormHandler() {
  loginFormEl.classList.remove("visible");
  toggleBackdrop();
}

function openRegisterFormHandler() {
  registerFormEl.classList.add("visible");
  toggleBackdrop();
}

function closeRegisterFormHandler() {
  registerFormEl.classList.remove("visible");
  toggleBackdrop();
}

function createAccountBtnHandler() {
  closeLoginFormHandler();
  openRegisterFormHandler();
}

function loginAccountBtnHandler() {
  closeRegisterFormHandler();
  openLoginFormHandler();
}

function toggleBackdrop() {
  backdropEl.classList.toggle("visible");
}

function backdropHandler() {
  closeLoginFormHandler();
  closeRegisterFormHandler();
  toggleBackdrop();
}

openLoginFormBtn.addEventListener("click", openLoginFormHandler);
closeLoginFormBtn.addEventListener("click", closeLoginFormHandler);
openRegisterFormBtn.addEventListener("click", openRegisterFormHandler);
closeRegisterFormBtn.addEventListener("click", closeRegisterFormHandler);
createAccountBtn.addEventListener("click", createAccountBtnHandler);
loginAccountBtn.addEventListener("click", loginAccountBtnHandler);
backdropEl.addEventListener("click", backdropHandler);
