@extends('admin.layouts.app')
@section('page_title', __('SSO Service'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="sso-settings-container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.includes.general_settings_menu')
            </div>
            <div class="col-md-9">
                <div class="card card-info">
                    @if(session('errorMgs'))
                        <div class="alert alert-warning fade in alert-dismissable">
                            <strong>Warning!</strong> {{ session('errorMgs') }}. <a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <span id="smtp_head">
                        <div class="card-header">
                            <h5><a href="{{ route('sso.index') }}">{{ __('General Settings') }} </a> >> {{ __('SSO Service') }}</h5>
                        </div>
                    </span>
                    <div class="card-body p-l-15">
                        <form action="{{ route('sso.index') }}" method="post" id="myform1" class="form-horizontal">
                            @csrf
                            @php
                            $requiredData = !empty($preference) ? json_decode($preference) : [];
                             $msg = __('This field is required.');
                            @endphp
                            <div class="card-body p-l-15">
                                <div class="d-flex justify-content-between">
                                    <div id="#headingOne">
                                        <h5 class="text-btn">{{ __('Google') }}</h5>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label align-left {{ in_array("Google", $requiredData) ? 'require' : '' }}">{{ __('Client ID') }}</label>

                                    <div class="col-sm-8">
                                        @if(in_array("Google", $requiredData))
                                        <input type="text" value="{{ env('GOOGLE_CLIENT_ID') }}" class="form-control removeSpace" name="data[google][client_id]" required oninvalid="this.setCustomValidity($msg)">
                                        @else
                                            <input type="text" value="{{ env('GOOGLE_CLIENT_ID') }}" class="form-control removeSpace" name="data[google][client_id]">
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label align-left {{ in_array("Google", $requiredData) ? 'require' : '' }}">{{ __('Client Secret') }}</label>

                                    <div class="col-sm-8">
                                        @if(in_array("Google", $requiredData))
                                        <input type="text" value="{{ env('GOOGLE_CLIENT_SECRET') }}" class="form-control removeSpace" name="data[google][client_secret]" required oninvalid="this.setCustomValidity($msg)">
                                        @else
                                            <input type="text" value="{{ env('GOOGLE_CLIENT_SECRET') }}" class="form-control removeSpace" name="data[google][client_secret]">
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div id="#headingOne">
                                        <h5 class="text-btn">{{ __('Facebook') }}</h5>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label align-left {{ in_array("Facebook", $requiredData) ? 'require' : '' }}">{{ __('Client ID') }}</label>

                                    <div class="col-sm-8">
                                        @if(in_array("Facebook", $requiredData))
                                            <input type="text" value="{{ env('FACEBOOK_CLIENT_ID') }}" class="form-control removeSpace" name="data[facebook][client_id]" required oninvalid="this.setCustomValidity($msg)">
                                        @else
                                        <input type="text" value="{{ env('FACEBOOK_CLIENT_ID') }}" class="form-control removeSpace" name="data[facebook][client_id]">
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label align-left {{ in_array("Facebook", $requiredData) ? 'require' : '' }}">{{ __('Client Secret') }}</label>

                                    <div class="col-sm-8">
                                        @if(in_array("Facebook", $requiredData))
                                            <input type="text" value="{{ env('FACEBOOK_CLIENT_SECRET') }}" class="form-control removeSpace" name="data[facebook][client_secret]" required oninvalid="this.setCustomValidity($msg)">
                                        @else
                                        <input type="text" value="{{ env('FACEBOOK_CLIENT_SECRET') }}" class="form-control removeSpace" name="data[facebook][client_secret]">
                                        @endif
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
            <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
