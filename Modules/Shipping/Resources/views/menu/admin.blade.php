@if (hasPermission('Modules\Shipping\Http\Controllers\ShippingController@index'))
    <li class="nav-item {{ $menu == 'shippinig' ? 'active' : '' }}">
        <a href="{{ route('shipping.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-shipping-fast"></i></span><span class="pcoded-mtext">{{ __('Shippings') }}</span></a>
    </li>
@endif

