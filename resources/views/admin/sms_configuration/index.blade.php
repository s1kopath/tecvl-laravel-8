@extends('admin.layouts.app')
@section('page_title', __('SMS Setup'))
@section('css')
    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="sms-settings-container">
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
                            <h5><a href="{{ route('smsConfiguration.index') }}">{{ __('General Settings') }} </a> >> {{ __('SMS Setup') }}</h5>
                        </div>
                    </span>
                        <div class="card-body p-l-15">
                        <form action="{{ route('smsConfiguration.index') }}" method="post" id="myform1" class="form-horizontal">
                            <div class="card-body p-l-15">
                                <div class="d-flex justify-content-between">
                                    <div id="#headingOne">
                                        <h5 class="text-btn">{{ __('Twilio') }}</h5>
                                    </div>
                                </div>
                                <input type="hidden" name="type" value="twilio">
                                <hr class="mt-2">

                                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require">{{ __('Default') }}</label>
                                    <div class="col-sm-8">
                                        <select class="select form-control" name="is_default" id="default">
                                            <option value ='1' {{ isset($smsConfig->is_default) && $smsConfig->is_default == '1' ? 'selected' : "" }} >{{ __('Yes') }} </option>
                                            <option value ='0' {{ isset($smsConfig->is_default) && $smsConfig->is_default == '0' ? 'selected' : "" }} >{{ __('No') }} </option>
                                        </select>
                                        <label for="default" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require align-left">{{ __('Status') }}</label>

                                    <div class="col-sm-8">
                                        <select class="select form-control" name="status" id="status">
                                            <option value='Active' {{ isset($smsConfig->status) && $smsConfig->status == 'Active' ? 'selected':""}}>{{ __('Active') }}</option>
                                            <option value='Inactive' {{ isset($smsConfig->status) && $smsConfig->status== 'Inactive' ? 'selected':""}}>{{ __('Inactive') }}</option>
                                        </select>
                                        <label for="status" generated="true" class="error"></label>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require align-left">{{ __('ACCOUNT SID') }}</label>

                                    <div class="col-sm-8">
                                        <input type="text" value="{{ isset($smsConfig->key) && !empty($smsConfig->key) ? $smsConfig->key : '' }}" class="form-control" name="key" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require align-left">{{ __('AUTH TOKEN') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ isset($smsConfig->secret_key) && !empty(isset($smsConfig->secret_key)) ? $smsConfig->secret_key : '' }}" class="form-control" name="secret_key" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require align-left">{{ __('Default Number') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ isset($smsConfig->default_number) && !empty($smsConfig->default_number) ? $smsConfig->default_number : '' }}" class="form-control" name="default_number" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
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
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
