@extends('admin.layouts.app')
@section('page_title', __('Maintenance Mode'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="maintenance-container">
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
                            <h5><a href="{{ route('maintenance.enable') }}">{{ __('General Settings') }} </a> >> {{ __('Maintenance Mode') }}</h5>
                        </div>
                    </span>
           <div class="card-body p-l-15">
               <form action="{{ route('maintenance.enable') }}" method="post" class="form-horizontal">
                   <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">

                    <div class="form-group row">
                        <label class="col-sm-3 control-label require">{{ __('Maintenance Mode') }}</label>
                        <div class="col-sm-8">
                            <select class="select form-control" name="maintenance" id="default">
                                <option value ='true' {{ app()->isDownForMaintenance() ? 'selected' : "" }} >{{ __('Enable') }} </option>
                                <option value ='false' {{ !app()->isDownForMaintenance() ? 'selected' : "" }} >{{ __('Disable') }} </option>
                            </select>
                            <label for="default" generated="true" class="error"></label>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                   <div class="form-group row">
                       <label class="col-sm-3 control-label">{{ __('Bypass URL') }}</label>
                       <div class="col-sm-8">
                            @if(app()->isDownForMaintenance())
                                <label><a href="{{ url('/', $secret) }}">{{ url('/', $secret) }}</a></label>
                            @endif
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="btn_save" class="col-sm-0 ml-3 control-label"></label>
                       <button class="btn btn-primary custom-btn-small float-left" type="submit">{{ __('Update') }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
