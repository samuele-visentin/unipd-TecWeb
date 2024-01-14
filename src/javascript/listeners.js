function focusFirst() {
    // Focus the first focusable element.
    document.getElementById("menuButton").focus({
      preventScroll: true,
    });
}
  
document.getElementById("backToTop").addEventListener('click', focusFirst);