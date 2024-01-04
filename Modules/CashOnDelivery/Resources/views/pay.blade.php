@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="align-center">{{ __('Cash On Delivery') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        @php
        $codResponse = \App\Models\Order::checkCashOnDelivery($purchaseData);
        @endphp
        @if($codResponse['status'] == true && $codResponse['notAvailable'] == false)
        <form action="{{ route('gateway.complete', ['gateway' => config('cashondelivery.alias'), 'key' => $purchaseData->code]) }}" method="post" id="payment-form">
            @csrf
            <div class="field full align-left">
                <div id="card-errors">
                    <span> {{ __('Are you sure?') }} </span>
                </div>
            </div>
            <button type="submit" class="sub-btn">
                <span> <i style="font-size:18px" class="{{ config('cashondelivery.fa_logo') }}"></i></span>{{ __('Confirm') }}
            </button>
        </form>
        @else
            <div class="field full align-left">
                <div id="card-errors">
                    <span> {{ __('Cash on delivery is not available for this order') }} </span>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('css')
@endsection
