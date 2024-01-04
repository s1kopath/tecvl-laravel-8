@if (in_array('Modules\Coupon\Http\Controllers\Vendor\CouponController@index', $prms))
    <li class="nav-item {{ $menu == 'coupon' ? 'active' : '' }}">
        <a href="{{ route('vendor.coupons') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tags"></i></span><span class="pcoded-mtext">{{ __('Coupon') }} </span></a>
    </li>
@endif
