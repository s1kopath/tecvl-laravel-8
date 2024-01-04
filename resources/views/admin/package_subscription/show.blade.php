@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Package Subscription')]))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="package-subscription-show-container">
    <div class="card">
        <div class="card-header">
            <h5> <a href="{{ route('packageSubscription.index') }}">{{ __('View :x', ['x' => __('Package Subscription')]) }}</a> </h5>
            <div class="card-header-right d-inline-block">
                <a href="{{ route('packageSubscription.index') }}" class="btn btn-outline-primary custom-btn-small">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h6>{{ __('Billing') }}</h6>
                    <p class="m-0">{{ wrapIt($subscription->billing_name) }}</p>
                    <p class="m-0">{{ wrapIt($subscription->billing_email, 20) }}</p>
                    <p class="m-0">{{ wrapIt($subscription->billing_phone, 12) }}</p>
                </div>
                <div class="col-sm-4">
                    <h6>{{ __('Address') }}</h6>
                    <p class="m-0">{{ wrapIt($subscription->billing_country, 10) }}</p>
                    <p class="m-0">{{ wrapIt($subscription->billing_state, 10) }}</p>
                    <p class="m-0">{{ wrapIt($subscription->billing_city, 10) . (!empty($subscription->billing_city) ? ', ' : '') . wrapIt($subscription->billing_zip, 5) }}</p>
                </div>
                <div class="col-sm-4">
                    <h6>{{ __('Amount') }}</h6>
                    <p class="m-0">{{ __('Billed') . ': ' . number_format((float)$subscription->amount_billed, $digit['decimal_digits'], '.', '') }}</p>
                    <p class="m-0">{{ __('Received') . ': ' . number_format((float)$subscription->amount_received, $digit['decimal_digits'], '.', '') }}</p>
                    <p class="m-0">{{ __('Due') . ': ' . number_format((float)$subscription->amount_due, $digit['decimal_digits'], '.', '') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="px-0">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Transaction') }}</h5>
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Transaction Order No') }}</h6>
                    <p class="mb-0 mr-3">{{ wrapIt($subscription->transaction_order_number, 30) }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Transaction Invoice Id') }}</h6>
                    <p class="mb-0 mr-3">{{ wrapIt($subscription->transaction_invoice_id, 30) }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Transaction Reference') }}</h6>
                    <p class="mb-0 mr-3">{{ wrapIt($subscription->transaction_reference, 30) }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Customized') }}</h6>
                    <p class="mb-0 mr-3">{{ $subscription->is_customized == 1 ? __('Yes') : __('No') }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Customized Record') }}</h6>
                    <p class="mb-0 mr-3">{{ wrapIt($subscription->customized_records, 10) }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Renewed') }}</h6>
                    <p class="mb-0 mr-3">{{ $subscription->is_renewed == 1 ? __('Yes') : __('No') }}</p>
                </div>
                <hr class="m-0">
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Status') }}</h6>
                    <p class="mb-0 mr-3">{{ ucfirst($subscription->status) }}</p>
                </div>
                <hr class="m-0">
            </div>
        </div>
    </div>

</div>
<div class="col-sm-6">
    <div class="px-0">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Subscription Information') }}</h5>
                <div class="card-header-right">
                    <h4 class="mt-2 mr-3 text-primary">{{ timeZoneformatDate($subscription->created_at) }}</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Name') }}</h6>
                    <p class="mb-0 mr-3 font-bold text-dark">{{ wrapIt($subscription->name, 10) }}</p>
                </div>
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Vendor Name') }}</h6>
                    <p class="mb-0 mr-3 font-bold text-dark">{{ isset($subscription->vendor->name) ? wrapIt($subscription->vendor->name, 10) : '' }}</p>
                </div>
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Package Name') }}</h6>
                    <p class="mb-0 mr-3 font-bold text-dark">{{ isset($subscription->package->name) ? wrapIt($subscription->package->name, 10) : '' }}</p>
                </div>
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Payment Processor') }}</h6>
                    <p class="mb-0 mr-3 font-bold text-dark">{{ isset($subscription->payment_processor) ? $subscription->payment_processor : '' }}</p>
                </div>
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Billing Cycle') }}</h6>
                    <p class="mb-0 mr-3 font-bold text-dark">{{ isset($subscription->billing_cycle) ? $subscription->billing_cycle : '' }}</p>
                </div>
                <hr class="m-0">
                <hr class="m-0">
            </div>

            <div class="card-body p-0">
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Activation Date') }}</h6>
                    <p class="mb-0 mr-3 h6 font-bold text-dark"> <i class="feather icon-clock"></i> {{ timeZoneformatDate($subscription->activation_date) }}</p>
                </div>
                <div class="card-block d-flex justify-content-between pb-2 pt-3 px-2">
                    <h6 class="mb-0 ml-3 text-muted">{{ __('Next Billing Date') }}</h6>
                    <p class="mb-0 mr-3 h6 font-bold text-dark"> <i class="feather icon-clock"></i> {{ timeZoneformatDate($subscription->next_billing_date) }}</p>
                </div><hr class="m-0">
                <hr class="m-0">
            </div>

        </div>
    </div>
</div>
@include('admin.layouts.includes.delete-modal')

@endsection
@section('js')
<script src="{{ asset('public/dist/js/custom/package.min.js') }}"></script>
@endsection


