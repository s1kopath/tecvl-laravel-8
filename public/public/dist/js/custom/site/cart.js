"use strict";
var options = [];
var optionNoLabelId = [];
var optionNoLabel = [];
var qty = 1;
var cartIndex = null;
var couponOffer = $('#couponOffer').text().replace(/,/g, '');
var couponDiscountType = $('#couponDiscountType').val();
var couponDiscouintAmount = $('#couponDiscountAmount').val();
emptyCart();


$(document).on('click', '.add-to-cart', function() {
    optionNoLabelId = [];
    optionNoLabel = [];
    cartIndex = null;
    let itemId = $(this).attr('data-itemId');
     options = $('input[name="option[]"]:checked').map(function(){return $(this).val();}).get().length > 0 ? $('input[name="option[]"]:checked').map(function(){return $(this).val();}).get() : [];
        $('select[name="option[]"] option:selected').each(function() {
            $(this).val() != '' ? options.push($(this).val()) : '';
        });
    $('input[type="radio"]:checked').each(function() {
        $(this).val() != '' ? options.push($(this).val()) : '';
    });
    $('input[name="optionNoLabel[]"]').each(function() {
        $(this).val() != '' ? optionNoLabel.push($(this).val()) : '';
        $(this).val() != '' ? optionNoLabelId.push($(this).attr('data-optionRealId')) : '';
    });
    let hours = $('select[name="hours"] option:selected').val();
    if (typeof hours != 'undefined') {
        let time = '';
        let minutes = typeof $('select[name="minutes"] option:selected').val() != 'undefined' ? $('select[name="minutes"] option:selected').val() : 0;
        let ampm = typeof $('select[name="ampm"] option:selected').val() != 'undefined' ? $('select[name="ampm"] option:selected').val() : "am";
        time = hours+":"+minutes+" "+ampm;
         optionNoLabel.push(time);
         optionNoLabelId.push($('select[name="hours"]').attr('data-optionRealId'));
    }
    let allOptionRequired = true;
    let dupOptionBox = [];
    let cnt = 0;
    $(".option_price").each(function() {
        let  optionBox, inputType;
        optionBox = typeof ($(this).find(':selected').attr('data-option')) != 'undefined' ? $(this).find(':selected').attr('data-option') : $(this).attr('data-option');
        inputType = typeof ($(this).find(':selected').attr('data-inputType')) != 'undefined' ? $(this).find(':selected').attr('data-inputType') : $(this).attr('data-inputType');
        if ($(this).hasClass("required-option")) {
            if (allOptionRequired == true) {
                if (inputType == 'checkbox' && jQuery.inArray(optionBox, dupOptionBox) == -1) {
                    allOptionRequired = false;
                    $(".multiChk-"+optionBox).each(function () {
                        if($(this).is(':checked')) {
                            jQuery.inArray(optionBox, dupOptionBox) == -1 ? dupOptionBox[cnt++] = optionBox : null ;
                            allOptionRequired = true;
                            return false;
                        }
                    });
                    if (allOptionRequired == false) {
                        $("#required-msg-"+optionBox).removeClass("display-none");
                        return false;
                    }

                } else {
                    if($(this).val() != '') {
                        allOptionRequired = true;
                    } else {
                        allOptionRequired = false;
                        $("#required-msg-"+optionBox).removeClass("display-none");
                        return false;
                    }
                }
            }
        }
    });
    $(".option_priceV").each(function() {
        let  optionBox, inputType;
        optionBox = typeof ($(this).find(':selected').attr('data-option')) != 'undefined' ? $(this).find(':selected').attr('data-option') : $(this).attr('data-option');
        inputType = typeof ($(this).find(':selected').attr('data-inputType')) != 'undefined' ? $(this).find(':selected').attr('data-inputType') : $(this).attr('data-inputType');
        if ($(this).hasClass("required-optionV")) {
            if (allOptionRequired == true) {
                if (inputType == 'checkbox' && jQuery.inArray(optionBox, dupOptionBox) == -1) {
                    allOptionRequired = false;
                    $(".multiChkV-"+optionBox).each(function () {
                        if($(this).is(':checked')) {
                            jQuery.inArray(optionBox, dupOptionBox) == -1 ? dupOptionBox[cnt++] = optionBox : null ;
                            allOptionRequired = true;
                            return false;
                        }
                    });
                    if (allOptionRequired == false) {
                        $("#required-msgV-"+optionBox).removeClass("display-none");
                        return false;
                    }

                } else {
                    if($(this).val() != '') {
                        allOptionRequired = true;
                    } else {
                        allOptionRequired = false;
                        $("#required-msgV-"+optionBox).removeClass("display-none");
                        return false;
                    }
                }
            }
        }
    });
    if (allOptionRequired == true) {
        ajaxCall("/cart-store", itemId, options, true, 'add');
    }
});

