"use strict";
if ($('.main-body .page-wrapper').find('#order-checkout-container').length) {
    checkedAddress();
    var tabName = "old";
    checkTab();
    function checkTab() {
        $(".selected-tab").each(function() {
            if ($(this).hasClass("is-active")) {
                tabName = $(this).attr("data-tab");
                $("#selected_tab").val(tabName);
            }
        });
    }
    $(document).on("keyup", ".positive-int-number", function () {
        var number = $(this).val();
        $(this).val(number.replace(/[^0-9]/g, ""));
    });

    $('#default-address').on('change', function(e) {
        if ($(this).is(":checked")) {
            $.ajax({
                url: SITE_URL + "/user/check-default-address",
                data: {
                    user_id: userId,
                    "_token": token
                },
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-start',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    if (data.status == 1) {
                        $('#new-address').prop('checked',false);
                        hideRequired();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: jsLang('Default address not found! Please create a address & make it default')
                        })
                        showRequired();
                        $('#default-address').prop('checked',false);
                    }
                }
            });
        }
    });

    function hideRequired()
    {
        $('.address-form').hide();
        $.each($('.required-field'), function (){
            $(this).prop('required',false);
            $(this).removeAttr('oninvalid');
            $(this).next("label").remove();
            $(this).attr('readonly', true);
        });
        $.each($('.has-validation-error'), function (){
            $(this).removeClass('has-validation-error');
        });
    }

    function showRequired()
    {
        $('.address-form').show();
        $.each($('.required-field'), function (){
            $(this).prop('required',true);
            $(this).attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $(this).attr('readonly', false);

        });
    }

    $("#addressForm").on('submit', function(event) {
        if($('.type_of_place').is(":checked") || tabName == "old") {
            $('#errorMsg').removeClass('error');
            $('#errorMsg').text('');
        } else {
            $('#errorMsg').addClass('error');
            $('#errorMsg').text(jsLang('This field is required.'));
            event.preventDefault();
        }
    })

    $('#makePayment').on('click', function(e) {
        if($('.type_of_place').is(":checked")) {
            $('#errorMsg').removeClass('error');
            $('#errorMsg').text('');
        } else {
            $('#errorMsg').addClass('error');
            $('#errorMsg').text(jsLang('This field is required.'));
        }
    });

    $('.type_of_place').on('change', function(e) {
        if ($(this).is(":checked")) {
            $('#errorMsg').removeClass('error');
            $('#errorMsg').text('');
        }
    });

    $('.selected-tab').on('click', function(e) {
         tabName = $(this).attr('data-tab');
        if (tabName == 'old') {
            hideRequired();
        } else {
            showRequired();
        }
        $("#selected_tab").val(tabName);
    });

    function checkedAddress()
    {
        $(".address-radio").each(function() {
            if ($(this).is(":checked")) {
                let addressId = $(this).attr('data-addressId');
                $("#address_id").val(addressId);
                hideRequired();
            }
        });
    }

    $('.address-radio').click(function(){
        let address_box = $(this).closest("div.adress-container");
        let addressId = $(this).attr('data-addressId');
        $("#address_id").val(addressId);
        hideRequired();
        $(this).closest("div.adress-container").addClass('border-gray-12').removeClass('border-gray-2');
        address_box.find('.s-icon').removeClass('hidden');
        address_box.find('.ab-name, .ab-label').addClass('text-gray-12').removeClass('text-gray-10');
        let address_container= $(this).closest('div.c-tab');
        let address_box_all=address_container.children();

        for(let i = 0; i<address_box_all.length; i++){
            let a_box = $(address_box_all[i]);
            if(a_box[0] !== address_box[0]){
                a_box.removeClass('border-gray-12');
                a_box.find('.s-icon').addClass('hidden');
                a_box.find('.ab-name, .ab-label').removeClass('text-gray-12').addClass('text-gray-10');
            }
        }
    })

    //Breadcrumbs functionality for checkout page
    function Tabs(options){

        var tabs = document.querySelector(options.el);
        var initCalled = false;
        var tabNavigation = tabs.querySelector(".c-tabs-nav");
        var tabNavigationLinks = tabs.querySelectorAll(".c-tabs-nav__link");
        var tabContentContainers = tabs.querySelectorAll(".c-tab");

        var marker = options.marker ? createNavMarker() : false;

        var activeIndex = 0;

      function init(){
            if (!initCalled){
                initCalled = true;

                for (var i = 0; i < tabNavigationLinks.length; i++){
                    var link = tabNavigationLinks[i];
                    clickHandlerSetup(link, i)
                }

                if (marker){
                    setMarker(tabNavigationLinks[activeIndex]);
                }
            }
        }

        function clickHandlerSetup(link, index){
            link.addEventListener("click", function(e){
                e.preventDefault();
                goToTab(index);
            })
        }

        function goToTab(index){
            if (index >= 0 && index != activeIndex && index <= tabNavigationLinks.length){
                tabNavigationLinks[activeIndex].classList.remove('is-active');
                tabNavigationLinks[index].classList.add('is-active');

                tabContentContainers[activeIndex].classList.remove('is-active');
                tabContentContainers[index].classList.add('is-active');

                if (marker){
                    setMarker(tabNavigationLinks[index]);
                }

                activeIndex = index;
            }
        }

        function createNavMarker(){
            var marker = document.createElement("div");
            marker.classList.add("c-tab-nav-marker");
            tabNavigation.appendChild(marker);
            return marker;
        }

        function setMarker(element){
            marker.style.left = element.offsetLeft +"px";
            marker.style.width = element.offsetWidth + "px";
            }

            return {
                init: init,
                goToTab: goToTab
            }
    }


        var m = new Tabs({
            el: "#tabs",
            marker: true
        });

        m.init();

}
