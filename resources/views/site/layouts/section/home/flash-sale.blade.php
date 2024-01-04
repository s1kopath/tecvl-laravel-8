@if (count($flashSale) > 0)
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-30p md:mt-53p">
    <div class="flex justify-center md:justify-between md:items-center">
        <div>
            <div class="flex">
                <div class="w-full md:w-385p">
                    <P class="dm-bold text-sm text-center md:text-left md:text-22 text-gray-12 uppercase">{{ __('Flash Sale') }}</P>
                </div>
                {{-- Flash sale counter will be here... --}}
            </div>
        </div>

        <a href="#" class="process-goto relative justify-center text-gray-10 font-medium text-base dm-sans hidden md:inline-flex items-center py-2 dm-sans">
            <span class="-ml-5">{{ __('See More') }}</span>
            <svg class="ml-2 relative"  width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="#898989"/>
            </svg>
        </a>
    </div>

    <div class="flex flex-col md:flex-row mt-5">
        <div class="w-full md:w-322p">
            <div class="relative bg-gray-11 rounded-md pb-0.5">
                <div class="p-4">
                    <p class="text-xs rounded-sm roboto-medium font-medium text-gray-12 text-center px-1.5 py-1 bg-yellow-1 w-25">Deal of the Day</p>
                </div>
                <div class="flex justify-center">
                    <img width="180px" height="160px" src="{{ asset('public/frontend/assets/img/product/healmate2.png') }}" alt="">
                </div>

                <div class="text-center bg-white mx-4 mb-4 mt-8  rounded">
                    <p class="text-base md:text-lg text-gray-12 mt-2 pt-4 px-5 dm-regular font-normal">Galactonimo <br>
                        Black & White Red
                        Devil 2K Helmet
                    </p>
                    <div class="item-rating">
                        <div class="self-top">
                            <ul class="flex justify-center mt-2">
                                <li class="mt-1">
                                    <svg class="h-5 w-5 text-yellow-1" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"/>
                                    </svg>

                                </li>

                                <li class="mt-1">
                                    <svg class="h-5 w-5 text-yellow-1" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"/>
                                    </svg>
                                </li>

                                <li class="mt-1">
                                    <svg class="h-5 w-5 text-yellow-1" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"/>
                                    </svg>
                                </li>

                                <li class="mt-1">
                                    <svg class="h-5 w-5 text-yellow-1" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"/>
                                    </svg>
                                </li>

                                <li class="mt-1">
                                    <svg class="h-5 w-5 text-yellow-1" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"/>
                                    </svg>
                                </li>
                            </ul>

                            <p class="ml-1.5 text-gray-10 text-13 md:text-sm dm-sans mt-1.5">
                                (44 Reviews)
                            </p>
                        </div>
                    </div>
                    <p class="text-xl text-gray-12 dm-bold mt-3 pb-4">$79.99</p>
                </div>
            </div>
        </div>
        <div class="w-full md:pl-5 md:mt-0 mt-30p">
            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-5">
                @foreach($flashSale as $key => $item)
                    @include('site.layouts.section.card-one')
                @endforeach
            </div>
            <a href="" class="md:hidden mt-30p pb-15p process-goto relative flex justify-center text-gray-12 font-medium text-sm items-center dm-sans border-b">
                <span>See More</span>
                <svg class="ml-2 relative" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z" fill="#898989"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
