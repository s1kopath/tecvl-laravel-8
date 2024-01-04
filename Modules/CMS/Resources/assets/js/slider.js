"use strict";

if ($('.main-body .page-wrapper').find('#slider-list-container').length) {
    $(".select2").select2();

    $('#edit-slider').on('show.bs.modal', function (e) {
        $('#edit-id').val($(e.relatedTarget).attr('id'));
        $('#name').val($(e.relatedTarget).attr('name'));
        $('#edit_status').val($(e.relatedTarget).attr('status'));

        if ($(e.relatedTarget).attr('status') == 'Active') {
            $('.is_default').attr('checked', 'checked');
        } else {
            $('.is_default').attr('checked', false);
        }
    });

    var checked = false;
    $(document).on('click', '.cr', function() {
        checked = checked == 'checked' ? false : 'checked';
        $('.is_default').attr('checked', checked);
        if (checked == 'checked') {
            $('#edit_status').val('Active');
        }
    })
}

if ($('.main-body .page-wrapper').find('#slide-add-container').length) {
    $(document).on('click', 'button.switch-tab', function() {
        $('#' + $(this).attr('data-id')).trigger('click');
    })

    // Load another slide
    function slideAjax(url, parent) {
        if ($(parent).find('.active').length == 0 && !$(parent).hasClass('submitting')) {
            $(parent).addClass('submitting');
            $(parent).find('.boxes').removeClass('d-none');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#load-data').html(data.data);
                    $('#v-pills-title-tab').trigger('click');
                    $('#v-pills-general-tab').trigger('click');
                    $('.slide li').removeClass('active');
                    $(parent).find('li').addClass('active');
                },
                complete: function() {
                    $(parent).find('.boxes').addClass('d-none');
                    $(parent).removeClass('submitting');
                }
            })
        }
    }

    $('.slide-edit').on('click', function() {
        var url = SITE_URL + "/slide/edit/" + $(this).attr('data-id');
        slideAjax(url, this);
    })

    $('.slide-create').on('click', function() {
        var url = SITE_URL + "/slide/create";
        slideAjax(url, this);
    })
}
