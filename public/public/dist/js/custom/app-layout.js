"use strict";
$(function () {
    $(".error").hide();
    document.cookie = "scrwid=" + window.innerWidth;
    document.cookie =
        "collapsedNavbar=" +
        $(".pcoded-navbar").hasClass("navbar-collapsed").toString();
});

// customer_header.blade.php
$('.lang').on('click', function() {
    var lang = $(this).data('shortname');
    var url = SITE_URL + '/change-lang';
    $.ajax({
        url: url,
        data: {
            _token: token,
            lang: lang,
            type: "admin",
        },
        type: "POST",
        success: function (data) {
            if (data == 1) {
                location.reload();
            }
        },
        error: function (xhr, desc, err) {
            return 0;
        },
    });
});

// header.blade.php
$(document).on("click", "#itemNotifications", function () {
    $("#notifications").html(
        '<img id="itemNotificationsLoader" src="' +
            SITE_URL +
            '/public/dist/img/loader/spiner.gif" />'
    );
    $.ajax({
        url: SITE_URL + "/item-notifications",
        method: "GET",
        success: function (data) {
            var itemNotifications = JSON.parse(data);
            var liElements = "";
            var counter = 0;
            $.each(itemNotifications, function (index, value) {
                liElements +=
                    '<li class="notification">' +
                    '<div class="media">' +
                    '<i class="fas fa-exclamation-triangle triangle-exclamation"></i>' +
                    '<div class="media-body">' +
                    '<p class="mr-20">Item Name :<strong>' +
                    value.name +
                    '</strong><span class="n-time text-muted"></p>' +
                    "<p>Quantity : <strong>" +
                    value.qty +
                    "</strong></p>" +
                    "</div>" +
                    "</div>" +
                    "</li>";
                counter++;
            });
            $("#itemCount").text(counter);
            $("#notifications").html(liElements);
        },
    });
});

$(function () {
    const dashPopup = $(".dash-popup-modal");
    const popUpContent = $(".dash-popup-modal .card-content");
    const popupLoader = $(".dash-popup-modal .card-loader");

    $(document).on("mouseenter", ".has-dash-popup", function (event) {
        console.log("hovered");
        setTimeout(() => {
            if (this.matches(":hover")) {
                var cord = this.getBoundingClientRect();
                dashPopup[0].style.left = cord.x + "px";
                dashPopup[0].style.top = cord.y + 40 + "px";
                dashPopup.addClass("popup-active");
                fillPopupData($(this).data("url"));
            }
        }, 1000);
    });

    $(document).on("mouseleave", ".has-dash-popup", function () {
        setTimeout(() => {
            clearPopup(this);
        }, 500);
    });

    dashPopup.mouseout(function () {
        setTimeout(() => {
            clearPopup(dashPopup[0]);
        }, 500);
    });

    const clearPopup = async (item = null) => {
        if (!item.matches(":hover") && !dashPopup[0].matches(":hover")) {
            dashPopup.removeClass("popup-active");
            popUpContent[0].innerHTML = "";
            popupLoader.removeClass("d-none");
        }
    };

    const fillPopupData = (url) => {
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        })
            .then((res) => res.json())
            .then((val) => {
                updatePopupContent(val.response.records);
            });
    };
    const updatePopupContent = async (_data) => {
        await popUpContent.html(_data);
        await popupLoader.addClass("d-none");
        let cords = getPlaceableCords(dashPopup[0].getBoundingClientRect());
        dashPopup[0].style.left = cords.x + "px";
        dashPopup[0].style.top = cords.y + "px";
    };

    const getPlaceableCords = (_cord) => {
        let wCord = {
            h: window.innerHeight,
            w: window.innerWidth,
        };
        return {
            x: getXCord(wCord, _cord),
            y: getYCord(wCord, _cord),
        };
    };

    const getXCord = (_wCord, _cord) => {
        if (_cord.x + _cord.width + 10 <= _wCord.w) {
            return _cord.x;
        }
        return getXCord(_wCord, {
            x: _cord.x - 10,
            width: _cord.width,
        });
    };

    const getYCord = (_wCord, _cord) => {
        if (_cord.y + _cord.height + 10 <= _wCord.h) {
            return _cord.y;
        }
        return getYCord(_wCord, {
            y: _cord.y - 10,
            height: _cord.height,
        });
    };
});
