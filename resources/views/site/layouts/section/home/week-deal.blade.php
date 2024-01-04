@if (count($bestDeals) > 0)
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 md:mt-12 mt-30p">
    <P class="text-center text-sm md:text-22 text-gray-12 uppercase dm-bold">{{ __('Best Deals of the Week') }}</P>
    <div class="flex md:mt-5 mt-2.5">
        <div class="w-322p hidden md:block">
            <div class="relative dm-sans    ">
                <img class="w-full" src="{{ asset('public/frontend/assets/img/product/Deals.png') }}" alt="">
                <div class="absolute top-0 p-6">
                    <p class="text-xs text-gray-1">LIVING & LIFESTYLE</p>
                    <p class="text-gray-12 font-medium text-lg uppercase">Decorate</p>
                    <p class="text-gray-12 font-bold text-2.5xl -mt-1.5 uppercase">Your Home</p>
                    <a href="#" class="process-goto hover:bg-gray-12 hover:text-white cursor-pointer relative flex justify-center text-gray-12 rounded-sm text-xs items-center py-2 w-29 dm-sans border border-gray-800">
                        <span>{{ __('See More') }}</span>
                        <svg class="ml-5p relative" width="10" height="7" viewBox="0 0 10 7" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full md:pl-5">
            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-5">
                @foreach($bestDeals as $key => $item)
                    @include('site.layouts.section.card-one')
                @endforeach
            </div>
            <a href="" class="md:hidden mt-30p pb-15p process-goto relative flex justify-center text-gray-12 font-medium text-sm items-center dm-sans border-b">
                <span>{{ __('See More') }}</span>
                <svg class="ml-2 relative" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z" fill="#898989"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
