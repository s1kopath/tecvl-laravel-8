<div>
    <div class="bg-gray-11 rev-img rounded-md relative">
        <div class="p-10 flex justify-center">
            <img class="h-20 w-20" src="{{ $item->fileUrl(['home' => true]) }}" alt="">
        </div>

        <div
            class="opacity-0 hover:opacity-100 duration-300 absolute inset-0 z-10 flex justify-center items-center text-xl text-white font-semibold">
            <div class="absolute flex justify-center bg-gray-100 h-6 w-6 cursor-pointer top-2 right-2">
                <a href="" class="relative sm:px-4 py-2 block w-fill">
                    <div slot="icon" class="relative">
                        {{-- Add to cart --}}
                        @if (!hasOption($item->id))
                            <a href="javascript:void(0)" class="add-to-cart" data-itemId={{ $item->id }}>
                                <div
                                    class="h-6 w-6 p-1 text-gray-12 hover:bg-yellow-1 border border-gray-2 rounded-full">
                                    <svg viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.81845 6.09833C3.48337 6.09833 3.21173 5.82669 3.21173 5.49161L3.21173 3.06475C3.21173 1.38935 4.56991 0.0311725 6.24531 0.0311728C7.92071 0.0311726 9.27889 1.38935 9.27889 3.06475L9.27889 5.49161C9.27889 5.82669 9.00725 6.09833 8.67217 6.09833C8.33709 6.09833 8.06545 5.82669 8.06545 5.49161L8.06545 3.06475C8.06545 2.05951 7.25055 1.2446 6.24531 1.2446C5.24007 1.2446 4.42516 2.05951 4.42516 3.06475L4.42516 5.49161C4.42516 5.82669 4.15353 6.09833 3.81845 6.09833Z"
                                            fill="#2C2C2C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.58666 3.06488C3.59925 3.06488 3.61187 3.06488 3.62454 3.06488L8.9038 3.06488C9.40133 3.06485 9.83213 3.06483 10.18 3.11C10.5538 3.15855 10.9128 3.26765 11.2149 3.54562C11.517 3.82358 11.6555 4.17222 11.7349 4.54078C11.8088 4.88366 11.8446 5.31296 11.8859 5.80877L12.2008 9.5876C12.2017 9.5992 12.2027 9.61078 12.2037 9.62235C12.2268 9.8996 12.2491 10.1666 12.2371 10.3873C12.2236 10.6348 12.1639 10.9229 11.9392 11.1671C11.7146 11.4113 11.4323 11.4947 11.1869 11.5287C10.9679 11.559 10.7 11.559 10.4218 11.5589C10.4102 11.5589 10.3986 11.5589 10.3869 11.5589H2.10355C2.09191 11.5589 2.08029 11.5589 2.06868 11.5589C1.79046 11.559 1.52258 11.559 1.30358 11.5287C1.05812 11.4947 0.775903 11.4113 0.551227 11.1671C0.326551 10.9229 0.266872 10.6348 0.253375 10.3873C0.241334 10.1666 0.263631 9.8996 0.286789 9.62234C0.287755 9.61078 0.288722 9.5992 0.289688 9.5876L0.601444 5.84654C0.602496 5.83391 0.603543 5.82133 0.604588 5.80879C0.645877 5.31297 0.681628 4.88366 0.755526 4.54078C0.834957 4.17222 0.97349 3.82358 1.27559 3.54562C1.57768 3.26765 1.93662 3.15855 2.3105 3.11C2.65833 3.06483 3.08913 3.06485 3.58666 3.06488ZM2.46675 4.31332C2.22362 4.3449 2.14342 4.39604 2.09721 4.43856C2.051 4.48108 1.99338 4.55675 1.94172 4.79642C1.8864 5.05311 1.85605 5.40287 1.81068 5.94731L1.49893 9.68837C1.47182 10.0136 1.45811 10.1948 1.46501 10.3212C1.46509 10.3229 1.46519 10.3245 1.46528 10.326C1.46684 10.3263 1.46843 10.3265 1.47006 10.3267C1.59552 10.3441 1.77714 10.3455 2.10355 10.3455H10.3869C10.7133 10.3455 10.8949 10.3441 11.0204 10.3267C11.022 10.3265 11.0236 10.3263 11.0252 10.326C11.0253 10.3245 11.0254 10.3229 11.0255 10.3212C11.0324 10.1948 11.0186 10.0136 10.9915 9.68837L10.6798 5.94731C10.6344 5.40287 10.6041 5.05311 10.5487 4.79642C10.4971 4.55675 10.4395 4.48108 10.3932 4.43856C10.347 4.39604 10.2668 4.3449 10.0237 4.31332C9.76332 4.27951 9.41224 4.27831 8.86592 4.27831H3.62454C3.07822 4.27831 2.72714 4.27951 2.46675 4.31332Z"
                                            fill="#2C2C2C" />
                                    </svg>
                                </div>
                            </a>
                        @else
                            <a
                                href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}">
                                <div
                                    class="h-6 w-6 p-1 text-gray-12 hover:bg-yellow-1 border border-gray-2 rounded-full">
                                    <svg viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.81845 6.09833C3.48337 6.09833 3.21173 5.82669 3.21173 5.49161L3.21173 3.06475C3.21173 1.38935 4.56991 0.0311725 6.24531 0.0311728C7.92071 0.0311726 9.27889 1.38935 9.27889 3.06475L9.27889 5.49161C9.27889 5.82669 9.00725 6.09833 8.67217 6.09833C8.33709 6.09833 8.06545 5.82669 8.06545 5.49161L8.06545 3.06475C8.06545 2.05951 7.25055 1.2446 6.24531 1.2446C5.24007 1.2446 4.42516 2.05951 4.42516 3.06475L4.42516 5.49161C4.42516 5.82669 4.15353 6.09833 3.81845 6.09833Z"
                                            fill="#2C2C2C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.58666 3.06488C3.59925 3.06488 3.61187 3.06488 3.62454 3.06488L8.9038 3.06488C9.40133 3.06485 9.83213 3.06483 10.18 3.11C10.5538 3.15855 10.9128 3.26765 11.2149 3.54562C11.517 3.82358 11.6555 4.17222 11.7349 4.54078C11.8088 4.88366 11.8446 5.31296 11.8859 5.80877L12.2008 9.5876C12.2017 9.5992 12.2027 9.61078 12.2037 9.62235C12.2268 9.8996 12.2491 10.1666 12.2371 10.3873C12.2236 10.6348 12.1639 10.9229 11.9392 11.1671C11.7146 11.4113 11.4323 11.4947 11.1869 11.5287C10.9679 11.559 10.7 11.559 10.4218 11.5589C10.4102 11.5589 10.3986 11.5589 10.3869 11.5589H2.10355C2.09191 11.5589 2.08029 11.5589 2.06868 11.5589C1.79046 11.559 1.52258 11.559 1.30358 11.5287C1.05812 11.4947 0.775903 11.4113 0.551227 11.1671C0.326551 10.9229 0.266872 10.6348 0.253375 10.3873C0.241334 10.1666 0.263631 9.8996 0.286789 9.62234C0.287755 9.61078 0.288722 9.5992 0.289688 9.5876L0.601444 5.84654C0.602496 5.83391 0.603543 5.82133 0.604588 5.80879C0.645877 5.31297 0.681628 4.88366 0.755526 4.54078C0.834957 4.17222 0.97349 3.82358 1.27559 3.54562C1.57768 3.26765 1.93662 3.15855 2.3105 3.11C2.65833 3.06483 3.08913 3.06485 3.58666 3.06488ZM2.46675 4.31332C2.22362 4.3449 2.14342 4.39604 2.09721 4.43856C2.051 4.48108 1.99338 4.55675 1.94172 4.79642C1.8864 5.05311 1.85605 5.40287 1.81068 5.94731L1.49893 9.68837C1.47182 10.0136 1.45811 10.1948 1.46501 10.3212C1.46509 10.3229 1.46519 10.3245 1.46528 10.326C1.46684 10.3263 1.46843 10.3265 1.47006 10.3267C1.59552 10.3441 1.77714 10.3455 2.10355 10.3455H10.3869C10.7133 10.3455 10.8949 10.3441 11.0204 10.3267C11.022 10.3265 11.0236 10.3263 11.0252 10.326C11.0253 10.3245 11.0254 10.3229 11.0255 10.3212C11.0324 10.1948 11.0186 10.0136 10.9915 9.68837L10.6798 5.94731C10.6344 5.40287 10.6041 5.05311 10.5487 4.79642C10.4971 4.55675 10.4395 4.48108 10.3932 4.43856C10.347 4.39604 10.2668 4.3449 10.0237 4.31332C9.76332 4.27951 9.41224 4.27831 8.86592 4.27831H3.62454C3.07822 4.27831 2.72714 4.27951 2.46675 4.31332Z"
                                            fill="#2C2C2C" />
                                    </svg>
                                </div>
                            </a>
                        @endif
                        @php
                            $wishlisted = false;
                            if (auth()->user()) {
                                $wishlisted = $item->isWishlist($item->id, optional(auth()->user())->id);
                            }
                        @endphp
                        {{-- Wishlist --}}
                        <div data-id="{{ $item->id }}"
                            class="wishlist h-6 w-6 p-1 mt-2 text-gray-12 hover:bg-yellow-1 border border-gray-2 rounded-full bg-white {{ $wishlisted ? 'remove-wishlist bg-yellow-1' : 'add-wishlist' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>

                        {{-- Compare --}}
                        <div data-itemId="{{ $item->id }}"
                            class="h-6 w-6 p-1 mt-2 text-gray-12 hover:bg-yellow-1 border border-gray-2 rounded-full bg-white add-to-compare">
                            <svg class="mt-1" width="13" height="9" viewBox="0 0 13 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.36875 3.28795V5.12946L5.875 2.67411L8.36875 0.21875V2.06027H12.75V3.28795H8.36875ZM0.25 5.7433H4.63125V3.90179L7.125 6.35714L4.63125 8.8125V6.97098H0.25V5.7433Z"
                                    fill="#2C2C2C" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            <a
                href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}">
                <p class="text-gray-12 font-medium absolute inset-x-0 bottom-0 p-1 text-center text-sm bg-yellow-1">
                    {{ __('Quick View') }}</p>
            </a>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}">
            <p class="text-sm text-gray-12 mt-2 dm-regular">{{ trimWords($item->name, 30) }}</p>
        </a>
        <div class="item-rating">
            <div class="self-top">
                <ul class="flex justify-center -space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($item->review_average >= $i)
                            {{-- Full star --}}
                            <li class="mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z"
                                        fill="currentColor" />
                                </svg>
                            </li>
                        @elseif ($item->review_average < $i && $item->review_average > $i - 1)
                            {{-- Half star --}}
                            <li class="mt-1 pr-2">
                                <svg class="h-3 w-3" viewBox="0 0 142 142" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M71 0L86.9405 49.0598H138.525L96.7923 79.3804L112.733 128.44L71 98.1196L29.2672 128.44L45.2077 79.3804L3.47499 49.0598H55.0595L71 0Z"
                                        fill="#C4C4C4" />
                                    <mask id="mask0_2170_1814" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="3"
                                        y="0" width="136" height="129">
                                        <path
                                            d="M71 0L86.9405 49.0598H138.525L96.7923 79.3804L112.733 128.44L71 98.1196L29.2672 128.44L45.2077 79.3804L3.47499 49.0598H55.0595L71 0Z"
                                            fill="#C4C4C4" />
                                    </mask>
                                    <g mask="url(#mask0_2170_1814)">
                                        <rect x="-39" y="-36" width="110" height="201" fill="#FCCA19" />
                                    </g>
                                </svg>
                            </li>
                        @else
                            {{-- Empty star --}}
                            <li class="mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z"
                                        fill="currentColor" />
                                </svg>
                            </li>
                        @endif
                    @endfor

                    <li class="mt-1 text-gray-10 text-11 dm-sans ">
                        ({{ $item->review_count }} {{ $item->review_count > 1 ? __('Reviews') : __('Review') }})
                    </li>
                </ul>
            </div>
        </div>
        @if ($item->isDiscountable())
            <p class="text-sm text-gray-12 dm-sans">
                {{ $currency_symbol }}{{ formatCurrencyAmount($item->discounted_price) }}
            </p>
        @endif
        <p
            class="{{ $item->isDiscountable()? 'text-11 font-medium line-through text-gray-10 pl-1 mt-0.5': 'text-sm text-gray-12 dm-sans' }}">
            {{ $currency_symbol }}{{ formatCurrencyAmount($item->price) }}
        </p>
    </div>
</div>
