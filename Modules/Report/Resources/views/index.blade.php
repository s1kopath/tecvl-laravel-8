@extends('admin.layouts.app')
@section('page_title', __('Reports'))
@section('css')
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Modules/Report/Resources/assets/css/style.min.css') }}">
@endsection
@section('content')
<div class="card-header card-head col-sm-12 bg-white">
    <h5 class="border-blue"> <a href="{{ route('reports') }}">{{ __('Reports') }} </a></h5>
</div>
    <div class="col-sm-9 pt-4" >
        <div class="bg-white pr4 p-4" id="report-module">
            <div id="report">  
            </div>
        </div>
    </div>
<div class="col-sm-3 bg-white mt-15">   
    <div class="p-3 pt-4">        
        <h3 class="tab-content-title">{{ __('Filter') }}</h3>
            <form action='' method="get" class="form-horizontal" id="reportForm">
                <div class="form-group">
                <label for="report-type">{{ __('Report Type') }}</label>
                <select class="form-control" id="report_name" name="type">
                    @foreach ($reportTypes as $key => $report)
                    <option value="{{ $key }}">{{ $report }}</option>
                    @endforeach
                </select>
                </div>
                <div id="filter-data">
                    <div id="filter-data">
                        <div class="form-group filter-data coupons_report date-picker-field" id="date-picker-field">
                            <label for="to">{{ __('Date Range') }}</label>
                            <button type="button" class="form-control date-range" id="daterange-btn">
                                <span class="float-left">
                                  <i class="fa fa-calendar"></i>
                                  {{ __('Pick a date range')  }}
                                </span>
                                <i class="fa fa-caret-down float-right pt-1"></i>
                            </button>
                            <input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
                            <input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
                        </div>
                        <div class="form-group filter-data coupons_report" id="coupon-field">
                            <label for="customer-name">{{ __('Coupon Code') }}</label>
                            <input type="text" name="coupon_code" class="form-control" id="coupon-code" value="">
                        </div>
                        <div class="form-group filter-data branded_products_report" id="brand-field">
                            <label for="customer-name">{{ __('Brand') }}</label>
                            <input type="text" name="brand_name" class="form-control" id="brand-name" value="">
                        </div>
                        <div class="form-group filter-data product_stock_report">
                            <label for="customer-name">{{ __('Qty Above') }}</label>
                            <input type="text" name="qty_above" class="form-control" id="qty-above" value="">
                        </div>
                        <div class="form-group filter-data product_stock_report" >
                            <label for="customer-name">{{ __('Qty Bellow') }}</label>
                            <input type="text" name="qty_bellow" class="form-control" id="qty-bellow" value="">
                        </div>
                        <div class="form-group filter-data product_stock_report">
                            <label for="report-type">{{ __('Stock Availability') }}</label>
                            <select class="form-control" name="stock_availability" id="stock_availability">
                                <option value="">{{ __('Select One') }}</option>
                                <option value="in_stock">{{ __('In Stock') }}</option>
                                <option value="out_of_stock">{{ __('Out Of Stock') }}</option>
                            </select>
                        </div>
                        <div class="form-group filter-data categorized_products_report">
                            <label for="customer-name">{{ __('Category') }}</label>
                            <input type="text" name="category_name" class="form-control" id="category-name" value="">
                        </div>
                        <div class="form-group filter-data tagged_products_report">
                            <label for="customer-name">{{ __('Tag') }}</label>
                            <input type="text" name="tag_name" class="form-control" id="tag-name" value="">
                        </div>
                        <div class="form-group filter-data order-status-field customers_order_report">
                            <label for="report-type">{{ __('Order Status') }}</label>
                            <select class="form-control" id="order_status" name="order_status">
                                <option value="">{{ __('Please select one') }}</option>
                                @foreach ($orderStatus as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group filter-data customers_order_report">
                            <label for="customer-name">{{ __('Customer Name') }}</label>
                            <input type="text" name="customer_name" class="form-control" id="customer-name" value="">
                        </div>
                        <div class="form-group filter-data customers_order_report">
                            <label for="customer-email">{{ __('Customer Email') }}</label>
                            <input type="text" name="customer_email" class="form-control" id="customer-email" value="">
                        </div>
                        <div class="form-group filter-data shipping_report">
                            <label for="report-type">{{ __('Shipping Method') }}</label>
                            <select class="form-control" id="shipping_method" name="shipping_method">
                                <option value="">{{ __('Please select one') }}</option>
                                @foreach ($shippingMethod as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group filter-data commitions_report">
                            <label for="customer-name">{{ __('Vendor Name') }}</label>
                            <input type="text" name="vendor_name" class="form-control" id="vendor-name" value="">
                        </div>
                        <button type="submit" class="btn btn-default search-btn" data-loading="">
                            {{ __('Filter') }}
                        </button>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
<script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('Modules/Report/Resources/assets/js/report.min.js') }}"></script>
<script type="text/javascript">
    'use strict';
    var startDate = "{!! isset($from) ? $from : 'undefined' !!}";
    var endDate   = "{!! isset($to) ? $to : 'undefined' !!}";
  </script>
@endsection
