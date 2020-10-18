$(document).ready(function () {
    $('.exercises-owl-carousel').owlCarousel({
        stagePadding: 80,
        loop:true,
        margin:10,
        nav:false,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        }
    })
});