function getSelectedIndex()
{
    let index = [];
    $('input[name="items[]"]:checked').each(function() {
        index.push($(this).val());
    });
    return index;
}

$(document).on('click', '#delete-selected-item', function() {
    let items = getSelectedIndex();
    if (items.length > 0) {
        ajaxCall("/cart-selected-delete", items, options, false, 'selectedRemove');
    }
})

$(document).on('click', '.delete-cart-item', function() {
    cartIndex = $(this).attr('data-index');
    ajaxCall("/cart-delete", null, options, false, 'remove');
})

$(document).on('click', '#cart_clear_all', function() {
    ajaxCall("/cart-all-delete", null, options, false, 'removeAll');
})

function deleteShopBox()
{
    $(".shop-box").each(function() {
        let hasItem = 0;
        $(".shop-box .cart-shop").each(function() {
        let shopId = $(this).attr('data-shop_id');
        let shopClass = ".cart-shop-"+shopId;
            $(shopClass).each(function() {
                hasItem++;
            });
        });
        if (hasItem == 0) {
            $(this).remove();
        }
    });
}

$(document).on('click', '.disable_a_href', function() {
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
    Toast.fire({
        icon: 'error',
        title: jsLang('Stock is not available.')
    })
})

$(document).on('click', '.cart-item-qty-inc', function() {
    let itemId = $(this).attr('data-itemId');
    qty = parseFloat($('#cart-item-details-'+itemId+' .cart-item-quantity').text()) + 1;
    $('#cart-item-details-'+itemId+' .cart-item-quantity').text(qty);
})

$(document).on('click', '.cart-item-qty-dec', function() {
    let itemId = $(this).attr('data-itemId');
    if (parseFloat($('#cart-item-details-'+itemId+' .cart-item-quantity').text()) > 1) {
        qty = parseFloat($('#cart-item-details-'+itemId+' .cart-item-quantity').text()) - 1;
        $('#cart-item-details-'+itemId+' .cart-item-quantity').text(qty);
    }
})

$("#cart-select-all").on('click', function() {
    if(this.checked) {
        document.querySelectorAll('.vendor-parent').forEach(vendor => {
            selectChildItems(vendor);
        });
    } else {
        document.querySelectorAll('.vendor-parent').forEach(vendor => {
            deselectChildItems(vendor);
        });
    }
    this.closest('#selecAllBox').classList.toggle('border-gray-12');
});

$(document).on('click', '.cart-shop', function() {
    let parent = getParentVendor(this);
    toggleChildItems(parent);

    if(allVendorChecked()) {
        $('#selecAllBox').addClass('border-gray-12');
        document.querySelector('#cart-select-all').checked = true;
    } else {
        $('#selecAllBox').removeClass('border-gray-12');
        document.querySelector('#cart-select-all').checked = false;
    }
});

