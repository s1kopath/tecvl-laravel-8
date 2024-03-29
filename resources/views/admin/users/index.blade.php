@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('page_title', __('Users'))
@section('content')
<!-- Main content -->
<div class="col-sm-12 list-container" id="user-list-container">
  <div class="card">
    <div class="card-header">
      <h5> <a href="{{ route('users.index') }}">{{ __('Users') }}</a> </h5>
      <div class="card-header-right d-inline-block">
        @if (in_array('App\Http\Controllers\UserController@import', $prms))
                <a href="{{ route('users.import') }}" class="btn btn-outline-primary custom-btn-small"><span class="fa fa-upload"> &nbsp;</span>{{ __('Import') }}</a>
            @endif

        @if (in_array('App\Http\Controllers\UserController@create', $prms))
          <a href="{{ route('users.create') }}" class="btn btn-outline-primary custom-btn-small">
            <span class="fa fa-plus"> &nbsp;</span>{{ __('New') }}
          </a>
        @endif

        <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
    </div>
    </div>

    <div class="card-header collapse" id="filterPanel">
      <div class="row">
        <div class="col-md-3">
          <select class="select2 filter" name="role">
            <option value="">{{ __('All Role') }}</option>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <select class="select2 filter" name="status">
            <option value="">{{ __('All Status') }}</option>
            <option value="Pending">{{ __('Pending') }}</option>
            <option value="Active">{{ __('Active') }}</option>
            <option value="Inactive">{{ __('Inactive') }}</option>
            <option value="Deleted">{{ __('Deleted') }}</option>
          </select>
      </div>
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
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    'use strict';
    $(".select2").select2();
    var pdf = "{{ (in_array('App\Http\Controllers\UserController@pdf', $prms)) ? '1' : '0' }}";
    var csv = "{{ (in_array('App\Http\Controllers\UserController@csv', $prms)) ? '1' : '0' }}";
</script>

<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/user.min.js') }}"></script>
@endsection
