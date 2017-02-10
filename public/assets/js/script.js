$(document).ready(function () {

    SliderHeight();
    $(window).resize(function () {
        SliderHeight();
    });

    function SliderHeight() {
        $('.map-holder #map-canvas').css({'height': $(window).height() - $('.navbar').height()});
    }


    var owl = $("#owl-slide");
    owl.owlCarousel({
        autoPlay: 2000,
        items: 6,
        itemsDesktop: [1200, 5],
        itemsDesktopSmall: [992, 4],
        itemsTablet: [768, 3],
        itemsMobile: [480, 2]
    });

    // Custom Navigation Events
    $(".next-slide").click(function () {
        owl.trigger('owl.next');
    });
    $(".prev-slide").click(function () {
        owl.trigger('owl.prev');
    });


    $('.fancybox').fancybox({padding: 2});


    $('.dropdown').hover(function () {
            $(this).addClass('open')
        }
        , function () {
            $(this).removeClass('open')
        });


    SliderHeight();
    $(window).resize(function () {
        SliderHeight();
    });

    function SliderHeight() {
        $('.map-holder #map-canvas').css({
            'height': $(window).height() * 3 / 4,
            'min-height': $('.search-block').height() + 100
        });
    }


    Animate_box();
    $(document).scroll(function () {
        Animate_box();
    });

    function Animate_box() {
        var scroll_var = $(this).scrollTop();

        $('.animate-box').each(function () {
            var val_one = $(this).offset().top - $(window).height() + 80;

            if (scroll_var > val_one) {
                $(this).addClass('animated fadeInUp');
            }
        });
    }


    var owl = $("#owl-slide");
    owl.owlCarousel({
        autoPlay: 2000,
        items: 6,
        itemsDesktop: [1200, 5],
        itemsDesktopSmall: [992, 4],
        itemsTablet: [768, 3],
        itemsMobile: [480, 2]
    });

    // Custom Navigation Events
    $(".next-slide").click(function () {
        owl.trigger('owl.next');
    });
    $(".prev-slide").click(function () {
        owl.trigger('owl.prev');
    });


    $('.fancybox').fancybox({padding: 2});


});