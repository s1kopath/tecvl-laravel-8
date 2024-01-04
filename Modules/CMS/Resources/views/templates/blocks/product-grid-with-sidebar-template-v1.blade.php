@php
$data = getComponentProperties($component);
$offset = builderGetValue($data, 'sidebar') == 'flash_sale' ? 1 : 0;
$products = $homeService->getProducts($data['showcase_type'], $offset ? 11 : 10);
$flashProduct = $data['sidebar'] == 'flash_sale' ? $products->shift() : null;
@endphp
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12">
    <div class="flex justify-{{ builderGetValue($data, 'see_more') == 1 ? 'between' : 'center' }}">
        <P class="font-bold text-22 text-gray-12 uppercase dm-bold">{{ $data && $data['title'] ? $data['title'] : '' }}
        </P>
        @if ($data && $data['see_more'] && isset($data['more_link']))
            <a href="{{ $data['more_link'] }}"
                class="text-gray-10 font-medium text-base inline-flex items-center mt-0.5 dm-sans">{{ __('See More') }}
                <svg class="w-4 h-4 ml-2 mt-0.5" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                        fill="currentColor" />
                </svg>
            </a>
        @endif
    </div>

    <div class="flex mt-5">
        @if ($data && isset($data['sidebar']) && isset($data['sidebar_position']) && $data['sidebar_position'] == 'left')
            @include('cms::partials.sidebar')
        @endif

        @if (isset($data['showcase_type']))
            <div
                class="w-full {{ isset($data['sidebar']) && isset($data['sidebar_position']) ? ($data['sidebar_position'] == 'left' ? 'pl-5' : 'pr-5') : '' }}">
                <div class="grid grid-cols-5 gap-5">
                    @if ($products)
                        @forelse ($products as $item)
                            @include('cms::partials.product')
                        @empty
                            <h2 class="">{{ __('No products') }}</h2>
                        @endforelse
                    @endif
                </div>
            </div>
        @endif

        @if ($data && isset($data['sidebar']) && isset($data['sidebar_position']) && $data['sidebar_position'] == 'right')
            @include('cms::partials.sidebar')
        @endif

    </div>
</section>
