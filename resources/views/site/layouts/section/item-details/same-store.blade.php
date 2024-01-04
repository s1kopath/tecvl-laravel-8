<div>
    <div class="bg-gray-50">
        <p class="font-bold text-gray-700 p-4 border">{{ __('From The Same Store') }}</p>
    </div>
    @foreach ($sameShop as $item)
        <div class="my-3">
            @if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from))
                @if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to))
                  @include('site.layouts.section.card-one')
                @endif
            @endif
        </div>
    @endforeach
</div>
