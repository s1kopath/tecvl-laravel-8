@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Attribute Group')]))
@section('css')
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="attribute_group-add-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('attributeGroup.index') }}">{{ __('Attribute Groups') }} </a> >>{{ __('Create :x', ['x' => __('Attribute Group')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('attributeGroup.store') }}" method="post" id="attributeGroupAdd" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('Attribute Group')]) }}</a>
                            </li>
                        </ul>
                        <div class="col-sm-12 tab-content form-edit-con" id="myTabContent">
                            <div class="tab-pane fade show active form-con" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="name" class="control-label require pl-3">{{ __('Name') }}
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" value="{{ old('name') }}" required oninvalid="this.setCustomValidity(jsLang('This field is required.'))">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Status" class="col-sm-3 control-label">{{ __('Vendor') }}</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="vendor" id="vendor">
                                                    <option value="">{{ __('Select One') }}</option>
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}" {{ old('vendor') == $vendor->id ? 'selected' : ''}}>{{ $vendor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="control-label pl-3">{{ __('Summary') }}
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="summary" class="form-control form-width">{{ old('summary') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Status" class="control-label pl-3">{{ __('Status') }}</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="Active" {{ old('status') == "Active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                                                    <option value="Inactive" {{ old('status') == "Inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-10 px-0 m-l-50 pl-2">
                                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                <a href="{{ route('attributeGroup.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/attribute.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
