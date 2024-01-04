@extends('../site/layouts.app')
@section('page_title', __('Home'))
@section('content')

<section class="container mx-auto mt-5">
    <div class="shadow">
        <div class="cover-image h-64 bg-no-repeat bg-cover"></div>
        <div class="flex flex-wrap px-8 -mt-16 mb-3">
            <div class="h-28 w-28 rounded-full border-2 mr-12 border-slate-100">
                <img class="h-full w-full" src="{{ $shop->vendor->fileUrl() }}" alt="avatar">
            </div>
            <div class="flex-auto">
                <div class="flex flex-wrap justify-between items-center mt-1 mb-3">
                    <div class="bg-green-500 color_switch_bac inline-block px-3 py-1 rounded my-3 md:my-0">
                        <h3 class="text-white font-semibold text-xl">{{ $shop->name }}</h3>
                    </div>
                    <div class="flex my-4">
                        <a href="https://facebook.com" target="_blank" rel="noreferrer noopener">
                            <div class="mr-3">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 30 30" fill="none" class="injected-svg" data-src="/assets/images/icons/facebook_filled.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <circle cx="15" cy="15" r="15" fill="#3B5998"></circle>
                                        <path d="M12.7208 22H15.5937V16.098H18.1823L18.4667 13.1651H15.5937V11.6842C15.5937 11.2773 15.9153 10.9474 16.312 10.9474H18.4667V8H16.312C14.3286 8 12.7208 9.64948 12.7208 11.6842V13.1651H11.2843L11 16.098H12.7208V22Z" fill="white"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noreferrer noopener">
                            <div class="mr-3">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8"   viewBox="0 0 30 30" fill="none" class="injected-svg" data-src="/assets/images/icons/twitter_filled.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <circle cx="15" cy="15" r="15" fill="#00ACEE"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M11.5556 8C12.4147 8 13.1111 8.69645 13.1111 9.55556V11.8889H17.7778C18.6369 11.8889 19.3333 12.5853 19.3333 13.4444C19.3333 14.3036 18.6369 15 17.7778 15H13.1111V16.5556C13.1111 17.8442 14.1558 18.8889 15.4444 18.8889H17.7778C18.6369 18.8889 19.3333 19.5853 19.3333 20.4444C19.3333 21.3036 18.6369 22 17.7778 22H15.4444C12.4376 22 10 19.5624 10 16.5556V9.55556C10 8.69645 10.6964 8 11.5556 8Z" fill="white"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noreferrer noopener">
                            <div class="mr-3">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 30 30" fill="none" class="injected-svg" data-src="/assets/images/icons/youtube_filled.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <circle cx="15" cy="15" r="15" fill="#FF0000"></circle>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.25 11.5H19.75C20.1642 11.5 20.5 11.8358 20.5 12.25V18.25C20.5 18.6642 20.1642 19 19.75 19H9.25C8.83579 19 8.5 18.6642 8.5 18.25V12.25C8.5 11.8358 8.83579 11.5 9.25 11.5ZM7 12.25C7 11.0074 8.00736 10 9.25 10H19.75C20.9926 10 22 11.0074 22 12.25V18.25C22 19.4926 20.9926 20.5 19.75 20.5H9.25C8.00736 20.5 7 19.4926 7 18.25V12.25ZM13 13L16 15.25L13 17.5V13Z" fill="white"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noreferrer noopener">
                            <div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" class="injected-svg" data-src="/assets/images/icons/instagram_filled.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <circle cx="15" cy="15" r="15" fill="#E1306C"></circle>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 11.8182C13.2427 11.8182 11.8182 13.2427 11.8182 15C11.8182 16.7573 13.2427 18.1818 15 18.1818C16.7573 18.1818 18.1818 16.7573 18.1818 15C18.1818 13.2427 16.7573 11.8182 15 11.8182ZM13.0909 15C13.0909 16.0544 13.9456 16.9091 15 16.9091C16.0544 16.9091 16.9091 16.0544 16.9091 15C16.9091 13.9456 16.0544 13.0909 15 13.0909C13.9456 13.0909 13.0909 13.9456 13.0909 15Z" fill="white"></path>
                                            <path d="M18.8182 10.5455C18.4667 10.5455 18.1818 10.8304 18.1818 11.1818C18.1818 11.5333 18.4667 11.8182 18.8182 11.8182C19.1696 11.8182 19.4545 11.5333 19.4545 11.1818C19.4545 10.8304 19.1696 10.5455 18.8182 10.5455Z" fill="white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5455 8C9.13964 8 8 9.13964 8 10.5455V19.4545C8 20.8604 9.13964 22 10.5455 22H19.4545C20.8604 22 22 20.8604 22 19.4545V10.5455C22 9.13964 20.8604 8 19.4545 8H10.5455ZM19.4545 9.27273H10.5455C9.84255 9.27273 9.27273 9.84255 9.27273 10.5455V19.4545C9.27273 20.1575 9.84255 20.7273 10.5455 20.7273H19.4545C20.1575 20.7273 20.7273 20.1575 20.7273 19.4545V10.5455C20.7273 9.84255 20.1575 9.27273 19.4545 9.27273Z" fill="white">
                                            </path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="flex" >
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($shop->rating))
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </span>
                                    @else
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </span>
                                    @endif
                                @endfor
                            </div>
                            <span class="pl-2 text-gray-400">({{ round($shop->rating, 1) }})</span>
                        </div>
                        <div class="flex mb-4 max-w-xs">
                            <div class="mt-1">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="injected-svg" data-src="/assets/images/icons/map-pin-2.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path d="M8.50002 0C5.10516 0 2.34326 2.7619 2.34326 6.15672C2.34326 10.3698 7.85295 16.5548 8.08753 16.8161C8.30787 17.0615 8.69256 17.0611 8.9125 16.8161C9.14708 16.5548 14.6568 10.3698 14.6568 6.15672C14.6567 2.7619 11.8948 0 8.50002 0ZM8.50002 9.25434C6.79198 9.25434 5.40243 7.86476 5.40243 6.15672C5.40243 4.44869 6.79201 3.05914 8.50002 3.05914C10.208 3.05914 11.5976 4.44872 11.5976 6.15676C11.5976 7.86479 10.208 9.25434 8.50002 9.25434Z" fill="#7D879C">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <span class="ml-3 text-gray-400 text-sm">{{ $shop->address }}</span>
                        </div>
                        <div class="flex ">
                            <div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none" class="injected-svg" data-src="/assets/images/icons/phone_filled.svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g clip-path="url(#clip0-24)">
                                        <path d="M14.5916 11.0085L12.4983 8.91519C11.7507 8.16759 10.4798 8.46666 10.1807 9.43852C9.95646 10.1114 9.20886 10.4852 8.53601 10.3356C7.0408 9.96184 5.02227 8.01807 4.64846 6.4481C4.42418 5.77522 4.87275 5.02762 5.54559 4.80336C6.51748 4.50432 6.81652 3.23339 6.06891 2.48579L3.97562 0.392493C3.37754 -0.130831 2.48041 -0.130831 1.95709 0.392493L0.536636 1.81294C-0.883814 3.30815 0.686157 7.27046 4.1999 10.7842C7.71365 14.298 11.676 15.9427 13.1712 14.4475L14.5916 13.027C15.115 12.4289 15.115 11.5318 14.5916 11.0085Z" fill="#7D879C"></path>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0-24">
                                        <rect width="15" height="15" fill="white"></rect>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm ml-4 text-gray-400">{{ $shop->phone }}</span>
                        </div>
                    </div>
                    <a href="mailto:{{ $shop->email }}">
                        <button class="text-white font-semibold px-6 py-2 bg-green-500 color_switch_bac rounded my-3">{{ __('Contact Vendor') }}</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="relative flex content-start items-center">
            <div class="h-12 pt-4 shop-menu">
                <div class="relative flex">
                    <div class="relative flex pr-3 ml-4 font-bold h-6 text-sm cursor-pointer text-green-500 whitespace-nowrap">
                        <a href="{{ route('site.shop', ['alias' => $shop->alias]) }}">
                            {{ __('Homepage') }}
                        </a>
                    </div>
                    <div class="relative flex pr-3 ml-4 font-bold h-6 text-sm cursor-pointer text-green-500 whitespace-nowrap">
                        <a href="{{ route('site.shopAll', ['alias' => $shop->alias]) }}">
                            {{ __('All Products') }}
                        </a>
                        <div class="absolute h-1 -left-2 -bottom-2 w-full flex bg-green-500 color_switch_bac"></div>
                    </div>
                    <div class=" flex pr-3 ml-4 font-bold h-6 text-sm cursor-pointer text-green-500 whitespace-nowrap">
                        <a href="#">
                            {{ __('Profile') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="sm:flex sm:mb-0 sm:place-content-end sm:flex-1 sm:pr-2 sm:bg-white flex place-content-center flex-2 w-full mb-2">
                <form action="{{ route('site.searchByKeyWord') }}" method="GET">
                    <div>
                        <input name="keyword" placeholder="{{ __('Search in store') }}" class="search-in-store pl-4 pr-8 search-border pt-1 pb-1 rounded hidden sm:block">
                    </div>
                    <button type="submit" role="button" class="absolute right-4 top-4 shop-search-icon">
                        <span>
                            <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" xml:space="preserve">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- All product section start -->
    @include('../site.layouts.section.shop.all-product')
<!-- All product section end -->

@include('../site/layouts/partials.product_section')
@endsection

@section('js')
<script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
@endsection
