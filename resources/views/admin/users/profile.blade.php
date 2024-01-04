@extends('admin.layouts.app')
@section('page_title', __('User Profile'))
@section('css')
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/lightbox/css/lightbox.min.css') }}">
@endsection
@section('content')
    <div class="col-sm-12" id="user-edit-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('users.index') }}">{{ __('Users') }}</a> >> {{ $user->name }} >>
                    {{ __('Profile') }}</h5>
            </div>
            <div class="card-body p-0" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('User')]) }}</a>
                        </li>
                        @if (in_array('App\Http\Controllers\UserController@updatePassword', $prms))
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab"
                                    data-rel="{{ $user->id }}" href="#profile" role="tab" aria-controls="profile"
                                    aria-selected="false">{{ __('Update Password') }}</a>
                            </li>
                        @endif
                    </ul>
                    <div class="col-sm-12 tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action='{{ route('users.updateProfile', ['id' => Auth::user()->id]) }}' method="post"
                                class="form-horizontal" id="userEdit" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label require pr-0">{{ __('Name') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control"
                                                    id="name" name="name" required minlength="3"
                                                    value="{{ !empty(old('name')) ? old('name') : $user->name }}"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Name'), 'x' => 3]) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email"
                                                class="col-sm-2 col-form-label require">{{ __('Email') }}</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ !empty(old('email')) ? old('email') : $user->email }}"
                                                    placeholder="{{ __('Email') }}" required
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-type-mismatch="{{ __('Enter a valid :x.', ['x' => strtolower(__('Email'))]) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="role_id" class="col-sm-2 control-label">{{ __('Role') }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" disabled name="role_ids[]"
                                                    id="role_id">
                                                    @foreach ($roles as $key => $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ in_array($role->id, $roleIds) ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Status"
                                                class="col-sm-2 col-form-label require">{{ __('Status') }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" disabled name="status" id="status">
                                                    <option value="Pending"
                                                        {{ old('status', $user->status) == 'Pending' ? 'selected' : '' }}>
                                                        {{ __('Pending') }}</option>
                                                    <option value="Active"
                                                        {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>
                                                        {{ __('Active') }}</option>
                                                    <option value="Inactive"
                                                        {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>
                                                        {{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="designation"
                                                class="col-sm-2 col-form-label pr-0">{{ __('Designation') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="{{ __('Designation') }}"
                                                    class="form-control" id="designation" name="designation"
                                                    value="{{ !empty(old('designation')) ? old('designation') : $user->designation }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pr-0">{{ __('Description') }}
                                            </label>
                                            <div class="col-sm-10 editor">
                                                <textarea class="form-control" name="description" id="description">{{ $user->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="facebook"
                                                class="col-sm-2 col-form-label pr-0">{{ __('facebook') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="url" placeholder="{{ __('https://www..com') }}"
                                                    class="form-control" id="facebook" name="facebook"
                                                    value="{{ !empty(old('facebook')) ? old('facebook') : $user->facebook }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="twitter" class="col-sm-2 col-form-label pr-0">{{ __('twitter') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="url" placeholder="{{ __('twitter') }}"
                                                    class="form-control" id="twitter" name="twitter"
                                                    value="{{ !empty(old('twitter')) ? old('twitter') : $user->twitter }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="instagram"
                                                class="col-sm-2 col-form-label pr-0">{{ __('Instagram') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="url" placeholder="{{ __('Instagram') }}"
                                                    class="form-control" id="instagram" name="instagram"
                                                    value="{{ !empty(old('instagram')) ? old('instagram') : $user->instagram }}">
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">{{ __('Attachment') }}</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="attachment"
                                                        id="validatedCustomFile">
                                                    <label class="custom-file-label overflow_hidden"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="divNote">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10" id='note_txt_1'>
                                                <span class="badge badge-danger">{{ __('Note') }}!</span>
                                                {{ __('Allowed File Extensions: jpg, png, gif, bmp') }}
                                            </div>
                                            <div class="col-md-9" id='note_txt_2'>
                                            </div>
                                        </div>
                                    </div>

                                    @if (!empty(getUserProfilePicture($user->id, 0)))
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="col-sm-9">
                                                    <div class="fixSize">
                                                        <a class="cursor_pointer"
                                                            href='{{ getUserProfilePicture($user->id, 0) }}'
                                                            data-lightbox="image-1"> <img
                                                                class="profile-user-img img-responsive fixSize"
                                                                src='{{ getUserProfilePicture($user->id, 0) }}' alt=""
                                                                class="img-thumbnail attachment-styles"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-10 px-0 m-l-5">
                                    <button class="btn btn-primary custom-btn-small" type="submit"
                                        id="btnSubmit">{{ __('Update') }}</button>
                                    <a href="{{ route('users.index') }}"
                                        class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action='{{ route('users.profilePassword', ['id' => $user->id]) }}'
                                        class="form-horizontal" id="password-form" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="password"
                                                class="col-sm-2 text-left col-form-label require">{{ __('Password') }}</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="{{ __('Password') }}" value="{{ old('password') }}"
                                                    required minlength="5"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Password'), 'x' => 5]) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1">
                                            <label for="password"
                                                class="col-sm-2 text-left col-form-label require">{{ __('Confirm Password') }}</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" placeholder="{{ __('Confirm Password') }}"
                                                    value="{{ old('confirm_password') }}" required minlength="5"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" class="form-control" name="send_mail"
                                                        id="checkbox-p-fill-1">
                                                    <label for="checkbox-p-fill-1"
                                                        class="cr">{{ __('Send email to the user') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 px-0 m-l-5">
                                            <button class="btn btn-primary custom-btn-small" type="submit"
                                                id="btnSubmit1">{{ __('Submit') }}</button>
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
@section('js')
    <script src="{{ asset('public/dist/plugins/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var user_id = '{{ $user->id }}';
    </script>
    <script src="{{ asset('public/dist/js/custom/user.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
