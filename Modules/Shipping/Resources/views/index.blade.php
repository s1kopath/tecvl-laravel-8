@extends('admin.layouts.app')
@section('page_title', __('Shippings'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="shipping-list-container">
  <div class="card">
    <div class="card-header">
      <h5><a href="{{ route('shipping.index') }}">{{ __('Shippings') }}</a></h5>
        <div class="card-header-right d-inline-block">
            @if (in_array('Modules\Shipping\Http\Controllers\ShippingController@create', $prms))
                <a href="{{ route('shipping.create') }}" class="btn btn-outline-primary custom-btn-small">
                <span class="fa fa-plus"> &nbsp;</span>{{ __('Add Shipping') }}
                </a>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
      <div class="card-block pt-2 px-2">
        <div class="col-sm-12">
          @include('admin.layouts.includes.yajra-data-table')
        </div>
      </div>
    </div>
    @include('admin.layouts.includes.delete-modal')
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var pdf = 0;
    var csv = 0;
</script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
