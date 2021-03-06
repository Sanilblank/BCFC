AOS.init({
    duration: 800,
    easing: "slide",
    once: true,
});

jQuery(document).ready(function ($) {
    "use strict";

    var siteMenuClone = function () {
        $(".js-clone-nav").each(function () {
            var $this = $(this);
            $this
                .clone()
                .attr("class", "site-nav-wrap")
                .appendTo(".site-mobile-menu-body");
        });

        setTimeout(function () {
            var counter = 0;
            $(".site-mobile-menu .has-children").each(function () {
                var $this = $(this);

                $this.prepend('<span class="arrow-collapse collapsed">');

                $this.find(".arrow-collapse").attr({
                    "data-toggle": "collapse",
                    "data-target": "#collapseItem" + counter,
                });

                $this.find("> ul").attr({
                    class: "collapse",
                    id: "collapseItem" + counter,
                });

                counter++;
            });
        }, 1000);

        $("body").on("click", ".arrow-collapse", function (e) {
            var $this = $(this);
            if ($this.closest("li").find(".collapse").hasClass("show")) {
                $this.removeClass("active");
            } else {
                $this.addClass("active");
            }
            e.preventDefault();
        });

        $(window).resize(function () {
            var $this = $(this),
                w = $this.width();

            if (w > 768) {
                if ($("body").hasClass("offcanvas-menu")) {
                    $("body").removeClass("offcanvas-menu");
                }
            }
        });

        $("body").on("click", ".js-menu-toggle", function (e) {
            var $this = $(this);
            e.preventDefault();

            if ($("body").hasClass("offcanvas-menu")) {
                $("body").removeClass("offcanvas-menu");
                $this.removeClass("active");
            } else {
                $("body").addClass("offcanvas-menu");
                $this.addClass("active");
            }
        });

        // click outisde offcanvas
        $(document).mouseup(function (e) {
            var container = $(".site-mobile-menu");
            if (
                !container.is(e.target) &&
                container.has(e.target).length === 0
            ) {
                if ($("body").hasClass("offcanvas-menu")) {
                    $("body").removeClass("offcanvas-menu");
                }
            }
        });
    };
    siteMenuClone();

    var sitePlusMinus = function () {
        $(".js-btn-minus").on("click", function (e) {
            e.preventDefault();
            if (
                $(this).closest(".input-group").find(".form-control").val() != 0
            ) {
                $(this)
                    .closest(".input-group")
                    .find(".form-control")
                    .val(
                        parseInt(
                            $(this)
                                .closest(".input-group")
                                .find(".form-control")
                                .val()
                        ) - 1
                    );
            } else {
                $(this)
                    .closest(".input-group")
                    .find(".form-control")
                    .val(parseInt(0));
            }
        });
        $(".js-btn-plus").on("click", function (e) {
            e.preventDefault();
            $(this)
                .closest(".input-group")
                .find(".form-control")
                .val(
                    parseInt(
                        $(this)
                            .closest(".input-group")
                            .find(".form-control")
                            .val()
                    ) + 1
                );
        });
    };
    // sitePlusMinus();

    var siteSliderRange = function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            },
        });
        $("#amount").val(
            "$" +
                $("#slider-range").slider("values", 0) +
                " - $" +
                $("#slider-range").slider("values", 1)
        );
    };
    // siteSliderRange();

    var siteMagnificPopup = function () {
        $(".image-popup").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: "mfp-no-margins mfp-with-zoom", // class to remove default margin from left and right side
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                verticalFit: true,
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
            },
        });

        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false,
        });
    };
    siteMagnificPopup();

    var siteCarousel = function () {
        if ($(".nonloop-block-13").length > 0) {
            $(".nonloop-block-13").owlCarousel({
                center: false,
                items: 1,
                loop: false,
                stagePadding: 0,
                margin: 20,
                nav: true,
                navText: [
                    '<span class="icon-arrow_back">',
                    '<span class="icon-arrow_forward">',
                ],
                responsive: {
                    600: {
                        margin: 0,
                        stagePadding: 10,
                        items: 2,
                    },
                    1000: {
                        margin: 0,
                        stagePadding: 0,
                        items: 2,
                    },
                    1200: {
                        margin: 0,
                        stagePadding: 0,
                        items: 3,
                    },
                },
            });
        }

        $(".slide-one-item").owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            autoplay: true,
            pauseOnHover: false,
            nav: false,
            navText: [
                '<span class="icon-arrow_back">',
                '<span class="icon-arrow_forward">',
            ],
        });
    };
    siteCarousel();

    var siteStellar = function () {
        $(window).stellar({
            responsive: false,
            parallaxBackgrounds: true,
            parallaxElements: true,
            horizontalScrolling: false,
            hideDistantElements: false,
            scrollProperty: "scroll",
        });
    };
    siteStellar();

    var siteCountDown = function () {
        $("#date-countdown").countdown("2020/10/10", function (event) {
            var $this = $(this).html(
                event.strftime(
                    "" +
                        '<span class="countdown-block"><span class="label">%w</span> weeks </span>' +
                        '<span class="countdown-block"><span class="label">%d</span> days </span>' +
                        '<span class="countdown-block"><span class="label">%H</span> hr </span>' +
                        '<span class="countdown-block"><span class="label">%M</span> min </span>' +
                        '<span class="countdown-block"><span class="label">%S</span> sec</span>'
                )
            );
        });
    };
    siteCountDown();
});

