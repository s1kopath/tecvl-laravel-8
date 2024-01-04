<!DOCTYPE html>
<html lang="en" dir="auto">

<head>
    <title>{{ $company_name }} | @yield('page_title', env('APP_NAME', ''))</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('seo')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/tailwind-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/themes/themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/google-font-roboto.css') }}" >
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.css') }}" type="text/css"/>
    <link rel="stylesheet" id="switcher-id" href="">
    @if(!empty($favicon) && file_exists('public/uploads/companyIcon/' . $favicon))
        <link rel='shortcut icon' href="{{ URL::to('/') }}/public/uploads/companyIcon/{{ $favicon }}" type='image/x-icon' />
    @endif
    <!--Custom CSS that was written on view-->
    @yield('css')
    <!-- Menubar css -->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/menu-style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/ionicon.min.css') }}" />
    <!-- Menubar css end-->
    <link rel="stylesheet" href="{{ asset('public/dist/css/site_custom.css') }}">
    @php $allTags = \App\Models\Tag::getAll()->where('status', 'Active')->pluck('name', 'id'); @endphp
    <script type="text/javascript">
        'use strict';
        var SITE_URL              = "{{ URL::to('/') }}";
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
        var allItemTags           =  '{!! $allTags !!}';
        var totalItemPerPage           =  '{!! totalItemPerPage() !!}';
    </script>
    <!-- Required Js -->
    <script src="{{ asset('public/dist/js/jquery.min.js') }}"></script>
</head>
<body class="antialiased min-h-screen" x-data="{'layout': 'grid'}">

<!-- Top nav start -->
@include('../site/layouts.includes.top_nav')
<!-- Top nav end -->

<!-- header section start -->
@include('../site/layouts.includes.header')
<!-- header section end -->

<!-- Bottom nav section start-->
@include('../site/layouts.includes.bottom_nav')
<!-- Bottom nav section End-->


<div class="flex fixed h-0 z-30 hide transition-all duration-500 color-parent top-56">
    <div class="colors">
        <div class="animated fadeInLeft">
            <header>
                <div class="mb-3 border-one pb-2 ml-1">
                    <h3 class="text-md text-gray-600 border-two">
                        {{ __('Color Screen') }}
                    </h3>
                </div>
                {{-- <p class="mt-4 mb-2 color-font text-md text-gray-600">{{ __('Color Screen') }} </p> --}}
                <div class="theme-switches">
                    <div data-theme="light" class="switch color-border" id="switch-1"></div>
                    <div data-theme="sky" class="switch" id="switch-2"></div>
                    <div data-theme="purple" class="switch" id="switch-3"></div>
                    <div data-theme="dark" class="switch" id="switch-4"></div>
                </div>

                <div class="theme-switches">
                    <div data-theme="yellow" class="switch" id="switch-5"></div>
                    <div data-theme="orange" class="switch" id="switch-8"></div>
                    <div data-theme="cyan" class="switch" id="switch-6"></div>
                    <div data-theme="brown" class="switch" id="switch-7"></div>
                </div>

                <div class="mb-2 border-one pb-2 ml-1 -mt-3">
                    <h3 class="text-md text-gray-600 border-two">
                        {{ __('Direction') }}
                    </h3>
                </div>

                <div class="mt-5 flex">

                    <a href="">
                        <div class="bg-green-500 text-white px-5 py-2 ml-1 transition duration-300 text-sm ease-in-out hover:bg-green-600 mr-6">
                                RTL
                        </div>
                    </a>

                    <a href="">
                        <div class="px-4 py-2 border border-green-500 transition duration-300 text-sm ease-in-out hover:bg-green-600 hover:text-white">
                                LTR
                        </div>
                    </a>
                </div>
            </header>
        </div>
    </div>
    <div class="switch-mode">
        <div id="myBtn" class="border-r border-b border-t">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 fa-spins text-green-500" width="24" height="24" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <path
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
    </div>
    </div>
  </div>

<div class="main-body">
    <div class="page-wrapper">
        <!-- Main content -->
         @yield('content')
    </div>
</div>

{{-- Modal --}}
@include('../site/layouts.includes.login_modal')

<!-- section footer start -->
@include('../site/layouts.includes.footer')

<!-- section footer end -->
{{-- Item view modal --}}
@if (request()->route()->getName() != "site.itemDetails")
@include('../site/layouts.includes.item_view')
@endif

<script src="{{ asset('public/dist/js/custom/site/formatting.min.js') }}"></script>
<!-- Custom Js -->
@yield('js')
<script src="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.js') }}"></script>

<script>

document.querySelector('.switch-mode').addEventListener("click", myFunction);

function myFunction() {
  document.querySelector('.color-parent').classList.toggle("hide");
}
</script>

{{-- mobile view side nav --}}
<script>
    let burger = document.querySelector('.burger');
    let close = document.querySelector('.close');
    let sidenav = document.querySelector('#sidenav');
    let overlay = document.querySelector('#overlay');

    let classOpen = [sidenav, overlay];
    burger.addEventListener('click', function(e){
        classOpen.forEach(e => e.classList.add('active'));
    });

    let classCloseClick = [overlay, close];
    classCloseClick.forEach(function(el) {
        el.addEventListener('click', function(els) {
            classOpen.forEach(els => els.classList.remove('active'));
        });
    });
</script>

{{-- multiple mobile view accordian menu --}}
<script>
    $(document).ready(function() {
		$("#accordian a.clicks").click(function() {
				var link = $(this);
				var closest_ul = link.closest("ul");
				var parallel_active_links = closest_ul.find(".active")
				var closest_li = link.closest("li");
				var link_status = closest_li.hasClass("active");
				var count = 0;
                $(this).toggleClass("down");
				closest_ul.find("ul").slideUp(function() {
						if (++count == closest_ul.find("ul").length)
								parallel_active_links.removeClass("active");
				});

				if (!link_status) {
						closest_li.children("ul").slideDown();
						closest_li.addClass("active");
				}
		})
    })

    // customer_header.blade.php
$('.lang').on('click', function() {
    var lang = $(this).data('shortname');
    var url = SITE_URL + '/change-language';
    $.ajax({
        url   :url,
        data:{
            _token:token,
            lang: lang,
            type: 'user'
        },
        type:"POST",
        success:function(data) {
            if (data == 1) {
                location.reload();
            }
        },
         error: function(xhr, desc, err) {
            return 0;
        }
    });
});

</script>

<script src="{{ asset('public/frontend/assets/js/script.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/alpine.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/theme.min.js') }}"></script>
{{-- <script src="{{ asset('public/frontend/assets/js/menu-script.js') }}"></script> --}}
<script src="{{ asset('public/dist/js/custom/site/cart.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/lang.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/site.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/main.min.js') }}"></script>
</body>
</html>
