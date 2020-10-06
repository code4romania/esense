window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if ($(window).width() > 991) {
    if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
      document.querySelector(".navbar-custom").style.boxShadow = "0px 4px 12px rgba(0, 0, 0, 0.06);";
      document.querySelector(".navbar-custom").style.background = "#0e4870";
      document.querySelector(".navbar-custom .navbar-brand img.logo-blue").style.display = "none";
      document.querySelector(".navbar-custom .navbar-brand img.logo-white").style.display = "block";
    } else {
      document.querySelector(".navbar-custom").style.boxShadow = "none";
      document.querySelector(".navbar-custom").style.background = "transparent";
      document.querySelector(".navbar-custom .navbar-brand img.logo-blue").style.display = "block";
      document.querySelector(".navbar-custom .navbar-brand img.logo-white").style.display = "none";
    }
  }
}