@extends('admin.layouts.list_pdf')

@section('pdf-title')
    <title>{{ __(':x List', ['x' => __('Option')]) }}</title>
@endsection

@section('header-info')
    <td colspan="2" class="tbody-td">
        <p class="title">
            <span class="title-text"></span><strong>{{ __(':x List', ['x' => __('Option')]) }}</strong>
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
            <td class="text-center list-th"> {{ __('Type') }} </td>
            <td class="text-center list-th"> {{ __('Required') }} </td>
            <td class="text-center list-th"> {{ __('Created At') }} </td>
        </tr>
        </thead>
        @foreach($optionGroups as $key => $groups)
            <tr>
                <td class="text-center list-td"> {!! wrapIt($groups->name , 10, ['columns' => 2]) !!} </td>
                <td class="text-center list-td"> {{ $groups->type }} </td>
                <td class="text-center list-td"> {{ $groups->is_required == 1 ? __('Yes') : __('No') }} </td>
                <td class="text-center list-td"> {{  $groups->format_created_at }} </td>
            </tr>
        @endforeach
    </table>
@endsection
