@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Attribute')]))
@section('css')
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="attribute-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('attribute.index') }}">{{ __('Attributes') }} </a> >>{{ __('Edit :x', ['x' => __('Attribute')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('attribute.update', $attributes->id) }}" method="post" id="attributeForm" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('Attribute')]) }}</a>
                            </li>
                        </ul>
                        <div class="col-sm-12" id="myTabContent">
                               <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <li><a class="nav-link text-left active" id="v-pills-home-tab" data-toggle="pill" href="#attribute" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ __('Attribute') }}</a></li>
                                            <li id="secondli"><a class="nav-link text-left" id="v-pills-profile-tab" data-toggle="pill" href="#attributeValue" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ __('Attribute :x', ['x' => __('Values')]) }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9 col-sm-12 form-edit-con">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="attribute" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="form-group row">
                                                    <label for="name" class="control-label require pl-3">{{ __('Name') }}
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" value="{{ $attributes->name }}" required oninvalid="this.setCustomValidity(jsLang('This field is required.'))">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Status" class="control-label require pl-3">{{ __('Type') }}</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2 sl_common_bx" name="type" id="type" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            <option value="">{{ __('Select One') }}</option>
                                                            <option value="dropdown" {{ $attributes->type == "dropdown" ? 'selected' : ''}}>{{ __('Dropdown') }}</option>
                                                            <option value="multiple_select" {{ $attributes->type == "multiple_select" ? 'selected' : ''}}>{{ __('Multiple Select') }}</option>
                                                            <option value="field" {{ $attributes->type == "field" ? 'selected' : ''}}>{{ __('Field') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="attribute_group" class="control-label require pl-3">{{ __('Attribute Group') }}</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2 sl_common_bx" name="attribute_group" id="attribute_group" required oninvalid="this.setCustomValidity(jsLang('This field is required.'))">
                                                            <option value="">{{ __('Select One') }}</option>
                                                            @foreach($attributeGroups as $group)
                                                                <option value="{{ $group->id }}" {{ $attributes->attribute_group_id == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="category_id" class="control-label require pl-3">{{ __('Category') }}</label>
                                                    <div class="col-sm-12">
                                                        <select name="category_ids[]" id="category_id" class="form-control select2 sl_common_bx" multiple required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            @foreach($categories as $key => $category)
                                                                <option value="{{ $category->id }}" {{ isset($category->categories) && count($category->categories) > 0 ? 'disabled' : '' }} {{ !empty($allCategoryAttributes) && is_array($allCategoryAttributes) && in_array($category->id, $allCategoryAttributes) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                @if (isset($category->categories) && count($category->categories) > 0)
                                                                    @foreach ($category->categories->where('status', 'Active') as $cateSub)
                                                                        <option value="{{ $cateSub->id }}" {{ isset($cateSub->categories) && count($cateSub->categories) > 0 ? 'disabled' : '' }} {{ !empty($allCategoryAttributes) && is_array($allCategoryAttributes) && in_array($cateSub->id, $allCategoryAttributes) ? 'selected' : '' }}>¦––{{ $cateSub->name }}</option>
                                                                        @if (isset($cateSub->categories) && count($cateSub->categories) > 0)
                                                                            @foreach ($cateSub->categories->where('status', 'Active') as $cateSecSub)
                                                                                <option value="{{ $cateSecSub->id }}" {{ !empty($allCategoryAttributes) && is_array($allCategoryAttributes) && in_array($cateSecSub->id, $allCategoryAttributes) ? 'selected' : '' }}>¦––¦––{{ $cateSecSub->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Status" class="control-label pl-3">{{ __('Status') }}</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="status" id="status">
                                                            <option value="Active" {{ $attributes->status == "Active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                                                            <option value="Inactive" {{ $attributes->status == "Inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="is_filterable" class="control-label pl-3">{{ __('Is filterable') }}</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="is_filterable" id="is_filterable">
                                                            <option value="0" {{ $attributes->is_filterable == "0" ? 'selected' : ''}}>{{ __('No') }}</option>
                                                            <option value="1" {{ $attributes->is_filterable == "1" ? 'selected' : ''}}>{{ __('Yes') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="is_filterable" class="control-label pl-3">{{ __('Is Required') }}</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control select2" name="is_required" id="is_required">
                                                            <option value="0" {{ $attributes->is_required == "0" ? 'selected' : ''}}>{{ __('No') }}</option>
                                                            <option value="1" {{ $attributes->is_required == "1" ? 'selected' : ''}}>{{ __('Yes') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description" class="control-label pl-3">{{ __('Description') }}
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control form-width" name="description">{{ $attributes->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="attributeValue" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                <div class="table-responsive">
                                                    <table class="options table table-bordered" id="attribute-value">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>{{ __('Value') }}</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="values">
                                                        @php $rowId = 1  @endphp
                                                        @foreach($attributeValues as $value)
                                                            <tr draggable="false" id="rowid-{{ $rowId }}">
                                                                <td class="text-center">
                                                                    <i class="fa fa-bars"></i>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" name="values[]" value="{{ $value->value }}" class="form-control errorChk" id="valueChk-{{ $rowId }}">
                                                                        <span id="value-text-{{ $rowId }}" class="validationMsg"></span>
                                                                        <input type="hidden" name="row_identify[]" value="{{ $rowId }}">
                                                                        <input type="hidden" name="value_id[]" value="{{ $value->id }}" class="form-control">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" id="delete-value" class="btn btn-xs btn-danger delete-row" data-row-id={{ $rowId++ }} data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                        <i class="feather icon-trash-2"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <input type="hidden" id="row_id" value="{{ $rowId }}">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="button" class="btn btn-default" id="add-new-value">{{ __('New') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-10 px-0 m-l-5">
                                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                <a href="{{ route('attribute.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/attribute.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
