@php
$data = getComponentProperties($component);
@endphp
<section dir="ltr" class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 my-40p">
    <div class="relative">
        <div style="background:linear-gradient(to right, #FDFDFD 21.44%, rgba(223, 223, 223, 0) 70.79%), url('{{ $homeService->getImage(isset($data['image']) ? $data['image'] : null) }}')"
            class="promote-img rounded-md">
        </div>
        <div class="absolute top-0 p-6">
            @if (isset($data) && isset($data['upper_st']))
                <p class="text-lg font-medium text-gray-10 dm-sans">{{ $data['upper_st'] }}</p>
            @endif
            @if (isset($data) && isset($data['title']))
                <p class="text-gray-12 font-bold text-2.5xl -mt-1.5 uppercase dm-bold">
                    {{ $data['title'] }}</p>
            @endif
            @if (isset($data) && isset($data['lower_st']))
                <p class="text-base dm-sans">{{ $data['lower_st'] }}</p>
            @endif

            @if (isset($data) && isset($data['btn_text']))
                <div
                    class="flex text-gray-12 border-gray-800 border rounded-sm text-xs justify-center p-2 w-29 mt-3 hover:bg-gray-12 hover:text-white cursor-pointer">
                    <a href="{{ isset($data['btn_link']) ? $data['btn_link'] : 'javascript:void(0)' }}"
                        class="pr-5p font-medium">{{ $data['btn_text'] }}</a>
                    <svg class="mt-5p" width="10" height="7" viewBox="0 0 10 7" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
            @endif

        </div>
    </div>
</section>
