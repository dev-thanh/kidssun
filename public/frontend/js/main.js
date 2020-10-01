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

    /*  Login register  */

    $('.login-registration .title-popup').click(function(e){
        e.preventDefault();

        var hslgi = $(this).hasClass('login');
        var hsfp = $(this).hasClass('forgot-password');

        var hw = $(window).height();

        $('.popups-content > div').removeClass('active');

        if (hslgi) {
            var hlg = $('.popup-content-login').height();
            var hpcs = parseInt(hlg) + 60;

            if (hpcs > hw) {
                $('.popups-box').css({'height': hw - 30, 'top': '0'});
            } else {
                $('.popups-box').css({'height': 'auto', 'top': 'auto'});
            }

            $('.popup-content-login').addClass('active');
        } else if (hsfp) {
            var hlg = $('.popup-content-forgot-password').height();
            var hpcs = parseInt(hlg) + 60;

            if (hpcs > hw) {
                $('.popups-box').css({'height': hw - 30, 'top': '0'});
            } else {
                $('.popups-box').css({'height': 'auto', 'top': 'auto'});
            }

            $('.popup-content-forgot-password').addClass('active');
        } else {
            var hlg = $('.popup-content-registration').height();
            var hpcs = parseInt(hlg) + 60;

            if (hpcs > hw) {
                $('.popups-box').css({'height': hw - 30, 'top': '0'});
            } else {
                $('.popups-box').css({'height': 'auto', 'top': 'auto'});
            }

            $('.popup-content-registration').addClass('active');
        }

        $('.art-popups-login-registration').addClass('active');
    });

    $('.popups-box').click(function(){
        $('.art-popups-login-registration').removeClass('active');
        $('#form-login')[0].reset();
        $('#reset-pass-member')[0].reset();
        $('.email_reset-error').html('');
        $('.loadingcover').remove();
    });

    $('.popups-content').click(function(e){
        e.stopPropagation();
    });

    $('.title-accounts .tab-title a').click(function(e){
         e.preventDefault();

         var hac = $(this).hasClass('active');

         if (!hac) {
            var clnm = $(this).attr('class').replace('-title','');
            var clsnm = clnm + '-box';
            $('.accounts-content > div').removeClass('active');
            $('.title-accounts .tab-title a').removeClass('active');
            $('.' + clsnm).addClass('active');
            $(this).addClass('active');
         }
    });

    $('.login-registration .title-sub').click(function(e){
        e.preventDefault();
        $(this).parent().toggleClass('active');
    });

    $('.title-sidebars').click(function(){
        var wd = $(window).width();
        if (wd < 992) {
            var hsc = $(this).hasClass('active');
            if (hsc) {
                $(this).removeClass('active');
                $(this).next().slideUp('slow');
            } else {
                $('.title-sidebars').removeClass('active');
                $(this).addClass('active');
                $('.sidebars-content').slideUp('slow');
                $(this).next().slideDown('slow');
            }
        }        
    });

    $(window).resize(function(){
        var hw = $(window).height();
        var hlg = $('.popups-content > div.active').height();
        var hpcs = parseInt(hlg) + 60;

        if (hpcs > hw) {
            $('.popups-box').css({'height': hw - 30, 'top': '0'});
        } else {
            $('.popups-box').css({'height': 'auto', 'top': 'auto'});
        }

        var wd = $(window).width();
        if (wd < 992) {
            $('.sidebars-content').hide();
            $('.title-sidebars').removeClass('active');
        } else {
            $('.sidebars-content').show();
        }
    });

    /*  register  */
    $(".btn-register-member").click(function(e){
        e.preventDefault();
        var _this = $(this);
        var url_browse = $('#get_url_path').val();
        var url = $('#register-member').attr('action');
        var _token = $("input[name='_token']").val();
        var full_name = $("input[name='full_name']").val();
        var user_name = $("input[name='user_name']").val();
        var phone = $("input[name='phone']").val();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var mentor_code = $("input[name='mentor_code']").val();
        _this.attr("disabled", true);

        $.ajax({
            url: url,
            type:'POST',
            data: {_token:_token, full_name:full_name, user_name:user_name, email:email, phone:phone, password:password, password_confirmation:password_confirmation, mentor_code:mentor_code},
            beforeSend: function() {
                $('.eror-ms').html('');
            },
            success: function(data) {
                // console.log(data);
                if(data.error_code){
                    $('.mentor_code-error').html(data.error_code);
                }
                if($.isEmptyObject(data.error)){
                    toastr["success"](data.success, "Thông báo");
                    $('.popup-content-registration').removeClass('active');
                    $('.popup-content-login').addClass('active');
                    history.pushState({}, null, url_browse+'?login=1');
                }else{
                    if(data.error.full_name){
                        $('.full_name-error').html(data.error.full_name);
                    }
                    if(data.error.user_name){
                        $('.user_name-error').html(data.error.user_name);
                    }
                    if(data.error.email){
                        $('.email-error').html(data.error.email);
                    }
                    if(data.error.phone){
                        $('.phone-error').html(data.error.phone);
                    }
                    if(data.error.password){
                        $('.password-error').html(data.error.password);
                    }
                    if(data.error.password_confirmation){
                        $('.password_confirmation-error').html(data.error.password_confirmation);
                    }
                   
                }
                _this.removeAttr('disabled');
            }
        });


    });

    $(".btn-login-member:not(.disabled)").click(function(e){
        e.preventDefault();
        var _this = $(this);
        var url_browse = $('#get_url_path').val();
        var url = $('#form-login').attr('action');
        var _token = $("input[name='_token']").val();
        var name_email = $("input[name='name_email']").val();
        var password_login = $("input[name='password_login']").val();
        _this.attr("disabled", true);
        $.ajax({
            url: url,
            type:'POST',
            data: {_token:_token, name_email:name_email, password_login:password_login},
            beforeSend: function() {
                $('.eror-ms').html('');
                $("input[name='name_email']").css('border-color','');
                $("input[name='password_login']").css('border-color','');
            },
            success: function(data) {
                if(data.error_code){
                    $('.mentor_code-error').html(data.error_code);
                }
                if($.isEmptyObject(data.error)){
                    if(data.status_login =='0'){
                        $("input[name='name_email']").css('border-color','red');
                        $("input[name='password_login']").css('border-color','red');
                        toastr["error"](data.message_login, data.message_title);
                    }
                    if(data.status_login =='1'){
                        var url_browse = $('#get_url_path').val();
                        window.location.href = url_browse+'/san-pham';
                    }
                }else{
                    if(data.error.name_email){
                        $('.name_email-error').html(data.error.name_email);
                    }
                    if(data.error.password_login){
                        $('.password_login-error').html(data.error.password_login);
                    }
                    
                   
                }
                _this.removeAttr('disabled');
            }
        });


    });

    $(".btn-reset-password").click(function(e){
        e.preventDefault();
        var loading = '<div class="loadingcover"">'+
                '<p class="csslder">'+
                    '<span class="csswrap">'+
                        '<span class="cssdot"></span>'+
                        '<span class="cssdot"></span>'+
                        '<span class="cssdot"></span>'+
                    '</span>'+
                '</p>'+
            '</div>';
        var url = $('#reset-pass-member').attr('action');
        var _token = $("input[name='_token']").val();
        var email_reset = $("input[name='email_reset']").val();
        $('.popups-box').append(loading);
        $.ajax({
            url: url,
            type:'POST',
            data: {_token:_token,email_reset:email_reset},
            beforeSend: function() {
                $('.eror-ms').html('');
            },
            success: function(data) {
                console.log(data);
                if(data.status == 0){
                    $('.email_reset-error').html(data.error);
                }
                if(data.status == 2){
                    $('.email_reset-error').html(data.error_empty);
                }
                if(data.status == 1){
                    toastr["success"](data.message, "Thông báo");
                    $('.art-popups-login-registration').removeClass('active');
                }
                $('.loadingcover').remove();
            }
        });
    });

    /*  GIỎ HÀNG  */
    ajax_giohang = function(id,qty,url,parent){
        $.ajax({
            url: url,
            type:'GET',
            data: {id:id,qty:qty},
            beforeSend: function() {
                
            },
            success: function(data) {
               console.log(data);
               parent.find('.cartitem-price').html(data.price_new);
               $('.total-cart').html(data.total);
               $('.count-cart').html('( '+data.count+' )');
               $('.disabled-click').removeClass();
            }
        });
    }
    $(".icon-minus-next").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        qty = parseFloat(qty)+1;
        qty_old.val(qty);

        ajax_giohang(id,qty,url,parent);
    });
    $(".icon-minus-pre").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        if(parseFloat(qty) > 1){
            qty =  parseFloat(qty)-1;        
            qty_old.val(qty);
            ajax_giohang(id,qty,url,parent);
        }
        else{
            //alert('Bạn có mún xóa sản phẩm khỏi giỏ hàng');
            $('.disabled-click').removeClass();
        }
    });

    $('.delete-cart').click(function(e){
        e.preventDefault();
        var _this_tbody = $(this).parents('tbody');
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type:'GET',
            data: {id:id},
            success: function(data) {
               console.log(data);
               $('.total-cart').html(data.total);
               $('.count-cart').html('( '+data.count+' )');
               toastr["success"](data.toastr, "");
               parent.remove();
               if(data.count==0){
                    _this_tbody.append('<tr><td colspan="5" rowspan="" headers="">'+data.empty+'</td></tr>');
               }
            }
        });
    });
    $('input[name="product_qty"]').blur(function(){
        var parent = $(this).parents('tr');
        var url = parent.find('input[name="get_id_product"]').data('url');
        var id = parent.find('input[name="get_id_product"]').val();
        var qty = $(this).val();
        if(qty !=''){            
            ajax_giohang(id,qty,url,parent);        
        }
    });

    /*   Thông tin tài khoản   */
    function readURL(input,img) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          img.attr('src', e.target.result);
          img.hide();
          img.fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#fileToUpload1").change(function() {
        var img = $(this).parents('.form-group').find('.preview-img');
      readURL(this,img);
    });
    $("#fileToUpload2").change(function() {
        var img = $(this).parents('.form-group').find('.preview-img');
        readURL(this,img);
    });
    $("#filename").change(function() {
        var img = $(this).parents('.form-group').find('.preview-img');
        readURL(this,img);
    });
});

