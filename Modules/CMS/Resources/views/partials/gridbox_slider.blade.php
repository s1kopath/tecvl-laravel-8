@if (hasAnotherSlider($data, 1))
    <div class="w-322p sidebar_slider">
        @php
            $counter = 0;
        @endphp
        @while (hasAnotherSlider($data, ++$counter))
            <div class="relative builder_slider h-full fade">
                <img class="w-full h-full object-cover rounded-md"
                    src="{{ $homeService->getImage($data['image_slider' . $counter]) }}" alt="">
                <div class="absolute bottom-0 p-6">
                    @if ($data['u_subtitle_slider' . $counter])
                        <p class="text-11 text-white dm-regular font-normal">
                            {{ $data['u_subtitle_slider' . $counter] }}</p>
                    @endif
                    @if ($data['l_subtitle_slider' . $counter])
                        <p class="text-white text-lg uppercase font-bold dm-bold">
                            {!! $data['l_subtitle_slider' . $counter] !!}
                        </p>
                    @endif
                    <p class="text-white text-2.5xl -mt-1.5 uppercase font-bold dm-bold">
                        {{ $data['title_slider' . $counter] }}</p>
                    <div
                        class="flex text-white border-white border text-11 justify-center p-2 w-29 mt-3 hover:bg-white hover:text-gray-12 cursor-pointer">
                        <p class="pr-5p font-medium">
                            {{ $data['button_slider' . $counter] ?? 'Shop Now' }}</p>
                        <svg class="mt-5p" width="10" height="7" viewBox="0 0 10 7" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
            </div>
        @endwhile
    </div>
@endif
