function focusFirst() {
    document.getElementById("menuButton").focus({
      preventScroll: true
    });
}
  
document.getElementById("backToTop").addEventListener('click', focusFirst);

let errorMessage = document.getElementById("error-message");
if(errorMessage !== ""){
  errorMessage.focus({
    preventScroll: true
  });
}
