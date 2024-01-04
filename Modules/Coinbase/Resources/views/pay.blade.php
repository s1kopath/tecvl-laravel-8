@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="text-center my-4 align-center">{{ __('Paying with Coinbase') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form name='razorpayform'
            action="{{ route('gateway.complete', ['gateway' => config('coinbase.alias'), 'key' => $purchaseData->code]) }}"
            method="POST">
            @csrf
            <button type="submit" class="sub-btn">
                <span> <i class="{{ config('coinbase.fa_logo') }}"></i></span>{{ __('Pay With Coinbase') }}
            </button>
        </form>
    </div>
@endsection
