function toggleContentMenu(){
    document.getElementById("contentMenu").classList.toggle("toggleMenu");
    document.getElementById("content").classList.toggle("toggleMenu");
    document.getElementById("breadcrumb").classList.toggle("toggleMenu");
}

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
};