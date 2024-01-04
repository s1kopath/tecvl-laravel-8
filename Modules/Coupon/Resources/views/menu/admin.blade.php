@if (hasPermission('Modules\Coupon\Http\Controllers\CouponController@index'))
    <li class="nav-item {{ $menu == 'coupon' ? 'active' : '' }}">
        <a href="{{ route('coupon.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tags"></i></span><span class="pcoded-mtext">{{ __('Coupons') }}</span></a>
    </li>
@endif
@if (hasPermission('Modules\Coupon\Http\Controllers\CouponController@index'))
    <li class="nav-item {{ $menu == 'menu' ? 'active' : '' }}">
        <a href="{{ route('menu.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tags"></i></span><span class="pcoded-mtext">{{ __('Menu Builder') }}</span></a>
    </li>
@endif
