@extends('admin.layouts.app')
@section('page_title', __('Withdrawal Setting'))
@section('css')
    {{-- Data table --}}
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="withdrawal-setting-container">
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
                            <h5>{{ __('General Settings') }} >> {{ __('Withdrawal Setting') }}</h5>
                        </div>
                    </span>
                    <div class="card-body">
                        <div class="row p-l-15">
                            <div class="table-responsive">
                                <table id="dataTableBuilder" class="table table-bordered table-hover table-striped dt-responsive">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($withdrawalMethods as $withdrawal)
                                        <tr>
                                            <td>{{ $withdrawal->method_name }}</td>
                                            <td>
                                                <input type="hidden" name="status" value="0">
                                                <div class="switch d-inline m-r-10 edit-status">
                                                    <input class="status" type="checkbox" value="1" name="status" {{ $withdrawal->status == 'Active' ? 'checked' : '' }}  id="status-{{ $withdrawal->id }}">
                                                    <label for="status-{{ $withdrawal->id }}" data-id="{{ $withdrawal->id }}" class="cr withdrawal-status"></label>
                                                </div>
                                            </td>
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

    </div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/withdrawal.min.js') }}"></script>
@endsection
