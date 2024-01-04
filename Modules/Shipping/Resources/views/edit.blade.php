@extends('admin.layouts.app')
@section('page_title', __('Edit Shipping'))
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="shipping-edit-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('shipping.index') }}">{{ __('Shippings') }}</a> >> {{ __('Edit Shipping') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active text-uppercase">{{ __('Shipping Information') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('shipping.update', ['id' => $shipping->id]) }}" method="post" class="form-horizontal">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="name">{{ __('Name') }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required maxlength="120" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('name')) ? old('name') : $shipping->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="cost">{{ __('Cost') }}</label>
                                    <div class="col-sm-6">
                                        <input type="number" step="any" max="99999999" placeholder="{{ __('Cost') }}" class="form-control remove-dash" id="price" name="cost" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" value="{{ !empty(old('cost')) ? formatCurrencyAmount(old('cost')) : formatCurrencyAmount($shipping->cost) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="minimum_amount">{{ __('Minimum Amount') }}</label>
                                    <div class="col-sm-6">
                                        <input type="number" step="any" max="99999999" placeholder="{{ __('Minimum Amount') }}" class="form-control remove-dash" id="minimum_amount" name="minimum_amount" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" value="{{ !empty(old('minimum_amount')) ? formatCurrencyAmount(old('minimum_amount')) : formatCurrencyAmount($shipping->minimum_amount) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="status">{{ __('Status') }}</label>
                                    <div class="col-sm-6">
                                    <select class="form-control select2 sl_common_bx" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                        <option value="">{{ __('Select One') }}</option>
                                        <option value="Active" {{ old('status', $shipping->status) == "Active" ? 'selected' : '' }}>{{ __('Active') }}</option>
                                        <option value="Inactive" {{ old('status', $shipping->status) == "Inactive" ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-8 px-0">
                                    <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                    <a href="{{ route('shipping.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/shipping.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>

@endsection
