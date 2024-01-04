@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Role')]))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="role-add-container">
    <div class="card">
      <div class="card-header">
        <h5><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a> >> {{ __('Add New Role') }}</h5>
        <div class="card-header-right">

        </div>
      </div>
      <div class="card-body table-border-style" >
        <div class="form-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active text-uppercase">{{ __('Role Information') }}</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <form action="{{ route('roles.store') }}" method="post" id="roleStore" class="form-horizontal">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="name">{{ __('Name') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required pattern="^[a-zA-Z ]*$" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Only alphabet and white space are allowed.') }}" data-related="slug" value="{{ old('name') }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="name">{{ __('Slug') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Slug') }}" class="form-control" id="slug" name="slug" required pattern="^[a-zA-Z\-]*$" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Only alphabet and white space are allowed.') }}" value="{{ old('slug') }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label" for="type">{{ __('Type') }}</label>
                  <div class="col-sm-6">
                    <select class="form-control select2" name="type" id="type">
                      <option value="global" {{ old('type') == "global" ? 'selected' : ''}}>{{ __('Global') }}</option>
                      <option value="vendor" {{ old('type') == "vendor" ? 'selected' : ''}}>{{ __('Vendor') }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-labe" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-6">
                      <textarea type="text" placeholder="{{ __('Description') }}" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                  </div>
                </div>

                <div class="col-sm-8 px-0">
                  <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                  <a href="{{ route('roles.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
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
<script src="{{ asset('public/dist/js/custom/roles.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
