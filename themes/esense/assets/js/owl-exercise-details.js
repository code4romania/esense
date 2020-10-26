$(document).ready(function () {
    $('.exercise-detailes-owl-carousel').owlCarousel({
        stagePadding: 0,
        loop:true,
        margin:10,
        nav:true,
        navText : ["<div><i class='fas fa-chevron-left text-secondary'></i></div>","<div><i class='fas fa-chevron-right text-secondary'></i></div>"],
        autoplay:true,
        autoplayTimeout:2500,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })
});