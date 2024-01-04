@extends('../site/layouts.app')

@section('page_title', __('Home'))
@section('content')

@if (isset($page))
    @foreach ($page->components as $component)
        @include('cms::templates.blocks.' . $component->layout->file)
    @endforeach
@else
    {{-- shipping --}}
    @include('site.layouts.section.home.shipping')
    {{-- shipping End--}}

    {{-- Top Categories of the Month --}}
    @include('site.layouts.section.home.top-category')
    {{-- Top Categories of the Month End --}}
    {{-- Best Deals of the Week --}}
    @include('site.layouts.section.home.week-deal')
    {{-- Best Deals of the Week End --}}

    {{-- Flash Sale --}}
    @include('site.layouts.section.home.flash-sale')
    {{-- Flash Sale End --}}

    {{-- Home - All promot sliders --}}
    @include('site.layouts.section.home.promot-banner')
    {{-- Home - All promot sliders End--}}

    {{-- Popular Departments --}}
    @include('site.layouts.section.home.popular-department')
    {{-- Popular Departments End --}}

    {{-- SPORTS ZONE --}}
    @include('site.layouts.section.home.sport-zone')
    {{-- SPORTS ZONE End--}}

    {{-- Top Brands --}}
    @include('site.layouts.section.home.top-brand')
    {{-- Top Brands / Seller End --}}

    {{-- Latest News --}}
    @include('site.layouts.section.home.latest-news')
    {{-- Latest News End --}}

    {{-- Follow us on Facebook / Instagram --}}
    @include('site.layouts.section.home.follow-us')
    {{-- Follow us on Facebook / Instagram End --}}
@endif

    {{-- Your Recent Views --}}
    @include('site.layouts.section.home.recent-view')
    {{-- Your Recent Views End --}}

@endsection

@section('js')
    <script src="{{ asset('public/dist/js/custom/site/home.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/slick/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/compare.min.js') }}"></script>
@endsection
