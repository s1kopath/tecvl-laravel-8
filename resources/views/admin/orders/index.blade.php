@extends('admin.layouts.app')
@section('page_title', __('Orders'))
@section('css')
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="order-list-container">
        <div class="card">

            <div class="card-header">
                <h5> <a href="{{ route('order.index') }}">{{ __('Orders') }}</a> </h5>
                <div class="card-header-right d-inline-block">
                    <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
                </div>
            </div>

            <div class="card-header p-0 collapse" id="filterPanel">
                <div class="row mx-2 my-2">
                    <div class="col-md-3">
                        <div class="input-group">
                            <button type="button" class="form-control" id="daterange-btn">
                                <span class="float-left"><i class="fa fa-calendar"></i> {{ __('Date range picker') }}</span>
                                <i class="fa fa-caret-down float-right pt-1"></i>
                            </button>
                        </div>
                    </div>
                    <input class="form-control" id="startfrom" type="hidden" name="from" value="">
                    <input class="form-control" id="endto" type="hidden" name="to" value="">
                    <div class="col-md-3">
                        <select class="filter select2" name="order_status_id" id="order_status_id">
                            <option value="">{{ __('All :x', ['x' => __('Order Status')]) }}</option>
                            @foreach($statuses as $allStatus)
                                <option value="{{ $allStatus->id }}">{{ $allStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <select class="filter display-none" name="start_date" id="start_date"></select>

                    <select class="filter display-none" name="end_date" id="end_date"></select>

                    <div class="col-md-3">
                        <select class="select2 filter" name="vendor_id" id="vendor_id">
                            <option value="">{{ __('All :x', ['x' => __('Vendors')]) }}</option>
                            @foreach($vendors as $allVendor)
                                <option value="{{ $allVendor->vendor_id }}">{{ optional($allVendor->vendor)->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="select2 filter" name="payment_status" id="payment_status">
                            <option value="">{{ __('All :x', ['x' => __('Payment Status')]) }}</option>
                                <option value="Paid">{{ __('Paid') }}</option>
                               <option value="Unpaid">{{ __('Unpaid') }}</option>
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
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <!-- select2 JS -->
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\OrderController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\OrderController@csv', $prms)) ? '1' : '0' }}";
        var startDate = "{!! isset($from) ? $from : 'undefined' !!}";
        var endDate   = "{!! isset($to) ? $to : 'undefined' !!}";
    </script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/order.min.js') }}"></script>
@endsection
