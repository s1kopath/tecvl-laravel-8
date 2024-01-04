"use strict";
if ($('.main-body .page-wrapper').find('#item-filter-container-mobile').length || $('.main-body .page-wrapper').find('#item-filter-container-desktop').length) {
    var searchKeyword = null;
    var url = new URL(window.location.href);
    var sortBy = "Price Low to High";
    var selCat = '';
    var optionSelectedIdentify = '';
    var min = null;
    var max = null;
    getFilterData();
    $(document).on('click', '.selected-category', function() {
        let category = $(this).attr('data-id');
        selCat = $(this).text();
        $('#selectedCategory').val(category);
        getFilterData();
    });
    $(document).on('click', '.button-update', function(event) {
        event.preventDefault();
        getFilterData();
    });
    $(document).on('click', '.option-checkbox', function() {
        optionSelectedIdentify = $(this).attr('data-option');
        getFilterData();
    });
    $(document).on('click', '.item-brand', function() {
        getFilterData();
    });
    $(document).on('click', '.item-ratings', function() {
        let rating = $(this).attr('data-rating');
        getFilterData(rating);
    });
    $(document).on('click', '.sort_by', function(event) {
        sortBy = $(this).attr('id');
        getFilterData();

        $('.sort_by').removeClass('bg-yellow-1 text-gray-12')
        $('.sort_by span.text-md').addClass('ml-3');
        $('.sort_by span.text-md').text('');
        $(this).addClass('bg-yellow-1 text-gray-12')
    });

    $(document).on('click', '.price_range', function() {
        min = $(this).attr('data-min');
        max = $(this).attr('data-max');
        getFilterData();
    });

    $(document).on('change', '.min_desktop', function() {
        min = $('.min_desktop').val();
    });

    $(document).on('change', '.max_desktop', function() {
        max = $('.max_desktop').val();
    });

    $(document).on('click', '.clear_all', function() {
        searchKeyword = typeof url.searchParams.get("keyword") != "undefined" && url.searchParams.get("keyword") != null ? url.searchParams.get("keyword") : null;
        console.log($('#selectedSubcategory').val().length);
        let jsonData = {
            'labels' : [],
            'category' : searchKeyword == null ? $('#selectedCategory').val() : null,
            'min' : null,
            'max' : null,
            'brands' : [],
            'rating' : null,
            'sort_by' : "Price Low to High",
            'searchKeyword' : searchKeyword,
            'options' : [],
        };
        ajaxCall("/filter-items", jsonData, 1);
    });

    $(document).on('click', '.Showing', function(event) {
        sortBy = $(this).attr('id');
        getFilterData();

        $('.Showing').removeClass('bg-yellow-1 text-gray-12')
        $('.Showing span.text-md').addClass('');
        $('.Showing span.text-md').text('');
        $(this).addClass('bg-yellow-1 text-gray-12')
    });

    $(document).on('click', '.pagintion', function(event) {
        start = $(this).attr('data-start');
        let pageNumber = $(this).attr('data-pageNumber');
        getFilterData(null, pageNumber, false);
    });
    $(document).on('click', '.page-prev', function(event) {
        if (parseInt(start) - 1 >= 0) {
            let dataStrt = $('#pagination').find('.bg-green-500.text-white.color_switch_bac').attr('data-start');
            let page = $('#pagination').find('.bg-green-500.text-white.color_switch_bac').attr('data-pageNumber');
            page = parseInt(page) - 1;
            start = parseInt(dataStrt) - parseInt(totalItemPerPage);
            getFilterData(null, page, false);
        }
    });
    $(document).on('click', '.page-next', function(event) {
            let dataStrt = $('#pagination').find('.bg-green-500.text-white.color_switch_bac').attr('data-start');
            let page = $('#pagination').find('.bg-green-500.text-white.color_switch_bac').attr('data-pageNumber');
            page = parseInt(page) + 1;
            start = parseInt(dataStrt) + parseInt(totalItemPerPage);
            getFilterData(null, page, false);
    });


    function getFilterData(rating = null, pageNumber = 1)
    {
        let labels = [];
        let brands = [];
        let options = [];
        let sortBy;
        labels = $('input[name="label[]"]:checked').map(function(){return $(this).val();}).get();
        options = $('input[name="label[]"]:checked').map(function(){return $(this).attr('data-option');}).get();
        brands = $('input[name="brands[]"]:checked').map(function(){return $(this).val();}).get();
        if ($('#selectedBrand').val() > 0) {
            brands = [$('#selectedBrand').val()];
        }
        let category = $('#selectedCategory').val();
        searchKeyword = typeof url.searchParams.get("keyword") != "undefined" && url.searchParams.get("keyword") != null ? url.searchParams.get("keyword") : null;
        let jsonData = {
            'labels' : labels,
            'category' : category,
            'min' : min,
            'max' : max,
            'brands' : brands,
            'rating' : rating,
            'sort_by' : sortBy,
            'searchKeyword' : searchKeyword,
            'options' : options,
            'subCategory' : $('#selectedSubcategory').val(),
        };
        ajaxCall("/filter-items", jsonData, pageNumber);
    }

    $(document).on('click', '.page-link', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getFilterData(0, page);
    });

    function ajaxCall(url, jsonData, page)
    {
        $.ajax({
            url: SITE_URL + url,
            data: {
                data: jsonData,
                page:page,
                "_token": token
            },
            method:"POST",
            beforeSend: function() {
                $(".search-result").addClass('hidden');
                $(window).scrollTop(1);
                $(".ajax-load").removeClass('hidden');
            },
            success: function (data) {
               $('#loadHtml').html(data);
            },
            complete: function() {
                $(".ajax-load").addClass('hidden');
            }
        });
        return 1;
    }

    $(document).on("keyup", ".positive-int-number", function () {
        var number = $(this).val();
        $(this).val(number.replace(/[^0-9]/g, ""));
    });
}
