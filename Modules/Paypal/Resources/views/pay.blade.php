@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="align-center">{{ __('Paying with Paypal') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form
            action="{{ route('gateway.complete', ['gateway' => config('paypal.alias'), 'key' => $purchaseData->code]) }}"
            method="post" id="payment-form">
            @csrf
            <button type="submit" class="sub-btn">
                <span> <i class="{{ config('paypal.fa_logo') }}"></i></span>{{ __('Pay With Paypal') }}
            </button>
        </form>
    </div>
@endsection
