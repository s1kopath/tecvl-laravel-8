"use strict";
  $(document).ready(function() {
    $('.date-range').daterangepicker(daterangeConfig(startDate, endDate), cbRange);
    cbRange(startDate, endDate);
      $('input[name="start_date"]').daterangepicker(dateSingleConfig($('input[name="start_date"]').val()));
      $('input[name="end_date"]').daterangepicker(dateSingleConfig($('input[name="end_date"]').val()));

        getReport('coupons_report');
        function getReport(report) {
          $(".filter-data").hide();
          $('input').val('');
          $("."+ report).show();
          if(report == 'customers_order_report' || report == 'shipping_report' || report == 'sale_report') {
            $(".date-picker-field").show();
          }
          if(report == 'shipping_report' || report == 'sale_report') {
            $(".order-status-field").show();
          }
          $('#report-module').html('');
        $.ajax({
          type: 'get',
          dataType: 'html',
          url: SITE_URL + '/reports',
          data: {
              'type': report,
          },
          success: function (data) {
            if(data) {
              let d = JSON.parse(data);
              $('#report-module').append(d.list);
            } 
          }
        });
      };

      $(document).on('change', "#report_name", function () {
        getReport($(this).val());
    });


      $(document).on('click', '.search-btn', function(event) {
        event.preventDefault()
        $('#report-module').html('');
        $.ajax({
          type: 'get',
          dataType: 'html',
          url: SITE_URL + '/reports',
          data: {
              'type': $('#report_name').val(),
              'from': $('#startfrom').val(),
              'to': $('#endto').val(),
              'couponCode': $('#coupon-code').val(),
              'brandName': $('#brand-name').val(),
              'categoryName': $('#category-name').val(),
              'tagName': $('#tag-name').val(),
              'customerName': $('#customer-name').val(),
              'customerEmail': $('#customer-email').val(),
              'orderStatus': $('#order_status').val(),
              'shippingMethod': $('#shipping_method').val(),
              'vendorName': $('#vendor-name').val(),
              'qtyAbove': $('#qty-above').val(),
              'qtybellow': $('#qty-bellow').val(),
              'stockAvailability': $('#stock_availability').val(),
          },
          success: function (data) {
            if(data) {
              let d = JSON.parse(data);
              $('#report-module').append(d.list);
            } 
          }
        });
      });
  });

