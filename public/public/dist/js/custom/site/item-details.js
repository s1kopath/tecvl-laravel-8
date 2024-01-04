"use strict";
if ($('.main-body .page-wrapper').find('#item-details-container').length) {
    var ratingValue = 0;
    var mainPrice = $('#item_price').text().replace(/,/g, '');
    var optionIdentify = [];
    var amount = [];
    var count = 0;
    var tempAmount = 0;
    var multipleSelectPrice = [];
    var multipleSelectPriceType = [];
    var globalOptionBox = [];
    var lastOptionBox = null;
    var rateClickEnable = false;
    $(document).ready(function(){

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $(document).on('click', '#stars li', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (let i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (let i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            rateClickEnable = true;
        });


    });

    $(".singleCheckBox").on('click', function() {
        let selectedOptionId = $(this).attr('data-optionId');
        let selectedOption = $(this).attr('data-option');
        $(".multiChk-"+selectedOption).each(function () {
           if ($(this).attr('data-optionId') != selectedOptionId) {
               $(this).prop("checked", false);
           }
        });
    });

    $(document).on('change', '.option_price', function() {
        let price, priceType, optionId, optionBox, inputType, reducePrice;
        inputType = typeof ($(this).find(':selected').attr('data-inputType')) != 'undefined' ? $(this).find(':selected').attr('data-inputType') : $(this).attr('data-inputType');
        optionBox = typeof ($(this).find(':selected').attr('data-option')) != 'undefined' ? $(this).find(':selected').attr('data-option') : $(this).attr('data-option');
        $("#required-msg-"+optionBox).addClass("display-none");
        if (inputType == 'checkbox' || inputType == 'checkbox_custom' || inputType == 'radio' || inputType == 'radio_custom') {
            if ($(this).prop("checked")) {
                price = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
                priceType = typeof ($(this).find(':selected').attr('data-type')) != 'undefined' ? $(this).find(':selected').attr('data-type') : $(this).attr('data-type');
                optionId = typeof ($(this).find(':selected').attr('data-optionId')) != 'undefined' ? $(this).find(':selected').attr('data-optionId') : $(this).attr('data-optionId');
                changePrice(price, priceType, optionBox, optionId, inputType);
            } else {
                reducePrice = null;
                if ($(this).prop("checked", false)) {
                    reducePrice = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
                }
                changePrice(price, priceType, optionBox, optionId, inputType, reducePrice);
            }
        } else {
            price = typeof ($(this).find(':selected').attr('data-price')) != 'undefined' ? $(this).find(':selected').attr('data-price') : $(this).attr('data-price');
            priceType = typeof ($(this).find(':selected').attr('data-type')) != 'undefined' ? $(this).find(':selected').attr('data-type') : $(this).attr('data-type');
            optionId = typeof ($(this).find(':selected').attr('data-optionId')) != 'undefined' ? $(this).find(':selected').attr('data-optionId') : $(this).attr('data-optionId');
            changePrice(price, priceType, optionBox, optionId, inputType);
        }
        if ($(this).prop("checked") || $(this).find(':selected').val() != '') {
            if (!$(this).prop("checked")) {
                $('#stock_qty-'+optionBox).addClass('display-none');
            }
            if (typeof $(this).find(':selected').val() != 'undefined' || $(this).prop("checked")) {
                getStock(typeof ($(this).find(':selected').attr('data-optionRealId')) != 'undefined' ? $(this).find(':selected').attr('data-optionRealId') : $(this).attr('data-optionRealId'), typeof ($(this).find(':selected').val()) != 'undefined' ? $(this).find(':selected').val() : $(this).val(), optionBox);
            }
        } else {
            $('#stock_qty-'+optionBox).addClass('display-none');
        }
    });

    function getStock(optionRealId, optionLabel, msgId)
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
                            enableAddToCart(optionRealId);
                        } else {
                            disableAddToCart();
                        }
                        let txt = '';
                        if (data.is_hide_stock == '0') {
                            txt = jsLang('Stock left')+": " + getDecimalNumberFormat(data.quantity);
                        }
                        $('#stock_qty-'+msgId).removeClass('display-none');
                        $('#stock_qty-'+msgId).text(txt);
                    } else {
                        enableAddToCart(optionRealId);
                    }
                } else {
                    enableAddToCart(optionRealId);
                }
            }
        });
    }

    function enableAddToCart(optionRealId)
    {
        let allOption = [];
        $.each($('.option_price'), function (i, v) {
            allOption[i] = typeof ($(this).find(':selected').attr('data-optionRealId')) != 'undefined' ? $(this).find(':selected').attr('data-optionRealId') : $(this).attr('data-optionRealId');
        });
        if (!jQuery.inArray(optionRealId, allOption)) {
            $('#item-add-to-cart').addClass("add-to-cart");
            $('#item-add-to-cart').removeClass("disable_a_href");
        }
    }

    function disableAddToCart()
    {
        $('#item-add-to-cart').removeClass("add-to-cart");
        $('#item-add-to-cart').addClass("disable_a_href");
    }

    function changePrice(price, priceType, optionBox, optionId, inputType, reducePrice = null)
    {
        let getData = null;
        if (typeof price == 'undefined' && typeof amount[optionBox] != 'undefined') {
               if (reducePrice != null) {
                   amount[optionBox] -= reducePrice;
                   getData = multipleCalc(".customCheckBox-"+optionBox, inputType);
                   amount[optionBox] = getData['extra'];
                   tempAmount = calculate() + mainPrice;
                   $('#item_price').text(null);
                   $('#item_price').text(getDecimalNumberFormat(tempAmount));
               } else {
                   $('#item_price').text(null);
                   $('#item_price').text(getDecimalNumberFormat(tempAmount - amount[optionBox]));
                   delete amount[optionBox];
               }
        } else {
            price = parseFloat(price);
            mainPrice = parseFloat(mainPrice);
            let extraAmount = 0;
            if (priceType == 'Percent') {
                extraAmount = (mainPrice*price)/100;
            } else {
                extraAmount = price;
            }
            if (inputType == 'checkbox_custom' || inputType == 'multiple_select' || inputType == 'radio_custom') {
                if (inputType == 'checkbox_custom' || inputType == 'radio_custom') {
                     getData = multipleCalc(".customCheckBox-"+optionBox, inputType);
                } else {
                     getData = multipleCalc("#multiple-"+optionBox, inputType);
                }
                amount[optionBox] = getData['extra'];
                tempAmount = calculate() + mainPrice;
            } else {
                amount[optionBox] = extraAmount;
                tempAmount = calculate() + mainPrice;
            }
            $('#item_price').text(null);
            $('#item_price').text(getDecimalNumberFormat(tempAmount));
        }
    }

    function multipleCalc(identify, type)
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
                exAm += (mainPrice*parseFloat(v))/100;
            } else {
                exAm += parseFloat(v);
            }
            cntPrice += mainPrice;
        })
        return {
            'total' : cntPrice,
            'extra' : exAm
        }
    }

    function calculate()
    {
        let total = 0;
        for (let i = 0; i < amount.length ; i++) {
            if(typeof(amount[i]) != "undefined") {
                total += amount[i];
            }
        }
        return total;
    }

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


    $(document).on('click', '.image-thumbnail', function() {
        var src = $(this).data('src');

        $('.preview-image img').attr('src', src);
        $('.preview-body').show();
        $('.preview-body').animate({opacity: '1'}, "slow");

    })

    $(document).on('click', '.preview-image span', function() {
        $('.preview-body').animate({opacity: '0'}, "slow");
        setTimeout(() => {
            $('.preview-body').hide();
        }, 1000);
    })

    // select multiple dropdown
    let mulInc = 0;
    $('.multiple_select').each(function () {
        let multiId = $(this).attr('id');
        window.dropdown = function () {
            return {
                options: [],
                selected: [],
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index, event) {

                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    let i = 0,box;
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);
                    multipleSelectPrice.splice(index, 1);
                    multipleSelectPriceType.splice(index, 1);
                    box = multipleSelectPrice.length == 1 ? globalOptionBox[0] : null;
                    box != null ? lastOptionBox = box : '';
                    globalOptionBox.splice(index, 1);
                    multipleSelectPrice.length == 0 ? changePrice(null, null, lastOptionBox, null, "multiple_select") : null;

                },
                loadOptions() {
                    const options = document.getElementById(multiId).options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                        value: options[i].value,
                        text: options[i].innerText,
                        price: options[i].getAttribute('data-price'),
                        inputType: options[i].getAttribute('data-inputType'),
                        optionBox: options[i].getAttribute('data-option'),
                        priceType: options[i].getAttribute('data-type'),
                        optionId: options[i].getAttribute('data-optionId'),
                        selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                    });
                }


                },
                selectedValues() {
                    let i = 0;
                    return this.selected.map((option) => {
                        multipleSelectPrice[i] = this.options[option].price;
                        multipleSelectPriceType[i] = this.options[option].priceType;
                        globalOptionBox[i] = this.options[option].optionBox;
                        changePrice(this.options[option].price, this.options[option].priceType, this.options[option].optionBox, this.options[option].optionId, this.options[option].inputType);
                        i++;
                        return this.options[option].value;
                    })
                }
            }
        }
    });

    var gImgObj = [];
    var j = 0, k = 0, deletedFiles = [];
    $(document).on("change", "#image", function(e) {
        if(!validate()) {
            $('#message').show(200)
            $('#message').html('<span class="font-bold text-red-600">' + jsLang('Please upload valid images') + '</span>');
            $('#image').val('');
            $('.error').remove()
            return 0;

        } else if(validate() == 2) {
            $('#message').show(200)
            $('#message').html('<span class="font-bold text-red-600">' + jsLang('Maximum file size 2MB') + '</span>');
            $('#image').val('');
            $('.error').remove();
            return 0;
        } else {
            $('#message').hide(200)
        }
        $('.error').remove();
        var files = e.target.files, filesLength = files.length;

        for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            gImgObj[k++] = f.name;
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                $('#imgs').append(`
                    <div class="pip error">
                        <div class="relative inline-block">
                            <img class="imageThumb object-cover h-24 w-24 border-2" src="${e.target.result}"/>
                            <span data-id="${j++}" class="removes absolute rounded-full bg-red-200 px-2 cursor-pointer -top-3 -right-3 text-bold text-red-700">x</span>
                        </div>
                    </div>
                `);
            });
            fileReader.readAsDataURL(f);
        }
    });

    $(document).on("click", ".removes", function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                var pid = $(this).data('id');
                $(this).closest(".pip").remove();
                if (typeof pid !== "undefined") {
                    deletedFiles.push(gImgObj[pid]);
                    $('#deleted-files').val(deletedFiles);
                }
            }
          })

    });


    $('#view-more').css("background", "linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 65%, rgba(255,255,255,0) 100%)")
    $('#view-more span').click(function () {
        if ($('.item-full-details').find('.add').length) {
            $('.item-full-details').addClass('h-full');
            $('.item-full-details').removeClass('h-96');
            $('#view-more').addClass('remove');
            $('#view-more svg').addClass('rotated-view');
            $('#view-more').removeClass('add');
            $('#view-more span').text(jsLang('See Less'))
        } else {
            $("#item-details-section")[0].scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
            $('.item-full-details').removeClass('h-full');
            $('.item-full-details').addClass('h-96');
            $('#view-more').removeClass('remove');
            $('#view-more svg').removeClass('rotated-view');
            $('#view-more').addClass('add');
            $('#view-more span').text(jsLang('See More'))
            setTimeout(() => {
                $(document).scrollTop($(document).scrollTop()-100);
            }, 1000);
        }
    })

    $('#view-more-policy').css("background", "linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 65%, rgba(255,255,255,0) 100%)")
    $('#view-more-policy span').click(function () {
        if ($('.policy-full-details').find('.add').length) {
            $('.policy-full-details').addClass('h-full');
            $('.policy-full-details').removeClass('h-40');
            $('#view-more-policy').addClass('remove');
            $('#view-more-policy').removeClass('add');
            $('#view-more-policy span').text(jsLang('See Less'))
        } else {
            $("#policy-details-section")[0].scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
            $('.policy-full-details').removeClass('h-full');
            $('.policy-full-details').addClass('h-40');
            $('#view-more-policy').removeClass('remove');
            $('#view-more-policy').addClass('add');
            $('#view-more-policy span').text(jsLang('See More'))
            setTimeout(() => {
                $(document).scrollTop($(document).scrollTop()-100);
            }, 1000);
        }
    })

    $('.rating-width').each((index, item) => {
        $(item).css('width', $(item).data('width') + "%");
    });

    $('span span.text-gray-500').css('background', '#eee');
    $(document).on('click', 'span a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    function fetch_data(page)
    {
        var _token = token;
        var url = reviewUrl;
        var item_id = itemId;
        $.ajax({
            url:url,
            method:"POST",
            data:{_token:_token, page:page, item_id:item_id},
            success:function(data)
            {
                $('#load_review').html(data);
                $('span span.text-gray-500').css('background', '#eee');
            }
        });
        return 1;
    }

    function validate() {

        var uploadImg = document.getElementById('image');
        //uploadImg.files: FileList
        for (var i = 0; i < uploadImg.files.length; i++) {
           var f = uploadImg.files[i];
            if (!allowExtension.includes(f.name.split('.').pop())) {
                return false
            }
            if (f.size > 2048000) {
                return 2;
            }
        }
        return true;
    }

    $("#reviewFrom").on('submit', function(event) {
        event.preventDefault();
        let rate = ratingValue;
        if (rate == 0) {
            $('#message').show(500).html('<span class="font-bold text-red-600">' + jsLang('Rating field is required') + '</span>');
        } else if ($('#imgs').find('.pip').length > 15) {
            $('#message').show(200)
            $('#message').html('<span class="font-bold text-red-600">' + jsLang('You can only upload a maximum of 15 files.') + '</span>');
            return 0;
        } else {
            let comments = $('#comments').val();
            let itemId = $('#item_id').val();
            var formData = new FormData(this)
            formData.append('rating', rate);
            formData.append('comments', comments);
            formData.append('item_id', itemId);
            $.ajax({
                url: SITE_URL + "/user/review-store",
                type: 'POST',
                dataType: 'JSON',
                data:  formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    if (data.status == 1) {
                        setTimeout(() => {
                            $('.review-store-section').hide(500);
                            fetch_data(1);
                        }, 3000);

                        $('#imgs').html('');
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-green-600">' + jsLang(data.message) + '</span>');
                        $('#comments').val(null);
                        $(".star").removeClass("selected");
                        deletedFiles = [];
                        gImgObj = [];
                        j = 0;
                        k = 0;
                    } else {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang(data.message) + '</span>');
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.status == 401) {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang('To give a review, you need to login first.') + '</span>');
                    } else {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang(thrownError) + '</span>');
                    }
                }
            });
        }
        setTimeout(() => {
            $('#message').hide(500)
        }, 5000);

    });

    var ratingUpdate = null;
    $(document).on('click', '#stars li', function(){
        ratingUpdate = true;
    });

    $(document).on('submit', '#reviewUpdateFrom', function (e) {
        e.preventDefault();
        if ($('#imgs').find('.pip').length > 15) {
            $('#message').show(200)
            $('#message').html('<span class="font-bold text-red-600">' + jsLang('You can only upload a maximum of 15 files.') + '</span>');
            return 0;
        } else {
            var formData = new FormData(this)

            if (ratingUpdate) {
                formData.append('rating', ratingValue);
            }
            console.log(formData);
            $.ajax({
                url: SITE_URL + "/site/review/update",
                type: 'POST',
                dataType: 'JSON',
                data:  formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    if (data.status == 1) {
                        deletedFiles = [];
                        gImgObj = [];
                        j = 0;
                        k = 0;
                        var page_no = Number($('span.relative.inline-flex.items-center.px-4.py-2.-ml-px').text())

                        if (fetch_data(1000)) {
                            fetch_data(page_no);
                        }

                        $('#imgs').hide();
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-green-600">' + jsLang(data.message) + '</span>');
                        setTimeout(() => {fetch_data($('span.relative.inline-flex.items-center.px-4.py-2.-ml-px').text());
                            $('#message').hide();
                            $('#imgs').show();
                        }, 2500);
                    } else {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang(data.message) + '</span>');

                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.status == 401) {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang('To give a review, you need to login first.') + '</span>');
                    } else {
                        $('#message').show(200)
                        $('#message').html('<span class="font-bold text-red-600">' + jsLang(thrownError) + '</span>');
                    }
                }
            });
        }
    });

    $(document).on('click', '.remove-review-image', function() {
        var file = $(this).data('path');
        var image = $(this);
        var key = $(this).data('key');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: SITE_URL + "/site/review/destroy",
                    data: {path: file, _token:token},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        image.closest('.pip').hide();
                        $('body #review-image-'+key).hide();
                    }
                });
            }
          })
    })

    $(document).on('click', '.filter', function() {
        var star = $(this).data('star');
        var item_id = $(this).data('item');
        $('.filter').children().removeClass('text-green-500')
        $('.filter span.text-md').addClass('ml-3');
        $('.filter span.text-md').text('');
        $(this).prepend(
            `<span class="text-green-500 -mr-3 text-md">✓</span>`
        )
        $(this).children().addClass('text-green-500')
        $.ajax({
            url: SITE_URL + "/site/review/filter",
            data: {rating: star, itemId: item_id, _token: token},
            type: 'POST',
            success: function (data) {
                $('#load_review').html(data);
            }
        });
    });

    $('#rating').click(function() {
        $("#load_review")[0].scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
    })



}

