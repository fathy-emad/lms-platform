(function ($) {
    "use strict";
    $(document).on('click', function (e) {
        var outside_space = $(".outside");
        if (!outside_space.is(e.target) &&
            outside_space.has(e.target).length === 0) {
            $(".menu-to-be-close").removeClass("d-block");
            $('.menu-to-be-close').css('display', 'none');
        }
    })

    $('.prooduct-details-box .close').on('click', function (e) {
        var tets = $(this).parent().parent().parent().parent().addClass('d-none');
        console.log(tets);
    })

    /*----------------------------------------
     password show hide
     ----------------------------------------*/
    $('.show-hide').show();
    $('.show-hide span').addClass('show');

    $('.show-hide span').click(function () {
        if ($(this).hasClass('show')) {
            $('input[name="login[password]"]').attr('type', 'text');
            $(this).removeClass('show');
        } else {
            $('input[name="login[password]"]').attr('type', 'password');
            $(this).addClass('show');
        }
    });
    $('form button[type="submit"]').on('click', function () {
        $('.show-hide span').addClass('show');
        $('.show-hide').parent().find('input[name="login[password]"]').attr('type', 'password');
    });

    /*=====================
      02. Background Image js
      ==========================*/
    $(".bg-center").parent().addClass('b-center');
    $(".bg-img-cover").parent().addClass('bg-size');
    $('.bg-img-cover').each(function () {
        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();
        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'display': 'block'
        });
        el.hide();
    });

    $(".mega-menu-container").css("display", "none");
    $(".header-search").click(function () {
        $(".search-full").addClass("open");
    });
    $(".close-search").click(function () {
        $(".search-full").removeClass("open");
        $("body").removeClass("offcanvas");
    });
    $(".mobile-toggle").click(function () {
        $(".nav-menus").toggleClass("open");
    });
    $(".mobile-toggle-left").click(function () {
        $(".left-header").toggleClass("open");
    });
    $(".bookmark-search").click(function () {
        $(".form-control-search").toggleClass("open");
    })
    $(".filter-toggle").click(function () {
        $(".product-sidebar").toggleClass("open");
    });
    $(".toggle-data").click(function () {
        $(".product-wrapper").toggleClass("sidebaron");
    });
    $(".form-control-search input").keyup(function (e) {
        if (e.target.value) {
            $(".page-wrapper").addClass("offcanvas-bookmark");
        } else {
            $(".page-wrapper").removeClass("offcanvas-bookmark");
        }
    });
    $(".search-full input").keyup(function (e) {
        console.log(e.target.value);
        if (e.target.value) {
            $("body").addClass("offcanvas");
        } else {
            $("body").removeClass("offcanvas");
        }
    });

    $('body').keydown(function (e) {
        if (e.keyCode == 27) {
            $('.search-full input').val('');
            $('.form-control-search input').val('');
            $('.page-wrapper').removeClass('offcanvas-bookmark');
            $('.search-full').removeClass('open');
            $('.search-form .form-control-search').removeClass('open');
            $("body").removeClass("offcanvas");
        }
    });
    $(".mode").on("click", function () {
        $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
        $('body').toggleClass("dark-only");
        var color = $(this).attr("data-attr");
        localStorage.setItem('body', 'dark-only');
    });

})(jQuery);

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
    } else {
        $('.tap-top').fadeOut();
    }
});



$('.tap-top').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}
(function ($, window, document, undefined) {
    "use strict";
    var $ripple = $(".js-ripple");
    $ripple.on("click.ui.ripple", function (e) {
        var $this = $(this);
        var $offset = $this.parent().offset();
        var $circle = $this.find(".c-ripple__circle");
        var x = e.pageX - $offset.left;
        var y = e.pageY - $offset.top;
        $circle.css({
            top: y + "px",
            left: x + "px"
        });
        $this.addClass("is-active");
    });
    $ripple.on(
        "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
        function (e) {
            $(this).removeClass("is-active");
        });


})(jQuery, window, document);


// active link

$(".chat-menu-icons .toogle-bar").click(function () {
    $(".chat-menu").toggleClass("show");
});


// Language
var tnum = 'en';

$(document).ready(function () {

    if (localStorage.getItem("primary") != null) {
        var primary_val = localStorage.getItem("primary");
        $("#ColorPicker1").val(primary_val);
        var secondary_val = localStorage.getItem("secondary");
        $("#ColorPicker2").val(secondary_val);
    }


    $(document).click(function (e) {
        $('.translate_wrapper, .more_lang').removeClass('active');
    });
    $('.translate_wrapper .current_lang').click(function (e) {
        e.stopPropagation();
        $(this).parent().toggleClass('active');

        setTimeout(function () {
            $('.more_lang').toggleClass('active');
        }, 5);
    });


    /*TRANSLATE*/
    // translate(tnum);

    // $('.more_lang .lang').click(function () {
    //     $(this).addClass('selected').siblings().removeClass('selected');
    //     $('.more_lang').removeClass('active');

    //     var i = $(this).find('i').attr('class');
    //     var lang = $(this).attr('data-value');
    //     var tnum = lang;
    //     translate(tnum);

    //     $('.current_lang .lang-txt').text(lang);
    //     $('.current_lang i').attr('class', i);


    // });
});

