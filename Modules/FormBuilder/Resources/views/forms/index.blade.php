@extends('formbuilder::layout')

@section('content')
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="#">{{ __('Forms') }}</a></h5>
                <div class="card-header-right d-inline-block">
                    <div class="btn-toolbar float-md-right" role="toolbar">
                        <div class="btn-group" role="group">
                            <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-circle"></i> {{ __('Create a New Form') }}
                            </a>

                            <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm ml-2">
                                <i class="fa fa-th-list"></i> {{ __('My Submissions') }}
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
        @include('admin.layouts.includes.delete-modal')
    </div>
@endsection
