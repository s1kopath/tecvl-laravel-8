@php
$data = getComponentProperties($component);
$totalCard = totalSimilarItems($data, 'title_');
$counter = 0;
@endphp
@if ($totalCard)
    <section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-40p">
        <div class="flex space-x-30p mt-8">
            @while (hasAnotherItem($data, 'title_', ++$counter))
                <div class="w-{{ $totalCard == 1 ? 'full' : '1/' . $totalCard }}">
                    <div class="relative">
                        <div class="h-44">
                            <img class="h-full w-full object-cover rounded-md"
                                src="{{ $homeService->getImage(builderGetValue($data, 'image' . $counter)) }}" alt="">
                        </div>
                        <div class="absolute top-0 p-6">
                            @if (builderGetValue($data, 'upper_st' . $counter))
                                <p class="text-11 text-gray-12 dm-regular">
                                    {{ builderGetValue($data, 'upper_st' . $counter) }}</p>
                            @endif

                            @if (builderGetValue($data, 'lower_st' . $counter))
                                <p class="text-gray-12 font-bold text-lg uppercase dm-bold">
                                    {{ $data['lower_st' . $counter] }}</p>
                            @endif

                            @if (builderGetValue($data, 'title_' . $counter))
                                <p class="text-gray-12 font-bold text-33 -mt-3 uppercase dm-bold">
                                    {{ builderGetValue($data, 'title_' . $counter) }}</p>
                            @endif

                            @if (builderGetValue($data, 'btn_text' . $counter))
                                <a href="{{ builderGetValue($data, 'btn_link' . $counter) ?? 'javascript:void(0)' }}"
                                    class="flex text-gray-12 border-gray-800 border rounded-sm text-xs justify-center p-2 w-29 mt-2 hover:bg-gray-12 hover:text-white cursor-pointer">
                                    <p class="pr-5p font-medium">{{ builderGetValue($data, 'btn_text' . $counter) }}
                                    </p>
                                    <svg class="mt-5p" width="10" height="7" viewBox="0 0 10 7"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endwhile
        </div>
    </section>
@endif
