@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="">{{ __('Paying with Instamojo') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form
            action="{{ route('gateway.complete', ['gateway' => config('instamojo.alias'), 'key' => $purchaseData->code]) }}"
            method="post" id="payment-form">
            @csrf
            <div class="field full align-left">
                <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                <input id="name" type="name" name="name" required placeholder="{{ __('Your name') }}">
            </div>
            <div class="field full align-left">
                <label for="email">{{ __('Email') }}<span class="text-red">*</span></label>
                <input id="email" type="email" name="email" required placeholder="example@mail.com">
            </div>
            <button type="submit" class="sub-btn">
                <span> <i class="{{ config('instamojo.fa_logo') }}"></i></span>{{ __('Pay With Instamojo') }}
            </button>
        </form>
    </div>
@endsection
