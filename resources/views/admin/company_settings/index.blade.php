@extends('admin.layouts.app')
@section('page_title', __('Company Settings'))
@section('css')
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    {{-- Media manager --}}
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="company-settings-container">
        <div class="row">
            <div class="col-sm-3">
                @include('admin.layouts.includes.company_details_menu')
            </div>
            <div class="col-sm-9">
                <div class="card card-info">
                    <div class="card-header">
                        <h5><a href="{{ route('companyDetails.setting') }}">{{ __('Company Settings') }} </a></h5>
                        <div class="card-header-right">

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('companyDetails.setting') }}" method="post" id="settingForm"
                            class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="form-group row p-t-10">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Name') }}
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_name" id="company_name"
                                        value="{{ isset($companyData['company']['company_name']) ? $companyData['company']['company_name'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label id='siteshortlabel' class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Site Short Name') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="text" name="site_short_name" readonly="readyonly"
                                        value="{{ isset($companyData['company']['site_short_name']) ? $companyData['company']['site_short_name'] : '' }}"
                                        id="site_short_name" class="form-control" required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row marginTop">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Email') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="company_email" id="company_email"
                                        value="{{ isset($companyData['company']['company_email']) ? $companyData['company']['company_email'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                        data-type-mismatch="{{ __('Enter a valid :x.', ['x' => strtolower(__('Email'))]) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Phone') }}
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control phone-number" name="company_phone"
                                        id="company_phone"
                                        value="{{ isset($companyData['company']['company_phone']) ? $companyData['company']['company_phone'] : '' }}"
                                        required minlength="8"
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                        data-min-length="{{ __(':x should contain at least :y digits.', ['x' => __('Phone Number'), 'y' => 8]) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="d-inline control-label require" for="inputEmail3">
                                        {{ __('Tax Id') }}
                                    </label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text"
                                        value="{{ isset($companyData['company']['company_gstin']) ? $companyData['company']['company_gstin'] : '' }}"
                                        class="form-control" name="company_tax_id" required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Street') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_street" id="company_street"
                                        value="{{ isset($companyData['company']['company_street']) ? $companyData['company']['company_street'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('City') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_city" id="company_city"
                                        value="{{ isset($companyData['company']['company_city']) ? $companyData['company']['company_city'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('State') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_state" id="company_state"
                                        value="{{ isset($companyData['company']['company_state']) ? $companyData['company']['company_state'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Zip code') }}
                                </label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_zip_code" id="company_zip_code"
                                        value="{{ isset($companyData['company']['company_zip_code']) ? $companyData['company']['company_zip_code'] : '' }}"
                                        required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">
                                    {{ __('Country') }}
                                </label>

                                <div class="col-sm-7">
                                    <select class="form-control js-example-basic-single" name="company_country"
                                        id="company_country">
                                        @foreach ($countryData as $data)
                                            <option value="{{ $data->id }}"
                                                <?= isset($companyData['company']['company_country']) && $companyData['company']['company_country'] == $data->id ? 'selected' : '' ?>>
                                                {{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label id="default-language" class="col-sm-3 control-label "
                                    for="inputEmail3">{{ __('Default language') }}</label>

                                <div class="col-sm-7">
                                    <select name="dflt_lang" id="dflt_lang" class="form-control js-example-basic-single">
                                        @foreach ($languageData as $language)
                                            <option data-rel="{{ $language->id }}" value="{{ $language->short_name }}"
                                                {{ $companyData['company']['dflt_lang'] == $language->short_name ? 'selected' : '' }}>
                                                {{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label id="default-currency" class="col-sm-3 control-label "
                                    for="inputEmail3">{{ __('Default currency') }}</label>

                                <div class="col-sm-7">
                                    <select class="form-control js-example-basic-single" name="dflt_currency_id">
                                        @foreach ($currencyData as $data)
                                            <option value="{{ $data->id }}"
                                                <?= isset($companyData['company']['dflt_currency_id']) && $companyData['company']['dflt_currency_id'] == $data->id ? 'selected' : '' ?>>
                                                {{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="logo">
                                <label class="col-sm-3 control-label " for="inputEmail3">{{ __('Logo') }}</label>
                                <div class="col-sm-7">
                                    <div class="custom-file" data-val="single" data-returntype="ids" id="image-status">
                                        <input class="custom-file-input is-image form-control" name="company_logo_id">
                                        <label class="custom-file-label overflow_hidden"
                                            for="validatedCustomFile">{{ __('Upload image') }}</label>
                                    </div>
                                    <div class="preview-image" id="company_logo">
                                        <!-- img will be shown here -->
                                        <div class="d-flex flex-wrap mt-2">
                                            <div class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                                <img width="80" class="p-1" src="{{ $companyData['logo'] }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-1" id="note_txt_1">
                                        <div class="d-flex mt-1 mb-3">
                                            <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                            <ul>
                                                <li>{{ __('Allowed File Extensions: jpg, jpeg, png') }}</li>
                                                <li>{{ __('Maximum File Size :x', ['x' => preference('file_size') . 'MB']) }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="iconTop">
                                <label class="col-sm-3 control-label " for="inputEmail3">{{ __('Favicon') }}</label>
                                <div class="col-sm-7">
                                    <div class="custom-file" data-val="single" data-returntype="ids" id="image-status">
                                        <input class="custom-file-input is-image form-control" name="company_icon_id">

                                        <label class="custom-file-label overflow_hidden"
                                            for="validatedCustomFile">{{ __('Upload image') }}</label>
                                    </div>
                                    <div class="preview-image" id="company_favicon">
                                        <!-- img will be shown here -->
                                        <div class="d-flex flex-wrap mt-2">
                                            <div class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                                <img width="80" class="old-img" class="p-1"
                                                    src="{{ $companyData['icon'] }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-1" id="note_txt_1">
                                        <div class="d-flex mt-1 mb-3">
                                            <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                            <ul>
                                                <li>{{ __('Allowed File Extensions: ico') }}</li>
                                                <li>{{ __('Maximum File Size :x', ['x' => preference('file_size') . 'MB']) }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="addTop">
                                <label for="btn_save" class="col-sm-0 pl-2 ml-2 control-label"></label>
                                <button type="submit" class="btn btn-primary custom-btn-small float-left"
                                    id="btnSubmits">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')

@endsection

@section('js')
    {{-- Using local does not have the required file --}}
    <script>
        let imageSize = {{ preference('file_size') }}
    </script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>

@endsection
