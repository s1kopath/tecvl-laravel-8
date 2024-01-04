@extends('admin.layouts.app')
@section('page_title', __('Order Statuses'))
@section('css')
    {{-- Data table --}}
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="order-status-container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.includes.general_settings_menu')
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
                            <h5><a href="{{ route('orderStatues.index') }}">{{ __('General Settings') }} </a> >> {{ __('Order Status') }}</h5>
                            @if (in_array('App\Http\Controllers\OrderStatusController@store', $prms))
                                <div class="card-header-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-status" class="btn btn-outline-primary custom-btn-small"><span class="fa fa-plus"> &nbsp;</span>{{ __('New :x', ['x' => __('Status')]) }}</a>
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
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Order By') }}</th>
                                        <th>{{ __('Default') }}</th>
                                        @if (array_intersect(['App\Http\Controllers\OrderStatusController@edit', 'App\Http\Controllers\OrderStatusController@destroy'], $prms))
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderStatuses as $status)
                                        <tr>
                                            <td>{{ $status->name }}</td>
                                            <td>{!! $status->roleName($status->role) !!}</td>
                                            <td>{{ $status->order_by }}</td>
                                            <td>{{ $status->is_default == 1 ? __('Yes') : __('No') }}</td>
                                            @if (array_intersect([
                                                   'App\Http\Controllers\OrderStatusController@edit',
                                                   'App\Http\Controllers\OrderStatusController@destroy'
                                               ], $prms)
                                           )
                                                <td>
                                                    @if (in_array('App\Http\Controllers\OrderStatusController@edit', $prms))
                                                        <a title="{{ __('Edit') }}" href="javascript:void(0)"  class="btn btn-xs btn-primary edit_status" data-toggle="modal" data-target="#edit-status" id="{{ $status->id }}" ><span class="feather icon-edit"></span></a> &nbsp;
                                                    @endif

                                                    @if (in_array('App\Http\Controllers\OrderStatusController@destroy', $prms) && $status->is_default <> 1 )
                                                        <form method="POST" action="{{ route('orderStatues.delete', $status->id) }}" accept-charset="UTF-8" id="delete-language-{{ $status->id }}" class="display_inline">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $status->id }}">
                                                            <button title="{{ __('Delete') }}"  class="btn btn-xs btn-danger" data-id="{{ $status->id }}" type="button" data-toggle="modal" data-target="#confirmDelete" data-label = "Delete" data-title="{{ __('Delete :x', ['x' => __('Status')]) }}" data-message="{{ __('Are you sure to delete this?') }}">
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
        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary custom-btn-small" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" id="confirmDeleteSubmitBtn" data-task="" class="btn btn-danger custom-btn-small">{{ __('Submit') }}</button>
                        <span class="ajax-loading"></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="add-status" class="modal fade display_none" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Add New') }} &nbsp; </h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('orderStatues.store') }}" method="post" id="addStatus" class="form-horizontal">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">{{ __('Name') }}</label>

                                <div class="col-sm-6">
                                    <input type="text" placeholder="{{ __('Name') }}" value="{{ old('name') }}" class="form-control name" name="name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0 " for="inputEmail3">{{ __('Role') }}</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2 sl_common_bx" name="role_ids[]" id="role_id" multiple required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">{{ __('Order By') }}</label>

                                <div class="col-sm-6">
                                    <input type="number" placeholder="{{ __('Order By') }}" value="{{ old('order_by') }}" class="form-control" name="order_by" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="is_default">{{ __('Default') }}</label>
                                <div class="col-sm-6">
                                    <select class="js-example-basic-single-1 form-control select2 sl_common_bx" name="is_default" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                        <option value="0" {{ old('is_default') == "0" ? 'selected' : ''}}>{{ __('No') }}</option>
                                        <option value="1" {{ old('is_default') == "1" ? 'selected' : ''}}>{{ __('Yes') }}</option>
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

        <div id="edit-status" class="modal fade display_none" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Edit :x',['x' => __('Status')]) }} &nbsp;</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('orderStatues.update') }}" method="post" id="editTax" class="form-horizontal">
                           @csrf
                            <input type="hidden" name="status_id" id="status_id">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="status_name">{{ __('Name') }}</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="status_name" name="name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require" for="inputEmail3">{{ __('Order By') }}</label>

                                <div class="col-sm-6">
                                    <input type="number" placeholder="{{ __('Order By') }}" value="{{ old('order_by') }}" class="form-control" name="order_by" id="status_orderBy" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="role_id">{{ __('Role') }}</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2 sl_common_bx" name="role_ids[]" id="status_role_id" multiple required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 control-label require pr-0" for="status_is_default">{{ __('Default') }}</label>
                                <div class="col-sm-6">
                                    <select class="js-example-basic-single-2 form-control select2" name="is_default" id="status_is_default">
                                        <option value="0">{{ __('No') }}</option>
                                        <option value="1">{{ __('Yes') }}</option>
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
@endsection
@section('js')
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/order_status.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
