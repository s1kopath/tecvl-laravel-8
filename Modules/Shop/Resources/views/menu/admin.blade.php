@if (hasPermission('Modules\Coupon\Http\Controllers\ShopController@index'))
    <li data-username="dashboard" class="nav-item {{ isset($menu) && $menu == 'shop' ? 'active' : '' }}">
        <a href="{{ route('shop.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-store"></i></span><span class="pcoded-mtext">{{ __('Shops') }}</span></a>
    </li>
@endif