// Open modal
'use strict';
$('.placeholder-loader').css('display', 'none');
$(document).off('click','.open-view-modal').on('click','.open-view-modal',function() {
    $('.placeholder-loader').css('display', 'block');
    $('.item-view-content').css('display', 'none');

    $('#view-modal').css('display', 'flex');
    var itemId = $(this).attr('data-itemId');
    $.ajax({
        url: SITE_URL + "/item/quick-view/" + itemId,
        type: 'GET',
        success: function (data) {
            $('.placeholder-loader').css('display', 'none');
            $('.item-view-content').css('display', 'block');
            $('#item-view-load').html(data);
            $('#view-modal').css('display', 'flex');

        }
    });

})

// Close modal when click outside of the modal

$(document).on('click', function(e) {

    if(!(($(e.target).closest("#view-modal-main").length > 0 ) || ($(e.target).closest(".open-view-modal").length > 0))) {

        $("#view-modal").css('display', 'none');
        $('.placeholder-loader').css('display', 'block');
        $('.item-view-content').css('display', 'none');

    }

})


$(document).on('click', ".open-view-modal-close", function(e) {

    $("#view-modal").css('display', 'none');
        $('.placeholder-loader').css('display', 'block');
        $('.item-view-content').css('display', 'none');

})


var mainPriceV = $('#item_priceV').text().replace(/,/g, '');
    var amountV = [];
    $(document).on('change', '.option_priceV', function() {
        let priceV, priceTypeV, optionIdV, optionBoxV, inputTypeV, reducePriceV;
        inputTypeV = typeof ($(this).find(':selected').attr('data-inputType')) != 'undefined' ? $(this).find(':selected').attr('data-inputType') : $(this).attr('data-inputType');
        optionBoxV = typeof ($(this).find(':selected').attr('data-option')) != 'undefined' ? $(this).find(':selected').attr('data-option') : $(this).attr('data-option');
        $("#required-msgV-"+optionBoxV).addClass("display-none");
        if (inputTypeV == 'checkbox' || inputTypeV == 'checkbox_custom' || inputTypeV == 'radio' || inputTypeV == 'radio_custom') {
            if ($(this).prop("checked")) {
                priceV = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
                priceTypeV = typeof ($(this).find(':selected').attr('data-type')) != 'undefined' ? $(this).find(':selected').attr('data-type') : $(this).attr('data-type');
                optionIdV = typeof ($(this).find(':selected').attr('data-optionId')) != 'undefined' ? $(this).find(':selected').attr('data-optionId') : $(this).attr('data-optionId');
                changePriceV(priceV, priceTypeV, optionBoxV, optionIdV, inputTypeV);
            } else {
                reducePriceV = null;
                if ($(this).prop("checked", false)) {
                    reducePriceV = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
                }
                changePriceV(priceV, priceTypeV, optionBoxV, optionIdV, inputTypeV, reducePriceV);
            }
        } else {
            priceV = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
            priceTypeV = typeof ($(this).find(':selected').attr('data-type')) != 'undefined' ? $(this).find(':selected').attr('data-type') : $(this).attr('data-type');
            optionIdV = typeof ($(this).find(':selected').attr('data-optionId')) != 'undefined' ? $(this).find(':selected').attr('data-optionId') : $(this).attr('data-optionId');
            changePriceV(priceV, priceTypeV, optionBoxV, optionIdV, inputTypeV);
        }
        if ($(this).prop("checked") || $(this).find(':selected').val() != '') {
            if (!$(this).prop("checked")) {
                $('#stock_qtyV-'+optionBoxV).addClass('display-none');
            }
            if (typeof $(this).find(':selected').val() != 'undefined' || $(this).prop("checked")) {
                getStockV(typeof ($(this).find(':selected').attr('data-optionRealId')) != 'undefined' ? $(this).find(':selected').attr('data-optionRealId') : $(this).attr('data-optionRealId'), typeof ($(this).find(':selected').val()) != 'undefined' ? $(this).find(':selected').val() : $(this).val(), optionBoxV);
            }
        } else {
            $('#stock_qtyV-'+optionBoxV).addClass('display-none');
        }
    });

    function changePriceV(price, priceType, optionBox, optionId, inputType, reducePrice = null)
    {
        let getData = null;
        if (typeof price == 'undefined' && typeof amountV[optionBox] != 'undefined') {
               if (reducePrice != null) {
                   amountV[optionBox] -= reducePrice;
                   getData = multipleCalcV(".customCheckBoxV-"+optionBox, inputType);
                   amountV[optionBox] = getData['extra'];
                   tempAmount = calculateV() + mainPriceV;
                   $('#item_priceV').text(null);
                   $('#item_priceV').text(getDecimalNumberFormat(tempAmount));
               } else {
                   $('#item_priceV').text(null);
                   $('#item_priceV').text(getDecimalNumberFormat(tempAmount - amountV[optionBox]));
                   delete amountV[optionBox];
               }
        } else {
            price = parseFloat(price);
            mainPrice = parseFloat(mainPriceV);
            let extraAmount = 0;
            if (priceType == 'Percent') {
                extraAmount = (mainPrice*price)/100;
            } else {
                extraAmount = price;
            }
            if (inputType == 'checkbox_custom' || inputType == 'multiple_select' || inputType == 'radio_custom') {
                if (inputType == 'checkbox_custom' || inputType == 'radio_custom') {
                     getData = multipleCalcV(".customCheckBoxV-"+optionBox, inputType);
                } else {
                     getData = multipleCalcV("#multipleV-"+optionBox, inputType);
                }
                amountV[optionBox] = getData['extra'];
                tempAmount = calculateV() + mainPrice;
            } else {
                amountV[optionBox] = extraAmount;
                tempAmount = calculateV() + mainPrice;
            }
            $('#item_priceV').text(null);
            $('#item_priceV').text(getDecimalNumberFormat(tempAmount));
        }
    }

    function calculateV()
    {
        let total = 0;
        for (let i = 0; i < amountV.length ; i++) {
            if(typeof(amountV[i]) != "undefined") {
                total += amountV[i];
            }
        }
        return total;
    }

    function getStockV(optionRealId, optionLabel, msgId)
    {
        $.ajax({
            url: SITE_URL + "/get-stock",
            data: {
                item_option_id: optionRealId,
                option_label : optionLabel,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    if (data.is_track_inventory == 1) {
                        if (data.quantity > 0) {
                            enableAddToCartV(optionRealId);
                        } else {
                            disableAddToCart();
                        }
                        let txt = '';
                        if (data.is_hide_stock == '0') {
                            txt = jsLang('Stock left')+": " + getDecimalNumberFormat(data.quantity);
                        }
                        $('#stock_qtyV-'+msgId).removeClass('display-none');
                        $('#stock_qtyV-'+msgId).text(txt);
                    } else {
                        enableAddToCartV(optionRealId);
                    }
                } else {
                    enableAddToCartV(optionRealId);
                }
            }
        });
    }

    function enableAddToCartV(optionRealId)
    {
        let allOption = [];
        $.each($('.option_priceV'), function (i, v) {
            allOption[i] = typeof ($(this).find(':selected').attr('data-optionRealId')) != 'undefined' ? $(this).find(':selected').attr('data-optionRealId') : $(this).attr('data-optionRealId');
        });
        if (!jQuery.inArray(optionRealId, allOption)) {
            $('#item-add-to-cartV').addClass("add-to-cart");
            $('#item-add-to-cartV').removeClass("disable_a_href");
        }
    }

    function multipleCalcV(identify, type)
    {
        let cntPrice = 0, exAm = 0, dtPrice, dtPriceType;
        if (type == 'multiple_select') {
            dtPrice = multipleSelectPrice
            dtPriceType = multipleSelectPriceType
        } else {
            let checkPrice = [];
            let checkPriceType = [];
            $(identify+':checkbox:checked').each(function(i) {
                checkPrice[i] = $(this).attr('data-price');
                checkPriceType[i] = $(this).attr('data-type');
            });
             dtPrice = checkPrice;
             dtPriceType = checkPriceType;
        }

        $.each(dtPrice, function (i, v) {
            if (dtPriceType[i] == 'Percent') {
                exAm += (mainPriceV*parseFloat(v))/100;
            } else {
                exAm += parseFloat(v);
            }
            cntPrice += mainPriceV;
        })
        return {
            'total' : cntPrice,
            'extra' : exAm
        }
    }

    $(".singleCheckBoxV").on('click', function() {
        let selectedOptionId = $(this).attr('data-optionId');
        let selectedOption = $(this).attr('data-option');
        $(".multiChkV-"+selectedOption).each(function () {
           if ($(this).attr('data-optionId') != selectedOptionId) {
               $(this).prop("checked", false);
           }
        });
    });


    setTimeout(() => {
        $('.product-thumbs').css("opacity","1")
    }, 5);
    $(document).on('mousemove','.zoom', function(e){
        console.log(e)
        var offsetX,offsetY,x,y;
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = offsetX/zoomer.offsetWidth*100
        y = offsetY/zoomer.offsetHeight*100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
      });

    if($(".product-left").length){
        var productSlider = new Swiper('.product-slider', {
            spaceBetween: 0,
            centeredSlides: true,
            loop:true,
            direction: 'horizontal',
            loopedSlides: 6,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            resizeObserver:true,
        });
        var productThumbs = new Swiper('.product-thumbs', {
            spaceBetween: 17,
            centeredSlides: true,
            loop: true,
            slideToClickedSlide: true,
            direction: 'horizontal',
            slidesPerView: 'auto',
            loopedSlides: slideImagecount,
        });
        productSlider.controller.control = productThumbs;
        productThumbs.controller.control = productSlider;
    }

