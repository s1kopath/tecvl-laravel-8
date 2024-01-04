"use strict";
$('#password_confirmation, #password').keyup(function(){
    let password = $("#password").val();
    let confirmPassword = $("#password_confirmation").val();
    if (password.length > 0 && confirmPassword.length > 0) {
        if (password != confirmPassword) {
            $(".password-validation-error").addClass('text-red-500');
            $(".password-validation-error").text(jsLang('Passwords does not match!'));
            $(".password-matching").hide();
        }
        else {
            $(".password-validation-error").text(jsLang(''));
            $(".password-matching").show();
        }
    }
});

$(document).on('submit', '#password-validate-submit', function(e) {
    e.preventDefault();

    var status = true;
    var isNameValid = true;
    var isEmailValid = true;
    var isPasswordValid = true;
    var nameErrMsg = '';
    var emailErrMsg = '';
    var errorMsg = '';
    var tmpMsg = [];

    if ($('.registration-name').val().length == 0) {
        status = isNameValid = false;
        nameErrMsg = jsLang('The name field is required.');
    } else if ($('.registration-name').val().length <= 3) {
        status = isNameValid = false;
        nameErrMsg = jsLang('The Name must be 3 character or long.');
    }

    if ($('.registration-email').val().length == 0) {
        status = isEmailValid = false;
        emailErrMsg = jsLang('The email field is required.');
    }

    if (uppercase && $('.password-validation').val().search(/[A-Z]/) < 0) {
        tmpMsg.push(jsLang('uppercase'));
        status = isPasswordValid = false;
    }
    if (lowercase && $('.password-validation').val().search(/[a-z]/) < 0) {
        tmpMsg.push(jsLang('lowercase'));
        status = isPasswordValid = false;
    }
    if (number && $('.password-validation').val().search(/[0-9]/) < 0) {
        tmpMsg.push(jsLang('numbers'));
        status = isPasswordValid = false;
    }
    if (symbol && $('.password-validation').val().search(/[#?!@$%^&*-]/) < 0) {
        tmpMsg.push(jsLang('symbols'));
        status = isPasswordValid = false;
    }

    if (tmpMsg.length > 0) {
        errorMsg = jsLang('Password must contain :x');
        errorMsg = errorMsg.replace(":x", tmpMsg.join(', '));
    }


    if (length && $('.password-validation').val().length < length) {
        if (errorMsg.length > 0) {
            errorMsg = jsLang('Password must contain :x and :y characters long.');
            errorMsg = errorMsg.replace(":x", tmpMsg.join(', '));
            errorMsg = errorMsg.replace(":y", length);

        } else {
            errorMsg = jsLang('Password must be at least :x characters.');
            errorMsg = errorMsg.replace(":x", length);
        }
        status = isPasswordValid = false;
    }

    if (status == false) {
        if (!isPasswordValid) {
            $('.password-validation-error').removeClass('text-green-500').addClass('text-red-500').text(errorMsg);
        }
        if (!isNameValid) {
            $('.name-validation-error').removeClass('text-green-500').addClass('text-red-500').text(nameErrMsg);
        }
        if (!isPasswordValid) {
            $('.email-validation-error').removeClass('text-green-500').addClass('text-red-500').text(emailErrMsg);
        }
    } else {
        $('.registration-modal-loader').css('display', 'inline');
        $.ajax({
            type: 'post',
            url: SITE_URL + '/sign-up-store',
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.status == 1) {
                    $('.register-active').removeClass('is-active');
                    $('.login-active').addClass('is-active');

                    $('.login-message').addClass('bg-green-2 mb-6 mt-8 rounded border border-green-1').html(`
                        <h1 class="roboto-medium font-medium ml-52p text-green-1">${jsLang('Registration successful. Please verify your email.')}</h1>
                        <span class="absolute top-2 left-2.5 border-r h-8 border-green-1 pl-1.5 pr-3">
                            <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3163 0.462473C17.5102 -0.242925 16.3121 -0.128557 15.6403 0.717921L8.80424 9.33189C8.14548 10.162 7.77515 10.6215 7.47948 10.9039C7.47564 10.9076 7.47188 10.9112 7.46818 10.9147C7.46419 10.9115 7.46013 10.9083 7.456 10.9051C7.13719 10.6519 6.72875 10.2295 6.00113 9.4654L3.2435 6.56972C2.5015 5.79059 1.29849 5.79059 0.556498 6.56972C-0.185497 7.34886 -0.185497 8.61209 0.556498 9.39123L3.31413 12.2869C3.34002 12.3141 3.36587 12.3412 3.39168 12.3684C4.01203 13.02 4.60881 13.6469 5.16407 14.0878C5.78606 14.5817 6.60062 15.0461 7.6445 14.9963C8.68838 14.9466 9.45955 14.4067 10.0364 13.8557C10.5514 13.3639 11.0916 12.6828 11.6532 11.9749C11.6766 11.9454 11.7 11.9159 11.7235 11.8864L18.5596 3.27239C19.2313 2.42592 19.1224 1.16787 18.3163 0.462473Z" fill="#009651"/>
                            </svg>
                        </span>

                    `);
                    $('.login-active-border').addClass('active-border');
                    $('.register-active-border').removeClass('active-border');

                    if (otpActive) {
                        window.location.href = otpUrl;
                    }

                } else if(typeof (data.error != undefined)) {
                    if (data.error.name != undefined) {
                        data.error.name.forEach(function(e) {
                            $('.name-validation-error').html('<li style="list-style:none">' + e + '</li>');
                        })
                    }
                    if (data.error.email != undefined) {
                        data.error.email.forEach(function(e) {
                            $('.email-validation-error').html('<li style="list-style:none">' + e + '</li>');
                        })
                    }
                    if (data.error.gCaptcha != undefined) {
                        data.error.gCaptcha.forEach(function(e) {
                            $('.recaptcha-validation-error').html('<li style="list-style:none">' + e + '</li>');
                        })
                    }
                    if (data.error.password != undefined) {
                        data.error.password.forEach(function(e) {
                            $('.password-validation-error').removeClass('text-green-500').addClass('text-red-500').html('<li style="list-style:none">' + e + '</li>');
                        })
                    }

                } else {
                    $('.password-validation-error').addClass('text-red-500').text(jsLang('Something went wrong, please try again.'))
                }
                $('.registration-modal-loader').css('display', 'none');
            }
        });
    }

});
