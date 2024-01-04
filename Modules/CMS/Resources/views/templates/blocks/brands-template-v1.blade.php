@php
$topBrands = $homeService->getBrands(componentValue($component, 'brand_type'));
@endphp
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12">
    @if (componentValue($component, 'title'))
        <P class="font-bold text-22 text-gray-12 uppercase dm-bold">{{ componentValue($component, 'title') }}</P>
    @endif
    <div class="flex mt-5 space-x-29p">
        @if (count($topBrands) > 0 && ($brand = $topBrands->shift()))
            <a href="{{ route('site.brandItems', ['id' => $brand->id]) }}"
                class="relative h-80 w-1/4 border rounded-md">
                <div class="inset-center">
                    <div class="grow">
                        <img class="w-29" src="{{ $brand->fileUrl() }}" alt="">
                    </div>
                </div>
            </a>
        @endif
        <div class="w-3/4">
            <div class="grid grid-cols-4 gap-7">
                @foreach ($topBrands as $brand)
                    <a href="{{ route('site.brandItems', ['id' => $brand->id]) }}">
                        <div class="border rounded-md">
                            <div class="grow p-6 flex flex-row h-36 justify-center items-center">
                                <img class="w-80p" src="{{ $brand->fileUrl() }}" alt="">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
