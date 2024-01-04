@if (hasPermission('Modules\Refund\Http\Controllers\RefundController@index'))
    <li class="nav-item {{ $menu == 'refund' ? 'active' : '' }}">
        <a href="{{ route('refund.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-shipping-fast"></i></span><span class="pcoded-mtext">{{ __('Refunds') }}</span></a>
    </li>
@endif

