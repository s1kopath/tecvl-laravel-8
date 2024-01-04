@if ($relates->count() > 0)
<section>
    <div class="container mx-auto px-4">
        <h2 class="font-bold text-gray-700 p-4 ">
            {{ __('Related Product') }}
        </h2>

        <div class="grid py-10 px-4 border grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 2xl:grid-cols-5 gap-x-3 md:gap-x-5 xl:gap-x-8 gap-y-5 lg:gap-y-5 xl:lg:gap-y-7 2xl:gap-y-8">
            @foreach ($relates as $item)
                @if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from))
                    @if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to))
                      @include('site.layouts.section.card-one')
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
