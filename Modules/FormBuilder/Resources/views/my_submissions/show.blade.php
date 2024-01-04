@extends('formbuilder::layout')

@section('content')
    <div class="col-sm-12 row list-continer">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5>
                        {{ __('Viewing my submission for form') }}
                        <strong>{{ $submission->form->name }}</strong>
                    </h5>
                    <div class="card-header-right d-inline-block">
                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group">
                                <a href="{{ route('formbuilder::my-submissions.index') }}"
                                    class="btn btn-primary btn-sm mr-2" title="{{ __('Back To My Submissions') }}">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                                @if ($submission->form->allowsEdit())
                                    <a href="{{ route('formbuilder::my-submissions.edit', $submission) }}"
                                        class="btn btn-primary btn-sm" title="{{ __('Edit this submission') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="card-block pt-2 px-2">
                        <div class="col-sm-12">
                            <ul class="list-group list-group-flush">
                                @foreach ($form_headers as $header)
                                    <li class="list-group-item">
                                        <strong>{{ $header['label'] ?? ucwords($header['name']) }}: </strong>
                                        <span class="float-right">
                                            {{ $submission->renderEntryContent($header['name'], $header['type']) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5>Details</h5>
                </div>

                <div class="card-body p-0">
                    <div class="card-block pt-2 px-2">
                        <div class="col-sm-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>{{ __('Form') }} : </strong>
                                    <span class="float-right">{{ $submission->form->name }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('Submitted By') }} : </strong>
                                    <span class="float-right">{{ $submission->user->name ?? __('Guest') }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('Updated On') }} : </strong>
                                    <span
                                        class="float-right">{{ $submission->updated_at->toDayDateTimeString() }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('Submitted On') }} : </strong>
                                    <span
                                        class="float-right">{{ $submission->created_at->toDayDateTimeString() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
