@extends('vendor.layouts.app')
@section('page_title', __('View :x', ['x' => __('Invoice')]))
@section('content')

    <!-- Main content -->
    <div class="col-sm-12" id="vendor-invoice-view-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendorOrder.view', $order->id) }}">{{ __('Order') }} </a> >>{{ __('Invoice') }}</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    @if($order->payment_status == "Paid")
                        <div class="btn-paid">{{ $order->payment_status }}</div>
                    @else
                        <div class="btn-unpaid">{{ $order->payment_status }}</div>
                    @endif
                </div>
                <div class="btn-group float-right row mr-2 mt-1 pl-3">
                    @if (in_array('App\Http\Controllers\Vendor\VendorOrderController@invoicePrint', $prms))
                    <a target="_blank" href="{{ route('vendorInvoice.print', $order->id)  }}?type=pdf" title="PDF" class="btn custom-btn-small btn-outline-secondary">{{ __('PDF') }}</a>
                    <a target="_blank" href="{{ route('vendorInvoice.print', $order->id)  }}?type=print" title="PDF" class="btn custom-btn-small btn-outline-secondary">{{ __('Print') }}</a>
                    @endif
                </div>
            </div>
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
                                                            <td><a class="text-secondary" href="mailto:{{ $company_email }}" target="_top">{{ $company_email }}</a></td>
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
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="m-b-20">{{ __('Invoice Number') }} <span>#{{ $order->reference }}</span></h6>
                                                @if(!empty(optional($order->paymentMethod)->gateway))
                                                <h6 class="m-b-20">{{  __('Payment Method') }}: <span>{{ optional($order->paymentMethod)->gateway }}</span></h6>
                                                @endif
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
                                                @if(isset($order->address->email))
                                                    <p class="m-0">{{ __('Email') }}: {{ optional($order->address)->email }}</p>
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
                                                            @php $shop = true; $subTotal = 0;@endphp
                                                        @endif
                                                        <tr class="thead-default">
                                                            <th>{{ __('Product Name') }}</th>
                                                            @if($shop)
                                                                <th>{{ __('Shop Name') }}</th>
                                                            @endif
                                                            <th>{{ __('Quantity') }}</th>
                                                            <th>{{ __('Amount') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order->vendorOrderItem($vendorId, $order->id) as $detail)
                                                            @php
                                                                $opName = '';
                                                                if ($detail->payloads != null) {
                                                                     $option = json_decode($detail->payloads);
                                                                          $opName = implode(",", $option->option_name ?? null);
                                                                          $opName .= ": ".implode(",", $option->options ?? null);
                                                                    }
                                                                $subTotal += $detail->price * $detail->quantity;
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <h6> <a href="{{ route('site.itemDetails', ['code' => optional($detail->item)->item_code, 'name' => cleanedUrl($detail->item_name)]) }}">{{ $detail->item_name }} <br> {{ !empty($opName) ? "( ".$opName." )" : '' }}</a> </h6>
                                                                    <p>{{ $opName }} </p>
                                                                </td>
                                                                @if($shop)
                                                                    <td>{{ optional($detail->shop)->name }}</td>
                                                                @endif
                                                                <td>{{ formatCurrencyAmount($detail->quantity) }}</td>
                                                                <td>{{ formatNumber($detail->price * $detail->quantity, optional($order->currency)->symbol)  }}</td>
                                                                <td>
                                                                    @if(optional($detail->refund)->status != "Completed")
                                                                    <select class="status" name="status" data-id = "{{ $detail->id }}" {{ $detail->is_delivery == 1 ? 'disabled' : ''  }}>
                                                                        @foreach($orderStatus as $status)
                                                                            @if($order->is_delivery == 1)
                                                                                @if($status->id <=  $order->order_status_id)
                                                                                    <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }} {{ $status->vendorStatusPermission($status->id) ? '' : 'disabled' }}>{{ $status->name }}</option>
                                                                                @endif
                                                                            @elseif($detail->is_delivery == 1)
                                                                                @if($status->id <=  $detail->order_status_id)
                                                                                    <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }} {{ $status->vendorStatusPermission($status->id) ? '' : 'disabled' }}>{{ $status->name }}</option>
                                                                                @endif
                                                                            @else
                                                                                <option value="{{ $status->id }}" {{ $status->id == $detail->order_status_id ? 'selected' : '' }} {{ $status->vendorStatusPermission($status->id) ? '' : 'disabled' }}>{{ $status->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @else
                                                                        <span>{{ __('Refunded') }}</span>
                                                                    @endif
                                                                </td>
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
                                                        <td>{{ formatNumber($subTotal, optional($order->currency)->symbol)  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('Shipping') }} :</th>
                                                        <td>{{ formatNumber($detail->shipping_charge, optional($order->currency)->symbol) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('Tax') }} :</th>
                                                        <td>{{ formatNumber($detail->tax_charge, optional($order->currency)->symbol) }}</td>
                                                    </tr>
                                                    @if(($subTotal - $order->vendorItemPrice($vendorId, $order->id)) > 0 && isActive('Coupon'))
                                                        <tr>
                                                            <th>{{ __('Discount') }} :</th>
                                                            <td>{{ formatNumber($subTotal - $order->vendorItemPrice($vendorId, $order->id), optional($order->currency)->symbol) }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr />
                                                            <h5 class="text-primary m-r-10">{{ __('Total') }} :</h5>
                                                        </td>
                                                        <td>
                                                            <hr />
                                                            <h5 class="text-primary">{{ formatNumber($order->vendorItemPrice($vendorId, $order->id) + ($detail->tax_charge + $detail->shipping_charge), optional($order->currency)->symbol)  }}</h5>
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

@endsection

@section('js')
    <script>
        var paymentStatus = "{{ $order->payment_status }}";
        var finalOrderStatus = {{ $finalOrderStatus }}
    </script>
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/invoice.min.js') }}"></script>
@endsection
