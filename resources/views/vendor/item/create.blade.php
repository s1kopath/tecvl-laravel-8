@extends('vendor.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Item')]))
@section('css')
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    <!-- date range picker css -->
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- custom category -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/custom-category.min.css') }}">
    <!-- summer note css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/summer-note/summernote.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-9" id="item-add-container">
        <div id="home" class="section">
            <div class="card-header card-head">
                <h5 class="border-blue"> <a href="{{ route('vendor.items') }}">{{ __('Items') }} </a> >>{{ __('Create :x', ['x' => __('Item')]) }}</h5>
            </div>
            <div class="table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('vendor.item.store') }}" method="post" id="itemForm" class="col-sm-12" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12 p-0">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-body bg-white">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 control-label require">{{ __('Name') }}
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" value="{{ old('name') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                </div>
                                            </div>
                                            <div class="ajax-loader">
                                                <img src="{{ asset('public/dist/img/loader/loader.gif') }}" class="img-responsive" />
                                            </div>
                                            @php $catId  = 0; $specificCat = 0; $specificSubCat = 1; @endphp
                                            <div class="form-group row form-h">
                                                <label class="col-sm-2 control-label require">{{ __('Category') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" id="custom-show" autocomplete="off">
                                                    <div class="Content">
                                                        <div class="drop-main" id="myDIV" style="display: none">
                                                            <ul class="Menu -vertical">
                                                                <div class="input-group p-2">
                                                                    <input class="form-control border-end-0 border m-border input-height category-search" type="search" placeholder="{{ __('Search') }}" data-seId = {{ $catId }}>
                                                                    <span class="input-group-append input-height">
                                                                            <button class="btn text-secondary bg-white border-start-0 border-left-0 border ms-n5" type="button">
                                                                                <div class="icon-height">
                                                                                    <i class="fa fa-search"></i>
                                                                                </div>
                                                                            </button>
                                                                        </span>
                                                                </div>
                                                                <div class="custom-overflow" id="categorySearchDiv-{{ $catId++ }}">
                                                                    @foreach($categories as $category)
                                                                        @if(count($category->childrenCategories->where('status', 'Active')))
                                                                            <li class="-hasSubmenu category-list categorySearchDiv-{{ $specificCat }}" id="list-{{ $category->id }}" data-catId = "{{ $category->id }}" data-name = "{{ $category->name }}">
                                                                                <a href="javascript:void(0)">{{ wrapIt($category->name, 20, ['columns' => 3, 'trim' => true, 'trimLength' => 25]) }}</a>
                                                                                <ul>
                                                                                    <div class="input-group p-2">
                                                                                        <input class="form-control border-end-0 border m-border input-height category-search" type="search" placeholder="{{ __('Search') }}" data-seId = {{ $catId }}>
                                                                                        <span class="input-group-append input-height">
                                                                                            <button class="btn text-secondary bg-white border-start-0 border-left-0 border ms-n5" type="button">
                                                                                                <div class="icon-height">
                                                                                                    <i class="fa fa-search"></i>
                                                                                                </div>
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="custom-overflow" id="categorySearchDiv-{{ $catId++ }}">
                                                                                        @foreach($category->childrenCategories->where('status', 'Active') as $childCategory)
                                                                                            @include('../admin/layouts.includes.child_category', ['child_category' => $childCategory, 'catId' => $catId])
                                                                                        @endforeach
                                                                                    </div>
                                                                                </ul>
                                                                            </li>
                                                                        @else
                                                                            <li class="category-list clicked categorySearchDiv-{{ $specificCat }}" id="list-{{ $category->id }}" data-catId = "{{ $category->id }}" data-name = "{{ $category->name }}"><a href="javascript:void(0)">{{ wrapIt($category->name, 20, ['columns' => 3, 'trim' => true, 'trimLength' => 25]) }}</a></li>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </ul>

                                                            <nav aria-label="breadcrumb" class="mt-2 small current-section">
                                                                <ol class="breadcrumb custom-breadcrumb text-sm">
                                                                    <span class="inline-block mr-2">{{ __('Current section') }}: </span>
                                                                </ol>
                                                            </nav>

                                                            <div>
                                                                <button class="custom-btns" disabled id="categorySubmit">{{ __('Confirm') }}</button>
                                                                <button class="custom-btns" id="categoryCancel">{{ __('Cancel') }}</button>
                                                                <button class="custom-btns" id="categoryClear">{{ __('Clear') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="category_id" id="category_id">
                                        </div>



                                        <div id="item-info">
                                            <div id="attributeBox" class="card-border card mt-3 section">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Attribute')]) }}</h6>
                                                </div>
                                                <div class="card-body" id="attribute_information"></div>
                                            </div>

                                            <div id="custom-item-info" class="card-border card mt-3 section">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Item')]) }}</h6>
                                                </div>
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            <label for="brand" class="control-label">{{ __('Brand') }}</label>
                                                            <select class="form-control select2" name="brand_id">
                                                                <option value="">{{ __('Select One') }}</option>
                                                                @foreach($brands as $brand)
                                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="price" class="control-label require">{{ __('Price') }}</label>
                                                            <input type="text" placeholder="{{ __('Price') }}" class="form-control positive-float-number" maxlength="8" id="price" name="price" value="{{ old('price') }}"required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" >
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="tax_id" class="control-label">{{ __('Tax Type') }}</label>
                                                            <select class="form-control select2 mt-3" id="tax_id" name="tax_id">
                                                                <option value="">{{ __('Select One') }}</option>
                                                                @foreach($taxes as $tax)
                                                                    <option value="{{ $tax->id }}"> {{ $tax->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="status" class="control-label require">{{ __('Status') }}</label>
                                                            <select class="form-control" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                                <option value="Active">{{ __('Active') }}</option>
                                                                <option value="Inactive">{{ __('Inactive') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="is_inventory_enabled" class="col-sm-3 control-label">{{  __('Discount') }}</label>
                                                        <div class="col-sm-3 margin-neg-top-05">
                                                            <div class="switch d-inline m-r-10">
                                                                <input type="checkbox" name="is_discount" id="is_discount_enable">
                                                                <label for="is_discount_enable" class="cr"></label>
                                                            </div>
                                                        </div>
                                                        <label for="track_inventory" class="col-sm-3 control-label">{{  __('Track Inventory') }}</label>
                                                        <div class="col-sm-3 margin-neg-top-05">
                                                            <div class="switch d-inline m-r-10">
                                                                <input type="checkbox" name="is_track_inventory" id="track_inventory">
                                                                <label for="track_inventory" class="cr"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="discount">
                                                        <div class="form-group row">
                                                            <div class="col-sm-4">
                                                                <label for="discount_price" class="control-label">{{ __('Discount Price') }}</label>
                                                                <input type="text" readonly placeholder="{{ __('Discount Price') }}" class="form-control positive-float-number" maxlength="8" id="discount_price" name="discounted_price" value="{{ old('discounted_price') }}">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="discount_amount" class="control-label" id="discount_amount_lbl">{{ __('Discount Amount') }}</label>
                                                                <input type="text" placeholder="{{ __('Discount Amount') }}" class="form-control positive-float-number" maxlength="8" id="discount_amount" name="discount_amount" value="{{ old('discount_amount') }}">
                                                                <span id="discount-amount-error" class="validationMsg"></span>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="discount_type" class="control-label" id="discount_type_lbl">{{ __('Discount Type') }}</label>
                                                                <select name="discount_type" class="form-control select2 sl_common_bx" id="discount_type">
                                                                    <option value=""> {{ __('Select One') }} </option>
                                                                    <option value="Flat" {{ old('discount_type') == "Flat" ? 'selected' : ''}}>{{ __("Flat") }}</option>
                                                                    <option value="Percent" {{ old('discount_type') == "Percent" ? 'selected' : ''}}>{{ __("Percent") }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 mt-3">
                                                                <label for="maximum_discount_amount" class="control-label">{{ __('Maximum Discount') }}</label>
                                                                <input type="text" placeholder="{{ __('Maximum Discount')  }}" class="form-control positive-float-number" id="maximum_discount_amount" maxlength="10" name="maximum_discount_amount" value="{{ old('discount_amount') }}">
                                                            </div>
                                                            <div class="col-sm-4 mt-3">
                                                                <label for="minimum_order_for_discount" class="control-label">{{ __('Minimum Order Discount') }}</label>
                                                                <input type="text" placeholder="{{ __('Minimum Order Discount') }}" class="form-control positive-float-number" id="minimum_order_for_discount" maxlength="8" name="minimum_order_for_discount" value="{{ old('discount_amount') }}">
                                                            </div>
                                                            <div class="col-sm-4 mt-3">
                                                                <label for="discount_from" class="control-label" id="discount_from_lbl">{{ __('Discount Start') }}</label>
                                                                <input type="text" id="discount_from" name="discount_from" class="form-control start_date sl_common_bx" placeholder="{{ __('Discount Start') }}" autocomplete="off">
                                                            </div>
                                                            <div class="col-sm-4 mt-3">
                                                                <label for="discount_to" class="control-label" id="discount_to_lbl">{{ __('Discount End') }}</label>
                                                                <input type="text" id="discount_to" name="discount_to" class="form-control end_date sl_common_bx" placeholder="{{ __('Discount End') }}" autocomplete="off">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div id="custom-option-information" class="card-border card mt-3 section">
                                                <div class="card-header mb-3">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Option')]) }}</h6>
                                                </div>
                                                <div class="drag_and_drop" id="new_option">
                                                    <div class="accordion custom-option" id="accordionExample-1">
                                                        <div class="" id="custom-option-1">
                                                            <div id="collapse-1" class=" card-body custom-pad collapse show" aria-labelledby="headingOne" data-parent="#accordionExample-1">
                                                                <div class="col-sm-12">
                                                                    <div class="row border">
                                                                        <div class="col-sm-4 mt-3">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-1">
                                                                                    <label for="option_name" class="control-label mt-1"><i class="fa fa-arrows-alt drag-color" aria-hidden="true"></i>
                                                                                    </label>
                                                                                </div>

                                                                                <div class="col-sm-3">
                                                                                    <label for="option_name" class="col-sm-4 mL-15 control-label require">{{ __('Name') }}</label>
                                                                                </div>
                                                                                <div class="col-sm-7">
                                                                                    <input type="text" placeholder="{{ __('Name') }}" class="form-control option_nameChk errorChk" id="option_nameChk-1" name="option_data[1][option_name]" value="{{ old('option_name') }}">
                                                                                    <span id="value-option_name-1" class="validationMsg"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="option_row_identify[]" value="1">
                                                                        <div class="col-sm-4 mt-3">
                                                                            <div class="form-group row">
                                                                                <label for="type" class="col-sm-4 control-label require">{{ __('Type') }}</label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="js-example-basic-single errorChk form-control typeChk" id="typeChk-1" data-select-id=1 name="option_data[1][type]">
                                                                                        <option value="" selected="">{{ __('Select One') }}</option>
                                                                                            <option value="dropdown">{{ __('Dropdown') }}</option>
                                                                                    </select>
                                                                                    <span id="value-option_type-1" class="validationMsg"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 mt-3">
                                                                            <div class="form-group row">
                                                                                <label for="is_required" class="col-sm-5 control-label">{{ __('Required') }}</label>
                                                                                <div class="col-sm-7">
                                                                                    <select class="form-control is_requiredChk" name="option_data[1][is_required]" id="is_requiredChk-1">
                                                                                        <option value="0" {{ old('is_required') == "0" ? 'selected' : ''}}>{{ __('No') }}</option>
                                                                                        <option value="1" {{ old('is_required') == "1" ? 'selected' : ''}}>{{ __('Yes') }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-1 mt-3">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 margin-top-1p text-center">
                                                                                    <a type="button" id="delete-option-1" class="del-btn delete-option-row" data-row-id="1" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="" data-globalId="">
                                                                                        <i class="feather icon-trash-2"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="custom-option-value-1">
                                                                    <div class="table-responsive option_div" id="option_div-1">
                                                                        <table class="options table table-bordered">
                                                                            <thead class="t-head">
                                                                            <tr>
                                                                                <th class="label">{{ __('Label') }}</th>
                                                                                <th>{{ __('Price') }}</th>
                                                                                <th class="option_qty">{{ __('Quantity') }}</th>
                                                                                <th>{{ __('Price type') }}</th>
                                                                                <th>{{ __('Status') }}</th>
                                                                                <th class="delete custom-width">
                                                                                    <a type="button" class="text-center font_12 add-new-option-value color_848484" id="add-new-option-value-1" data-row-id=1 data-div-id=1 ><i class="fas fa-plus"></i> {{ __('Add') }}</a>
                                                                                </th>
                                                                            </tr>
                                                                            </thead>

                                                                            <tbody id="option-values-1" class="drag_and_drop">
                                                                            <tr draggable="false" id="option-value-rowid-1" class="option-value-rowid">
                                                                                <td class="label">
                                                                                    <div class="d-flex">
                                                                                        <i class="fa fa-arrows-alt drag-color mt-2 pr-3" aria-hidden="true"></i>
                                                                                        <input type="text" name="option_data[1][label][]" class="form-control errorChk labelChk" id="labelChk-1">
                                                                                    </div>
                                                                                    <span id="value-label-1" class="validationMsg value-label ml-27px"></span>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="option_data[1][option_price][]" class="form-control errorChk positive-float-number priceChk" maxlength="8" id="priceChk-1">
                                                                                    <span id="value-price-1" class="validationMsg value-price"></span>
                                                                                </td>
                                                                                <td class="option_qty">
                                                                                    <input type="text" name="option_data[1][option_qty][]" class="form-control errorChk positive-float-number inventory_qty" value="0" maxlength="10">
                                                                                    <span id="value-qty-1" class="validationMsg value-qty"></span>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control price_type" name="option_data[1][option_price_type][]" id="price_type">
                                                                                        <option value="Fixed">{{ __('Fixed') }}</option>
                                                                                        <option value="Percent">{{ __('Percent') }}</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control" name="option_data[1][option_status][]" id="option_status">
                                                                                        <option value="Active">{{ __('Active') }}</option>
                                                                                        <option value="Inactive">{{ __('Inactive') }}</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td class="text-center delete">
                                                                                    <a type="button" id="delete-option-value-1" class="del-btn delete-option-value-row" data-row-id=1 data-div-id=1 data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                                        <i class="feather icon-trash-2"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group pull-left mt-3" id="item-new-option">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-default padding_6 btn-width ml-2 w-full" id="add-new-option" data-row-id=1>{{ __('New :x', ['x' => __('Option')]) }}</button>
                                                            </div>
                                                            <div class="col-sm-6 ml-neg-point5 "></div>
                                                            <div class="col-sm-2">
                                                                <select class="form-control" name="global_option" id="global_option">
                                                                    <option value="">{{ __('Select One') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-default padding_6" id="add-new-option-global" data-row-id=1>{{ __('Load Option') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="custom-additional-information" class="card-border card mt-3 section">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Additional')]) }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            <label for="available_from" class="control-label">{{ __('Available :x',['x' => __('From')]) }}</label>
                                                            <input type="text" id="available_from" name="available_from" readonly="readonly" class="form-control start_date" placeholder="{{ __('Available :x',['x' => __('From')]) }}">
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="available_to" class="control-label">{{ __('Available :x',['x' => __('To')]) }}</label>
                                                            <input type="text" id="available_to" name="available_to" readonly="readonly" class="form-control end_date" placeholder="{{ __('Available :x',['x' => __('To')]) }}">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="sku" class="col-sm-2 control-label">{{ __('SKU') }}</label>
                                                            <input type="text" id="sku" name="sku" class="form-control" placeholder="{{ __('SKU') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="custom-service-delivery" class="card-border mt-2 card section">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __('Service & Delivery') }}</h6>
                                                </div>
                                                <div class="form-group row card-body">
                                                    <div class="col-sm-4">
                                                        <label for="warranty_type" class="control-label require"> {{ __('Warranty Type') }} </label>
                                                        <select class="form-control" id="warranty_type" name="warranty_type" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            @foreach(getServiceData(1,0) as $warrantyType)
                                                                <option value="{{ $warrantyType }}">{{ $warrantyType }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="warranty_period" id="warranty_period_lbl"> {{ __('Warranty Period') }} </label>
                                                        <select class="form-control " id="warranty_period" name="warranty_period">
                                                            <option value="">{{ __('Select One') }}</option>
                                                            @foreach(getServiceData(0,1) as $warrantyPeriod)
                                                                <option value="{{ $warrantyPeriod }}">{{ $warrantyPeriod }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="warranty_policy" class="control-label "> {{ __('Warranty Policy') }} </label>
                                                        <textarea type="text" rows="2" class="form-control" name="warranty_policy" id="warranty_policy"></textarea>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-4 align-content-start">
                                                                <div class="row">
                                                                    <div class="col-sm-12 mt-2 pb-2">
                                                                        <h6 class="mb-0 h6 mt-3">{{ __('Featured & Cash On Delivery') }}</h6>
                                                                    </div>
                                                                    <label for="is_inventory_enabled" class="col-sm-8 mt-3">{{ __('Featured') }}</label>
                                                                    <div class="col-sm-4 margin-neg-top-05 mt-2">
                                                                        <div class="switch d-inline m-r-10">
                                                                            <input type="checkbox" id="is_featured" name="is_featured">
                                                                            <label for="is_featured" class="cr"></label>
                                                                        </div>
                                                                    </div>

                                                                    <label for="is_inventory_enabled" class="col-sm-8 mt-3">{{ __('Cash On Delivery') }}</label>
                                                                    <div class="col-sm-4 margin-neg-top-05 mt-2">
                                                                        <div class="switch d-inline m-r-10">
                                                                            <input type="checkbox" id="is_cash_on_delivery" name="is_cash_on_delivery">
                                                                            <label for="is_cash_on_delivery" class="cr"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 align-content-start">
                                                                <div class="row">
                                                                    <div class="col-sm-12 mt-2 pb-2">
                                                                        <h6 class="mb-0 h6 mt-3">{{ __('Stock Visibility State') }}</h6>
                                                                    </div>

                                                                    <label for="is_hide_stock" class="col-sm-8 mt-3">{{ __('Hide Stock') }}</label>
                                                                    <div class="col-sm-4 margin-neg-top-05 mt-2">
                                                                        <div class="switch d-inline m-r-10">
                                                                            <input type="checkbox" id="is_hide_stock" name="is_hide_stock">
                                                                            <label for="is_hide_stock" class="cr"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(isActive('Shipping'))
                                                                <div class="col-sm-4 row align-content-start">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 mt-2 pb-2">
                                                                            <h6 class="mb-0 h6 mt-3">{{ __('Shipping Configuration') }}</h6>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <label for="shipping_id" class="control-label require">{{ __('Shipping') }}</label>
                                                                            <select class="form-control select2 sl_common_bx" name="shipping_id" id="shipping_id" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                                                <option value="">{{ __('Select One') }}</option>
                                                                                @foreach($shippings as $shiping)
                                                                                    <option value="{{ $shiping->id }}">{{ $shiping->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="custom-details-information" class="card-border card mt-3 section">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Details')]) }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="summary" class="col-sm-3 control-label">{{ __('Summary') }}
                                                        </label>
                                                        <div class="col-sm-9 custom-details-form">
                                                            <textarea class="form-control" name="summary"> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 mt-3">
                                                            <label for="description" class="control-label">{{ __('Description') }}</label>
                                                        </div>
                                                        <div class="col-sm-9 mt-3">
                                                            <textarea class="form-control" name="description" id="summernote"> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="contact" class="card-border mt-2 card">
                                                <div class="card-header">
                                                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Upload Image')]) }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label">{{ __('File') }}</label>
                                                        <div class="col-sm-10">
                                                            <div data-toggle="modal" data-target="#exampleModalCenter" class="custom-file" data-val="multiple" id="image-status">
                                                                <input  class="custom-file-input form-control up-images attachment" name="attachment" id="validatedCustomFile" accept="image/*" >
                                                                <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                            </div>
                                                            <div class="" id="img-container">
                                                                <!-- img will be shown here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-10" id="blog-image">

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label">{{ __('Tags') }}</label>
                                                        <div class="col-sm-10" id="tags">
                                                            <select class="form-control" id="item_tags" multiple="multiple" name="tags[]">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="-ml-4 marginTop-2r pb-3 mL-16">
                                                        <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                                        <a href="{{ route('item.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 card" id="sideBar">
        <div class="sticky-position">
            <nav id="navbar-scroll" class="custom-navbar side-positon">
                <ul class="nav-menu">
                    <li>
                        <a data-scroll="home" href="#home" class="dot custom-active">
                            <span>{{ __(':x Information', ['x' => __('Basic')]) }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="attributeBox" href="#attributeBox" class="dot">
                            <span>{{ __(':x Information', ['x' => __('Attribute')]) }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="custom-item-info" href="#custom-item-info" class="dot">
                            <span>{{ __(':x Information', ['x' => __('Item')]) }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="custom-option-information" href="#custom-option-information" class="dot">
                            <span>{{ __(':x Information', ['x' => __('Option')]) }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="custom-additional-information" href="#custom-additional-information" class="dot">
                            <span>{{ __(':x Information', ['x' => __('Additional')]) }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="custom-service-delivery" href="#custom-service-delivery" class="dot">
                            <span>{{ __('Service & Delivery') }}</span>
                        </a>
                    </li>
                    <li class="sideBar">
                        <a data-scroll="custom-details-information" href="#custom-details-information" class="dot">
                            <span>{{ __(':x Information', ['x' => __('Details')]) }}</span>
                        </a>
                    </li>
                </ul>

                <div class="custom-border sideBar">

                </div>

                <div class="mt-3">
                    <h5>{{ __('Tips') }}</h5>
                    <p class="small font-weight-normal">{{ __('Please ensure you have entered the right package weight (kg) and dimensions (cm) to avoid incorrect shipping fee calculation.') }}</p>
                </div>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="categoryWarning" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmChange">{{ __('Warning') }}!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>{{ __('Changing category will not effect basic attributes such as Name, Brand, Description. However, some category-specific attributes may be removed. Do you still want to continue?') }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary custom-btn-small" data-dismiss="modal">{{ __('No') }}</button>
                    <button type="button" id="confirmChangeCategory" data-task="" class="btn btn-danger custom-btn-small">{{ __('Yes') }}</button>
                    <span class="ajax-loading"></span>
                </div>
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')
@endsection

@section('js')
    <!-- select2 JS -->
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Jquery Ui JS -->
    <script src="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <!-- summernote JS -->
    <script src="{{ asset('public/datta-able/plugins/summer-note/summernote.min.js') }}"></script>
    <!-- dropzone JS -->
    <script src="{{ asset('public/datta-able/plugins/fileupload/js/dropzone.min.js') }}"></script>
    <!-- sweetalert JS -->
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- date range picker Js -->
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('public/dist/js/custom/item.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/custom-category.min.js') }}"></script>

    <script>
        var confirmTextCurrentSection = '';
        var parentCategoryId = [];
    </script>

@endsection
