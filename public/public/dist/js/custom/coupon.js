'use strict';
if ($('.main-body .page-wrapper').find('#coupon-add-container, #coupon-edit-container, #vendor-coupon-add-container, #vendor-coupon-edit-container, #coupon-list-container, #vendor-coupon-list-container').length) {
    $('.select2').select2()

    $('#discount_type').change(function() {
        if ($(this).val() == 'Percentage') {
            $('.discount_amount_label').text(jsLang('Discount Percentage'))
            $('#discount_amount').attr("placeholder", jsLang('Discount Percentage'))
        } else {
            $('.discount_amount_label').text(jsLang('Discount Amount'))
            $('#discount_amount').attr("placeholder", jsLang('Discount Amount'))
        }
    })
}
// Coupon module
function discount() {
    if ($('.main-body .page-wrapper').find('#coupon-add-container, #coupon-edit-container, #vendor-coupon-add-container, #vendor-coupon-edit-container').length) {
        if ($('select[name="discount_type"]').val() != "Percentage" ) {
            $('#max_discount').hide();
        }

        $('select[name="discount_type"]').on('change', function(e) {
            if (e.target.value == 'Percentage') {
                $('#max_discount').show();
            } else {
                $('#max_discount').hide();
            }
        })
    }
}
function shop(id, shop_id = null) {
    $.ajax({
        url: SITE_URL + "/coupon/shop/" + id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $('#shop_id').html('');
            $('#shop_id').append(`
                <option value="">${jsLang('Select One')}</option>
            `);
            for (const key in data) {
                if (data[key].id == shop_id) {
                    $('#shop_id').append(`
                        <option value="${data[key].id}" selected>${data[key].name}</option>
                    `);
                } else {
                    $('#shop_id').append(`
                        <option value="${data[key].id}">${data[key].name}</option>
                    `);
                }
            }
        }
    })
}
if ($('.main-body .page-wrapper').find('#coupon-add-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig());
    $('input[name="end_date"]').daterangepicker(dateSingleConfig());

    discount();

    if (is_active === 'true') {
        $('#vendor_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            shop(id);
        })
        $('#shop_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        })
    } else {
        $('#vendor_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option  value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        })

        // If old vendor value exist
        if ($('#vendor_id').val() != '') {
            var item_ids = [];
            if (Array.isArray(old_item) && old_item.length) {
                item_ids = old_item.map(function (x) {
                    return parseInt(x, 10);
                });
            }
            var id = $('#vendor_id').val();
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option ${item_ids.includes(data.items[key].id) ? 'selected' : ''}  value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        }
    }

}
if ($('.main-body .page-wrapper').find('#coupon-edit-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig($('input[name="start_date"]').val()));
    $('input[name="end_date"]').daterangepicker(dateSingleConfig($('input[name="end_date"]').val()));

    discount();

    if (is_active === 'true') {
        shop($('#vendor_id').val(), shopId);

        $('#vendor_id').change(function() {
            var id = $(this).val();
            shop(id);
        })

        $('#shop_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        })
        $.ajax({
            url: SITE_URL + "/coupon/item/" + shopId,
            type: 'GET',
            dataType: 'JSON',
            data:{
                coupon_id: couponId,
            },
            success: function (data) {
                $('#item_id').html('');

                for (const key in data.items) {
                    if (data.select.includes(data.items[key].id)) {
                        $('#item_id').append(`
                            <option value="${data.items[key].id}" selected>${data.items[key].name}</option>
                        `);
                    } else {
                        $('#item_id').append(`
                            <option value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            }
        })

    } else {

        // If old vendor value exist
        if (old_vendor != '') {
            var item_ids = [];
            if (Array.isArray(old_item) && old_item.length) {
                item_ids = old_item.map(function (x) {
                    return parseInt(x, 10);
                });
            }
            var id = $('#vendor_id').val();
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option ${item_ids.includes(data.items[key].id) ? 'selected' : ''}  value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        } else {
            $.ajax({
                url: SITE_URL + "/coupon/item/" + vendorId ?? 0,
                type: 'GET',
                dataType: 'JSON',
                data:{
                    coupon_id: couponId,
                },
                success: function (data) {

                    $('#item_id').html('');

                    for (const key in data.items) {
                        if (data.select.map(Number).includes(data.items[key].id)) {
                            $('#item_id').append(`
                                <option value="${data.items[key].id}" selected>${data.items[key].name}</option>
                            `);
                        } else {
                            $('#item_id').append(`
                                <option value="${data.items[key].id}">${data.items[key].name}</option>
                            `);
                        }
                    }
                }
            })
        }

        $('#vendor_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            $.ajax({
                url: SITE_URL + "/coupon/item/" + id,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#item_id').html('');

                    for (const key in data.items) {
                        $('#item_id').append(`
                            <option value="${data.items[key].id}">${data.items[key].name}</option>
                        `);
                    }
                }
            })
        })

    }
}

function item(id) {
    $.ajax({
        url: SITE_URL + "/vendor/coupon/shop-item/" + id,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $('#item_id').html('');

            for (const key in data.items) {
                $('#item_id').append(`
                    <option value="${data.items[key].id}">${data.items[key].name}</option>
                `);
            }
        }
    })
}

function oldItemSelection() {
    if (Array.isArray(old_item) && old_item.length) {
        var item_ids = [];

        item_ids = old_item.map(function (x) {
            return parseInt(x, 10);
        });

        $.ajax({
            url: SITE_URL + "/coupon/shop-item/" + 0,
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#item_id').html('');

                for (const key in data.items) {
                    $('#item_id').append(`
                        <option ${item_ids.includes(data.items[key].id) ? 'selected' : ''}  value="${data.items[key].id}">${data.items[key].name}</option>
                    `);
                }
            }
        })
    }
}

if ($('.main-body .page-wrapper').find('#vendor-coupon-add-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig());
    $('input[name="end_date"]').daterangepicker(dateSingleConfig());

    discount();

    if (is_active === 'true') {
        $('#shop_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            item(id);
        })
    }
    oldItemSelection();

}

if ($('.main-body .page-wrapper').find('#vendor-coupon-edit-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig($('input[name="start_date"]').val()));
    $('input[name="end_date"]').daterangepicker(dateSingleConfig($('input[name="end_date"]').val()));

    discount();

    if (is_active === 'true') {
        $('#shop_id').change(function() {
            var id = $(this).val() ? $(this).val() : 0;
            item(id);
        })
    }
    oldItemSelection();
}

if ($('.main-body .page-wrapper').find('#coupon-list-container').length) {
    // For export csv and pdf
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/coupon/" + this.id;
    });
}

if ($('.main-body .page-wrapper').find('#coupon-redeem-list-container').length) {
    // For export csv and pdf
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/coupon-redeem/" + this.id;
    });
}

if ($('.main-body .page-wrapper').find('#vendor-coupon-list-container').length) {
    // For export csv and pdf
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/vendor/coupon/" + this.id;
    });
}

$('.coupon-submit-button').click(function (e) {
    var arr = ['#v-pills-general', '#v-pills-restriction', '#v-pills-limit']
    setTimeout(() => {
        for (const key in arr) {
            if($(arr[key]).find('.error').length) {
                var target = $(arr[key]).attr('aria-labelledby');
                $('#' + target).trigger('click');
                break;
            }
        }
    }, 100);
});

$('button.switch-tab').on('click', function() {
    $('#' + $(this).attr('data-id')).trigger('click');
})
