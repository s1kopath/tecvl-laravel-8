@extends('admin.layouts.app')
@section('page_title', __('Options'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="option-list-container">
        <div class="card">
            <div class="card-header">
                @if (in_array('App\Http\Controllers\OptionController@index', $prms))
                    <h5><a href="{{ route('option.index') }}">{{ __('Options') }}</a></h5>
                @endif

                @if (in_array('App\Http\Controllers\OptionController@create', $prms))
                    <div class="card-header-right d-47inline-block">
                        <a href="{{ route('option.create') }}" class="btn btn-outline-primary custom-btn-small">
                            <span class="fa fa-plus"> &nbsp;</span>{{ __('New') }}
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
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\OptionController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\OptionController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/option.min.js') }}"></script>
@endsection
