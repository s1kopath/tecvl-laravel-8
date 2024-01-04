@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Brand')]))
@section('css')
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="brand-add-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('brands.index') }}">{{ __('Brands') }} </a> >>{{ __('Create :x', ['x' => __('Brand')]) }}</h5>
                <div class="card-header-right">

                </div>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('brands.store') }}" method="post" id="brandAdd" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('Brand')]) }}</a>
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
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" value="{{ old('name') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Status" class="control-label pl-3">{{ __('Vendor') }}</label>
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
                                            <label for="description" class="control-label pl-3">{{ __('Description') }}
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="description" class="form-control form-width">{{ old('description') }}</textarea>
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

                                        <div class="form-group row">
                                            <label class="control-label pl-3">{{ __('Upload Image') }}</label>
                                            <div class="col-sm-12">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control" name="image" id="validatedCustomFile" accept="image/*" >
                                                    <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="divNote">
                                            <label class="control-label"></label>
                                            <div class="col-sm-12" id='note_txt_1'>
                                                <span class="badge badge-danger">{{ __('Note') }}!</span> {{ __('Allowed File Extensions: jpg, jpeg, png') }}
                                            </div>
                                            <div class="col-md-9" id='note_txt_2'>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-10 px-0 m-l-5 btn-align">
                                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                <a href="{{ route('brands.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/dist/js/custom/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/brand.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
