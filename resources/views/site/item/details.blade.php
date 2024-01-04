@extends('../site/layouts.app')
@section('page_title', __('Details'))
@section('seo')
        @php
        $tagName = [];
        foreach ($item->itemTag as $tag) {
            $tagName[] = $tag->tag->name;
        }
        $title = isset($item->seo->title) && !empty($item->seo->title) ? $item->seo->title : $item->name;
        $description = isset($item->seo->description) && !empty($item->seo->description) ? $item->seo->description : $item->summary;
        $slug = isset($item->seo->slug) && !empty($item->seo->slug) ? $item->seo->slug : $item->name;
        $imageUrl = isset($item->seo) ? $item->seo->fileUrl() : $item->fileUrl();
        $fbAppId =  env('FACEBOOK_CLIENT_ID');
         @endphp
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ count($tagName) > 0 ? implode(",", $tagName) : '' }}">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $title }}">
    <meta itemprop="description" content="{{ $description }}">
    <meta itemprop="image" content="{{ $imageUrl }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="{{ __('Product') }}">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ $imageUrl }}">
    <meta name="twitter:data1" content="{{ $item->isDiscountable() ? formatCurrencyAmount($item->discounted_price) : formatCurrencyAmount($item->price) }}">
    <meta name="twitter:label1" content="{{ __('Price') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:type" content="og:{{ __('Product') }}" />
    <meta property="og:url" content="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($slug)]) }}" />
    <meta property="og:image" content="{{ $imageUrl }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:site_name" content="{{ $company_name }}" />
    <meta property="og:price:amount" content="{{ $item->isDiscountable() ? formatCurrencyAmount($item->discounted_price) : formatCurrencyAmount($item->price) }}" />
    <meta property="product:price:currency" content="{{ $currency_name }}" />
    <meta property="fb:app_id" content="{{ $fbAppId }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('public/frontend/assets/swiper/swiper-bundle.min.css') }}">
@endsection

@section('content')


<!-- Details section start -->
@php
    $avg = $item->review->where('status', 'Active')->avg('rating');
    $reviewCount = $item->review->where('status', 'Active')->count('rating');
