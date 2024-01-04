"use strict";
emptyShow();
$(document).on('click', '.add-to-compare', function() {
    let itemId = $(this).attr('data-itemId');
    compareAjaxCall("/compare-store", itemId, true);
});

$(document).on('click', '.compareRemove', function() {
    let itemId = $(this).attr('data-itemId');
    compareAjaxCall("/compare-delete", itemId, false);
});

function compareAjaxCall(url, itemId, msgShow = false)
{
    $.ajax({
        url: SITE_URL + url,
        data: {
            item_id: itemId,
            "_token": token
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (data) {
            if (msgShow == true) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                if (data.status == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: jsLang(data.message)
                    });
                    updateCompare(data.totalItem, itemId);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: jsLang(data.message)
                    })
                }
            } else {
                if (data.status == 1) {
                    updateCompare(data.totalItem, itemId);
                }
            }
        }
    });
}

function emptyShow(itemId = null)
{
  if (parseInt($('#totalCompareItem').text()) > 0 ) {
      $('.value-'+itemId).remove();
      $('#compareEmpty').hide();
  } else {
      $('.compare-table').remove();
      $('#compareEmpty').show();
      $('#totalCompareItem').removeClass('w-4 h-4');
  }
}

function updateCompare(total = 0, itemId)
{
    if (parseInt(total) > 0) {
        $('#totalCompareItem').html(total);
        $('#totalCompareItem').addClass('w-4 h-4');
    } else {
        $('#totalCompareItem').html('');
    }
    emptyShow(itemId);
}
