function openMenu(){
    document.getElementById("contentMenu").classList.add("toggleMenu");
    document.getElementById("content").classList.add("toggleMenu");
    document.getElementById("breadcrumb").classList.add("toggleMenu");
    document.getElementById("menuClose").focus({
      preventScroll: true
    });
}

function closeMenu(){
  document.getElementById("contentMenu").classList.remove("toggleMenu");
  document.getElementById("content").classList.remove("toggleMenu");
  document.getElementById("breadcrumb").classList.remove("toggleMenu");
  document.getElementById("menuButton").focus({
    preventScroll: true
  });
}

const mql = window.matchMedia("screen and (max-width: 600px)");

mql.onchange = (e) => {
  if (!e.matches) {
    document.getElementById("contentMenu").classList.remove("toggleMenu");
    document.getElementById("content").classList.remove("toggleMenu");
    document.getElementById("breadcrumb").classList.remove("toggleMenu");
  }
};

async function displayCriteria(inputId) {
  var input = document.getElementById("displayCriteria");
  if(input == null) {
      let div = document.getElementById("input-container");
      input = document.createElement("div");
      input.id = "displayCriteria";
      input.setAttribute("role", "region");
      input.setAttribute("aria-live", "polite");
      div.parentNode.insertBefore(input, div.nextSibling);
  }
  var criteria = "";
  if (inputId === "username") {
      criteria = await (await fetch("hint/username.html")).text();
  } else if (inputId === "password" || inputId === "confermaPassword") {
      criteria = await (await fetch("hint/password.html")).text();
  }
  input.innerHTML = criteria;
}

function validateForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var confermaPassword = document.getElementById("confermaPassword").value;
  function errorMessage(message) {
    let h = document.getElementById("login-signup");
    let errorMessage = document.getElementById("error-message");
    errorMessage ??= document.createElement("p");
    errorMessage.role = "alert";
    errorMessage.id = "error-message";
    errorMessage.innerHTML = "L'<span lang='en'>username</span> non rispetta i criteri richiesti";
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