
<!-- Profile Image -->
  <div class="card card-info display_block" id="nav">
    <div class="card-header p-t-20">
      <h5><a href="{{ route('preferences.index') }}" id="general-settings">{{ __('Manage Preferences') }}</a></h5>
    </div>
    <ul class="card-body nav nav-pills nav-stacked" id="mcap-tab" role="tablist">
        @if (in_array('App\Http\Controllers\PreferenceController@index', $prms))
            <li class="nav-item">
                <a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'general_preference' ? 'active' : ''}}" href="{{ route('preferences.index') }}" id="s" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('General Preferences') }}</a>
            </li>
        @endif

        @if (in_array('App\Http\Controllers\PreferenceController@password', $prms))
            <li class="nav-item"><a class="nav-link h-lightblue text-left {{ isset($list_menu) &&  $list_menu == 'password_preference' ? 'active' : ''}}" href="{{ route('preferences.password') }}">{{ __('Password Strength') }}</a></li>
        @endif
    </ul>
  </div>
  <!-- /.box-body -->
