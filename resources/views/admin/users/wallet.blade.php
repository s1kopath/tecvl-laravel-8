@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('User')]))
@section('css')
{{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
@endsection
@section('content')
<div class="col-sm-12" id="user-wallet-container">
    <div class="card">
        <div class="card-header">
            <h5><a href="{{ route('users.index') }}">{{ __('Users') }}</a> >> {{ $user->name}} >> {{ __('Wallet') }}</h5>
        </div>
        <div class="card-body p-0" id="no_shadow_on_card">
            @include('admin.layouts.includes.user_menu')
            <div class="col-sm-12 m-t-20 form-tabs">
                @include('admin.layouts.includes.yajra-data-table')
            </div>
        </div>
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
