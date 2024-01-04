@extends('admin.layouts.app')
@section('page_title', __('Dashboard'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/material/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">

    {{-- This link will be removed after the work is done --}}
    <link rel="stylesheet" href="{{ asset('public/dist/css/custom.min.css') }}">
@endsection

@section('content')
    @include('admin.dashboxes.popup')
    <!-- Main content -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Welcome to admin dashboard.') }}</h3>
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
                        <span class="d-block text-uppercase">New Orders <small>(7 days)</small></span>
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
                        <span class="d-block text-uppercase">Refund Requests</span>
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
                        <i class="feather icon-stop-circle f-30 text-c-green"></i>
                    </div>
                    <div class="col">
                        <h3 class="f-w-300">{{ formatNumber($thisWeekSales) }}
                            @include('admin.dashboxes.partials.compare', [
                                'change' => $thisWeekSalesCompare,
                            ])
                        </h3>
                        <span class="d-block text-uppercase">Total sales <small>(7 days)</small></span>
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
                        <span class="d-block text-uppercase">New products <small>(7 days)</small></span>
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
                        <i class="feather icon-home f-30 text-c-green rides-icon"></i>
                    </div>
                    <div class="col">
                        <h3 class="f-w-300">{{ $newVendors }}
                            @include('admin.dashboxes.partials.compare', [
                                'change' => $newVendorsCompare,
                            ])
                        </h3>
                        <span class="d-block text-uppercase">New vendors <small>(30 days)</small></span>
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
                        <i class="feather icon-user-plus f-30 text-c-green rides-icon"></i>
                    </div>
                    <div class="col">
                        <h3 class="f-w-300">{{ $newUsers }}
                            @include('admin.dashboxes.partials.compare', [
                                'change' => $newUsersCompare,
                            ])
                        </h3>
                        <span class="d-block text-uppercase">New users <small>(30 days)</small></span>
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
                        <i class="feather icon-user-plus f-30 text-c-green rides-icon"></i>
                    </div>
                    <div class="col">
                        <h3 class="f-w-300">{{ formatNumber($commissionsThisWeek) }}
                            @include('admin.dashboxes.partials.compare', [
                                'change' => $commissionThisWeekCompare,
                            ])
                        </h3>
                        <span class="d-block text-uppercase">Commission <small>(7 days)</small></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        @include('admin.dashboxes.donut-chart')
    </div>

    <div class="col-md-12">
        @include('admin.dashboxes.heatmap')
    </div>

    <div class="col-md-12">
        @include('admin.dashboxes.vendor-stats')
    </div>
    <div class="col-md-8">
        @include('admin.dashboxes.vendor-request')
    </div>
    <div class="col-md-4">
        @include('admin.dashboxes.most-sold-products')
    </div>
    <div class="col-md-4">
        @include('admin.dashboxes.most-sold-brands')
    </div>
    <div class="col-md-4">
        @include('admin.dashboxes.most-active-users')
    </div>
@endsection

@section('js')
    <script>
        const mostSoldProductsUrl = "{{ route('dashboard.most-sold-products') }}";
        const mostActiveUsersUrl = "{{ route('dashboard.most-active-users') }}";
        const vendorStatsUrl = "{{ route('dashboard.vendor-stats') }}";
        const vendorStatsUrlDaily = "{{ route('dashboard.vendor-stats-type','daily') }}";
        const vendorStatsUrlWeekly = "{{ route('dashboard.vendor-stats-type','weekly') }}";
        const vendorStatsUrlMonthly = "{{ route('dashboard.vendor-stats-type','monthly') }}";
        const vendorStatsUrlYearly = "{{ route('dashboard.vendor-stats-type','yearly') }}";
        const salesOfThisMonth = "{{ route('dashboard.sales-of-this-month') }}";
        const vendorEdiUrl = "{{ route('vendors.edit', ['id' => '__id__']) }}";
        const vendorReqsUrl = "{{ route('dashboard.vendor-req') }}";
    </script>
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/chart-chartjs/js/Chart-2019.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/dashboard.min.js') }}"></script>
@endsection
