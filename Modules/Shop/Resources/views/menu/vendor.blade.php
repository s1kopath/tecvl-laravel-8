@if (in_array('App\Http\Controllers\Vendor\ShopController@index', $prms))
    <li class="nav-item {{ $menu == 'shop' ? 'active' : '' }}">
        <a href="{{ url('vendor/shop') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-store"></i></span><span class="pcoded-mtext">{{ __('Shop') }} </span></a>
    </li>
@endif
