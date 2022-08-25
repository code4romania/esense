$(document).ready(function () {
    $('.exercises-owl-carousel').owlCarousel({
        stagePadding: 80,
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        navText : ["<div><i class='fas fa-chevron-left text-secondary'></i></div>","<div><i class='fas fa-chevron-right text-secondary'></i></div>"],
        responsive:{
            0:{
                items:1
            },
            320:{
                items:1
            },
            768:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
});
