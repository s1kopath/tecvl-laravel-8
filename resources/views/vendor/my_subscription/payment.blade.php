@extends('vendor.layouts.app')
@section('page_title', __('My Subscription'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="payment-container">
  <div class="card">
    <div class="card-header">
        <h5><a href="#"></a>{{ __('My Subscription') }}</h5>
        <div class="card-header-right d-inline-block">
            <a href="{{ route('vendor.my_subscription.index') }}" class="btn btn-outline-primary font-bold custom-btn-small">{{ __('Back') }}</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row mt-3">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow-1 border-top">
                    <div class="card-header">
                        <h3 class="font-bold display-td pt-1" >{{ __('Payment Details') }}</h3>
                        <div class="display-td" >
                            <img class="img-responsive float-right" src="{{ asset('public/dist/img/stripe.png') }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                              <div class="panel panel-default credit-card-box">
                                <div class="panel-heading display-table" >
                                  <div class="row display-tr"></div>
                                </div>
                                <div class="panel-body">
                                  <div class="stripe-elements">
                                    <div class="row form-group error-alert" id="card-errors">
                                    </div>
                                    @switch(true)
                                        @case(isset($_REQUEST['renew']))
                                            <form action="{{ route('vendor.renew') }}" method="post" id="payment-form">
                                                <input type="hidden" name="stripeAmount" value="{{ $package_subscription->billing_price }}">
                                                <input type="hidden" name="package_subscription_id" value="{{ $package_subscription->id }}">
                                            @break
                                        @case(isset($_REQUEST['upgrade']))
                                        <form action="{{ route('vendor.my_subscription.subscription', ['id' => $package->id]) }}" method="post" id="payment-form">
                                            <input type="hidden" name="stripeAmount" value="{{ $package->price }}">
                                            @break
                                        @default

                                    @endswitch

                                      @csrf
                                      <div class="row pt-2">
                                        <div class="field">
                                          <div id="card-number" class="input empty"></div>
                                          <label for="card-number">{{ __('Card Number') }}</label>
                                          <div class="baseline"></div>
                                        </div>
                                      </div>
                                      <div class="row pt-2 pb-2">
                                        <div class="field half-width">
                                          <div id="card-expiry" class="input empty"></div>
                                          <label for="card-expiry">{{ __('Expiration') }}</label>
                                          <div class="baseline"></div>
                                        </div>
                                        <div class="field half-width">
                                          <div id="card-cvc" class="input empty"></div>
                                          <label for="card-cvc">{{ __('CVC') }}</label>
                                          <div class="baseline"></div>
                                        </div>
                                      </div>
                                      <div class="row pt-2">
                                        <button class="btn btn-primary btn-lg btn-block" id="stripe-submit-btn" type="submit">
                                           <i class="fa fa-spinner fa-spin display_none"></i>
                                           @switch(true)
                                            @case(isset($_REQUEST['renew']))
                                                <span id="stripe-submit-btn-text">{{ __('Pay Now') }} ({{ '$' . number_format((float)$package_subscription->billing_price, $digit['decimal_digits'], '.', '') }})</span>
                                                @break
                                            @case(isset($_REQUEST['upgrade']))
                                                <span id="stripe-submit-btn-text">{{ __('Pay Now') }} ({{ '$' . number_format((float)$package->price, $digit['decimal_digits'], '.', '') }})</span>
                                                @break
                                            @default

                                        @endswitch
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script>
        "use strict";
        var publishableKey = '{{ $publishableKey }}';
    </script>
    <script src="{{ url('https://js.stripe.com/v3/') }}"></script>
    <script src="{{ asset('public/dist/js/custom/payment.js') }}"></script>
@endsection

