
    $("#loginForm").on('submit', function(event) {
        event.preventDefault();
        $('.login-modal-loader').css('display', 'inline');
        $.ajax({
            url: SITE_URL + "/authenticate",
            type: 'post',
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status == 1) {
                    $('.login-message').removeClass('border border-reds-3');
                    $('.login-message').addClass('bg-green-2 mb-6 mt-8 rounded border border-green-1').html(`
                        <h1 class="roboto-medium font-medium ml-52p text-green-1">${data.message}</h1>
                        <span class="absolute top-2 left-2.5 border-r h-8 border-green-1 pl-1.5 pr-3">
                            <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3163 0.462473C17.5102 -0.242925 16.3121 -0.128557 15.6403 0.717921L8.80424 9.33189C8.14548 10.162 7.77515 10.6215 7.47948 10.9039C7.47564 10.9076 7.47188 10.9112 7.46818 10.9147C7.46419 10.9115 7.46013 10.9083 7.456 10.9051C7.13719 10.6519 6.72875 10.2295 6.00113 9.4654L3.2435 6.56972C2.5015 5.79059 1.29849 5.79059 0.556498 6.56972C-0.185497 7.34886 -0.185497 8.61209 0.556498 9.39123L3.31413 12.2869C3.34002 12.3141 3.36587 12.3412 3.39168 12.3684C4.01203 13.02 4.60881 13.6469 5.16407 14.0878C5.78606 14.5817 6.60062 15.0461 7.6445 14.9963C8.68838 14.9466 9.45955 14.4067 10.0364 13.8557C10.5514 13.3639 11.0916 12.6828 11.6532 11.9749C11.6766 11.9454 11.7 11.9159 11.7235 11.8864L18.5596 3.27239C19.2313 2.42592 19.1224 1.16787 18.3163 0.462473Z" fill="#009651"/>
                            </svg>
                        </span>

                    `);
                    function check_cookie(name){
                        return document.cookie.split(';').some(c => {
                            return c.trim().startsWith(name + '=');
                        });
                    }
                    function getCookie(cname) {
                        let name = cname + "=";
                        let decodedCookie = decodeURIComponent(document.cookie);
                        let ca = decodedCookie.split(';');
                        for(let i = 0; i <ca.length; i++) {
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

                    if (check_cookie('item_id')) {
                        $.ajax({
                            url: SITE_URL + "/user/wishlist/store",
                            type: 'POST',
                            dataType: 'JSON',
                            data:{
                                item_id: getCookie('item_id'),
                                store_only: true,
                                "_token": token
                            },
                            success: function (data) {
                                document.cookie = "item_id=; Max-Age=-99999999;";
                                window.location.href = SITE_URL;
                            }
                        })
                    }
                    window.location.href = currentUrl;

                } else {
                    $('.login-message').addClass('bg-pinks-2 mb-6 mt-8 border border-reds-3 rounded').html(`
                        <h1 class="roboto-medium font-medium text-reds-3 ml-52p">${data.message}</h1>
                        <span class="absolute top-2 left-2.5 border-r h-8 border-reds-3 pl-1.5 pr-3">
                            <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10C0 15.5228 4.47715 20 10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10ZM11 9V10V16V17H9V16V10V9H11ZM9 5V6H11V5V4V3H9V4V5Z" fill="#C8191C"/>
                            </svg>
                        </span>

                    `).show();
                    $('.login-modal-loader').css('display', 'none');
                }
            },
            error: function (data) {
                var error = '';
                $('.login-modal-loader').css('display', 'none');
                if (data.responseJSON.errors != undefined && data.responseJSON.errors.gCaptcha != undefined) {
                    $('.login-captcha-error-message').text(data.responseJSON.errors.gCaptcha[0]);
                }
                if (data.responseJSON.errors.email[0] != undefined) {
                    error = data.responseJSON.errors.email[0];
                } else if (data.responseJSON.errors.password[0] != undefined) {
                    error = data.responseJSON.errors.password[0];
                }
                if (error != '') {
                    $('.login-message').addClass('bg-pinks-2 mb-6 mt-8 border border-reds-3 rounded').html(`
                        <h1 class="roboto-medium font-medium text-reds-3 ml-52p">${error}</h1>
                        <span class="absolute top-2 left-2.5 border-r h-8 border-reds-3 pl-1.5 pr-3">
                            <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10C0 15.5228 4.47715 20 10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10ZM11 9V10V16V17H9V16V10V9H11ZM9 5V6H11V5V4V3H9V4V5Z" fill="#C8191C"/>
                            </svg>
                        </span>

                    `).show();
                }

            }
        });
    });

    // Active login part
    $(document).on('click', '.login-active', function() {
        $('.register-active').removeClass('is-active');
        $('.login-active').addClass('is-active');
        $('.login-active-border').addClass('active-border');
        $('.register-active-border').removeClass('active-border');
    });

    // Active registration part
    $(document).on('click', '.register-active', function() {
        $('.login-active').removeClass('is-active');
        $('.register-active').addClass('is-active');
        $('.register-active-border').addClass('active-border');
        $('.login-active-border').removeClass('active-border');
    });

    //password show-hide part
    $('.password-hide').click(function() {
       $(this).hide();
       $(".password-show").show();
       $(this).closest('.password-container').find('.password-field').get(0).type="text";
    });

    $('.password-show').click(function() {
      $(this).hide();
      $(".password-hide").show();
      $(this).closest('.password-container').find('.password-field').get(0).type="password";
    });

    // Open modal
    $('.open-login-modal').click(function() {
        $('#my-modal').css('display', 'flex')
    })
    $('.login-close-btn').click(function() {
        $('#my-modal').css('display', 'none');
    })
    // Close modal when click outside of the modal
    $(document).on('mousedown', function(e) {
        if(!(($(e.target).closest("#modal-main").length > 0 ) || ($(e.target).closest(".open-login-modal").length > 0))) {
            $("#my-modal").css('display', 'none');
        }
    })


    if (loginNeeded == 1) {
        $('#my-modal').css('display', 'flex')
    }

    var debounce = null;
    var email = null;
    $('.registration-email').keyup(function() {
        var tmp = this;
        clearTimeout(debounce );
        debounce = setTimeout(function() {
            email = $(tmp).val();
            $.ajax({
                url: SITE_URL + "/check-email-existence/" + email,
                type: 'get',
                success: function (data) {
                    if (data.status == 1) {
                        $('.email-validation-error').removeClass('text-green-500').addClass('text-red-500').text(data['message']);
                    }
                }
            });
        }, 500);
    });

    //Admin login spinner functionality
   $('.admin-login-con .sign-in-btn, .login-box-body .send-btn').click(function(){
           $('.admin-login-con .spin, .login-box-body .spin').show();
    })
   //Admin Login load functionality
   if ($('.auth-wrapper').find('#admin-login-container').length) {
        setTimeout(() => {
            $("#admin-login-container").show();
        }, 300);
  };