//* description-review tab
function Tabs(options){

	var tabs = document.querySelector(options.el);
	var initCalled = false;
	var tabNavigation = tabs.querySelector(".c-tabs-nav");
	var tabNavigationLinks = tabs.querySelectorAll(".c-tabs-nav__link");
	var tabContentContainers = tabs.querySelectorAll(".c-tab");

	var marker = options.marker ? createNavMarker() : false;

	var activeIndex = 0;

  function init(){
		if (!initCalled){
			initCalled = true;

			for (var i = 0; i < tabNavigationLinks.length; i++){
    			var link = tabNavigationLinks[i];
    			clickHandlerSetup(link, i)
    		}

    		if (marker){
    			setMarker(tabNavigationLinks[activeIndex]);
    		}
		}
	}

	function clickHandlerSetup(link, index){
    	link.addEventListener("click", function(e){
    		e.preventDefault();
    		goToTab(index);
    	})
    }

    function goToTab(index){
    	if (index >= 0 && index != activeIndex && index <= tabNavigationLinks.length){
    		tabNavigationLinks[activeIndex].classList.remove('is-active');
    		tabNavigationLinks[index].classList.add('is-active');

    		tabContentContainers[activeIndex].classList.remove('is-active');
    		tabContentContainers[index].classList.add('is-active');

    		if (marker){
    			setMarker(tabNavigationLinks[index]);
    		}

    		activeIndex = index;
    	}
    }

    function createNavMarker(){
    	var marker = document.createElement("div");
    	marker.classList.add("c-tab-nav-marker");
    	tabNavigation.appendChild(marker);
    	return marker;
    }

    function setMarker(element){
        marker.style.left = element.offsetLeft +"px";
        marker.style.width = element.offsetWidth + "px";
        }

        return {
            init: init,
            goToTab: goToTab
        }
}


    var m = new Tabs({
        el: "#tabs",
        marker: true
    });

    m.init();

// *product slider*
setTimeout(() => {
    $('.product-thumbs').css("opacity","1")
}, 5);

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
        loopedSlides: slideCounts,
    });
    productSlider.controller.control = productThumbs;
    productThumbs.controller.control = productSlider;
}

$( ".zoom" ).mousemove(function( e ) {
    var offsetX,offsetY,x,y;
    var zoomer = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX/zoomer.offsetWidth*100
    y = offsetY/zoomer.offsetHeight*100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
  });

$('a.review').click(function() {
    $('a').removeClass('is-acive');
    $(this).addClass('is-active');
    $('div.c-tab').removeClass('is-active');
    $('div.c-tab.review').addClass('is-active');
    $(document).scrollTop($("#item-details-section").offset().top - 100);
})
if ("{!! request('reviewRequired') !== null ? true : false !!}") {
    $('a.review').trigger('click');
}

/* when modal is opened */
document.querySelector("#review-open-modal-btn").addEventListener('click', function() {
    document.querySelector("body").style.overflow = 'hidden';
});

/* when modal is closed */
$('.review-close-modal-btn').click(function() {
    $('body').css('overflow', 'visible');
})

