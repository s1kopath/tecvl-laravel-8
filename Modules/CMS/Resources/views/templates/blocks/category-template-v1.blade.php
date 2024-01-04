@php
$cType = componentValue($component ?? null, 'category_type');
$categories = $homeService->categories($cType, [], $cType == 'selectedCategories' ? componentValue($component ?? null, 'categories') : null);
@endphp
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12">
    @if (componentValue($component, 'title'))
        <p class="text-center font-bold text-22 text-gray-12 uppercase dm-bold">
            {{ componentValue($component, 'title') }}</p>
    @endif
    <div class="grid grid-cols-5 gap-30p mt-5  ">
        @foreach ($categories as $category)
            <a href="{{ route('site.categoryItems', $category->slug) }}">
                <div class="bg-gray-11 hover:bg-yellow-1 rounded-md relative">
                    <div class="p-10 flex justify-center">
                        <img class="h-28 w-28" src="{{ $category->fileUrl() }}" alt="">
                    </div>
                    <div
                        class="opacity-0 hover:opacity-100 duration-300 absolute inset-0 z-10 flex justify-center items-center text-xl text-white font-semibold">
                        <p class="text-gray-12 font-bold absolute inset-x-0 bottom-5 text-center">{{ $category->name }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
