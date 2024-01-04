
<!-- Profile Image -->
<div class="card card-info display_block" id="nav">
    <div class="card-header p-t-20">
        <h5><a href="{{ route('companyDetails.setting') }}" id="company-settings">{{ __('Manage') . " " . __('Settings') }}</a></h5>
    </div>
    <ul class="card-body nav nav-pills nav-stacked" id="mcap-tab" role="tablist">
        @if (in_array('App\Http\Controllers\CompanySettingController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'company_settings' ? 'active' : ''}}" href="{{ route('companyDetails.setting') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Company Setting') }}</a>
            </li>
        @endif

    </ul>
</div>
<!-- /.box-body -->
