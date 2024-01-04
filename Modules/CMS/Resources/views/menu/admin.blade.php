@if (hasPermission('Modules\CMS\Http\Controllers\CMSController@index'))
    <li class="nav-item {{ $menu == 'page' ? 'active' : '' }}">
        <a href="{{ route('page.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-adjust"></i></span><span class="pcoded-mtext">{{ __('Pages') }}</span></a>
    </li>
@endif
@if (hasPermission('Modules\CMS\Http\Controllers\SlideController@index'))
    <li class="nav-item {{ $menu == 'slide' ? 'active' : '' }}">
        <a href="{{ route('slider.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fab fa-adn"></i></span><span class="pcoded-mtext">{{ __('Slide') }}</span></a>
    </li>
@endif
