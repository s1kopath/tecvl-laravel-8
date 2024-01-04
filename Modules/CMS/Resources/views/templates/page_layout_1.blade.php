@extends('../site/layouts.app')

@section('page_title', __('Home'))
@section('content')
    @foreach ($page->components as $component)
        @include('cms::templates.blocks.' . optional($component->layout)->file)
    @endforeach
@endsection

@section('js')
    <script src="{{ asset('public/dist/js/custom/site/home.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/slick/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/compare.min.js') }}"></script>
@endsection
