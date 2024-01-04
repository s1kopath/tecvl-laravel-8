@extends('formbuilder::layout')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Submissions') }}</h5>
                <div class="card-header-right d-inline-block">
                    <div class="btn-toolbar float-md-right" role="toolbar">
                        <div class="btn-group" role="group">
                            <a href="{{ route('formbuilder::forms.index') }}"
                                class="btn btn-primary float-md-right btn-sm">
                                <i class="fa fa-arrow-left"></i> {{ __('Back To Forms') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12">
                        @include('admin.layouts.includes.yajra-data-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.includes.delete-modal')
@endsection
