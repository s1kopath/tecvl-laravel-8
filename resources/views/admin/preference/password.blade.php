@extends('admin.layouts.app')
@section('page_title', __('Password Preferences'))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <!-- Main content -->
<div class="col-sm-12" id="password-preference-settings-container">
    <div class="row">
        <div class="col-sm-3">
            @include('admin.layouts.includes.preference_menu')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Password Preferences') }}</h5>
                    <div class="card-header-right">

                    </div>
                </div>
                <div class="card-block table-border-style">
                    <form action="{{ route('preferences.password') }}" method="post" class="form-horizontal" id="preference_form">
                        {!! csrf_field() !!}
                        @php
                            $uppercase = $lowercase = $number = $symbol = $length = false;
                            if(env('PASSWORD_STRENGTH') != null && env('PASSWORD_STRENGTH') != '') {
                                $length = filter_var(env('PASSWORD_STRENGTH'), FILTER_SANITIZE_NUMBER_INT);
                                $conditions = explode('|', env('PASSWORD_STRENGTH'));
                                $uppercase = in_array("UPPERCASE", $conditions);
                                $lowercase = in_array("LOWERCASE", $conditions);
                                $number = in_array("NUMBERS", $conditions);
                                $symbol = in_array("SYMBOLS", $conditions);
                            }

                        @endphp
                        <div class="card-body p-0">

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-left" for="length">{{ __('Minimum Password Length') }}</label>
                                <div class="col-sm-6">
                                    <input type="number" name="length" id="length" class="form-control" value="{{ $length ? $length : 4 }}"
                                    max="32" min="4" data-min="{{ __('This value must be greater than :x.', ['x' => '3']) }}" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 32]) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-left" for="uppercase">{{ __('Include Uppercase') }}</label>
                                <div class="col-sm-6">
                                    <div class="switch d-inline m-r-10 edit-is_default">
                                        <input class="uppercase" type="checkbox" value="1" name="uppercase"  id="uppercase" {{ $uppercase ? 'checked' : '' }}>
                                        <label for="uppercase" class="cr"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-left" for="lowercase">{{ __('Include Lowercase') }}</label>
                                <div class="col-sm-6">
                                    <div class="switch d-inline m-r-10 edit-is_default">
                                        <input class="lowercase" type="checkbox" value="1" name="lowercase"  id="lowercase" {{ $lowercase ? 'checked' : '' }}>
                                        <label for="lowercase" class="cr"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-left" for="number">{{ __('Include Numbers') }}</label>
                                <div class="col-sm-6">
                                    <div class="switch d-inline m-r-10 edit-is_default">
                                        <input class="number" type="checkbox" value="1" name="number"  id="number" {{ $number ? 'checked' : '' }}>
                                        <label for="number" class="cr"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-left" for="symbol">{{ __('Include Symbols') }}</label>
                                <div class="col-sm-6">
                                    <div class="switch d-inline m-r-10 edit-is_default">
                                        <input class="symbol" type="checkbox" value="1" name="symbol" id="symbol" {{ $symbol ? 'checked' : '' }}>
                                        <label for="symbol" class="cr"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8 px-0">
                                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit">{{  __('Submit')  }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/preference.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
