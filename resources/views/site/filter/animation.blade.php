<div class="flex">
    <div class="w-24% mt-19p hidden md:block">
        <div class="border rounded-md px-5 pt-30p pb-2.5">
            <div class="flex justify-between">
                <p class="uppercase roboto-medium text-lg text-gray-12">{{ __('Filters') }}</p>
                <div class="flex items-center clear_all">
                    <p class="mr-1.5 roboto-medium text-xs text-gray-10 font-medium cursor-pointer">{{ __('Clear All') }}</p>
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L7.70711 6.29289C8.09763 6.68342 8.09763 7.31658 7.70711 7.70711C7.31658 8.09763 6.68342 8.09763 6.29289 7.70711L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                            fill="#898989"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.70711 0.292893C7.31658 -0.0976311 6.68342 -0.0976311 6.29289 0.292893L0.292893 6.29289C-0.0976315 6.68342 -0.0976315 7.31658 0.292893 7.70711C0.683417 8.09763 1.31658 8.09763 1.70711 7.70711L7.70711 1.70711C8.09763 1.31658 8.09763 0.683417 7.70711 0.292893Z"
                            fill="#898989"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-2.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Related Categories') }}
                    </h3>
                </div>
                <ul class="mt-13p cate-hover skeleton-box py-10 p-1">

                </ul>
            </div>

            <div class="mt-0.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Price Range') }}
                    </h3>
                </div>
                <ul class="mt-13p skeleton-box py-10">

                </ul>
            </div>

            <form class="mt-18p">
                <div class="flex mb-2">
                    <div class="flex items-center skeleton-box py-3 w-full">

                    </div>

                    <div class="flex items-center ml-13p skeleton-box py-3 w-full">

                    </div>
                </div>
                <button
                    class="skeleton-box py-3 px-2 border rounded mt-2 dm-bold text-sm text-gray-12 w-full h-10 hover:border-gray-12 duration-100 button-update">
                </button>
            </form>

            <div class="mt-1.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Color') }}
                    </h3>
                </div>
                <div class="mt-18p">
                    <div class="skeleton-box py-3 flex items-center c-check mb-2.5 relative w-full">
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-2.5 relative w-full">
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-2.5 relative w-full">
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-2.5 relative w-full">
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-2.5 relative w-full">
                    </div>
                </div>
            </div>

            <div>
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Brand') }}
                    </h3>
                </div>
                <div class="mt-4">
                    <div class="skeleton-box py-3 flex items-center c-check mb-5p w-full">
                        <label for="checkbox-13"
                            class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                        </label>
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-5p w-full">
                        <label for="checkbox-14"
                            class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                        </label>
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-5p w-full">
                        <label for="checkbox-15"
                            class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                        </label>
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-5p w-full">

                        <label for="checkbox-16"
                            class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                        </label>
                    </div>
                    <div class="skeleton-box py-3 flex items-center c-check mb-5p w-full">

                        <label for="checkbox-17"
                            class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Ratings') }}
                    </h3>
                </div>

                <div class="skeleton-box py-1 radio-stars mt-0.5 w-full">
                    <span class="skeleton-box py-1 radio-star-total roboto-medium"> {{ __('Stars') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="w-76% mt-2.5 pb-14 hidden md:block">
        <div class="flex justify-between">
            <span class="text-left dm-sans text-lg flex justify-items-center pl-30p mt-3" id="found_total_item">
            </span>
            <nav class="text-right">
                <button class="rtl-direction-space-left mt-2">
                    <span class="mr-5 text-sm roboto-medium text-gray-12">Sort By:</span>
                    <div class="dropdown rounded shadow-none border relative z-30">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> Price Low to High </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z"
                                    fill="#898989"></path>
                            </svg>

                        </div>
                        <input type="hidden" name="sort_by" value="Price Low to High">
                        <ul class="dropdown-menu">
                            <li id="Price Low to High" class="sort_by bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">Price Low to High</a>
                            </li>
                            <li id="Price High to Low" class="sort_by">
                                <a class="roboto-medium text-xs">Price High to Low</a>
                            </li>
                            <li id="Avg. Ratting" class="sort_by">
                                <a class="roboto-medium text-xs">Avg. Ratting</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="rtl-direction-space-left mt-2 mb-3">
                    <span class="mr-5 text-sm roboto-medium text-gray-12">Showing:</span>
                    <div class="dropdown rounded shadow-none border relative z-30 showing-width">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> 1 </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z"
                                    fill="#898989"></path>
                            </svg>

                        </div>
                        <input type="hidden" name="Showing" value="1">
                        <ul class="dropdown-menu show-list">
                            <li id="1" class="Showing text-center bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">1</a>
                            </li>
                            <li id="2" class="Showing">
                                <a class="roboto-medium text-xs">2</a>
                            </li>
                            <li id="3" class="Showing">
                                <a class="roboto-medium text-xs">3</a>
                            </li>
                            <li id="4" class="Showing">
                                <a class="roboto-medium text-xs">4</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="ml-1.5 hidden">
                    <div class="mb-3 flex items-center c-select relative">
                        <span class="mr-2.5 text-sm roboto-medium text-gray-12">Showing:</span>
                        <select class="mi form-select w-11 appearance-none block px-3 py-1.5 text-sm roboto-regular font-normal text-gray-10 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-200
                                rounded-sm
                                transition-all
                                ease
                                m-0" aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <div class="absolute right-2">
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z"
                                    fill="#898989"></path>
                            </svg>
                        </div>

                    </div>
                </button>

                <button type="button" class="mx-1 hidden sm:inline-block text-gray-200 ml-3 duration-700 text-gray-10"
                    x-on:click="layout = 'grid'" x-bind:class="{'text-gray-10': layout === 'grid'}">
                    <svg class="-mb-5p" width="19" height="19" viewBox="0 0 19 19" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"></path>
                        <path d="M6.78564 0H12.2142V5.42857H6.78564V0Z" fill="currentColor"></path>
                        <path d="M13.5713 0H18.9999V5.42857H13.5713V0Z" fill="currentColor"></path>
                        <path d="M13.5713 6.78564H18.9999V12.2142H13.5713V6.78564Z" fill="currentColor"></path>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"></path>
                        <path d="M6.78564 13.5715H12.2142V19.0001H6.78564V13.5715Z" fill="currentColor"></path>
                        <path d="M13.5713 13.5715H18.9999V19.0001H13.5713V13.5715Z" fill="currentColor"></path>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"></path>
                        <path d="M6.78564 6.78564H12.2142V12.2142H6.78564V6.78564Z" fill="currentColor"></path>
                    </svg>
                </button>

                <button type="button" class="mx-1 py-3 hidden sm:inline-block text-gray-200 duration-700"
                    x-on:click="layout = 'list'" x-bind:class="{'text-gray-10': layout === 'list'}">
                    <svg class="-mb-5p" width="24" height="19" viewBox="0 0 24 19" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.78564 0H23.0714V5.42857H6.78564V0Z" fill="currentColor"></path>
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"></path>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"></path>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"></path>
                        <path d="M6.78564 6.78564H23.0714V12.2142H6.78564V6.78564Z" fill="currentColor"></path>
                        <path d="M6.78564 13.5715H23.0714V19.0001H6.78564V13.5715Z" fill="currentColor"></path>
                    </svg>
                </button>

            </nav>
        </div>


        <div class="sm:col-span-5 md:col-span-5 lg:col-span-3"
            x-bind:class="{'pb-4 lg:col-span-2': layout === 'list','p-3 xl:col-span-2 2xl:col-span-3': layout === 'grid-two'}">

            <div class="grid grid-cols-3 gap-x-30p gap-y-4 pl-30p mt-1"
                x-bind:class="{'grid grid-cols-3': layout === 'grid','space-y-5': layout === 'list'}">

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

                <div x-bind:class="{'flex space-x-30p': layout === 'list',}">
                    <div class="skeleton-box bg-gray-11 rev-img rounded-md relative">
                        <div x-bind:class="{'w-60 skeleton-box': layout === 'list'}"
                            class="p-10 flex justify-center items-center h-60">
                            <!-- <img class="h-40 w-40 border"
                                 alt=""> -->
                        </div>
                    </div>
                    <div x-bind:class="{'text-left': layout === 'list', 'text-center': layout === 'grid' }"
                        class="text-center">
                        <p class="text-13 text-gray-10 roboto-medium mt-3 skeleton-box py-2 inline-block w-56"></p>

                        <p class="skeleton-box py-2 inline-block w-44 text-20 text-gray-12 dm-sans mt-0.5 font-medium"
                            x-bind:class="{'mt-5p': layout === 'list', }">
                        </p>
                        <div class="item-rating mt-1p skeleton-box py-2 inline-block w-56">

                        </div>

                        <p x-bind:class="{'text-gray-10 roboto-medium font-medium text-sm mt-1.5 skeleton-box py-2 w-full': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                        </p>

                        <div x-bind:class="{'text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }"
                            class="hidden">
                            <a href="javascript:void(0)" class="add-to-cart skeleton-box w-44 py-5 inline-block" id="item-add-to-cart" data-itemid="1047">

                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
{{-- for mobile --}}
<div class="md:hidden">
    <div class="flex justify-between mt-2.5">
            <div class="mt-2">
                <button class="bg-gray-12 text-white x:text-xs text-sm rounded x:px-2 px-6 x:py-2.5 py-2">
                    <span class="inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.16753 6.5C1.76866 6.5 1.44531 6.17665 1.44531 5.77778L1.44531 0.722222C1.44531 0.32335 1.76866 -2.82681e-08 2.16753 -6.31387e-08C2.56641 -9.80092e-08 2.88976 0.32335 2.88976 0.722222L2.88976 5.77778C2.88976 6.17665 2.56641 6.5 2.16753 6.5Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.49957 3.61108C6.10069 3.61108 5.77734 3.28773 5.77734 2.88886L5.77734 0.722195C5.77734 0.323323 6.10069 -2.72457e-05 6.49957 -2.7327e-05C6.89844 -2.74084e-05 7.22179 0.323322 7.22179 0.722195L7.22179 2.88886C7.22179 3.28773 6.89844 3.61108 6.49957 3.61108Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.16753 11.5557C1.76866 11.5557 1.44531 11.2323 1.44531 10.8334L1.44531 8.66678C1.44531 8.2679 1.76866 7.94455 2.16753 7.94455C2.56641 7.94455 2.88976 8.2679 2.88976 8.66677L2.88976 10.8334C2.88976 11.2323 2.56641 11.5557 2.16753 11.5557Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8336 11.5557C10.4347 11.5557 10.1113 11.2323 10.1113 10.8334L10.1113 9.389C10.1113 8.99013 10.4347 8.66678 10.8335 8.66678C11.2324 8.66677 11.5558 8.99012 11.5558 9.389L11.5558 10.8334C11.5558 11.2323 11.2324 11.5557 10.8336 11.5557Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.49957 11.5557C6.10069 11.5557 5.77734 11.2323 5.77734 10.8334L5.77734 5.77789C5.77734 5.37901 6.10069 5.05566 6.49956 5.05566C6.89844 5.05566 7.22179 5.37901 7.22179 5.77789L7.22179 10.8334C7.22179 11.2323 6.89844 11.5557 6.49957 11.5557Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.33203 2.88897C4.33203 2.4901 4.65538 2.16675 5.05425 2.16675L7.94314 2.16675C8.34201 2.16675 8.66536 2.4901 8.66536 2.88897C8.66536 3.28784 8.34201 3.61119 7.94314 3.61119L5.05425 3.61119C4.65538 3.61119 4.33203 3.28784 4.33203 2.88897Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8.66656C0 8.26769 0.32335 7.94434 0.722222 7.94434L3.61111 7.94434C4.00998 7.94434 4.33333 8.26769 4.33333 8.66656C4.33333 9.06543 4.00998 9.38878 3.61111 9.38878H0.722222C0.32335 9.38878 0 9.06543 0 8.66656Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.66797 9.38897C8.66797 8.9901 8.99132 8.66675 9.39019 8.66675H12.2791C12.678 8.66675 13.0013 8.9901 13.0013 9.38897C13.0013 9.78784 12.678 10.1112 12.2791 10.1112H9.39019C8.99132 10.1112 8.66797 9.78784 8.66797 9.38897Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8336 7.22217C10.4347 7.22217 10.1113 6.89882 10.1113 6.49995L10.1113 0.722168C10.1113 0.323296 10.4347 -5.43842e-05 10.8335 -5.44147e-05C11.2324 -5.44452e-05 11.5558 0.323295 11.5558 0.722168L11.5558 6.49995C11.5558 6.89882 11.2324 7.22217 10.8336 7.22217Z" fill="white"/>
                            </svg>
                    </span>
                    Filter
                </button>
            </div>
            <nav class="text-right">
                <button class="rtl-direction-space-left mt-2">
                    <span class="mr-5 text-sm roboto-medium text-gray-12 hidden md:inline-block">{{ __('Sort By:') }}</span>
                    <div class="filter-dropdown dropdown rounded shadow-none border relative z-30">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> Price Low to High </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>

                        </div>
                        <input type="hidden" name="sort_by" value="Price Low to High">
                        <ul class="dropdown-menu">
                            <li id="Price Low to High" class="sort_by bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">{{ __('Price Low to High') }}</a>
                            </li>
                            <li id="Price High to Low" class="sort_by">
                                <a class="roboto-medium text-xs">{{ __('Price High to Low') }}</a>
                            </li>
                            <li id="Avg. Ratting" class="sort_by">
                                <a class="roboto-medium text-xs">{{ __('Avg. Ratting') }}</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="rtl-direction-space-left mt-2 mb-3 hidden md:inline-block">
                    <span class="mr-5 text-sm roboto-medium text-gray-12">Showing:</span>
                    <div class="dropdown rounded shadow-none border relative z-30 showing-width">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> 1 </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>

                        </div>
                        <input type="hidden" name="Showing" value="1">
                        <ul class="dropdown-menu show-list">
                            <li id="1" class="Showing text-center bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">1</a>
                            </li>
                            <li id="2" class="Showing">
                                <a class="roboto-medium text-xs">2</a>
                            </li>
                            <li id="3" class="Showing">
                                <a class="roboto-medium text-xs">3</a>
                            </li>
                            <li id="4" class="Showing">
                                <a class="roboto-medium text-xs">4</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="ml-1.5 hidden">
                    <div class="mb-3 flex items-center c-select relative">
                        <span class="mr-2.5 text-sm roboto-medium text-gray-12">Showing:</span>
                        <select class="mi form-select w-11 appearance-none block px-3 py-1.5 text-sm roboto-regular font-normal text-gray-10 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-200
                                rounded-sm
                                transition-all
                                ease
                                m-0" aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <div class="absolute right-2">
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>
                        </div>

                    </div>
                </button>

                <button type="button" class="mx-1  sm:inline-block text-gray-200 md:ml-3 duration-700" x-on:click="layout = 'grid'"
                        x-bind:class="{'text-gray-10': layout === 'grid'}">
                    <svg class="-mb-5p" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"/>
                        <path d="M6.78564 0H12.2142V5.42857H6.78564V0Z" fill="currentColor"/>
                        <path d="M13.5713 0H18.9999V5.42857H13.5713V0Z" fill="currentColor"/>
                        <path d="M13.5713 6.78564H18.9999V12.2142H13.5713V6.78564Z" fill="currentColor"/>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"/>
                        <path d="M6.78564 13.5715H12.2142V19.0001H6.78564V13.5715Z" fill="currentColor"/>
                        <path d="M13.5713 13.5715H18.9999V19.0001H13.5713V13.5715Z" fill="currentColor"/>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"/>
                        <path d="M6.78564 6.78564H12.2142V12.2142H6.78564V6.78564Z" fill="currentColor"/>
                    </svg>
                </button>

                <button type="button" class="mx-1 py-3  sm:inline-block text-gray-200 duration-700" x-on:click="layout = 'list'"
                        x-bind:class="{'text-gray-10': layout === 'list'}">
                    <svg class="-mb-5p" width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.78564 0H23.0714V5.42857H6.78564V0Z" fill="currentColor"/>
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"/>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"/>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"/>
                        <path d="M6.78564 6.78564H23.0714V12.2142H6.78564V6.78564Z" fill="currentColor"/>
                        <path d="M6.78564 13.5715H23.0714V19.0001H6.78564V13.5715Z" fill="currentColor"/>
                    </svg>
                </button>

            </nav>
    </div>
    <div id="res-loader" class="flex flex-col justify-around h-1/2 -mt-4">
        <svg class="h-10 w-10 sm:h-16 sm:w-16" id="loading-spinner" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle id="loading-circle-large" cx="40" cy="40" r="36" stroke="#FCCA19" stroke-width="8" />
        </svg>
    </div>
</div>

