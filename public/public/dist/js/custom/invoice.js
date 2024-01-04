"use strict";

if ($('.main-body .page-wrapper').find('#invoice-view-container').length) {
    var maxQty = 1;
    (function () {
        var previous;
        var orderDateCount = 0;
        var deliveryDateCount = 0;
        $("#status").on('focus', function () {
            previous = this.value;
        }).change(function() {
            swal({
                title: jsLang('Are you sure?'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let status = $(this).val();
                    let data = {
                        'status_id' : status,
                        'order_id': orderId,
                    };
                    clickOnSave("/orders/change-status", "POST", data);
                    if (paymentStatus == "Paid" || finalOrderStatus != status) {
                        $(".status").each(function() {
                            $(this).val(status);
                        });
                    } else {
                        $('#status').val(previous);
                    }
                } else {
                    $('#status').val(previous);
                    swal(jsLang('Your data is safe!'));
                }
            });
        });
        $(".status").on('focus', function () {
            previous = this.value;
        }).change(function() {
            swal({
                title: jsLang('Are you sure?'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let status = $(this).val();
                        let detailId = $(this).attr('data-id');
                        let data = {
                            'id' : detailId,
                            'status_id' : status,
                            'type' : 'detail'
                        };
                        clickOnSave("/orders/change-status", "POST", data);
                        if (paymentStatus != "Paid" && finalOrderStatus == status) {
                            $(this).val(previous);
                        }
                    } else {
                        $(this).val(previous);
                        swal(jsLang('Your data is safe!'));
                    }
                });
        });

        $("#payment_status").on('focus', function () {
            previous = this.value;
        }).change(function() {
            swal({
                title: jsLang('Are you sure?'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let status = $(this).val();
                        let detailId = $(this).attr('data-id');
                        let data = {
                            'order_id' : orderId,
                            'payment_status' : status,
                            'type' : 'payment'
                        };
                        clickOnSave("/orders/update", "POST", data);
                        paymentStatus = status;
                    } else {
                        $(this).val(previous);
                        swal(jsLang('Your data is safe!'));
                    }
                });
        });

        $("#orderDate").on('focus', function () {
            previous = this.value;
        }).change(function() {
            orderDateCount++;
            if (orderDateCount != 1) {
                swal({
                    title: jsLang('Are you sure?'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            let orderDate = $(this).val();
                            let data = {
                                'order_id' : orderId,
                                'orderDate' : orderDate,
                                'type' : 'orderDate'
                            };
                             clickOnSave("/orders/update", "POST", data);
                        } else {
                            $(this).val(previous);
                            swal(jsLang('Your data is safe!'));
                        }
                    });
            }
        });
        $("#user_id").on('focus', function () {
            previous = this.value;
        }).change(function() {
                swal({
                    title: jsLang('Are you sure?'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            let orderDate = $(this).val();
                            let data = {
                                'order_id' : orderId,
                                'user_id' : $(this).val(),
                                'type' : 'userId'
                            };
                            clickOnSave("/orders/update", "POST", data);
                        } else {
                            $(this).val(previous);
                            swal(jsLang('Your data is safe!'));
                        }
                    });
        });

        $("#deliveryDate").on('focus', function () {
            previous = this.value;
        }).change(function() {
            deliveryDateCount++;
            if (deliveryDateCount != 1) {
                swal({
                    title: jsLang('Are you sure?'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            let deliveryDate = $(this).val();
                            let data = {
                                'order_id' : orderId,
                                'deliveryDate' : deliveryDate,
                                'type' : 'deliveryDate'
                            };
                            clickOnSave("/orders/update", "POST", data);
                        } else {
                            $(this).val(previous);
                            swal(jsLang('Your data is safe!'));
                        }
                    });
            }
        });

        $("#updateNote").on('focus', function () {
            previous = $('#order_note').text();
        }).click(function() {
                swal({
                    title: jsLang('Are you sure?'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            let data = {
                                'order_id' : orderId,
                                'note' : $('#order_note').val(),
                                'type' : 'note'
                            };
                            var response = clickOnSave("/orders/update", "POST", data);

                            var intervalTime = setInterval(() => {
                                if (response.responseJSON != undefined) {
                                    if (response.responseJSON.status == 1) {
                                        $('.order-notes-container .notes').append(`
                                            <div class="order-notes mb-2">
                                                <span>${data.note}</span>
                                            </div>
                                        `);
                                        $('#order_note').val('');
                                    }
                                    clearInterval(intervalTime);
                                }
                            }, 200);
                        } else {
                            $('#order_note').val(previous);
                            swal(jsLang('Your data is safe!'));
                        }
                    });
        });

    })();
    let orderDate = $('#orderDate').val();
    $('#orderDate').daterangepicker(selectFromTo(orderDate.length > 0 ? orderDate : null));
    let deliveryDate = $('#deliveryDate').val();
    if (typeof deliveryDate != 'undefined') {
        $('#deliveryDate').daterangepicker(selectFromTo(deliveryDate.length > 0 ? deliveryDate : null));
    }
    $('.select2').select2();

    $(document).on('click', '#refundApply', function(e) {
        e.preventDefault();
        let orderDetailId = $(this).attr('data-detailId');
        $('#order_detail_id').val(orderDetailId);
        maxQty = parseInt($(this).attr('data-qty'));
        $('#refundQty').text(1);
        $('#refund-store').modal('show');
    });

    $(document).on('click', '#refundQtyDec', function(e) {
        e.preventDefault();
        let qty = parseInt($('#refundQty').text());
        qty = qty - 1;
        if (qty > 0) {
            $('#refundQty').text(qty);
        }
        $('#quantity_sent').val(qty);
    });
    $(document).on('click', '#refundQtyInc', function(e) {
        e.preventDefault();
        let qty = parseInt($('#refundQty').text());
        qty = qty + 1;
        if (qty <= maxQty) {
            $('#refundQty').text(qty);
        }
        $('#quantity_sent').val(qty);
    });

    $(document).on('click', '#order_action_btn', function(e) {
        e.preventDefault();
        let actionVal = $('#orderAction').val();

        swal({
            title: jsLang('Are you sure?'),
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    let data = {
                        'order_id' : orderId,
                        'action_val' : actionVal,
                        'type' : 'orderAction'
                    };
                    $.ajax({
                        type: "POST",
                        url: SITE_URL + "/orders/update",
                        data: {
                            "_token": token,
                            data: data,
                        },
                        success: function (data) {
                            if (data.status == 1) {
                                swal(data.message, {
                                    icon: "success",
                                    buttons: [false, jsLang('Ok')],
                                });
                            } else if(typeof (data.error != undefined)) {
                                swal(data.error, {
                                    icon: "error",
                                    buttons: [false, jsLang('Ok')],
                                });
                            } else {
                                swal(jsLang('Something went wrong, please try again.'), {
                                    icon: "error",
                                    buttons: [false, jsLang('Ok')],
                                });
                            }
                        }
                    });
                }
            });

    });

    $(".accordion").click(function() {
        $(this).siblings().toggle(500);
        var icon = $(this).find('.drop-down-icon');
        if (icon.hasClass('rotate-180')) {
            icon.removeClass('rotate-180');
            icon.addClass('rotate-0');
        } else {
            icon.removeClass('rotate-0');
            icon.addClass('rotate-180');
        }
    });

}

if ($('.main-body .page-wrapper').find('#vendor-invoice-view-container').length) {
    (function () {
        var previous;
        $(".status").on('focus', function () {
            previous = this.value;
        }).change(function() {
            swal({
                title: jsLang('Are you sure?'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let status = $(this).val();
                        let detailId = $(this).attr('data-id');
                        let data = {
                            'id' : detailId,
                            'status_id' : status,
                        };
                        clickOnSave("/orders/change-status", "POST", data);
                        if (paymentStatus != "Paid" && finalOrderStatus == status) {
                            $(this).val(previous);
                        } else if (finalOrderStatus == status && paymentStatus == "Paid") {
                            $(this).attr('disabled', 'disabled');
                        }
                    } else {
                        $(this).val(previous);
                        swal(jsLang('Your data is safe!'));
                    }
                });
        });
    })();
}
