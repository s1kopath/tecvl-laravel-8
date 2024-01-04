@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('User')]))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
@endsection
@section('content')
<div class="col-sm-12" id="user-edit-container">
  <div class="card">
    <div class="card-header">
      <h5><a href="{{ route('users.index') }}">{{ __('Users') }}</a> >> {{ $user->name}} >> {{ __('Profile') }}</h5>
    </div>
    <div class="card-body p-0" id="no_shadow_on_card">
        @include('admin.layouts.includes.user_menu')
      <div class="col-sm-12 m-t-20 form-tabs">
        <ul class="nav nav-tabs " id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('User')]) }}</a>
          </li>
            @if (in_array('App\Http\Controllers\UserController@updatePassword', $prms))
                <li class="nav-item">
                    <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" data-rel="{{ $user->id }}" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('Update Password') }}</a>
                </li>
            @endif
        </ul>

        <div class="col-md-12 tab-content form-edit-con" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form action='{{ route("users.update", ["id" => $user->id]) }}' method="post" class="form-horizontal" id="userEdit" enctype="multipart/form-data">
              <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
              <div class="row">
                <div class="col-md-3 col-xl-2 mt-2">
                    <div class="form-group">
                      <div class="col-md-9">
                        <div class="fixSize user-img-con">
                          <a class="cursor_pointer" href='{{ $user->fileUrl() }}'  data-lightbox="image-1"> <img class="profile-user-img img-responsive fixSize rounded-circle" src='{{ $user->fileUrl() }}' alt="" class="img-thumbnail attachment-styles"></a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-sm-8 form-container">
                  <div class="form-group row">
                    <label for="first_name" class="col-form-label require pl-3">{{ __('Name') }}
                      </label>
                      <div class="col-sm-12">
                        <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" required minlength="3" value="{{ !empty(old('name')) ? old('name') : $user->name }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Name'), 'x' => 3]) }}">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-form-label require pl-3">{{ __('Email') }}</label>
                    <div class="col-sm-12">
                      <input type="email" class="form-control form-width" id="email" name="email" value="{{ !empty(old('email')) ? old('email') : $user->email }}" placeholder="{{ __('Email') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="role_id" class="control-label require pl-3">{{ __('Role') }}</label>
                      <div class="col-sm-12">
                          <select class="form-control select2" name="role_ids[]" id="role_id">
                            @foreach ($roles as $key => $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $roleIds) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                  <div class="form-group row">
                    <label for="Status" class="col-form-label require pl-3">{{ __('Status') }}</label>
                    <div class="col-sm-12">
                      <select class="form-control select2" name="status" id="status">
                        <option value="Pending" {{ old('status', $user->status) == 'Pending' ? 'selected' : ''}}>{{ __('Pending') }}</option>
                        <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : ''}}>{{ __('Active') }}</option>
                        <option value="Inactive" {{ old('status', $user->status) == 'Inactive' ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                        <option value="Deleted" {{ old('status', $user->status) == 'Deleted' ? 'selected' : ''}}>{{ __('Deleted') }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="control-label pl-3">{{ __('Picture') }}</label>
                    <div class="col-sm-12">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attachment" id="validatedCustomFile" accept="image/*">
                        <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row" id="divNote">
                    <div class="col-sm-10" id='note_txt_1'>
                      <div class="d-flex">
                            <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                            <ul>
                                <li>{{ __('Allowed File Extensions: jpg, png, gif, bmp') }}</li>
                                <li>{{ __('Maximum File Size :x', ['x' => preference('file_size') . 'MB']) }}</li>
                            </ul>
                      </div>
                    </div>
                    <div class="col-md-9" id='note_txt_2'>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row px-0">
                 <label class="col-sm-2 control-label"></label>
                 <div class="col-sm-9 btn-con">
                    <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit">{{ __('Update') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                 </div>
              </div>
            </form>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-sm-12">
                <form action='{{ route("users.password", ["id" => $user->id]) }}' class="form-horizontal" id="password-form" method="POST" onsubmit="return passwordValidation()">
                  <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token2">
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 text-left col-form-label require">{{ __('Password') }}</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control password-validation" id="password" name="password"  placeholder="{{ __('Password') }}" value="{{ old('password') }}" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Password'), 'x' => 5]) }}">
                      <div class="password-validation-error mt-1"></div>
                    </div>
                  </div>

                  <div class="form-group row mb-1">
                    <label for="password" class="col-sm-2 text-left col-form-label require">{{ __('Confirm Password') }}</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="{{ __('Confirm Password') }}" value="{{ old('confirm_password') }}" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}'
                      )">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <div class="checkbox checkbox-primary checkbox-fill d-inline">
                        <input type="checkbox" class="form-control" name="send_mail" id="checkbox-p-fill-1">
                        <label for="checkbox-p-fill-1" class="cr">{{ __('Send email to the user') }}</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-10 px-0 m-l-5">
                    <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit1">{{ __('Submit') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@php
    $uppercase = $lowercase = $number = $symbol = $length = 0;
    if(env('PASSWORD_STRENGTH') != null && env('PASSWORD_STRENGTH') != '') {
        $length = filter_var(env('PASSWORD_STRENGTH'), FILTER_SANITIZE_NUMBER_INT);
        $conditions = explode('|', env('PASSWORD_STRENGTH'));
        $uppercase = in_array("UPPERCASE", $conditions);
        $lowercase = in_array("LOWERCASE", $conditions);
        $number = in_array("NUMBERS", $conditions);
        $symbol = in_array("SYMBOLS", $conditions);
    }
@endphp
@section('js')
<script src="{{asset('public/dist/plugins/lightbox/js/lightbox.min.js')}}"></script>
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
    "use strict";
    var user_id = '{{ $user->id }}';
    var uppercase = "{!! $uppercase !!}";
    var lowercase = "{!! $lowercase !!}";
    var number = "{!! $number !!}";
    var symbol = "{!! $symbol !!}";
    var length = "{!! $length !!}";
    var currentUrl = "{!! url()->full() !!}";
    var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
</script>
<script src="{{ asset('public/dist/js/custom/user.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
