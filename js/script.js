const openLoginFormBtn = document.getElementById("login-btn");
const loginFormEl = document.getElementById("login-form");
const closeLoginFormBtn = document.getElementById("close-login-form");
const openRegisterFormBtn = document.getElementById("register-btn");
const registerFormEl = document.getElementById("register-form");
const closeRegisterFormBtn = document.getElementById("close-register-form");
const createAccountBtn = document.querySelector(".create-account");
const loginAccountBtn = document.querySelector(".login");
const backdropEl = document.getElementById("backdrop");
const activationForm = document.getElementById("activation-form");
const activationFormInputs = activationForm.querySelectorAll("input");

// Open - Close modals
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
  if (activationForm.classList.contains("visible")) {
    return;
  }
  closeLoginFormHandler();
  closeRegisterFormHandler();
  toggleBackdrop();
}

function openActivateAccountFormHandler() {
  activationForm.classList.add("visible");
  toggleBackdrop();
}

openLoginFormBtn.addEventListener("click", openLoginFormHandler);
closeLoginFormBtn.addEventListener("click", closeLoginFormHandler);
openRegisterFormBtn.addEventListener("click", openRegisterFormHandler);
closeRegisterFormBtn.addEventListener("click", closeRegisterFormHandler);
createAccountBtn.addEventListener("click", createAccountBtnHandler);
loginAccountBtn.addEventListener("click", loginAccountBtnHandler);
backdropEl.addEventListener("click", backdropHandler);

window.addEventListener("keydown", function (event) {
  // If <ESC> clicked
  if (event.key === "Escape") {
    if (loginFormEl.classList.contains("visible")) {
      closeLoginFormHandler();
      return;
    } else if (registerFormEl.classList.contains("visible")) {
      closeRegisterFormHandler();
      return;
    }
  }
});

// Activation code inputs
for (const input of activationFormInputs) {
  input.addEventListener("keydown", function (event) {
    event.preventDefault();
    const currentInput = event.target;
    if (isFinite(event.key) && event.key !== " ") {
      currentInput.value = event.key;
      currentInput.blur();
      currentInput.nextElementSibling.focus();
    } else if (event.key === "Backspace") {
      currentInput.value = "";
      currentInput.blur();
      if (currentInput.previousElementSibling) {
        currentInput.previousElementSibling.focus();
      }
    }
  });
}
