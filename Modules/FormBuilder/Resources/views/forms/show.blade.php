@extends('formbuilder::layout')

@section('content')
    <div class="col-sm-12 row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Form Preview for :x', ['x' => $form->name]) }}</h5>
                    <div class="card-header-right d-inline-block">
                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group">
                                <a href="{{ route('formbuilder::forms.index') }}"
                                    class="btn btn-primary float-md-right btn-sm mr-2">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                                <a href="{{ route('formbuilder::submissions.index', $form) }}"
                                    class="btn btn-primary float-md-right btn-sm mr-2">
                                    <i class="fa fa-th-list"></i> {{ __('Submissions') }}
                                </a>
                                <a href="{{ route('formbuilder::forms.edit', $form) }}"
                                    class="btn btn-primary float-md-right btn-sm mr-2">
                                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                                </a>
                                <a href="{{ route('formbuilder::forms.create') }}"
                                    class="btn btn-primary float-md-right btn-sm">
                                    <i class="fa fa-plus-circle"></i> {{ __('New Form') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="fb-render"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Details') }}</h5>
                    <div class="card-header-right d-inline-block">
                        <div class="btn-toolbar float-md-right" role="toolbar">
                            <div class="btn-group" role="group" aria-label="Third group">
                                <button class="btn btn-primary btn-sm clipboard float-right"
                                    data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}"
                                    data-message="{{ __('Copied') }}" data-original="{{ __('Copy Form URL') }}"
                                    title="{{ __('Copy form URL to clipboard') }}">
                                    <i class="fa fa-clipboard"></i> {{ __('Copy Form URL') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>{{ __('Public URL') }} : </strong>
                            <a href="{{ route('formbuilder::form.render', $form->identifier) }}" class="float-right"
                                target="_blank">
                                {{ $form->identifier }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Visibility') }} : </strong> <span
                                class="float-right">{{ $form->visibility }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Allows Edit') }} : </strong>
                            <span class="float-right">{{ $form->allowsEdit() ? 'YES' : 'NO' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Owner') }} : </strong> <span
                                class="float-right">{{ $form->user->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Current Submissions') }} : </strong>
                            <span class="float-right">{{ $form->submissions_count }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Updated On') }} : </strong>
                            <span class="float-right">
                                {{ $form->updated_at->toDayDateTimeString() }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <strong>{{ __('Created On') }} : </strong>
                            <span class="float-right">
                                {{ $form->created_at->toDayDateTimeString() }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\render-form.min.js') }}" defer></script>
@endpush
