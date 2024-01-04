@extends('admin.layouts.app')
@section('page_title', __('Items'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="item-list-container">
        <div class="card">

            <div class="card-header">
                <h5> <a href="{{ route('item.index') }}">{{ __('Items') }}</a> </h5>
                <div class="card-header-right d-inline-block">
                    <a href="{{ route('item.import') }}" class="btn btn-outline-primary custom-btn-small"><span class="fa fa-upload"> &nbsp;</span>{{ __('Import') }}</a>
                    <a href="{{ route('item.create') }}" class="btn btn-outline-primary custom-btn-small">
                        <span class="fa fa-plus"> &nbsp;</span>{{ __('New') }}
                    </a>
                    <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
                </div>
            </div>

            <div class="card-header p-0 collapse" id="filterPanel">
                <div class="row mx-2 my-3">
                    <div class="col-md-3">
                        <select class="select2 filter" name="brand">
                            <option value="">{{ __('All Brands') }}</option>
                            @foreach ($itemBrands as $item)
                                @if(optional($item->brand)->id)
                                <option value="{{ optional($item->brand)->id }}">{{ optional($item->brand)->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="select2 filter" name="category">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach ($itemCategories as $item)
                                @if(optional($item->category)->id)
                                <option value="{{ optional($item->category)->id }}">{{ optional($item->category)->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="select2 filter" name="vendor">
                            <option value="">{{ __('All :x', ['x' => __('Vendors')]) }}</option>
                            @foreach ($vendors as $vendor)
                                @if($vendor->vendor_id)
                                    <option value="{{ $vendor->vendor_id }}">{{ optional($vendor->vendor)->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="select2 filter" name="status">
                            <option>{{ __('All Status') }}</option>
                            <option value="Active">{{ __('Active') }}</option>
                            <option value="Inactive">{{ __('Inactive') }}</option>
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
    <script src="{{ asset('public/dist/js/custom/item.min.js') }}"></script>
@endsection
