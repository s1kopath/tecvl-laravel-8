"use strict";
if ($('.main-body .page-wrapper').find('#item-list-container, #vendor-item-list-container').length) {
    $('.select2').select2();
}
if ($('.main-body .page-wrapper').find('#item-add-container').length || $('.main-body .page-wrapper').find('#item-edit-container').length) {
    var action = 'create';
    var optionRowId = 2;
    discountTab();
    checkWarrentyField($('#warranty_type').val());
    if ($('.main-body .page-wrapper').find('#item-add-container').length) {
        $("#attributeBox").hide();
        $('.sideBar').hide();
    }
    if ($('.main-body .page-wrapper').find('#item-edit-container').length) {
        action = 'edit';
        optionRowId = 1;
        if (parseInt($('#cateAttLen').val()) > 0) {
            $("#attributeBox").show();
        } else {
            $("#attributeBox").hide();
        }
    }

    $('#summernote').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ]
    });

    $(document).on('change', '.errorChk', function(event) {
        if ($(this).hasClass("err1") && $(this).val != '') {
            $(this).removeClass("err1");
            let id = $(this).attr('id');
            $('#'+id).next("span").text('');
        }
    });

    $('.select2').select2({
        placeholder: jsLang('Nothing selected'),
        allowClear: true
    });

    // [ Tagging Support ] start
    $("#item_tags").select2({
        tags: true
    });
    if (action == 'edit') {
        let catId = $('#category_id').val();
        let itemId = $('#name').attr('data-item_id');
        addOption(catId);
        getItemOption(itemId);
        let available_from = $('#available_from').val();
        let available_to = $('#available_to').val();
        let discount_from = $('#discount_from').val();
        let discount_to = $('#discount_to').val();
        $('#available_from').daterangepicker(selectFromTo(available_from.length > 0 ? available_from : null));
        $('#available_from').on('change', function(e) {
            $('#available_to').daterangepicker(selectFromTo($(this).val(), 'to'));
            $('#available_to').val('');
        });
        $('#available_to').daterangepicker(selectFromTo(available_to.length > 0 ? available_to : null));
        available_from.length <= 0 ? $('#available_from').val('') : '';
        available_to.length <= 0 ? $('#available_to').val('') : '';

        $('#discount_from').daterangepicker(selectFromTo(discount_from.length > 0 ? discount_from : null));
        $('#discount_from').on('change', function(e) {
            $('#discount_to').daterangepicker(selectFromTo($(this).val(), 'to'));
            $('#discount_to').val('');
        });
        $('#discount_to').daterangepicker(selectFromTo(discount_to.length > 0 ? discount_to : null));
        discount_from.length <= 0 ? $('#discount_from').val('') : '';
        discount_to.length <= 0 ? $('#discount_to').val('') : '';
    }
    if (action == 'create') {
        $('#available_from').on('change', function(e) {
            $('#available_to').daterangepicker(selectFromTo($(this).val(), 'to'));
            $('#available_to').val('');
        });
        $('#discount_from').on('change', function(e) {
            $('#discount_to').daterangepicker(selectFromTo($(this).val(), 'to'));
            $('#discount_to').val('');
        });
        $('.start_date, .end_date').daterangepicker(selectFromTo());
        $('.start_date').val('');
        $('.end_date').val('');
    }
    var createOnce = true;
    var isLabelHide = [];
    isLabelHide[0] = false;
    var optionValueRow = 1;
    var attributeRowId = 1;
    var globalOption = [];
    var inputIndexValue = 1;
    var once = false;
    var discountType = $('#discount_type').val();

    action == 'create' ? $('#item-info').hide() : '';

    action == 'create' ? typeCheck($('#typeChk-1').val(), $('#typeChk-1').attr('data-select-id')) : '';

    $('#category_id').change(function ()
    {
        reset();
        let categoryId = $('#category_id').val();
        addAttribute(categoryId);
        $('.sideBar').show();
    });

    $('#discount_type').change(function ()
    {
        discountType = $(this).val();
    });

    function getItemOption(itemID)
    {
        $.ajax({
            url: SITE_URL + "/items/get-item-option",
            data: {
                item_id: itemID,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $.each(data, function (index, value){
                    let payLoads = JSON.parse(value.payloads);
                    let opVal = [];
                    $.each(payLoads.label, function (i, v) {
                        opVal[i] = {
                            'option' : payLoads.label[i],
                            'price' : payLoads.option_price[i].option_price,
                            'price_type' : payLoads.option_price_type[i],
                            'option_status' : typeof payLoads.option_status != 'undefined' ? payLoads.option_status[i] : null,
                            'inventory_quantity' : typeof payLoads.inventory_id != 'undefined' ? value.inventory_data[payLoads.inventory_id[i]] : 0,
                        }
                    });
                    let option = {
                        'item_option_id' : value.id,
                        'name' : value.name,
                        'type' : value.type,
                        'is_required' : value.is_required,
                        'values' : opVal,
                    }

                    addNewOption(option, 'edit');
                });
            }
        });
    }

    function discountTab()
    {
        if ($("#is_discount_enable").is(":checked")) {
            $('#discount_amount_lbl').addClass('require');
            $('#discount_from_lbl').addClass('require');
            $('#discount_to_lbl').addClass('require');
            $('#discount_type_lbl').addClass('require');
            $('#discount_amount').prop('required',true);
            $('#discount_amount').attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $('#discount_from').prop('required',true);
            $('#discount_from').attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $('#discount_to').prop('required',true);
            $('#discount_to').attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $('#discount_type').prop('required',true);
            $('#discount_type').attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $("#discount").show();
        } else {
            $('#discount_amount_lbl').removeClass('require');
            $('#discount_from_lbl').removeClass('require');
            $('#discount_to_lbl').removeClass('require');
            $('#discount_type_lbl').removeClass('require');
            $('#discount_amount').prop('required',false);
            $('#discount_amount').removeAttr('oninvalid');
            $('#discount_from').prop('required',false);
            $('#discount_from').removeAttr('oninvalid');
            $('#discount_to').prop('required',false);
            $('#discount_to').removeAttr('oninvalid');
            $('#discount_type').prop('required',false);
            $('#discount_type').removeAttr('oninvalid');
            $("#discount").hide();
        }
    }

    $('#is_discount_enable').on('change', function(e) {
        discountTab();
    });

    $('#discount_amount, #discount_type, #price').on('change', function(e) {
        let discountPrice = null;
        let discountAmount = parseFloat($('#discount_amount').val());
        let actualPrice = parseFloat($('#price').val());
        let discountType = $('#discount_type').val();
        if ($("#is_discount_enable").is(":checked") && $.isNumeric(discountAmount) && actualPrice > 0 && discountType != '') {
            if (discountType == "Flat") {
                $('#discount_price').val(actualPrice - discountAmount);
            } else if (discountType == "Percent") {
                $('#discount_price').val(actualPrice - (discountAmount * actualPrice) / 100);
            }
        } else {
            $('#discount_price').val(null);
        }
    });

    function reset()
    {
        $('#item-info').show();
        $('#attribute_information').empty();
        let avoidFirstOption = true;
        let avoidFirstOptionValue = false;
        $.each($('.custom-option .card'), function (index, value) {
            if (avoidFirstOption == true) {
                avoidFirstOption = false;
            } else {
                $(this).remove();
            }
        });
        $.each($('.option_div'), function (valueIndex, optionValue) {
            $.each($('#'+optionValue.id+ ' table>tbody>tr.option-value-rowid'), function() {
                let trId = $(this).attr('id');
                if (avoidFirstOptionValue != false) {
                    $('#'+optionValue.id+' table>tbody>tr#'+trId).remove();
                }
                avoidFirstOptionValue = true;
            });

        });
        $('.labelChk').val(null);
        $('.priceChk').val(null);
        $('.price_type').val('Fixed');
        $('.option_nameChk').val(null);
        $('.is_requiredChk').val(0);
        $('.typeChk').val(null);
        globalOption = [];
        createOnce = true;
    }

    function capitalizeFirstLetter(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function lowerCase(str)
    {
        str = str.toLowerCase();
        return str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-')
    }

    function removeNumber(strnum)
    {
        return strnum.replace(/\d+/g, '')
    }

    function addAttribute(categoryId)
    {
        $.ajax({
            url: SITE_URL + "/attributes/get-attribute",
            data: {
                category_id: categoryId,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if (data.length > 0) {
                    $("#attributeBox").show();
                    addAttributeHtml(data, 'attribute_information');
                    addOption(categoryId);
                } else {
                    $("#attributeBox").hide();
                }
            }
        });
    }
    function addAttributeHtml(data, selector)
    {
        let attribute = '';
        let even = 0;
        let numOfCols = 3;
        let rowCount = 0;
        let bootstrapColWidth = 12 / numOfCols;
        let formGroupStart = '';
        let formGroupEnd = '';
        let type = '';
        $.each(data, function( index, value ) {
            if (rowCount % numOfCols == 0) {
                rowCount++;
                formGroupStart = `<div class="form-group row">`
                formGroupEnd = ``
            } else {
                formGroupStart = '';
            }
            if (rowCount % numOfCols == 0) {
                formGroupEnd = `</div>`;
            }
            let attributeValues = '';
            if (value.type == 'dropdown' || value.type == 'multiple_select') {
                attributeValues = `<option value="">${jsLang('Select One')}</option>`;
                $.each(value.values, function( attributeValueIndex, attributeValue ) {
                    attributeValues += `<option value="${attributeValue.value}">${attributeValue.value}</option>`;
                });
            }
            if (value.type == 'dropdown') {
                type = `<select class="form-control errorChk ${selector} ${value.is_required == 1 ? 'attribute_require' : ''}" id="${lowerCase(value.name)}-${attributeRowId}" name="attribute_data[${value.id}]">
                          ${attributeValues}
                        </select>
                        <span id="value-${lowerCase(value.name)}-${attributeRowId++}" class="validationMsg"></span>
                        `;
            } else if (value.type == 'field') {
                type = `<input type="text" class="form-control errorChk ${selector} ${value.is_required == 1 ? 'attribute_require' : ''}" id="${lowerCase(value.name)}-${attributeRowId}" name="attribute_data[${value.id}]">
                       <span id="value-${lowerCase(value.name)}-${attributeRowId++}" class="validationMsg"></span>
                       `;
            } else if (value.type == 'multiple_select') {
                type = `<select class="js-example-basic-multiple errorChk selectMultiple ${selector} ${value.is_required == 1 ? 'attribute_require' : ''}" id="${lowerCase(value.name)}-${attributeRowId}" name="attribute_data[${value.id}][]" multiple="multiple">
                          ${attributeValues}
                        </select>
                         <span id="value-${lowerCase(value.name)}-${attributeRowId++}" class="validationMsg"></span>
                       `;
            } else if (value.type == 'checkbox') {
                $.each(value.values, function( attributeValueIndex, attributeValue ) {
                    attributeValues += `
                                   <div class="form-group d-inline">
                                        <div class="checkbox d-inline">
                                            <input type="checkbox" class="${selector} ${value.is_required == 1 ? 'attribute_require' : ''} ${removeNumber(lowerCase(value.name))}" name="${lowerCase(attributeValue.value)}" id="${lowerCase(value.name)}_${attributeValueIndex}">
                                            <label for="${lowerCase(value.name)}_${attributeValueIndex}" class="cr">${capitalizeFirstLetter(attributeValue.value)}</label>
                                        </div>
                                   </div>
                                         `;
                    type = attributeValues;
                });
                type += `<span id="value-${lowerCase(value.name)}_" class="validationMsg"></span>`;
            }
            attribute +=
                `
                            ${formGroupStart}

                            <div class="col-sm-4">
                                <label for="${value.name}" class="control-label ${value.is_required == 1 ? 'require' : ''}"> ${capitalizeFirstLetter(value.name.length > 25 ? value.name.substring(0, 25)+".." : value.name)} ${value.explain != null && value.explain.length > 0 ? `<i id="bottom-toolbar-${attributeRowId}" class="fas fa-question-circle bottom-toolbar" data-toggle="popover" data-placement="bottom" data-content="${value.explain}"></i>` : ''} </label>
                                ${type}
                            </div>

                            ${formGroupEnd}
                         `
        });
        $('#'+selector).append(attribute);
        $('[data-toggle="popover"]').popover();
        $('.selectMultiple').select2();
    }

    function addOption(categoryId)
    {
        $.ajax({
            url: SITE_URL + "/options/get-option",
            data: {
                category_id: categoryId,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#global_option').find('option').not(':first').remove();
                $.each(data, function (index, value) {
                    $('#global_option').append($('<option>', {
                        value: value.id,
                        text: value.name,
                    }));
                    globalOption[value.id] = {
                        'id' : value.id,
                        'name' : value.name,
                        'type' : value.type,
                        'is_required' : value.is_required,
                        'values' : value.values
                    };
                });
            }
        });
    }

    /* price information */
    $(document).on('change', '.typeChk', function() {
        let selectedId = $(this).attr('data-select-id');
        let idName = $(this).attr('id');
        let label = $(this).val();
        typeCheck(label, selectedId);
        trackInventroy();
    });

    /*check type for necessary action*/
    function typeCheck(label, selectedId)
    {
        if (label.length > 0) {
            $('#option_div-'+selectedId).show();
            if (label == 'field' || label == 'textarea' || label == 'date' || label == 'date_time' || label == 'time') {
                hideTable(selectedId);
            } else {
                showTable(selectedId);
            }
        } else {
            $('#option_div-'+selectedId).hide();
        }
    }

    /* hide table column */
    function hideTable(id)
    {
        let avoidFirst  = false;
        isLabelHide[id] = true;
        $.each($('#option_div-'+id+' table>tbody>tr.option-value-rowid'), function() {
            let trId = $(this).attr('id');
            if (avoidFirst != false) {
                $('#option_div-'+id+' table>tbody>tr#'+trId).remove();
            }
            avoidFirst = true;
        });
        $('#option_div-'+id+' table>thead>tr>th.bar').hide();
        $('#option_div-'+id+' table>thead>tr>th.label').hide();
        $('#option_div-'+id+' table>thead>tr>th.delete').hide();

        $('#option_div-'+id+' table>tbody>tr>td.bar').hide();
        $('#option_div-'+id+' table>tbody>tr>td.label').hide();
        $('#option_div-'+id+' table>tbody>tr>td.delete').hide();

        $('#option_div-'+id+' #add-new-option-value-'+id).hide();
    }

    function showTable(id)
    {
        isLabelHide[id] = false;
        $('#option_div-'+id+' table>thead>tr>th.bar').show();
        $('#option_div-'+id+' table>thead>tr>th.label').show();
        $('#option_div-'+id+' table>thead>tr>th.delete').show();

        $('#option_div-'+id+' table>tbody>tr>td.bar').show();
        $('#option_div-'+id+' table>tbody>tr>td.label').show();
        $('#option_div-'+id+' table>tbody>tr>td.delete').show();

        $('#option_div-'+id+' #add-new-option-value-'+id).show();
    }

    /* remove option value */
    $(document).on('click', '.delete-option-value-row', function(e) {
        e.preventDefault();
        $(this).closest("tr").remove();
    });

    /* remove option  */
    $(document).on('click', '.delete-option-row', function(e) {
        e.preventDefault();
        let rowDel = $(this).attr('data-row-id');
        $('#custom-option-' + rowDel).remove();
        let globalId = $(this).attr('data-globalid');
        $.each($('#global_option option'), function (i, v){
            if ($(this).val() == globalId) {
                $(this).removeAttr('disabled');
            }
        });
    });

    /* add new option */
    $(document).on('click', '#add-new-option', function(event) {
        event.preventDefault();
        addNewOption();
    });

    function addNewOption(global = null, actionPerform = 'create')
    {
        optionValueRow = 1;
        let globalValues = global != null ? global.values : null;
        let newOption = `
                       <div class="accordion custom-option" id="accordionExample-${optionRowId}">
                         <div class="mt-2" id="custom-option-${optionRowId}">
                            <div id="collapse-${optionRowId}" class="card-body custom-pad collapse show" aria-labelledby="headingOne" data-parent="#accordionExample-${optionRowId}">
                                <div class="col-sm-12">
                                    <div class="row border">
                                       <div class="col-sm-4 mt-3">
                                           <div class="form-group row">

                                                <div class="col-sm-1">
                                                    <label for="option_name" class="control-label mt-1"><i class="fa fa-arrows-alt drag-color" aria-hidden="true"></i>
                                                    </label>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="option_name" class="col-sm-4 mL-15 control-label require">${jsLang(('Name'))}</label>
                                                </div>
                                               <div class="col-sm-7">
                                                   <input type="text" placeholder="${jsLang(('Name'))}" class="form-control errorChk option_nameChk" id="option_nameChk-${optionRowId}" name="option_data[${optionRowId}][option_name]" value="${ global != null ?  global.name : ''}" ${ global != null && global.name == 'Color' ||  global != null && global.name == 'Size'?  "readonly" : ''}>
                                                   <span id="value-option_name-${optionRowId}" class="validationMsg"></span>
                                               </div>
                                           </div>
                                       </div>
                                       <input type="hidden" name="option_row_identify[]" value="${optionRowId}">
                                       ${ actionPerform == 'edit' && global != null ? `<input type="hidden" name="option_data[${optionRowId}][item_option_id]" value="${global.item_option_id}">` : '' }
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group row">
                                                <label for="type" class="col-sm-4 control-label require">${jsLang(('Type'))}</label>
                                                <div class="col-sm-8">
                                                    <select class="js-example-basic-single form-control errorChk typeChk" id="typeChk-${optionRowId}" name="option_data[${optionRowId}][type]" data-select-id=${optionRowId}>
                                                            <option value="" selected="">${jsLang(('Select One'))}</option>
                                                            <option value="dropdown" ${ global != null && global.type == 'dropdown' ? 'selected'  : ''}>${jsLang(('Dropdown'))}</option>
                                                    </select>
                                                    <span id="value-option_type-${optionRowId}" class="validationMsg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <div class="form-group row">
                                                <label for="is_required" class="col-sm-5 control-label">${jsLang(('Required'))}</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control is_requiredChk" name="option_data[${optionRowId}][is_required]" id="is_requiredChk-${optionRowId}">
                                                        <option value="0" ${ global != null && global.is_required == 0 ? 'selected'  : ''}>${jsLang(('No'))}</option>
                                                        <option value="1" ${ global != null && global.is_required == 1 ? 'selected'  : ''}>${jsLang(('Yes'))}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 mt-3">
                                            <div class="form-group row">
                                                <div class="col-sm-12 margin-top-1p text-center">
                                                    <a type="button" id="delete-option-${optionRowId}" class="del-btn delete-option-row" data-row-id=${optionRowId} data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="" data-globalId = "${global != null && typeof global.id != 'undefined' ? global.id : '' }">
                                                        <i class="feather icon-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="custom-option-value-1">
                                  <div class="table-responsive option_div" id="option_div-${optionRowId}">
                                    <table class="options table table-bordered">
                                        <thead class="t-head">
                                        <tr>
                                            <th class="label">${jsLang('Label')}</th>
                                            <th>${jsLang('Price')}</th>
                                            <th class="option_qty">${jsLang('Quantity')}</th>
                                            <th>${jsLang('Price type')}</th>
                                            <th>${jsLang('Status')}</th>
                                            <th class="delete custom-width">
                                                <a type="button" class="text-center font_12 add-new-option-value color_848484" id="add-new-option-value-${optionRowId}" data-row-id=${optionValueRow} data-div-id=${optionRowId}><i class="fas fa-plus"></i> ${jsLang('Add')}</a>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="option-values-${optionRowId}" class="drag_and_drop">

                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                      </div>
                       </div>
                        `;
        $('#new_option').append(newOption);
        addNewOptionValue(optionRowId, globalValues);
        global == null ? $('#option_div-'+optionRowId).hide() : '';
        optionRowId++;
    }

    /* add new option value */
    $(document).on('click', '.add-new-option-value', function(event) {
        event.preventDefault();
        let valueRowId = $(this).attr('data-row-id');
        let divRowId = $(this).attr('data-div-id');
        inputIndexValue = divRowId;
        addNewOptionValue(divRowId);
    });

    function addNewOptionValue(divRowId, globalValue = null)
    {
        inputIndexValue = divRowId;
        let newOptionValue = '';
        if (globalValue != null) {
            $.each(globalValue, function (index, value) {
                ++optionValueRow;
                newOptionValue += addNewOptionValueHtml(value);
            })
        } else {
            ++optionValueRow;
            newOptionValue = addNewOptionValueHtml();
        }
        $('#option-values-'+divRowId).append(newOptionValue);
        typeCheck($('#typeChk-'+divRowId).val(), $('#typeChk-'+divRowId).attr('data-select-id'));
        dragAndDrop(".drag_and_drop");
        trackInventroy();
    }

    function addNewOptionValueHtml(values = null)
    {
        return `
           <tr draggable="false" id="option-value-rowid-${optionValueRow}" class="option-value-rowid">
                <td class="label">
                    <div class="d-flex">
                        <i class="fa fa-arrows-alt drag-color mt-2 pr-3" aria-hidden="true"></i>
                        <input type="text" name="option_data[${inputIndexValue}][label][]" value="${ values != null && values.option != null ? values.option : '' }" class="form-control errorChk labelChk" id="labelChk-${optionValueRow}">
                    </div>
                    <span id="value-label-${optionValueRow}" class="validationMsg value-label ml-27px"></span>
                </td>
                <td>
                    <input type="text" name="option_data[${inputIndexValue}][option_price][]" value="${ values != null ? values.price : '' }" class="form-control errorChk positive-float-number priceChk" maxlength="8" id="priceChk-${optionValueRow}">
                    <span id="value-price-${optionValueRow}" class="validationMsg value-price"></span>
                </td>
                <td class="option_qty">
                    <input type="text" name="option_data[${inputIndexValue}][option_qty][]" value="${ values != null && typeof values.inventory_quantity != 'undefined' ? values.inventory_quantity : 0 }" class="form-control errorChk positive-float-number inventory_qty" maxlength="10">
                    <span id="value-qty-${optionValueRow}" class="validationMsg value-qty"></span>
                </td>
                <td>
                    <select class="form-control price_type" name="option_data[${inputIndexValue}][option_price_type][]" id="price_type">
                        <option value="Fixed" ${ values != null && values.price_type == 'Fixed' ? 'selected' : '' }>${jsLang('Fixed')}</option>
                        <option value="Percent" ${ values != null && values.price_type == 'Percent' ? 'selected' : '' }>${jsLang('Percent')}</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="option_data[${inputIndexValue}][option_status][]" id="option_status">
                        <option value="Active" ${ values != null && values.option_status == 'Active' ? 'selected' : '' }>${jsLang('Active')}</option>
                        <option value="Inactive" ${ values != null && values.option_status == 'Inactive' ? 'selected' : '' }>${jsLang('Inactive')}</option>
                    </select>
                </td>
                <td class="text-center delete">
                    <a type="button" id="delete-option-value-${optionValueRow}" class="del-btn delete-option-value-row" data-row-id=${optionValueRow} data-div-id=${optionRowId} data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                        <i class="feather icon-trash-2"></i>
                    </a>
                </td>
            </tr>
        `;
    }

    /* drag and drop function */
    function dragAndDrop(selector)
    {
        $(selector).sortable({
            distance: 2,
            delay: 300,
            opacity: 0.8,
            cursor: 'move',
        });
    }

    /*Drag and drop attribute table column*/
    dragAndDrop(".drag_and_drop");

    /* add global option */
    $(document).on('click', '#add-new-option-global', function(e) {
        e.preventDefault();
        let globalSelectedValue = $('#global_option').val();
        if (globalSelectedValue.length > 0) {
            addNewOption(globalOption[globalSelectedValue]);
            $("#global_option option:selected").attr('disabled', 'disabled');
        }
    });

    function customOptionValidation(clickBtn = false)
    {
        let checkName = 0;
        let checkType = 0;
        let checkNameFlag = 0;
        let checkLabel = 1;
        let checkPrice = 0;
        let checkTypeFlag = 0;
        let checkLabelFlag = 0;
        let checkPriceFlag = 0;
        let checkQty = 0;
        let checkQtyFlag = 0;
        let allOptionRowId = $("input[name='option_row_identify[]']").map(function(){return $(this).val();}).get();
        for (let i = 0; i < allOptionRowId.length; i++) {
            $.each($("#option_nameChk-" + allOptionRowId[i]), function() {
                if ($(this).val()) {
                    checkName = 1;
                } else {
                    checkName = 0;
                }
                if ($("#typeChk-" + allOptionRowId[i]).val()) {
                    checkType = 1;
                } else {
                    checkType = 0;
                }
                if (checkName == 1 && checkType == 1) {
                    $.each($('#option_div-'+allOptionRowId[i]+' table>tbody>tr.option-value-rowid'), function() {
                        if(isLabelHide[allOptionRowId[i]] == false) {
                            let label = $(this).closest('tr').find('.labelChk').val();
                            if (label.length > 0) {
                                checkLabel = 1;
                            } else {
                                checkLabel = 0;
                            }
                        }
                        let price = $(this).closest('tr').find('.priceChk').val();
                        let qty = $(this).closest('tr').find('.inventory_qty').val();
                        if (price.length > 0) {
                            checkPrice = 1;
                        } else {
                            checkPrice = 0;
                        }
                        if ($("#track_inventory").is(":checked")) {
                            if (qty.length > 0 && qty > 0) {
                                checkQty = 1;
                            } else {
                                checkQty = 0;
                            }
                        } else {
                            checkQty = 1;
                        }
                        if (checkLabel == 0) {
                            $(this).closest('tr').find('.labelChk').addClass('err1');
                            $(this).closest('tr').find('.value-label').text(jsLang('This field is required.'));
                            checkLabelFlag = 3;
                            return false;
                        } else {
                            $(this).closest('tr').find('.labelChk').removeClass('err1');
                            $(this).closest('tr').find('.value-label').text('');
                            checkLabelFlag = 0;
                        }
                        if (checkPrice == 0) {
                            $(this).closest('tr').find('.priceChk').addClass('err1');
                            $(this).closest('tr').find('.value-price').text(jsLang('This field is required.'));
                            checkPriceFlag = 3;
                            return false;
                        } else {
                            $(this).closest('tr').find('.priceChk').removeClass('err1');
                            $(this).closest('tr').find('.value-price').text('');
                            checkPriceFlag = 0;
                        }

                        if (checkQty == 0) {
                            $(this).closest('tr').find('.inventory_qty').addClass('err1');
                            $(this).closest('tr').find('.value-qty').text(jsLang('required & more than 0.'));
                            checkQtyFlag = 3;
                            return false;
                        } else {
                            $(this).closest('tr').find('.inventory_qty').removeClass('err1');
                            $(this).closest('tr').find('.value-qty').text('');
                            checkQtyFlag = 0;
                        }

                    });
                }
            });
            if (checkPriceFlag == 3 || checkLabelFlag == 3 || checkQtyFlag == 3){
                return false;
            } else {
                if (checkName == 0) {
                    $("#option_nameChk-" + allOptionRowId[i]).addClass('err1');
                    $('#value-option_name-' + allOptionRowId[i]).text(jsLang('This field is required.'));
                    checkNameFlag = 1;
                    if (clickBtn == false) {
                        break;
                    }
                } else {
                    $("#option_nameChk-" + allOptionRowId[i]).removeClass('err1');
                    $('#value-option_name-' + allOptionRowId[i]).text('');
                    checkNameFlag = 0;
                }
                if (checkType == 0) {
                    $("#typeChk-" + allOptionRowId[i]).addClass('err1');
                    $('#value-option_type-' + allOptionRowId[i]).text(jsLang('This field is required.'));
                    checkTypeFlag = 1;
                    if (clickBtn == false) {
                        break;
                    }
                } else {
                    $("#typeChk-" + allOptionRowId[i]).removeClass('err1');
                    $('#value-option_type-' + allOptionRowId[i]).text('');
                    checkTypeFlag = 0;
                }
            }
        }

        if (checkNameFlag == 0 && checkTypeFlag == 0 && checkLabelFlag == 0 && checkPriceFlag == 0) {
            return true;
        }
        return false;

    }

    function customAttributeValidation(clickBtn = false)
    {
        let idName = '';
        let check = 1;
        $(".attribute_require").each(function() {
            idName = $(this).attr('id');
            let attributeVal = $("#"+idName).val();
            if (attributeVal.length <= 0)
            {
                $("#"+idName).addClass('err1');
                $('#value-' + idName).text(jsLang('This field is required.'));
                check = 0;
                if (clickBtn == false) {
                    return false;
                }
            } else if (attributeVal.length > 50) {
                $("#"+idName).addClass('err1');
                var errMsg = jsLang('The value not more than :x characters long.');
                errMsg = errMsg.replace(":x", 50);
                $('#value-' + idName).text(errMsg);
                check = 0;
                return false;
            } else {
                $("#"+idName).removeClass('err1');
                $('#value-' + idName).text('');
            }
        });
        if (check == 0) {
            return false;
        } else {
            return true;
        }
    }

    function customDiscountAmountValidation()
    {
        if(parseInt($('#discount_amount').val()) > parseInt($('#price').val()) && discountType != 'Percent') {
            $('#discount_amount').addClass('err1');
            $('#discount-amount-error').text(jsLang('Discount amount not more than actual price.'));
            return false;
        } else if(parseInt($('#discount_amount').val()) > 100 && discountType == 'Percent') {
            $('#discount_amount').addClass('err1');
            $('#discount-amount-error').text(jsLang('Discount percent not more than 100'));
            return false;
        } else {
            $('#discount_amount').removeClass('err1');
            $('#discount-amount-error').text('');
            return true;
        }
    }

    $("#itemForm").on('submit', function(event) {
        if (customDiscountAmountValidation() == true) {
            if(customAttributeValidation() == true) {
                if (customOptionValidation() == false) {
                    jump();
                    event.preventDefault();
                } else {
                    $("#spinnerText").text(jsLang('Please wait...'));
                    $(".spinner").css({'display': 'inline-block', 'line-height': '0'});
                    $('#btnSubmit').attr("disabled", true);
                }
            } else {
                jump();
                event.preventDefault();
            }
        } else {
            jump();
            event.preventDefault();
        }
    });
    $(document).on('click', '#btnSubmit', function(e) {
        once = true;
        let clickBtn = true;
        customAttributeValidation(clickBtn)
        customOptionValidation(clickBtn)
    });
    function jump()
    {
        $('html, body').animate({
            scrollTop: $('.err1').offset().top
        }, 1000);
    }

    $('#warranty_type').change(function(e) {
        checkWarrentyField($(this).val());
    });

    function checkWarrentyField(val)
    {
        if (val != "No Warranty") {
            $('#warranty_period').prop('disabled', false);
            $('#warranty_period_lbl').addClass('require');
            $('#warranty_period').prop('required',true);
            $('#warranty_period').attr('oninvalid', "this.setCustomValidity(jsLang('This field is required.'))");
            $('#warranty_policy').attr('readonly', false);
        } else {
            $('#warranty_period').prop('disabled', 'disabled');
            $('#warranty_period_lbl').removeClass('require');
            $('#warranty_period').prop('required',false);
            $('#warranty_period').removeAttr('oninvalid');
            $('#warranty_policy').attr('readonly', true);
        }
    }

    $('#track_inventory').change(function () {
        trackInventroy();
    });

    function trackInventroy() {
        if ($('#track_inventory').is(':checked')) {
            $('.option_qty').show();
        } else {
            $('.option_qty').hide();
        }
    }

    $(document).on('change', '.inventory_qty', function() {
        let currValue = $(this).val();
        currValue = float2int(currValue);
        $(this).val(currValue);
    });

    function float2int (value) {
        return Math.round(value);
    }

}

