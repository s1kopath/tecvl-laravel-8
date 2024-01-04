@extends('../site/layouts.app')
@section('page_title', __('Home'))
@section('content')
    <section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 ">
        {{-- profile and top benner --}}
        <div class="flex justify-between mt-5">
            <div class="bg-gray-12 rounded-md border ">
                <div class="flex items-start">
                    <img class="h-84p w-84p m-5 rounded-full" src="{{ $shop->vendor->fileUrl() }}" alt="avatar">
                    <div class="mt-8 mr-14 ">
                        <p class="bg-yellow-1 py-1.5 px-2 rounded-sm roboto-medium font-medium text-gray-12 text-xs ">top
                            Seller</p>
                        <p class="text-white font-bold dm-bold text-2xl mt-2.5">{{ $shop->name }}</p>
                    </div>
                </div>
                <p class=" mb-5 pl-5 pr-5 roboto-medium font-medium text-gray-2 text-sm">
                    {{ trimWords($shop->description, 150) }}
                </p>
                <div class="flex items-center mb-5 ml-5">
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($shop->rating))
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-1"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </span>
                            @else
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </span>
                            @endif
                        @endfor
                    </div>
                    <span
                        class="pl-2.5 pt-1 roboto-medium font-medium font-sm text-white">{{ round($shop->rating, 1) }}</span>
                    <span class="pl-2.5 pt-1 roboto-medium font-medium font-sm text-gray-10">(67 Reviews)</span>
                </div>
                <div class=" ml-5 mr-5 flex">
                    <div class="text-white dm-sans font-medium ">
                        <p class=" text-sm">Seller Ratings</p>
                        <p class="text-2xl">{{ (new \App\Models\Item)->positiveRating($shop->vendor->id) }}%</p>
                    </div>
                    <div>
                        <a href="" class="bg-yellow-1 text-gray-12 font-bold dm-bold text-sm ml-5 rounded-sm  px-8 flex items-start">
                            <span class=" my-3.5"> Chat Now</span> <svg class="ml-2  my-3.5"
                                xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.50461 3.79496e-07H9.49539C10.7786 -1.41442e-05 11.8134 -2.59653e-05 12.6436 0.0844338C13.5006 0.171614 14.2438 0.356532 14.9013 0.795839C15.4169 1.14036 15.8596 1.58308 16.2042 2.0987C16.6435 2.75617 16.8284 3.49938 16.9156 4.35638C17 5.18664 17 6.22141 17 7.50459V7.60651C17 8.8897 17 9.92447 16.9156 10.7547C16.8284 11.6117 16.6435 12.3549 16.2042 13.0124C15.8596 13.528 15.4169 13.9707 14.9013 14.3153C14.3271 14.6989 13.688 14.8884 12.9641 14.9885C12.3956 15.0671 11.7374 15.0948 10.9756 15.105L10.1895 16.6773C9.49337 18.0695 7.50663 18.0695 6.81053 16.6773L6.02435 15.105C5.26255 15.0948 4.6044 15.0671 4.03589 14.9885C3.31203 14.8884 2.67291 14.6989 2.0987 14.3153C1.58308 13.9707 1.14036 13.528 0.795839 13.0124C0.356532 12.3549 0.171614 11.6117 0.0844338 10.7547C-2.59653e-05 9.92447 -1.41442e-05 8.88969 3.79496e-07 7.6065V7.50461C-1.41442e-05 6.22142 -2.59653e-05 5.18664 0.0844338 4.35638C0.171614 3.49939 0.356532 2.75617 0.795839 2.0987C1.14037 1.58308 1.58308 1.14036 2.0987 0.795839C2.75617 0.356532 3.49939 0.171614 4.35639 0.0844338C5.18664 -2.59653e-05 6.22142 -1.41442e-05 7.50461 3.79496e-07ZM4.54755 1.96362C3.8399 2.03561 3.44348 2.16903 3.14811 2.36639C2.83874 2.57311 2.57311 2.83873 2.36639 3.14811C2.16903 3.44348 2.03561 3.8399 1.96362 4.54755C1.89003 5.27098 1.88889 6.20946 1.88889 7.55555C1.88889 8.90165 1.89003 9.84013 1.96362 10.5636C2.03561 11.2712 2.16903 11.6676 2.36639 11.963C2.57311 12.2724 2.83874 12.538 3.14811 12.7447C3.40628 12.9172 3.74211 13.041 4.29454 13.1174C4.86215 13.1958 5.59182 13.2165 6.61523 13.2209C6.99724 13.2226 7.32547 13.4509 7.47276 13.7781L8.5 15.8326L9.52724 13.7781C9.67453 13.4509 10.0028 13.2226 10.3848 13.2209C11.4082 13.2165 12.1379 13.1958 12.7055 13.1174C13.2579 13.041 13.5937 12.9172 13.8519 12.7447C14.1613 12.538 14.4269 12.2724 14.6336 11.963C14.831 11.6676 14.9644 11.2712 15.0364 10.5636C15.11 9.84013 15.1111 8.90165 15.1111 7.55555C15.1111 6.20946 15.11 5.27098 15.0364 4.54755C14.9644 3.8399 14.831 3.44348 14.6336 3.14811C14.4269 2.83873 14.1613 2.57311 13.8519 2.36639C13.5565 2.16903 13.1601 2.03561 12.4524 1.96362C11.729 1.89003 10.7905 1.88889 9.44444 1.88889H7.55556C6.20946 1.88889 5.27098 1.89003 4.54755 1.96362Z"
                                    fill="#2C2C2C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.7207 5.6671C4.7207 5.1455 5.14355 4.72266 5.66515 4.72266L11.3318 4.72266C11.8534 4.72266 12.2763 5.1455 12.2763 5.6671C12.2763 6.1887 11.8534 6.61154 11.3318 6.61154L5.66515 6.61154C5.14355 6.61154 4.7207 6.1887 4.7207 5.6671Z"
                                    fill="#2C2C2C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.7207 9.44444C4.7207 8.92284 5.14355 8.5 5.66515 8.5H8.49848C9.02008 8.5 9.44292 8.92284 9.44292 9.44444C9.44292 9.96605 9.02008 10.3889 8.49848 10.3889H5.66515C5.14355 10.3889 4.7207 9.96605 4.7207 9.44444Z"
                                    fill="#2C2C2C" />
                            </svg></a>
                    </div>
                </div>
            </div>
            <img class="h-350-w-830 ml-4" src="{{ asset('public/frontend/assets/img/vendor-shop/Banner Static.png') }}" alt="">
        </div>
        {{-- Slider --}}
        <div class="flex mt-30p justify-between">
            <div>
                <img class=" h-56 mr-4 pr-5 relative "
                    src="{{ asset('public/frontend/assets/img/vendor-shop/Banner 1.png') }}" alt="">
                <div class="absolute -mt-48">
                    <p class=" ml-7 w-24 text-center text-13 py-1 bg-blues-4 rounded-sm text-white dm-regular font-regular">
                        DRONE ZONE</p>
                    <p class="ml-7 mt-1 text-white dm-bold font-bold text-3xl">ADD
                        <span class="text-yellow-1">CONTROL</span> TO THE SKIES
                    </p>
                    <p class="ml-7 mt-0.5 text-white dm-regular font-regular text-lg">Starting from
                        <span class="dm-bold font-bold"> $99.99</span>
                    </p>
                    <a href=""
                        class="bg-yellow-1 mb-10 text-gray-12 font-medium dm-sans w-32 text-sm ml-7 mt-8 rounded-sm pl-5  flex items-start">
                        <span class=" my-2.5"> Shop Now</span>
                        <svg class="ml-1.5 mt-18p" xmlns="http://www.w3.org/2000/svg" width="10" height="7"
                            viewBox="0 0 10 7" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z"
                                fill="#2C2C2C" />
                        </svg>
                    </a>
                </div>
            </div>
            <img src="{{ asset('public/frontend/assets/img/vendor-shop/small banner.png') }}" alt="">
        </div>
        {{-- menu items and search --}}
        <div class="relative  flex content-start items-center">
            <div class=" border-b mt-10 py-2 mr-5 border-line">
                <div class="relative flex">

                    <div
                        class="relative flex  mr-12 custom-bottom-borders font-medium dm-sans h-6 text-lg cursor-pointer text-gray-10 ">
                        <a class="px-12" href="{{ route('site.shop', ['alias' => $shop->alias]) }}">
                            {{ __('All Products') }}</a>
                    </div>
                    <div
                        class=" relative flex  custom-bottom-borders font-medium dm-sans h-6 text-lg cursor-pointer text-gray-10 ">
                        <a class="px-11" href="{{ route('site.shopAll', ['alias' => $shop->alias]) }}"> {{ __('Vendor Profile') }} </a>
                    </div>
                </div>
            </div>
            <div class=" mt-30p w-467  content-end">
                <form method="GET" action="{{ route('site.searchByKeyWord') }}">
                    <div class="relative rounded  border  bg-white">
                        <input type="search" name="keyword" placeholder="{{ __('Search in this store..') }}"
                            class="bg-transparentsearch-in-store border-none h-12 text-sm roboto-regular font-regular pt-3.5 text-gray-10 focus:outline-none pl-12 pr-10" />
                        <button type="submit" role="button"
                            class="absolute left-0 shop-search-icon mt-3.5 ml-3 pr-2 border-r border-gray-2 h-6 search-btn">
                            <svg class="h-4 w-4 fill-current text-gray-12" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 2C13.3137 2 16 4.68629 16 8C16 11.3137 13.3137 14 10 14C6.68629 14 4 11.3137 4 8C4 4.68629 6.68629 2 10 2ZM18 8C18 3.58172 14.4183 0 10 0C5.58172 0 2 3.58172 2 8C2 12.4183 5.58172 16 10 16C14.4183 16 18 12.4183 18 8Z"
                                    fill="#2C2C2C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.70711 13.2929C4.31658 12.9024 3.68342 12.9024 3.29289 13.2929L0.292893 16.2929C-0.0976315 16.6834 -0.0976315 17.3166 0.292893 17.7071C0.683417 18.0976 1.31658 18.0976 1.70711 17.7071L4.70711 14.7071C5.09763 14.3166 5.09763 13.6834 4.70711 13.2929Z"
                                    fill="#2C2C2C" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- All product section start -->
        @include('../site.layouts.section.shop.all-product')
        <!-- All product section end -->
    </section>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
@endsection
