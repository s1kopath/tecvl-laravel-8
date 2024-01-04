@extends('admin.layouts.app')
@section('page_title', __('Packages'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="package-list-container">
  <div class="card">
    <div class="card-header">
        @if (in_array('App\Http\Controllers\PackageController@index', $prms))
            <h5><a href="{{ route('package.index') }}">{{ __('Packages') }}</a></h5>
        @endif

        @if (in_array('App\Http\Controllers\PackageController@create', $prms))
            <div class="card-header-right d-inline-block">
                <a href="{{ route('package.create') }}" class="btn btn-outline-primary custom-btn-small">
                    <span class="fa fa-plus"> &nbsp;</span>{{ __('Add :x', ['x' =>__('Package')]) }}
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
    var pdf = "{{ (in_array('App\Http\Controllers\PackageController@pdf', $prms)) ? '1' : '0' }}";
    var csv = "{{ (in_array('App\Http\Controllers\PackageController@csv', $prms)) ? '1' : '0' }}";
</script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/package.min.js') }}"></script>
@endsection


