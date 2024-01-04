@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Package')]))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="package-edit-container">
    <div class="card">
      <div class="card-header">
        <h5><a href="{{ route('package.index') }}">{{ __('Packages') }}</a> >> {{ __('Edit :x', ['x' => __('Package')]) }}</h5>
      </div>
      <div class="card-body table-border-style">
        <div class="form-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active text-uppercase">{{ __('Package Information') }}</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <form action="{{ route('package.update', ['id' => $package->id]) }}" method="post" id="packageUpdate" class="form-horizontal">
                @csrf

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="name">{{ __('Name') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('name')) ? old('name') : $package->name }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="code">{{ __('Code') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Code') }}" class="form-control" name="code" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('code')) ? old('code') : $package->code }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-6">
                    <textarea placeholder="{{ __('Description') }}" id="description" class="form-control" name="description" required maxlength="5000" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">{{ !empty(old('description')) ? old('description') : $package->description }}</textarea>
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2  control-label" for="params">Params</label>
                    <div class="col-sm-6">
                      <textarea placeholder="Params" id="params" class="form-control" name="params">{{ !empty(old('params')) ? old('params') : $package->params }}</textarea>
                      <span class="badge badge-info pb-1">{{ __('Example') }}</span> <small class="text-secondary">{"name":"Package1", "code":"t4yf45dd", "price":44999}</small>
                    </div>
                  </div>

                <div class="form-group row">
                    <label class="col-sm-2  control-label require" for="price">{{ __('Price') }}</label>
                    <div class="col-sm-6">
                      <input type="number" step="any" placeholder="{{ __('Price') }}" id="price" class="form-control" name="price" required max="99999999" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('price')) ? old('price') : number_format((float)$package->price, $digit['decimal_digits'], '.', '') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2  control-label require" for="sort_order">{{ __('Sort Order') }}</label>
                    <div class="col-sm-6">
                      <input type="number" placeholder="{{ __('Sort Order') }}" id="sort_order" class="form-control" name="sort_order" required min="0" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min="{{ __('This value must be greater than 0.') }}" value="{{ !empty(old('sort_order')) ? old('sort_order') : $package->sort_order }}">
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label" for="billingCycle">{{ __('Billing Cycle') }}</label>
                  <div class="col-sm-6">
                    <select class="form-control select2" id="billing_cycle" name="billing_cycle">
                        <option value="monthly" {{ old('billing_cycle', $package->billing_cycle) == "monthly" ? 'selected' : ''}}>{{ __('Monthly') }}</option>
                        <option value="yearly" {{ old('billing_cycle', $package->billing_cycle) == "yearly" ? 'selected' : ''}}>{{ __('Yearly') }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="isPrivate">{{ __('Private') }}</label>
                    <div class="col-sm-6">
                        <input type="hidden" name="is_private" value="0">
                        <div class="switch d-inline m-r-10">
                            <input class="status" type="checkbox" value="1" name="is_private"  id="is_private" {{ $package->is_private == 1 ? 'checked' : ''  }} >
                            <label for="is_private" class="cr"></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="status">{{ __('Status') }}</label>
                    <div class="col-sm-6">
                      <select class="form-control select2" id="status" name="status">
                        <option value="pending" {{ old('status', $package->status) == "pending" ? 'selected' : ''}}>{{ __('Pending') }}</option>
                        <option value="inactive" {{ old('status', $package->status) == "inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                        <option value="active" {{ old('status', $package->status) == "active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                      </select>
                    </div>
                </div>

                <div class="col-sm-8 px-0">
                  <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Update') }}</span></button>
                  <a href="{{ route('package.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
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
<script src="{{ asset('public/dist/js/custom/package.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
