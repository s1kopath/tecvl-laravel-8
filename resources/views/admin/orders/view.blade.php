@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Invoice')]))
@section('css')
    <!-- date range picker css -->
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <div class="col-sm-12 order-details-container" id="invoice-view-container">
        <div>
            <div class="card card-width">
                <div class="card-header">
                    <div class="d-flex flex-md-row flex-column justify-content-md-between">
                        <h6 class="order-details-text text-uppercase"> <a href="{{ route('order.view', $order->id) }}">{{ __('Order') }} </a> {{ __('Details') }}</h6>
                        <div>
                            <span class="order-number">{{ __('Reference') }}</span>
                            <h6 class="order-reference"><span>#{{ $order->reference }}</span></h6>
                        </div>
                    </div>
                    <div class="order-details-body">
                        <div>
                            <div class="status-dropdown col-md-3 mb-4">
                                <p>{{ __('Payment Status') }}</p>
                                <select class="form-control select2" name="payment_status" id="payment_status">
                                    <option value="Paid" {{ $order->payment_status == "Paid" ? "selected" : '' }}>{{ __('Paid') }}</option>
                                    <option value="Unpaid" {{ $order->payment_status == "Unpaid" ? "selected" : '' }}>{{ __('Unpaid') }}</option>
                                </select>
                            </div>

                            @if(optional($order->paymentMethod)->gateway != null)
                                <p class="payment-method">{{ __('Payment Method') }} <span class="order-detail-payment-gap">:</span> <span class="payment-type">{{ optional($order->paymentMethod)->gateway }}</span></p>
                            @endif
                            @if($order->paid > 0 && !empty(optional($order->transaction)->transaction_date))
                                <p class="paid-on">{{ __('Paid On') }} <span class="order-detail-paid-gap">:</span> <span class="payment-date">{{ formatDate(optional($order->transaction)->transaction_date) }}</span> @if(!empty($order->TransactionId($order->id)))<a href="{{ route('transaction.edit', $order->TransactionId($order->id)) }}">({{ __('View Transaction') }})</a>@endif</p>
                            @endif

                            <div class="d-md-flex gbs-section">
                                <div class="general-section">
                                    <p class="text-uppercase general">{{ __('General') }}</p>
                                    <div>
                                        <span class="date-created">{{ __('Order Date') }}</span>

                                        <br>
                                        <div class="d-flex date-summary">
                                            <input class="input-date" id="orderDate" value='{{ $order->order_date }}' type="text">
                                        </div>
                                        <div class="status-dropdown">
                                            <p>{{ __('Status') }}</p>
                                            <select class="form-control select2" name="status" id="status">
                                                @foreach($orderStatus as $status)
                                                    @if($order->is_delivery == 1)
                                                        @if($status->id <= $order->order_status_id)
                                                          <option value="{{ $status->id }}" {{ $order->order_status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $status->id }}" {{ $order->order_status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="customer-dropdown">
                                            <p>{{ __('Customers') }}</p>
                                            <select class="form-control select2" name="user_id" id="user_id">
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ $customer->id == $order->user_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="billing-section text-uppercase">
                                    <div class="billing-icon-container">
                                        <p class="billing">{{ __('Billing Address') }}</p>
                                        <span class="billing-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                                <path d="M10.0988 0.0437536C9.97574 0.0656281 9.77066 0.117581 9.64468 0.164065C9.13492 0.347269 9.30191 0.202347 5.58707 3.66406C3.59195 5.5207 2.09195 6.93985 2.0275 7.02735C1.9689 7.10938 1.8898 7.2461 1.85464 7.33359C1.81656 7.41836 1.65249 8.07734 1.49136 8.79649C1.14859 10.3031 1.13101 10.4617 1.26578 10.8172C1.3566 11.0551 1.5148 11.2848 1.69351 11.4324C1.9396 11.6348 2.36441 11.7852 2.68375 11.7852C2.79507 11.7852 5.30289 11.334 5.73355 11.2355C5.81265 11.2164 5.97378 11.159 6.0939 11.107C6.3107 11.0113 6.37515 10.9539 9.77652 7.78203C13.4269 4.375 13.4035 4.39961 13.588 3.98399C13.7199 3.68047 13.7726 3.44805 13.7902 3.08985C13.8136 2.5293 13.673 2.03985 13.3507 1.59414C13.1427 1.30157 12.258 0.478518 12.0119 0.347269C11.4435 0.0437536 10.7521 -0.0656214 10.0988 0.0437536ZM10.799 1.42461C11.1007 1.47657 11.2648 1.58047 11.7248 2.01797C12.1847 2.45547 12.2755 2.58672 12.3341 2.89024C12.3722 3.10078 12.3166 3.39063 12.1964 3.5793C12.1496 3.65586 10.8166 4.92735 8.78629 6.83594L5.4523 9.9668L4.07242 10.1828C3.31656 10.3031 2.6896 10.3934 2.68375 10.3879C2.67789 10.3824 2.79507 9.8 2.94449 9.09727L3.21402 7.81484L6.53629 4.71406C9.44547 1.9961 9.87906 1.60235 10.0343 1.53125C10.3068 1.40274 10.5119 1.37539 10.799 1.42461Z" fill="#898989"/>
                                                <path d="M1.64571 12.6948C1.19746 12.8479 1.05684 13.4221 1.38496 13.7721C1.43184 13.8241 1.52852 13.8924 1.59297 13.9252L1.71309 13.9854L7.38204 13.9936C13.6926 13.9991 13.2443 14.0127 13.4816 13.8131C13.549 13.7584 13.6252 13.6627 13.6545 13.6026C13.719 13.4713 13.7277 13.2143 13.6691 13.0858C13.6076 12.9463 13.4465 12.7932 13.2854 12.7248L13.1389 12.6592L7.44063 12.662C3.13106 12.662 1.71895 12.6702 1.64571 12.6948Z" fill="#898989"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="billing-information-container">
                                        <div>
                                            <span class="billing-information text-capitalize">{{ optional($order->user)->name }}</span>
                                            <span class="billing-information text-capitalize">{{ optional($order->user)->address }}</span>
                                        </div>
                                        <p class="email billing-information text-capitalize">{{ __('Email') }}: <span class="text-lowercase">{{ optional($order->user)->email }}</span></p>
                                        <p class="billing-information text-capitalize phone"> {{ __('Phone') }}: <span>{{ optional($order->user)->phone }}</span></p>
                                    </div>
                                </div>
                                <div class="shipping-section">
                                    <div class="shipping-icon-container">
                                        <p class="shipping">{{ __('Shipping Address') }}</p>
                                        <span class="shipping-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                                <path d="M10.0988 0.0437536C9.97574 0.0656281 9.77066 0.117581 9.64468 0.164065C9.13492 0.347269 9.30191 0.202347 5.58707 3.66406C3.59195 5.5207 2.09195 6.93985 2.0275 7.02735C1.9689 7.10938 1.8898 7.2461 1.85464 7.33359C1.81656 7.41836 1.65249 8.07734 1.49136 8.79649C1.14859 10.3031 1.13101 10.4617 1.26578 10.8172C1.3566 11.0551 1.5148 11.2848 1.69351 11.4324C1.9396 11.6348 2.36441 11.7852 2.68375 11.7852C2.79507 11.7852 5.30289 11.334 5.73355 11.2355C5.81265 11.2164 5.97378 11.159 6.0939 11.107C6.3107 11.0113 6.37515 10.9539 9.77652 7.78203C13.4269 4.375 13.4035 4.39961 13.588 3.98399C13.7199 3.68047 13.7726 3.44805 13.7902 3.08985C13.8136 2.5293 13.673 2.03985 13.3507 1.59414C13.1427 1.30157 12.258 0.478518 12.0119 0.347269C11.4435 0.0437536 10.7521 -0.0656214 10.0988 0.0437536ZM10.799 1.42461C11.1007 1.47657 11.2648 1.58047 11.7248 2.01797C12.1847 2.45547 12.2755 2.58672 12.3341 2.89024C12.3722 3.10078 12.3166 3.39063 12.1964 3.5793C12.1496 3.65586 10.8166 4.92735 8.78629 6.83594L5.4523 9.9668L4.07242 10.1828C3.31656 10.3031 2.6896 10.3934 2.68375 10.3879C2.67789 10.3824 2.79507 9.8 2.94449 9.09727L3.21402 7.81484L6.53629 4.71406C9.44547 1.9961 9.87906 1.60235 10.0343 1.53125C10.3068 1.40274 10.5119 1.37539 10.799 1.42461Z" fill="#898989"/>
                                                <path d="M1.64571 12.6948C1.19746 12.8479 1.05684 13.4221 1.38496 13.7721C1.43184 13.8241 1.52852 13.8924 1.59297 13.9252L1.71309 13.9854L7.38204 13.9936C13.6926 13.9991 13.2443 14.0127 13.4816 13.8131C13.549 13.7584 13.6252 13.6627 13.6545 13.6026C13.719 13.4713 13.7277 13.2143 13.6691 13.0858C13.6076 12.9463 13.4465 12.7932 13.2854 12.7248L13.1389 12.6592L7.44063 12.662C3.13106 12.662 1.71895 12.6702 1.64571 12.6948Z" fill="#898989"/>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="billing-information-container">
                                        <p class="billing-information"> {{ __('Name') }}: <span> {{ optional($order->address)->first_name." ".optional($order->address)->last_name }} </span> </p>
                                        <p class="billing-information"> {{ __('Phone') }}: <span> {{ optional($order->address)->phone }} </span> </p>
                                        <p class="billing-information"> {{ __('Address') }}: <span> {{ optional($order->address)->address_1 }} {{ !empty(optional($order->address)->address_2) ? ", ".optional($order->address)->address_2 : '' }}, {{ optional($order->address)->city }} </span> </p>
                                        <p class="billing-information"> {{ __('Postcode') . "/" . __('ZIP') }}: <span> {{ optional($order->address)->zip }} </span> </p>
                                        <p class="billing-information"> {{ __('Country') }}: <span> {{ optional($order->address)->country }} </span> </p>
                                        <p class="billing-information"> {{ __('Email') }}: <span> {{ optional($order->address)->email }} </span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-width">
                <div class="col-sm-12 form-tabs">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="row">
                                <div class="container" id="printTable">
                                    <div>
                                        <div class="">
                                            <div class="row order-info-table-container">
                                                <div class="col-sm-12 order-info-table">
                                                    <div class="table-responsive order-details-table-responsive">
                                                        <table class="table invoice-detail-table">
                                                            <thead>
                                                                @if(isActive('Shop'))
                                                                    @php $shop = true; @endphp
                                                                @endif
                                                                <tr class="thead-default order-info-thead">
                                                                    <th>{{__('')}}</th>
                                                                    <th>{{ __('Items') }}</th>
                                                                    <th>{{ __('SKU') }}</th>
                                                                    <th>{{ __('Status') }}</th>
                                                                    <th>{{ __('Cost') }}</th>
                                                                    <th>{{ __('Qty') }}</th>
                                                                    <th>{{ __('Total') }}</th>
                                                                    <th>{{ __('Refund') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach($orderDetails as $details)
                                                                    @if(isset($details[0]->shop->name) && isActive('Shop'))
                                                                        <tr>
                                                                            <td colspan="5">{{ $details[0]->shop->name }}</td>
                                                                        </tr>
                                                                    @elseif(isset($details[0]->vendor->name))
                                                                        <tr>
                                                                            <td colspan="5">{{ $details[0]->vendor->name }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @foreach($details as $detail)
                                                                        @php
                                                                            if (isActive('Refund')) {
                                                                            $orderDeliverId = $detail->orderStatus->where('order_by', $detail->orderStatus->max('order_by'))->first()->id;
                                                                            }

                                                                            $opName = '';
                                                                            if ($detail->payloads != null) {
                                                                                $option = json_decode($detail->payloads);
                                                                                $itemCount = count($option->option_name);
                                                                                $i = 0;
                                                                                foreach ($option->option_name as $key => $value) {
                                                                                    $opName .= $value . ': ' . $option->options[$key] . (++$i == $itemCount ? '' : ', ');
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="order-itm-img-con">
                                                                                        <img src="{{$detail->item->fileUrl()}}" alt="">
                                                                                    </div>
                                                                                    <div class="order-item-name-attribute">
                                                                                        <h6>
                                                                                            <a class="order-item-name" href="{{ route('site.itemDetails', ['code' => optional($detail->item)->item_code, 'name' => cleanedUrl($detail->item_name)]) }}" title="{{ $detail->item_name }}">
                                                                                                {{trimWords($detail->item_name, 25)  }}
                                                                                                <br>
                                                                                            </a>
                                                                                        </h6>
                                                                                        <p class="order-item-attr">{{ $opName }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span title="{{ optional($detail->item)->sku }}">{{ trimWords(optional($detail->item)->sku, 15) }}</span>
                                                                            </td>
                                                                            <td>
                                                                                @if (optional($detail->refund)->status != "Completed")
                                                                                    <select class="form-control status order-status" name="status" data-id = "{{ $detail->id }}">
                                                                                        @foreach($orderStatus as $status)
                                                                                            @if ($order->is_delivery == 1)
                                                                                                @if ($status->id <= $order->order_status_id)
                                                                                                    <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                                                                @endif
                                                                                            @elseif ($detail->is_delivery == 1)
                                                                                                @if ($status->id <= $detail->order_status_id)
                                                                                                    <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                                                                @endif
                                                                                            @else
                                                                                                <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                @else
                                                                                    <span>{{ __('Refunded') }}</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ formatCurrencyAmount($detail->price) }}</td>
                                                                            <td>
                                                                                <span class="order-q-icon">x</span>
                                                                                {{floor(formatCurrencyAmount($detail->quantity)) }}
                                                                            </td>
                                                                            <td>{{ formatNumber($detail->price * $detail->quantity, optional($order->currency)->symbol) }}</td>
                                                                            @if (isActive('Refund'))
                                                                                <td>
                                                                                    @if ($detail->is_delivery == 1 && auth()->user()->refunds()->where('order_detail_id', $detail->id)->count() == 0)
                                                                                        <a href="javascript:void(0)" id="refundApply" data-detailId = "{{ $detail->id }}" data-qty = {{ $detail->quantity }}><span>{{ __('Apply') }}</span></a>
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 invoice-table-container">
                                                    <table class="table table-responsive invoice-table invoice-total invoice-total-customize">
                                                        <tbody>
                                                            <tr>
                                                                <th>{{ __('Sub Total') }} :</th>
                                                                <td>{{ formatNumber(($order->total + $order->other_discount_amount) - ($order->shipping_charge + $order->tax_charge), optional($order->currency)->symbol) }}</td>
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
                                                                    <h5 class="order-grand-total">{{ __('Grand Total') }} :</h5>
                                                                </td>
                                                                <td>
                                                                    <hr />
                                                                    <h5 class="order-grand-currency">{{ formatNumber($order->total, optional($order->currency)->symbol) }}</h5>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
            <div class="card card-width">
                <div class="product-permissions-header accordion cursor_pointer">
                    <span>Downloadable Product Permission</span>
                    <span class="drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 10" fill="none">
                            <path d="M6.80496 9.84648L12.7031 2.23935C13.3926 1.35009 12.8043 -9.56008e-07 11.7273 -9.68852e-07L1.27274 -1.09352e-06C0.195723 -1.10636e-06 -0.39263 1.35009 0.296859 2.23935L6.19504 9.84648C6.35375 10.0512 6.64626 10.0512 6.80496 9.84648Z" fill="white"/>
                            </svg>
                    </span>
                </div>
                <div class="product-permissions-body">
                    <div class="d-flex">
                        <input placeholder="Search for a downloadable product.." type="text">
                        <button class="grant-access">Grant Access</button>
                    </div>
                </div>
            </div>
            <div class="card card-width">
               <div class="shipment-header accordion cursor_pointer">
                   <span>Shipments</span>
                   <span class="drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 10" fill="none">
                            <path d="M6.80496 9.84648L12.7031 2.23935C13.3926 1.35009 12.8043 -9.56008e-07 11.7273 -9.68852e-07L1.27274 -1.09352e-06C0.195723 -1.10636e-06 -0.39263 1.35009 0.296859 2.23935L6.19504 9.84648C6.35375 10.0512 6.64626 10.0512 6.80496 9.84648Z" fill="white"/>
                            </svg>
                    </span>
               </div>
               <div class="shipment-body">
                   <span>No shipment added for this product</span>
               </div>
            </div>
        </div>
        <div class="order-actions-container">
            <div class="card">
                <div class="order-sections-header accordion cursor_pointer">
                    <span>{{ __('Order') }} {{ __('Actions') }}</span>
                    <span class="order-icon drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                        </svg>
                    </span>
                </div>
                <div class="order-sections-body">
                    <select class="form-control select2" name="order_action" id="orderAction">
                        <option value="" selected="">{{ __('Choose an action..') }}</option>
                        <option value="1">{{ __('Email invoice / order details to customer') }}</option>
                        <option value="3">{{ __('Resend Order Email (Vendor)') }}</option>
                    </select>
                    <div class="trash-update">
                        <button id="order_action_btn">{{ __('Update') }}</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="order-sections-header accordion cursor_pointer">
                    <span>{{ __('Delivery Time') }}</span>
                    <span class="order-icon drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                        </svg>
                    </span>
                </div>
                @php
                    $orderDeliverId = $detail->orderStatus->where('order_by', $detail->orderStatus->max('order_by'))->first()->id;
                    $deliveryDate = $order->deliveryDate($order->id, $orderDeliverId);
                @endphp
                <div class="order-delivery-sections-body">
                    <div>
                        <p class="store-location-container"> <span class="store-location">Store location:</span> (Default) 34K, Rich Villa Council, Gulistan Hawkers, Dhaka, Bangladesh.</p>
                    </div>
                    @if(!empty($deliveryDate))
                    <div>
                        <span class="order-date-text">{{ __('Delivery date') }}</span>
                        <input id="deliveryDate" type="text" class="form-control" value="{{ $deliveryDate }}">
                        <br>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="order-sections-header accordion cursor_pointer">
                    <span>{{ __('Status history') }}</span>
                    <span class="order-icon drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                        </svg>
                    </span>
                </div>
                <div class="order-sections-body">
                    @if(count($orderStatusHistories) > 0)
                        @foreach($orderStatusHistories->groupBy('item_id') as $item_id => $histories)
                            <div class="card">
                                <div class="order-sections-header accordion cursor_pointer">
                                    <span class="text-dark">{{ trimWords($histories->first()->item->name, 25) }}</span>
                                    <span class="order-icon drop-down-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="order-sections-body">
                                    @foreach($histories as $history)
                                        <div class="order-notes">
                                            <span class="underline cursor_default">{{ __('Order status changed to :x by :y', ['x' => optional($history->orderStatus)->name, 'y' => optional($history->user)->name ?? __('Automatic')]) }} .</span>
                                        </div>
                                        <div class="date-delete-container mb-3">
                                            <span class="date underline cursor_default">{{ $history->format_created_at }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="order-sections-header accordion cursor_pointer">
                    <span>{{ __('Note history') }}</span>
                    <span class="order-icon drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                        </svg>
                    </span>
                </div>
                <div class="order-sections-body order-notes-container">
                    <div class="notes">
                        @if(count($orderNotes) > 0)
                            @foreach($orderNotes as $history)
                                <div class="order-notes">
                                    <span>{{ $history->note }}</span>
                                </div>
                                <div class="date-delete-container">
                                    <span class="date">{{ $history->format_created_at }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="add-note-container">
                        <div class="add-note">
                            <span class="add-note-text">{{ __('Note') }}</span>
                            <span class="add-note-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6ZM6.66667 10C6.66667 10.3682 6.36819 10.6667 6 10.6667C5.63181 10.6667 5.33333 10.3682 5.33333 10C5.33333 9.63181 5.63181 9.33333 6 9.33333C6.36819 9.33333 6.66667 9.63181 6.66667 10ZM6 1.33333C4.52724 1.33333 3.33333 2.52724 3.33333 4H4.66667C4.66667 3.26362 5.26362 2.66667 6 2.66667H6.06287C6.76453 2.66667 7.33333 3.23547 7.33333 3.93713V4.27924C7.33333 4.62178 7.11414 4.92589 6.78918 5.03421C5.91976 5.32402 5.33333 6.13765 5.33333 7.05409V8.66667H6.66667V7.05409C6.66667 6.71155 6.88586 6.40744 7.21082 6.29912C8.08024 6.00932 8.66667 5.19569 8.66667 4.27924V3.93713C8.66667 2.49909 7.50091 1.33333 6.06287 1.33333H6Z" fill="#898989"/>
                                </svg>
                            </span>
                        </div>
                        <div class="add-note-text-field">
                            <textarea name="order_note" id="order_note" cols="45" rows="3"></textarea>
                            <div class="trash-update">
                                <button id="updateNote">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="order-sections-header accordion cursor_pointer">
                    <span>{{ __('Create PDF') }}</span>
                    <span class="order-icon drop-down-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="5" viewBox="0 0 7 5" fill="none">
                            <path d="M3.33579 4.92324L0.159846 1.11968C-0.211416 0.675046 0.105388 -4.81444e-07 0.685319 -5.06793e-07L6.31468 -7.52861e-07C6.89461 -7.7821e-07 7.21142 0.675045 6.84015 1.11968L3.66421 4.92324C3.57875 5.02559 3.42125 5.02559 3.33579 4.92324Z" fill="#2C2C2C"/>
                        </svg>
                    </span>
                </div>
                <div class="order-pdf-btn">
                    <a href="{{ route('invoice.print', $order->id) }}?type=pdf"><button class="pdf-inv-btn">{{ __('PDF Invoice') }}</button></a>
                </div>
            </div>
        </div>

        <div id="refund-store" class="modal fade display_none" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Refund') }} &nbsp; </h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('site.orderRefund') }}" method="post" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="quantity_sent" id="quantity_sent" value="1">
                            <input type="hidden" name="order_detail_id" id="order_detail_id">
                            <input type="hidden" name="type" value="admin">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="inputEmail3">{{ __('Quantity') }}</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <a href="javascript:void(0)" class="text-center form-control col-sm-2" id="refundQtyDec"><span class="inline-block">-</span></a>
                                        <div class="form-control col-sm-2" id="refundQty">1</div>
                                        <a href="javascript:void(0)" class="text-center form-control col-sm-2" id="refundQtyInc"><span class="inline-block">+</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label pr-0" for="inputEmail3">{{ __('Reason') }}</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2" name="refund_reason_id">
                                        @foreach ($refundReasons as $reason)
                                            <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label pr-0" for="is_default"></label>
                                <div class="col-sm-6">
                                    <textarea name="comment" class="form-control" placeholder="{{ __('Please let me know, why are you want to refund this item.') }}" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="btn_save" class="col-sm-3 control-label"></label>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                    <button type="button" class="btn btn-secondary custom-btn-small float-right" data-dismiss="modal">{{ __('Close') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var orderId = {{ $order->id }};
        var paymentStatus = "{{ $order->payment_status }}";
        var finalOrderStatus = {{ $finalOrderStatus }}
    </script>
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/common.min.js') }}"></script>
    <!-- select2 JS -->
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date range picker Js -->
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/invoice.min.js') }}"></script>
@endsection
