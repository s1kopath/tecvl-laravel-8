@extends('admin.layouts.list_pdf')

@section('pdf-title')
    <title>{{ __('Package List') }}</title>
@endsection

@section('header-info')
    <td colspan="2" class="tbody-td">
        <p class="title">
            <span class="title-text"></span><strong>{{ __('Package List') }}</strong>
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
            <td class="text-center list-th"> {{ __('Code') }} </td>
            <td class="text-center list-th"> {{ __('Price') }} </td>
            <td class="text-center list-th"> {{ __('Billing Cycle') }} </td>
            <td class="text-center list-th"> {{ __('Sort Order') }} </td>
            <td class="text-center list-th"> {{ __('Private') }} </td>
            <td class="text-center list-th"> {{ __('Status') }} </td>
        </tr>
        </thead>
        @foreach($packages as $key => $package)
            <tr>
                <td class="text-center list-td word-wrap-normal"> {!! wrapIt($package->name, 10, ['columns' => 2]) !!} </td>
                <td class="text-center list-td word-wrap-normal"> {!! wrapIt($package->code, 10, ['columns' => 2]) !!} </td>
                <td class="text-center list-td"> {{ number_format((float)$package->price, $digit['decimal_digits'], '.', '') }} </td>
                <td class="text-center list-td"> {{ $package->billing_cycle }} </td>
                <td class="text-center list-td"> {{ $package->sort_order }} </td>
                <td class="text-center list-td"> {{ $package->is_private == 1 ? "Yes" : "No" }} </td>
                <td class="text-center list-td"> {{ $package->status }} </td>
            </tr>
        @endforeach
    </table>
@endsection
