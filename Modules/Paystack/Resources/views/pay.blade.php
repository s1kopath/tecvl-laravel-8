@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="">{{ __('Paying with Paystack') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form
            action="{{ route('gateway.complete', ['gateway' => config('paystack.alias'), 'key' => $purchaseData->code]) }}"
            method="post" id="payment-form">
            @csrf
            <div class="field full align-left">
                <label for="name">{{ __('Email') }}<span class="text-red">*</span></label>
                <input id="name" type="email" name="email" required placeholder="example@mail.com">
            </div>
            <button type="submit" class="sub-btn">
                <span> <i class="{{ config('paystack.fa_logo') }}"></i></span>{{ __('Pay With Paystack') }}
            </button>
        </form>
    </div>
@endsection
