<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ __('Invoice') }}</title>
    <link rel="stylesheet" href="{{ asset('public/bootstrap/css/font-awesome.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/css/style.css?v=1.0') }}">
</head>
<body>
<!-- Main content -->
<div class="col-sm-12" id="invoice-view-container">
    <div class="card">
        <div class="col-sm-12 m-t-20 form-tabs">
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ Invoice ] start -->
                        <div class="container" id="printTable">
                            <div>
                                <div class="row invoice-contact">
                                    <div class="col-md-8">
                                        <div class="invoice-box row">
                                            <div class="col-sm-12">
                                                <table class="table table-responsive invoice-table table-borderless">
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $company_name }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $company_street }}, {{ $company_state }}, {{ $company_zipCode }}, {{ $company_city }}, {{ $company_country_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $company_email }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $company_phone }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="card-block">
                                    <div class="row invoive-info">
                                        <div class="col-md-6 col-xs-12 invoice-client-info">
                                            <h6>{{ __('Order Information') }} :</h6>
                                            <table class="table table-responsive invoice-table invoice-order table-borderless">
                                                <tbody>
                                                <tr>
                                                    <th>{{ __('Date') }} :</th>
                                                    <td>{{ formatDate($order->order_date) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Status') }} :</th>
                                                    <td>
                                                        {{ optional($order->orderStatus)->name }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <h6 class="m-b-20">{{ __('Invoice Number') }} <span>#{{ $order->reference }}</span></h6>
                                            @if(!empty(optional($order->paymentMethod)->gateway))
                                            <h6 class="m-b-20">{{  __('Payment Method') }}: <span>{{ optional($order->paymentMethod)->gateway }}</span></h6>
                                            @endif
                                            <h6 class="text-uppercase text-primary">{{ __('Total Due') }} :
                                                <span>{{ formatNumber($order->total - $order->paid, optional($order->currency)->symbol)  }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row invoive-info">
                                        <div class="col-md-6 col-xs-12 invoice-client-info">
                                            <h6>{{ __('Shipping Address') }} :</h6>
                                            <h6 class="m-0">{{ optional($order->address)->first_name." ".optional($order->address)->last_name }}</h6>
                                            <p class="m-0 m-t-10">{{ __('Street Address') }}: {{ optional($order->address)->address_1 }} {{ !empty(optional($order->address)->address_2) ? ", ".optional($order->address)->address_2 : '' }}</p>
                                            <p class="m-0 m-t-10">{{ __('City') }}: {{ optional($order->address)->city }}</p>
                                            <p class="m-0 m-t-10">{{ __('Postcode') . ' / ' . __('ZIP') }}: {{ optional($order->address)->zip }}</p>
                                            <p class="m-0 m-t-10">{{ __('Country') }}: {{ optional($order->address)->country }}</p>
                                            <p class="m-0 m-t-10">{{ __('State') . ' / ' . __('Province') }}: {{ optional($order->address)->state }}</p>
                                            @if(isset($order->address->phone))
                                            <p class="m-0">{{ __('Phone') }}: {{ optional($order->address)->phone }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-xs-12 invoice-client-info">
                                            <h6>{{ __('Billing Address') }} :</h6>
                                            <h6 class="m-0">{{ optional($order->user)->name }}</h6>
                                            <p class="m-0 m-t-10">{{ __('Email') }}: {{ optional($order->user)->email }}</p>
                                            <p class="m-0 m-t-10">{{ __('Phone') }}: {{ optional($order->user)->phone }}</p>
                                            <p class="m-0 m-t-10">{{ __('Address') }}: {{ optional($order->user)->address }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table  invoice-detail-table">
                                                    <thead>
                                                    @if(isActive('Shop'))
                                                    @php $shop = true; @endphp
                                                    @endif
                                                    <tr class="thead-default">
                                                        <th>{{ __('Product Name') }}</th>
                                                        @if($shop)
                                                        <th>{{ __('Shop Name') }}</th>
                                                        @endif
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orderDetails as $detail)
                                                    @php
                                                    $opName = '';
                                                    if ($detail->payloads != null) {
                                                    $option = json_decode($detail->payloads);
                                                    $opName = implode(",", $option->option_name ?? null);
                                                    $opName .= ": ".implode(",", $option->options ?? null);
                                                    }
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <h6> {{ $detail->item_name }} <br> {{ !empty($opName) ? "( " . $opName." )" : '' }} </h6>
                                                            <p>{{ $opName }} </p>
                                                        </td>
                                                        @if($shop)
                                                        <td>{{ optional($detail->shop)->name }}</td>
                                                        @endif
                                                        <td>{{ formatCurrencyAmount($detail->quantity) }}</td>
                                                        <td>{{ formatNumber($detail->price * $detail->quantity, optional($order->currency)->symbol)  }}</td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-responsive invoice-table invoice-total">
                                                <tbody>
                                                <tr>
                                                    <th>{{ __('Sub Total') }} :</th>
                                                    <td>{{ formatNumber(($order->total + $order->other_discount_amount) - ($order->shipping_charge + $order->tax_charge), optional($order->currency)->symbol)  }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Shipping') }} :</th>
                                                    <td>{{ formatNumber($order->shipping_charge, optional($order->currency)->symbol) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Tax') }} :</th>
                                                    <td>{{ formatNumber($order->tax_charge, optional($order->currency)->symbol) }}</td>
                                                </tr>
                                                @if($order->other_discount_amount > 0 && isActive('Coupon'))
                                                <tr>
                                                    <th>{{ __('Discount') }} :</th>
                                                    <td>{{ formatNumber($order->other_discount_amount, optional($order->currency)->symbol) }}</td>
                                                </tr>
                                                @endif
                                                <tr class="text-info">
                                                    <td>
                                                        <hr />
                                                        <h5 class="text-primary m-r-10">{{ __('Total') }} :</h5>
                                                    </td>
                                                    <td>
                                                        <hr />
                                                        <h5 class="text-primary">{{ formatNumber($order->total, optional($order->currency)->symbol) }}</h5>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if(!empty($order->note))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6>{{ __('Note') }} :</h6>
                                            <p>{{ $order->note }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- [ Invoice ] end -->
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@if($type == 'print')
<script>
    window.onload = function() { window.print(); }
</script>
@endif