if ($('.main-body .page-wrapper').find('#item-list-container').length) {
    $(document).on("click", "#csv, #pdf", function (event) {
        event.preventDefault();
        window.location = SITE_URL + "/items/" + this.id;

    });
}
if ($('.main-body .page-wrapper').find('#vendor-item-list-container').length) {
    $(document).on("click", "#csv, #pdf", function (event) {
        event.preventDefault();
        window.location = SITE_URL + "/items/" + this.id;
    });
}
if ($('.main-body .page-wrapper').find('#item-view-container').length) {
    hideNoDiv();
    selectFirst();
    var preVDuplicateRelate = [];
    var preVDuplicateCross = [];
    var preVDuplicateUp = [];
    $( "#search" ).autocomplete({
        delay: 500,
        position: {my: "left top", at: "left bottom", collision: "flip"},
        source: function (request, response) {
            autoCompleteSource(request, response, SITE_URL + '/items/search/'+'relate', '#search', '#no_div_relate');
        },
        select: function (event, ui) {
            let e = ui.item;
            $('#related-item-table').show();
            $('#select_first_related').hide();
            if (typeof(preVDuplicateRelate[e.id]) == "undefined" && preVDuplicateRelate[e.id] != e.value) {
                addRow("relate", e, "#item_data");
                this.value = "";
                return false;
            } else {
                swal(jsLang('Already Exists!'), {
                    icon: "error",
                    buttons: [false, jsLang('Ok')],
                });
            }
        },
        minLength: 1,
        autoFocus: true
    });

    function addRow(type, e, selector)
    {
        let newRow = `
                        <tr class="relate-item-value-rowid">
                            <td>
                                <span> ${e.value} </span>
                            </td>
                            <td>
                                <span> ${e.item_code} </span>
                            </td>
                            <td>
                               <span> ${e.sku != null ? e.sku : ''} </span>
                               <input type="hidden" value="${e.id}" name="related_item_id[]">
                            </td>
                            <td class="text-center delete">
                                <button type="button" class="btn btn-xs btn-danger delete-item-value-row" data-itemId="${e.id}" data-type="${type}" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                    <i class="feather icon-trash-2"></i>
                                </button>
                            </td>
                        </tr>
                     `;
        if (type == "relate") {
            preVDuplicateRelate[e.id] = e.value;
        } else if(type == "cross") {
            preVDuplicateCross[e.id] = e.value;
        } else if(type == "up") {
            preVDuplicateUp[e.id] = e.value;
        }

        $(selector).append(newRow);
    }

    $( "#search_cross" ).autocomplete({
        delay: 500,
        position: {my: "left top", at: "left bottom", collision: "flip"},
        source: function (request, response) {
            autoCompleteSource(request, response, SITE_URL + '/items/search/'+'cross', '#search_cross', '#no_div_cross');
        },
        select: function (event, ui) {
            let e = ui.item;
            $('#cross-item-table').show();
            $('#select_first_cross').hide();
            if (typeof(preVDuplicateCross[e.id]) == "undefined" && preVDuplicateCross[e.id] != e.value) {

                addRow("cross", e, "#item_data_cross");

                this.value = "";
                return false;
            } else {
                swal(jsLang('Already Exists!'), {
                    icon: "error",
                    buttons: [false, jsLang('Ok')],
                });
            }
        },
        minLength: 1,
        autoFocus: true
    });

    $( "#search_up" ).autocomplete({
        delay: 500,
        position: {my: "left top", at: "left bottom", collision: "flip"},
        source: function (request, response) {
            autoCompleteSource(request, response, SITE_URL + '/items/search/'+'up', '#search_up', '#no_div_up');
        },
        select: function (event, ui) {
            let e = ui.item;
            $('#up-item-table').show();
            $('#select_first_up').hide();
            if (typeof(preVDuplicateUp[e.id]) == "undefined" && preVDuplicateUp[e.id] != e.value) {
                addRow("up", e, "#item_data_up");
                this.value = "";
                return false;
            } else {
                swal(jsLang('Already Exists!'), {
                    icon: "error",
                    buttons: [false, jsLang('Ok')],
                });
            }
        },
        minLength: 1,
        autoFocus: true
    });

    function autoCompleteSource(request = null, response = null, url = null, selector = null, divSelector = null) {
        let text = $(selector).val();
        let itemId = $('#item_id').val();
        $.ajax({
            url: url,
            dataType: "json",
            type: "POST",
            data: {
                _token:token,
                search: text,
                item_id: itemId
            },
            success: function(data) {
                if(data.status_no == 1) {
                    var data = data.item;
                    $(divSelector).css('display','none');
                    response($.map( data, function( item ) {
                        return {
                            id: item.id,
                            value: item.name,
                            item_code: item.item_code,
                            sku: item.sku,
                        }
                    }));
                } else {
                    $('.ui-menu-item').remove();
                    $(divSelector).css('top',$(selector).position().top+35);
                    $(divSelector).css('left',$(selector).position().left);
                    $(divSelector).css('width',$(selector).width());
                    $(divSelector).css('display','block');
                }
                //end
            }
        })
    }

    $(document).on('click', '.delete-item-value-row', function(e) {
        e.preventDefault();
        let type = $(this).attr('data-type');
        removeArrayElement(type, $(this).attr('data-itemId'))
        $(this).closest("tr").remove();
        selectFirst();
    });

    function removeArrayElement(type, itemId)
    {
        if (type == "relate") {
            delete preVDuplicateRelate[itemId];
        } else if(type == "cross") {
            delete preVDuplicateCross[itemId];
        } else if(type == "up") {
            delete preVDuplicateUp[itemId];
        }
    }

    function hideNoDiv()
    {
        $('#no_div_relate').hide();
        $('#no_div_cross').hide();
        $('#no_div_up').hide();
    }
    function selectFirst()
    {
        if ($('#item_data tr').length > 0) {
            $('#related-item-table').show();
        } else {
            $('#select_first_related').show();
        }
        if($('#item_data_cross tr').length > 0) {
            $('#cross-item-table').show();
        } else {
            $('#select_first_cross').show();
        }
        if ($('#item_data_up tr').length > 0) {
            $('#up-item-table').show();
        } else {
            $('#select_first_up').show();
        }
    }


    deleteAttachment(SITE_URL + '/file/remove?type=item_option');
    let dropzoneCount = 1;
    let optionCount = 1;
    $.each($('.option_div'), function (i, v){
        let optionVal = $('#option-id-'+optionCount).val();
        $.each($('#option_div-'+optionCount+' table>tbody>tr.option-value-rowid'), function() {
            uploadAttachmentById(SITE_URL + '/file/upload?type=item_option', '#uploader-text-'+dropzoneCount, '#add-attachments-'+dropzoneCount, '#dropzone-attachments-'+dropzoneCount, optionVal);
            dropzoneCount++;
        });
        optionCount++;
    });

    $(document).on('keyup', '#seo_slug', function() {
        var str = this.value.replace(/[&\/\\#@,+()$~%.'":*?<>{}]/g, "");
        $('#seo_slug').val(str.trim().toLowerCase().replace(/\s/g, "-"));
    });
}

if ($('.main-body .page-wrapper').find('#item-import-container').length) {
    $("#fileRequest").on("click", function() {
        window.location = SITE_URL. replace("/admin", "") . replace("/vendor", "") + "/public/dist/downloads/item_sheet.csv";

    });

    $('.error, #note_txt_2').hide();
    $("#validatedCustomFile").on('change', function() {
        //get uploaded filename
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));

        //image validation
        var fileName = files.toString();
        var ext      = fileName.split('.').pop();
        if ($.inArray(ext, ['csv']) == -1) {
            $('#note_txt_1, .error').hide();
            $('#note_txt_2').show();
            $('#note_txt_2').html('<h6> <span class="text-danger font-weight-bolder">' + jsLang('Invalid file extension') +' </span> </h6> <span class="badge badge-info note-style">' + jsLang('Note') +'</span><small class="text-info"> ' + jsLang('Allowed File Extensions: csv')) + '</small>';
        } else {
            $('#note_txt_1, #note_txt_2').hide();
        }
    });

    $('.search-table').on('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = $(this).val();
        filter = input.toUpperCase();
        table = $(".myTable");
        tr = $(".myTable tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].querySelector(".search");
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    })

    $('#goto-optional, #goto-required').css({'right': '10px', 'top': '100px'});
    $('.require-section, .optional-section').css('overflow', 'hidden');
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        $('#goto-optional').css('top', scroll+100+'px')
        var require_height = $('.require-section').height()
        $('#goto-required').css('top', scroll+100-require_height+'px')
    });
}
