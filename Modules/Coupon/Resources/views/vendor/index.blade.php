@extends('vendor.layouts.app')
@section('page_title', __('Coupons'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="vendor-coupon-list-container">
  <div class="card">
    <div class="card-header">
      <h5><a href="{{ route('vendor.coupons') }}">{{ __('Coupons') }}</a></h5>
        <div class="card-header-right d-inline-block">
            @if (in_array('Modules\Coupon\Http\Controllers\Vendor\CouponController@create', $prms))
                <a href="{{ route('vendor.couponCreate') }}" class="btn btn-outline-primary custom-btn-small">
                    <span class="fa fa-plus"> &nbsp;</span>{{ __('Add Coupon') }}
                </a>
            @endif
            <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
        </div>
    </div>
    <div class="card-header p-0 collapse" id="filterPanel">
        <div class="row mx-2 my-3">
            <div class="col-md-3">
                <select class="select2 filter" name="status">
                    <option>{{ __('All Status') }}</option>
                    <option value="Active">{{ __('Active') }}</option>
                    <option value="Inactive">{{ __('Inactive') }}</option>
                    <option value="Pending">{{ __('Pending') }}</option>

                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
      <div class="card-block pt-2 px-2">
        <div class="col-sm-12">
          @include('vendor.layouts.includes.yajra-data-table')
        </div>
      </div>
    </div>
    @include('vendor.layouts.includes.delete-modal')
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var pdf = "{{ (in_array('Modules\Coupon\Http\Controllers\Vendor\CouponController@pdf', $prms)) ? '1' : '0' }}";
    var csv = "{{ (in_array('Modules\Coupon\Http\Controllers\Vendor\CouponController@csv', $prms)) ? '1' : '0' }}";
</script>
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/coupon.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
