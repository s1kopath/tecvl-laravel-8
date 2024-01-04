@extends('admin.layouts.app')
@section('page_title', __('Edit Subsriber'))
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="subscriber-edit-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('subscriber.index') }}">{{ __('Subscriber') }}</a> >> {{ __('Edit Subscriber') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active text-uppercase">{{ __('Subscriber Information') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('subscriber.update', ['id' => $subscriber->id]) }}" method="post" class="form-horizontal">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="email">{{ __('Email') }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="{{ __('Email') }}" class="form-control" id="email" name="email" required maxlength="120" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('email')) ? old('email') : $subscriber->email }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="confirmation_date">{{ __('Confirmation Date') }}</label>
                                    <div class="input-group date col-sm-6">
                                        <div class="input-group-prepend">
                                            <i class="fas fa-calendar-alt input-group-text"></i>
                                        </div>
                                        <input class="form-control" id="confirmation_date" type="text" name="confirmation_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ $subscriber->confirmation_date }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="status">{{ __('Status') }}</label>
                                    <div class="col-sm-6">
                                    <select class="form-control select2 sl_common_bx" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                        <option value="">{{ __('Select One') }}</option>
                                        <option value="Active" {{ old('status', $subscriber->status) == "Active" ? 'selected' : '' }}>{{ __('Active') }}</option>
                                        <option value="Inactive" {{ old('status', $subscriber->status) == "Inactive" ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-8 px-0">
                                    <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                    <a href="{{ route('subscriber.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
<script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/newsletter.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>

@endsection
