@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="align-center">{{ __('Paying with Stripe') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form
            action="{{ route('gateway.complete', ['gateway' => config('stripe.alias'), 'key' => $purchaseData->code]) }}"
            method="post" id="payment-form">
            @csrf
            <div class="field full align-left">
                <label for="card-element">{{ __('Credit or debit card') }}</label>
                <div id="card-element">
                    <!-- a Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="card-errors"></div>
            </div>
            <button type="submit" class="sub-btn">
                <span> <i style="font-size:18px"
                        class="{{ config('stripe.fa_logo') }}"></i></span>{{ __('Pay With Stripe') }}
            </button>
        </form>
    </div>
@endsection



@section('css')
    <style>
        .StripeElement {
            background-color: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        .StripeElement {
            margin-top: 10px;
            box-sizing: border-box;
            box-shadow: 0 1px 3px 0 #40b3ff34 !important;
        }

        div#card-errors {
            color: red;
            font-size: 14px;
        }

    </style>
@endsection

@section('js')
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Your JS File -->
    <script>
        var stripe = Stripe('{{ $publishableKey }}');
        var elements = stripe.elements();
        // Custom Styling
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Send Stripe Token to Server
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            // Add Stripe Token to hidden input
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit form
            form.submit();
        }
    </script>
@endsection
