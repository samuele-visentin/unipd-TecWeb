function focusFirst() {
    document.getElementById("menuButton").focus({
      preventScroll: true
    });
}
  
document.getElementById("backToTop").addEventListener('click', focusFirst);

document.querySelector("form")?.addEventListener("submit", function(event) {
  if (!validateForm()) {
      event.preventDefault();
  }
});