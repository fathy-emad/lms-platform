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

function submitForm(submit, datatable = null, successCallback = null, errorCallback = null)
{
    //Collect form data
    $(submit).prop("disabled", true);
    let form = $(submit).closest("form");
    let action = form.attr("action");
    let method = form.attr("method").toUpperCase();
    let locale = form.attr("locale") || 'ar';
    let csrf = form.attr("csrf") || '';
    let authorization = form.attr("authorization");
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
            'Authorization': 'Bearer ' + authorization,
            'locale': locale,
        },
        success: function(response, textStatus, jqXHR) {
            let entity = action.split("/")[action.split("/").length - 3];
            if (response.success) {
                if (action.split("/").pop() === "login") {
                    handleLoginSuccess(response, entity, csrf, submit);
                } else if (action.split("/").pop() === "logout") {
                    handleLogoutSuccess(entity, csrf, submit);
                } else {
                    handleFormSuccess(response, form, datatable, submit, successCallback);
                }

            } else {
                handleFormError(submit, response.message || "Unknown error", errorCallback);
            }
        },
        error: function(xhr) {
            handleAjaxError(xhr, form, submit, errorCallback);
        }
    });
}

function handleLoginSuccess(response, entity, csrf, submit) {
    let data = JSON.stringify(response.data);
    $.ajax({
        url: APP_URL + "/create/session/" + entity,
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
                window.location = APP_URL + "/" + entity + "/dashboard";
            }, 0, 1000);
        },
        error: function(xhr) {
            handleFormError(submit, xhr.responseText || "Unknown error");
        }
    });
}

function handleLogoutSuccess(entity, csrf, submit) {
    $.ajax({
        url: APP_URL + "/destroy/session/" + entity,
        type: "POST",
        processData: false,
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        success: function(response) {
            let title = "Logout Successfully";
            let message = "You will redirect to login";
            notifyForm(title, message, "success", function () {
                window.location = "http://127.0.0.1:8000/" + entity + "/auth/login";
            }, 0, 1000);
        },
        error: function(xhr) {
            handleFormError(submit, xhr.responseText || "Unknown error");
        }
    });
}

function handleFormSuccess(response, form, datatable, submit, successCallback) {
    $(submit).prop("disabled", false);
    form[0].reset();
    form.find("[name]").removeClass("is-invalid");
    form.removeClass("was-validated");
    if (datatable) {
        datatable.DataTable().ajax.reload(null, false);
    }
    form.closest(".modal").find(".btn-close").click();
    let title = response.message;
    let message = "";
    notifyForm(title, message, "success", successCallback, 0, 3000);
}

function handleAjaxError(xhr, form, submit, errorCallback) {
    $(submit).prop("disabled", false);
    let title = "Some thing went wrong";
    let message = xhr.responseText || "Unknown error";
    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.success == false) {
        let response = xhr.responseJSON;
        let errors = response.errors;
        message = "<ul>";
        for (let key in errors) {
            if (errors.hasOwnProperty(key)) {
                form.find("[name='" + key + "']").addClass("is-invalid");
                message += `<li>${errors[key]}</li>`;
            }
        }
        message += "</ul>";
        title = response.message;
    }
    notifyForm(title, message, "danger", errorCallback);
}

function handleFormError(submit, message, successCallback) {
    $(submit).prop("disabled", false);
    let title = "Some thing went wrong";
    notifyForm(title, message, "danger", successCallback);
}

function notifyForm(title, message, type, callback, delay = 0, timer = 10000)
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
            delay:delay,
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
    if (typeof callback === 'function' && callback) {
        setTimeout(callback, totalDuration);
    }
}

function fileUploadBuilder(element, name, value, title, accept) {
    $(element).find("[data-file=container]").remove();
    let template = `<div class="border border-2 rounded-3 p-2 row justify-content-around align-items-center" data-file="container">
                                <div class="col-1"><img data-file="preview" class="border border-1 round-badge-primary"
                                    src="${value ? APP_URL+'/uploads/'+value.file : APP_URL + '/assets/images/no-image.jpg'}" alt="no-image" width="75" height="60"></div>
                                <div class="col-1">
                                    <input type="hidden" name="${name}[key]" data-file="key" value="${value ? value.key : ''}">
                                    <input type="file" name="${name}[file]" data-file="file" accept="${accept}" style="display: none">
                                    <button type="button" data-file="upload" class="btn btn-lg btn-success" style="height: 60px !important;" onclick="$(this).prev().click()" title="upload file"><i class="fa fa-cloud-upload"></i></button>
                                </div>
                                <div class="col-6 title-container">
                                    <div class="input-group-square">
                                        <div class="input-group" style="height: 60px !important;">
                                            <div class="input-group-prepend"><span class="input-group-text" style="height: 100% !important;">title</span></div>
                                            <input class="form-control" type="text" data-file="title" placeholder="title image" value="${value ? value.title : ''}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="button" data-file="reset" class="btn btn-lg btn-danger" style="height: 60px !important;" title="reset file"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>`;
    element.append(template);
    if (!title) $(element).find(".title-container").hide();
    $(element).find("[data-file=file]").on("change", function (event){
        let file = event.target.files[0];
        let reader = new FileReader();
        reader.onload = function(e) {
            $(element).find("[data-file=preview]").attr('src', e.target.result); // Set the src of the img tag
        };
        reader.readAsDataURL(file);
        $(element).find("[data-file=key]").val('');
    });
    $(element).find("[data-file=reset]").on("click", function (){
        $(element).find("[data-file=key]").val('');
        $(element).find("[data-file=file]").val('');
        $(element).find("[data-file=preview]").attr('src', `${APP_URL}/assets/images/no-image.jpg`);
    });
}


