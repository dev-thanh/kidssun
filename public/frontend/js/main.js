jQuery(document).ready(function($) {

    $(".slick-slidershow").slick({

        dots: true,

        autoplay:true,

        infinite: true,

        speed: 500,

        slidesToShow: 1,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-blogs").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 3,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="fal fa-angle-left icon icon-prev"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="fal fa-angle-right icon icon-next"></i></button>',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-related-blogs").slick({

        dots: true,

        infinite: true,

        speed: 500,

        slidesToShow: 3,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-testimonials").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 1,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="fal fa-angle-left icon icon-prev"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="fal fa-angle-right icon icon-next"></i></button>',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-brands").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 4,

        slidesToScroll: 1,

        adaptiveHeight: true,

        arrow: false,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="fal fa-angle-left icon icon-prev"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="fal fa-angle-right icon icon-next"></i></button>',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 4,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 2,

                }

            }

        ]

    });



    $(".slick-introduces").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 4,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1199,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 991,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 767,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 575,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    // $(".slick-products").slick({

    //     dots: false,

    //     infinite: true,

    //     speed: 500,

    //     slidesToShow: 4,

    //     slidesToScroll: 1,

    //     adaptiveHeight: true,

    //     arrow: true,

    //     prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="fal fa-angle-left icon icon-prev"></i></button>',

    //     nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="fal fa-angle-right icon icon-next"></i></button>',

    //     responsive: [

    //         {

    //             breakpoint: 1199,

    //             settings: {

    //                 slidesToShow: 3,

    //             }

    //         },

    //         {

    //             breakpoint: 991,

    //             settings: {

    //                 slidesToShow: 3,

    //             }

    //         },

    //         {

    //             breakpoint: 767,

    //             settings: {

    //                 slidesToShow: 2,

    //             }

    //         },

    //         {

    //             breakpoint: 575,

    //             settings: {

    //                 slidesToShow: 1,

    //             }

    //         }

    //     ]

    // });

});



jQuery(document).ready(function($) {

    // $('#menu .menu-content').click(function(e){

    //     e.stopPropagation();

    // });

    // $('#menuToggle .menu-title, #menuToggle .menu-close, #menu').click(function(){

    //     $('#menuToggle').toggleClass('active');

    // });$('.menu-box').height('100%');



    $('.megamenu .sub-title').click(function(event){

        event.preventDefault();

        $(this).next().slideToggle('slow');

    });



    $('.images-grid .banner-box').click(function(){

        $('.popup-images').toggleClass('active');

        var srcimg = $(this).children('.banner-image').children().attr('src');

        $('.popup-banner-image img').attr('src', srcimg);

    });

    $('.images-grid .banner-box .banner-link').click(function(event){

        event.preventDefault();

    });

    $('.popup').click(function(){

        $(this).removeClass('active');

    });

     $('.popup-box').click(function(e){

        e.stopPropagation();

    });



    $(window).on("scroll",function() {

        if ($(this).scrollTop() > 41 ) {

            $('.main-sticky').addClass('active');

        } else {

            $('.main-sticky').removeClass('active');

        }



        if ($(this).scrollTop() > 0 ) {

            $('.back-to-top').addClass('active');

        } else {

            $('.back-to-top').removeClass('active');

        }

    });

    $('.back-to-top').click(function(){

        $('html, body').animate({scrollTop:0}, 400);

    });



    $('.categories-title').click(function(){

        var hsac = $(this).parent().hasClass('active');

        if (!hsac) {

            $(this).parent().parent().children().removeClass('active');

            $(this).parent().addClass('active');

        }

    });

});