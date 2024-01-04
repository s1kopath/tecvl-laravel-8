'use strict';

imgInp.onchange = evt => {
    $('#refund_image').html('');

    var files = imgInp.files, filesLength = files.length;

    for (var i = 0; i < filesLength; i++) {
        var f = files[i];
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
            $('#refund_image').append(`
                    <img width="100" class="m-auto rounded-md mr-2 mt-2" src="${e.target.result}"/>
            `);
        });
        fileReader.readAsDataURL(f);
    }
}

function quantitySelect() {
    var qty = $("select[name='order_items']").find(':selected').data('quantity');
    var orderDetailId = $("select[name='order_items']").find(':selected').data('order_detail_id');
    $('input[name="order_detail_id"]').val(orderDetailId)
    $("select[name='quantity_sent']").html(`<option value="">${jsLang('Select one')}</option>`);
    for (let index = 1; index <= qty; index++) {
        $("select[name='quantity_sent']").append(`
            <option value="${index}">${index}</option>
        `)
    }
}
var itemFind = false;
function findItems(reference) {
    $.ajax({
        url: SITE_URL + "/user/refund-items/" + reference,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $('#order_items').html(`<option value="">${jsLang('Select one')}</option>`);
            for (const key in data) {
                $('#order_items').append(`
                    <option ${item_id == data[key].item_id ? 'selected' : ''} data-order_detail_id="${data[key].id}" data-quantity="${data[key].quantity}" value="${data[key].item_id}">${data[key].item_name}</option>
                `)
            }
            itemFind = true;
        }
    })

}

if (item_id > 0) {
    findItems($("select[name='order_reference']").val());
    var refund_count = 1;
    var intervals = setInterval(() => {
        refund_count++;
        if (itemFind == true) {
            quantitySelect();
            clearInterval(intervals);
        }
        if (refund_count == 300) {
            clearInterval(intervals);
        }
    }, 100);

}

$("select[name='order_reference']").on('change',function() {
    var tmp = this;
    clearTimeout(debounce );
    var debounce = setTimeout(function() {
        var reference = $(tmp).val();
        if (reference) {
            findItems(reference);
        } else {
            $('#order_items').html(`<option value="">${jsLang('Select one')}</option>`)
            $("select[name='quantity_sent']").html(`<option value="">${jsLang('Select one')}</option>`);
        }

    }, 100);
})

$("select[name='order_items']").on('change', function() {
    quantitySelect();
});