// function translate(tnum) {
//     $('.lan-1').text(trans[0][tnum]);
//     $('.lan-2').text(trans[1][tnum]);
//     $('.lan-3').text(trans[2][tnum]);
//     $('.lan-4').text(trans[3][tnum]);
//     $('.lan-5').text(trans[4][tnum]);
//     $('.lan-6').text(trans[5][tnum]);
//     $('.lan-7').text(trans[6][tnum]);
//     $('.lan-8').text(trans[7][tnum]);
//     $('.lan-9').text(trans[8][tnum]);
// }

// var trans = [{
//         en: 'General',
//         pt: 'Geral',
//         es: 'Generalo',
//         fr: 'GÃ©nÃ©rale',
//         de: 'Generel',
//         cn: 'ä¸€èˆ¬',
//         ae: 'Ø­Ø¬Ù†Ø±Ø§Ù„ Ù„ÙˆØ§Ø¡'
//     }, {
//         en: 'Dashboards,widgets & layout.',
//         pt: 'PainÃ©is, widgets e layout.',
//         es: 'Paneloj, fenestraÄµoj kaj aranÄo.',
//         fr: "Tableaux de bord, widgets et mise en page.",
//         de: 'Dashboards, widgets en lay-out.',
//         cn: 'ä»ªè¡¨æ¿ï¼Œå°å·¥å…·å’Œå¸ƒå±€ã€‚',
//         ae: 'Ù„ÙˆØ­Ø§Øª Ø§Ù„Ù…Ø¹Ù„ÙˆÙ…Ø§Øª ÙˆØ§Ù„Ø£Ø¯ÙˆØ§Øª ÙˆØ§Ù„ØªØ®Ø·ÙŠØ·.'
//     }, {
//         en: 'Dashboards',
//         pt: 'PainÃ©is',
//         es: 'Paneloj',
//         fr: 'Tableaux',
//         de: 'Dashboards',
//         cn: ' ä»ªè¡¨æ¿ ',
//         ae: 'ÙˆØ­Ø§Øª Ø§Ù„Ù‚ÙŠØ§Ø¯Ø© '
//     }, {
//         en: 'Default',
//         pt: 'PadrÃ£o',
//         es: 'Vaikimisi',
//         fr: 'DÃ©faut',
//         de: 'Standaard',
//         cn: 'é›»å­å•†å‹™',
//         ae: 'ÙˆØ¥ÙØªØ±Ø§Ø¶ÙŠ'
//     }, {
//         en: 'Ecommerce',
//         pt: 'ComÃ©rcio eletrÃ´nico',
//         es: 'Komerco',
//         fr: 'Commerce Ã©lectronique',
//         de: 'E-commerce',
//         cn: 'é›»å­å•†å‹™',
//         ae: 'ÙˆØ§Ù„ØªØ¬Ø§Ø±Ø© Ø§Ù„Ø¥Ù„ÙƒØªØ±ÙˆÙ†ÙŠØ©'
//     }, {
//         en: 'Widgets',
//         pt: 'Ferramenta',
//         es: 'Vidin',
//         fr: 'Widgets',
//         de: 'Widgets',
//         cn: 'å°éƒ¨ä»¶',
//         ae: 'ÙˆØ§Ù„Ø­Ø§Ø¬ÙŠØ§Øª'
//     }, {
//         en: 'Page layout',
//         pt: 'Layout da pÃ¡gina',
//         es: 'PaÄa aranÄo',
//         fr: 'Tableaux',
//         de: 'Mise en page',
//         cn: 'é é¢ä½ˆå±€',
//         ae: 'ÙˆØªØ®Ø·ÙŠØ· Ø§Ù„ØµÙØ­Ø©'
//     }, {
//         en: 'Applications',
//         pt: 'FormulÃ¡rios',
//         es: 'Aplikoj',
//         fr: 'Applications',
//         de: 'Toepassingen',
//         cn: 'æ‡‰ç”¨é ˜åŸŸ',
//         ae: 'ÙˆØ§Ù„ØªØ·Ø¨ÙŠÙ‚Ø§Øª'
//     }, {
//         en: 'Ready to use Apps',
//         pt: 'Pronto para usar aplicativos',
//         es: 'Preta uzi Apps',
//         fr: ' Applications prÃªtes Ã  lemploi ',
//         de: 'Klaar om apps te gebruiken',
//         cn: 'ä»ªè¡¨æ¿',
//         ae: 'Ø¬Ø§Ù‡Ø² Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù… Ø§Ù„ØªØ·Ø¨ÙŠÙ‚Ø§Øª'
//     },

