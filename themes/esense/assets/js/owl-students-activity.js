$(document).ready(function () {
    $('.students-activity-owl-carousel').owlCarousel({
        stagePadding: 0,
        items:1,
        singleItem:true,
        loop:true,
        margin:30,
        nav:true,
        responsiveClass:'owl-responsive',
        navText : ["<div class='p-2 rounded-circle bg-secondary'><i class='fas fa-arrow-left'></i></div>","<div class='p-2 rounded-circle bg-secondary'><i class='fas fa-arrow-right'></i></div>"],
        responsive:{
            0:{
                items:1
            }
        }
    })
});