$(document).on('click', '.checkOut', function() {
    if($(this).attr('href') == 'javascript:void(0)') {
        const ToastError = Swal.mixin({
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
        ToastError.fire({
            icon: 'error',
            title: jsLang('Please select an item first!')
        })
    }
});

function isShopAllChecked()
{
    let flag = true;
    $('.cart-shop').each(function() {
        if ($(this).prop("checked")) {

        } else {
            flag = false;
        }
    })

    if (flag == true) {
        $("#cart-select-all").prop('checked', true);
    } else {
        $("#cart-select-all").prop('checked', false);
    }
}

function checkingCheckbox()
{
    let totalSubPrice = 0;
    let checkOutPgeEnable = false;
    let totalTax = 0;
    let totalShipping = 0;
    $(".cart-shop").each(function() {
        let shopId = $(this).attr('data-shop_id');
        let shopClass = ".cart-shop-"+shopId;
        $(shopClass).each(function() {
            let itemPrice = parseFloat($(this).attr('data-price'));
            let itemQuantity = parseFloat($(this).attr('data-quantity'));
            let tax = parseFloat($(this).attr('data-tax'));
            let shipping = parseFloat($(this).attr('data-shipping'));
            if ($(this).prop("checked")) {
                totalSubPrice = totalSubPrice + (itemPrice * itemQuantity);
                totalTax += ((itemQuantity * itemPrice) * tax)  / 100;
                totalShipping += shipping;
                checkOutPgeEnable = true;
            }
        });
    });
    if (checkOutPgeEnable == true) {
        $(".checkOut").attr("href", SITE_URL+"/checkout");
    } else {
        $(".checkOut").attr("href", "javascript:void(0)");
    }
    totalPriceByChecked(totalSubPrice, totalTax, totalShipping);
}

$(document).on('click', '.cart-item-single', function() {
    let parent = getParentVendor(this);
    if(isAllChildChecked(parent)) {
        parent.classList.add("border-gray-12");
        parent.querySelector('.cart-shop').checked = true;

    } else {
        parent.classList.remove("border-gray-12");
        parent.querySelector('.cart-shop').checked = false;
    }

    if (!this.checked) {
        document.querySelector('#selecAllBox').classList.remove('border-gray-12')
        document.querySelector('#cart-select-all').checked = false;
    }
    updateTotalBox();

    checkingCheckbox()
});

const allVendorChecked = () => {
    let shops = document.querySelectorAll('.cart-shop');
    for (let index = 0; index < shops.length; index++) {
        const element = shops[index];
        if(!element.checked) {
            return false;
        }
    }
    return true;
}

const updateTotalBox = () => {
    if(allVendorChecked()) {
        $('#selecAllBox').addClass('border-gray-12');
        document.querySelector('#cart-select-all').checked = true;
    } else {
        $('#selecAllBox').removeClass('border-gray-12');
        document.querySelector('#cart-select-all').checked = false;
    }
}

const toggleBorder = (parent) => {
    if(parent.classList.value.includes('border-gray-12')) {
        parent.classList.remove("border-gray-12");
        parent.querySelector('.cart-shop').checked = false;
    } else {
        parent.classList.add("border-gray-12");
        parent.querySelector('.cart-shop').checked = true;
    }
}

const getParentVendor = (child) => {
    return child.closest('.vendor-parent');
}

const isAllChildChecked = (parent) => {
    let children = parent.querySelectorAll('.cart-item-single');
    for (let index = 0; index < children.length; index++) {
        let element = children[index];
        if(!element.checked) {
            return false
        }
    }
    return true;
}

const toggleChildItems = (parent) => {
    if(isAllChildChecked(parent)) {
        deselectChildItems(parent)
    } else {
        selectChildItems(parent);
    }
}

const selectChildItems = (parent) => {
    let children = parent.querySelectorAll('.cart-item-single');
    children.forEach(element => {
        element.checked = true;
    });
    parent.classList.add("border-gray-12");
    parent.querySelector('.cart-shop').checked = true;
    checkingCheckbox()
}

const deselectChildItems = (parent) => {
    let children = parent.querySelectorAll('.cart-item-single');
    children.forEach(element => {
        element.checked = false;
    });
    parent.classList.remove("border-gray-12");
    parent.querySelector('.cart-shop').checked = false;
    checkingCheckbox()
}

function isShopAllItemChecked(shopClass, index, shopId)
{
    let flag = true;
    $(shopClass).each(function() {
        if ($(this).prop("checked")) {

        } else {
            flag = false;
        }
    });
    if (flag == true) {
        $('.cart-shop').each(function() {
            if($(this).attr('data-shop_id') == shopId) {
                $(this).prop('checked', true);
            }
        })
    } else {
        $('.cart-shop').each(function() {
            if($(this).attr('data-shop_id') == shopId) {
                $(this).prop('checked', false);
            }
        })
    }
    isShopAllChecked();
}
$(document).on('click', '.cart-page-item-qty-inc', function() {
    cartIndex = $(this).attr('data-index');
    let itemId = $(this).attr('data-itemId');
    let price = $(this).attr('data-price');
    qty =  $('#cart-item-'+cartIndex+' .cart-item-quantity').text() != '' ? parseFloat($('#cart-item-'+cartIndex+' .cart-item-quantity').text()) + 1 : parseFloat($('#cart-item-header-'+cartIndex+' .cart-item-quantity-header').text()) + 1;
    ajaxCall("/cart-store", itemId, options, false,'qtyIncrement');
})

$(document).on('click', '.cart-page-item-qty-dec', function() {
    cartIndex = $(this).attr('data-index');
    let itemId = $(this).attr('data-itemId');
    let price = $(this).attr('data-price');
    let qtyPre = $('#cart-item-'+cartIndex+' .cart-item-quantity').text() != '' ? parseFloat($('#cart-item-'+cartIndex+' .cart-item-quantity').text()) : parseFloat($('#cart-item-header-'+cartIndex+' .cart-item-quantity-header').text());
    if (parseFloat(qtyPre) > 1) {
        qty =  parseFloat(qtyPre) - 1;
        ajaxCall("/cart-reduce-qty", itemId, options, false,'qtyDecrement');
    }
})


function ajaxCall(url, itemId, ItemOption, msgShow = false, action = null)
{
    $.ajax({
        url: SITE_URL + url,
        data: {
            item_id: itemId,
            options : ItemOption,
            qty : qty,
            cartIndex : cartIndex,
            optionNoLabel : optionNoLabel,
            optionNoLabelId : optionNoLabelId,
            "_token": token
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (data) {
            if (msgShow == true || data.status == 0) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-start',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                if (data.status == 1) {
                    var item = [];
                    for (const key in data.carts) {
                        if (data.carts[key].id == itemId) {
                            item = data.carts[key];
                            break;
                        }
                    }
                    Toast.fire({
                        width: 304,
                        html: `
                            <div>
                                <div class="flex">
                                    <div class="w-20 h-20 mr-3.5">
                                        <img class="h-full w-full" src="${item.photo}" alt="">
                                    </div>
                                    <div class="mt-5">
                                        <h1 class="dm-sans font-medium text-gray-12 text-base">${item.name.substring(0,15)}...</h1>
                                        <h3 class="roboto-medium font-medium text-sm text-gray-10 whitespace-nowrap">${jsLang('has been added to cart.')}</h3>
                                    </div>
                                </div>
                                <div class="flex justify-between mt-3">
                                    <a href="${SITE_URL + '/carts'}" class="text-center py-2 w-120p border border-gray-2 rounded-sm text-xs dm-bold text-gray-12 font-bold transition ease-in-out duration-200 hover:border-gray-12 hover:text-gray-12">${jsLang('View Cart')}</a>
                                    <a href="${SITE_URL + '/checkout?select=all'}" class="text-center py-2 w-120p border border-gray-2 rounded-sm text-xs dm-bold text-white font-bold bg-gray-12 hover:bg-yellow-1 hover:text-gray-12">${jsLang('Checkout')}</a>
                                </div>
                            </div>
                        `,
                    });
                    updateCart(data.totalItem, data.totalPrice, data.carts, itemId, action)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: jsLang(data.message)
                    })
                }
            } else {
                if (data.status == 1) {
                    updateCart(data.totalItem, data.totalPrice, data.carts, itemId, action)
                }
            }
        }
    });
}


