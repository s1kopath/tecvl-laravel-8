@if (isset($data['image_banner']))
    <div class="w-322p">
        <div class="relative h-full dm-sans ">
            <img class="w-full h-full object-cover rounded-md"
                src="{{ $homeService->getImage($data['image_banner']) }}" alt="">
            <div class="absolute top-0 p-6">
                @if (isset($data['u_subtitle_slide']))
                    <p class="text-xs text-gray-1">{{ $data['u_subtitle_slide'] }}</p>
                @endif
                @if (isset($data['l_subtitle_banner']))
                    <p class="text-gray-12 font-medium text-lg uppercase">{{ $data['l_subtitle_banner'] }}</p>
                @endif
                @if (isset($data['title_banner']))
                    <p class="text-gray-12 font-bold text-2.5xl -mt-1.5 uppercase">{{ $data['title_banner'] }}</p>
                @endif
                @if (isset($data['button_banner']))
                    <div
                        class="flex text-gray-12 border-gray-800 border rounded-sm text-xs justify-center p-2 w-29 mt-3 hover:bg-gray-12 hover:text-white cursor-pointer">
                        <p class="pr-5p font-medium">{{ $data['button_banner'] }}</p>
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
    </div>
@endif
