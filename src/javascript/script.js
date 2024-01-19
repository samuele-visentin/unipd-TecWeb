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