function updateCart(totalItem, totalPrice, carts = [], itemId = null, action = null)
{
    let qty;
    let cartHeader = '';
    $('#totalCartItem').text(totalItem);
    $('#totalCartitemPage').text(totalItem);
    if (action == 'add') {
        cartHeader += `<div class="w-full px-30p scrollbar-w-2 hidden md:block z-50 overflow-auto h-screen pb-40 mt-10p" id="cart-header">`;
        $.each(carts, function (index, value) {
            let optionNames = null;
            let options = null;
            let optionHtml = '';

            cartHeader += `
            <div class="flex cursor-pointer border-gray-100 cart-item-header mt-5" id="cart-item-header-${index}">
                <div class="h-72p w-24 border border-gray-2 rounded">
                    <img class="h-full w-full p-0.5" src="${value['photo']}" alt="img product">
                </div>
                <div class="flex flex-col justify-center text-sm w-64 ml-5">
                    <a href="${ SITE_URL+'/items/'+value['item_code']+"/"+encodeURI(value['name']).replace(/%20/g, "+").replace(/\\|\//g,'+') }"><div class="dm-sans font-medium text-gray-12 text-18 pb-2">${value['name'].substring(0, 16)+'...'}</div></a>
                    ${optionHtml}
                    <div class="cart-item-quantity roboto-medium font-medium text-gray-10 text-base leading-5">${value['quantity']} × ${getDecimalNumberFormat(value['price'])}</div>

                </div>
                <div class="flex flex-col w-18 font-medium justify-center ml-10">
                    <a href="${`javascript:void(0)`}" class="w-4 h-4 rounded-full cursor-pointer text-red-700 delete-cart-item" data-index="${index}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9897 0.455612C11.3822 -0.151871 10.3973 -0.151871 9.78981 0.455612L0.45648 9.78895C-0.151003 10.3964 -0.151003 11.3814 0.45648 11.9888C1.06396 12.5963 2.04889 12.5963 2.65637 11.9888L11.9897 2.6555C12.5972 2.04802 12.5972 1.06309 11.9897 0.455612Z" fill="#898989"/>
                        </svg>
                    </a>
                </div>
            </div>
          `;
        });

        cartHeader += `
             <div class="absolute justify-center bg-white flex flex-col inset-x-0 px-30p mt-30p bottom-5">
                    <div class="border-t border-gray-2">
                        <div class="pt-4 pb-30p flex justify-between dm-sans font-medium text-gray-12 text-22">
                            <p class="">${jsLang('Subtotal')}:</p>
                            <p id="cart-item-total-price">${decimalNumberFormatWithCurrency(totalPrice)}</p>
                       </div>
                    </div>

                    <div id="view-cart-display" class="bg-white text-gray-12 border border-gray-2 p-2 w-full rounded mb-10p">
                        <a href="${SITE_URL+"/carts"}" class="flex justify-center px-4 py-2 rounded font-bold cursor-pointer dm-bold text-18">
                        ${jsLang('View Cart')}
                        </a>
                   </div>

                   <div id="checkout-display" class="bg-gray-12 text-white p-2 w-full rounded">
                        <a  href="${SITE_URL+"/checkout?select=all"}" class="flex justify-center px-4 py-2  font-bold cursor-pointer dm-bold text-18">
                            ${jsLang('Go to Checkout')}
                        </a>
                   </div>

                   <div class="text-gray-10 mt-5"
                   aria-label="Clear All" id="cart_clear_all">
                     <div id="clear-all-display" class="flex justify-center items-center cursor-pointer">
                           <p class="mr-2 dm-sans font-medium text-gray-10">${jsLang('Clear All')}
                               </p>
                               <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83333 11.6667C5.3731 11.6667 5 11.2937 5 10.8334L5 8.33341C5 7.87318 5.3731 7.50008 5.83333 7.50008C6.29357 7.50008 6.66667 7.87318 6.66667 8.33341L6.66667 10.8334C6.66667 11.2937 6.29357 11.6667 5.83333 11.6667Z" fill="#898989"/>
                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M9.16732 11.6667C8.70708 11.6667 8.33398 11.2937 8.33398 10.8334L8.33398 8.33341C8.33398 7.87318 8.70708 7.50008 9.16732 7.50008C9.62755 7.50008 10.0007 7.87318 10.0007 8.33341L10.0007 10.8334C10.0007 11.2937 9.62756 11.6667 9.16732 11.6667Z" fill="#898989"/>
                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M0.8552 5.01385C0.657717 5.00037 0.399686 4.99992 0 4.99992V3.33325C0.00891358 3.33325 0.0177978 3.33325 0.0266526 3.33325C0.0445462 3.33325 0.0623196 3.33325 0.0799725 3.33325H14.92C14.9377 3.33325 14.9555 3.33325 14.9733 3.33325L15 3.33325V4.99992C14.6003 4.99992 14.3423 5.00037 14.1448 5.01385C13.9548 5.02681 13.8824 5.04899 13.8478 5.06335C13.6436 5.14793 13.4813 5.31016 13.3968 5.51435C13.3824 5.54903 13.3602 5.62139 13.3473 5.81139C13.3338 6.00887 13.3333 6.2669 13.3333 6.66659L13.3333 11.7214C13.3334 12.4602 13.3334 13.0967 13.2649 13.6064C13.1914 14.1527 13.0258 14.6763 12.6011 15.101C12.1764 15.5257 11.6528 15.6914 11.1065 15.7648C10.5968 15.8333 9.96027 15.8333 9.22153 15.8333H5.77847C5.03973 15.8333 4.40322 15.8333 3.89351 15.7648C3.34724 15.6914 2.82362 15.5257 2.3989 15.101C1.97418 14.6763 1.80856 14.1527 1.73512 13.6064C1.66659 13.0967 1.66662 12.4602 1.66666 11.7214L1.66667 6.66659C1.66667 6.2669 1.66622 6.00887 1.65274 5.81139C1.63978 5.62139 1.6176 5.54903 1.60323 5.51435C1.51865 5.31016 1.35643 5.14793 1.15224 5.06335C1.11756 5.04899 1.0452 5.02681 0.8552 5.01385ZM11.8107 4.99992H3.18933C3.26749 5.23126 3.29962 5.46462 3.31554 5.69793C3.33335 5.95898 3.33334 6.27439 3.33333 6.63993L3.33333 11.6666C3.33333 12.4758 3.3351 12.9989 3.38692 13.3843C3.43552 13.7458 3.51397 13.8591 3.57741 13.9225C3.64085 13.9859 3.75414 14.0644 4.11559 14.113C4.50101 14.1648 5.0241 14.1666 5.83333 14.1666H9.16667C9.9759 14.1666 10.499 14.1648 10.8844 14.113C11.2459 14.0644 11.3592 13.9859 11.4226 13.9225C11.486 13.8591 11.5645 13.7458 11.6131 13.3843C11.6649 12.9989 11.6667 12.4758 11.6667 11.6666V6.63993C11.6667 6.27439 11.6666 5.95898 11.6845 5.69793C11.7004 5.46462 11.7325 5.23126 11.8107 4.99992Z" fill="#898989"/>
                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M8.67175 0.101025C8.31844 0.0332505 7.90785 0 7.50015 0C7.09245 4.96705e-08 6.68185 0.0332505 6.32855 0.101025C6.15192 0.134907 5.979 0.179406 5.82234 0.238021C5.68005 0.291261 5.48597 0.37965 5.32178 0.532849C4.98526 0.84682 4.96699 1.37414 5.28096 1.71065C5.57723 2.0282 6.06348 2.06237 6.40011 1.8014C6.40204 1.80065 6.40412 1.79985 6.40639 1.799C6.45085 1.78237 6.52809 1.7598 6.64254 1.73785C6.87139 1.69395 7.17407 1.66667 7.50015 1.66667C7.82623 1.66667 8.12891 1.69395 8.35775 1.73785C8.4722 1.7598 8.54944 1.78237 8.59391 1.799C8.59617 1.79985 8.59826 1.80065 8.60018 1.8014C8.93681 2.06237 9.42306 2.0282 9.71933 1.71065C10.0333 1.37414 10.015 0.846819 9.67852 0.532848C9.51432 0.37965 9.32025 0.29126 9.17795 0.23802C9.02129 0.179405 8.84837 0.134907 8.67175 0.101025Z" fill="#898989"/>
                           </svg>
                      </div>
                   </div>
            </div>
        `;
        cartHeader += `</div>`;

        $('#cart-header').replaceWith(cartHeader);
    }
    if (action == 'remove') {
        $('#cart-item-'+cartIndex).remove();
        $('#cart-item-header-'+cartIndex).remove();
        if (carts.length == 0) {
            $('#cart-items').append(`<h3 class="text-xl mt-4 font-bold dark:text-gray-2 text-center" class="cart-empty">${jsLang('Empty!')}</h3>`);
            $('#checkOut').hide();
            $('#selecAllBox').hide();
        }
        totalPriceUpdate(totalPrice);
        checkingCheckbox();
        deleteShopBox();
    }
    if (action == 'selectedRemove') {
        $.each(itemId, function (i, v){
            $('#cart-item-'+v).remove();
            $('#cart-item-header-'+v).remove();
        });
        if (carts.length == 0) {
            $('#cart-items').append(`<h3 class="text-xl mt-4 font-bold dark:text-gray-2 text-center" class="cart-empty">${jsLang('Empty!')}</h3>`);
            $('#checkOut').hide();
            $('#selecAllBox').hide();
        }
        totalPriceUpdate(totalPrice);
        checkingCheckbox();
        deleteShopBox();

    }
    if (action == 'qtyIncrement') {
        qty = $('#cart-item-'+cartIndex+' .cart-item-quantity').text() != '' ? parseFloat($('#cart-item-'+cartIndex+' .cart-item-quantity').text()) + 1 : parseFloat($('#cart-item-header-'+cartIndex+' .cart-item-quantity-header').text()) + 1;
        quantityPriceUpdate(qty, parseFloat(carts[cartIndex]['price']), totalPrice, parseFloat(carts[cartIndex]['discount_amount']), carts[cartIndex]['discount_type'], carts[cartIndex]['actual_price']);
    }
    if (action == 'qtyDecrement') {
        qty = $('#cart-item-'+cartIndex+' .cart-item-quantity').text() != '' ? parseFloat($('#cart-item-'+cartIndex+' .cart-item-quantity').text()) - 1 : parseFloat($('#cart-item-header-'+cartIndex+' .cart-item-quantity-header').text()) - 1;
        quantityPriceUpdate(qty, parseFloat(carts[cartIndex]['price']), totalPrice, parseFloat(carts[cartIndex]['discount_amount']), carts[cartIndex]['discount_type'], carts[cartIndex]['actual_price']);
    }

    if (action == 'removeAll') {
        $('.cart-item-header').remove();
        if (carts.length == 0) {
            $('#cart-items').append(`<h3 class="text-xl mt-4 font-bold dark:text-gray-2 text-center" class="cart-empty">${jsLang('Empty!')}</h3>`);
            $('#checkOut').hide();
            $('#selecAllBox').hide();
        }
        totalPriceUpdate(totalPrice);
        checkingCheckbox();
        deleteShopBox();
    }
    emptyCart();
}

