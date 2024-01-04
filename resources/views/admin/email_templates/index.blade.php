@extends('admin.layouts.app')
@section('page_title', __('Email Templates'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="email-template-list-container">
  <div class="card">
    <div class="card-header">
        @if (in_array('App\Http\Controllers\MailTemplateController@index', $prms))
            <h5> <a href="{{ route('emailTemplates.index') }}">{{ __('Email Templates') }}</a> </h5>
        @endif

      @if (in_array('App\Http\Controllers\MailTemplateController@create', $prms))
        <div class="card-header-right d-inline-block">
            <a href="{{ route('emailTemplates.create') }}" class="btn btn-outline-primary custom-btn-small">
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


