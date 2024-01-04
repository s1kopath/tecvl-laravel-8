@extends('admin.layouts.app')
@section('page_title', __('General Preferences'))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <!-- Main content -->
<div class="col-sm-12" id="preference-settings-container">
  <div class="row">
    <div class="col-sm-3">
      @include('admin.layouts.includes.preference_menu')
    </div>
    <div class="col-sm-9">
      <div class="card">
      <div class="card-header">
        <h5>{{ __('General Preferences') }}</h5>
        <div class="card-header-right">

        </div>
      </div>
      <div class="card-block table-border-style">
        <form action="{{ route('preferences.index') }}" method="post" class="form-horizontal" id="preference_form">
        {!! csrf_field() !!}
          <div class="card-body p-0">

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="inputEmail3">{{ __('Rows per page') }}</label>

              <div class="col-sm-6">
                <select name="row_per_page" class="form-control select" >
                    <option value="10" <?=isset($prefData['preference']['row_per_page']) && $prefData['preference']['row_per_page'] == 10 ? 'selected':""?>>10</option>
                    <option value="25" <?=isset($prefData['preference']['row_per_page']) && $prefData['preference']['row_per_page'] == 25 ? 'selected':""?>>25</option>
                    <option value="50" <?=isset($prefData['preference']['row_per_page']) && $prefData['preference']['row_per_page'] == 50 ? 'selected':""?>>50</option>
                    <option value="100" <?=isset($prefData['preference']['row_per_page']) && $prefData['preference']['row_per_page'] == 100 ? 'selected':""?>>100</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="inputEmail3">{{ __('Date format') }}</label>

              <div class="col-sm-6">
                <select name="date_format" class="form-control select" >
                    <option value="0" <?=isset($prefData['preference']['date_format']) && $prefData['preference']['date_format'] == 0 ? 'selected':""?>>yyyymmdd {2020 12 31}</option>
                    <option value="1" <?=isset($prefData['preference']['date_format']) && $prefData['preference']['date_format'] == 1 ? 'selected':""?>>ddmmyyyy {31 12 2020}</option>
                    <option value="2" <?=isset($prefData['preference']['date_format']) && $prefData['preference']['date_format'] == 2 ? 'selected':""?>>mmddyyyy {12 31 2020}</option>
                    <option value="3" <?=isset($prefData['preference']['date_format']) && $prefData['preference']['date_format'] == 3 ? 'selected':""?>>ddMyyyy {31 Dec 2020}</option>
                    <option value="4" <?=isset($prefData['preference']['date_format']) && $prefData['preference']['date_format'] == 4 ? 'selected':""?>>yyyyMdd {2020 Dec 31}</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="inputEmail3">{{ __('Date Separator') }}</label>

              <div class="col-sm-6">
                <select name="date_sepa" class="form-control select">
                    <option value="-" <?=isset($prefData['preference']['date_sepa']) && $prefData['preference']['date_sepa'] == '-' ? 'selected':""?>>-</option>
                    <option value="/" <?=isset($prefData['preference']['date_sepa']) && $prefData['preference']['date_sepa'] == '/' ? 'selected':""?>>/</option>
                    <option value="." <?=isset($prefData['preference']['date_sepa']) && $prefData['preference']['date_sepa'] == '.' ? 'selected':""?>>.</option>
                    <option value="  " <?=isset($prefData['preference']['date_sepa']) && $prefData['preference']['date_sepa'] == '  ' ? 'selected':""?>>  </option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="decimal_digits">{{ __('Decimal Format') }}(.)</label>
              <div class="col-sm-6">
                <select name="decimal_digits" class="form-control select">
                    @for($i=1; $i<=8; $i++)
                      <option value={{$i}} <?= isset($prefData['preference']['decimal_digits']) && $prefData['preference']['decimal_digits'] == $i ? 'selected' : "" ?>>{{$i}}</option>
                    @endfor
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="thousand_separator">{{ __('Thousand Separator') }}</label>
              <div class="col-sm-6">
                <select name="thousand_separator" class="form-control select">
                  <option value="," <?= isset($prefData['preference']['thousand_separator']) && $prefData['preference']['thousand_separator'] == ',' ? 'selected' : "" ?>> , </option>
                  <option value="." <?= isset($prefData['preference']['thousand_separator']) && $prefData['preference']['thousand_separator'] == '.' ? 'selected' : "" ?>> . </option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left" for="symbol_position">{{ __('Currency Symbol Position') }}</label>
              <div class="col-sm-6">
                <select name="symbol_position" class="form-control select">
                  <option value="before" <?= isset($prefData['preference']['symbol_position']) && $prefData['preference']['symbol_position'] == 'before' ? 'selected' : "" ?>>{{ __('Before') }}</option>
                  <option value="after" <?= isset($prefData['preference']['symbol_position']) && $prefData['preference']['symbol_position'] == 'after' ? 'selected' : "" ?>>{{ __('After') }}</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 control-label text-left require" for="file_size">{{ __('Max FileSize') }}</label>
              <div class="col-sm-6 input-group flex-wrap">
                <div class="input-group-prepend">
                  <span class="input-group-text">{{ __('MB') }}</span>
                </div>
                <input class="form-control" type="number" name="file_size" id="file_size" min="0" max="20" value="{{ isset($prefData['preference']['file_size']) ? $prefData['preference']['file_size'] : ''}}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min="{{ __('The value must be :x than or equal to :y', ['x' => __('greater'), 'y' => 0]) }}" data-max="{{ __('The value must be :x than or equal to :y', ['x' => __('less'), 'y' => 20]) }}">
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 control-label text-left" for="inputEmail3">{{ __('Timezone') }}</label>
                  <?php
                   $timezones = timeZoneList();
                  ?>
                <div class="col-sm-6">
                  <select class="form-control select" name="default_timezone" >
                  @foreach($timezones as $timezone)
                    <option value="{{$timezone['zone']}}" <?=isset($prefData['preference']['default_timezone']) && $prefData['preference']['default_timezone'] == $timezone['zone'] ? 'selected':""?>>
                      {{$timezone['diff_from_GMT'] . ' - ' . $timezone['zone'] }}
                    </option>
                  @endforeach
                  </select>
                   <br>
                   <br>
                </div>
            </div>

              <div class="form-group row">
                  <label class="col-sm-3 control-label text-left" for="captcha">{{ __('SSO Service') }}</label>
                  <div class="col-sm-6">
                      <select name="sso_service[]" class="form-control select" multiple>
                          @php $services = isset($prefData['preference']['sso_service']) ?  json_decode($prefData['preference']['sso_service']) : null @endphp
                          <option value="Facebook" <?= isset($services) && in_array("Facebook",$services) ? 'selected' : "" ?>>{{ __('Facebook') }}</option>
                          <option value="Google" <?= isset($services) && in_array("Google",$services) ? 'selected' : "" ?>>{{ __('Google') }}</option>
                      </select>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-3 control-label text-left require" for="file_size">{{ __('Invoice Prefix') }}</label>
                  <div class="col-sm-6 input-group flex-wrap">
                      <input class="form-control" type="text" name="invoice_prefix" id="invoice_prefix" value="{{ isset($prefData['preference']['invoice_prefix']) ? $prefData['preference']['invoice_prefix'] : ''}}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
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
