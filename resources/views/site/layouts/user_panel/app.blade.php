<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $company_name }} | @yield('page_title', env('APP_NAME', ''))</title>
    <meta charset="UTF-8">
    <meta rel="stylesheet" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('public/css/tailwind-custom.css') }}" />
    <link href="{{ asset('public/frontend/assets/css/google-font-inter.css') }}" >
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <script src="{{  asset('public/frontend/assets/js/alpine.min.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/user-panel.css') }}">

    @if(!empty($favicon) && file_exists('public/uploads/companyIcon/' . $favicon))
        <link rel='shortcut icon' href="{{ URL::to('/') }}/public/uploads/companyIcon/{{ $favicon }}" type='image/x-icon' />
    @endif
    @yield('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/site_custom.css') }}">
    <script type="text/javascript">
        'use strict';
        var SITE_URL              = "{{ URL::to('/') }}";
        var token                 = '{!! csrf_token() !!}';
        var txLnSts               = {!! $json !!};
    </script>

    <!-- Required Js -->
    <script src="{{ asset('public/dist/js/jquery.min.js') }}"></script>

</head>

<!-- partial:index.partial.html -->

<body class="antialiased bg-gray-100 overflow-hidden m-0" x-data="{'darkMode': false}" x-init="
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">
<div :class="{'dark': darkMode === true}">
    <div class=" dark:bg-red-2 dark:text-gray-100 ">


        <div x-data="{ sidemenu: false }" class="h-screen flex overflow-hidden" x-cloak
             @keydown.window.escape="sidemenu = false">
                <!-- sidebar start -->
                @include('../site/layouts.user_panel.includes.sidebar')
                <!-- sidebar end -->
                <div class="flex-1 flex-col relative z-0 overflow-y-auto pb-8 dark:bg-red-1 bg-white">
                <!-- header start -->
               @include('../site/layouts.user_panel.includes.header')
                <!-- header end -->
                @include('../site/layouts.user_panel.includes.notifications')
                <!-- content start-->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Main content -->
                         @yield('content')
                    </div>
                </div>
                <!-- content end -->
            </div>
        </div>
    </div>
    <!-- partial -->
    <script src="{{ asset('public/frontend/assets/js/user-dashboard.min.js') }}"></script>
@yield('js')
</body>

</html>
