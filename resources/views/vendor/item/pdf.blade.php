@extends('admin.layouts.list_pdf')

@section('pdf-title')
    <title>{{ __(':x List', ['x' => __('Item')]) }}</title>
@endsection

@section('header-info')
    <td colspan="2" class="tbody-td">
        <p class="title">
            <span class="title-text"></span><strong>{{ __(':x Lists', ['x' => __('Item')]) }}</strong>
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
            <td class="text-center list-th"> {{ __('Category') }} </td>
            <td class="text-center list-th"> {{ __('Brand') }} </td>
            <td class="text-center list-th"> {{ __('Vendor') }} </td>
            <td class="text-center list-th"> {{ __('Item Code') }} </td>
            <td class="text-center list-th"> {{ __('SKU') }} </td>
            <td class="text-center list-th"> {{ __('Price') }} </td>
            <td class="text-center list-th"> {{ __('Created At') }} </td>
        </tr>
        </thead>
        @foreach($items as $key => $item)
            <tr>
                <td class="text-center list-td"> {!! wrapIt($item->name, 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {!! wrapIt(optional($item->itemCategory->category)->name, 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {!! wrapIt(optional($item->brand)->name , 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {!! wrapIt(optional($item->vendor)->name, 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {!! wrapIt($item->item_code, 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {!! wrapIt($item->sku, 10, ['columns' => 6]) !!} </td>
                <td class="text-center list-td"> {{ $item->price }} </td>
                <td class="text-center list-td"> {{ timeZoneformatDate($item->created_at) }} {{ timeZonegetTime($item->created_at) }} </td>
            </tr>
        @endforeach
    </table>
@endsection
