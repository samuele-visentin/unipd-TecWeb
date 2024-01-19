function focusFirst() {
    document.getElementById("menuButton").focus({
      preventScroll: true
    });
}
  
document.getElementById("backToTop").addEventListener('click', focusFirst);