@endphp
<section class="mx-5 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 md:mt-30p mt-5" id="item-details-container">

    {{-- breadcrumbs --}}
    <nav class="text-gray-600 text-sm" aria-label="Breadcrumb">
        <ol class="list-none p-0 flex flex-wrap md:inline-flex text-xs md:text-sm roboto-medium font-medium text-gray-10 leading-5">
          <li class="flex items-center">

            <svg class="-mt-1 mr-2" width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.35643 1.89407C4.93608 2.1717 4.43485 2.59943 3.69438 3.23412L2.916 3.9013C2.0595 4.63545 1.82512 4.85827 1.69934 5.13174C1.57357 5.4052 1.55692 5.72817 1.55692 6.85625V10.1569C1.55692 10.9127 1.55857 11.4013 1.60698 11.7613C1.65237 12.099 1.72565 12.2048 1.7849 12.264C1.84416 12.3233 1.94997 12.3966 2.28759 12.442C2.64759 12.4904 3.13619 12.492 3.89206 12.492H8.56233C9.31819 12.492 9.80679 12.4904 10.1668 12.442C10.5044 12.3966 10.6102 12.3233 10.6695 12.264C10.7287 12.2048 10.802 12.099 10.8474 11.7613C10.8958 11.4013 10.8975 10.9127 10.8975 10.1569V6.85625C10.8975 5.72817 10.8808 5.4052 10.755 5.13174C10.6293 4.85827 10.3949 4.63545 9.53838 3.9013L8.76 3.23412C8.01953 2.59943 7.5183 2.1717 7.09795 1.89407C6.69581 1.62848 6.44872 1.55676 6.22719 1.55676C6.00566 1.55676 5.75857 1.62848 5.35643 1.89407ZM4.49849 0.595063C5.03749 0.239073 5.5849 0 6.22719 0C6.86948 0 7.41689 0.239073 7.95589 0.595063C8.4674 0.932894 9.04235 1.42573 9.7353 2.01972L10.5515 2.71933C10.5892 2.75162 10.6264 2.78347 10.6632 2.81492C11.3564 3.40806 11.8831 3.85873 12.1694 4.48124C12.4557 5.10375 12.4551 5.79693 12.4543 6.70926C12.4543 6.75764 12.4542 6.80662 12.4542 6.85625L12.4542 10.2081C12.4543 10.8981 12.4543 11.4927 12.3903 11.9688C12.3217 12.479 12.167 12.9681 11.7703 13.3648C11.3736 13.7615 10.8845 13.9162 10.3742 13.9848C9.89812 14.0488 9.30358 14.0488 8.61355 14.0488H3.84083C3.1508 14.0488 2.55626 14.0488 2.08015 13.9848C1.56991 13.9162 1.08082 13.7615 0.68411 13.3648C0.2874 12.9681 0.132701 12.479 0.064101 11.9688C9.07021e-05 11.4927 0.000124017 10.8981 0.000162803 10.2081L0.000164659 6.85625C0.000164659 6.80662 0.000122439 6.75763 8.07765e-05 6.70926C-0.000705247 5.79693 -0.00130245 5.10374 0.285011 4.48124C0.571324 3.85873 1.09802 3.40806 1.79122 2.81492C1.82798 2.78347 1.8652 2.75162 1.90288 2.71933L2.68126 2.05215C2.69391 2.0413 2.70652 2.03049 2.71909 2.01972C3.41204 1.42573 3.98698 0.932893 4.49849 0.595063Z" fill="#898989"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50293 9.37853C3.50293 8.51876 4.19991 7.82178 5.05969 7.82178H7.39482C8.25459 7.82178 8.95158 8.51876 8.95158 9.37853V13.2704C8.95158 13.7003 8.60309 14.0488 8.1732 14.0488C7.74331 14.0488 7.39482 13.7003 7.39482 13.2704V9.37853H5.05969V13.2704C5.05969 13.7003 4.71119 14.0488 4.28131 14.0488C3.85142 14.0488 3.50293 13.7003 3.50293 13.2704V9.37853Z" fill="#898989"/>
            </svg>

            <a href="{{ route('site.index') }}">{{ __('Home') }}</a>
            <p class="px-2">/</p>
          </li>
            @if(isset($parentCategory))
                @foreach($parentCategory as $parent)
                    @if (!empty($parent['slug']))
                        <li class="flex items-center">
                            <a href="{{ route('site.categoryItems', $parent['slug']) }}">{{ $parent['name'] }}</a>
                            <p class="px-2">/</p>
                        </li>
                    @endif
                @endforeach
            @endif
          <li>
            <a href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}" class="text-gray-12" aria-current="page">{{ trimWords($item->name, 28) }}</a>
          </li>
        </ol>
    </nav>

    <div class="flex flex-wrap mt-4 md:mt-6 relative">
        <div class="sm:pr-7 md:pr-3 w-full xxs:w-72% xxs:transform xxs:translate-x-19% sm:w-1/2 lg:w-36% md:order-none">
            <div class="product-left mb-5 mb-lg-0 relative">
                <div class="swiper-container product-slider mb-3 border rounded">
                    <div class="swiper-wrapper">
                        @foreach($item->filesUrl() as $image)
                        @php
                            $image = str_replace('\\', '/', $image);
                        @endphp
                        <div class="swiper-slide zoom" style="background-image: url({{ $image }}); object-fit:contain">
                            <img class="zoom_img" src="{{ $image }}" alt="...">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative">
                    <div class="swiper-container product-thumbs opacity-0" style="width:100%;height;400px">
                        <div class="swiper-wrapper ml-11" style="transform: translate3d(-418.333px, 0px, 0px) !important; margin-left: calc(-3% - 5px);">
                            @foreach($item->filesUrl() as $image)
                            <div class="swiper-slide swiper-slidee">
                                <img class="w-66p" src="{{ $image }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-button-next bg-white">
                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7L7.70711 7.70711L8.41421 7L7.70711 6.29289L7 7ZM1.70711 13.7071L7.70711 7.70711L6.29289 6.29289L0.292893 12.2929L1.70711 13.7071ZM7.70711 6.29289L1.70711 0.292893L0.292893 1.70711L6.29289 7.70711L7.70711 6.29289Z" fill="#898989"/>
                        </svg>
                    </div>
                    <div class="swiper-button-prev rotate-180 transform bg-white">
                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7L7.70711 7.70711L8.41421 7L7.70711 6.29289L7 7ZM1.70711 13.7071L7.70711 7.70711L6.29289 6.29289L0.292893 12.2929L1.70711 13.7071ZM7.70711 6.29289L1.70711 0.292893L0.292893 1.70711L6.29289 7.70711L7.70711 6.29289Z" fill="#898989"/>
                        </svg>
                    </div>
                </div>

                <div class="absolute right-6 z-20 bottom-25">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 18H11V16H14.5858L11.2929 12.7071C10.9024 12.3166 10.9024 11.6834 11.2929 11.2929C11.6834 10.9024 12.3166 10.9024 12.7071 11.2929L16 14.5858V11H18V18Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 18H0V11H2V14.5858L5.29289 11.2929C5.68342 10.9024 6.31658 10.9024 6.70711 11.2929C7.09763 11.6834 7.09763 12.3166 6.70711 12.7071L3.41421 16H7V18Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 7H16V3.41421L12.7071 6.70711C12.3166 7.09763 11.6834 7.09763 11.2929 6.70711C10.9024 6.31658 10.9024 5.68342 11.2929 5.29289L14.5858 2H11V0H18V7Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 3.41421V7H0V0H7V2H3.41421L6.70711 5.29289C7.09763 5.68342 7.09763 6.31658 6.70711 6.70711C6.31658 7.09763 5.68342 7.09763 5.29289 6.70711L2 3.41421Z" fill="#898989"/>
                    </svg>
                </div>
            </div>
        </div>

        <div id="item-details-wishlist" class="md:px-3 w-full sm:w-1/2 lg:w-36% md:order-none">
            <div>
                <div class="lg:flex md:space-x-10p hidden">
                    <div class="flex-initial px-2 text-gray-10 bg-gray-11 rounded-sm">
                        <p class="roboto-medium font-medium text-xs text-center py-1">{{ __('Category') }}: {{ $item->itemCategory->category->name ?? null }}</p>
                    </div>
                    <div class="flex-initial px-2 text-gray-10 bg-gray-11 rounded-sm">
                        <p class="roboto-medium font-medium text-xs text-center py-1">{{ __('SKU') }}: {{ $item->sku }}</p>
                    </div>
                </div>
                <div class="md:mt-4">
                    <h3 class="text-gray-12 dm-bold font-bold text-xl  2xl:text-22 -mt-1">
                        {{ $item->name }}
                    </h3>
                </div>

                <div class="flex md:flex-col lg:flex-row justify-start items-center md:items-start lg:justify-start lg:items-center space-x-4 md:space-x-0 lg:space-x-4 md:mt-3 mt-3">
                    {{-- ratting --}}
                    <div id="rating">
                        <div class="flex items-center cursor-pointer">
                            <ul class="flex rtl-direction-space-left space-x-5p">
                                @for($i = 1; $i <= 5 ; $i++)

                                    @if (round($avg) >= $i)
                                        <li>
                                            <svg class="text-green-500" width="17" height="16" viewBox="0 0 17 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z"/>
                                            </svg>
                                        </li>
                                    @else
                                        <li>
                                            <svg class="text-gray-4" width="17" height="16" viewBox="0 0 17 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z"/>
                                            </svg>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                            <u class="roboto-medium font-medium text-sm text-gray-10"><span class="pl-2">{{ round($avg, 1) }}</span><span class="px-0.5">/</span> </u>
                            <span class="roboto-medium font-medium text-sm text-gray-10">{{ $reviewCount }}</span> <span class="ml-2 roboto-medium font-medium text-sm text-gray-10">{{ __('Reviews') }}</span>

                        </div>
                    </div>
                    <div class="flex justify-start items-center x:space-x-3 space-x-4 mt-0 md:mt-4 lg:mt-0">
                        {{-- share button --}}
                        <div>

                            <div class="relative" x-data="{ open: false }" x-cloak
                            @keydown.window.escape="open = false">
                                <div @click="open = !open">
                                    <button class="flex items-center">
                                        <svg class="bi bi-share text-gray-10" width="14" height="16" viewBox="0 0 14 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0513 11.8454C10.4521 11.4831 10.9763 11.2519 11.5621 11.2519C12.8031 11.2519 13.8128 12.2616 13.8128 13.5026C13.8128 14.7436 12.8031 15.7534 11.5621 15.7534C10.3211 15.7534 9.31132 14.7436 9.31132 13.5026C9.31132 13.333 9.33444 13.1634 9.37298 13.0016L3.88485 9.79503C3.46862 10.1804 2.92135 10.4194 2.31241 10.4194C1.03288 10.4194 0 9.38651 0 8.10697C0 6.82744 1.03288 5.79456 2.31241 5.79456C2.92135 5.79456 3.46862 6.03351 3.88485 6.41891L9.31903 3.2509C9.28049 3.07362 9.24965 2.89633 9.24965 2.71134C9.24965 1.4318 10.2825 0.398926 11.5621 0.398926C12.8416 0.398926 13.8745 1.4318 13.8745 2.71134C13.8745 3.99088 12.8416 5.02375 11.5621 5.02375C10.9531 5.02375 10.4059 4.7848 9.98963 4.3994L4.55545 7.56741C4.59399 7.74469 4.62483 7.92198 4.62483 8.10697C4.62483 8.29196 4.59399 8.46925 4.55545 8.64653L10.0513 11.8454ZM12.3327 2.71134C12.3327 2.2874 11.9858 1.94054 11.5619 1.94054C11.1379 1.94054 10.7911 2.2874 10.7911 2.71134C10.7911 3.13529 11.1379 3.48215 11.5619 3.48215C11.9858 3.48215 12.3327 3.13529 12.3327 2.71134ZM2.31175 8.87779C1.88781 8.87779 1.54095 8.53093 1.54095 8.10699C1.54095 7.68304 1.88781 7.33618 2.31175 7.33618C2.7357 7.33618 3.08256 7.68304 3.08256 8.10699C3.08256 8.53093 2.7357 8.87779 2.31175 8.87779ZM10.7911 13.518C10.7911 13.9419 11.1379 14.2888 11.5619 14.2888C11.9858 14.2888 12.3327 13.9419 12.3327 13.518C12.3327 13.0941 11.9858 12.7472 11.5619 12.7472C11.1379 12.7472 10.7911 13.0941 10.7911 13.518Z"/>
                                        </svg>
                                    </button>
                                </div>

                                <div x-show.transition="open" @click.away="open = false" class="absolute right-0 -mt-2 text-gray-600 bg-white rounded-md border border-gray-400 dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 z-40">

                                    <div class="rotate-45 absolute mt-7 border-b-0 border-r-0 z-20 bg-white border border-gray-300 h-4 w-4 transform -translate-x-12 -translate-y-3 ">

                                    </div>
                                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute flex z-10 -right-16  top-4 w-80 px-4 py-6 mt-2 space-y-2 text-gray-600 bg-white border border-gray-200 rounded-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
                                        <li class="px-2 py-1 ml-5">{{ __('Share via') }}: </li>
                                        <li class="flex">
                                            <div id="fb-root"></div>
                                            <div class="fb-share-button" data-href="https://rovercrm.net" data-layout="button" data-size="small">
                                                <div class="flex flex-col justify-center bg-blue-500 items-center h-8 w-8 -mt-2 ml-3 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u={{ urlencode(url()->current()) }}" class="fb-xfbml-parse-ignore text-white text-xl">
                                                        <i class="fa fa-facebook browse-tooltip" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="flex">
                                            <div class="flex flex-col justify-center bg-blue-400 items-center h-8 w-8 -mt-2 ml-2 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                <a href="https://twitter.com/share?url={{ urlencode(url()->current()) }}&text={{ $item->name }}" target="_blank" class="text-white text-xl">
                                                    <i class="fa fa-twitter browse-tooltip" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex flex-col justify-center bg-green-500 items-center h-8 w-8 -mt-2 ml-2 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" target="_blank" class="text-white text-xl">
                                                    <i class="fa fa-whatsapp browse-tooltip" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex flex-col justify-center bg-blue-600 items-center h-8 w-8 -mt-2 ml-2 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                <a href="mailto:?Subject=&body={{urlencode(url()->current()) }}" target="_blank" class="text-white text-md">
                                                    <i class="fa fa-envelope-o browse-tooltip" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @php
                            $active = false;
                            if (auth()->user()) {
                                foreach (auth()->user()->wishlist as $key => $wishlist) {
                                    if ($item->id == $wishlist->item_id) {
                                        $active = true;
                                    }
                                }
                            }
                        @endphp
                        {{-- Wish-list --}}
                        <div>
                            <div class="flex items-center cursor-pointer text-transparent wishlist" data-id="{{ $item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="{{ $active ? 'color_fill svg-bg ' : 'text-gray-10'  }} -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- compare --}}
                        <a href="javascript:void(0)" data-itemId="{{ $item->id }}" class="add-to-compare">
                            <div>
                                <svg width="17" height="17" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.84923 0.0139465C2.80785 0.0214701 2.67995 0.0478029 2.5671 0.0703735C2.45424 0.0929451 2.2022 0.186991 2.00658 0.281036C1.7094 0.423985 1.59655 0.502984 1.34074 0.758788C1.08494 1.01835 1.00594 1.12745 0.862989 1.42463C0.641041 1.88734 0.592138 2.10552 0.595899 2.60585C0.603423 3.23031 0.783991 3.72311 1.19779 4.22719C1.44983 4.5319 1.93887 4.85918 2.34891 4.99084L2.4881 5.03599L2.50315 8.18463C2.51819 11.6831 2.50315 11.4875 2.77776 12.048C3.10128 12.7139 3.72198 13.218 4.45177 13.4061C4.64739 13.4587 4.94081 13.4738 6.02422 13.485L7.3559 13.5039L6.85934 14.0004L6.36654 14.4932L6.81796 14.9446L7.26938 15.3961L8.36407 14.3051C8.96597 13.7032 9.48134 13.1615 9.51143 13.0938C9.57914 12.9396 9.57914 12.7364 9.51143 12.5822C9.48134 12.5145 8.96597 11.9728 8.36407 11.3709L7.26938 10.28L6.81796 10.7314L6.36654 11.1828L6.8631 11.6831L7.36343 12.1835L6.02798 12.1722L4.69253 12.1609L4.50444 12.0593C4.27873 11.9389 4.03797 11.6944 3.91759 11.4649L3.82731 11.2957L3.81602 8.16583L3.8085 5.03975L3.94769 4.99084C5.08376 4.62595 5.83612 3.46354 5.69694 2.3049C5.56527 1.23654 4.88438 0.420224 3.86493 0.107992C3.61288 0.0289936 3.01475 -0.0274334 2.84923 0.0139465ZM3.45113 1.32682C4.04173 1.48106 4.41792 1.96257 4.41792 2.56823C4.41792 2.86917 4.3502 3.08736 4.18092 3.31683C3.94393 3.65163 3.57903 3.8322 3.15018 3.83596C2.54076 3.83596 2.05925 3.45978 1.90502 2.85413C1.73949 2.19204 2.14953 1.51492 2.83042 1.33059C3.09751 1.25911 3.18404 1.25911 3.45113 1.32682Z" fill="#898989"/>
                                    <path d="M8.18316 1.12749C7.57751 1.73315 7.0659 2.27861 7.04333 2.33504C6.99066 2.48175 6.99442 2.68113 7.05838 2.82408C7.08847 2.89179 7.60384 3.43349 8.20573 4.03539L9.30042 5.12632L9.75184 4.6749L10.2033 4.22348L9.7067 3.72315L9.20638 3.22283L10.5418 3.23412L11.8773 3.2454L12.0654 3.34697C12.2911 3.46735 12.5318 3.71187 12.6522 3.94134L12.7425 4.11062L12.7538 7.24046L12.7613 10.3665L12.6221 10.4154C12.1669 10.5622 11.6666 10.912 11.3845 11.2882C11.0271 11.7584 10.8653 12.2437 10.8653 12.8381C10.8653 13.5528 11.1099 14.1397 11.6139 14.6437C11.9488 14.9785 12.2535 15.1629 12.7237 15.3058C13.1224 15.43 13.7168 15.43 14.1156 15.3058C14.9921 15.035 15.6165 14.418 15.8799 13.5566C16.2673 12.2926 15.5676 10.9082 14.3074 10.4493L14.0817 10.3665L14.0667 7.2367C14.0554 4.41157 14.0479 4.08805 13.9914 3.8661C13.792 3.13255 13.2692 2.4968 12.5995 2.17704C12.118 1.95133 12.0353 1.94005 10.5644 1.92124L9.2139 1.90243L9.71046 1.40587L10.2033 0.91307L9.75937 0.469173C9.51861 0.228417 9.30795 0.0290403 9.30042 0.0290403C9.28914 0.0290403 8.78505 0.525601 8.18316 1.12749ZM13.8598 11.638C14.2472 11.7735 14.5519 12.1233 14.6648 12.5522C14.8943 13.455 14.0366 14.3127 13.1337 14.0832C12.3099 13.8726 11.9111 13.0186 12.2798 12.2587C12.5544 11.6945 13.2503 11.4199 13.8598 11.638Z" fill="#898989"/>
                                </svg>
                            </div>
                        </a>

                        {{-- print --}}
                        <div class="md:block hidden">
                            <svg width="16" height="17" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.22862 3.63367H11.1652C11.9486 3.63366 12.58 3.63365 13.0766 3.70041C13.5922 3.76973 14.0264 3.91803 14.3711 4.26282C14.7159 4.6076 14.8642 5.04172 14.9335 5.55732C15.0003 6.05392 15.0003 6.68534 15.0003 7.46871V8.03387C15.0003 8.41471 15.0003 8.74285 14.965 9.00562C14.9271 9.28724 14.8418 9.55718 14.6228 9.77614C14.4038 9.99509 14.1339 10.0805 13.8523 10.1183C13.5895 10.1537 13.2614 10.1537 12.8805 10.1536L12.549 10.1536V9.29441H12.8522C13.2694 9.29441 13.5391 9.2935 13.7378 9.26678C13.9241 9.24173 13.9825 9.20128 14.0152 9.16858C14.0479 9.13587 14.0884 9.07747 14.1134 8.89113C14.1402 8.69244 14.1411 8.42276 14.1411 8.00558V7.50016C14.1411 6.67793 14.1402 6.10448 14.082 5.67181C14.0255 5.25149 13.9221 5.02891 13.7636 4.87038C13.6051 4.71184 13.3825 4.60848 12.9622 4.55197C12.5295 4.4938 11.956 4.49289 11.1338 4.49289H4.26005C3.43782 4.49289 2.86437 4.4938 2.4317 4.55197C2.01138 4.60848 1.7888 4.71184 1.63027 4.87038C1.47174 5.02891 1.36837 5.25149 1.31186 5.6718C1.25369 6.10448 1.25278 6.67793 1.25278 7.50015V8.8648C1.25278 9.07946 1.25369 9.19724 1.26468 9.27895C1.26482 9.28002 1.26496 9.28106 1.26511 9.28208C1.26613 9.28222 1.26717 9.28237 1.26824 9.28251C1.34994 9.2935 1.46773 9.29441 1.68239 9.29441H2.84486V10.1536H1.68239C1.67459 10.1536 1.6668 10.1536 1.65902 10.1536C1.47683 10.1537 1.29978 10.1537 1.15375 10.1341C0.98912 10.1119 0.801261 10.058 0.64522 9.90197C0.489179 9.74593 0.435254 9.55807 0.41312 9.39344C0.393487 9.24741 0.393522 9.07036 0.393558 8.88817C0.393559 8.88039 0.393561 8.8726 0.393561 8.8648L0.393561 7.46872C0.393549 6.68535 0.393539 6.05393 0.460307 5.55732C0.529626 5.04172 0.677924 4.6076 1.02271 4.26282C1.3675 3.91803 1.80162 3.76973 2.31721 3.70041C2.81382 3.63365 3.44524 3.63366 4.22862 3.63367Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.81934 14.81C2.81935 14.8028 2.81935 14.7957 2.81935 14.7887L2.81935 8.17943C2.81933 7.79859 2.81931 7.47045 2.85464 7.20767C2.8925 6.92606 2.97788 6.65611 3.19684 6.43716C3.4158 6.2182 3.68574 6.13282 3.96736 6.09496C4.23014 6.05963 4.55828 6.05964 4.93913 6.05967L10.4542 6.05967C10.8351 6.05964 11.1632 6.05963 11.426 6.09496C11.7076 6.13282 11.9776 6.2182 12.1965 6.43716C12.4155 6.65611 12.5009 6.92606 12.5387 7.20768C12.5741 7.47045 12.574 7.7986 12.574 8.17945L12.574 14.7887C12.574 14.7957 12.574 14.8028 12.574 14.81C12.5741 14.9268 12.5742 15.0571 12.5583 15.165C12.5401 15.2896 12.4886 15.4782 12.3064 15.6095C12.1242 15.7408 11.9291 15.73 11.8051 15.7079C11.6977 15.6888 11.5741 15.6475 11.4633 15.6105C11.4565 15.6083 11.4498 15.606 11.4431 15.6038L9.73182 15.0334L8.01579 15.7198C8.01141 15.7215 8.00633 15.7236 8.00062 15.726C7.94449 15.7492 7.82675 15.7978 7.69669 15.7978C7.56662 15.7978 7.44888 15.7492 7.39275 15.726C7.38704 15.7236 7.38196 15.7215 7.37758 15.7198L5.66155 15.0334L3.95028 15.6038C3.9436 15.606 3.93686 15.6083 3.93008 15.6105C3.81925 15.6476 3.69569 15.6888 3.58826 15.7079C3.46432 15.73 3.26912 15.7408 3.08697 15.6095C2.90482 15.4782 2.85332 15.2896 2.83505 15.165C2.81922 15.0571 2.81928 14.9268 2.81934 14.81ZM5.72127 15.0141C5.7213 15.0141 5.72129 15.0141 5.72127 15.0141V15.0141ZM5.60308 15.0107C5.60305 15.0107 5.60305 15.0107 5.60308 15.0107V15.0107ZM9.7903 15.0107C9.79033 15.0107 9.79033 15.0107 9.7903 15.0107V15.0107ZM3.67857 14.7887L3.67857 8.20772C3.67857 7.79053 3.67948 7.52086 3.7062 7.32216C3.73125 7.13583 3.7717 7.07742 3.8044 7.04472C3.8371 7.01201 3.89551 6.97157 4.08185 6.94651C4.28054 6.9198 4.55022 6.91889 4.9674 6.91889L10.426 6.91889C10.8432 6.91889 11.1128 6.9198 11.3115 6.94651C11.4979 6.97157 11.5563 7.01201 11.589 7.04472C11.6217 7.07742 11.6621 7.13582 11.6872 7.32216C11.7139 7.52086 11.7148 7.79053 11.7148 8.20772L11.7148 14.7887L10.0035 14.2183C9.9994 14.2169 9.99462 14.2152 9.98925 14.2134C9.9364 14.1952 9.82588 14.1571 9.70617 14.1606C9.58646 14.1641 9.47837 14.2086 9.42668 14.2299C9.42143 14.2321 9.41675 14.234 9.41271 14.2356L7.69669 14.922L5.98066 14.2356C5.97662 14.234 5.97195 14.2321 5.96669 14.2299C5.915 14.2086 5.80692 14.1641 5.6872 14.1606C5.56749 14.1571 5.45697 14.1952 5.40412 14.2134C5.39875 14.2152 5.39397 14.2169 5.38984 14.2183L3.67857 14.7887ZM7.63267 14.9468C7.63262 14.9468 7.63263 14.9468 7.63267 14.9468V14.9468ZM7.76069 14.9468C7.76073 14.9468 7.76074 14.9468 7.76069 14.9468V14.9468Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.24609 9.72392C5.24609 9.48665 5.43844 9.29431 5.6757 9.29431L8.91041 9.29431C9.14768 9.29431 9.34002 9.48665 9.34002 9.72392C9.34002 9.96119 9.14768 10.1535 8.91041 10.1535L5.6757 10.1535C5.43844 10.1535 5.24609 9.96119 5.24609 9.72392Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.24609 12.15C5.24609 11.9127 5.43844 11.7204 5.6757 11.7204L9.71909 11.7204C9.95636 11.7204 10.1487 11.9127 10.1487 12.15C10.1487 12.3873 9.95636 12.5796 9.71909 12.5796L5.6757 12.5796C5.43844 12.5796 5.24609 12.3873 5.24609 12.15Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.31108 0.398926H9.08226C9.78493 0.398913 10.3557 0.398903 10.8055 0.459381C11.2743 0.522409 11.6756 0.658124 11.9952 0.977744C12.3148 1.29736 12.4505 1.69865 12.5136 2.16745C12.574 2.61728 12.574 3.18801 12.574 3.89068V4.06325H11.7148V3.92173C11.7148 3.18051 11.7139 2.66781 11.662 2.28194C11.6118 1.90842 11.521 1.71867 11.3876 1.5853C11.2543 1.45194 11.0645 1.36116 10.691 1.31094C10.3051 1.25906 9.79242 1.25815 9.0512 1.25815H6.34214C5.60092 1.25815 5.08822 1.25906 4.70235 1.31094C4.32883 1.36116 4.13908 1.45194 4.00571 1.5853C3.87235 1.71867 3.78157 1.90842 3.73135 2.28194C3.67947 2.66781 3.67856 3.18051 3.67856 3.92173V4.06325H2.81934L2.81934 3.89067C2.81932 3.188 2.81931 2.61728 2.87979 2.16745C2.94282 1.69865 3.07853 1.29736 3.39815 0.977744C3.71777 0.658124 4.11906 0.522409 4.58786 0.459381C5.03769 0.398903 5.60842 0.398913 6.31108 0.398926Z" fill="#898989"/>
                            </svg>
                        </div>
                    </div>
                </div>
                @if(isset($item->itemDetail) && $item->isDiscountable())
                    @php $days = $item->getLeftDiscountDays() @endphp
                <p class="text-sm mt-1.5 pt-1p dm-sans font-medium text-gray-12">{{ __('Offer end in') }}:</p>
                <div class="w-full flex roboto-medium mt-3">
                    <div class="border border-dashed border-gray-12 rounded bg-yellow-1 ">
                        <p class="text-center px-2 text-sm text-black py-1">
                            {{ $days['days'] ?? 0 }} {{ __('Days') }}
                        </p>
                    </div>
                    <div class="border border-dashed border-gray-12 rounded ml-2.5 bg-yellow-1 ">
                        <p class="text-center px-2 text-sm text-black py-1">
                            {{ $days['hours'] ?? 0 }} {{ __('hours') }}
                        </p>
                    </div>
                </div>
                @endif
                <div class="md:mt-3 mt-2">
                    <p class="dm-bold font-700">
                        @if($symbol_position == "before")
                        <span class="text-lg text-gray-12">{{ $currency_symbol }}</span>
                        @endif
                        <span class="text-2.5xl text-gray-12" id="item_price">{{ formatCurrencyAmount($price) }}</span>
                        @if($symbol_position == "after")
                         <span class="text-lg text-gray-12">{{ $currency_symbol }}</span>
                        @endif
                        <span class="text-lg text-gray-10 display-none">/</span>
                        @if($actualPrice != $price)
                        <span class="text-gray-10 line-through">{{ formatNumber($actualPrice) }}</span>
                        @endif
                    </p>
                </div>


                @php $count = 0 ; $optionBox = 0@endphp
                @foreach($item->itemOption as $key => $option)
                @php $payloads = json_decode($option->payloads) @endphp
                      <!-- Color section -->
                      @if($option->type == 'dropdown' && $option->name == "Color")
                        <div class="flex mt-5">
                            <p class="text-gray-12 w-1/5 text-sm mt-0.5 font-medium roboto-medium {{ $option->is_required == 1 ? 'require' : '' }}"> {{ $option->name }}</p>
                            <div class="flex flex-wrap space-x-11 md:space-x-9 w-4/5 ml-2">
                                @foreach($payloads->label as $payKey => $label)
                                    @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                        @php
                                           $colorClass = '';
                                            $colors = getColor();
                                            $colorsKey = array_keys(getColor());
                                            if (in_array(strtolower($label), $colorsKey)) {
                                                $colorClass = $colors[strtolower($label)];
                                           } else {
                                               $colorClass = 'bg-custom-white black-check';
                                           }
                                       @endphp
                                       <div class="round">
                                             <input type="checkbox" id="checkbox-{{$count}}" class="fixed singleCheckBox option_price {{ $option->is_required == 1 ? 'required-option' : '' }} multiChk-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count }}" data-option="{{ $optionBox }}" data-inputType="checkbox" data-optionRealId = "{{ $option->id }}"/>
                                           <label class="{{ $colorClass }}" for="checkbox-{{$count++}}"></label>
                                       </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- Size section -->
                      @elseif($option->type == 'dropdown' && $option->name == "Size")
                        <div class="flex mt-5 pl-1">
                            <p class="w-1/5 text-gray-12 text-sm font-medium roboto-medium {{ $option->is_required == 1 ? 'require' : '' }}">{{ $option->name }}</p>
                            <div class="flex flex-wrap">
                                @foreach($payloads->label as $payKey => $label)
                                    @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                      <div class="squre w-16 mr-3 mb-5">
                                        <input type="checkbox" id="checkbox-{{$count}}" class="singleCheckBox option_price {{ $option->is_required == 1 ? 'required-option' : '' }} multiChk-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count }}" data-option="{{ $optionBox }}" data-inputType="checkbox" data-optionRealId = "{{ $option->id }}"/>
                                      <label class="{{ isset($item->itemDetail) && $item->itemDetail->is_track_inventory == 1 && !isStockAvailable($option->id, $label) ? 'check-disable' : '' }}" for="checkbox-{{$count++}}">{{ $label }}</label>
                                     </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <a href=""> <p class="text-gray-10 text-sm font-medium roboto-medium ml-23 -mt-2">{{ __('See size guide') }}</p>
                        </a>
                      @elseif($option->type == 'dropdown')
                      <div class="flex mt-4 md:mt-3 option-select items-center">
                            <h4 class="text-gray-12 text-sm font-medium roboto-medium mr-2 w-1/5 {{ $option->is_required == 1 ? 'require' : '' }}"> {{ $option->name }}</h4>
                            <select name="option[]"
                                class="option_price {{ $option->is_required == 1 ? 'required-option' : '' }} custombox-selected outline-none rounded border border-gray-2 block whitespace-no-wrap text-gray-10 text-sm font-medium roboto-medium bg-white w-36 z-20">
                                <option class="border-none" value="" data-optionId="{{ $count++ }}"
                                    data-option="{{ $optionBox }}">{{ __('Select One') }}</option>
                                @foreach($payloads->label as $payKey => $label)
                                    @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                    <option class="border-none" value="{{ $label }}"
                                        data-price="{{ $payloads->option_price[$payKey]->option_price }}"
                                        data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}"
                                        data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">{{ $label }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @elseif($option->type == 'checkbox')
                            <!-- Only one checkbox select -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                <div class="col-span-2">
                                    <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                        {{ $option->name }}
                                    </h4>
                                </div>
                                <div class="col-span-3">
                                    <div>
                                        @foreach($payloads->label as $payKey => $label)
                                            @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                <div>
                                                    <label for="option" class="inline-flex items-center">
                                                        <input type="checkbox" class="radio singleCheckBox option_price multiChk-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                        <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @elseif($option->type == 'checkbox_custom')
                            <!-- Multiple(custom) checkbox select -->
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                        @foreach($payloads->label as $payKey => $label)
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox customCheckBox-{{$optionBox}} option_price" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" id="multiple-{{ $optionBox }}">
                                            <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                        @elseif($option->type == 'radio')
                            <!-- Only one(custom) radio button select -->
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8 ">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                        <div>
                                            @foreach($payloads->label as $payKey => $label)
                                                @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                    <div>
                                                        <label for="option_price" class="inline-flex items-center">
                                                            <input type="radio" class="form-radio option_price multiChk-{{$optionBox}}" name="option-{{ $optionBox }}[]" value="{{ $label }}" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                            <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        @elseif($option->type == 'radio_custom')
                        @elseif($option->type == 'multiple_select')
                            <!-- Multiple dropdown select -->
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 mt-10 px-0 sm:px-5">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                        <div>
                                            <select x-cloak  name="option[]" class="option_price multiple_select" id="multiple-{{ $optionBox }}">
                                                @foreach($payloads->label as $payKey => $label)
                                                    @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                     <option value="{{ $label }}" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">{{ $label }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            <div x-data="dropdown()" x-init="loadOptions()"
                                                 class="flex">
                                                <input name="values" type="hidden" x-bind:value="selectedValues()">
                                                <div class="inline-block relative w-64">
                                                    <div class="flex flex-col items-center relative">
                                                        <div x-on:click="open" class="w-full">
                                                            <div class=" p-1 flex border border-gray-200 bg-white rounded">
                                                                <div class="flex flex-auto flex-wrap">
                                                                    <template x-for="(option,index) in selected"
                                                                              :key="options[option].value">
                                                                        <div
                                                                            class="flex justify-center items-center m-1 font-medium py-1 px-1 rounded bg-gray-100 border">
                                                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                                 options[option] x-text="options[option].text"></div>
                                                                            <div class="flex flex-auto flex-row-reverse">
                                                                                <div x-on:click.stop="remove(index,option)">
                                                                                    <svg class="fill-current h-4 w-4" role="button"
                                                                                         viewBox="0 0 20 20">
                                                                                        <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                        c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                        l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                        C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                                                    </svg>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                    <div x-show="selected.length == 0" class="flex-1">
                                                                        <input placeholder="Select a option"
                                                                               class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                                                               x-bind:value="selectedValues()">
                                                                    </div>
                                                                </div>
                                                                <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                                                    <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                        <svg version="1.1" class="fill-current h-4 w-4"
                                                                             viewBox="0 0 20 20">
                                                                            <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                            c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                            L17.418,6.109z" />
                                                                        </svg>
                                                                    </button>
                                                                    <button type="button" x-show="isOpen() === false" @click="close"
                                                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                            <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                            c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                            " />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-full px-4">
                                                            <div x-show.transition.origin.top="isOpen()"
                                                                 class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select"
                                                                 x-on:click.away="close">
                                                                <div class="flex flex-col w-full overflow-y-auto">
                                                                    <template x-for="(option,index) in options" :key="option"
                                                                              class="overflow-auto">
                                                                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100"
                                                                             @click="select(index,$event)">
                                                                            <div
                                                                                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                                                <div class="w-full items-center flex justify-between">
                                                                                    <div class="mx-2 leading-6" x-model="option"
                                                                                         x-text="option.text"></div>
                                                                                    <div x-show="option.selected">
                                                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                                                            <path fill="none"
                                                                                                  d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                                                                C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                                                                L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @elseif($option->type == 'date')
                            <!-- Date picker -->
                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                        <input class="border py-2 px-3 dark:bg-gray-2 text-gray-500 outline-none rounded" type="date"
                                               id="date" name="optionNoLabel[]" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                    </div>
                                </div>
                        @elseif($option->type == 'date_time')
                            <!-- Date and time picker -->
                           <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-10">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                        <div x-data
                                             x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: true, dateFormat: 'M j, Y h:i K'});"
                                             x-ref="datetimewidget" class="flatpickr container mx-auto col-span-6 sm:col-span-6">

                                            <div class="flex align-middle align-content-center">
                                                <input x-ref="datetime" type="text" id="datetime" data-input name="optionNoLabel[]" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}" class="block px-3 border text-gray-500 outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md">

                                                <p class="h-12 w-8 input-button cursor-pointer rounded-r-md inline-block border"
                                                   title="clear" data-clear>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 ml-1"
                                                         viewBox="0 0 20 20" fill="#c53030">
                                                        <path fill-rule="evenodd"
                                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @elseif($option->type == 'time')
                            <!-- Time -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-12">
                                    <div class="col-span-2">
                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                            {{ $option->name }}
                                        </h4>
                                    </div>
                                    <div class="col-span-3">
                                            <div class="p-3 w-40 bg-white rounded border">
                                                <div class="flex">
                                                    <select name="hours" class="bg-transparent text-sm appearance-none outline-none text-gray-500" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                        @for($hour = 1; $hour <= 12 ; $hour++)
                                                        <option value="{{ $hour }}">{{$hour}}</option>
                                                        @endfor
                                                    </select>
                                                    <span class="text-sm mr-3">:</span>
                                                    <select name="minutes" class="bg-transparent text-sm appearance-none outline-none mr-4 text-gray-500">
                                                        @for($minute = 0; $minute <= 59 ; $minute++)
                                                        <option value="{{ $minute }}">{{ $minute }}</option>
                                                        @endfor
                                                    </select>
                                                    <select name="ampm"
                                                            class="bg-transparent text-sm appearance-none outline-none text-gray-500">
                                                        <option value="am">AM</option>
                                                        <option value="pm">PM</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                        @endif
                    <label class="error display-none" id="required-msg-{{ $optionBox }}">{{ __('Please select the option') }}</label>
                    <span class="display-none text-color-red text-sm mt-1.5 pt-1p dm-sans font-medium" id="stock_qty-{{ $optionBox }}"></span>
                @php $optionBox++ @endphp
                @endforeach
                <div class="flex flex-col lg:flex lg:flex-row my-4 md:justify-start lg:space-x-3 mt-5">
                    <!-- Qty section -->
                    <div class="flex flex-wrap justify-start items-center space-x-2 lg:space-x-0">
                        <p class="lg:hidden w-1/5 text-sm roboto-medium text-gray-12">Qty:</p>
                        <div class="flex flex-wrap w-36 lg:w-135p h-10 lg:h-54p text-xl border rounded" id="cart-item-details-{{$item->id}}">
                            <a href="javascript:void(0)"
                                class="cart-item-qty-dec m-auto text-2xl flex items-center font-thin text-gray-600 hover:text-gray-700  rounded-l cursor-pointer outline-none ml-4  md:text-center"
                                data-itemId={{ $item->id }}><span class="inline-block">
                                    <svg class="" width="13" height="2" viewBox="0 0 13 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13 2H0L0 0H13V2Z" fill="#898989"/>
                                    </svg>
                                </span>
                            </a>

                            <div class="flex items-center dm-bold font-bold text-20 text-gray-12 text-center cart-item-quantity">1</div>
                            <a href="javascript:void(0)"
                                class="cart-item-qty-inc m-auto flex items-center text-2xl font-thin text-gray-600 hover:text-gray-700 h-10 rounded-r cursor-pointer mr-15p md:text-center"
                                data-itemId={{ $item->id }}> <span class="inline-block">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87909 -8.02595e-08L8.87909 14.077L7.04297 14.077L7.04297 0L8.87909 -8.02595e-08Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.95643L0.923044 7.95642L0.923044 6.1203L15 6.1203L15 7.95643Z" fill="#898989"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="lg:mt-0 mt-5 w-full">
                        <a href="javascript:void(0)" class="add-to-cart" id="item-add-to-cart" data-itemId={{ $item->id }}>
                            <button
                                class="bg-yellow-1 lg:bg-gray-11 font-bold w-full h-54p py-3  2xl:p-2 rounded flex justify-center items-center">
                                <svg class="text-gray-12 lg:text-gray-10" width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.88135 10C5.32906 10 4.88135 9.55228 4.88135 9L4.88135 5C4.88135 2.23858 7.11992 -1.25946e-06 9.88135 -6.82991e-07C12.6428 -1.0602e-06 14.8813 2.23858 14.8813 5L14.8813 9C14.8813 9.55228 14.4336 10 13.8813 10C13.3291 10 12.8813 9.55228 12.8813 9L12.8813 5C12.8813 3.34315 11.5382 2 9.88135 2C8.22449 2 6.88135 3.34314 6.88135 5L6.88135 9C6.88135 9.55228 6.43363 10 5.88135 10Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.49955 5C5.52029 5 5.5411 5 5.56198 5L14.2634 5C15.0834 4.99996 15.7934 4.99991 16.3668 5.07436C16.983 5.15438 17.5746 5.33421 18.0725 5.79236C18.5704 6.25051 18.7988 6.82513 18.9297 7.4326C19.0515 7.99774 19.1104 8.70533 19.1785 9.52254L19.6975 15.7509C19.6991 15.77 19.7007 15.7891 19.7023 15.8081C19.7404 16.2651 19.7772 16.7051 19.7573 17.069C19.7351 17.4768 19.6367 17.9518 19.2664 18.3542C18.8961 18.7567 18.431 18.8941 18.0264 18.9502C17.6654 19.0002 17.2239 19.0001 16.7653 19C16.7462 19 16.727 19 16.7079 19H3.05505C3.03587 19 3.01671 19 2.99759 19C2.53902 19.0001 2.09749 19.0002 1.73653 18.9502C1.33195 18.8941 0.866803 18.7567 0.496488 18.3542C0.126173 17.9518 0.0278088 17.4768 0.00556347 17.069C-0.0142834 16.7051 0.0224672 16.2651 0.0606358 15.8081C0.0622278 15.7891 0.0638222 15.77 0.0654151 15.7509L0.579256 9.58478C0.58099 9.56397 0.582717 9.54323 0.584438 9.52256C0.652492 8.70535 0.711417 7.99775 0.833217 7.4326C0.964137 6.82513 1.19247 6.25051 1.69039 5.79236C2.18831 5.33421 2.77991 5.15438 3.39615 5.07436C3.96946 4.99991 4.67951 4.99996 5.49955 5ZM3.6537 7.05771C3.25295 7.10975 3.12078 7.19404 3.04461 7.26412C2.96844 7.33421 2.87347 7.45892 2.78833 7.85396C2.69715 8.27703 2.64713 8.85352 2.57235 9.75087L2.05851 15.917C2.01383 16.4531 1.99123 16.7516 2.00259 16.96C2.00274 16.9627 2.00289 16.9654 2.00305 16.968C2.00562 16.9684 2.00825 16.9687 2.01093 16.9691C2.21772 16.9977 2.51706 17 3.05505 17H16.7079C17.2458 17 17.5452 16.9977 17.752 16.9691C17.7547 16.9687 17.7573 16.9684 17.7599 16.968C17.76 16.9654 17.7602 16.9627 17.7603 16.96C17.7717 16.7516 17.7491 16.4531 17.7044 15.917L17.1906 9.75087C17.1158 8.85352 17.0658 8.27703 16.9746 7.85396C16.8894 7.45892 16.7945 7.33421 16.7183 7.26412C16.6421 7.19404 16.51 7.10975 16.1092 7.05771C15.68 7.00198 15.1014 7 14.2009 7H5.56198C4.66152 7 4.08288 7.00198 3.6537 7.05771Z" fill="currentColor"/>
                                </svg>
                                <span class="pl-2 p-5p dm-bold font-bold text-gray-12 lg:text-gray-10 text-lg">{{ __('Add to Cart') }}</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:pl-3 w-full sm:w-full lg:w-28% md:order-none">
            <div class="border rounded-md pb-7 mt-2 md:mt-0">
                <div class="px-4">
                    <div class="py-5">
                        <p class="font-bold dm-bold text-17 text-gray-12">{{ __('Delivery Options') }}</p>
                    </div>
                    <a class="flex title-font font-medium text-gray-900">
                        <div>
                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C4.68629 2 2 4.68629 2 8C2 10.1458 3.09211 11.9159 4.45503 13.2906C5.77773 14.6248 7.27659 15.5032 8 15.8837C8.72341 15.5032 10.2223 14.6248 11.545 13.2906C12.9079 11.9159 14 10.1458 14 8C14 4.68629 11.3137 2 8 2ZM0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 10.8706 14.5326 13.1178 12.9653 14.6987C11.397 16.2805 9.64481 17.2838 8.85847 17.6917C8.31691 17.9726 7.68309 17.9726 7.14153 17.6917C6.35519 17.2838 4.60299 16.2805 3.03474 14.6987C1.46741 13.1178 0 10.8706 0 8ZM8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8Z" fill="#898989"/>
                            </svg>
                        </div>
                        <p class="ml-4 -mt-0.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-10 roboto-medium font-medium text-13"> House-D/1, Sukrabad, Dhanmondi-32, Dhaka-North, Dhaka-1207
                        </p>
                    </a>
                    <div class="ml-8 -mt-1">
                        <a class="text-gray-12 dm-bold font-bold text-11 border-gray-12 border-b" href="">Change</a>
                    </div>
                </div>

                <div class="mx-4 border-b pb-4">
                    <div>
                        <a class="flex title-font font-medium items-center md:justify-start text-gray-900 mt-18p">
                            <div>
                                <svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.3631 12.8182C7.84532 12.8182 8.30778 12.6266 8.64875 12.2857C8.98973 11.9447 9.18129 11.4822 9.18129 11C9.18129 10.5178 8.98973 10.0553 8.64875 9.71436C8.30778 9.37338 7.84532 9.18182 7.3631 9.18182C6.88089 9.18182 6.41843 9.37338 6.07745 9.71436C5.73648 10.0553 5.54492 10.5178 5.54492 11C5.54492 11.4822 5.73648 11.9447 6.07745 12.2857C6.41843 12.6266 6.88089 12.8182 7.3631 12.8182V12.8182Z" stroke="#898989" stroke-width="1.5" stroke-miterlimit="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.4549 12.8182C16.9371 12.8182 17.3996 12.6266 17.7405 12.2857C18.0815 11.9447 18.2731 11.4822 18.2731 11C18.2731 10.5178 18.0815 10.0553 17.7405 9.71436C17.3996 9.37338 16.9371 9.18182 16.4549 9.18182C15.9727 9.18182 15.5102 9.37338 15.1693 9.71436C14.8283 10.0553 14.6367 10.5178 14.6367 11C14.6367 11.4822 14.8283 11.9447 15.1693 12.2857C15.5102 12.6266 15.9727 12.8182 16.4549 12.8182V12.8182Z" stroke="#898989" stroke-width="1.5" stroke-miterlimit="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.22727 11H13.7273V1.54545C13.7273 1.40079 13.6698 1.26205 13.5675 1.15976C13.4652 1.05747 13.3265 1 13.1818 1H1" stroke="#898989" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M5.22745 11H3.36381C3.29218 11 3.22126 10.9859 3.15508 10.9585C3.0889 10.9311 3.02877 10.8909 2.97812 10.8402C2.92747 10.7896 2.88729 10.7295 2.85988 10.6633C2.83247 10.5971 2.81836 10.5262 2.81836 10.4545V6" stroke="#898989" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M1.90918 3.72729H5.54554" stroke="#898989" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.7275 3.72729H18.8275C18.933 3.72732 19.0361 3.7579 19.1246 3.81534C19.213 3.87278 19.2828 3.95461 19.3257 4.05093L20.953 7.71275C20.984 7.78228 21.0001 7.85753 21.0003 7.93366V10.4546C21.0003 10.5262 20.9862 10.5971 20.9587 10.6633C20.9313 10.7295 20.8912 10.7896 20.8405 10.8403C20.7899 10.8909 20.7297 10.9311 20.6635 10.9585C20.5974 10.9859 20.5264 11 20.4548 11H18.7275" stroke="#898989" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M13.7275 11H14.6366" stroke="#898989" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="ml-2.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-12 text-15 dm-bold font-bold"> Home Delivery
                                </span>
                                <p class="font-bold dm-bold text-gray-12 text-15">$20</p>
                            </div>
                        </a>
                        <div class="flex justify-between">
                            <p class="mx-4 ml-8 mt-0.5 text-sm text-gray-10 roboto-medium font-medium">2 - 8 days</p>
                            {{-- <p class="font-bold dm-bold text-gray-12 text-15 -mt-6">$20</p> --}}
                        </div>

                        <a class="flex title-font font-medium items-center md:justify-start text-gray-900 mt-5">
                            <div>
                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4286 5.71429C11.4286 6.47205 11.1276 7.19877 10.5917 7.73459C10.0559 8.27041 9.32919 8.57143 8.57143 8.57143C7.81367 8.57143 7.08694 8.27041 6.55112 7.73459C6.01531 7.19877 5.71429 6.47205 5.71429 5.71429C5.71429 4.95652 6.01531 4.2298 6.55112 3.69398C7.08694 3.15816 7.81367 2.85714 8.57143 2.85714C9.32919 2.85714 10.0559 3.15816 10.5917 3.69398C11.1276 4.2298 11.4286 4.95652 11.4286 5.71429ZM10 5.71429C10 5.33541 9.84949 4.97204 9.58158 4.70413C9.31367 4.43622 8.95031 4.28571 8.57143 4.28571C8.19255 4.28571 7.82919 4.43622 7.56128 4.70413C7.29337 4.97204 7.14286 5.33541 7.14286 5.71429C7.14286 6.09317 7.29337 6.45653 7.56128 6.72444C7.82919 6.99235 8.19255 7.14286 8.57143 7.14286C8.95031 7.14286 9.31367 6.99235 9.58158 6.72444C9.84949 6.45653 10 6.09317 10 5.71429ZM0 1.78571C0 0.8 0.8 0 1.78571 0H15.3571C16.3429 0 17.1429 0.8 17.1429 1.78571V9.64286C17.1429 10.6286 16.3429 11.4286 15.3571 11.4286H1.78571C0.8 11.4286 0 10.6286 0 9.64286V1.78571ZM1.78571 1.42857C1.69099 1.42857 1.60015 1.4662 1.53318 1.53318C1.4662 1.60015 1.42857 1.69099 1.42857 1.78571V2.85714H2.14286C2.3323 2.85714 2.51398 2.78189 2.64793 2.64793C2.78189 2.51398 2.85714 2.3323 2.85714 2.14286V1.42857H1.78571ZM1.42857 9.64286C1.42857 9.84 1.58857 10 1.78571 10H2.85714V9.28571C2.85714 9.09627 2.78189 8.91459 2.64793 8.78064C2.51398 8.64668 2.3323 8.57143 2.14286 8.57143H1.42857V9.64286ZM4.28571 9.28571V10H12.8571V9.28571C12.8571 8.71739 13.0829 8.17235 13.4848 7.77049C13.8866 7.36862 14.4317 7.14286 15 7.14286H15.7143V4.28571H15C14.4317 4.28571 13.8866 4.05995 13.4848 3.65809C13.0829 3.25622 12.8571 2.71118 12.8571 2.14286V1.42857H4.28571V2.14286C4.28571 2.71118 4.05995 3.25622 3.65809 3.65809C3.25622 4.05995 2.71118 4.28571 2.14286 4.28571H1.42857V7.14286H2.14286C2.71118 7.14286 3.25622 7.36862 3.65809 7.77049C4.05995 8.17235 4.28571 8.71739 4.28571 9.28571ZM14.2857 10H15.3571C15.4519 10 15.5427 9.96237 15.6097 9.8954C15.6767 9.82842 15.7143 9.73758 15.7143 9.64286V8.57143H15C14.8106 8.57143 14.6289 8.64668 14.4949 8.78064C14.361 8.91459 14.2857 9.09627 14.2857 9.28571V10ZM15.7143 2.85714V1.78571C15.7143 1.69099 15.6767 1.60015 15.6097 1.53318C15.5427 1.4662 15.4519 1.42857 15.3571 1.42857H14.2857V2.14286C14.2857 2.3323 14.361 2.51398 14.4949 2.64793C14.6289 2.78189 14.8106 2.85714 15 2.85714H15.7143ZM5 14.2857C4.54746 14.2859 4.10647 14.1428 3.74026 13.8769C3.37405 13.611 3.10142 13.2361 2.96143 12.8057C3.16 12.84 3.36286 12.8571 3.57143 12.8571H15.3571C16.2096 12.8571 17.0272 12.5185 17.63 11.9157C18.2328 11.3129 18.5714 10.4953 18.5714 9.64286V2.97857C18.9894 3.12635 19.3512 3.40012 19.6071 3.76216C19.863 4.12419 20.0002 4.55668 20 5V9.64286C20 10.2526 19.8799 10.8563 19.6466 11.4196C19.4133 11.9829 19.0713 12.4947 18.6401 12.9259C18.209 13.357 17.6972 13.699 17.1339 13.9323C16.5706 14.1656 15.9669 14.2857 15.3571 14.2857H5Z" fill="#898989"/>
                                </svg>
                            </div>
                            <span class="ml-2.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-12 text-15 dm-bold font-bold"> {{ __('Cash on Delivery') }}
                            </span>
                        </a>
                        <p class="mx-4 ml-8 mt-0.5 text-sm text-gray-10 roboto-medium font-medium">{{ isset($item->itemDetail->is_cash_on_delivery) && $item->itemDetail->is_cash_on_delivery == 1 ? __('Available') : __('Not Available') }}</p>
                    </div>
                </div>
                @if(isset($item->itemDetail))
                <div class="px-4 my-4">
                    <div>
                        <p class="font-bold dm-bold text-base text-gray-12">{{ __('Warranty') }}</p>
                    </div>

                    <a class="flex title-font font-medium items-center md:justify-start text-gray-900 mt-5">
                        <div>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.00002 1C9.00002 0.447715 9.44773 0 10 0C12.3136 0 14.5555 0.802193 16.3439 2.2699C18.1323 3.7376 19.3565 5.78 19.8079 8.0491C20.2592 10.3182 19.9098 12.6736 18.8192 14.714C17.7286 16.7543 15.9643 18.3534 13.8268 19.2388C11.6894 20.1242 9.3111 20.241 7.09717 19.5694C4.88323 18.8978 2.97066 17.4793 1.68532 15.5557C0.399978 13.6321 -0.1786 11.3222 0.0481687 9.01982C0.274937 6.71741 1.29302 4.56486 2.92895 2.92893C3.31947 2.53841 3.95264 2.53841 4.34316 2.92893C4.73369 3.31945 4.73369 3.95262 4.34316 4.34314C3.03442 5.65189 2.21995 7.37393 2.03854 9.21586C1.85712 11.0578 2.31998 12.9056 3.34826 14.4446C4.37653 15.9835 5.90659 17.1182 7.67774 17.6555C9.44888 18.1928 11.3515 18.0993 13.0615 17.391C14.7714 16.6828 16.1829 15.4035 17.0554 13.7712C17.9279 12.1389 18.2074 10.2546 17.8463 8.43928C17.4852 6.624 16.5059 4.99008 15.0752 3.81592C13.6444 2.64175 11.8509 2 10 2C9.44773 2 9.00002 1.55228 9.00002 1Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.29304 3.29289C3.68357 2.90237 4.31673 2.90237 4.70726 3.29289L10.7073 9.29289C11.0978 9.68342 11.0978 10.3166 10.7073 10.7071C10.3167 11.0976 9.68357 11.0976 9.29304 10.7071L3.29304 4.70711C2.90252 4.31658 2.90252 3.68342 3.29304 3.29289Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0C10.5523 0 11 0.447715 11 1V3C11 3.55228 10.5523 4 10 4C9.44772 4 9 3.55228 9 3V1C9 0.447715 9.44772 0 10 0Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 10.5523 19.5523 11 19 11L17 11C16.4477 11 16 10.5523 16 10C16 9.44772 16.4477 9 17 9L19 9C19.5523 9 20 9.44772 20 10Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 16C10.5523 16 11 16.4477 11 17V19C11 19.5523 10.5523 20 10 20C9.44772 20 9 19.5523 9 19V17C9 16.4477 9.44772 16 10 16Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4 10C4 10.5523 3.55228 11 3 11L1 11C0.447715 11 -6.78525e-08 10.5523 -4.37114e-08 10C-1.95703e-08 9.44772 0.447715 9 1 9L3 9C3.55228 9 4 9.44772 4 10Z" fill="#898989"/>
                            </svg>
                        </div>
                        <span class="ml-2.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-12 text-15 dm-bold font-bold"> {{ !empty($item->itemDetail->warranty_period) ? $item->itemDetail->warranty_period : 'Warranty not Available'  }}
                        </span>
                    </a>
                    @if(!empty($item->itemDetail->warranty_policy))
                        <div id="policy-details">
                           <div id="policy-details-section" class="overflow-hidden relative policy-full-details h-40">
                               <p class="mx-4 ml-8 text-sm text-gray-10 roboto-medium font-medium mt-1">{{ $item->itemDetail->warranty_policy }}</p>
                               <div id="view-more-policy" class="absolute justify-center flex inset-x-0 bottom-0 add">
                                   <div class="mb-2 mt-8 px-6 py-1 cursor-pointer rounded-sm">
                                       <a class="flex justify-center">
                                           <span class="pr-5p text-sm dm-sans font-medium text-gray-10">{{ __('See More') }}</span>
                                           <svg class="mt-2" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M5.5 5L4.83564 5.74741L5.5 6.33796L6.16436 5.74741L5.5 5ZM0.335636 1.74741L4.83564 5.74741L6.16436 4.25259L1.66436 0.252591L0.335636 1.74741ZM6.16436 5.74741L10.6644 1.74741L9.33564 0.252591L4.83564 4.25259L6.16436 5.74741Z" fill="#898989"/>
                                           </svg>
                                       </a>
                                   </div>
                               </div>
                           </div>
                        </div>
                    @endif

                    <a class="flex title-font font-medium items-center md:justify-start text-gray-900 mt-18p">
                        <div>
                            <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.712 3.78862L9.78784 1.24968C9.28474 1.03406 8.71526 1.03406 8.21216 1.24968L2.28797 3.78862C1.47806 4.13572 0.990735 4.972 1.08804 5.84777L1.73939 11.7099C1.93906 13.5069 2.8263 15.157 4.21529 16.3144L7.71963 19.2347C8.46132 19.8528 9.53868 19.8528 10.2804 19.2347L13.7847 16.3144C15.1737 15.157 16.0609 13.5069 16.2606 11.7099L16.912 5.84777C17.0093 4.972 16.5219 4.13572 15.712 3.78862Z" stroke="#898989" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="ml-2.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-12 text-15 dm-bold font-bold"> {{ __('Warranty') }}: <span class="text-15 text-gray-10 ml-0.5 dm-sans font-medium">{{ $item->itemDetail->warranty_type }}</span>
                        </span>
                    </a>

                    <a class="flex title-font font-medium items-center md:justify-start text-gray-900 mt-5">
                        <div>
                            <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.93417 2.43991e-06C4.95604 3.63201e-06 4.97799 4.8241e-06 5 4.8241e-06L15.0658 2.43991e-06C15.9523 -4.73896e-05 16.7161 -9.01893e-05 17.3278 0.0821453C17.9833 0.170277 18.6117 0.369022 19.1213 0.878684C19.631 1.38835 19.8297 2.0167 19.9179 2.67221C20.0001 3.28388 20.0001 4.0477 20 4.9342V10.0658C20.0001 10.9523 20.0001 11.7161 19.9179 12.3278C19.8297 12.9833 19.631 13.6117 19.1213 14.1213C18.6117 14.631 17.9833 14.8297 17.3278 14.9179C16.7161 15.0001 15.9523 15.0001 15.0658 15H4.93417C4.04769 15.0001 3.28387 15.0001 2.67221 14.9179C2.0167 14.8297 1.38835 14.631 0.878684 14.1213C0.369022 13.6117 0.170277 12.9833 0.0821453 12.3278C-9.01893e-05 11.7161 -4.73896e-05 10.9523 2.43991e-06 10.0658L4.8241e-06 5C4.8241e-06 4.97799 3.63201e-06 4.95604 2.43991e-06 4.93417C-4.73896e-05 4.04769 -9.01893e-05 3.28387 0.0821453 2.67221C0.170277 2.0167 0.369022 1.38835 0.878684 0.878684C1.38835 0.369022 2.0167 0.170277 2.67221 0.0821453C3.28387 -9.01893e-05 4.04769 -4.73896e-05 4.93417 2.43991e-06ZM2.93871 2.06431C2.50497 2.12263 2.36902 2.21677 2.2929 2.2929C2.21677 2.36902 2.12263 2.50497 2.06431 2.93871C2.00213 3.40122 2 4.02893 2 5V10C2 10.9711 2.00213 11.5988 2.06431 12.0613C2.12263 12.495 2.21677 12.631 2.2929 12.7071C2.36902 12.7832 2.50497 12.8774 2.93871 12.9357C3.40122 12.9979 4.02893 13 5 13H15C15.9711 13 16.5988 12.9979 17.0613 12.9357C17.495 12.8774 17.631 12.7832 17.7071 12.7071C17.7832 12.631 17.8774 12.495 17.9357 12.0613C17.9979 11.5988 18 10.9711 18 10V5C18 4.02893 17.9979 3.40122 17.9357 2.93871C17.8774 2.50497 17.7832 2.36902 17.7071 2.2929C17.631 2.21677 17.495 2.12263 17.0613 2.06431C16.5988 2.00213 15.9711 2 15 2H5C4.02893 2 3.40122 2.00213 2.93871 2.06431Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4 10C4 9.44772 4.44772 9 5 9H5.01C5.56228 9 6.01 9.44772 6.01 10C6.01 10.5523 5.56228 11 5.01 11H5C4.44772 11 4 10.5523 4 10Z" fill="#898989"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6C1 5.44772 1.44772 5 2 5H19C19.5523 5 20 5.44772 20 6C20 6.55228 19.5523 7 19 7H2C1.44772 7 1 6.55228 1 6Z" fill="#898989"/>
                            </svg>
                        </div>
                        <span class="ml-2.5 hover:text-orange-500 cursor-pointer transition-all rtl-direction-space-location text-gray-12 text-15 dm-bold font-bold"> {{ __('Secure Online Payment') }}
                        </span>
                    </a>

                </div>
                @endif

                <div class="px-4 flex items-center space-x-4 mt-6">
                    <svg width="40" height="13" viewBox="0 0 40 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.7447 0.172852H34.2681C33.5194 0.172852 32.9434 0.403233 32.5978 1.15197L27.875 11.9223H31.2155C31.2155 11.9223 31.7915 10.4824 31.9067 10.1369C32.2523 10.1369 35.5352 10.1369 35.996 10.1369C36.1111 10.54 36.3991 11.8647 36.3991 11.8647H39.3941L36.7447 0.172852ZM32.8282 7.71785C33.1162 7.02671 34.0953 4.43491 34.0953 4.43491C34.0953 4.49251 34.3833 3.74377 34.4985 3.3406L34.7289 4.37732C34.7289 4.37732 35.3624 7.1995 35.4776 7.77545H32.8282V7.71785Z" fill="#3362AB"/>
                        <path d="M28.1069 8.06336C28.1069 10.4824 25.9183 12.095 22.5201 12.095C21.0802 12.095 19.698 11.8071 18.9492 11.4615L19.41 8.8121L19.8132 8.98489C20.8499 9.44565 21.541 9.61844 22.8081 9.61844C23.7296 9.61844 24.7088 9.27287 24.7088 8.46653C24.7088 7.94817 24.3056 7.6026 23.0385 7.02664C21.829 6.45069 20.2163 5.52916 20.2163 3.85889C20.2163 1.55508 22.4625 0 25.6303 0C26.8398 0 27.8765 0.230382 28.5101 0.518359L28.0493 3.05256L27.8189 2.82218C27.243 2.59179 26.4942 2.36141 25.3999 2.36141C24.1904 2.41901 23.6144 2.93737 23.6144 3.39813C23.6144 3.91649 24.3056 4.31966 25.3999 4.83802C27.243 5.70195 28.1069 6.68107 28.1069 8.06336Z" fill="#3362AB"/>
                        <path d="M0 0.287999L0.0575954 0.0576172H5.0108C5.70195 0.0576172 6.22031 0.287999 6.39309 1.03674L7.48741 6.22033C6.39309 3.45575 3.85889 1.20953 0 0.287999Z" fill="#F9B50B"/>
                        <path d="M14.4557 0.17283L9.44489 11.8647H6.04676L3.16699 2.07348C5.24043 3.39817 6.96829 5.47161 7.60184 6.9115L7.94741 8.121L11.0576 0.115234H14.4557V0.17283Z" fill="#3362AB"/>
                        <path d="M15.7815 0.115234H18.9492L16.9334 11.8647H13.7656L15.7815 0.115234Z" fill="#3362AB"/>
                    </svg>

                    <svg width="36" height="21" viewBox="0 0 36 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.3941 10.4998C35.3941 16.2612 30.7096 20.9996 24.8943 20.9996C19.1329 20.9996 14.3945 16.2612 14.3945 10.4998C14.3945 4.73836 19.0791 0 24.8405 0C30.7096 0 35.3941 4.73836 35.3941 10.4998Z" fill="#F9B50B"/>
                        <path d="M21.3403 10.5536C21.3403 9.7998 21.2326 9.04597 21.1249 8.34598H14.6635C14.7173 7.96907 14.825 7.646 14.9327 7.21524H20.6941C20.5864 6.83832 20.4249 6.46141 20.2634 6.08449H15.3635C15.525 5.70757 15.7404 5.3845 15.9557 4.95374H19.6711C19.4557 4.57683 19.1865 4.19991 18.8634 3.823H16.8173C17.1403 3.44608 17.4634 3.12301 17.8942 2.7461C16.0634 1.02306 13.5866 0 10.8405 0C5.13289 0.161535 0.394531 4.73836 0.394531 10.4998C0.394531 16.2612 5.07905 20.9996 10.8943 20.9996C13.6404 20.9996 16.0634 19.9227 17.948 18.2535C18.3249 17.9304 18.648 17.5535 19.0249 17.1227H16.8711C16.6019 16.7997 16.3327 16.4227 16.1173 16.0458H19.7787C19.9941 15.7228 20.2095 15.3458 20.371 14.9151H15.4711C15.3096 14.592 15.1481 14.2151 15.0404 13.7843H20.8018C21.1249 12.8151 21.3403 11.7382 21.3403 10.5536Z" fill="#C8191C"/>
                        <path d="M14.6095 13.192L14.771 12.2228C14.7172 12.2228 14.6095 12.2766 14.5018 12.2766C14.1249 12.2766 14.071 12.0613 14.1249 11.9536L14.448 10.0152H15.0403L15.2018 8.93826H14.6633L14.771 8.29211H13.6403C13.6403 8.29211 12.9941 11.9536 12.9941 12.3843C12.9941 13.0305 13.3711 13.3535 13.9095 13.3535C14.2326 13.3535 14.5018 13.2459 14.6095 13.192Z" fill="white"/>
                        <path d="M14.9863 11.4151C14.9863 12.9766 16.0632 13.3535 16.9247 13.3535C17.7324 13.3535 18.1093 13.192 18.1093 13.192L18.3247 12.1151C18.3247 12.1151 17.7324 12.3843 17.1401 12.3843C15.9017 12.3843 16.1171 11.469 16.1171 11.469H18.3786C18.3786 11.469 18.5401 10.769 18.5401 10.4459C18.5401 9.74592 18.1632 8.83055 16.9247 8.83055C15.8478 8.77671 14.9863 10.0151 14.9863 11.4151ZM16.9247 9.79976C17.517 9.79976 17.4094 10.4997 17.4094 10.5536H16.1709C16.2248 10.4997 16.3325 9.79976 16.9247 9.79976Z" fill="white"/>
                        <path d="M23.9793 13.192L24.1947 11.9536C24.1947 11.9536 23.6563 12.2228 23.2255 12.2228C22.4717 12.2228 22.0947 11.6305 22.0947 10.9305C22.0947 9.58439 22.7409 8.88441 23.5486 8.88441C24.087 8.88441 24.5716 9.20748 24.5716 9.20748L24.7332 8.02289C24.7332 8.02289 24.087 7.75366 23.4409 7.75366C22.1486 7.75366 20.9102 8.88441 20.9102 10.9844C20.9102 12.3843 21.5563 13.2997 22.9024 13.2997C23.387 13.3535 23.9793 13.192 23.9793 13.192Z" fill="white"/>
                        <path d="M8.52574 8.77673C7.77191 8.77673 7.17961 8.99211 7.17961 8.99211L7.01808 9.96132C7.01808 9.96132 7.50268 9.74594 8.25651 9.74594C8.63343 9.74594 8.9565 9.79979 8.9565 10.1229C8.9565 10.3382 8.90265 10.3921 8.90265 10.3921H8.41805C7.44884 10.3921 6.42578 10.769 6.42578 12.0613C6.42578 13.0843 7.07192 13.2997 7.50268 13.2997C8.25651 13.2997 8.63343 12.8151 8.68727 12.8151L8.63343 13.2459H9.54879L9.97955 10.1767C9.97955 8.83058 8.90265 8.77673 8.52574 8.77673ZM8.74112 11.2536C8.74112 11.4151 8.63343 12.3305 7.98729 12.3305C7.66422 12.3305 7.55653 12.0613 7.55653 11.8997C7.55653 11.6305 7.71806 11.2536 8.57958 11.2536C8.68727 11.2536 8.74112 11.2536 8.74112 11.2536Z" fill="white"/>
                        <path d="M11.0561 13.2997C11.3253 13.2997 12.7253 13.3536 12.7253 11.8459C12.7253 10.4459 11.3792 10.7152 11.3792 10.1767C11.3792 9.90749 11.5945 9.7998 11.9715 9.7998C12.133 9.7998 12.7253 9.85365 12.7253 9.85365L12.8868 8.83059C12.8868 8.83059 12.5099 8.7229 11.8099 8.7229C11.0022 8.7229 10.1407 9.04597 10.1407 10.1767C10.1407 11.469 11.5407 11.3613 11.5407 11.8459C11.5407 12.169 11.1638 12.2228 10.8946 12.2228C10.4099 12.2228 9.8715 12.0613 9.8715 12.0613L9.70996 13.0843C9.81765 13.192 10.1407 13.2997 11.0561 13.2997Z" fill="white"/>
                        <path d="M33.2403 7.91528L33.025 9.42294C33.025 9.42294 32.5942 8.88449 31.9481 8.88449C30.925 8.88449 30.0635 10.1229 30.0635 11.5767C30.0635 12.4921 30.4942 13.4075 31.4634 13.4075C32.1096 13.4075 32.5403 12.9767 32.5403 12.9767L32.4865 13.3536H33.6173L34.4249 8.02297L33.2403 7.91528ZM32.7019 10.8229C32.7019 11.4152 32.4327 12.2229 31.7865 12.2229C31.4096 12.2229 31.1942 11.8998 31.1942 11.3075C31.1942 10.3922 31.5711 9.8537 32.1096 9.8537C32.4865 9.90755 32.7019 10.1768 32.7019 10.8229Z" fill="white"/>
                        <path d="M2.44018 13.2459L3.08632 9.26141L3.19401 13.2459H3.94784L5.40166 9.26141L4.80936 13.2459H5.99395L6.90932 7.91528H5.07859L3.94784 11.1998L3.894 7.91528H2.27865L1.36328 13.2459H2.44018Z" fill="white"/>
                        <path d="M19.6701 13.246C19.9931 11.4152 20.047 9.90758 20.8547 10.1768C20.9624 9.47682 21.1239 9.15375 21.2316 8.88452H21.0162C20.5316 8.88452 20.1008 9.53066 20.1008 9.53066L20.2085 8.93837H19.1316L18.4316 13.246H19.6701Z" fill="white"/>
                        <path d="M26.5628 8.77673C25.809 8.77673 25.2167 8.99211 25.2167 8.99211L25.0552 9.96132C25.0552 9.96132 25.5398 9.74594 26.2936 9.74594C26.6705 9.74594 26.9936 9.79979 26.9936 10.1229C26.9936 10.3382 26.9398 10.3921 26.9398 10.3921H26.4552C25.4859 10.3921 24.4629 10.769 24.4629 12.0613C24.4629 13.0843 25.109 13.2997 25.5398 13.2997C26.2936 13.2997 26.6705 12.8151 26.7244 12.8151L26.6705 13.2459H27.6936L28.1244 10.1767C28.1244 8.83058 26.9398 8.77673 26.5628 8.77673ZM26.8321 11.2536C26.8321 11.4151 26.7244 12.3305 26.0782 12.3305C25.7552 12.3305 25.6475 12.0613 25.6475 11.8997C25.6475 11.6305 25.809 11.2536 26.6705 11.2536C26.7782 11.2536 26.7782 11.2536 26.8321 11.2536Z" fill="white"/>
                        <path d="M28.9865 13.246C29.3096 11.4152 29.3634 9.90758 30.1711 10.1768C30.2788 9.47682 30.4403 9.15375 30.548 8.88452H30.3326C29.848 8.88452 29.4172 9.53066 29.4172 9.53066L29.5249 8.93837H28.448L27.748 13.246H28.9865Z" fill="white"/>
                    </svg>

                    <svg width="57" height="14" viewBox="0 0 57 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.8143 5.90125C21.6686 6.99408 20.7943 6.99408 19.9929 6.99408H19.5558L19.9201 4.88128C19.9201 4.73557 20.0658 4.66272 20.2115 4.66272H20.4301C21.0129 4.66272 21.5229 4.66272 21.8143 4.95414C21.8143 5.24556 21.8143 5.53698 21.8143 5.90125ZM21.45 2.98706H18.3173C18.0987 2.98706 17.953 3.13277 17.8801 3.35133L16.6416 11.3654C16.6416 11.5111 16.7145 11.6568 16.933 11.6568H18.3901C18.6087 11.6568 18.7544 11.5111 18.8272 11.2925L19.1915 9.10687C19.1915 8.8883 19.4101 8.74259 19.6287 8.74259H20.6486C22.6886 8.74259 23.8542 7.72262 24.2185 5.75554C24.3642 4.88129 24.2185 4.22559 23.8542 3.71561C23.2714 3.27848 22.47 2.98706 21.45 2.98706Z" fill="#263577"/>
                        <path d="M28.6615 8.81552C28.5158 9.68978 27.8601 10.2726 26.9859 10.2726C26.5487 10.2726 26.1845 10.1269 25.9659 9.83549C25.7473 9.54407 25.6745 9.17979 25.7473 8.81552C25.893 7.94126 26.5487 7.35842 27.423 7.35842C27.8601 7.35842 28.2244 7.50413 28.443 7.79555C28.5887 8.01411 28.7344 8.37839 28.6615 8.81552ZM30.7015 5.90133H29.2444C29.0987 5.90133 29.0258 5.97418 28.9529 6.11989L28.8801 6.55702L28.8072 6.41131C28.5158 5.97418 27.7873 5.75562 27.0587 5.75562C25.3831 5.75562 23.9988 6.99415 23.7074 8.74266C23.5617 9.61692 23.7802 10.4183 24.2902 11.0012C24.7274 11.5111 25.3831 11.7297 26.1845 11.7297C27.4958 11.7297 28.2244 10.8555 28.2244 10.8555L28.1515 11.2926C28.1515 11.4383 28.2244 11.584 28.443 11.584H29.7543C29.9729 11.584 30.1186 11.4383 30.1915 11.2197L30.9929 6.11989C30.9929 6.04703 30.92 5.90133 30.7015 5.90133Z" fill="#263577"/>
                        <path d="M38.6427 5.90137H37.1128C36.9671 5.90137 36.8214 5.97422 36.7485 6.11993L34.7086 9.17983L33.8343 6.26564C33.7615 6.04708 33.6157 5.97422 33.3972 5.97422H31.9401C31.7944 5.97422 31.6487 6.11993 31.7215 6.33849L33.3972 11.1469L31.8672 13.3326C31.7215 13.4783 31.8672 13.7697 32.0858 13.7697H33.6158C33.7615 13.7697 33.9072 13.6968 33.98 13.5511L38.9342 6.33849C39.007 6.11993 38.8613 5.90137 38.6427 5.90137Z" fill="#263577"/>
                        <path d="M43.9627 5.90125C43.817 6.99408 42.9428 6.99408 42.1414 6.99408H41.7042L42.0685 4.88128C42.0685 4.73557 42.2142 4.66272 42.3599 4.66272H42.5785C43.1613 4.66272 43.6713 4.66272 43.9627 4.95414C44.0356 5.24556 44.0356 5.53698 43.9627 5.90125ZM43.5985 2.98706H40.4657C40.2471 2.98706 40.1014 3.13277 40.0286 3.35133L38.79 11.3654C38.79 11.5111 38.8629 11.6568 39.0815 11.6568H40.6843C40.83 11.6568 40.9757 11.5839 40.9757 11.3654L41.34 9.10687C41.34 8.8883 41.5585 8.74259 41.7771 8.74259H42.7971C44.837 8.74259 46.0027 7.72262 46.367 5.75554C46.5127 4.88129 46.367 4.22559 46.0027 3.71561C45.4927 3.27848 44.6913 2.98706 43.5985 2.98706Z" fill="#2199D6"/>
                        <path d="M50.8822 8.81552C50.7365 9.68978 50.0808 10.2726 49.2066 10.2726C48.7694 10.2726 48.4052 10.1269 48.1866 9.83549C47.968 9.54407 47.8952 9.17979 47.968 8.81552C48.1137 7.94126 48.7694 7.35842 49.6437 7.35842C50.0808 7.35842 50.4451 7.50413 50.6637 7.79555C50.8094 8.01411 50.9551 8.37839 50.8822 8.81552ZM52.9222 5.90133H51.4651C51.3194 5.90133 51.2465 5.97418 51.1736 6.11989L51.1008 6.55702L51.0279 6.41131C50.7365 5.97418 50.008 5.75562 49.2794 5.75562C47.6038 5.75562 46.2195 6.99415 45.9281 8.74266C45.7824 9.61692 46.0009 10.4183 46.5109 11.0012C46.9481 11.5111 47.6038 11.7297 48.4052 11.7297C49.7165 11.7297 50.4451 10.8555 50.4451 10.8555L50.3723 11.2926C50.3723 11.4383 50.4451 11.584 50.6637 11.584H51.975C52.1936 11.584 52.3393 11.4383 52.4122 11.2197L53.2136 6.11989C53.2136 6.04703 53.0679 5.90133 52.9222 5.90133Z" fill="#2199D6"/>
                        <path d="M54.6708 3.20562L53.3594 11.3654C53.3594 11.5111 53.4322 11.6568 53.6508 11.6568H54.9622C55.1808 11.6568 55.3265 11.5111 55.3993 11.2925L56.6378 3.27848C56.6378 3.13277 56.565 2.98706 56.3464 2.98706H54.8893C54.8165 2.98706 54.7436 3.13277 54.6708 3.20562Z" fill="#2199D6"/>
                        <path d="M3.67338 13.1867L3.89193 11.6568H3.38195H0.832031L2.58055 0.509987C2.58055 0.509987 2.58055 0.437134 2.6534 0.437134H2.72626H7.02469C8.40893 0.437134 9.4289 0.728554 9.93888 1.31139C10.1574 1.60281 10.3032 1.89423 10.376 2.18565C10.4489 2.54992 10.4489 2.9142 10.376 3.42418V3.7156L10.5946 3.86131C10.8131 3.93417 10.9589 4.07987 11.1046 4.22558C11.3231 4.44415 11.4688 4.73557 11.4688 5.09984C11.5417 5.46412 11.5417 5.90124 11.396 6.41123C11.2503 6.99407 11.1046 7.43119 10.886 7.86832C10.6674 8.2326 10.376 8.52402 10.0846 8.81544C9.79317 9.034 9.35604 9.17971 8.99177 9.32542C8.55464 9.39827 8.11751 9.47113 7.60753 9.47113H7.24326C7.02469 9.47113 6.80613 9.54398 6.58757 9.68969C6.44186 9.8354 6.29615 10.054 6.22329 10.2725V10.4182L5.78616 13.1139V13.1867V13.2596C5.78616 13.2596 5.78616 13.2596 5.7133 13.2596H3.67338V13.1867Z" fill="#263577"/>
                        <path d="M10.8851 3.42419C10.8851 3.49705 10.8851 3.56991 10.8122 3.64276C10.2294 6.55695 8.33519 7.50406 5.85813 7.50406H4.61959C4.32817 7.50406 4.03676 7.72263 4.03676 8.01405L3.38106 12.0939L3.23535 13.2596C3.23535 13.4782 3.38106 13.6239 3.52677 13.6239H5.78527C6.07669 13.6239 6.29525 13.4053 6.29525 13.1867V13.041L6.73238 10.4183V10.2725C6.80524 9.98113 7.0238 9.83542 7.24237 9.83542H7.60664C9.79228 9.83542 11.4679 8.96116 11.9051 6.41124C12.1236 5.31842 11.9779 4.44416 11.4679 3.86132C11.3222 3.71562 11.1037 3.5699 10.8851 3.42419Z" fill="#2199D6"/>
                        <path d="M10.3026 3.20562C10.2298 3.20562 10.1569 3.13277 10.0112 3.13277C9.93835 3.13277 9.79263 3.05991 9.71978 3.05991C9.3555 2.98706 8.99123 2.98706 8.62695 2.98706H5.27564C5.20278 2.98706 5.12993 2.98706 5.05707 3.05991C4.91136 3.13277 4.76566 3.27848 4.76566 3.42419L4.03711 7.94119V8.0869C4.10996 7.79548 4.32852 7.57691 4.61994 7.57691H5.85848C8.33554 7.57691 10.2298 6.55695 10.8126 3.71561C10.8126 3.64275 10.8126 3.5699 10.8855 3.49704C10.7397 3.42419 10.594 3.35134 10.4483 3.27848C10.3755 3.20563 10.3026 3.20562 10.3026 3.20562Z" fill="#252C5E"/>
                        <path d="M4.76582 3.42417C4.76582 3.27846 4.91152 3.13275 5.05723 3.0599C5.13009 3.0599 5.20295 2.98705 5.2758 2.98705H8.62712C8.99139 2.98705 9.42852 2.98705 9.71994 3.0599C9.79279 3.0599 9.93851 3.0599 10.0114 3.13276C10.0842 3.13276 10.1571 3.20561 10.3028 3.20561C10.3756 3.20561 10.3756 3.20561 10.4485 3.27847C10.5942 3.35132 10.7399 3.42418 10.8856 3.49703C11.0313 2.40421 10.8856 1.67566 10.3028 1.01997C9.64709 0.291418 8.48141 0 7.02431 0H2.72588C2.43446 0 2.14304 0.218562 2.14304 0.509981L0.394531 11.7296C0.394531 11.9482 0.540241 12.1668 0.758805 12.1668H3.38157L4.03727 7.94118L4.76582 3.42417Z" fill="#263577"/>
                    </svg>

                    <svg width="52" height="15" viewBox="0 0 52 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58639 5.5137C2.47912 5.78187 2.42549 6.06792 2.35398 6.35396C2.1752 7.21211 2.03217 8.12388 1.83552 8.98202C1.4422 8.98202 1.03101 8.98202 0.637695 8.98202C1.08464 6.08579 1.90703 3.26108 2.26459 0.150315C2.6579 0.150315 3.05122 0.150315 3.42665 0.150315C3.37302 0.436362 3.30151 0.704532 3.26575 0.990579C3.26575 1.00846 3.23 1.02633 3.23 1.06209C3.76634 0.36485 4.58872 -0.117854 5.89381 0.0251696C7.18102 0.150315 7.87827 1.16936 7.9319 2.36718C8.05704 4.65556 6.84134 6.7294 4.33843 6.55062C3.51604 6.49699 2.89032 6.19306 2.58639 5.5137ZM4.26692 1.16936C3.21212 1.7057 2.19308 4.17285 3.3909 5.22765C4.17753 5.92489 5.41111 5.54946 5.92957 4.90585C6.51954 4.17285 7.05588 2.06326 6.16198 1.31238C5.85806 1.06209 5.37535 0.972701 4.9284 1.02633C4.6066 1.04421 4.4457 1.07997 4.26692 1.16936Z" fill="#030000"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4563 6.4255C13.0808 6.4255 12.7054 6.4255 12.3121 6.4255C12.3657 6.06794 12.4372 5.72826 12.5087 5.38858C12.1691 5.88916 11.5791 6.46126 10.7209 6.55065C9.48736 6.67579 8.36105 6.05006 8.25378 5.03102C8.21803 4.69134 8.23591 4.13712 8.52195 3.70805C9.23707 2.58174 11.0964 2.51023 12.9378 2.56386C13.492 0.525778 10.5243 0.829701 9.50524 1.49119C9.55887 1.09787 9.64827 0.722434 9.7019 0.329119C11.5433 -0.242976 14.0284 -0.0999513 14.1714 1.8845C14.225 2.67113 13.9926 3.43988 13.8496 4.19076C13.7066 4.92375 13.5635 5.63887 13.4563 6.4255ZM9.55888 4.79861C9.59463 5.31707 10.1667 5.60312 10.6316 5.60312C11.9009 5.62099 12.5087 4.51256 12.7054 3.422C11.2752 3.35049 9.46949 3.52927 9.55888 4.79861Z" fill="#030000"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2099 0.168213C16.4781 1.83086 16.7999 3.43988 17.0502 5.13828C17.9977 3.51139 18.8738 1.81298 19.8034 0.168213C20.2325 0.168213 20.6616 0.168213 21.1085 0.168213C19.9643 2.24206 18.6235 4.51255 17.3363 6.69366C16.9429 7.37303 16.5496 8.2848 15.9775 8.73175C15.477 9.12507 14.5115 9.21445 13.707 9.05355C13.7249 8.69599 13.8501 8.42783 13.8679 8.08815C14.0288 8.07027 14.2255 8.17754 14.4221 8.17754C15.2982 8.17754 15.7809 7.37303 16.1027 6.7473C15.7272 4.58407 15.316 2.43871 14.9406 0.257603C14.9049 0.221847 14.9227 0.203969 14.9406 0.168213C15.3697 0.168213 15.7988 0.168213 16.2099 0.168213Z" fill="#030000"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6276 10.0906C21.3594 11.6102 21.0197 13.0404 20.7516 14.56C19.9113 14.56 19.071 14.56 18.2129 14.56C18.6062 12.7007 18.9459 10.8593 19.3213 9.01787C19.6968 7.19432 20.1437 5.37077 20.3582 3.43995C21.0376 3.38632 21.9494 3.38632 22.6287 3.43995C22.6109 3.86902 22.5036 4.22658 22.4678 4.63778C23.1293 3.97629 23.8444 3.10027 25.3641 3.24329C26.8122 3.38632 27.6167 4.60202 27.724 6.13952C27.9206 8.78546 26.6334 11.3778 24.3093 11.5565C22.8612 11.6638 22.1818 11.0023 21.6276 10.0906ZM22.6466 6.13952C22.0566 6.97979 21.86 8.5888 22.6109 9.21453C23.0757 9.60785 23.9338 9.41119 24.3271 9.08939C24.8277 8.67819 25.1853 7.89156 25.1674 6.90827C25.1495 6.01438 24.7562 5.2635 23.8087 5.38865C23.2545 5.46016 22.9148 5.74621 22.6466 6.13952Z" fill="#009651"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M34.6776 11.3955C34.0161 11.3776 33.2652 11.4312 32.6574 11.3597C32.7289 11.0022 32.7289 10.5552 32.7825 10.1977C32.5859 10.3943 32.4428 10.6804 32.1925 10.9128C31.3701 11.6637 29.5287 11.8246 28.6169 11.0737C27.6337 10.2513 27.7946 8.28472 28.6169 7.44446C29.5645 6.46117 31.3523 6.21088 33.1937 6.40754C33.3725 5.65667 32.8719 5.19184 32.2462 5.10245C31.3344 4.97731 30.1187 5.37062 29.5824 5.69242C29.6896 5.04882 29.7254 4.35158 29.8505 3.70797C30.4941 3.47556 31.102 3.29678 31.8707 3.26102C33.9982 3.118 35.4642 3.83312 35.6072 5.65667C35.6787 6.62208 35.3927 7.62324 35.1782 8.57077C34.9815 9.50043 34.8385 10.448 34.6776 11.3955ZM32.121 7.8199C31.3523 7.83778 30.512 8.08807 30.3332 8.66016C30.1902 9.16074 30.5478 9.62557 30.9232 9.69708C32.1031 9.94738 32.9077 8.78531 32.997 7.85565C32.7289 7.80202 32.3356 7.8199 32.121 7.8199Z" fill="#009651"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M42.4725 3.70793C42.3473 4.35154 42.1149 4.88787 41.9898 5.53148C41.364 5.31694 40.6132 4.99514 39.6299 5.10241C39.2366 5.15604 38.8433 5.3527 38.8433 5.74601C38.8611 6.22872 39.5941 6.4075 40.0411 6.58628C40.6668 6.85445 41.4177 7.21201 41.7216 7.74835C42.2401 8.678 41.7216 10.0367 41.1674 10.6088C40.7026 11.0915 39.8265 11.4848 38.9326 11.5563C37.7706 11.6457 36.5549 11.4312 35.5537 11.163C35.6967 10.5015 35.8576 9.8937 36.0364 9.28585C36.6979 9.55402 37.4488 9.80431 38.4678 9.71492C38.9505 9.66129 39.4869 9.50038 39.4153 8.92829C39.3617 8.46346 38.6645 8.30256 38.146 8.08803C37.1806 7.69471 36.4655 7.19413 36.4655 5.88904C36.4655 3.20735 40.1841 2.7604 42.4725 3.70793Z" fill="#009651"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M48.8019 3.708C48.6589 4.33373 48.4622 4.9237 48.2834 5.53155C47.6934 5.29914 46.9247 4.99521 45.9414 5.10248C45.5481 5.13824 45.1548 5.33489 45.1548 5.74608C45.1727 6.24667 46.0666 6.51484 46.4777 6.69362C47.318 7.05118 48.1225 7.44449 48.2298 8.4099C48.3371 9.35743 47.9437 10.1262 47.3895 10.6446C46.8711 11.1452 46.1023 11.4849 45.2442 11.5564C44.0642 11.6458 42.92 11.4313 41.8652 11.1631C41.9725 10.4837 42.187 9.92953 42.3122 9.28592C42.7949 9.42894 43.2597 9.66136 43.8318 9.71499C44.6363 9.7865 45.7269 9.73287 45.709 9.03563C45.6911 8.28476 44.1357 8.12385 43.5279 7.64115C42.8664 7.12269 42.4552 5.85335 42.9737 4.81643C43.8318 3.20742 46.7817 2.84986 48.8019 3.708Z" fill="#009651"/>
                        <path d="M49.7486 4.53042H49.4268L49.4446 4.40527H50.2313L50.2134 4.53042H49.8916L49.7128 5.51371H49.5698L49.7486 4.53042Z" fill="#009651"/>
                        <path d="M51.0719 5.51371L51.1434 4.92374C51.1612 4.81647 51.1791 4.65557 51.197 4.5483C51.1434 4.65557 51.0897 4.79859 51.0182 4.90586L50.6964 5.51371H50.5892L50.4998 4.92374C50.4819 4.79859 50.464 4.67344 50.464 4.5483C50.4461 4.65557 50.4104 4.81647 50.3746 4.92374L50.2316 5.51371H50.1064L50.3925 4.40527H50.5713L50.6607 5.031C50.6785 5.12039 50.6785 5.22766 50.6785 5.31705C50.7143 5.22766 50.7679 5.13827 50.8037 5.04888L51.1434 4.40527H51.3221L51.1791 5.51371H51.0719Z" fill="#009651"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div id="item-details-section" class="flex flex-wrap mt-6">
        <div class="lg:pr-3 w-full lg:w-72%">
            <section class="md:mb-10">
                <div id="tabs" class="c-tabs">
                    <div class="flex dm-sans">
                        <div class="c-tabs-nav d-tab w-full">
                            <a href="javascript:void(0)" class="c-tabs-nav__link is-active">{{ __('Description') }}</a>
                            <a href="javascript:void(0)" class="c-tabs-nav__link">{{ __('Specification') }}</a>
                            <a href="javascript:void(0)" class="c-tabs-nav__link vendor-info">{{ __('Vendor Info') }}</a>
                            <a href="javascript:void(0)" class="c-tabs-nav__link">{{ __('Reviews') }} ({{ $reviewCount }})</a>
                        </div>
                    </div>

                    <div class="c-tab is-active md:mt-6">
                        <div class="c-tab__content">
                            <div id="item-details-section">
                                <div id="item-details" class="h-96 overflow-hidden relative item-full-details -mt-5 md:-mt-0">
                                    <div class="pl-1">
                                        <div class="pl-4">
                                            <h3 class="sr-only">{{ __('Description') }}</h3>
                                            <div class="space-y-6 list-style mb-20 roboto-medium text-sm md:text-15 text-gray-10">
                                                <P class="md:block hidden">
                                                    <iframe class="w-337p h-155p inline-block float-right rounded px-2" src="https://www.youtube.com/embed/Kch8n4tcOZQ" allowfullscreen></iframe>
                                                    <?= $item->description ?>
                                                </P>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="view-more" class="absolute justify-center flex inset-x-0 bottom-0 add">
                                        <div class="mb-2 mt-8 px-6 py-1 cursor-pointer rounded-sm">
                                            <a class="flex justify-center">
                                                <span class="pr-5p text-sm dm-sans font-medium text-gray-10">{{ __('See More') }}</span>
                                                <svg class="mt-2" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5L4.83564 5.74741L5.5 6.33796L6.16436 5.74741L5.5 5ZM0.335636 1.74741L4.83564 5.74741L6.16436 4.25259L1.66436 0.252591L0.335636 1.74741ZM6.16436 5.74741L10.6644 1.74741L9.33564 0.252591L4.83564 4.25259L6.16436 5.74741Z" fill="#898989"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="c-tab mt-6">
                        <div class="c-tab__content -mt-5 md:-mt-0">
                            <p class="roboto-medium text-sm md:text-15 font-medium text-gray-10">
                                {{ __('Specifications of :x', ['x' => $item->name]) }}
                            </p>
                            <div class="rounded my-6">
                                <table class="text-left w-full border-collapse border text-sm md:text-15">
                                    <tbody class="text-gray-10 roboto-medium">
                                    @foreach($item->itemAttributes as $attribute)
                                        <tr>
                                            <td class="py-4 px-6 border">{{ $attribute->attribute->name ?? '' }}</td>
                                            <td class="py-4 px-6 border">
                                                {{ $attribute->payloads }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="c-tab mt-8">
                        <div class="c-tab__content">
                            <div class="flex flex-wrap">
                                <div class="w-46% h-60">
                                    <img class="w-full h-full" src="{{ $item->vendor ? $item->vendor->fileUrl() : asset('public/frontend/assets/img/product/unsplash_7.png') }}" alt="">
                                </div>
                                <div class="w-54% pl-5">
                                    <div class="flex">
                                        <div class="w-60p h-60p border flex justify-center items-center rounded-sm">
                                            <svg width="16" height="40" viewBox="0 0 16 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99944 0C12.2195 0 13.9995 1.78004 13.9995 4.0001C13.9995 6.22015 12.2195 8.0002 9.99944 8.0002C7.77939 8.0002 5.99934 6.22015 5.99934 4.0001C5.99934 1.78004 7.77939 0 9.99944 0ZM3.99971 16.0004C1.65965 16.9804 0.0196095 19.3205 -0.000391006 22.0005V30.0007H5.99976V40.001H11.9999V30.0007H16V16.0004C16 12.6803 13.3199 10.0002 9.99985 10.0002C6.67977 10.0002 3.99971 12.6803 3.99971 16.0004Z" fill="#994ABE" fill-opacity="0.54"/>
                                            </svg>
                                        </div>
                                        <div class="pl-15p flex flex-col justify-center">
                                            <p class="dm-bold text-gray-12 text-lg" >{{ $item->vendor->shops[0]->name ?? null }}</p>

                                            <div class="flex items-center cursor-pointer">
                                                <ul class="flex rtl-direction-space-left space-x-5p">
                                                    <li>
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" fill="#FCCA19"/>
                                                        </svg>
                                                    </li>

                                                    <li>
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" fill="#FCCA19"/>
                                                        </svg>
                                                    </li>

                                                    <li>
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" fill="#FCCA19"/>
                                                        </svg>
                                                    </li>
                                                    <li>
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" fill="#FCCA19"/>
                                                        </svg>
                                                    </li>
                                                    <li>
                                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z" fill="#FCCA19"/>
                                                        </svg>
                                                    </li>

                                                </ul>
                                                <span class="roboto-medium font-medium text-sm text-gray-10 pl-2">(20 reviews)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex mt-5 roboto-medium text-sm text-gray-10">
                                        <p class="w-23%">
                                            {{ __('Owner Name') }}:
                                        </p>
                                        <p class="w-77%">
                                            {{ $item->vendor->name ?? null }}
                                        </p>
                                    </div>

                                    <div class="flex mt-5 roboto-medium text-sm text-gray-10">
                                        <p class="w-23%">
                                            {{ __('Website') }}:
                                        </p>
                                        <p class="w-23%">
                                            {{ $item->vendor->website ?? null }}
                                        </p>
                                    </div>
                                    <div class="flex mt-5 roboto-medium text-sm text-gray-10">
                                        <p class="w-23%">
                                            {{ __('Phone') }}:
                                        </p>
                                        <p class="w-77%">
                                            {{ $item->vendor->phone ?? null }}
                                        </p>
                                    </div>

                                    <a href="{{ route('site.shop', ['alias' => $shopAlias]) }}" class="relative text-gray-12 font-medium text-base inline-flex items-center dm-sans justify-end mt-5 process-visit">Visit Store
                                        <svg class="w-4 h-4 ml-2 mt-0.5 absolute" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="currentColor"></path>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mt-30p space-x-30p">
                            <div class="relative border-r h-60p pr-30p">
                                <p class="text-gray-10 text-sm roboto-medium font-medium mt-1">{{ __('Positive Seller Ratings') }}</p>
                                <p class="text-xl font-bold mt-3 absolute bottom-0 ml-1 text-orange-2">{{ $item->positiveRating($item->vendor_id) }}%</p>
                            </div>

                            <div class="relative border-r h-60p ">
                                <p class="text-gray-10 text-sm roboto-medium font-medium mt-1 pr-30p">Ship on Time</p>
                                <p class="text-xl font-bold mt-3 absolute bottom-0 ml-1 text-green-4">98%</p>
                            </div>

                            <div class="relative h-60p ">
                                <p class="text-gray-10 text-sm roboto-medium font-medium mt-1 pr-30p">Response Rate</p>
                                <p class="text-xl font-bold mt-3 absolute bottom-0 ml-1 text-green-4">87%</p>
                            </div>
                        </div>
                    </div>

                    <div class="c-tab review md:mt-6">
                        <div class="c-tab__content">
                            <div class="md:mt-4">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-6 lg:grid-cols-6">
                                    <div class="col-span-3">
                                        <div class="flex items-center">
                                            <p class="text-52 text-gray-12 dm-bold">{{ round($avg, 1) }}</p>
                                            <div class="pl-2.5">
                                                <p class="roboto-medium text-base text-gray-12">{{ __('Average Rating') }}</p>
                                                <ul class="flex items-center focus-within mt-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (round($avg) >= $i)
                                                            <li>
                                                                <svg class="text-green-500" width="13" height="12" viewBox="0 0 13 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z"/>
                                                                </svg>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <svg width="13" height="12" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M7.9048 0L9.72229 5.59367H15.6038L10.8456 9.05074L12.6631 14.6444L7.9048 11.1873L3.14654 14.6444L4.96404 9.05074L0.205779 5.59367H6.08731L7.9048 0Z" fill="#C4C4C4"/>
                                                                </svg>
                                                            </li>
                                                        @endif
                                                    @endfor
                                                    <p class="text-gray-10 text-xs roboto-medium ml-1"> ({{ $reviewCount }} {{ $reviewCount > 1 ? __('Reviews') : __('Rating') }})</p>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="mb-1 tracking-wide mt-2 md:mt-0 md:py-4" >
                                            <div class="md:pb-3">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <div class="flex items-center mt-1">
                                                        <div class=" text-indigo-500 tracking-tighter mr-4">
                                                            <ul class="flex">
                                                                @for($j = 1; $j <= 5; $j++)
                                                                    @if ($i >= $j)
                                                                        <li>
                                                                            <svg class="text-green-500" width="13" height="12" viewBox="0 0 13 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6.15238 0L7.53368 4.25119H12.0036L8.38736 6.87857L9.76866 11.1298L6.15238 8.50238L2.5361 11.1298L3.9174 6.87857L0.301119 4.25119H4.77109L6.15238 0Z"/>
                                                                            </svg>
                                                                        </li>
                                                                    @else
                                                                        <li>
                                                                            <svg width="13" height="12" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M7.9048 0L9.72229 5.59367H15.6038L10.8456 9.05074L12.6631 14.6444L7.9048 11.1873L3.14654 14.6444L4.96404 9.05074L0.205779 5.59367H6.08731L7.9048 0Z" fill="#C4C4C4"/>
                                                                            </svg>
                                                                        </li>
                                                                    @endif
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                        @php
                                                            $percent = 0;
                                                            if ($reviewCount > 0) {
                                                                $percent = intval(($item->review->where('status', 'Active')->where('is_public', 1)->where('rating', $i)->count() / $reviewCount) * 100);
                                                            }
                                                        @endphp
                                                        <div class="w-49%">
                                                            <div class="bg-gray-6 w-full rounded-lg h-2">
                                                                <div data-width="{{ $percent }}" class="rating-width bg-green-500 color_switch_bac rounded-lg h-2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="w-1/5 text-gray-700 pl-3">
                                                            <span class="text-sm">{{ $percent }}%</span>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-3">
                                        @if (!auth()->user())
                                            <div class="flex flex-col justify-center items-center">
                                                <p class="dm-sans text-lg md:text-20 text-gray-12 md:mt-24">{{ __('To give a review, you need to login first.') }}</p>
                                                <a href="{{ route('site.login') }}" class="border w-52 py-1 text-center mt-18p text-base dm-sans text-gray-12 rounded">Login</a>
                                            </div>
                                        @endif

                                        @if(auth()->user() && auth()->user()->review()->where('item_id', $item->id)->count() == 0 && auth()->user()->verifiedUser($item->id))
                                        <section class="text-gray-600 body-font mt-4 review-store-section">
                                            <form method="post" action="" id="reviewFrom" enctype="multipart/form-data">
                                                @csrf
                                                <div class="flex flex-col">
                                                    <h1 class="text-lg font-medium dm-sans text-gray-12">{{ __('Add A Review') }}</h1>
                                                </div>
                                                <input type="hidden" id="deleted-files" name="deleted_files">
                                                <div class="flex justify-between items-center cursor-pointer mt-4 border rounded px-15p py-13p">
                                                    <p class="dm-sans text-sm fonr-medium text-gray-12">{{ __('Add Your Rating') }} </p>
                                                    <div class='rating-stars text-center'>
                                                        <ul id='stars' class="text-xs">
                                                            <li class='star' title="{{ __('Poor') }}" data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title="{{ __('Fair') }}" data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title="{{ __('Good') }}" data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title="{{ __('Excellent') }}" data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title="{{ __('WOW') }}" data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="item_id" value="{{ $item->id }}">
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                                                    <label class="block text-left mt-3 col-span-2 c-label">
                                                        <span class="text-sm text-gray-12 dm-sans">{{ __('Write Your Review') }}</span>
                                                        <textarea class="form-control form-textarea block w-full rounded text-13 roboto-medium h-32 mt-2.5"
                                                            id="comments" name="comments" rows="3" placeholder="{{ __('Your review') }}"
                                                            value="{{ old('name') }}"></textarea>
                                                    </label>
                                                    <label class="block text-left md:mt-3 col-span-2 md:col-span-0">
                                                        <span class="text-sm text-gray-12 dm-sans">{{ __('Attachments') }}</span>
                                                        <div class="relative h-24 rounded border-dashed mt-2.5 py-16 border bg-white flex justify-center items-center hover:cursor-pointer">
                                                            <div class="absolute">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <div class="text-xl mb-3">
                                                                        <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <circle cx="19" cy="19" r="19" fill="#F3F3F3"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4232 20.4614C12.8267 20.4614 13.1539 20.7886 13.1539 21.1922V24.1153C13.1539 24.3091 13.2309 24.495 13.368 24.632C13.505 24.769 13.6909 24.846 13.8847 24.846H24.1155C24.3093 24.846 24.4951 24.769 24.6322 24.632C24.7692 24.495 24.8462 24.3091 24.8462 24.1153V21.1922C24.8462 20.7886 25.1734 20.4614 25.577 20.4614C25.9806 20.4614 26.3078 20.7886 26.3078 21.1922V24.1153C26.3078 24.6967 26.0768 25.2543 25.6657 25.6655C25.2545 26.0766 24.6969 26.3076 24.1155 26.3076H13.8847C13.3033 26.3076 12.7456 26.0766 12.3345 25.6655C11.9234 25.2543 11.6924 24.6967 11.6924 24.1153V21.1922C11.6924 20.7886 12.0196 20.4614 12.4232 20.4614Z" fill="#898989"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4831 11.9062C18.7685 11.6208 19.2312 11.6208 19.5166 11.9062L23.1704 15.56C23.4558 15.8454 23.4558 16.3081 23.1704 16.5935C22.885 16.8789 22.4223 16.8789 22.137 16.5935L18.9998 13.4564L15.8627 16.5935C15.5774 16.8789 15.1147 16.8789 14.8293 16.5935C14.5439 16.3081 14.5439 15.8454 14.8293 15.56L18.4831 11.9062Z" fill="#898989"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.0003 11.6921C19.4039 11.6921 19.7311 12.0193 19.7311 12.4229V21.1921C19.7311 21.5957 19.4039 21.9229 19.0003 21.9229C18.5967 21.9229 18.2695 21.5957 18.2695 21.1921V12.4229C18.2695 12.0193 18.5967 11.6921 19.0003 11.6921Z" fill="#898989"/>
                                                                        </svg>
                                                                    </div>
                                                                    <span class="block text-gray-400 font-normal text-xss">{{ __('Attach you files here') }}</span>
                                                                    <p class="flex text-xss">or <span class="block text-blue-400 text-xss ml-0.5">browse files</span></p>
                                                                </div>
                                                            </div>
                                                            <input type="file" id="image" name="image[]" multiple class="h-full w-full opacity-0">
                                                        </div>
                                                    </label>
                                                </div>
                                                <div id="message" class="mt-4">

                                                </div>
                                                <div id="imgs" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-2.5">

                                                </div>
                                                <button class="text-white bg-black mt-2.5 rounded-sm text-xs p-2 w-33 text-center dm-regular">Submit Review</button>
                                            </form>
                                        </section>
                                        @endif
                                    </div>
                                </div>

                                <div id="review-section" class="flex justify-between items-center border-b pb-1 mt-5 md:mt-0">
                                    <h2 class="font-bold text-gray-12 dm-bold text-base md:text-20">
                                        Product Reviews
                                    </h2>

                                    <div class="flex justify-center md:pr-4 items-center">

                                        <div x-data="{ dropdownOpen: false }" class="relative ml-2">
                                            <button @click="dropdownOpen = !dropdownOpen" class="inline-flex justify-between items-center w-25 md:w-48 rounded  md:px-2 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                            <div class="flex text-gray-500 items-center">
                                                <svg class="mr-5p md:block hidden" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.57238C0 0.703977 0.696446 0 1.55556 0H12.4444C13.3036 0 14 0.703977 14 1.57238V2.8191C14 3.23612 13.8361 3.63606 13.5444 3.93094L10.1111 7.40135V11.5095C10.1111 12.0171 9.78977 12.4677 9.31337 12.6283L5.42448 13.9386C4.66903 14.1931 3.88888 13.6247 3.88888 12.8198V7.40134L0.455612 3.93094C0.163888 3.63606 0 3.23612 0 2.8191V1.57238ZM12.4444 1.57238H1.55556V2.8191L4.98883 6.2895C5.28055 6.58438 5.44444 6.98432 5.44444 7.40134V12.2744L8.55555 11.2262V7.40135C8.55555 6.98433 8.71944 6.58439 9.01116 6.28951L12.4444 2.8191V1.57238Z" fill="#898989"/>
                                                </svg>
                                                <svg class="md:hidden mr-5p" width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.23544C0 0.553125 0.547208 0 1.22222 0H9.77778C10.4528 0 11 0.553125 11 1.23544V2.21501C11 2.54267 10.8712 2.85691 10.642 3.0886L7.94444 5.81535V9.04318C7.94444 9.44201 7.69196 9.79609 7.31765 9.92221L4.26209 10.9517C3.66852 11.1517 3.05555 10.7052 3.05555 10.0727V5.81534L0.357981 3.0886C0.12877 2.85691 0 2.54267 0 2.21501V1.23544ZM9.77778 1.23544H1.22222V2.21501L3.91979 4.94175C4.149 5.17344 4.27777 5.48768 4.27777 5.81534V9.64419L6.72222 8.82057V5.81535C6.72222 5.48769 6.85099 5.17345 7.0802 4.94176L9.77778 2.21501V1.23544Z" fill="#898989"/>
                                                </svg>

                                                <span class="roboto-medium text-13 md:text-base text-gray-10">Filter:</span>
                                            </div>
                                            <svg class="w-2 h-1 md:w-0 md:h-0" width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.87867e-08 1.39309L1.5814 1.8858e-08L7.5 5.21383L13.4186 1.60015e-07L15 1.39309L7.5 8L7.87867e-08 1.39309Z" fill="#898989"/>
                                            </svg>
                                            </button>

                                            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

                                            <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-24 md:w-48 bg-white rounded shadow z-20 roboto-medium" style="display: none;">
                                                <button @click="dropdownOpen = false" data-star="0" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="text-green-500 text-md">✓</span><span class="inline-block ml-3 text-green-500">All Star</span>
                                                </button>
                                                <button @click="dropdownOpen = false"  data-star="5" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="inline-block ml-6">5 Star</span>
                                                </button>
                                                <button @click="dropdownOpen = false" data-star="4" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="inline-block ml-6">4 Star</span>
                                                </button>
                                                <button @click="dropdownOpen = false" data-star="3" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="inline-block ml-6">3 Star</span>
                                                </button>
                                                <button @click="dropdownOpen = false" data-star="2" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="inline-block ml-6">2 Star</span>
                                                </button>

                                                <button @click="dropdownOpen = false" data-star="1" data-item="{{ $item->id }}" class="filter w-full text-left px-3 py-2 text-sm capitalize hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                    <span class="inline-block ml-6">1 Star</span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:p-4">
                                    <div id="load_review">
                                        @include('site.item.review')
                                    </div>

                                    <div class="bg-gray-11 mt-3 md:mt-0 md:mx-24 rounded">
                                        <div class="p-4 roboto-italic-regular">
                                            <p class="text-black text-sm font-bold">Lavisho Bangladesh responded:</p>
                                            <p class="text-xs text-gray-10 ml-11 mt-5p">“Lorem ipsum dolor sit 2007, consectetur adipiscing elit. Eu pretium lacus mattis tristique est nisl amet
                                                commodo, volutpat. Cras egestas id in amet aliquet arcu.”
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex justify-center">
                                        <a class="relative text-gray-12 font-medium text-sm inline-flex items-center dm-sans justify-end mt-5 process-visit">See All Reviews
                                            <svg class="w-2.5 h-2 md:w-4 md:h-4 ml-2 mt-0.5 absolute" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="currentColor"></path>
                                            </svg>
                                        </a>
                                    </div>

                                    <hr class="mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             @include('site.layouts.section.item-details.related-items')

        </div>

        <div class="lg:pl-3 w-full lg:w-28% md:mt-4">
            <div class="relative z-ng px-2 pb-15p border rounded rounded-b-none">
                <div class="flex flex-wrap px-2">
                    <div class="w-4/5">
                        <p class="text-gray-10 dm-bold font-bold text-xs pt-4">{{ __('Sold By') }}</p>
                        <p class="text-base text-gray-12 dm-bold font-bold">{{ $item->vendor->shops[0]->name ?? null }}</p>
                    </div>
                    <div class="w-1/5">
                        <div class="mt-4">
                            <img src="{{ asset('public/frontend/assets/img/product/levisho.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/3">
                        <div class="relative border-r h-66p px-2">
                            <p class="text-gray-10 text-11 roboto-medium font-medium mt-1">{{ __('Positive Seller Ratings') }}</p>
                            <p class="text-xl roboto-medium font-medium mt-3 absolute bottom-0">{{ $item->positiveRating($item->vendor_id) }}%</p>
                        </div>
                    </div>

                    <div class="w-1/3">
                        <div class="relative border-r h-66p px-2">
                            <p class="text-gray-10 text-11 roboto-medium font-medium mt-1">{{ __('Ship on Time') }}</p>
                            <p class="text-xl roboto-medium font-medium mt-3 absolute bottom-0">99%</p>
                        </div>
                    </div>

                    <div class="w-1/3">
                        <div class="relative h-66p px-2">
                            <p class="text-gray-10 text-11 roboto-medium font-medium mt-1">{{ __('Response Rate') }}</p>
                            <p class="text-xl roboto-medium font-medium mt-3 absolute bottom-0">87%</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('site.shop', ['alias' => $shopAlias]) }}" class="process-goto relative flex justify-center text-gray-12 font-medium text-sm items-center py-2 dm-sans bg-gray-11 border border-t-0 rounded rounded-t-none">
                <span class="-ml-5">{{ __('Go to Store') }}</span>
                <svg class="ml-2 relative" width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08128 0L6.90393 1.05155L8.81279 2.75644H0.832512C0.372728 2.75644 0 3.08934 0 3.5C0 3.91066 0.372728 4.24356 0.832512 4.24356H8.81279L6.90393 5.94845L8.08128 7L12 3.5L8.08128 0Z" fill="#2C2C2C"/>
                </svg>
            </a>

            @include('site.layouts.section.item-details.same-shop')

            <div class="mt-2.5 lg:block hidden">
                <img class="w-full" src="{{ asset('public/frontend/assets/img/product/SideBanner.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
<!-- Details section end -->
@endsection
@section('js')

<script>
    var itemId = "{{ $item->id }}";
    var reviewUrl = "{{ route('fetch.review') }}";
    var slideCounts = "{{ count($item->filesUrl()) ?? 0 }}";
</script>
<script src="{{ asset('public/frontend/assets/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/flatpickr.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/wishlist.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/compare.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/description-tabs.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/item-details.min.js') }}"></script>

@endsection
