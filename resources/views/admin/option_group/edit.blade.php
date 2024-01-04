@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Option')]))
@section('css')
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="option-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('option.index') }}">{{ __('Options') }} </a> >>{{ __('Edit :x', ['x' => __('Option')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('option.update', $optionGroups->id) }}" method="post" id="optionForm" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information',['x' => __('Option')]) }}</a>
                            </li>
                        </ul>
                        <div class="col-sm-12" id="myTabContent">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <li><a class="nav-link text-left active" id="v-pills-home-tab" data-toggle="pill" href="#group" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ __('Group') }}</a></li>
                                        <li><a class="nav-link text-left" id="v-pills-profile-tab" data-toggle="pill" href="#options" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ __('Options') }}</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12 form-edit-con">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <div class="form-group row">
                                                <label for="name" class="control-label require pl-3">{{ __('Name') }}
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="{{ __('Name') }}" class="form-control form-width" id="name" name="name" value="{{ $optionGroups->name }}" {{ $optionGroups->id == 1 || $optionGroups->id == 2 ? 'readonly' : '' }} required oninvalid="this.setCustomValidity(jsLang('This field is required.'))">
                                                </div>
                                            </div>
                                            @if(!in_array($optionGroups->id, [1,2]))
                                            <div class="form-group row">
                                                <label for="category_id" class="control-label require">{{ __('Category') }}</label>
                                                <div class="col-sm-12">
                                                    <select name="category_ids[]" id="category_id" class="form-control select2 sl_common_bx" multiple required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                        @foreach($categories as $key => $category)
                                                            <option value="{{ $category->id }}" {{ isset($category->categories) && count($category->categories) > 0 ? 'disabled' : '' }} {{ !empty($allCategoryOptionGroups) && is_array($allCategoryOptionGroups) && in_array($category->id, $allCategoryOptionGroups) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @if (isset($category->categories) && count($category->categories) > 0)
                                                                @foreach ($category->categories->where('status', 'Active') as $cateSub)
                                                                    <option value="{{ $cateSub->id }}" {{ isset($cateSub->categories) && count($cateSub->categories) > 0 ? 'disabled' : '' }} {{ !empty($allCategoryOptionGroups) && is_array($allCategoryOptionGroups) && in_array($cateSub->id, $allCategoryOptionGroups) ? 'selected' : '' }}>¦––{{ $cateSub->name }}</option>
                                                                    @if (isset($cateSub->categories) && count($cateSub->categories) > 0)
                                                                        @foreach ($cateSub->categories->where('status', 'Active') as $cateSecSub)
                                                                            <option value="{{ $cateSecSub->id }}" {{ !empty($allCategoryOptionGroups) && is_array($allCategoryOptionGroups) && in_array($cateSecSub->id, $allCategoryOptionGroups) ? 'selected' : '' }}>¦––¦––{{ $cateSecSub->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group row">
                                                <label for="type" class="control-label require pl-3">{{ __('Type') }}</label>
                                                <div class="col-sm-12">
                                                    <select class="js-example-basic-single form-control select2 sl_common_bx" id="type" name="type" required oninvalid="this.setCustomValidity({{ __('This field is required.') }})">
                                                            <option value="" selected="">{{ __('Select One') }}</option>
                                                            <option value="dropdown" {{ $optionGroups->type == "dropdown" ? 'selected' : '' }}>{{ __('Dropdown') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="is_required" class="control-label pl-3">{{ __('Is Required') }}</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control select2" name="is_required" id="is_required">
                                                        <option value="0" {{ $optionGroups->is_required == "0" ? 'selected' : ''}}>{{ __('No') }}</option>
                                                        <option value="1" {{ $optionGroups->is_required == "1" ? 'selected' : ''}}>{{ __('Yes') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="options" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <div class="alert alert-primary" role="alert" id="select_first">
                                                {{ __('Please select a option type.') }}
                                            </div>
                                            <div class="table-responsive" id="option_div">
                                                <table class="options table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th class="bar"></th>
                                                        <th class="label">{{ __('Label') }}</th>
                                                        <th>{{ __('Price') }}</th>
                                                        <th>{{ __('Price type') }}</th>
                                                        <th class="delete"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="values">
                                                    @php $rowId = 1  @endphp
                                                    @foreach($optionValues as $value)
                                                        <tr class="sortable-row" draggable="false" id="rowid-{{ $rowId }}">
                                                            <td class="text-center bar">
                                                                <i class="fa fa-bars"></i>
                                                            </td>
                                                            <td class="label">
                                                                <input type="text" name="label[]" value="{{ $value->option }}" class="form-control errorChk" id="labelChk-{{ $rowId }}">
                                                                <span id="value-label-{{ $rowId }}" class="validationMsg"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="price[]" value="{{ formatCurrencyAmount($value->price) }}" class="form-control positive-float-number errorChk" id="priceChk-{{ $rowId }}" maxlength="8">
                                                                    <span id="value-price-{{ $rowId }}" class="validationMsg"></span>
                                                                    <input type="hidden" name="row_identify[]" value="{{ $rowId }}">
                                                                    <input type="hidden" name="value_id[]" value="{{ $value->id }}" class="form-control">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="price_type[]" id="price_type">
                                                                    <option value="Fixed" {{ $value->price_type == 'Fixed' ? 'selected' : '' }}>{{ __('Fixed') }}</option>
                                                                    <option value="Percent" {{ $value->price_type == 'Percent' ? 'selected' : '' }}>{{ __('Percent') }}</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-center delete">
                                                                <button type="button" id="delete-value" class="btn btn-xs btn-danger delete-row" data-row-id={{ $rowId++ }} data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                    <i class="feather icon-trash-2"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <input type="hidden" id="row_id" value="{{ $rowId }}">
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-default" id="add-new-value">{{ __('New') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 px-0 m-l-5 pl-2">
                                <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                <a href="{{ route('option.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/dist/js/custom/option.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
