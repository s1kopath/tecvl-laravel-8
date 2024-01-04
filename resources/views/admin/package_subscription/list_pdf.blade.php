@extends('admin.layouts.list_pdf')

@section('pdf-title')
    <title>{{ __('Package Subscription List') }}</title>
@endsection

@section('header-info')
    <td colspan="2" class="tbody-td">
        <p class="title">
            <span class="title-text"></span><strong>{{ __('Package Subscription List') }}</strong>
        </p>
        <p class="title">
            <span class="title-text">{{ __('Print Date') }}: </span> {{ formatDate(date('d-m-Y')) }}
        </p>
    </td>
@endsection

@section('list-table')
    <table class="list-table">
        <thead class="list-head">
        <tr>
            <td class="text-center list-th"> {{ __('Name') }} </td>
            <td class="text-center list-th"> {{ __('Vendor') }} </td>
            <td class="text-center list-th"> {{ __('Package') }} </td>
            <td class="text-center list-th"> {{ __('Billing Cycle') }} </td>
            <td class="text-center list-th"> {{ __('Next Billing Date') }} </td>
            <td class="text-center list-th"> {{ __('Status') }} </td>
            <td class="text-center list-th"> {{ __('Amount Billed') }} </td>
            <td class="text-center list-th"> {{ __('Amount Due') }} </td>
        </tr>
        </thead>
        @foreach($subscriptions as $key => $subscription)
            <tr>
                <td class="text-center list-td word-wrap-normal"> {!! isset($subscription->name) ? wrapIt($subscription->name, 10, ['columns' => 3]) : '' !!} </td>
                <td class="text-center list-td word-wrap-normal"> {!! isset($subscription->vendor->name) ? wrapIt($subscription->vendor->name, 10, ['columns' => 3]) : '' !!} </td>
                <td class="text-center list-td word-wrap-normal"> {!! isset($subscription->package->name) ? wrapIt($subscription->package->name, 10, ['columns' => 3]) : '' !!} </td>
                <td class="text-center list-td"> {{ isset($subscription->billing_cycle) ? $subscription->billing_cycle : '' }} </td>
                <td class="text-center list-td"> {{ timeZoneformatDate($subscription->next_billing_date) }} </td>
                <td class="text-center list-td"> {{ isset($subscription->status) ? $subscription->status : '' }} </td>
                <td class="text-center list-td"> {{ number_format((float)$subscription->amount_billed, $digit['decimal_digits'], '.', '') }} </td>
                <td class="text-center list-td"> {{ number_format((float)$subscription->amount_due, $digit['decimal_digits'], '.', '') }} </td>
            </tr>
        @endforeach
    </table>
@endsection
