@extends('admin.layouts.app')
@section('page_title', __('Package Subscriptions'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="package-subscription-list-container">
  <div class="card">
    <div class="card-header">
      <h5> <a href="{{ route('packageSubscription.index') }}">{{ __('Package Subscriptions') }}</a> </h5>
        @if (in_array('App\Http\Controllers\PackageSubscriptionController@create', $prms))
            <div class="card-header-right d-inline-block">
                <a href="{{ route('packageSubscription.create') }}" class="btn btn-outline-primary custom-btn-small">
                <span class="fa fa-plus"> &nbsp;</span>{{ __('Add :x', ['x' => __('Package Subscription')]) }}
                </a>
            </div>
        @endif
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
    var pdf = "{{ (in_array('App\Http\Controllers\PackageSubscriptionController@pdf', $prms)) ? '1' : '0' }}";
    var csv = "{{ (in_array('App\Http\Controllers\PackageSubscriptionController@csv', $prms)) ? '1' : '0' }}";
</script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/package.min.js') }}"></script>
@endsection


