@extends('admin.layouts.app')
@section('page_title', __('Reviews'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="review-list-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('review.index') }}">{{ __('Reviews') }}</a> </h5>
                <div class="card-header-right d-inline-block">

                    <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
                </div>
            </div>

            <div class="card-header p-0 collapse" id="filterPanel">
                <div class="row mx-2 my-3">
                    <div class="col-md-3">
                        <select class="select2 filter" name="rating">
                            <option value="">{{ __('All Rating') }}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="select2 filter" name="status">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="Active">{{ __('Active') }}</option>
                            <option value="Inactive">{{ __('Inactive') }}</option>
                        </select>
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
            @include('admin.layouts.includes.delete-modal')

            <div id="edit-review" class="modal fade display_none" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('Edit :x',['x' => __('Review')]) }}</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <form action="{{ route('review.update') }}" method="post" id="editLanguage" class="form-horizontal" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label require" for="edit_status">{{ __('Status') }}</label>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control js-example-basic-single-1 sl_common_bx" id="edit_status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                    <option value="Active">{{ __('Active') }}</option>
                                                    <option value="Inactive">{{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="review_id" id="review_id">
                            </div>
                            <div class="modal-footer py-0">
                                <div class="form-group row">
                                    <label for="btn_save" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                        <button type="button" class="btn btn-secondary custom-btn-small float-right" data-dismiss="modal">{{ __('Close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\ReviewController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\ReviewController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/review.min.js') }}"></script>
@endsection
