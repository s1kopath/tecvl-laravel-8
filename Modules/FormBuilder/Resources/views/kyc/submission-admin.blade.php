@extends('formbuilder::layout')

@section('content')
    <div class="col-md-12 row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('KYC Submission') }}</h5>
                    <div class="card-header-right d-inline-block">
                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group">
                                <a href="{{ route('formbuilder::kyc.sub-edit', ['id' => $submission->id]) }}"
                                    class="btn btn-primary float-md-right btn-sm" title="{{ __('Edit KYC Data') }}">
                                    <i class="fa fa-pencil-square-o m-0"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($form_headers as $header)
                            <li class="list-group-item">
                                <strong>{{ $header['label'] ?? ucfirst($header['name']) }}: </strong>
                                <span class="float-right">
                                    {{ $submission->renderEntryContent($header['name'], $header['type']) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Details') }}</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>{{ __('Form') }} : </strong>
                            <span class="float-right">{{ $submission->form->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Submitted By') }} : </strong>
                            <span class="float-right">{{ $submission->user->name ?? 'Guest' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Updated On') }} : </strong>
                            <span class="float-right">{{ $submission->updated_at->toDayDateTimeString() }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Submitted On') }} : </strong>
                            <span class="float-right">{{ $submission->created_at->toDayDateTimeString() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
