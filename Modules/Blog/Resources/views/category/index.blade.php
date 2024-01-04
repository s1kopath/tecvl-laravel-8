@extends('admin.layouts.app')
@section('page_title', __('Blog Category'))
@section('css')
   <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="item-list-container">
        <div class="card">
            <div class="card-header">
              <h5><a href="{{ route('blog.category.index') }}">{{ __('Blog Category') }}</a></h5>
                <div class="card-header-right d-inline-block">
                @if (in_array('Modules\Blog\Http\Controllers\BlogCategoryController@create', $prms))
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-category-name" class="add-payment-term btn btn-outline-primary custom-btn-small"><span class="fa fa-plus"> &nbsp;</span>{{ __('Add :?', ['?' => 'Category']) }}</a>
                @endif
                <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
            </div>
            </div>
             <div class="card-header collapse" id="filterPanel">
              <div class="row">
                <div class="col-md-3">
                 <select class="select2 filter" name="category_id">
                    <option value="">{{ __('All Category') }}</option>
                    @foreach ($categoary as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
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
          </div>
    </div>
    <div id="add-category-name" class="modal fade display_none" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add :x', ['x' => __('Category')]) }}</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="{{ route('blog.category.store') }}" method="post" id="addPaymentForm"
                      class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 control-label require" for="store-term">{{ __('Category Name') }}</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" id="store-term" value="" required minlength="3" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label" for="">{{ __('Status') }}</label>
                            <div class="col-sm-7">
                                <input type="hidden" name="status" value="Inactive">
                                <div class="switch d-inline m-r-10">
                                    <input class="is_default" type="checkbox" name="status" value="Active"  id="is_default" checked>
                                    <label for="is_default" class="cr"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                <button type="button" class="btn btn-secondary custom-btn-small float-right"
                                        data-dismiss="modal">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="edit-payment" class="modal fade display_none" aria-modal="true" role="dialog" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit :x', ['x' => __('Category Name')]) }}</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="{{ route('blog.category.update') }}" method="post" id="edit-payment-form"
                      class="form-horizontal" >
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="edit-id" id="edit-id" name="id" value="">

                        <div class="form-group row">
                            <label class="col-sm-4 control-label require" for="store-term">{{ __('Category Name') }}</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" id="name" value="" required minlength="3" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label" for="">{{ __('Status') }}</label>
                            <div class="col-sm-7">
                                <input type="hidden" name="status" value="Inactive">
                                <div class="switch d-inline m-r-10">
                                    <input class="is_default" type="checkbox" name="status" value=""  id="edit_status">
                                    <label for="is_default" class="cr"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                <button type="button" class="btn btn-secondary custom-btn-small float-right"
                                        data-dismiss="modal">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('Modules/Blog/Resources/assets/js/blog-category.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script type="text/javascript">
    'use strict';
      $(".select2").select2();
  </script>
@endsection
