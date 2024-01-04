"use strict";
allItemTags = JSON.parse(allItemTags)
allItemTags = Object.keys(allItemTags).map((key) =>  allItemTags[key]);
$( "#itemSearch" ).autocomplete({
    delay: 500,
    position: {my: "left top", at: "left bottom", collision: "flip"},
    source: allItemTags,
    select: function (event, ui) {
        let e = ui.item;
        window.location.href = SITE_URL+"/search-items?keyword="+encodeURI(e.value).replace(/%20/g, "+");
    },
    minLength: 1,
    autoFocus: false
});

$(document).ready(function() {
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }
    $('.custom-modal-over .close-modal').each(function() {
        var popupName = $(this).attr('data-popupName');
        var loginRequired = $(this).attr('data-loginRequired');
        var isLogin = $(this).attr('data-isLogin');
        var popupShowAfter = $(this).attr('data-popupShowAfter');
        var popupPage = $(this).attr('data-popupPage');

        if (!getCookie(popupName) && popupPage == 'true') {
            if (loginRequired == '1') {
                if (isLogin == 'true') {
                    setTimeout(() => {
                        $(this).closest('.custom-modal-over').show();
                    }, popupShowAfter * 1000);
                }
            } else {
                setTimeout(() => {
                    $(this).closest('.custom-modal-over').show();
                }, popupShowAfter * 1000);
            }
        }

        $('.custom-modal-over .close-modal').click(function() {
            $(this).closest('.custom-modal-over').hide();
            setCookie(popupName, true, 1);
        });
    });
})

$(document).on('submit', '#subscribe', function(e) {
    e.preventDefault();
    $('.send-btn').css('display', 'none');
    $('.subscribe-loader').css('display', 'inline');
    $('.subscribe-message').text('');
    $.ajax({
        type: 'post',
        url: subscribeUrl,
        data: new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $('.subscribe-message').text(data.message);
            $('.subscribe-loader').css('display', 'none');
            $('.send-btn').css('display', 'block');
        },
        error: function (data) {
            $('.subscribe-message').text(data.responseJSON.errors.email[0]);
            $('.subscribe-loader').css('display', 'none');
            $('.send-btn').css('display', 'block');
        }
    })
})

