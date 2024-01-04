
<!-- Profile Image -->
  <div class="card card-info display_block" id="nav">
    <div class="card-header p-t-20">
        @if (in_array('App\Http\Controllers\PreferenceController@index', $prms))
            <h5><a href="{{ route('preferences.index') }}" id="general-settings">{{ __('Manage') . " " . __('General Settings') }}</a></h5>
        @endif
    </div>
    <ul class="card-body nav nav-pills nav-stacked" id="mcap-tab" role="tablist">
        @if (in_array('App\Http\Controllers\EmailConfigurationController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'email_setup' ? 'active' : ''}}" href="{{ route('emailConfigurations.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Email Setup') }}</a>
            </li>
        @endif

        @if (in_array('App\Http\Controllers\MaintenanceModeController@enable', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'maintenance' ? 'active' : ''}}" href="{{ route('maintenance.enable') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Maintenance Mode') }}</a>
            </li>
        @endif

        @if (in_array('App\Http\Controllers\SmsConfigurationController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'sms_setup' ? 'active' : ''}}" href="{{ route('smsConfiguration.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('SMS Setup') }}</a>
            </li>
        @endif

        @if (in_array('App\Http\Controllers\LanguageController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'language' ? 'active' : ''}}" href="{{ route('language.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Language') }}</a>
            </li>
        @endif

        @if (in_array('App\Http\Controllers\CurrencyController@currencyConverterSetup', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'currency_converter' ? 'active' : ''}}" href="{{ route('currency.convert') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Currency Converter Setup') }}</a>
            </li>
        @endif
         @if (in_array('App\Http\Controllers\SsoController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'sso_service' ? 'active' : ''}}" href="{{ route('sso.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('SSO Service') }}</a>
            </li>
         @endif
        @if (in_array('App\Http\Controllers\OrderStatusController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'order_status' ? 'active' : ''}}" href="{{ route('orderStatues.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Order Status') }}</a>
            </li>
        @endif
        @if (in_array('App\Http\Controllers\WithdrawalController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'withdrawal_setting' ? 'active' : ''}}" href="{{ route('withdrawalSetting.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Withdrawal Setting') }}</a>
            </li>
        @endif
        @if (in_array('App\Http\Controllers\EmailController@emailVerifySetting', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'email_verify_setting' ? 'active' : ''}}" href="{{ route('emailVerifySetting') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('User verification') }}</a>
            </li>
        @endif
    </ul>
  </div>
  <!-- /.box-body -->
