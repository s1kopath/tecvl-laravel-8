<section>
    <div class="container mx-auto px-4 pt-8">
        <div class="border-l-4 border-green-500 color_switch_border">
            <h3 class="text-xl font-bold ml-3 py-2 text-gray-900 rtl-direction-space">
                {{ __('All Product') }}
            </h3>
        </div>

        <div class="grid py-10 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 2xl:grid-cols-5 gap-x-3 md:gap-x-5 xl:gap-x-8 gap-y-5 lg:gap-y-5 xl:lg:gap-y-7 2xl:gap-y-8">
            @foreach ($allItems as $item)
                @include('site.layouts.section.card-one')
            @endforeach
        </div>
    </div>
</section>
<div class="px-4" style="z-index: -1">
    {{ $allItems->links('pagination::tailwind') }}
</div>
