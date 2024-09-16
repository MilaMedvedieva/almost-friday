$(function() {

    $('.slider').slick({
        infinite: false,
        arrows: true,
        dots: true,
        slidesToShow: 3,
        responsive: [

            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    $('.slider-reviews').slick({
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1,
        variableWidth: true,
        focusOnSelect: true,
        dots: true,
        arrows: false,
        speed: 300,
        //autoplay: true,
        autoplaySpeed: 10000,
        responsive: [

            {
                breakpoint: 768,
                settings: {
                    variableWidth: true,
                    centerPadding: '30px',
                }
            },
            {
                breakpoint: 767,
                settings: {
                    variableWidth: false,
                }
            }
        ]
    });


    $('.background-image').slick({
        autoplay: true,
        infinite: true,
        autoplaySpeed: 5000,
        arrows: false,
        dots: false,
        draggable: true,
        fade: true,
        speed: 900,
        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        touchThreshold: 100
    });

});
