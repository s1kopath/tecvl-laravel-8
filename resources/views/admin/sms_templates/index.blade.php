@extends('admin.layouts.app')
@section('page_title', __('SMS Templates'))
@section('content')

    <!-- Main content -->
    <div class="col-sm-12 list-container" id="sms-template-list-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('smsTemplates.index') }}">{{ __('SMS Templates') }}</a> </h5>
                @if (in_array('App\Http\Controllers\SmsTemplateController@create', $prms))
                    <div class="card-header-right d-inline-block">
                        <a href="{{ route('smsTemplates.create') }}" class="btn btn-outline-primary custom-btn-small">
                            <span class="fa fa-plus"> &nbsp;</span>{{ __('New') }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="card-body p-0">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12">
                        @include('admin.layouts.includes.yajra-data-table')
                    </div>
                </div>
            </div>
            @include('admin.layouts.includes.delete-modal')
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/templates.min.js') }}"></script>
@endsection


