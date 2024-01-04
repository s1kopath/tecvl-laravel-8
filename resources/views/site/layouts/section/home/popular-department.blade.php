<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12 hidden lg:block">
    <P class="text-center font-bold text-22 text-gray-12 uppercase dm-bold">{{ __('Popular Departments') }}</P>
    <div id="tabs" class="p_tabs mt-4">

        <div class="flex justify-center dm-sans">
            <div class="c-tabs-nav">
                <a href="#" class="c-tabs-nav__link is-active">{{ __('New Arrivals') }}</a>
                <a href="#" class="c-tabs-nav__link">{{ __('Featured') }}</a>
                <a href="#" class="c-tabs-nav__link">{{ __('Most Popular') }}</a>
                <a href="#" class="c-tabs-nav__link">{{ __('Best Seller') }}</a>
                <div class="c-tab-nav-marker"></div>
            </div>
        </div>

        {{-- New arrival items --}}
        <div class="c-tab is-active mt-5">
            <div class="c-tab__content">
                <div class="grid grid-cols-5 gap-8">
                    @foreach($newArrivals as $key => $item)
                        @include('site.layouts.section.card-one')
                    @endforeach

                </div>
            </div>
        </div>

        {{-- Feature items --}}
        <div class="c-tab mt-8">
            <div class="c-tab__content">
                <div class="grid grid-cols-5 gap-8">
                    @foreach($featureItems as $key => $item)
                        @include('site.layouts.section.card-one')
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Popular items --}}
        <div class="c-tab mt-8">
            <div class="c-tab__content">
                <div class="grid grid-cols-5 gap-8">
                    @foreach($popularItems as $key => $item)
                        @include('site.layouts.section.card-one')
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Top seller --}}
        <div class="c-tab mt-8">
            <div class="c-tab__content">
                <div class="grid grid-cols-5 gap-8">
                    @foreach($bestSeller as $key => $item)
                        @include('site.layouts.section.card-one')
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