// ];

$(".mobile-title svg").click(function () {
    $(".header-mega").toggleClass("d-block");
});

$(".header-mega").click(function () {
    $(".header-mega").addClass("d-block");
});


$(".onhover-dropdown").on("click", function () {
    $(this).children('.onhover-show-div').toggleClass("active");
});

// if ($(window).width() <= 991) {
//     $(".left-header .link-section").children('ul').css('display', 'none');
//     $(this).parent().children('ul').toggleClass("d-block").slideToggle();
// }


// if ($(window).width() < 991) {
//     $('<div class="bg-overlay"></div>').appendTo($('body'));
//     $(".bg-overlay").on("click", function () {
//         $(".page-header").addClass("close_icon");
//         $(".sidebar-wrapper").addClass("close_icon");
//         $(this).removeClass("active");
//     });

//     $(".toggle-sidebar").on("click", function () {
//         $(".bg-overlay").addClass("active");
//     });
//     $(".back-btn").on("click", function () {
//         $(".bg-overlay").removeClass("active");
//     });
// }

$("#flip-btn").click(function(){
    $(".flip-card-inner").addClass("flipped")
});

$("#flip-back").click(function(){
    $(".flip-card-inner").removeClass("flipped")
})


function submitForm(submit)
{
    //Collect form data
    $(submit).prop("disabled", true);
    let form = $(submit).closest("form");
    let action = form.attr("action");
    let method = form.attr("method").toUpperCase();
    let locale = form.attr("locale");
    let csrf = form.attr("csrf");
    let formData = new FormData(form[0]); // form[0] gets the native form element

    //Before send new request do
    form.find("[name]").removeClass("is-invalid");
    form.removeClass("was-validated");

    //Send request
    $.ajax({
        url: action,
        type: method,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'locale': locale,
        },
        success: function(response, textStatus, jqXHR) {
            //Case is login
            $(submit).prop("disabled", true);
            if (response.success && action.split("/")[action.split("/").length - 1] === "login") {
                let data = JSON.stringify(response.data);
                $.ajax({
                    url: "http://127.0.0.1:8000/admin/create/session",
                    type: "POST",
                    processData: false,
                    data: data,
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function(response) {

                        let title = "Login Successfully";
                        let message = "You will redirect to dashboard";
                        notifyForm(title, message, "success", function () {
                            window.location = "http://127.0.0.1:8000/admin/dashboard";
                        }, 0, 3000);

                    },
                    error: function(xhr) {
                        $(submit).prop("disabled", false);
                        let title = "Some thing went wrong";
                        let message = xhr.responseText || "Unknown error";
                        notifyForm(title, message, "danger");
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            $(submit).prop("disabled", false);
            let title = "";
            let message = "";

            if(xhr.status === 422 && xhr.responseJSON.success == false ) {
                let response = xhr.responseJSON;
                let errors = response.errors;
                message = "<ul>";
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        form.find("[name=" + key + "]").addClass("is-invalid");
                        form.addClass("was-validated");
                        message += `<li>${errors[key]}</li>`;
                    }
                }
                message += "</ul>";
                title = response.message;

            } else {
                title = "Some thing went wrong";
                message = xhr.responseText || "Unknown error";
            }

            notifyForm(title, message, "danger");
        }
    });
}

function notifyForm(title, message, type, callback, delay = 1000, timer = 10000)
{

    $.notify(
        {
            title: title,
            message: message
        },
        {
            type: type,
            allow_dismiss:true,
            newest_on_top:true ,
            mouse_over:true,
            showProgressbar:false,
            spacing:50,
            timer:timer,
            placement:{
                from:'bottom',
                align:'right'
            },
            offset:{
                x:30,
                y:30
            },
            delay:delay ,
            z_index:10000,
            animate:{
                enter:'animated shake',
                exit:'animated shake'
            }
        }
    );

    // Calculate total duration the notification will be on screen
    const totalDuration = delay + timer;

    // Set a timeout to execute the callback after the notification is done
    if (typeof callback === 'function') {
        setTimeout(callback, totalDuration);
    }
}


$(document).ready(function() {
    // This ensures your code runs after the DOM has fully loaded.

    $(document).ajaxStop(function() {
        // This event is triggered when all AJAX requests have completed.
        $('.loader-wrapper').fadeOut('slow', function() {
            $(this).remove(); // Remove the element after the fadeOut animation.
        });
    });
});
