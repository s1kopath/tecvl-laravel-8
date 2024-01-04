@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Item')]))
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
    <form class="col-sm-9" action="{{ route('item.update', $item->id) }}" method="post" id="itemForm" enctype="multipart/form-data">
        @csrf
        <div id="item-edit-container">
            <div id="home" class="card section">
                <div class="card-header">
                    <h5> <a href="{{ route('item.index') }}">{{ __('Items') }} </a> >> {{ __('Edit :x', ['x' => __('Item')]) }}</h5>
                </div>
                <div class="table-border-style">
                    <div class="row form-tabs">
                        <div class="col-sm-12" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-12 p-1">
                                        <div class="card-border">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2 control-label require">{{ __('Name') }}
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" data-item_id="{{ $item->id }}" name="name" value="{{ $item->name }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                    </div>
                                                </div>
                                                <div class="ajax-loader">
                                                    <img src="{{ asset('public/dist/img/loader/loader.gif') }}" class="img-responsive" />
                                                </div>
                                                @php $catId  = 0; $specificCat = 0; $specificSubCat = 1; @endphp
                                                <div class="form-group row form-h">
                                                    <label for="category_id" class="col-sm-2 control-label require">{{ __('Category') }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="custom-show" value="{{ $parentCategory ?? null }}" autocomplete="off">
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
                                                                            @if(count($category->childrenCategories))
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
                                                                                            @foreach($category->childrenCategories as $childCategory)
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
                                                <input type="hidden" name="category_id" id="category_id" value="{{ optional($item->itemCategory)->category_id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="item-info">
            <input type="hidden" id="cateAttLen" value="{{ count($categoryAttributes) }}">
            <div id="attributeBox">
                <div id="custom-attribute" class="card-border card section">
                    <div class="card-header">
                        <h6 class="mb-0 h6">{{ __(':x Information',['x' => __('Attribute')]) }}</h6>
                    </div>
                    <div class="card-body" id="attribute_information">
                            @php
                                $index = 1;
                                $numOfCols = 3;
                                $rowCount = 0;
                                $bootstrapColWidth = 12 / $numOfCols;
                            @endphp
                            @foreach($categoryAttributes as $key => $attribute)
                                @if ($rowCount % $numOfCols == 0)
                                    @php $rowCount++; @endphp
                                    <div class="form-group row">
                                        @endif
                                        @php
                                         $tooltip = '';
                                         if (optional($attribute->attribute)->description != null) {
                                             $tooltip = '<i class="fas fa-question-circle bottom-toolbar" data-toggle="popover" data-placement="bottom" data-content="'. optional($attribute->attribute)->description .'"></i>';
                                         }
                                        @endphp
                                        @if(optional($attribute->attribute)->type == 'dropdown')
                                            @php
                                                $attributeValues = App\Models\AttributeValue::getAll()->where('attribute_id', optional($attribute->attribute)->id)->sortBy('order_by');
                                            @endphp
                                            <div class="col-sm-4">
                                                <label for="{{ optional($attribute->attribute)->name }}" class="control-label {{ optional($attribute->attribute)->is_required == 1 ? 'require' : '' }}"> {{ strlen(optional($attribute->attribute)->name) > 25 ? substr(optional($attribute->attribute)->name, 0, 25) . ".." : optional($attribute->attribute)->name }} {!! $tooltip !!} </label>
                                                <select class="form-control errorChk attribute_information {{ optional($attribute->attribute)->is_required == 1 ? 'attribute_require' : ''}}" id="{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{ $index }}" name="attribute_data[{{ optional($attribute->attribute)->id }}]">
                                                    <option value="">{{ __('Select One') }}</option>
                                                    @foreach($attributeValues as $attributeValue)
                                                        <option value="{{ $attributeValue->value }}" {{ isset($itemAttribute[optional($attribute->attribute)->id]) && $itemAttribute[optional($attribute->attribute)->id] ==  $attributeValue->value ? 'selected' : ''}}>{{ $attributeValue->value }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="value-{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{$index++}}" class="validationMsg"></span>
                                            </div>
                                        @elseif(optional($attribute->attribute)->type == 'multiple_select')
                                            @php
                                                $attributeValues = App\Models\AttributeValue::getAll()->where('attribute_id', optional($attribute->attribute)->id)->sortBy('order_by');
                                            @endphp
                                            <div class="col-sm-4">
                                                <label for="{{ optional($attribute->attribute)->name }}" class="control-label {{ optional($attribute->attribute)->is_required == 1 ? 'require' : '' }}"> {{ strlen(optional($attribute->attribute)->name) > 25 ? substr(optional($attribute->attribute)->name, 0, 25) . ".." : optional($attribute->attribute)->name }} {!! $tooltip !!} </label>
                                                @php $attributeSelected = isset($itemAttribute[optional($attribute->attribute)->id]) ? json_decode($itemAttribute[optional($attribute->attribute)->id]) : '' @endphp
                                                <select class="js-example-basic-multiple errorChk select2 attribute_information {{ optional($attribute->attribute)->is_required == 1 ? 'attribute_require' : ''}}" id="{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{ $index }}" name="attribute_data[{{ optional($attribute->attribute)->id }}][]" multiple="multiple">
                                                    <option value="">{{ __('Select One') }}</option>
                                                    @foreach($attributeValues as $attributeValue)
                                                        <option value="{{ $attributeValue->value }}" {{ !empty($attributeSelected) && in_array($attributeValue->value, $attributeSelected) ? 'selected' : '' }} >{{ $attributeValue->value }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="value-{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{ $index++ }}" class="validationMsg"></span>
                                            </div>
                                        @elseif(optional($attribute->attribute)->type == 'field')
                                            <div class="col-sm-4">
                                                <label for="{{ optional($attribute->attribute)->name }}" class="control-label {{ optional($attribute->attribute)->is_required == 1 ? 'require' : '' }}"> {{ strlen(optional($attribute->attribute)->name) > 25 ? substr(optional($attribute->attribute)->name, 0, 25) . ".." : optional($attribute->attribute)->name }} {!! $tooltip !!} </label>
                                                <input type="text" class="form-control errorChk attribute_information {{ optional($attribute->attribute)->is_required == 1 ? 'attribute_require' : '' }}" id="{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{ $index }}" name="attribute_data[{{ optional($attribute->attribute)->id }}]" value="{{ isset($itemAttribute[optional($attribute->attribute)->id]) ? $itemAttribute[optional($attribute->attribute)->id] : '' }}">
                                                <span id="value-{{ strtolower(str_replace(' ', '-' , optional($attribute->attribute)->name)) }}-{{ $index++ }}" class="validationMsg"></span>
                                            </div>
                                        @endif
                                        @if ($rowCount % $numOfCols == 0)
                                    </div>
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>
            @if ($rowCount % $numOfCols != 0)
            </div>

            @endif


            <div id="custom-item-info" class="card-border mt-2 card section">
                <div class="card-header">
                    <h6 class="mb-0 h6">{{ __(':x Information',['x' => __('Item')]) }}</h6>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand" class="control-label">{{ __('Brand') }}</label>
                            <select class="form-control select2" name="brand_id">
                                <option class="" value="">{{ __('Select One') }}</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="vendor" class="control-label require">{{ __('Vendor') }}</label>
                            <select class="form-control select2 sl_common_bx" name="vendor_id" id="vendor_id" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ $item->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="price" class="control-label require">{{ __('Price') }}</label>
                            <input type="text" placeholder="{{ __('Price') }}" class="form-control positive-float-number" maxlength="8" id="price" name="price" value="{{ $item->price }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>

                        <div class="col-sm-4">
                            <label for="tax_id" class="control-label mt-3">{{ __('Tax Type') }}</label>
                            <select class="form-control select2 mt-3" id="tax_id" name="tax_id">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach($taxes as $tax)
                                    <option value="{{ $tax->id }}" {{ isset($item->itemDetail->tax_id) && $item->itemDetail->tax_id == $tax->id ? 'selected' : '' }}> {{ $tax->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="status" class="control-label mt-3 require sl_common_bx">{{ __('Status') }}</label>
                            <select class="form-control select2 mt-3 sl_common_bx" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                <option value="Active" {{ $item->status == "Active" ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option value="Inactive" {{ $item->status == "Inactive" ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_inventory_enabled" class="col-sm-3 control-label">{{  __('Discount') }}</label>
                        <div class="col-sm-3 margin-neg-top-05">
                            <div class="switch d-inline m-r-10">
                                <input type="checkbox" name="is_discount" id="is_discount_enable" {{ isset($item->itemDetail->is_discount) && $item->itemDetail->is_discount == 1 ? 'checked' : '' }}>
                                <label for="is_discount_enable" class="cr"></label>
                            </div>
                        </div>
                        <label for="track_inventory" class="col-sm-3 control-label">{{  __('Track Inventory') }}</label>
                        <div class="col-sm-3 margin-neg-top-05">
                            <div class="switch d-inline m-r-10">
                                <input type="checkbox" name="is_track_inventory" id="track_inventory" {{ isset($item->itemDetail->is_track_inventory) && $item->itemDetail->is_track_inventory == 1 ? 'checked' : '' }}>
                                <label for="track_inventory" class="cr"></label>
                            </div>
                        </div>
                    </div>
                    <div id="discount">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="discount_price" class="control-label">{{ __('Discount Price') }}</label>
                                <input type="text" readonly placeholder="{{ __('Discount Price') }}" class="form-control positive-float-number" maxlength="8" id="discount_price" name="discounted_price" value="{{ $item->discounted_price }}">
                            </div>

                            <div class="col-sm-4">
                                <label for="discount_amount" class="control-label" id="discount_amount_lbl">{{ __('Discount Amount') }}</label>
                                <input type="text" placeholder="{{ __('Discount Amount') }}" class="form-control positive-float-number" maxlength="8" id="discount_amount" name="discount_amount" value="{{ $item->discount_amount }}">
                                <span id="discount-amount-error" class="validationMsg"></span>
                            </div>

                            <div class="col-sm-4">
                                <label for="discount_type" class="control-label" id="discount_type_lbl">{{ __('Discount Type') }}</label>
                                <select name="discount_type" class="form-control select2 sl_common_bx" id="discount_type">
                                    <option value=""> {{ __('Select One') }} </option>
                                    <option value="Flat" {{ $item->discount_type == "Flat" ? 'selected' : ''}}>{{ __("Flat") }}</option>
                                    <option value="Percent" {{ $item->discount_type == "Percent" ? 'selected' : ''}}>{{ __("Percent") }}</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="maximum_discount_amount" class="control-label">{{ __('Maximum Discount') }}</label>
                                <input type="text" placeholder="{{ __('Maximum Discount')  }}" class="form-control positive-float-number" maxlength="10" id="maximum_discount_amount" name="maximum_discount_amount" value="{{ formatCurrencyAmount($item->maximum_discount_amount) }}">
                            </div>

                            <div class="col-sm-4">
                                <label for="minimum_order_for_discount" class="control-label text-left">{{ __('Minimum Order Discount') }}</label>
                                <input type="text" placeholder="{{ __('Minimum Order Discount') }}" class="form-control positive-float-number" maxlength="8" id="minimum_order_for_discount" name="minimum_order_for_discount" value="{{ formatCurrencyAmount($item->minimum_order_for_discount) }}">
                            </div>

                            <div class="col-sm-4">
                                <label for="discount_from" class="control-label" id="discount_from_lbl">{{ __('Discount Start') }}</label>
                                <input type="text" id="discount_from" name="discount_from" class="form-control start_date sl_common_bx" placeholder="{{ __('Discount Start') }}" value="{{ $item->discount_from }}" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label for="discount_to" class="control-label" id="discount_to_lbl">{{ __('Discount End') }} </label>
                                <input type="text" id="discount_to" name="discount_to" class="form-control end_date sl_common_bx" placeholder="{{ __('Discount End') }}" value="{{ $item->discount_to }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="custom-option-information" class="card-border mt-2 card section">
                <div class="card-header mb-3">
                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Option')]) }}</h6>
                </div>
                <div class="drag_and_drop" id="new_option">

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

            <div id="custom-additional-information" class="card-border mt-2 card section">
                <div class="card-header">
                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Additional')]) }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="available_from" class="control-label">{{ __('Available From') }}</label>
                            <input type="text" id="available_from" name="available_from" readonly="readonly" class="form-control start_date" id="available_from" placeholder="{{ __('Available From') }}" value="{{ strlen($item->available_from) > 0 ? $item->available_from : null }}">
                        </div>

                        <div class="col-sm-4">
                            <label for="available_to" class="control-label">{{ __('Available To') }}</label>
                            <input type="text" id="available_to" name="available_to" readonly="readonly" class="form-control end_date" placeholder="{{ __('Available To') }}" value="{{ strlen($item->available_to) > 0  ? $item->available_to : null }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="sku" class="col-sm-2 control-label">{{ __('SKU') }}</label>
                            <input type="text" id="sku" name="sku"  class="form-control" placeholder="{{ __('SKU') }}" value="{{ $item->sku }}">
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
                        <label for="Color" class="control-label require">{{ __('Warranty Type') }} </label>
                        <select class="form-control attribute_information " id="warranty_type" name="warranty_type" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                            @foreach(getServiceData(1,0) as $warrantyType)
                                <option value="{{ $warrantyType }}" {{ optional($item->itemDetail)->warranty_type == $warrantyType ? 'selected' : '' }}>{{ $warrantyType }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="control-label" id="warranty_period_lbl" for="warranty_period"> {{ __('Warranty Period') }} </label>
                        <select class="form-control attribute_information " id="warranty_period" name="warranty_period">
                            <option value="">{{ __('Select One') }}</option>
                            @foreach(getServiceData(0,1) as $warrantyPeriod)
                                <option value="{{ $warrantyPeriod }}" {{ optional($item->itemDetail)->warranty_period == $warrantyPeriod ? 'selected' : '' }}>{{ $warrantyPeriod }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="Protection" class="control-label "> {{ __('Warranty Policy') }} </label>
                        <textarea type="text" rows="2" class="form-control" name="warranty_policy" id="warranty_policy">{{ optional($item->itemDetail)->warranty_policy }}</textarea>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4 align-content-start">
                                <div class="row">
                                    <div class="col-sm-12 mt-2 pb-2">
                                        <h6 class="mb-0 h6 mt-3">{{ __('Featured & Cash On Delivery') }}</h6>
                                    </div>
                                    <label for="is_featured" class="col-sm-8 mt-3">{{ __('Featured') }}</label>
                                    <div class="col-sm-4 margin-neg-top-05 mt-2">
                                        <div class="switch d-inline m-r-10">
                                            <input type="checkbox" id="is_featured" name="is_featured" {{ optional($item->itemDetail)->is_featured == 1 ? 'checked' : '' }}>
                                            <label for="is_featured" class="cr"></label>
                                        </div>
                                    </div>

                                    <label for="is_cash_on_delivery" class="col-sm-8 mt-3">{{ __('Cash On Delivery') }}</label>
                                    <div class="col-sm-4 margin-neg-top-05 mt-2">
                                        <div class="switch d-inline m-r-10">
                                            <input type="checkbox" id="is_cash_on_delivery" name="is_cash_on_delivery" {{ optional($item->itemDetail)->is_cash_on_delivery == 1 ? 'checked' : '' }}>
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
                                            <input type="checkbox" id="is_hide_stock" name="is_hide_stock" {{ optional($item->itemDetail)->is_hide_stock == 1 ? 'checked' : '' }}>
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
                                                <option value="{{ $shiping->id }}" {{ isset($item->itemDetail->shipping_id) && $item->itemDetail->shipping_id == $shiping->id ? 'selected' : ''  }}>{{ $shiping->name }}</option>
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

            <div id="custom-details-information" class="card-border mt-2 card section">
                <div class="card-header">
                    <h6 class="mb-0 h6">{{ __(':x Information', ['x' => __('Details')]) }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="summary" class="col-sm-3 control-label">{{ __('Summary') }}
                        </label>
                        <div class="col-sm-9 custom-details-form">
                            <textarea class="form-control" name="summary"> {{ $item->summary }} </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 mt-3">
                            <label for="description" class="control-label">{{ __('Description') }}</label>
                        </div>
                        <div class="col-sm-9 mt-3">
                            <textarea class="form-control" name="description" id="summernote"> {{ $item->description }} </textarea>
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
                        <label class="col-sm-2">{{ __('File') }}</label>
                        <div class="col-sm-10">
                            <div data-toggle="modal" data-target="#exampleModalCenter" class="custom-file" data-val="multiple" id="image-status">
                                <input  class="custom-file-input form-control up-images attachment" name="attachment" id="validatedCustomFile" accept="image/*" >
                                <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                            </div>

                            <div class="" id="img-container">
                                <div class="d-flex flex-wrap mt-2">
                                    @foreach($item->filesUrl() as $key => $file)
                                    <div class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                        <div class="position-absolute rounded-circle text-center img-remove-icon"><i class="fa fa-times"></i></div>
                                        <img class="upl-img" src="{{ $file }}" alt="">
                                        @if(isset($item->objectImage[$key]->file_id))
                                        <input type="hidden" name="file_id[]" value="{{ $item->objectImage[$key]->file_id }}">
                                        @endif
                                        <div class="img-text pl-2">{{ isset($file->params) && !empty($file->params['type']) ?  $file->params['type'] : '' }}</div>
                                        <small class="img-size pl-2">{{ isset($file->params) && !empty($file->params['size']) ?  $file->params['size'] : '' }} kb</small>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10" id="blog-image">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ __('Tags') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="item_tags" multiple="multiple" name="tags[]">
                                @foreach($tags as $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                @endforeach
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
    </form>

    <div class="col-sm-3 card">
      <div class="sticky-position">
        <nav id="navbar-scroll" class="custom-navbar side-positon">
            <ul class="nav-menu">
              <li>
                <a data-scroll="home" href="#home" class="dot custom-active">
                  <span>{{ __(':x Information', ['x' => __('Basic')]) }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-attribute" href="#custom-attribute" class="dot">
                  <span>{{ __(':x Information', ['x' => __('Attribute')]) }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-item-info" href="#custom-item-info" class="dot">
                  <span>{{ __(':x Information', ['x' => __('Item')]) }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-option-information" href="#custom-option-information" class="dot">
                  <span>{{ __(':x Information', ['x' => __('Option')]) }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-additional-information" href="#custom-additional-information" class="dot">
                  <span>{{ __(':x Information', ['x' => __('Additional')]) }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-service-delivery" href="#custom-service-delivery" class="dot">
                  <span>{{ __('Service & Delivery') }}</span>
                </a>
              </li>
              <li>
                <a data-scroll="custom-details-information" href="#custom-details-information" class="dot">
                  <span>{{ __(':x Information', ['x' => __('Details')]) }}</span>
                </a>
              </li>
            </ul>

            <div class="custom-border">

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
    <!-- summernote  JS -->
    <script src="{{ asset('public/datta-able/plugins/summer-note/summernote.min.js') }}"></script>

    <!-- dropzone JS -->
    <script src="{{ asset('public/dist/plugins/dropzone/dropzone.min.js') }}"></script>
    <!-- sweetalert JS -->
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- date range picker Js -->
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('public/dist/js/custom/item.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/custom-category.min.js') }}"></script>
    <script>
        var parentCategoryId = {{ json_encode($parentCategoryId) }}
            parentCategoryId != '' ? buttonIsDisable = false : '';
        loadListItem(false);
        var confirmTextCurrentSection = '';
    </script>
    @if(!empty($parentCategory))
        @foreach(explode(" / ", $parentCategory) as $key => $parent)
            <script>
                confirmTextCurrentSection += `<li class="breadcrumb-item" data-catId = {{ $parentCategoryId[$key] ?? null }}><a class="custom-a" href="javascript:void(0)">{{ $parent }}</a></li>`;
            </script>
        @endforeach
    @endif
@endsection
