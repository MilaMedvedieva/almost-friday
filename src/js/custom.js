$(function() {

    function smoothScrolling() {
        $('a[href^="#"].scroll ').on("click", function (event) {
            event.preventDefault();
            var id  = $(this).attr('href'),
                top = $(id).offset().top - 100;

            $('body,html').animate({scrollTop: top}, 1000);
        });
    }
    function imageGallery() {
        $( ".img-wrapper" ).hover(
            function() {
                $(this).find(".img-overlay").animate({opacity: 1}, 600);
            }, function() {
                $(this).find(".img-overlay").animate({opacity: 0}, 600);
            }
        );

        var $overlay = $('<div id="overlay"></div>');
        var $image = $("<img>");
        var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
        var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
        var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

        $overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
        $("#gallery").append($overlay);

        $overlay.hide();

        $(".img-overlay").click(function(event) {
            event.preventDefault();
            var imageLocation = $(this).prev().attr("href");
            $image.attr("src", imageLocation);
            $overlay.fadeIn("slow");
        });

        $overlay.click(function() {
            $(this).fadeOut("slow");
        });

        $nextButton.click(function(event) {
            $("#overlay img").hide();
            var $currentImgSrc = $("#overlay img").attr("src");
            var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
            var $nextImg = $($currentImg.closest(".image").next().find("img"));
            var $images = $("#image-gallery img");
            if ($nextImg.length > 0) {
                $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
            } else {
                $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
            }
            event.stopPropagation();
        });

        $prevButton.click(function(event) {
            $("#overlay img").hide();
            var $currentImgSrc = $("#overlay img").attr("src");
            var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
            var $nextImg = $($currentImg.closest(".image").prev().find("img"));
            $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
            event.stopPropagation();
        });

        $exitButton.click(function() {
            $("#overlay").fadeOut("slow");
        });
    }
    function openMobilMenu() {
        const burger = $('.burger');
        const menu = $('.menu-wrap');

        $( burger ).on( "click", function() {
            $( 'body' ).toggleClass('hidden');
            $( this ).toggleClass( 'active');
            $( menu ).toggleClass( 'active');
        });
    }
    function menuDesktop() {
        if ( $(window).width() > 991 ) {
            const logo = $('header .logo');
            $('.menu-wrapper:first-child').after(logo);
            $('#menu-left-side').append('<a href="#" class="subscribe" data-info="Subscribe"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">\n' +
                '<path d="M507.49,101.721L352.211,256L507.49,410.279c2.807-5.867,4.51-12.353,4.51-19.279V121 C512,114.073,510.297,107.588,507.49,101.721z"/>\n' +
                '<path d="M467,76H45c-6.927,0-13.412,1.703-19.279,4.51l198.463,197.463c17.548,17.548,46.084,17.548,63.632,0L486.279,80.51 C480.412,77.703,473.927,76,467,76z"/>\n' +
                '<path d="M4.51,101.721C1.703,107.588,0,114.073,0,121v270c0,6.927,1.703,13.413,4.51,19.279L159.789,256L4.51,101.721z"/>\n' +
                '<path d="M331,277.211l-21.973,21.973c-29.239,29.239-76.816,29.239-106.055,0L181,277.211L25.721,431.49 C31.588,434.297,38.073,436,45,436h422c6.927,0,13.412-1.703,19.279-4.51L331,277.211z"/>\n' +
                '</svg></a>');
        }
    }
    function openPackage() {
        const item = $('.type-list').find('.item');

        $(item).each(function (value) {
            const arrow = $(this).find('.arrow');

            $(arrow).on("click", function () {
                const asd = this.parentElement.parentElement;
                $(arrow).toggleClass('active')
                $(asd).find('.packages').toggleClass('open')
            });
        });
    }
    function openNewsletter() {
        const icon = $('.subscribe');
        const modal = $('.modalSubscribe');
        const close = $(modal).find('.close');

        $(icon).on("click", function (e) {
            e.preventDefault();
            $(modal).addClass('active');
        });

        $(close).on("click", function () {
            $(modal).removeClass('active');
            console.log('modal', close)
        });
    }
    function changeBackgroundHeader() {
        $(window).scroll(function() {
            const height = $(window).scrollTop();

            if( height > 100 ){
                $( 'header' ).addClass( 'header-white' );
            } else{
                $( 'header' ).removeClass( 'header-white' );
            }
        });
    }
    function submitForm() {
        $('#subscribe').on('submit', function (e) {
            const ajaxurl = '/wp-admin/admin-ajax.php';
            e.preventDefault();
            var obj = $(this);
            var form = $(this).serialize();
            $.post({
                url: ajaxurl,
                data: form,
                success: function (data) {
                    setTimeout(function () {
                        $('.success').css('display', 'flex');
                    },1000);
                    setTimeout(function () {
                        $('.icon').addClass('active');
                        $("#subscribe").trigger("reset");
                    },2000);
                    setTimeout(function () {
                        $('.success').css('display', 'none');
                    },4000);
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
    }
    function setCaretMenu() {
        let item = $('.menu > li.menu-item-has-children > a');
        item.append('<span class="caret"></span>');

        if ( $(window).width() < 991 ) {
            var sub_item = $('.menu ul li.menu-item-has-children > a');
            sub_item.append('<span class="caret"></span>');
        }
    }
    function openSubMobilMenu() {
        $("li.menu-item-has-children .caret").on('click', function (e) {
            e.preventDefault();
            $(this).parent().next().toggleClass('show');
        });
        $("ul.menu a[href='#']").click(function (e) {
            e.preventDefault();
        });
    }
    function openBookNow(){
        const btn = $('.btn-bookNow');
        const modal = $('.modalBookNow');
        const close = modal.find('.close');
        btn.on("click", function (e) {
            e.preventDefault();
            modal.addClass('active');
        });
        close.on("click", function () {
            modal.removeClass('active');
        });
    }
    function submitBookNow(){
        $('#formBookNow').on('submit', function (e) {
            e.preventDefault();
            let user_name = $(this).find("input[name='user_name']").val();
            let user_email = $(this).find("input[name='user_email']").val();
            let user_phone = $(this).find("input[name='user_tel']").val();
            console.log(user_name,user_email,user_phone)
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'actionFormBookNow',
                    user_name: user_name,
                    user_tel: user_phone,
                    user_email: user_email,
                },
                success: function success(response){
                    console.log(response);
                    $("#formBookNow")[0].reset();
                    setTimeout(function () {
                        window.location.href="/thank-you";
                    },300);
                },
                error: function error(data){
                    console.log(error);
                }
            })
        });

    }

    setCaretMenu();
    openSubMobilMenu();
    openMobilMenu();
    menuDesktop();
    openPackage();
    openNewsletter();
    changeBackgroundHeader();
    submitForm();
    imageGallery();
    smoothScrolling();
    openBookNow();
    submitBookNow();

});
