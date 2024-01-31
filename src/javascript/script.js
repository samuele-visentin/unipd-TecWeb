function openMenu(){
    document.getElementById("contentMenu").classList.add("toggleMenu");
    document.getElementById("content").classList.add("toggleMenu");
    document.getElementById("breadcrumb").classList.add("toggleMenu");
    document.getElementById("menuClose").focus({
      preventScroll: true
    });
    document.querySelector("body").classList.add("lock");

    document.getElementById("mainContent").addEventListener("click", closeMenu);
}

function closeMenu(){
  document.getElementById("contentMenu").classList.remove("toggleMenu");
  document.getElementById("content").classList.remove("toggleMenu");
  document.getElementById("breadcrumb").classList.remove("toggleMenu");
  document.getElementById("menuButton").focus({
    preventScroll: true
  });
  document.querySelector("body").classList.remove("lock");

  document.getElementById("mainContent").removeEventListener("click", closeMenu);
}

const mql = window.matchMedia("screen and (max-width: 768px)");

mql.onchange = (e) => {
  if (!e.matches) {
    document.getElementById("contentMenu").classList.remove("toggleMenu");
    document.getElementById("content").classList.remove("toggleMenu");
    document.getElementById("breadcrumb").classList.remove("toggleMenu");
    document.querySelector("body").classList.remove("lock");
  }
};

function displayCriteria(inputId) {
  if (inputId === "username") {
    document.getElementById("UsernameHint").classList.remove("hideHint");
  } else if (inputId === "password") {
    document.getElementById("PasswordHint").classList.remove("hideHint");
  }
}

function removeFocus(inputType) {
  if (inputType === "username") {
    document.getElementById("UsernameHint").classList.add("hideHint");
  } else if (inputType === "password") {
    document.getElementById("PasswordHint").classList.add("hideHint");
  }
}

function validateSignup() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var confermaPassword = document.getElementById("confermaPassword").value;
  function errorMessage(message) {
    let h = document.getElementById("login-signup");
    let errorMessage = document.getElementById("error-message");
    errorMessage ??= document.createElement("p");
    errorMessage.id = "error-message";
    errorMessage.role = "alert";
    errorMessage.innerHTML = message;
    h.parentNode.insertBefore(errorMessage, h.nextSibling);
  }
  if (!username.match(/^[a-zA-Z0-9_]{4,16}$/)) {
    errorMessage("L'<span lang='en'>username</span> non rispetta i criteri richiesti");
    return false;
  }
  if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,25}$/)) {
    errorMessage("La <span lang='en'>password</span> non rispetta i criteri richiesti.");
    return false;
  }
  if (password !== confermaPassword) {
    errorMessage("Le <span lang='en'>password</span> non corrispondono.");
    return false;
  }
  let p = document.getElementById("error-message");
  if (p != null) {
    p.remove();
  }
  return true;
}

function validateUsername() {
  let username = document.getElementById("uname").value;
  let p = document.getElementById("error-message");
  if (p == null) {
    p = document.createElement("p");
    p.id = "error-message";
    let h = document.getElementById("account-title");
    h.parentNode.insertBefore(p, h.nextSibling);
  }
  p.role = "alert";
  if (username.match(/^[a-zA-Z0-9_]{4,16}$/) == null){
    p.innerHTML = "L'<span lang='en'>username</span> non rispetta i criteri richiesti";
    return false;
  }
  if (p != null) {
    p.remove();
  }
  return true;
}

function validatePassword() {
  let password = document.getElementById("psw").value;
  let p = document.getElementById("error-message");
  if (p == null) {
    p = document.createElement("p");
    p.id = "error-message";
    let h = document.getElementById("userform");
    h.parentNode.insertBefore(p, h.nextSibling);
  }
  p.role = "alert";
  if (password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,25}$/) == null) {
    p.innerHTML = "La <span lang='en'>password</span> non rispetta i criteri richiesti.";
    return false;
  } else if (password !== document.getElementById("confermaPsw").value) {
    p.innerHTML = "Le <span lang='en'>password</span> non corrispondono.";
    return false;
  }
  if (p != null) {
    p.remove();
  }
  return true;
}

/*
const mql = window.matchMedia("screen and (max-width: 600px)");

mql.onchange = (e) => {
  if (e.matches) {
    if(document.getElementById("contentMenu").classList.contains("toggleMenu")) {        
        document.getElementById("contentMenu").classList.remove("toggleMenu");
        document.getElementById("content").classList.remove("toggleMenu");
        document.getElementById("breadcrumb").classList.remove("toggleMenu");
    }
  } else {
    document.getElementById("contentMenu").classList.remove("toggleMenu");
    document.getElementById("content").classList.remove("toggleMenu");
    document.getElementById("breadcrumb").classList.remove("toggleMenu");
  }
};*/