function quantityPriceUpdate(qty, price, totalPrice, discountAmount, discountType, actualPrice)
{
    $('#cart-item-'+cartIndex+' .cart-item-quantity').text(qty);
    $('#cart-item-'+cartIndex+' .cart-item-quantity').text(qty);

    $('#cart-item-'+cartIndex+' .cart-item-single').removeAttr("data-quantity");
    $('#cart-item-'+cartIndex+' .cart-item-single').attr("data-quantity", qty);

    discountType != "Percent" ? $('#discount-amount-'+cartIndex).text(getDecimalNumberFormat(discountAmount * qty)) : '';

    $('#cart-item-header-'+cartIndex+' .cart-item-quantity').text(qty+ " × "+getDecimalNumberFormat(price));
    $('#cart-item-header-'+cartIndex+' .cart-item-quantity-header').text(qty);
    $('#cart-item-header-'+cartIndex+' .cart-item-price').text(getDecimalNumberFormat(price * qty));
    totalPriceUpdate(totalPrice);
    checkingCheckbox();
}

function totalPriceUpdate(totalPrice)
{
    $('#cart-item-total-price').text(decimalNumberFormatWithCurrency(totalPrice));
}

function totalPriceByChecked(totalPrice, totalTax = 0, totalShipping = 0)
{
    couponOffer = 0;
    $('#couponOffer').text(getDecimalNumberFormat(couponOffer));
    $('#cart-subtotal').text(getDecimalNumberFormat(totalPrice));
    $('#tax').text(getDecimalNumberFormat(totalTax));
    $('#shipping').text(getDecimalNumberFormat(totalShipping));
    $('#cart-total').text(decimalNumberFormatWithCurrency((totalPrice - couponOffer) + totalTax + totalShipping));
    let index = getSelectedIndex();
    ajaxCall("/cart-selected-store", index, options, false, null);
}

