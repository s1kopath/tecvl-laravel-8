<!DOCTYPE html>
<head>
    <title>{{ $company_name }} | @yield('page_title', env('APP_NAME', ''))</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
        <script src="{{ asset('public/dist/js/respond.min.js') }}"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('admin.layouts.includes.meta')
    <!-- Favicon icon -->

    <link rel='shortcut icon' href="{{ \App\Models\Preference::getAll()->where('field', 'company_icon')->first()->fileUrl() }}" type='image/x-icon' />

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- Material icon -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/material/css/materialdesignicons.min.css') }}">
    <!-- flaq icon -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/flag/css/flag-icon.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/animation/css/animate.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/css/style.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/custom.min.css') }}">

    <!--Custom CSS that was written on view-->
    @yield('css')

    @stack('styles')

    <!-- Theme style RTL -->
    @if (\Cache::get(config('cache.prefix') . '-language-direction') == 'rtl')
        <link rel="stylesheet" href="{{ asset('public/datta-able/css/layouts/rtl.css') }}">
    @endif

    <script type="text/javascript">
        'use strict';
        var SITE_URL              = "{{ URL::to('/admin') }}";
        var currencySymbol        = '{!! $default_currency->symbol !!}';
        var defaultCurrencySymbol = '{!! $default_currency->symbol !!}';
        var decimal_digits        = "{{ $decimal_digits }}";
        var thousand_separator    = "{{ $thousand_separator }}";
        var symbol_position       = "{!! $symbol_position !!}";
        var dateFormat            = '{!! $date_format_type !!}';
        var token                 = '{!! csrf_token() !!}';
        var app_locale_url        = "{!! url('/resources/lang/' . config('app.locale') . '.json') !!}";
        var row_per_page          = '{!! $row_per_page !!}';
        var txLnSts               = {!! $json !!};
        var language_direction    = '{!! \Cache::get(config('cache.prefix') . '-language-direction') !!}';
    </script>

    <!-- Required Js -->
    <script src="{{ asset('public/datta-able/js/vendor-all.js') }}"></script>
</head>

<?php
    $appName = env('APP_NAME', '');
    $appName = (!empty($appName) && mb_strlen($appName) > 19) ? mb_substr($appName, 0, 17) .'..' : $appName;
?>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    @include('admin.layouts.includes.sidebar')
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    @include('admin.layouts.includes.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    @include('admin.layouts.includes.notifications')

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                @yield('content')
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>{{ __('Warning') }}!!</h1>
            <p>{{ __('You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.') }}
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="//www.google.com/chrome/">
                            <img src="{{ asset('public/datta-able/images/browser/chrome.png') }}" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="//www.mozilla.org/en-US/firefox/new/">
                            <img src="{{ asset('public/datta-able/images/browser/firefox.png') }}" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="//www.opera.com">
                            <img src="{{ asset('public/datta-able/images/browser/opera.png') }}" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="//www.apple.com/safari/">
                            <img src="{{ asset('public/datta-able/images/browser/safari.png') }}" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="//windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="{{ asset('public/datta-able/images/browser/ie.png') }}" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>{{ __('Sorry for the inconvenience!') }}</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    {{-- Custom Js --}}
    <!-- Required Js -->
    <script>
        const fetchUserData = '{{route("users.user-data", ["uid" => "__id__"])}}';
    </script>
    <script src="{{ asset('public/datta-able/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/app-layout.js') }}"></script>
    <!-- Custom Js -->
    @yield('js')

    @stack('scripts')
</body>

</html>
