@extends('admin.layouts.app')
@section('page_title', __('User verification'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="user-verification-container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.includes.general_settings_menu')
            </div>
            <div class="col-md-9">
                <div class="card card-info">
                    @if(session('errorMgs'))
                        <div class="alert alert-warning fade in alert-dismissable">
                            <strong>{{ __('Warning') }}!</strong> {{ session('errorMgs') }}. <a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <span id="smtp_head">
                        <div class="card-header">
                            <h5><a href="{{ route('sso.index') }}">{{ __('General Settings') }} </a> >> {{ __('User Verification') }}</h5>
                        </div>
                    </span>
                    <div class="card-body p-l-15">
                        <form action="{{ route('emailVerifySetting') }}" method="post" id="myform1" class="form-horizontal">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="custom-control custom-radio ml-4 my-2">
                                        <input type="radio" id="otp" name="verification" {{ preference('email') == 'otp' ? 'checked' : '' }} class="custom-control-input" value="otp">
                                        <label class="custom-control-label" for="otp">OTP</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-4 my-2">
                                        <input type="radio" id="token" name="verification" {{ preference('email') == 'token' ? 'checked' : '' }} class="custom-control-input" value="token">
                                        <label class="custom-control-label" for="token">{{ __('Token') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-4 my-2">
                                        <input type="radio" id="both" name="verification" {{ preference('email') == 'both' ? 'checked' : '' }} class="custom-control-input" value="both">
                                        <label class="custom-control-label" for="both">{{ __('Both') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="btn_save" class="col-sm-0 pl-4 ml-3 control-label"></label>
                                <button class="btn btn-primary custom-btn-small float-left" type="submit">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
