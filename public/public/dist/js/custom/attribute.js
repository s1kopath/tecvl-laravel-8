"use strict";
if ($('.main-body .page-wrapper').find('#attribute_group-add-container').length ||$('.main-body .page-wrapper').find('#attribute_group-edit-container').length || $('.main-body .page-wrapper').find('#attribute-add-container').length || $('.main-body .page-wrapper').find('#attribute-edit-container').length) {
    $(".select2").select2();
    var type;
    type = $('#type :selected').val();
    typeCheck();
    var rowid = 2;
    if ($('.main-body .page-wrapper').find('#attribute-edit-container').length) {
        rowid = $('#row_id').val();
    }
    function tabValidation()
    {
        if ($('#name').val().length > 0 && $('#attribute_group').val().length > 0) {
            let allRowId = $("input[name='row_identify[]']").map(function(){return $(this).val();}).get();
            let rowIdlength = parseInt(allRowId.length);
            for (let i = 0; i < rowIdlength; i++) {
                $.each($("#valueChk-" + allRowId[i]), function() {
                    if ($(this).val().length < 1){
                        $("#attribute").removeClass('show');
                        $("#attribute").removeClass('active');
                        $("#v-pills-home-tab").removeClass('active');
                        $('#v-pills-home-tab').removeAttr('aria-selected');
                        $('#v-pills-home-tab').attr('aria-selected', 'false');

                        $('#v-pills-profile-tab').removeAttr('aria-selected');
                        $('#v-pills-profile-tab').attr('aria-selected', 'true');

                        $("#v-pills-profile-tab").addClass('active');
                        $("#attributeValue").addClass('show');
                        $("#attributeValue").addClass('active');
                    }
                });
            }
        }
    }

    $(document).on('change', '.errorChk', function(event) {
        if ($(this).hasClass("err1") && $(this).val != '') {
            $(this).removeClass("err1");
            let id = $(this).attr('id');
            $('#'+id).next("span").text('');
        }
    });

    $(document).on('click', '#btnSubmit', function(event) {
        if($('#category_id').val() == '' || $('#name').val() == '' || $('#type').val() == '') {
            $("#attribute").addClass('show');
            $("#attribute").addClass('active');
            $("#v-pills-home-tab").addClass('active');
            $('#v-pills-home-tab').removeAttr('aria-selected');
            $('#v-pills-home-tab').attr('aria-selected', 'false');

            $('#v-pills-profile-tab').removeAttr('aria-selected');
            $('#v-pills-profile-tab').attr('aria-selected', 'true');

            $("#v-pills-profile-tab").removeClass('active');
            $("#attributeValue").removeClass('show');
            $("#attributeValue").removeClass('active');
        }
    });
    function customValidation(){
        let allRowId = $("input[name='row_identify[]']").map(function(){return $(this).val();}).get();
        let checkText = 1;
        let rowIdlength = parseInt(allRowId.length);
        let flag = 0;
        for (let i = 0; i < rowIdlength; i++) {
            $.each($("#valueChk-" + allRowId[i]), function() {
                if ($(this).val()) {
                    checkText = 1;
                } else {
                    checkText = 0;
                }
            });
            if (checkText == 0) {
                $("#valueChk-" + allRowId[i]).addClass('err1');
                $('#value-text-' + allRowId[i]).text(jsLang('This field is required.'));
                flag = 1;
                break;
            } else {
                $("#valueChk-" + allRowId[i]).removeClass('err1');
                $('#value-text-' + allRowId[i]).text('');
                flag = 0;
            }
        }
        if (flag == 0 && checkText == 1){
            return true;
        }
        return false;
    }
    if ($('.main-body .page-wrapper').find('#attribute-add-container').length || $('.main-body .page-wrapper').find('#attribute-edit-container').length) {
            $("#values").sortable({
                distance: 5,
                delay: 300,
                opacity: 0.6,
                cursor: 'move',
            });
    }

    $("#attributeForm").on('submit', function(event) {
        if (type != 'field') {
            tabValidation();
            if(customValidation() == false) {
                event.preventDefault();
            } else {
                $("#spinnerText").text(jsLang('Please wait...'));
                $(".spinner").css({'display': 'inline-block', 'line-height': '0'});
                $('#btnSubmit').attr("disabled", true);
            }
        } else {
            $("#spinnerText").text(jsLang('Please wait...'));
            $(".spinner").css({'display': 'inline-block', 'line-height': '0'});
            $('#btnSubmit').attr("disabled", true);
        }
    });
    $("#attributeGroupAdd").on('submit', function(event) {
        $("#spinnerText").text(jsLang('Please wait...'));
        $(".spinner").css({'display': 'inline-block', 'line-height': '0'});
        $('#btnSubmit').attr("disabled", true);
    });
    $('#type').change(function ()
    {
        type = $('#type :selected').val();
        typeCheck()
    });
    function typeCheck()
    {
        if (type == 'field') {
            $('#secondli').hide();
        } else {
            $('#secondli').show();
            if ($('#attribute-value >tbody >tr').length < 1) {
                addAttributeValue();
            }
        }
    }
        $(document).on('click', '#add-new-value', function(event) {
        event.preventDefault();
         addAttributeValue();

    });

    function addAttributeValue()
    {
        let attributValue = `<tr draggable="false" class="" id="rowid-${rowid}">
                                <td class="text-center">
                                    <i class="fa fa-bars"></i>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="values[]" class="form-control errorChk" id="valueChk-${rowid}">
                                        <span id="value-text-${rowid}" class="validationMsg"></span>
                                        <input type="hidden" name="row_identify[]" value="${rowid}">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-danger delete-row" data-row-id="${rowid}" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                        <i class="feather icon-trash-2"></i>
                                    </button>
                                </td>
                            </tr>`;
        rowid++;
        $('#values').append(attributValue);
    }

    $(document).on('click', '.delete-row', function(e) {
        e.preventDefault();
        var idtodelete = $(this).attr('data-row-id');
        $('#rowid-' + idtodelete).remove();
    });
}
if ($('.main-body .page-wrapper').find('#attribute-list-container').length) {
    // For export csv
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/attributes/" + this.id;
    });
    $(".select2").select2();
}

if ($('.main-body .page-wrapper').find('#attribute_group-list-container').length) {
    // For export csv
    $(document).on("click", "#csv, #pdf", function(event) {
        event.preventDefault();
        window.location = SITE_URL + "/attribute-groups/" + this.id;
    });
    $(".select2").select2();
}
