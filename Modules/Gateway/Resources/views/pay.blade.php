@extends('gateway::layouts.master')

@section('content')
    @include('gateway::partial.errors')

    <h4 class="choose-payment">{{ __('Choose payment method below') }}</h4>
    <div class="types payment-select">
        @forelse ($gateways as $gateway)
            <a href="{{ route('gateway.pay', ['gateway' => $gateway->alias, 'key' => $purchaseData->code]) }}"
                class="type">
                <div class="logo">
                    <i class="{{ config($gateway->alias . '.fa_logo') }}"></i>
                </div>
                <div class="text">
                    <p>{{ __('Pay with :name', ['name' => $gateway->name]) }}</p>
                </div>
            </a>

        @empty
            <div class="type" style="width: 100%">
                {{ __('No payment gateways found.') }}
            </div>
        @endforelse
    </div>
@endsection

@section('css')
@endsection
