@extends('vendor.layouts.app')
@section('page_title', __('Withdrawal'))

@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="vendor-withdrawal-container">

        <div class="card">
            <div class="card-header">
                <h5>{{ __('Withdrawals History') }}</h5>
                <div class="card-header-right d-inline-block">
                    <a href="{{ route('vendorWithdrawal.setting') }}" class="btn btn-outline-primary custom-btn-small">
                        <span>{{ __('Setting') }}</span>
                    </a>
                    <a href="{{ route('vendorWithdrawal.money') }}" class="btn btn-outline-primary custom-btn-small">
                        <span>{{ __('Withdraw') }}</span>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
              <div class="card-block pt-2 px-2">
                <div class="col-sm-12">
                  @include('vendor.layouts.includes.yajra-data-table')
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\Vendor\WithdrawalController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\Vendor\WithdrawalController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/withdrawal.min.js') }}"></script>
@endsection
