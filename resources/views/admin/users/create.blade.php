@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('User')]))
@section('css')
    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
  <!-- Main content -->
  <div class="col-sm-12" id="user-add-container">
    <div class="card">
      <div class="card-header">
        <h5> <a href="{{ route('users.index') }}">{{ __('Users') }} </a> >>{{ __('Create :x', ['x' => __('User')]) }}</h5>
      </div>
      <div class="card-block table-border-style">
        <div class="row form-tabs">
          <form action="{{ route('users.store') }}" method="post" id="userAdd" class="form-horizontal col-sm-12" enctype="multipart/form-data" onsubmit="return passwordValidation()">
            @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('User')]) }}</a>
              </li>
            </ul>
            <div class="col-sm-12 tab-content form-edit-con" id="myTabContent">
              <div class="tab-pane fade show active form-con" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-sm-9">
                    <div class="form-group row">
                      <label for="name" class="control-label require pl-3">{{ __('Name') }}
                      </label>
                      <div class="col-sm-12">
                        <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" required minlength="3" value="{{ old('name') }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Name'), 'x' => 3]) }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="email" class="control-label require pl-3">{{ __('Email') }}</label>
                        <div class="col-sm-12">
                          <input type="email" class="form-control form-width" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="password" class="col-sm-2 control-label require">{{ __('Password') }}</label>
                        <div class="col-sm-12">
                          <input type="password" class="form-control password-validation form-width" id="password" name="password"  placeholder="{{ __('Password') }}" value="{{ old('password') }}" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Password'), 'x' => 5]) }}">
                          <span class="password-validation-error mt-1 d-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 control-label require">{{ __('Role') }}</label>
                          <div class="col-sm-12">
                              <select class="form-control select2" name="role_ids[]" id="role_id" >
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                @endforeach
                              </select>
                          </div>
                    </div>

                    <div class="form-group row">
                      <label for="Status" class="control-label pl-3">{{ __('Status') }}</label>
                        <div class="col-sm-12">
                            <select class="form-control select2" name="status" id="status">
                              <option value="Pending" {{ old('status') == "Pending" ? 'selected' : ''}}>{{ __('Pending') }}</option>
                              <option value="Active" {{ old('status') == "Active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                              <option value="Inactive" {{ old('status') == "Inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 control-label pl-3">{{ __('Picture') }}</label>
                      <div class="col-sm-12">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input form-control" name="attachment" id="validatedCustomFile" accept="image/*" >
                          <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row" id="divNote">
                        <label class="control-label"></label>
                        <div class="col-sm-12" id='note_txt_1'>
                            <div class="d-flex">
                                <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                <ul>
                                    <li>{{ __('Allowed File Extensions: jpg, png, gif, bmp') }}</li>
                                    <li>{{ __('Maximum File Size :x', ['x' => preference('file_size') . 'MB']) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                      <label class="control-label"></label>
                      <div class="col-sm-12">
                        <div class="checkbox checkbox-primary checkbox-fill d-inline">
                          <input type="checkbox" class="form-control" name="send_mail" id="checkbox-p-fill-1">
                          <label for="checkbox-p-fill-1" class="cr">{{ __('Send email to the user') }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-10 px-0 m-l-5 btn-align">
                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                <a href="{{ route('users.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
              </div>
            </div>
            <!-- Modal -->
         </form>
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
<script>
    var uppercase = "{!! $uppercase !!}";
    var lowercase = "{!! $lowercase !!}";
    var number = "{!! $number !!}";
    var symbol = "{!! $symbol !!}";
    var length = "{!! $length !!}";
    var currentUrl = "{!! url()->full() !!}";
    var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
</script>
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/user.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
