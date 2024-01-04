@extends('vendor.layouts.app')
@section('page_title', __('Dashboard'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/material/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/custom.min.css') }}">
@endsection

@section('content')
    @include('admin.dashboxes.popup')
    <!-- Main content -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Welcome to vendor dashboard.') }}</h3>
                </div>
            </div>
        </div>

        @foreach ($walletBalances as $wallet)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <div class="row d-flex align-items-center">
                            <div class="col-auto">
                                <div class="wallet-symbol f-30 text-c-green">
                                    <span>{{ $wallet->currency->symbol }}</span>
                                </div>
                                <div class="wallet-main">
                                    <p class="wallet-currency-name">
                                        {{ $wallet->currency->name }}
                                    </p>
                                    <p class="wallet-currency-balance">
                                        {{ formatCurrencyAmount($wallet->balance - $wallet->vendorCommission($wallet->currency_id)) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-sm-4">
            <div class="card">
                <div class="card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-stop-circle f-30 text-c-green"></i>
                        </div>
                        <div class="col">
                            <h3 class="f-w-300">{{ formatNumber($thisWeekSales) }}
                                @include('admin.dashboxes.partials.compare', [
                                    'change' => $thisWeekSalesCompare,
                                ])
                            </h3>
                            <span class="d-block text-uppercase">{{ __('Total sales') }}
                                <small>({{ __('7 days') }})</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-shopping-cart f-30 text-c-green"></i>
                        </div>
                        <div class="col">
                            <h3 class="f-w-300">{{ $thisWeekOrdersCount }}
                                @include('admin.dashboxes.partials.compare', [
                                    'change' => $thisWeekOrdersCompare,
                                ])

                            </h3>
                            <span class="d-block text-uppercase">{{ __('New Orders') }}
                                <small>({{ __('7 days') }})</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-repeat f-30 text-c-green rides-icon"></i>
                        </div>
                        <div class="col">
                            <h3 class="f-w-300">{{ $newRefunds }}
                                @include('admin.dashboxes.partials.compare', [
                                    'change' => $newRefundsCompare,
                                ])</h3>
                            <span class="d-block text-uppercase">{{ __('Refund Requests') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-package f-30 text-c-green"></i>
                        </div>
                        <div class="col">
                            <h3 class="f-w-300">{{ $newProducts }}
                                @include('admin.dashboxes.partials.compare', [
                                    'change' => $newProductsCompare,
                                ])
                            </h3>
                            <span class="d-block text-uppercase">{{ __('New products') }}
                                <small>({{ __('7 days') }})</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-block">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="feather icon-package f-30 text-c-green"></i>
                        </div>
                        <div class="col">
                            <h3 class="f-w-300">{{ $newProducts }}
                                @include('admin.dashboxes.partials.compare', [
                                    'change' => $newProductsCompare,
                                ])
                            </h3>
                            <span class="d-block text-uppercase">{{ __('New Ratings') }}
                                <small>({{ __('7 days') }})</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('admin.dashboxes.heatmap')
        </div>

        <div class="col-md-6">
            @include('admin.dashboxes.donut-chart')
        </div>

        <div class="col-md-4">
            @include('admin.dashboxes.most-sold-products')
        </div>
    </div>
@endsection

@section('js')
    <script>
        const mostSoldProductsUrl = "{{ route('vendor.dashboard.most-sold-products') }}";
        const mostActiveUsersUrl = "{{ route('vendor.dashboard.most-active-users') }}";
        const vendorStatsUrl = "{{ route('vendor.dashboard.vendor-stats') }}";
        const salesOfThisMonth = "{{ route('vendor.dashboard.sales-of-this-month') }}";
        const vendorEdiUrl = "{{ route('vendors.edit', ['id' => '__id__']) }}";
    </script>
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/chart-chartjs/js/Chart-2019.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/dashboard.js') }}"></script>
@endsection
