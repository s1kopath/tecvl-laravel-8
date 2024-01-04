@if (count($bestCategories) > 0)
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-30p md:mt-12">
    <P class="text-center font-bold text-sm md:text-22 text-gray-12 uppercase dm-bold">{{ __('Top Categories of the Month') }}</P>
    <div class="grid lg:grid-cols-5 lg:gap-30p mt-2.5 md:mt-5 grid-flow-col lg:grid-flow-row gap-4 auto-cols-max overflow-auto">
        @foreach($bestCategories as $key => $category)
            <a href="{{ route('site.categoryItems', $category->slug) }}">
                <div class="border hover:bg-yellow-1 rounded-md relative">
                    <div class="md:p-10 p-22p flex justify-center" >
                        <img class="md:h-28 md:w-28 w-66p h-66p object-contain" src="{{ $category->fileUrl() }}" alt="">
                    </div>
                    <div class="opacity-0 hover:opacity-100 duration-300 absolute inset-0 z-10 flex justify-center items-center text-xs md:text-xl text-white font-semibold">
                        <p class="text-gray-12 font-bold absolute inset-x-0 bottom-1 md:bottom-5 text-center">{{ $category->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
