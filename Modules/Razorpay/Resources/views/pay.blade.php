@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="text-center my-4 align-center">{{ __('Paying with Razorpay') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <button id="rzp-button1" type="submit" class="sub-btn">
            <span> <i class="fab fa-paypal"></i></span> {{ __('Pay with Razorpay') }}
        </button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <form name='razorpayform'
            action="{{ route('gateway.complete', ['gateway' => config('razorpay.alias'), 'key' => $purchaseData->code]) }}"
            method="POST">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        </form>
        <script>
            var options = {!! $data !!};

            options.handler = function(response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.razorpayform.submit();
            };
            options.modal = {
                ondismiss: function() {
                    console.log("This code runs when the popup is closed");
                },
                escape: true,
                backdropclose: false
            };

            var rzp = new Razorpay(options);

            document.getElementById('rzp-button1').onclick = function(e) {
                rzp.open();
                e.preventDefault();
            }
        </script>
    </div>
@endsection
