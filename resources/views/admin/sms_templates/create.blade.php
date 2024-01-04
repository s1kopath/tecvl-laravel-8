@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Template')]))
@section('css')
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="sms-template-add-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('smsTemplates.index') }}">{{ __('SMS Templates') }}</a> >>{{ __('Create :x', ['x' => __('Template')]) }}</h5>
                <div class="card-header-right">
                </div>
            </div>
            <div class="col-sm-12 m-t-20 form-tabs">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">{{ __(':x Information', ['x' => __('Template')]) }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="translate-tab" data-toggle="tab" href="#translate" role="tab" aria-controls="translate" aria-selected="false">{{ __('Translate') }}</a>
                    </li>
                </ul>
                <form action='{{ route("smsTemplates.store")}}' method="post" class="form-horizontal" id="userEdit" enctype="multipart/form-data">
                    <div class="col-sm-12 tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-2 col-form-label require pr-0">{{ __('Name') }}
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" required pattern="^[a-zA-Z ]*$" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Only alphabet and white space are allowed.') }}" data-related="slug" value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2  control-label require" for="name">{{ __('Slug') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{ __('Slug') }}" class="form-control" id="slug" name="slug" required pattern="^[a-zA-Z\-]*$" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Only alphabet and white space are allowed.') }}" value="{{ old('slug') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="body" class="col-sm-2 col-form-label require pr-0">{{ __('Body') }}
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="body" class="form-control" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">{{ old('body') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Status" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="Pending" {{ old('status') == "Pending" ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                                <option value="Active" {{ old('status') == "Active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                                                <option value="Inactive" {{ old('status') == "Inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="variables" class="col-sm-2 col-form-label pr-0">{{ __('Variables') }}
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea id="variables" name="variables" class="form-control">{{ old('variables') }}</textarea>
                                            <span class="badge badge-info">{{ __('Note') }}</span> <small class="text-info">{{ __('Please use comma separated values for variables field.') }}</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="translate" role="tabpanel" aria-labelledby="translate-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                @php
                                    $languages  = \App\Models\Language::getAll()->where('status', 'Active');
                                    $i = 1
                                @endphp
                                 @if($languages->isNotEmpty())
                                    @foreach($languages as $language)
                                        <!-- Escape the english details -->
                                            @php if($language->short_name == 'en'){continue;} @endphp
                                            <div class="card-header p-0">
                                                <img src='{{ url("public/datta-able/fonts/flag/flags/4x3/". getSVGFlag($language->short_name) .".svg") }}' height="20" alt="{{ $language->flag }}"> <span class="text-uppercase f-18 font-weight-bold">{{ $language->name }}</span>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label pr-0">{{ __('Body') }}
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <textarea id="translateBody-{{ $i }}" name="data[{{ $language->short_name }}][body]" class="form-control">{{ old('data.'.$language->short_name.'.body') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="data[{{ $language->short_name }}][language_id]" value="{{ $language->id }}">
                                                </div>
                                            </div>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="nthLoop" data-rel="{{ $i }}" id="nthLoop">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-10 px-0 m-l-5">
                            <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit">{{ __('Submit') }}</button>
                            <a href="{{ route('smsTemplates.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/templates.min.js') }}"></script>
@endsection
