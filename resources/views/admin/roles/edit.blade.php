@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Role')]))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="role-edit-container">
    <div class="card">
      <div class="card-header">
        <h5><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a> >> {{ __('Edit Role') }}</h5>
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
              <form action="{{ route('roles.update', ['id' => $roles->id]) }}" method="post" id="roleEdit" class="form-horizontal">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="name">{{ __('Name') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required pattern="^[a-zA-Z ]*$" value="{{ !empty(old('name')) ? old('name') : $roles->name }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" oninput="this.setCustomValidity('')" data-pattern = "{{ __('Only alphabet and white space are allowed.') }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-label require" for="slug">{{ __('Slug') }}</label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="{{ __('Slug') }}" class="form-control <?= in_array($roles->slug, defaultRoles()) ? 'readonly' : '' ?>" id="slug" name="slug" <?= in_array($roles->slug, defaultRoles()) ? 'readonly' : '' ?> value="{{ !empty(old('slug')) ? old('slug') : $roles->slug }}" required pattern="^[a-zA-Z\-]*$" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Only alphabet and white space are allowed.') }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label" for="type">{{ __('Type') }}</label>
                  <div class="col-sm-6">
                    <select class="form-control select2" name="type" id="type" <?= in_array($roles->slug, defaultRoles()) ? 'disabled' : '' ?>>
                      <option value="global" {{ old('type', $roles->type) == 'global' ? 'selected' : ''}}>{{ __('Global') }}</option>
                      <option value="vendor" {{ old('type', $roles->type) == 'vendor' ? 'selected' : ''}}>{{ __('Vendor') }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2  control-labe" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-6">
                    <textarea type="text" placeholder="{{ __('Description') }}" class="form-control" id="description" name="description">{{ !empty(old('description')) ? old('description') : $roles->description }}</textarea>
                  </div>
                </div>

                <div class="col-sm-8 px-0">
                  <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Update') }}</span></button>
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
<script src="{{ asset('public/dist/js/jquery.validate.min.js') }}"></script>
{!! translateValidationMessages() !!}
<script src="{{ asset('public/dist/js/custom/roles.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
