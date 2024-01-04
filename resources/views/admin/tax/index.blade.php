@extends('admin.layouts.app')
@section('page_title', __('Tax'))
@section('css')
    {{-- Data table --}}
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="tax-settings-container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.includes.finance_menu')
            </div>
            <div class="col-md-9">
                <div class="card card-info">
                    @if(session('errorMgs'))
                        <div class="alert alert-warning fade in alert-dismissable">
                            <strong>{{ __('Warning') }}!</strong> {{ session('errorMgs') }}. <a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <span id="smtp_head">
                        <div class="card-header">
                            <h5><a href="{{ route('tax.index') }}">{{ __('Finance') }} </a> >> {{ __('Taxes') }}</h5>
                            @if (in_array('App\Http\Controllers\TaxController@store', $prms))
                            <div class="card-header-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-tax" class="btn btn-outline-primary custom-btn-small"><span class="fa fa-plus"> &nbsp;</span>{{ __('New :x', ['x' => __('Tax')]) }}</a>
                            </div>
                            @endif
                        </div>
                    </span>
                    <div class="card-body">
                        <div class="row p-l-15">
                            <div class="table-responsive">
                                <table id="dataTableBuilder" class="table table-bordered table-hover table-striped dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Tax Rate') }} (%)</th>
                                            <th>{{ __('Default') }}</th>
                                            @if (array_intersect(['App\Http\Controllers\TaxController@edit'], $prms))
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($taxes as $tax)
                                        <tr>
                                            <td>{{ $tax->name }}</td>
                                            <td>{{ formatCurrencyAmount($tax->tax_rate) }}</td>
                                            <td>{{ $tax->is_default == 1 ? __('Yes') : __('No') }}</td>
                                            @if (array_intersect(['App\Http\Controllers\TaxController@edit', 'App\Http\Controllers\TaxController@destroy'], $prms))
                                            <td>
                                                @if (in_array('App\Http\Controllers\TaxController@edit', $prms))
                                                    <a title="{{ __('Edit :x', ['x' => __('Tax')]) }}" href="javascript:void(0)"  class="btn btn-xs btn-primary edit_currency" data-toggle="modal" data-target="#edit-currency" id="{{ $tax->id }}" ><span class="feather icon-edit"></span></a> &nbsp;
                                                @endif
                                                @if (in_array('App\Http\Controllers\TaxController@destroy', $prms) && $tax->is_default <> 1)
                                                    <form method="post" action="{{ route('tax.delete', ['id' => $tax->id]) }}" id="delete-tax-{{ $tax->id }}" accept-charset="UTF-8" class="display_inline">
                                                        @csrf
                                                        <button title="{{ __('Delete') }}" class="btn btn-xs btn-danger" type="button" data-id={{ $tax->id }} data-label="Delete" data-delete="tax" data-toggle="modal" data-target="#confirmDelete" data-title="{{ __('Delete :x', ['x' => __('Tax')]) }}" data-message="{{ __('Are you sure to delete :x ?', ['x' => __('Tax')]) }}">
                                                            <i class="feather icon-trash-2"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add-tax" class="modal fade display_none" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Add New') }} &nbsp; </h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tax.store') }}" method="post" id="addTax" class="form-horizontal">
                            {!! csrf_field() !!}

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">{{ __('Name') }}</label>

                                <div class="col-sm-6">
                                    <input type="text" placeholder="{{ __('Name') }}" class="form-control name" name="name" required maxlength="50" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0 " for="inputEmail3">{{ __('Tax Rate') }} (%)</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="{{ __('Tax Rate') }}" class="form-control positive-float-number" name="tax_rate" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="is_default">{{ __('Default') }}</label>
                                <div class="col-sm-6">
                                    <select class="js-example-basic-single-1 form-control select2" name="is_default">
                                        <option value=0>{{ __('No') }}</option>
                                        <option value=1>{{ __('Yes') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="btn_save" class="col-sm-3 control-label"></label>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                    <button type="button" class="btn btn-secondary custom-btn-small float-right" data-dismiss="modal">{{ __('Close') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div id="edit-tax" class="modal fade display_none" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Edit :x',['x' => __('Tax')]) }} &nbsp;</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tax.update') }}" method="post" id="editTax" class="form-horizontal">
                            {!! csrf_field() !!}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="tax_id" id="tax_id">

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="curr_name">{{ __('Name') }}</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="name" name="name" required maxlength="50" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="tax_rate">{{ __('Tax Rate') }} (%)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control positive-float-number" placeholder="{{ __('Tax Rate') }}" id="tax_rate" name="tax_rate" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="exchange_from">{{ __('Default') }}</label>
                                <div class="col-sm-6">
                                    <select class="js-example-basic-single-2 form-control select2" name="is_default" id="is_default">
                                        <option value=0>{{ __('No') }}</option>
                                        <option value=1>{{ __('Yes') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="btn_save" class="col-sm-3 control-label"></label>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary custom-btn-small float-right">{{ __('Submit') }}</button>
                                    <button type="button" class="btn btn-secondary custom-btn-small float-right" data-dismiss="modal">{{ __('Close') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @include('admin.layouts.includes.delete-modal')
@endsection
@section('js')
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/finance.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
