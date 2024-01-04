@extends('admin.layouts.app')
@section('page_title', __('Coupon Redeems'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="coupon-redeem-list-container">
  <div class="card">
    <div class="card-header">
        <h5><a href="{{ route('couponRedeem.index') }}">{{ __('Coupon Redeems') }}</a></h5>
        <div class="card-header-right d-inline-block">
            <a href="{{ route('coupon.index') }}" class="btn btn-outline-primary custom-btn-small">
                {{ __('Back') }}
            </a>
        </div>
    </div>
    <div class="card-body p-0">
      <div class="card-block pt-2 px-2">
        <div class="col-sm-12">
          @include('admin.layouts.includes.yajra-data-table')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var pdf = "{{ (in_array('Modules\Coupon\Http\Controllers\CouponRedeemController@pdf', $prms)) ? '1' : '0' }}";
    var csv = "{{ (in_array('Modules\Coupon\Http\Controllers\CouponRedeemController@csv', $prms)) ? '1' : '0' }}";
</script>
<script src="{{ asset('public/dist/js/custom/coupon.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
