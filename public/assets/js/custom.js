$(document).ready(function () {
    // home page hero section Slider
    $('.owl-one').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            480: {
                items: 1,
                nav: false
            },
            667: {
                items: 1,
                nav: true
            },
            1000: {
                items: 1,
                nav: true
            }
        }
    })


})
