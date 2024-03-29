@extends('admin.layouts.app')
@section('page_title', __('Transaction'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="transaction-list-container">
    <div class="card">
        <div class="card-header">
            <h5>{{ __('Transactions') }}</h5>
            <div class="card-header-right d-inline-block">
                <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
            </div>
        </div>
        <div class="card-header p-0 collapse" id="filterPanel">
            <div class="row mx-2 my-3">
                <div class="col-md-3">
                    <select class="select2 filter" name="transaction_type">
                        <option value="">{{ __('All Transaction Type') }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->transaction_type }}">{{ $type->transaction_type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="select2 filter" name="status">
                        <option>{{ __('All Status') }}</option>
                        <option value="Accepted">{{ __('Accepted') }}</option>
                        <option value="Rejected">{{ __('Rejected') }}</option>
                        <option value="Pending">{{ __('Pending') }}</option>

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
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\TransactionController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\TransactionController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/withdrawal.min.js') }}"></script>
@endsection


