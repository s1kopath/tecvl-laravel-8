@extends('admin.layouts.app')
@section('page_title', __('Create Coupon'))
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection

@section('content')
    <div class="col-sm-12" id="coupon-add-container">
        <div class="card">
            <div class="card-body">
                <div class="row mt-3" id="theme-container">
                    <div class="col-sm-3 z-index-10" aria-labelledby="navbarDropdown">
                        <div class="card card-info mx-auto-sm" id="nav">
                            <ul class="nav flex-column nav-pills mr-neg-10" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <nav id="column_left">
                                    <div class="card-header margin-top-neg-15">
                                        <h5><a href="#" id="general-settings">{{ __('Coupon Create') }}</a></h5>
                                    </div>
                                    <ul class="nav nav-list flex-column">
                                        <li><a class="nav-link text-left tab-name arrows" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true" data-id = "General">{{ __('General') }}</a></li>
                                        <li><a class="nav-link text-left tab-name arrows" id="v-pills-restriction-tab" data-toggle="pill" href="#v-pills-restriction" role="tab" aria-controls="v-pills-restriction" aria-selected="true" data-id ="Usage Restriction">{{ __('Usage Restriction') }}</a></li>
                                        <li><a class="nav-link text-left tab-name arrows" id="v-pills-limit-tab" data-toggle="pill" href="#v-pills-limit" role="tab" aria-controls="v-pills-limit" aria-selected="true" data-id = "Usage Limit">{{ __('Usage Limit') }}</a></li>
                                    </ul>
                                </nav>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 ml-neg-30">
                        <div class="card card-info border-tl-radius-0">
                            <div class="card-header p-t-20">
                                <h5><a href="{{ route('coupon.index') }}" >{{ __('Coupon') }} </a> >> <span id="theme-title" ></span></h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('coupon.store') }}" method="post" class="form-horizontal">
                                    @csrf
                                    <div class="tab-content p-0 box-shadow-unset" id="topNav-v-pills-tabContent">
                                        {{-- General --}}
                                        <div class="tab-pane fade" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require" for="name">{{ __('Name') }}</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required maxlength="120" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ old('name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require" for="code">{{ __('Code') }}</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="{{ __('Code') }}" class="form-control" id="code" name="code" required maxlength="100" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ old('code') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require text-left" for="discount_type">{{ __('Discount Type') }}</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control select2 sl_common_bx" id="discount_type" name="discount_type" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                                <option value="Flat" {{ old('discount_type') == "Flat" ? 'selected' : '' }}>{{ __('Flat') }}</option>
                                                                <option value="Percentage" {{ old('discount_type') == "Percentage" ? 'selected' : '' }}>{{ __('Percentage') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-2">
                                                            <label class="control-label text-left require" for="discount_amount">{{ __('Discount Amount') }}</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="number" step="any" placeholder="{{ __('Discount Amount') }}" class="form-control" id="discount_amount" max="99999999" name="discount_amount" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" value="{{ old('discount_amount') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" id="max_discount">
                                                        <label class="col-sm-2 control-label text-left" for="maximum_discount_amount">{{ __('Maximum Discount') }}</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" step="any" placeholder="{{ __('Maximum Discount') }}" class="form-control" id="maximum_discount_amount" max="99999999" name="maximum_discount_amount" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" value="{{ old('maximum_discount_amount') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require" for="start_date">{{ __('Start Date') }}</label>
                                                        <div class="input-group bg-white date col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <i class="fas fa-calendar-alt input-group-text"></i>
                                                            </div>
                                                            <input class="form-control" id="start_date" type="text" name="start_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require" for="end_date">{{ __('End Date') }}</label>
                                                        <div class="input-group bg-white date col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <i class="fas fa-calendar-alt input-group-text"></i>
                                                            </div>
                                                            <input class="form-control" id="end_date" type="text" name="end_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label require" for="status">{{ __('Status') }}</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control select2 sl_common_bx" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                                <option value="Active" {{ old('status') == "Active" ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                                <option value="Inactive" {{ old('status') == "Inactive" ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer py-0">
                                                <div class="form-group row">
                                                    <label for="btn_save" class="col-sm-3 control-label"></label>
                                                    <div class="col-sm-12">
                                                        <button data-id="v-pills-restriction-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Next') }}</button>
                                                        <button type="button" class="btn btn-primary form-submit custom-btn-small float-right" disabled>{{ __('Previous') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Usage restriction --}}
                                        <div class="tab-pane fade" id="v-pills-restriction" role="tabpanel" aria-labelledby="v-pills-restriction-tab">
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="vendor_id">{{ __('Vendor') }}</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control select2 sl_common_bx" id="vendor_id" name="vendor_id">
                                                        <option value="">{{ __('Select One') }}</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option {{ old('vendor_id') == $vendor->id ? 'selected' : '' }} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if(isActive('Shop') ? false : false)
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label" for="shop_id">{{ __('Shop') }}</label>
                                                    <div class="col-sm-6">
                                                    <select class="form-control select2 sl_common_bx" id="shop_id" name="shop_id">
                                                        <option value="">{{ __('Select One') }}</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="item_id">{{ __('Items') }}</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control select2 sl_common_bx" id="item_id" name="item_ids[]" multiple>
                                                        {{-- Item load from ajax --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label text-left" for="minimum_spend">{{ __('Minimum Spend') }}</label>
                                                <div class="col-sm-6">
                                                    <input type="text"  placeholder="{{ __('Minimum Spend') }}" class="form-control positive-float-number" id="minimum_spend" name="minimum_spend" value="{{ old('minimum_spend') }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer py-0">
                                                <div class="form-group row">
                                                    <label for="btn_save" class="col-sm-3 control-label"></label>
                                                    <div class="col-sm-12">
                                                        <button data-id="v-pills-limit-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Next') }}</button>
                                                        <button data-id="v-pills-general-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Previous') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Usage limitation --}}
                                        <div class="tab-pane fade" id="v-pills-limit" role="tabpanel" aria-labelledby="v-pills-limit-tab">
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="usage_limit">{{ __('Usage Limit') }}</label>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="{{ __('Usage Limit') }}" class="form-control positive-int-number" id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer py-0">
                                                <div class="form-group row">
                                                    <label for="btn_save" class="col-sm-3 control-label"></label>
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary form-submit custom-btn-small float-right coupon-submit-button" id="footer-btn">{{ __('Save Changes') }}</button>
                                                        <a href="{{ route('coupon.index') }}" class="btn btn-primary form-submit custom-btn-small float-right coupon-submit-button">{{ __('Cancel') }}</a>
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
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        'use strict';
        var is_active = "{{ isActive('Shop') }}";
        var old_item = @json(old('item_ids'));
    </script>

    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/condition.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/theme.min.js') }}"></script>

    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date range picker Js -->
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/coupon.min.js') }}"></script>
@endsection
