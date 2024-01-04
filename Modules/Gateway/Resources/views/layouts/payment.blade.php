<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://kit.fontawesome.com/86a46842c3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('Modules\Gateway\Resources\assets\css\gateway.css') }}">
    @yield('css')
</head>

<body>
    <div class="payment-card payment-form">
        <div class="container">
            <div class="card-logo">
                <img id="img" src="{{ config('gateway.logo') }}" alt="logo">
            </div>
            <div class="payment-form-height">
                <div class="card-body">
                    <div class="payment-amount">
                        <p>{{ __('Amount:') }} <span>{{ $purchaseData->total }}</span></p>
                        <p>{{ __('Currency:') }} <span>{{ $purchaseData->currency_code }}</span></p>
                    </div>
                    @yield('content')
                </div>


            </div>
            <div class="card-actions">
                <button onclick="history.back()" class="button button-secondary">{{ __('Return') }}</button>
            </div>
        </div>

    </div>
    <script src="{{ asset('Modules\Gateway\Resources\assets\js\app.js') }}" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