// Meet the team Slider
var siteCarousel = function () {
    if ($(".nonloop-block-13").length > 0) {
        $(".nonloop-block-13").owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            dots: false,
            autoplay: true,
            nav: false,
            navText: [
                '<span class="icon-arrow_back">',
                '<span class="icon-arrow_forward">',
            ],
            responsive: {
                600: {
                    margin: 0,
                    nav: false,
                    items: 2,
                },
                1000: {
                    margin: 0,
                    stagePadding: 0,
                    nav: false,
                    items: 3,
                },
                1200: {
                    margin: 0,
                    stagePadding: 0,
                    nav: false,
                    items: 4,
                },
            },
        });
    }

    if ($(".nonloop-block-14").length > 0) {
        $(".nonloop-block-14").owlCarousel({
            center: false,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 0,
            autoplay: true,
            nav: true,
            navText: [
                '<span class="icon-arrow_back">',
                '<span class="icon-arrow_forward">',
            ],
            responsive: {
                600: {
                    margin: 20,
                    nav: true,
                    items: 2,
                },
                1000: {
                    margin: 30,
                    stagePadding: 0,
                    nav: true,
                    items: 2,
                },
                1200: {
                    margin: 30,
                    stagePadding: 0,
                    nav: true,
                    items: 3,
                },
            },
        });
    }

    $(".slide-one-item").owlCarousel({
        center: false,
        items: 1,
        pagination: true,
        dots: true,
        loop: true,
        stagePadding: 0,
        margin: 0,
        autoplay: true,
        pauseOnHover: false,
        nav: true,
        navText: [
            '<span class="icon-keyboard_arrow_left">',
            '<span class="icon-keyboard_arrow_right">',
        ],
    });

    if ($(".owl-4-slider").length > 0) {
        var owl4 = $(".owl-4-slider").owlCarousel({
            loop: true,
            autoHeight: true,
            margin: 10,
            autoplay: true,
            smartSpeed: 1000,
            items: 3,
            nav: false,
            navText: [
                '<span class="icon-keyboard_backspace"></span>',
                '<span class="icon-keyboard_backspace"></span>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 3,
                },
            },
        });

        $(".js-custom-next-v2").click(function (e) {
            e.preventDefault();
            owl4.trigger("next.owl.carousel");
        });
        $(".js-custom-prev-v2").click(function (e) {
            e.preventDefault();
            owl4.trigger("prev.owl.carousel");
        });
    }
};
siteCarousel();

var siteStellar = function () {
    $(window).stellar({
        responsive: false,
        parallaxBackgrounds: true,
        parallaxElements: true,
        horizontalScrolling: false,
        hideDistantElements: false,
        scrollProperty: "scroll",
    });
};
siteStellar();

/*------------------
       logo Carousel
    --------------------*/
$(".logo-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    items: 5,
    dots: false,
    navText: [
        '<i class="ti-angle-left"></i>',
        '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    mouseDrag: true,
    autoplay: true,
    responsive: {
        0: {
            items: 3,
        },
        768: {
            items: 5,
        },
    },
});

//gallery in landing

$(function () {
    $(".img-w").each(function () {
        $(this).wrap("<div class='img-c'></div>");
        let imgSrc = $(this).find("img").attr("src");
        $(this).css("background-image", "url(" + imgSrc + ")");
    });

    $(".img-c").click(function () {
        let w = $(this).outerWidth();
        let h = $(this).outerHeight();
        let x = $(this).offset().left;
        let y = $(this).offset().top;

        $(".active").not($(this)).remove();
        let copy = $(this).clone();
        copy.insertAfter($(this))
            .height(h)
            .width(w)
            .delay(500)
            .addClass("active");
        $(".active").css("top", y - 8);
        $(".active").css("left", x - 8);

        setTimeout(function () {
            copy.addClass("positioned");
        }, 0);
    });
});

$(document).on("click", ".img-c.active", function () {
    let copy = $(this);
    copy.removeClass("positioned active").addClass("postactive");
    setTimeout(function () {
        copy.remove();
    }, 500);
});
