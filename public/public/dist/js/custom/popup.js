'use strict';
if ($('.main-body .page-wrapper').find('#popup-list-container, #popup-add-container, #popup-edit-container').length) {
    $('.select2').select2()
}
if ($('.main-body .page-wrapper').find('#popup-add-container').length) {

    function popupBackground() {
        if ($('#background').val() == 'Image') {
            $('#popup_image').closest('div').attr('style', 'display: block !important');
            $('#popup_bg_color').closest('div').attr('style', 'display: none !important');
        } else if ($('#background').val() == 'Color') {
            $('#popup_bg_color').closest('div').attr('style', 'display: block !important');
            $('#popup_image').closest('div').attr('style', 'display: none !important');
        } else {
            $('#popup_bg_color').closest('div').attr('style', 'display: none !important');
            $('#popup_image').closest('div').attr('style', 'display: none !important');
        }
    }
    popupBackground();
    $('#background').change(popupBackground)

    function resetPopup() {
        $('.default_content').attr('style', 'display: block !important')
        $('#page_links').attr('style', 'display: none !important')
        $('#mail').attr('style', 'display: none !important')
        $('#subscription').attr('style', 'display: none !important')
    }
    function checkType() {
        if ($('#popup_type').val() == 'Information') {
            resetPopup();
        } else if ($('#popup_type').val() == 'Another page link') {
            resetPopup();
            $('#page_links').attr('style', 'display: block !important')
        } else if ($('#popup_type').val() == 'Send mail') {
            resetPopup();
            $('#mail').attr('style', 'display: block !important')
        } else if ($('#popup_type').val() == 'Subscribed') {
            resetPopup();
            $('#subscription').attr('style', 'display: block !important')
        } else {
            resetPopup();
            $('.default_content').attr('style', 'display: none !important')
        }
    }
    checkType();
    $('#popup_type').change(checkType)

    $('input[name="start_date"]').daterangepicker(dateSingleConfig());
    $('input[name="end_date"]').daterangepicker(dateSingleConfig());
}

if ($('.main-body .page-wrapper').find('#popup-edit-container').length) {
    $('input[name="start_date"]').daterangepicker(dateSingleConfig($('input[name="start_date"]').val()));
    $('input[name="end_date"]').daterangepicker(dateSingleConfig($('input[name="end_date"]').val()));

    $('#background').change(function() {
        if ($(this).val() == 'Image') {
            $('#popup_image').closest('div').attr('style', 'display: block !important');
            $('#popup_bg_color').closest('div').attr('style', 'display: none !important');
            $('.old_image').show();
        } else if ($(this).val() == 'Color') {
            $('#popup_bg_color').closest('div').attr('style', 'display: block !important');
            $('#popup_image').closest('div').attr('style', 'display: none !important');
            $('.old_image').hide();
        } else {
            $('#popup_bg_color').closest('div').attr('style', 'display: none !important');
            $('#popup_image').closest('div').attr('style', 'display: none !important');
            $('.old_image').hide();
        }
    })
}

$('#add_text').click(function() {
    var id = $(this).data('id');
    $(this).data('id', id + 1);
    $('#text').append(`
        <div class="text-area border p-3">
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="text[text1]text">${jsLang('Text')}</label>
                <div class="col-sm-5">
                    <input type="text" placeholder="${jsLang('Text')}" class="form-control" id="text${id}" name="text[text${id}][text]">
                </div>
                <div class="col-1">
                    <input type="color" class="w-100" name="text[text${id}][text_color]" id="text${id}_color">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" placeholder="${jsLang('Font size')}" class="form-control" id="text${id}_size" name="text[text${id}][text_size]">
                        <div class="input-group-append">
                            <button class="btn btn-sm" type="button">Px</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 popup-content-remove">
                    <span class="remove-text cursor-pointer px-3 py-2">x</span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 control-label text-left" for="text${id}_margin_left">${jsLang('Text Margin')}</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" placeholder="${jsLang('Left')}" class="form-control" id="text${id}_margin_left" name="text[text${id}][text_margin_left]" value="">
                        <div class="input-group-append">
                            <button class="btn btn-sm" type="button">Px</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" placeholder="${jsLang('Top')}" class="form-control" id="text${id}_margin_top" name="text[text${id}][text_margin_top]" value="">
                        <div class="input-group-append">
                            <button class="btn btn-sm" type="button">Px</button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <select class="form-control select2 sl_common_bx" id="text${id}_font_weight" name="text[text${id}][text_font_weight]">
                        <option value="normal">${jsLang('Normal')}</option>
                        <option value="bold">${jsLang('Bold')}</option>
                        <option value="italic">${jsLang('Italic')}</option>
                    </select>
                </div>

                <div class="col-sm-3 offset-2 mt-14">
                    <div class="input-group">
                        <input type="number" placeholder="${jsLang('Right')}" class="form-control" id="text${id}_margin_right" name="text[text${id}][text_margin_right]" value="">
                        <div class="input-group-append">
                            <button class="btn btn-sm" type="button">Px</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 mt-14">
                    <div class="input-group">
                        <input type="number" placeholder="${jsLang('Bottom')}" class="form-control" id="text${id}_margin_bottom" name="text[text${id}][text_margin_bottom]" value="">
                        <div class="input-group-append">
                            <button class="btn btn-sm" type="button">Px</button>
                        </div>
                    </div>
                </div>

                <div class="col-4 mt-14">
                    <select class="form-control select2 sl_common_bx" id="text${id}_alignment" name="text[text${id}][text_alignment]">
                        <option value="left">${jsLang('Left')}</option>
                        <option value="center">${jsLang('Center')}</option>
                        <option value="right">${jsLang('Right')}</option>
                    </select>
                </div>

            </div>
        </div>
    `)
})

$('.popup-store-button').click(function (e) {
    var arr = ['#v-pills-setting', '#v-pills-target', '#v-pills-display', '#v-pills-content', '#v-pills-popupType']
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

$(document).on('click', '.remove-text', function() {
    $(this).closest('.text-area').remove();
})

$('button.switch-tab').on('click', function() {
    $('#' + $(this).attr('data-id')).trigger('click');
})