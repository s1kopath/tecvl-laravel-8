@extends('vendor.layouts.app')
@section('page_title', __('Pricing'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="my_subscription-container">
  <div class="card">
    <div class="card-header">
        <h5><a href="{{ route('vendor.my_subscription.pricing') }}"></a>{{ __('Pricing') }}</h5>
        <div class="card-header-right d-inline-block">
            <a href="{{ route('vendor.my_subscription.index') }}" class="btn btn-outline-primary font-bold custom-btn-small">{{ __('Back') }}</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row no-gutters">
            @if ($packages->count() > 0)
                <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-center p-4">
                        @foreach($packages as $key => $package)
                            <div class="border p-38 rounded shadow-1 text-center m-3 w-250 relative">
                                <img width="100" src="{{ asset('public/dist/img/package/package' . $increment++ . '.png') }}" alt="">
                                <h4 class="my-4 font-bold">{{ trimWords($package->name, 15) }}</h3>
                                <p class="mt-4 mb-120">{{ trimWords($package->description, 80) }}</p>
                                <div class="plan-price">
                                    <h3 class="mt-3 mb-1 font-bold text-light-black">{{ $package->price == 0 ? __('Free') : '$' . number_format((float)$package->price, $digit['decimal_digits'], '.', '') }}</h3>
                                    <p class="mb-4">{{ $package->billing_cycle }}</p>
                                    <form action="{{ route('vendor.my_subscription.subscription', ['id' => $package->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn-plan font-bold">{{ __('Select Plan') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12 p-3">
                    <h3 class="text-red text-center">{{ __('No package found') }}</h3>
                </div>
            @endif
        </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/shops.min.js') }}"></script>
@endsection