function emptyCart()
{
    if (parseInt($('#totalCartItem').text()) > 0) {
        $('#emptyCart').hide();

    } else {
        $('#emptyCart').show();
        $('#view-cart-display').hide();
        $('#clear-all-display').hide();
        $('#checkout-display').addClass("text-gray-10 bg-gray-11");
        $('#checkout-display').removeClass("bg-gray-12");
    }
}

$("#checkCoupon").on('click', function(event) {
    let disCountCode = $('#discount_code').val();
    if (disCountCode.length > 0) {
        $.ajax({
            url: SITE_URL + "/check-coupon",
            data: {
                discount_code: disCountCode,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                let txt = jsLang('Congrats you are eligible for this coupon in this order.');
                if (data.status == 1) {
                    $('#checkOutMsg').removeClass('error');
                    $('#checkOutMsg').addClass('success');

                    let totalAm = $('#cart-total').text().replace(/,/g, '');
                    totalAm = parseFloat(totalAm.replace(currencySymbol,''));
                    couponOffer = data.data['calculated_discount'];
                    couponDiscountType = data.data['discount_type'];
                    couponDiscouintAmount = data.data['discount_amount'];
                    $('#couponOffer').text(getDecimalNumberFormat(couponOffer));
                    $('#cart-total').text(decimalNumberFormatWithCurrency(totalAm - couponOffer));
                } else {
                    txt = jsLang(data.message);
                    $('#checkOutMsg').removeClass('success');
                    $('#checkOutMsg').addClass('error');
                }
                $('#checkOutMsg').text(txt);
                $('#checkOutMsg').show();
                $('#discount_code').val(null);
            }
        });
    } else {
        $('#checkOutMsg').removeClass('success')
        $('#checkOutMsg').addClass('error');
        $('#checkOutMsg').text(jsLang('This field is required.'));
        $('#checkOutMsg').show();
    }
});


if ($('.main-body .page-wrapper').find('#cart-details-container').length) {


    document.querySelectorAll('.vendor-parent').forEach(element => {
        if(isAllChildChecked(element)) {
            element.classList.add("border-gray-12");
            element.querySelector('.cart-shop').checked = true;
        }
    });

    updateTotalBox();

    checkingCheckbox();
}
