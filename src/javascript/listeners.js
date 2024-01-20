function focusFirst() {
    document.getElementById("menuButton").focus({
      preventScroll: true
    });
}
  
document.getElementById("backToTop").addEventListener('click', focusFirst);

function displayCriteria(inputId) {
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
      criteria += "<h2 lang='en'>Username: </h2>";
      criteria += "<dl><dt>Deve contenere:</dt>" + 
          "<dd>Numeri</dd><dd>Lettere</dd><dd lang='en'>Underscore</dd>" +
          "<dt>Deve essere lungo:</dt>" +
          "<dd>Minimo 4 caratteri</dd><dd>Massimo 16 caratteri</dd>" +
          "<dt>Deve essere univoco</dt></dl>";
  } else if (inputId === "password" || inputId === "confermaPassword") {
      criteria += "<h2 lang='en'> Password: </h2>";
      criteria += "<dl><dt>Deve contenere:</dt>" + 
          "<dd>Una lettera minuscola</dd><dd>Una lettera maiuscola</dd><dd>Un numero</dd>" +
          "<dd>Un carattere speciale(@$!%*?&amp;)</dd>" +
          "<dt>Deve essere lunga:</dt>" +
          "<dd>Minimo 4 caratteri</dd><dd>Massimo 25 caratteri</dd></dl>";
  }
  input.innerHTML = criteria;
}

function validateForm() {
  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var confermaPassword = document.getElementById("confermaPassword");
  var errorMessage = document.getElementById("error-message");
  if(errorMessage === null) {
    let h = document.getElementById("login-signup");
    errorMessage = document.createElement("p");
    errorMessage.id = "error-message";
    h.parentNode.insertBefore(errorMessage, h.nextSibling);
  }

  if (!username.match(/^[a-zA-Z0-9_]{4,16}$/)) {
    errorMessage.innerHTML = "L'username deve contenere solo lettere, numeri e underscore e deve essere lungo da 4 a 16 caratteri.";
    return false;
  }

  if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,25}$/)) {
    errorMessage.innerHTML = "La password deve contenere almeno una lettera minuscola, una lettera maiuscola, un numero, un carattere speciale e deve essere lunga da 4 a 25 caratteri.";
    return false;
  }

  if (password !== confermaPassword) {
    errorMessage.innerHTML = "Le password non corrispondono.";
    return false;
  }

  return true;
}

document.querySelector("form").addEventListener("submit", function(event) {
  if (!validateForm()) {
      event.preventDefault();
  }
});