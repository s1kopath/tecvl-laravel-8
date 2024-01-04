@extends('formbuilder::layout')

@section('content')
    <div class="col-sm-12 list-container" id="coupon-list-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="#">{{ __('Create New Form') }}</a></h5>
                <div class="card-header-right d-inline-block">
                    <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-sm btn-primary float-md-right">
                        <i class="fa fa-arrow-left"></i> {{ __('Back To My Form') }}
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12">
                        <form action="{{ route('formbuilder::forms.store') }}" method="POST" id="createFormForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('Form Name') }}</label>

                                        <input id="name" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="{{ old('name') }}" required autofocus
                                            placeholder="{{ __('Enter Form Name') }}">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visibility" class="col-form-label">{{ __('Form Visibility') }}</label>

                                        <select name="visibility" id="visibility" class="form-control"
                                            required="required">
                                            <option value="">{{ __('Select Form Visibility') }}</option>
                                            @foreach (Modules\FormBuilder\Entities\Form::$visibility_options as $option)
                                                <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('visibility'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('visibility') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3" style="display: none;" id="allows_edit_DIV">
                                    <div class="form-group">
                                        <label for="allows_edit" class="col-form-label">
                                            {{ __('Allow Submission Edit') }}
                                        </label>

                                        <select name="allows_edit" id="allows_edit" class="form-control"
                                            required="required">
                                            <option value="0">{{ __('NO (submissions are final)') }}</option>
                                            <option value="1">{{ __('YES (allow users to edit their submissions)') }}
                                            </option>
                                        </select>

                                        @if ($errors->has('allows_edit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('allows_edit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visibility" class="col-form-label">{{ __('Form Type') }}</label>

                                        <select name="type" id="type" class="form-control" required="required">
                                            <option value="">{{ __('Select Form Types') }}</option>
                                            @foreach (Modules\FormBuilder\Entities\Form::formTypes() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i>
                                        {{ __('Click on or drag and drop components onto the main panel to build your form content.') }}
                                    </div>

                                    <div id="fb-editor" class="fb-editor"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer" id="fb-editor-footer" style="display: none;">
                <button type="button" class="btn btn-primary fb-clear-btn">
                    <i class="fa fa-remove"></i> {{ __('Clear Form') }}
                </button>
                <button type="button" class="btn btn-primary fb-save-btn">
                    <i class="fa fa-save"></i> {{ __('Save Form') }}
                </button>
            </div>
        </div>
    </div>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\create-form.min.js') }}" defer></script>
@endpush
