"use strict";
if ($('.main-body .page-wrapper').find('#theme-container').length) {
    $(document).ready(function(){
        $('.conditional').ifs();
        $('#success-message').css("display", "none");
        $('#warning-message').css("display", "none");
        $("#v-pills-general-tab").trigger('click');
      
        $("input").change(function() {
            $('.warning-message').addClass('alert-secondary');
            $('#warning-message').css("display", "block");
            $('#warning-msg').html(jsLang('Settings have changed, you should save them!'));
          });
    });
    $('.tab-name').on("click", function () {
        var id = $(this).attr('data-id');

        $('#theme-title').html(id);
        var activeLink = $("ul.vertical-class li a.active");
    });

    $("#optionForm").on('submit', function(event) {
            event.preventDefault();
            var activeLink = $("ul.vertical-class li a.active");
                $.ajax({
                    url: SITE_URL + "/theme/store",
                    type: 'POST',
                    data: {
                       
                        _token: token,
                        enctype: 'multipart/form-data',
                        data: $( "#optionForm" ).serialize()
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            $('.abc').addClass('alert-success');
                            $('#success-message').css("display", "block");
                            $('#warning-message').css("display", "block");
                            $('#msg').html(data.message);
                        }
                        if (data.status == 0) {
                            $('.abc').addClass('alert-danger');
                            $('#success-message').css("display", "block");
                            $('#warning-message').css("display", "block");
                            $('#msg').html(data.message);
                        }
                    },
                });
                $('#footer-btn').removeAttr('disabled');
            
            setTimeout(() => {
                $('#success-message').hide(500),
                $('#warning-message').hide(500),
                $('.abc').removeClass('alert-success'),
                $('.abc').removeClass('alert-danger')
            }, 5000);
    
        });

}




