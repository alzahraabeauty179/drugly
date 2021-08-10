$(document).ready(function () {


    $('.btn-show-sidebar').click(function (e) {
        e.preventDefault();
        $('.overlay-sidebar').css({ opacity: 1, visibility: "visible" });
        $('.sidebar-show').css("right", "0px");
    });



    $(window).on("load", function() {
        $(".absCenter").fadeOut('slow');
    });

    $(".hero-slides").owlCarousel({
        rtl: true,
        items: 1,
        nav: !1,
        dots: false,
        touchDrag: !1,
        mouseDrag: !1,
        autoplay: !0,
        smartSpeed: 700,
        loop: !0,
        navText: ["<i class='icofont-rounded-left'></i>", "<i class='icofont-rounded-right'></i>"]
    });

    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('.back-top').fadeIn();
        } else {
            $('.back-top').fadeOut();
        }
    });

    $(".back-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    new WOW().init();

    $(".popup-video").magnificPopup({
        disableOn: 320,
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: !1,
        fixedContentPos: !1
    });



});