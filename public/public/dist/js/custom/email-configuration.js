"use strict";
if ($('.main-body .page-wrapper').find('#email-configuration-settings-container').length) {
  $(".select2").select2();

  $("#type").on('change', function () {
    var type = $(this).val();
    if (type == 'smtp') {
      $("#sendmail_form, #sendmail_head").hide();
      $("#smtp_form, #smtp_head").show();
      $("#type_val").attr('value', 'smtp');
    } else {
      $("#sendmail_form, #sendmail_head").show();
      $("#smtp_form, #smtp_head").hide();
      $("#type_val").attr('value', 'sendmail');
    }
  });

  $(window).on('load', function () {
    var type = $("#type").val();
    if (type == 'smtp') {
      $("#sendmail_form, #sendmail_head").hide();
      $("#smtp_form, #smtp_head").show();
      $("#type_val").attr('value', 'smtp');
    } else {
      $("#sendmail_form, #sendmail_head").show();
      $("#smtp_form, #smtp_head").hide();
      $("#type_val").attr('value', 'sendmail');
    }
  });
}