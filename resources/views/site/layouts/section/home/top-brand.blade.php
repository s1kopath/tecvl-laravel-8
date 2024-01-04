@if (count($topBrands) > 0)
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-30p md:mt-12">
    <P class="dm-bold text-sm text-center md:text-left md:text-22 text-gray-12 uppercase">{{ __('Top Brands') }}</P>
    <div class="flex flex-col md:flex-row mt-2 md:mt-5 md:space-x-29p">
        @foreach ($topBrands as $brand)
            @if ($loop->iteration == 1)
                <a href="{{ route('site.brandItems', ['id' => $brand->id]) }}" class="relative h-36 md:h-80 md:w-1/4 border rounded-md">
                    <div class="inset-center">
                        <div class="grow">
                            <img class="w-29 h-29 object-contain" src="{{ $brand->fileUrl() }}" alt="">
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
        <div class="w-full md:w-3/4 mt-5 md:mt-0">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-7">
                @foreach ($topBrands as $brand)
                    @if ($loop->iteration > 1)
                        <a href="{{ route('site.brandItems', ['id' => $brand->id]) }}">
                            <div class="border rounded-md">
                                <div class="grow p-6 flex flex-row h-36 justify-center items-center">
                                    <img class="w-80p h-20 object-contain" src="{{ $brand->fileUrl() }}" alt="">
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
