'use strict';

if ($('.main-body .page-wrapper').find('#subscriber-list-container, #subscriber-edit-container').length) {
    $('.select2').select2();
}
if ($('.main-body .page-wrapper').find('#subscriber-edit-container').length) {
    $('input[name="confirmation_date"]').daterangepicker(dateSingleConfig($('input[name="confirmation_date"]').val()));
}
