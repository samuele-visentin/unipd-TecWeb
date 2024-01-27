function focusFirst() {
    document.getElementById("menuButton").focus({
      preventScroll: true
    });
}

let backTopButton = document.getElementById("backToTop");

backTopButton.addEventListener('click', focusFirst);

window.addEventListener('scroll', e => {
  if(window.scrollY > 20) {
    backTopButton.classList.add("show");
  } else {
    backTopButton.classList.remove("show");
  }
});

const zoomImgs = document.getElementsByClassName("zoomImg");
const fullPage = document.getElementById("imgFullPage");
const chiudi = document.getElementById("closeImg");

for (let i = 0; i < zoomImgs.length; i++) {
  zoomImgs[i].addEventListener('click', function() {
    fullPage.style.backgroundImage = 'url(' + zoomImgs[i].src + ')';
    fullPage.style.display = 'block';
    chiudi.style.display = 'block';
  });
}

function closeImg() {
  fullPage.style.display = 'none';
  chiudi.style.display = 'none';
}