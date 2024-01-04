<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ url('vendor/dashboard') }}" class="b-brand">
                <span class="b-title" title="{{ $company_name }}">{{ $company_name }}</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('NAVIGATION') }}</label>
                </li>
                <?php
                $menus = Modules\MenuBuilder\Http\Models\MenuItems::menus(3);
                ?>
                @foreach($menus as $menu)
                        @if ($menu->hasPermission($prms))
                            @if($menu->getModuleName())
                                <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item {{ $menu->class }} @if($menu->isParent()) pcoded-hasmenu @endif {{ $menu->isLinkActive() ? 'pcoded-trigger active' : '' }}">
                                    <a href='{{ $menu->isParent() ?  "javascript:" : $menu->url("vendor") }}' class="nav-link"><span class="pcoded-micon"><i class="{{ $menu->icon }}"></i></span><span class="pcoded-mtext">{{ $menu->label_name }}</span></a>
                                    @if($menu->isParent())
                                        <ul class="pcoded-submenu">
                                            @foreach ($menu->child as $submenu)
                                                @if ($submenu->hasPermission($prms))
                                                <li class="{{ $submenu->isLinkActive() ? 'active' : '' }} {{ $submenu->class }}">
                                                    <a href="{{ $submenu->url('vendor') }}" class="">{{ $submenu->label_name }}</a>
                                                </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
