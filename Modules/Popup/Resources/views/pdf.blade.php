@extends('admin.layouts.list_pdf')

@section('pdf-title')
    <title>{{ __(':? List', ['?' => __('Popup')]) }}</title>
@endsection

@section('header-info')
    <td colspan="2" class="tbody-td">
        <p class="title">
            <span class="title-text"></span><strong>{{ __(':? List', ['?' => __('Popup')]) }}</strong>
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
            <td class="text-center list-th"> {{ __('Popup Type') }} </td>
            <td class="text-center list-th"> {{ __('Show after') }} </td>
            <td class="text-center list-th"> {{ __('Login required') }} </td>
            <td class="text-center list-th"> {{ __('Start Date') }} </td>
            <td class="text-center list-th"> {{ __('End Date') }} </td>
            <td class="text-center list-th"> {{ __('Status') }} </td>
        </tr>
        </thead>
        @foreach($popups as $key => $popup)
            <tr>
                <td class="text-center list-td"> {{ wrapIt($popup->name, 10, ['columns' => 1]) }} </td>
                <td class="text-center list-td"> {{ $popup->type }} </td>
                <td class="text-center list-td"> {{ !empty($popup->show_time) ? $popup->show_time . ' sec' : ''; }} </td>
                <td class="text-center list-td"> {{ $popup->login_enabled == 1 ? __('Yes') : __('No'); }} </td>
                <td class="text-center list-td"> {{ timeZoneformatDate($popup->start_date) }} </td>
                <td class="text-center list-td"> {{ timeZoneformatDate($popup->end_date) }} </td>
                <td class="text-center list-td"> {{ $popup->status }} </td>
            </tr>
        @endforeach
    </table>
@endsection
