$(document).on('click', '.wishlist', function() {
    var item_id = $(this).data('id');
    document.cookie = "item_id="+ item_id;
    var wishlist = $(this);
    $.ajax({
        url: SITE_URL + "/user/wishlist/store",
        type: 'POST',
        dataType: 'JSON',
        data:{
            item_id: item_id,
            "_token": token
        },
        success: function (data) {
            document.cookie = "item_id=; Max-Age=-99999999;";
            if (wishlist.find('svg.text-gray-10').length) {
                wishlist.find('svg').removeClass('text-gray-10');
                wishlist.find('svg').addClass('color_fill svg-bg');
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) + 1);
                $('#totalWishlistItem').addClass('w-4 h-4');
            } else if (wishlist.find('svg.color_fill').length) {
                wishlist.find('svg').addClass('text-gray-10');
                wishlist.find('svg').removeClass('color_fill svg-bg');
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) - 1);
                if ($('#totalWishlistItem').text() == 0) {
                    $('#totalWishlistItem').text('');
                    $('#totalWishlistItem').removeClass('w-4 h-4');
                }
            } else if (wishlist.find('.fa-heart-o').length) {
                wishlist.find('i').removeClass('fa-heart-o text-black');
                wishlist.find('i').addClass('fa-heart text-green-500')
                wishlist.find('span').text(jsLang('Remove from wishlist'));
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) + 1);
            } else if (wishlist.hasClass('add-wishlist')) {
                wishlist.addClass('remove-wishlist bg-yellow-1');
                wishlist.removeClass('add-wishlist');
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) + 1);
                $('#totalWishlistItem').addClass('w-4 h-4');
            } else if (wishlist.hasClass('remove-wishlist')) {
                wishlist.addClass('add-wishlist');
                wishlist.removeClass('remove-wishlist bg-yellow-1');
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) - 1);
                if ($('#totalWishlistItem').text() == 0) {
                    $('#totalWishlistItem').text('');
                    $('#totalWishlistItem').removeClass('w-4 h-4');
                }
            }
            else {
                wishlist.find('i').removeClass('fa-heart text-gray-10')
                wishlist.find('i').addClass('fa-heart-o text-black');
                wishlist.find('span').text(jsLang('Add to wishlist'));
                $('#totalWishlistItem').text(Number($('#totalWishlistItem').text()) - 1);
                if ($('#totalWishlistItem').text() == 0) {
                        $('#totalWishlistItem').text('');
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == '401') {
                window.location.href = SITE_URL + "/user/login";
            }
        }
    })
})

/** Shop Profile start **/
$('.shop-search-icon').click(function() {
    if (window.innerWidth <= 624) {
        $(".search-in-store").toggle();
        $(".shop-menu").toggle();
    }
});
/** Shop Profile end **/
