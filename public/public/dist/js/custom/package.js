'use strict';
// Package module
if ($('.main-body .page-wrapper').find('#package-add-container, #package-edit-container, #package_subscription-add-container, #package-subscription-edit-container').length) {
    $('.select2').select2()
}
// package subscription module
if ($('.main-body .page-wrapper').find('#package_subscription-add-container').length) {
    $('input[name="activation_date"]').daterangepicker(dateSingleConfig());
    $('input[name="billing_date"]').daterangepicker(dateSingleConfig());
    $('input[name="next_billing_date"]').daterangepicker(dateSingleConfig());
    $('.customized_records').hide();
    $('#customized').click(function() {
        setTimeout(() => {
            if ($('#is_customized').prop("checked")) {
                $('.customized_records').show();
            } else {
                $('.customized_records').hide();
            }
        }, 10);
    })
}
if ($('.main-body .page-wrapper').find('#package-subscription-edit-container').length) {
    $('input[name="activation_date"]').daterangepicker(dateSingleConfig($('input[name="activation_date"]').val()));
    $('input[name="billing_date"]').daterangepicker(dateSingleConfig($('input[name="billing_date"]').val()));
    $('input[name="next_billing_date"]').daterangepicker(dateSingleConfig($('input[name="next_billing_date"]').val()));
    if ($('#is_customized').prop("checked")) {
        $('.customized_records').show();
    } else {
        $('.customized_records').hide();
    }
    $('#customized').click(function() {
        setTimeout(() => {
            if ($('#is_customized').prop("checked")) {
                $('.customized_records').show();
            } else {
                $('.customized_records').hide();
            }
        }, 10);
    })
}


if ($('.main-body .page-wrapper').find('#package-list-container').length) {
    // For export csv and pdf
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/package/" + this.id;
    });
}
if ($('.main-body .page-wrapper').find('#package-subscription-list-container').length) {
    // For export csv and pdf
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/package-subscription/" + this.id;
    });
}
