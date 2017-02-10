/*global $,alert,smoothScroll,angular*/
$(document).ready(function () {
    "use strict";



    $('header .questions .block .inner').on("click", function () {
        $('header .questions .block .inner .choice-result').css({
            opacity: "1",
            visibility: "visible"
        });

    });

    var count = $('.count-num');
    count.countTo({
        from: 0,
        to: count.html(),
        speed: 5000,
        refreshInterval: 60
    });

    var count1 = $('.count-num1');
    count1.countTo({
        from: 0,
        to: count1.html(),
        speed: 5000,
        refreshInterval: 60
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    //for smoth scroll
    smoothScroll.init({
        speed: 1000,
        updateURL: false,
        offset: 100
    });

    $('.show-com-text').on("click", function () {
        $('.add-comment').stop();
        $('.add-comment').slideToggle();
    });

    $('.show-post-text').on("click", function () {
        $('#comment-area').stop();
        $('#comment-area').slideToggle();
    });

    $('.collapse-replies').on("click", function () {
        $('.children-comments').stop();
        $('.children-comments').slideToggle();
    });

    $('.add-fav').on("click", function () {
        $(this).toggleClass('active');
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 800) {
            $('.sticky').css({
                opacity: "1",
                visibility: "visible"
            });
        } else {
            $('.sticky').css({
                opacity: "0",
                visibility: "hidden"
            });
        }
    });

    /* ---------------------------------------------
     Scrool To Top Button Function
    --------------------------------------------- */

    $(".toTop").click(function () {
        $("html,body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    //hide left slide nav
    $('.show-nav-mob').on('click', function () {
        $('.mask-inner').css({
            transform: "translatex(230px)"
        });
        $('.wrap-pop').fadeIn();
        $('.mobile-nav').css('left', '0px');
        $('body').css('position', 'fixed');
    });

    $('.wrap-pop').on('click', function () {
        $('.mask-inner').css({
            transform: "translatex(0px)",
            marginLeft: "0px"
        });
        $(this).fadeOut();
        $('.mobile-nav').css('left', '-260px');
        $('body').css('position', 'relative');
    });


    // For transforming via url to tabs items
    var hash = window.location.hash.split('#')[1];
    $('.nav-tabs li a[href="#' + hash + '"]').tab('show');


});