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
                <p class=" mb-5 pl-5 pr-5 roboto-medium font-medium text-gray-2 text-sm">Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Eget nisi tincidunt venenatis viverra nibh neque. Neque iaculis lorem
                    mattis ac mattis.
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
                        <p class="text-2xl"> 86%</p>
                    </div>
                    <div>
                        <a href=""
                            class="bg-yellow-1 text-gray-12 font-bold dm-bold text-sm ml-5 rounded-sm  px-8 flex items-start">
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
            <img class="h-350-w-830 ml-4" src="{{ asset('public/frontend/assets/img/vendor-shop/Banner Static.png') }}"
                alt="">
        </div>
        {{-- Slider --}}
        <div class="flex mt-30p justify-between">
            <div>
                <img class=" h-56 mr-4 pr-5 relative"
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
            <img src="{{ asset('public/frontend/assets/img/vendor-shop/Group 8995.png') }}" alt="">
        </div>
        {{-- menu items and search --}}
        <div class="relative flex content-start items-center">
            <div class=" border-b mt-10 py-2 mr-5 border-line">
                <div class="relative flex">
                    <div
                        class="relative flex text-center  mr-10 custom-bottom-borders font-medium dm-sans h-6 text-lg cursor-pointer text-gray-10">
                        <a class="px-60p " href="{{ route('site.shop', ['alias' => $shop->alias]) }}">
                            {{ __('Home') }} </a>
                    </div>
                    <div
                        class="relative flex  mr-12 custom-bottom-borders font-medium dm-sans h-6 text-lg cursor-pointer text-gray-10 ">
                        <a class="px-12" href="{{ route('site.shopAll', ['alias' => $shop->alias]) }}">
                            {{ __('All Products') }}</a>
                    </div>
                    <div
                        class=" relative flex  custom-bottom-borders font-medium dm-sans h-6 text-lg cursor-pointer text-gray-10 ">
                        <a class="px-11" href="#"> {{ __('Vendor Profile') }} </a>
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
        {{-- third section --}}
        <div class="mt-11  rounded-lg border border-gray-11">
            <div class="grid grid-cols-8">
                <div class="col-span-2 border-r border-gray-11">
                    <div class="mt-4 mr-4">
                        <div class="flex justify-end">
                            <svg class="mt-0.5" xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                viewBox="0 0 17 16" fill="none">
                                <path
                                    d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z"
                                    fill="#FCCA19" />
                            </svg>
                            <span class="dm-sans font-medium text-gray-12 text-base"> 4.4</span>
                        </div>
                        <img class="m-auto"
                            src="{{ asset('public/frontend/assets/img/vendor-shop/Ellipse 175.png') }}" alt="">
                        <div class="text-center mt-6 mb-10">
                            <span
                                class="bg-yellow-1 py-1.5 px-2 rounded-sm roboto-medium font-medium text-gray-12 text-xs ">Top
                                Seller</span>
                            <p class="text-gray-12 font-bold dm-bold text-2xl mt-2.5">{{ $shop->name }}</p>
                            <p class="text-gray-10 roboto-medium font-medium text-xs mt-2.5">Multi-Category Shop</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 w-full flex bg-gray-11">
                    <div>
                        <div class="bg-white inline-flex rounded-sm m-5 ">
                            <div>
                                <p class="text-gray-12 mt-3.5 ml-15p dm-sans font-medium text-sm">Have any query?</p>
                                <p class="text-gray-12 mb-3.5 ml-15p dm-bold font-bold text-lg">Send us a message</p>
                            </div>
                            <div class="m-15p ml-8">
                                <a href=""
                                    class="bg-yellow-1 text-gray-12 font-bold dm-bold text-sm ml-5 rounded-sm  px-8 flex items-start">
                                    <span class=" my-3.5"> Chat Now</span> <svg class="ml-2  my-3.5"
                                        xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18"
                                        fill="none">
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
                        <div>
                            <p class="text-gray-10 roboto-medium font-medium text-sm ml-5">Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Eget nisi tincidunt <br> venenatis
                                viverra nibh neque. Neque iaculis lorem mattis ac mattis. Jingo <br> dofela bolisa nio hemi
                                daroki.</p>
                        </div>
                        <div class="flex mt-5">
                            <a class="flex title-font font-medium ml-5 items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                    fill="none">
                                    <path
                                        d="M1.47651 0.76132L1.99175 0.246076C2.31985 -0.082025 2.85181 -0.0820256 3.17991 0.246075L5.35237 2.41854C5.68047 2.74664 5.68047 3.2786 5.35237 3.6067L3.84647 5.1126C3.59536 5.36371 3.53311 5.74733 3.69192 6.06496C4.61001 7.90113 6.09887 9.38999 7.93504 10.3081C8.25267 10.4669 8.63629 10.4046 8.8874 10.1535L10.3933 8.64763C10.7214 8.31953 11.2534 8.31953 11.5815 8.64763L13.7539 10.8201C14.082 11.1482 14.082 11.6801 13.7539 12.0082L13.2387 12.5235C11.4648 14.2974 8.65654 14.4969 6.64965 12.9918L5.63439 12.2303C4.16956 11.1317 2.86831 9.83044 1.76968 8.36561L1.00824 7.35036C-0.496933 5.34346 -0.297357 2.53518 1.47651 0.76132Z"
                                        fill="#2C2C2C" />
                                </svg>

                                <span
                                    class="ml-3 text-xs font-medium  cursor-pointer transition-all rtl-direction-space roboto-medium">(+88)
                                    014423735455, (+88) 4355633</span>
                            </a>
                            <a class="flex title-font font-medium ml-5 items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.683417 0.753154C0 1.50631 0 2.71849 0 5.14286V6.85714C0 9.28151 0 10.4937 0.683417 11.2468C1.36683 12 2.46678 12 4.66667 12H9.33333C11.5332 12 12.6332 12 13.3166 11.2468C14 10.4937 14 9.28151 14 6.85714V5.14286C14 2.71849 14 1.50631 13.3166 0.753154C12.6332 0 11.5332 0 9.33333 0H4.66667C2.46678 0 1.36683 0 0.683417 0.753154ZM2.76477 2.71539C2.40736 2.4528 1.92446 2.55923 1.68618 2.95311C1.44791 3.347 1.54449 3.87917 1.9019 4.14176L6.13713 7.25336C6.65964 7.63724 7.34036 7.63724 7.86287 7.25336L12.0981 4.14176C12.4555 3.87917 12.5521 3.347 12.3138 2.95311C12.0755 2.55923 11.5926 2.4528 11.2352 2.71539L7 5.82699L2.76477 2.71539Z"
                                        fill="#2C2C2C" />
                                </svg>

                                <span
                                    class="ml-3 text-xs font-medium  cursor-pointer transition-all rtl-direction-space roboto-medium">support@gizmotizmo.org</span>
                            </a>
                        </div>
                        <div class="ml-5 mt-5">
                            <a class="flex title-font font-medium  items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.39804 15.901C8.88097 15.1271 14 12.0901 14 7.04299C14 3.15325 10.866 0 7 0C3.13401 0 0 3.15325 0 7.04299C0 12.0901 5.11903 15.1271 6.60196 15.901C6.85483 16.033 7.14517 16.033 7.39804 15.901ZM7 10.0614C8.65685 10.0614 10 8.71002 10 7.04299C10 5.37596 8.65685 4.02457 7 4.02457C5.34315 4.02457 4 5.37596 4 7.04299C4 8.71002 5.34315 10.0614 7 10.0614Z"
                                        fill="#2C2C2C" />
                                </svg>
                                <span
                                    class="ml-3 pt-4 text-xs font-medium  cursor-pointer transition-all rtl-direction-space roboto-medium">239
                                    Zoom Tower, Gazi Hillview, Tongi, <br>
                                    Bangladesh</span>
                            </a>
                        </div>
                    </div>
                    <div class="m-5">
                        <div class=" flex">
                            <div
                                class="hover:bg-gray-12 bg-white pt-5 pl-15p hover:text-white text-gray-12 cursor-pointer dm-sans font-medium text-base  rounded">
                                <p class="mb-3 mr-10">Positive Seller
                                    <br> Ratings
                                </p>
                                <p class="roboto-medium font-medium text-2.5xl mb-4">86%</p>
                            </div>
                            <div
                                class="ml-15p hover:bg-gray-12 bg-white  hover:text-white cursor-pointer text-gray-12 pt-5 pl-15p dm-sans font-medium text-base  rounded ">
                                <p class="mb-3 mr-12">Shipment on
                                    <br> Time
                                </p>
                                <p class="roboto-medium font-medium text-2.5xl text-green-3 ">94%</p>
                            </div>
                        </div>
                        <div class="flex mt-15p">
                            <div
                                class="  pt-5 pl-15p hover:bg-gray-12 bg-white cursor-pointer hover:text-white text-gray-12 dm-sans font-medium text-base  rounded ">
                                <p class="mb-3 mr-12">Seller’s
                                    <br> Cancellation
                                </p>
                                <p class="roboto-medium font-medium text-2.5xl text-orange-1 mb-4">6%</p>
                            </div>
                            <div
                                class="ml-15p hover:bg-gray-12 bg-white  hover:text-white cursor-pointer pt-5 pl-15p text-gray-12 dm-sans font-medium text-base  rounded ">
                                <p class="mb-3 mr-7 ">Chat Response
                                    <br> Rate
                                </p>
                                <p class="roboto-medium font-medium text-2.5xl text-green-3 ">98%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- review section --}}
        <div>
            <div class=" review mt-11">
                <div class="mt-4">
                    <div class="grid grid-cols-12 ">
                        <div class="col-span-4">
                            <div class="flex items-center">
                                <p class="text-52 text-gray-12 dm-bold">{{ round(4.4) }}</p>
                                <div class="pl-2.5">
                                    <p class="roboto-medium text-base text-gray-12">{{ __('Seller Rating') }}</p>
                                    <ul class="flex items-center focus-within mt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                <svg class="text-green-500" width="13" height="12" viewBox="0 0 13 12"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" />
                                                </svg>
                                            </li>
                                        @endfor
                                        <p class="text-gray-10 text-xs roboto-medium ml-1">(80 Reviews)</p>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-1 tracking-wide py-4">
                                <div class="pb-3">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <div class="flex items-center mt-1">
                                            <div class=" text-indigo-500 tracking-tighter mr-4">
                                                <ul class="flex">
                                                    @for ($j = 1; $j <= 5; $j++)
                                                        <li>
                                                            <svg class="text-green-500" width="13" height="12"
                                                                viewBox="0 0 13 12" fill="currentColor"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" />
                                                            </svg>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <div class="w-full">
                                                <div class="bg-gray-6 w-full rounded-lg h-2">
                                                    <div data-width="gfgdfffff"
                                                        class="rating-width bg-green-500 color_switch_bac rounded-lg h-2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-1/5 text-gray-700 pl-3">
                                                <span class="text-sm">78%</span>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="col-span-8 ml-12 text-left">
                            <div id="review-section" class="flex justify-between items-center border-b pb-1">
                                <h2 class="font-bold text-gray-12 dm-bold text-20">
                                    Product Reviews
                                </h2>
                                <div class="flex justify-center pr-4 items-center">
                                    <div x-data="{ dropdownOpen: false }" class="relative ml-2">
                                        <button @click="dropdownOpen = !dropdownOpen"
                                            class="inline-flex justify-between items-center w-48 rounded  px-2 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                            <div class="flex text-gray-500 items-center">
                                                <svg class="mr-5p" width="14" height="14" viewBox="0 0 14 14"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M0 1.57238C0 0.703977 0.696446 0 1.55556 0H12.4444C13.3036 0 14 0.703977 14 1.57238V2.8191C14 3.23612 13.8361 3.63606 13.5444 3.93094L10.1111 7.40135V11.5095C10.1111 12.0171 9.78977 12.4677 9.31337 12.6283L5.42448 13.9386C4.66903 14.1931 3.88888 13.6247 3.88888 12.8198V7.40134L0.455612 3.93094C0.163888 3.63606 0 3.23612 0 2.8191V1.57238ZM12.4444 1.57238H1.55556V2.8191L4.98883 6.2895C5.28055 6.58438 5.44444 6.98432 5.44444 7.40134V12.2744L8.55555 11.2262V7.40135C8.55555 6.98433 8.71944 6.58439 9.01116 6.28951L12.4444 2.8191V1.57238Z"
                                                        fill="#898989" />
                                                </svg>
                                                <span class="roboto-medium text-base text-gray-10">Filter:</span>
                                            </div>
                                            <svg width="15" height="8" viewBox="0 0 15 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.87867e-08 1.39309L1.5814 1.8858e-08L7.5 5.21383L13.4186 1.60015e-07L15 1.39309L7.5 8L7.87867e-08 1.39309Z"
                                                    fill="#898989" />
                                            </svg>
                                        </button>
                                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                            class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>
                                        <div x-show="dropdownOpen"
                                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded shadow z-20"
                                            style="display: none;">
                                            <button @click="dropdownOpen = false" data-star="0" data-item=""
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="text-green-500 text-md">✓</span><span
                                                    class="inline-block ml-3 text-green-500">All Star</span>
                                            </button>
                                            <button @click="dropdownOpen = false" data-star="5" data-item=" "
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="inline-block ml-6">5 Star</span>
                                            </button>
                                            <button @click="dropdownOpen = false" data-star="4" data-item=" "
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="inline-block ml-6">4 Star</span>
                                            </button>
                                            <button @click="dropdownOpen = false" data-star="3" data-item=" "
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="inline-block ml-6">3 Star</span>
                                            </button>
                                            <button @click="dropdownOpen = false" data-star="2" data-item=" "
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="inline-block ml-6">2 Star</span>
                                            </button>

                                            <button @click="dropdownOpen = false" data-star="1" data-item=" "
                                                class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <span class="inline-block ml-6">1 Star</span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="load_review">
                                <div class="container">
                                    <div class="pt-8 flex flex-wrap md:flex-nowrap">
                                        <div class="flex-shrink-0 flex flex-col">
                                            <img class="w-14 h-14 mr-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0"
                                                src="{{ asset('public/frontend/assets/img/vendor-shop/Ellipse 175 (2).png') }}"
                                                alt="">
                                        </div>
                                        <div class="md:flex-grow rtl-direction-space-review">
                                            <div class="flex justify-between">
                                                <p class="text-gray-12 text-lg dm-bold">
                                                    {{ __('John Kenedy') }}</p>
                                                <div class="flex items-center">
                                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M7.1239 0.485884C7.24974 0.190417 7.53052 0 7.84036 0C9.57241 0 10.9765 1.46524 10.9765 3.27271V5.72724H14.6261C15.3144 5.72059 15.971 6.02891 16.4228 6.57105C16.8756 7.11448 17.0769 7.83801 16.9733 8.55L15.8914 15.9135C15.8914 15.9137 15.8914 15.9133 15.8914 15.9135C15.7155 17.1217 14.7147 18.0112 13.5441 17.9999H2.35211C1.05308 17.9999 0 16.901 0 15.5454V9.81812C0 8.46252 1.05308 7.36359 2.35211 7.36359H4.19469L7.1239 0.485884ZM3.92018 8.99995H2.35211C1.9191 8.99995 1.56807 9.36626 1.56807 9.81812V15.5454C1.56807 15.9972 1.9191 16.3635 2.35211 16.3635H3.92018V8.99995ZM5.48825 16.3635V8.3554L8.31709 1.71335C8.95002 1.92389 9.40844 2.54243 9.40844 3.27271V6.54542C9.40844 6.99728 9.75946 7.36359 10.1925 7.36359H14.6301L14.639 7.36354C14.869 7.36082 15.0886 7.46365 15.2395 7.64479C15.3904 7.82585 15.4575 8.06689 15.4231 8.30412C15.4231 8.30401 15.4231 8.30423 15.4231 8.30412L14.341 15.6681C14.2824 16.0715 13.948 16.3682 13.557 16.3636L5.48825 16.3635Z"
                                                            fill="#2C2C2C" />
                                                    </svg>
                                                    <p class="ml-2 roboto-medium text-13 text-gray-12">Helpful (2)</p>
                                                    <div class="flex ml-4">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M16.3397 2.51762C16.2456 2.00279 15.7857 1.62718 15.2503 1.63651L15.2356 1.63664H13.8492V9.00015H15.2356L15.2503 9.00028C15.7857 9.00961 16.2456 8.634 16.3397 8.11917V2.51762ZM12.1889 9.64469V1.63664H3.64552C3.23157 1.63203 2.87743 1.92864 2.81536 2.33203L1.66973 9.69565C1.6697 9.69582 1.66976 9.69547 1.66973 9.69565C1.63337 9.93281 1.70434 10.1743 1.86405 10.3553C2.02387 10.5364 2.25634 10.6393 2.49989 10.6365L2.50929 10.6364L7.20797 10.6365C7.66645 10.6365 8.03813 11.0028 8.03813 11.4547V14.7273C8.03813 15.4576 8.52351 16.0761 9.19366 16.2867L12.1889 9.64469ZM13.5586 10.6365L10.457 17.5141C10.3238 17.8096 10.0265 18 9.69844 18C7.86451 18 6.37781 16.5348 6.37781 14.7273V12.2728H2.51353C1.78477 12.2795 1.0895 11.9712 0.611165 11.429C0.131702 10.8856 -0.081431 10.1621 0.0282194 9.45009L1.17382 2.08668C1.17386 2.08644 1.17378 2.08693 1.17382 2.08668C1.36009 0.87857 2.41974 -0.0110148 3.65913 0.000301913H15.2289C16.619 -0.0200071 17.806 0.986519 17.9925 2.34514C17.9975 2.38149 18 2.41813 18 2.45481V8.18198C18 8.21866 17.9975 8.2553 17.9925 8.29165C17.806 9.65027 16.619 10.6568 15.2289 10.6365H13.5586Z"
                                                                fill="#898989" />
                                                        </svg>
                                                        <p class="ml-2 roboto-medium text-13 text-gray-10">Unhelpful (2)
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="roboto-medium text-gray-10 text-xs">
                                                6 January, 2022 at 2:43 pm
                                            </p>
                                            <div class="flex  justify-between ">
                                                <div>
                                                    <ul class="flex">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <li>
                                                                <svg class="text-green-500 mt-25p" width="20" height="19"
                                                                    viewBox="0 0 20 19" fill="#FCCA19"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10.0381 0L12.2918 6.93615H19.5849L13.6846 11.2229L15.9383 18.1591L10.0381 13.8723L4.13785 18.1591L6.39154 11.2229L0.4913 6.93615H7.7844L10.0381 0Z" />
                                                                </svg>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="leading-relaxed mt-2.5 text-gray-10 roboto-medium text-sm">
                                                Lorem ipsum dolor sit 2007, consectetur adipiscing elit. Eu pretium lacus
                                                mattis tristique est nisl amet commodo, volutpat. Cras egestas id in amet
                                                aliquet arcu. Adipiscing vivamus adipiscing arcu sem malesuada mauris duis.
                                                Quis rutrum sed nunc scelerisque eleifend sed.
                                            </p>
                                            <div class="mt-5 flex">
                                                <img class="border border-gray-2 rounded-sm"
                                                    src="{{ asset('public/frontend/assets/img/vendor-shop/white-back-sweater 1.png') }}"
                                                    alt="">
                                                <img class=" ml-3 border border-gray-2 rounded-sm"
                                                    src="{{ asset('public/frontend/assets/img/vendor-shop/pink-sweater-front 5.png') }}"
                                                    alt="">
                                                <img class=" ml-3 border border-gray-2 rounded-sm"
                                                    src="{{ asset('public/frontend/assets/img/vendor-shop/pink-sweater-front 5.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="ml-9 mt-15p bg-gray-11">
                                                <p class="roboto-medium font-medium italic text-sm p-3 pb-0 text-gray-12">
                                                    Gizmo Tizmo responded:</p>
                                                <p
                                                    class="text-gray-10 roboto-medium ml-12 pb-3 mt-5p mr-4 font-medium italic text-xs">
                                                    “Lorem ipsum dolor sit 2007, consectetur adipiscing elit. Eu pretium
                                                    lacus mattis tristique est nisl amet
                                                    commodo, volutpat. Cras egestas id in amet aliquet arcu.”</p>
                                            </div>
                                            <div class="mt-8">
                                                <a href=""
                                                    class="dm-sans flex justify-center font-medium text-lg  text-gray-12">
                                                    <span>See All Reviews</span>
                                                    <svg class="mt-2.5 ml-2" xmlns="http://www.w3.org/2000/svg"
                                                        width="15" height="10" viewBox="0 0 15 10" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                                                            fill="#2C2C2C" />
                                                    </svg></a>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="border mt-5 border-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
@endsection
