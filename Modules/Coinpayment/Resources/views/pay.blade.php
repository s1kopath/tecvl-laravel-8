@extends('gateway::layouts.payment')

@section('content')
    <div class="col-md-12">
        <h2 class="">{{ __('Paying with CoinPayment') }}</h2>
        @include('gateway::partial.instruction')
    </div>
    <div class="col-md-12 p-4 payment-box align-center mt-2">
        <form
            action="{{ route('gateway.complete', ['gateway' => config('coinpayment.alias'), 'key' => $purchaseData->code]) }}"
            method="post" id="payment-form">
            @csrf
            <div class="field full align-left">
                <label for="name">{{ __('Email') }}<span class="text-red">*</span></label>
                <input id="name" type="email" name="email" required placeholder="example@mail.com">
            </div>
            <div class="field full align-left">
                <label for="name">{{ __('Select currency you want to pay:') }}<span class="text-red">*</span></label>
                <select name="currency">
                    @foreach ($coinpayment->currencies as $currency)
                        <option value="{{ $currency }}">{{ $currency }}</option>
                    @endforeach
                </select>
            </div>
            @if (count($currencies) > 0)
                <div class="field full table">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Currency') }}</th>
                                <th>{{ __('Rate') }}</th>
                                <th>{{ __('CP Trx Fee') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $name => $detail)
                                <tr>
                                    <td><img src="{{ $detail['image'] }}" alt="{{ $name }}"></td>
                                    <td>{{ $name }}</td>
                                    <td>{{ $detail['rate_btc'] }}</td>
                                    <td>{{ $detail['tx_fee'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <small>{{ __('Note: These are the latest data from CoinPayment') }}</small>
                </div>
            @endif
            <button type="submit" class="sub-btn">
                <span> <i class="{{ config('coinpayment.fa_logo') }}"></i></span>{{ __('Pay With CoinPayment') }}
            </button>
        </form>
    </div>
@endsection

@section('css')
    <style>
        table {
            width: 100%;
        }

        td img {
            max-width: 60px;
            max-height: 60px;
        }

        table {
            overflow-x: scroll;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #c7def4;
            padding: 5px 15px;
        }

        small {
            display: block;
            text-align: left;
            padding: 10px 0;
        }

        @media screen and (max-width: 992px) {
            .table {
                overflow-x: scroll;
            }
        }

    </style>
@endsection
