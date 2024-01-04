<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ route('dashboard') }}" class="b-brand">

                <span class="b-title" title="{{ $company_name }}">{{ $company_name }}</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('NAVIGATION') }}</label>
                </li>

                @if (in_array('App\Http\Controllers\DashboardController@index', $prms))
                    <li data-username="dashboard" class="nav-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">{{ __('Dashboard') }} </span></a>
                    </li>
                @endif

                @if (in_array('App\Http\Controllers\UserController@index', $prms))
                    <li data-username="Customer Supplier Team" class="nav-item pcoded-hasmenu {{ $menu == 'personnel' ? 'pcoded-trigger active' : '' }}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">{{ __('Personnel') }}</span></a>
                        <ul class="pcoded-submenu">
                            @if (in_array('App\Http\Controllers\UserController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'users' ? 'active' : '' }}"><a href="{{ route('users.index') }}" class="">{{ __('Users') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (array_intersect(['App\Http\Controllers\BrandController@index',
                        'App\Http\Controllers\CategoryController@index',
                        'App\Http\Controllers\AttributeController@index',
                        'App\Http\Controllers\AttributeGroupController@index',
                        'App\Http\Controllers\OptionController@index'
                    ], $prms)
                )
                    <li data-username="Customer Supplier Team" class="nav-item pcoded-hasmenu {{ $menu == 'items' ? 'pcoded-trigger active' : '' }}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">{{ __('Items') }}</span></a>
                        <ul class="pcoded-submenu">
                            <li class="{{ isset($sub_menu) && $sub_menu == 'items' ? 'active' : '' }}"><a href="{{ route('item.index') }}" class="">{{ __('items') }}</a></li>
                            @if (in_array('App\Http\Controllers\BrandController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'brands' ? 'active' : '' }}"><a href="{{ route('brands.index') }}" class="">{{ __('Brands') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\CategoryController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'category' ? 'active' : '' }}"><a href="{{ route('categories.index') }}" class="">{{ __('Categories') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\AttributeController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'attribute' ? 'active' : '' }}"><a href="{{ route('attribute.index') }}" class="">{{ __('Attributes') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\AttributeGroupController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'attributeGroup' ? 'active' : '' }}"><a href="{{ route('attributeGroup.index') }}" class="">{{ __('Attribute Groups') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\OptionController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'option' ? 'active' : '' }}"><a href="{{ route('option.index') }}" class="">{{ __('Options') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if (array_intersect(['App\Http\Controllers\PackageController@index',
                        'App\Http\Controllers\PackageSubscriptionController@index',
                        'App\Http\Controllers\PaymentMethodController@index'
                    ], $prms)
                )
                    <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item pcoded-hasmenu {{ $menu == 'billings' ? 'pcoded-trigger active' : '' }}">
                        <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fas fa-receipt"></i></span><span class="pcoded-mtext">{{ __('Manage Billings') }}</span></a>
                        <ul class="pcoded-submenu">
                            @if (in_array('App\Http\Controllers\PackageController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'package' ? 'active' : '' }}"><a href="{{ route('package.index') }}" class="">{{ __('Packages') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\PackageSubscriptionController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'package_subscription' ? 'active' : '' }}"><a href="{{ route('packageSubscription.index') }}" class="">{{ __('Package Subscriptions') }}</a></li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (array_intersect(['Modules\ShopModules\Shoppp\Http\Controllers\ShopController@index', 'App\Http\Controllers\VendorController@index'], $prms))
                    <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item pcoded-hasmenu {{ $menu == 'vendor' ? 'pcoded-trigger active' : '' }}">
                        <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fas fa-diagnoses"></i></span><span class="pcoded-mtext">{{ __('Vendors') }}</span></a>
                        <ul class="pcoded-submenu">
                            @if (in_array('Modules\Shop\Http\Controllers\ShopController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'shop' ? 'active' : '' }}"><a href="{{ route('shop.index') }}" class="">{{ __('Shops') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\VendorController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'vendors' ? 'active' : '' }}"><a href="{{ route('vendors.index') }}" class="">{{ __('Vendors') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (array_intersect(['App\Http\Controllers\CompanySettingController@index',
                        'App\Http\Controllers\EmailConfigurationController@index',
                        'App\Http\Controllers\CurrencyController@index',
                        'App\Http\Controllers\MailTemplateController@index',
                        'App\Http\Controllers\SmsTemplateController@index',
                        'App\Http\Controllers\PreferenceController@index',
                        'App\Http\Controllers\RoleController@index',
                        'App\Http\Controllers\PermissionRoleController@index'
                    ], $prms)
                )
                    <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item pcoded-hasmenu {{ $menu == 'manage' ? 'pcoded-trigger active' : '' }}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">{{ __('Configurations') }}</span></a>
                        <ul class="pcoded-submenu">
                            @if (in_array('App\Http\Controllers\CompanySettingController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'company_details' ? 'active' : '' }}"><a href="{{ route('companyDetails.setting') }}" class="">{{ __('Company Details') }}</a></li>
                            @endif

                            @if (array_intersect(['App\Http\Controllers\EmailConfigurationController@index',
                                    'App\Http\Controllers\SmsConfigurationController@index',
                                    'App\Http\Controllers\LanguageController@index',
                                    'App\Http\Controllers\CurrencyController@currencyConverterSetup'
                                ], $prms)
                            )
                                <li class="{{ isset($sub_menu) && $sub_menu == 'general' ? 'active' : '' }}">
                                    @if (in_array('App\Http\Controllers\EmailConfigurationController@index', $prms))
                                        <a href="{{ route('emailConfigurations.index') }}" class="">{{ __('General Settings') }}</a>
                                    @elseif (in_array('App\Http\Controllers\SmsConfigurationController@index', $prms))
                                        <a href="{{ route('smsConfiguration.index') }}" class="">{{ __('General Settings') }}</a>
                                    @elseif (in_array('App\Http\Controllers\LanguageController@index', $prms))
                                        <a href="{{ route('language.index') }}" class="">{{ __('General Settings') }}</a>
                                    @elseif (in_array('App\Http\Controllers\CurrencyController@currencyConverterSetup', $prms))
                                        <a href="{{ route('currency.convert') }}" class="">{{ __('General Settings') }}</a>
                                    @endif
                                </li>
                            @endif

                            @if (array_intersect(['App\Http\Controllers\CurrencyController@index', 'App\Http\Controllers\PaymentTermController@index'], $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'finance' ? 'active' : '' }}">
                                    @if (in_array('App\Http\Controllers\CurrencyController@index', $prms))
                                        <a href="{{ route('currency.index') }}" class="">{{ __('Finance') }}</a>
                                    @else
                                        <a href="{{ route('paymentTerm.index') }}" class="">{{ __('Finance') }}</a>
                                    @endif
                                </li>
                            @endif

                            @if (in_array('App\Http\Controllers\MailTemplateController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'email_templates' ? 'active' : '' }}"><a href="{{ route('emailTemplates.index') }}" class="">{{ __('Email Templates') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\SmsTemplateController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'sms_templates' ? 'active' : '' }}"><a href="{{ route('smsTemplates.index') }}" class="">{{ __('SMS Templates') }}</a></li>
                            @endif

                            @if (array_intersect(['App\Http\Controllers\PreferenceController@index', 'App\Http\Controllers\PreferenceController@theme'], $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'preference' ? 'active' : '' }}">
                                    @if (in_array('App\Http\Controllers\PreferenceController@index', $prms))
                                        <a href="{{ route('preferences.index') }}" class="">{{ __('Preference') }}</a>
                                    @else
                                        <a href="{{ route('preferences.theme') }}" class="">{{ __('Preference') }}</a>
                                    @endif
                                </li>
                            @endif

                            @if (in_array('App\Http\Controllers\RoleController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'roles' ? 'active' : '' }}"><a href="{{ route('roles.index') }}" class="">{{ __('Roles') }}</a></li>
                            @endif

                            @if (in_array('App\Http\Controllers\PermissionRoleController@index', $prms))
                                <li class="{{ isset($sub_menu) && $sub_menu == 'permission_role' ? 'active' : '' }}"><a href="{{ route('permissionRoles.index') }}" class="">{{ __('Role Permissions') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
