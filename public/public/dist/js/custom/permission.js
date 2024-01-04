"use strict";
// Permission
function permission(pdf, csv) {
    if (pdf == 1 || csv == 1) {
        var show = setInterval(() => {
            if ($("#btnGroupDrop1").length) {
                $("#btnGroupDrop1").css('display','inline-block')
                $(".btn-group").css({'display':'inline-flex'})
                $("#dataTableBuilder_length").css({'margin-top':'0px'});

                (pdf == 1) ? $("#pdf").show() : $("#pdf").hide();
                (csv == 1) ? $("#csv").show() : $("#csv").hide();

                clearInterval(show);
            }
        }, 100);
    } else {
        var hide = setInterval(() => {
            if ($("#btnGroupDrop1").length) {
                $("#btnGroupDrop1").css('display','none')
                $(".btn-group").css({'display':'inline-block'})
                $("#dataTableBuilder_length").css({'margin-top':'-20px'})
                clearInterval(hide);
            }
        }, 100);
    }
}
if ($('.main-body .page-wrapper').find('#shop-list-container').length
    || $('.main-body .page-wrapper').find('#attribute-list-container').length
    || $('.main-body .page-wrapper').find('#attribute_group-list-container').length
    || $('.main-body .page-wrapper').find('#brand-list-container').length
    || $('.main-body .page-wrapper').find('#option-list-container').length
    || $('.main-body .page-wrapper').find('#user-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-shop-list-container').length
    || $('.main-body .page-wrapper').find('#package-list-container').length
    || $('.main-body .page-wrapper').find('#package-subscription-list-container').length
    || $('.main-body .page-wrapper').find('#coupon-list-container').length
    || $('.main-body .page-wrapper').find('#coupon-redeem-list-container').length
    || $('.main-body .page-wrapper').find('#shipping-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-item-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-review-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-coupon-list-container').length
    || $('.main-body .page-wrapper').find('#user-wallet-container').length
    || $('.main-body .page-wrapper').find('#refund-list-container').length
    || $('.main-body .page-wrapper').find('#vendor-withdrawal-container').length
    || $('.main-body .page-wrapper').find('#transaction-list-container').length
    || $('.main-body .page-wrapper').find('#withdrawal-list-container').length
    || $('.main-body .page-wrapper').find('#popup-list-container').length
    || $('.main-body .page-wrapper').find('#subscriber-list-container').length
) {
    permission(pdf, csv);
}

function exportPdfCsv(id, url) {
    if ($('.main-body .page-wrapper').find(id).length) {
        // For export pdf and csv
        $(document).on("click", "#csv, #pdf", function(event) {
            event.preventDefault();
            window.location = SITE_URL + url + this.id;
        });
    }
}
exportPdfCsv('#refund-list-container', '/refund-request/');
exportPdfCsv('#vendor-refund-list-container', '/vendor/refund-request/');
exportPdfCsv('#transaction-list-container', '/transactions/');
exportPdfCsv('#withdrawal-list-container', '/withdrawals/');
exportPdfCsv('#popup-list-container', '/popups/');
exportPdfCsv('#subscriber-list-container', '/subscribers/');

