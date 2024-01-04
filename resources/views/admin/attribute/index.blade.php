@extends('admin.layouts.app')
@section('page_title', __('Attributes'))

@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="attribute-list-container">
        <div class="card">

            <div class="card-header">
                <h5> <a href="{{ route('attribute.index') }}">{{ __('Attributes') }}</a> </h5>
                @if (in_array('App\Http\Controllers\AttributeController@create', $prms))
                    <div class="card-header-right d-47inline-block">
                        <a href="{{ route('attribute.create') }}" class="btn btn-outline-primary custom-btn-small">
                            <span class="fa fa-plus"> &nbsp;</span>{{ __('New') }}
                        </a>
                        <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
                    </div>
                @endif
            </div>

            <div class="card-header p-0 collapse" id="filterPanel">
                <div class="row mx-2 my-3">
                    <div class="col-md-3">
                        <select class="select2 filter" name="group">
                            <option value="">{{ __('All :x', ['x' => __('Groups')]) }}</option>
                            @foreach ($attributeGroups as $groups)
                                @if(optional($groups->attributeGroup)->id)
                                    <option value="{{ optional($groups->attributeGroup)->id }}">{{ optional($groups->attributeGroup)->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="select2 filter" name="status">
                            <option>{{ __('All Status') }}</option>
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
@endsection
@section('js')
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\AttributeController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\AttributeController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/dist/js/custom/attribute.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