function filesUploadBuilder(element, name, values, title, accept) {
    $(element).find("[data-file=container]").remove();
    let template = `<div class="border border-2 rounded-3 p-2 row mb-2 justify-content-around align-items-center" data-file="container">
                                <div class="col-1"><img data-file="preview" class="border border-1 round-badge-primary" src="${APP_URL + '/assets/images/no-image.jpg'}" alt="no-image" width="75" height="60"></div>
                                <div class="col-1">
                                    <input type="hidden" data-file="key" value="">
                                    <input type="file"  data-file="file" accept="${accept}" style="display: none">
                                    <button type="button" data-file="upload" class="btn btn-lg btn-success" style="height: 60px !important;" onclick="$(this).prev().click()" title="upload file"><i class="fa fa-cloud-upload"></i></button>
                                </div>
                                <div class="col-6 title-container">
                                    <div class="input-group-square">
                                        <div class="input-group" style="height: 60px !important;">
                                            <div class="input-group-prepend"><span class="input-group-text" style="height: 100% !important;">title</span></div>
                                            <input class="form-control" type="text" data-file="title" placeholder="title image" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="button" data-file="reset" class="btn btn-lg btn-primary" style="height: 60px !important;" title="reset file"><i class="fa fa-refresh"></i></button>
                                </div>
                                <div class="col-1">
                                    <button type="button" data-file="add" class="btn btn-lg btn-success" style="height: 60px !important;" title="add file"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-1">
                                    <button type="button" data-file="remove" class="btn btn-lg btn-danger" style="height: 60px !important;" title="delete file"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>`;


    if (values && values.length){
        for (const i in values) {
            add(values[i]);
        }
    } else {
        add();
    }


    function add(value= null){
        let clone = $(template).clone(true);
        if (!title) $(clone).find(".title-container").hide();
        if (value){
            $(clone).find('[data-file=key]').val(value.key);
            $(clone).find('[data-file=title]').val(value.title);
            $(clone).find('[data-file=preview]').attr('src', APP_URL+'/uploads/'+value.file);
        }
        $(clone).find('[data-file=add]').on('click', function (){ add() });
        $(clone).find('[data-file=reset]').on('click', function (){ reset(clone) });
        $(clone).find('[data-file=remove]').on('click', function (){ remove(clone) });
        $(clone).find('[data-file=file]').on('change', function (e){ change(e, clone) });
        element.append(clone);
        arrange(value);
    }

    function change(event, clone){
        let file = event.target.files[0];
        let reader = new FileReader();
        reader.onload = function(e) {
            $(clone).find("[data-file=preview]").attr('src', e.target.result); // Set the src of the img tag
        };
        reader.readAsDataURL(file);
        $(clone).find("[data-file=key]").val('');
    }

    function reset(clone){
        $(clone).find("[data-file=key]").val('');
        $(clone).find("[data-file=file]").val('');
        $(clone).find("[data-file=preview]").attr('src', `${APP_URL}/assets/images/no-image.jpg`);
    }

    function remove(clone) {
        $(clone).remove();
        arrange();
    }

    function arrange(){
        let counter = 0;
        $(element).find("[data-file=container]").each(function (){
            $(this).find('[data-file=key]').attr('name', `${name}[${counter}][key]`);
            $(this).find('[data-file=file]').attr('name', `${name}[${counter}][file]`);
            $(this).find('[data-file=title]').attr('name', `${name}[${counter}][title]`);
            counter++;
        });
    }

}

$(document).ready(function() {

    $('.loader-wrapper').fadeOut('slow', function() {
        $(this).remove(); // Remove the element after the fadeOut animation.
    });

    //init datatable if found
    if ($("#data-table-ajax").length){

        let table = $('#data-table-ajax').DataTable({
            "processing": false,
            //"serverSide": true,
            "ajax": {
                "url": datatableUri,
                "type": "GET",
                "headers": {
                    'Authorization': 'Bearer ' + datatableAuthToken,
                    'locale': dataTableLocale,
                },
                "dataSrc": function (json) {
                    return json.data;
                }
            },
            "columns": datatableColumns,
            "rowReorder": {
                selector: dataTableReorder ? dataTableReorder.selector : '0',
            }
        });

        if (dataTableReorder){
            table.on('row-reorder', function (e, details, changes) {

                if (details.length) {
                    let reorderMapping = details.map(detail => ({
                        id: table.row(detail.node).data().id,
                        priority: detail.newPosition + 1 // Calculate new priority
                    }));
                    // AJAX call to server to update priorities
                    $.ajax({
                        url: dataTableReorder.uri,
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({reorder: reorderMapping}),
                        headers: {
                            'Authorization': 'Bearer ' + datatableAuthToken,
                            'locale': dataTableLocale,
                        },
                        success: function(response) {
                            notifyForm("reorder", response.message, "success",null, 0, 5000);
                            table.ajax.reload(null, false); // Reload the DataTable to reflect changes
                        },
                        error: function(xhr) {
                            if(xhr.status === 422 && xhr.responseJSON.success === false ) {
                                let response = xhr.responseJSON;
                                let errors = response.errors;
                                message = "<ul>";
                                for (let key in errors) {
                                    if (errors.hasOwnProperty(key)) {
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
            });
        }
    }

});
