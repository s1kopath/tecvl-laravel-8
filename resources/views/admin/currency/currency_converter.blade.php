@extends('admin.layouts.app')
@section('page_title', __('Currency Converter Setup'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="currency-converter-settings-container">
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
                            <h5><a href="{{ route('currency.convert') }}">{{ __('General Settings') }} </a> >> {{ __('Currency Converter Setup') }}</h5>
                        </div>
                    </span>
                    <div class="card-body p-l-15">
                        <form action="{{ route('currency.convert') }}" method="post" id="myform1" class="form-horizontal">
                            <div class="card-body p-l-15">
                                <div class="d-flex justify-content-between">
                                    <div id="#headingOne">
                                        <h5 class="text-btn">{{ __('Currency Converter Api') }}</h5>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" {{ isset($currency_converter_api->status) && $currency_converter_api->status == "Active" ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customRadio1">{{ __('Click this to active') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-2">

                                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require">{{ __('Api Key') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ isset($currency_converter_api->api_key) ? $currency_converter_api->api_key : ''}}" class="form-control" name="currency_converter_api_api_key">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-l-15">
                                <div class="d-flex justify-content-between">
                                    <div id="#headingOne">
                                        <h5 class="text-btn">{{ __('Exchange Rate Api') }}</h5>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" {{ isset($exchange_rate_api->status) && $exchange_rate_api->status == "Active" ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customRadio2">{{ __('Click this to active') }}</label>
                                        </div>

                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label require">{{ __('Api Key') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ isset($exchange_rate_api->api_key) ? $exchange_rate_api->api_key : ''}}" class="form-control" name="exchange_rate_api_api_key">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="exchange_rate_api_status" id="exchange_rate_api" value="{{ isset($exchange_rate_api->status) ? $exchange_rate_api->status : 'Inactive'}}">
                            <input type="hidden" name="currency_converter_api_status" id="currency_converter_api" value="{{ isset($currency_converter_api->status) ? $currency_converter_api->status : 'Inactive'}}">
                            <div class="form-group row">
                                <label for="btn_save" class="col-sm-0 pl-4 ml-3 control-label"></label>
                                <button class="btn btn-primary custom-btn-small float-left" type="submit">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
  <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
