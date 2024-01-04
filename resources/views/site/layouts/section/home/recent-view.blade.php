@if (!empty($recentView))
<section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12 hidden lg:block">
    <P class="text-center font-bold text-22 text-gray-12 uppercase dm-bold"> {{ __('Your Recent Views') }} </P>

    <!-- Big cards slider -->
    <div class="slider-big-cards mt-8">
        @foreach($recentView as $key => $item)
            <a class="slider-big-cards__item bg-gray-11 rounded-md" href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}">
                <img class="object-contain" src="{{ $item->fileUrl() }}" alt="">
            </a>
        @endforeach
    </div>
</section>
@endif
