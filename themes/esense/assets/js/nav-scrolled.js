window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
    document.querySelector(".navbar-custom").style.boxShadow = "0px 4px 12px rgba(0, 0, 0, 0.06);";
    document.querySelector(".navbar-custom").style.background= "#363636";
  } else {
    document.querySelector(".navbar-custom").style.boxShadow = "none";
    document.querySelector(".navbar-custom").style.background= "transparent";
  }
}