$(document).ready(function($) {
    $('.btn-cap-nhap-thong-tin').click(function(e){
        e.preventDefault();
        var _this = $(this);
        var url = $('#cap_nhap_thong_tin').attr('action');
        var formData = new FormData($('#cap_nhap_thong_tin')[0]);
        $('.error-message').html('');
        $('.loadingcover').show();
        $.ajax({
            url: url,
            type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status==1){
                    toastr["success"](data.toastr, "");
                }else{            
                    console.log(data.error);              
                    if(data.error.full_name){
                        $('.error_full_name').html(data.error.full_name);
                    }
                    if(data.error.email){
                        $('.error_email').html(data.error.email);
                    }
                    if(data.error.phone){
                        $('.error_phone').html(data.error.phone);
                    }
                    if(data.error.so_cmnd){
                        $('.error_so_cmnd').html(data.error.so_cmnd);
                    }
                    if(data.error.cmnd1){
                        $('.error_cmnd1').html(data.error.cmnd1);
                    }
                    if(data.error.cmnd2){
                        $('.error_cmnd2').html(data.error.cmnd2);
                    }
                }
                $('.loadingcover').hide();
                $('#thay_doi_mat_khau')[0].reset();
            }
        });
    });
});

$(document).ready(function($) {
    $('.tab-title .information-title').click(function(e){
        var url_browse = $('.current-url').val();
        $('.information-box').addClass('active');
        history.pushState({}, null, url_browse+'?tab=tttk');
    });
    $('.tab-title .password-title').click(function(e){
        var url_browse = $('.current-url').val();
        $('.password-box').addClass('active');
        history.pushState({}, null, url_browse+'?tab=tdmk');
    });
    $('.tab-title .url-title').click(function(e){
        var url_browse = $('.current-url').val();
        $('.url-box').addClass('active');
        history.pushState({}, null, url_browse+'?tab=urlgt');
    });
    $('.btn-thay-doi-mat-khau').click(function(e){
        e.preventDefault();
        var _this = $(this);
        var url = $('#thay_doi_mat_khau').attr('action');
        var formData = new FormData($('#thay_doi_mat_khau')[0]);
        $('.error-message').html('');
        $('.loadingcover').show();
        $.ajax({
            url: url,
            type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('.loadingcover').hide();
                if(data.status==1){
                    toastr["success"](data.toastr, "");
                    $('#thay_doi_mat_khau')[0].reset();                    
                }else{                   
                    if(data.error.old_password){
                        $('.error_old_password').html(data.error.old_password);
                    }
                    if(data.error.new_password){
                        $('.error_new_password').html(data.error.new_password);
                    }
                    if(data.error.renew_password){
                        $('.error_renew_password').html(data.error.renew_password);
                    }
                }
                $('#cap_nhap_thong_tin').load(location.href + " #cap_nhap_thong_tin>*");
            }
        });
    });

    $('.btn-nap-tien').click(function(e){
        e.preventDefault();
        var _this = $(this);
        var url = $('#recharge-form').attr('action');
        var formData = new FormData($('#recharge-form')[0]);
        $('.error-message').html('');
        $('.loadingcover').show();
        $.ajax({
            url: url,
            type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status==1){
                    $('#recharge-form')[0].reset();
                    var url_browse = $('#get_url_path').val();
                    $('.recharge-bill').find('.preview-img').attr('src',url_browse+'/public/images/img-bill.png');
                    toastr["success"](data.toastr, "");
                }else{                          
                    if(data.error.sender){
                        $('.error_sender').html(data.error.sender);
                    }
                    if(data.error.bankname){
                        $('.error_bankname').html(data.error.bankname);
                    }
                    if(data.error.amount_money){
                        $('.error_amount_money').html(data.error.amount_money);
                    }
                    if(data.error.filename){
                        $('.error_filename').html(data.error.filename);
                    }
                    if(data.error.receiver){
                        $('.error_receiver').html(data.error.receiver);
                    }
                    if(data.error.trading_code){
                        $('.error_trading_code').html(data.error.trading_code);
                    }
                }
                $('.loadingcover').hide();
            },
            error: function(data){
                $('.loadingcover').hide();
                toastr["error"]('Has an error,please try again later', "");
            }
        });
    });
    $('.products-table .code-orders').click(function(e){
        e.preventDefault();
        var id_order = $(this).data('id');
        var url_browse = $('#get_url_path').val();
        $('.order-detail-content').html('<img src="'+url_browse+'/public/images/loader.gif'+'">');
        var hw = $(window).height();
        var hlg = $('.popup-content').height();
        var hpcs = parseInt(hlg) + 60;

        if (hpcs > hw) {
            $('.popups-box').css({'height': hw - 30, 'top': '0'});
        } else {
            $('.popups-box').css({'height': 'auto', 'top': 'auto'});
        }

        $('.art-popups-code-orders').addClass('active');
        $.ajax({
            url: url_browse+'/chi-tiet-don-hang/'+id_order,
            type:'GET',
            success: function(data) {
                $('.order-detail-content').html(data);
            }
        });
        
    });
    $('.popups-box').click(function(){
        $('.art-popups').removeClass('active');
    });
});