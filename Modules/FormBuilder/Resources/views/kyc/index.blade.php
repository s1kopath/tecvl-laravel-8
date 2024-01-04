@extends('formbuilder::layout')

@section('content')
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="#">{{ __('KYC Submissions') }}</a></h5>
                <div class="card-header-right d-inline-block">
                    <div class="btn-toolbar float-md-right" role="toolbar">
                        <div class="btn-group" role="group">
                            <a href="{{ route('formbuilder::kyc.edit', ['form' => $form->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"></i> {{__('Edit KYC From')}}
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
