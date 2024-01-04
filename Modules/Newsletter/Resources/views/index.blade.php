@extends('admin.layouts.app')
@section('page_title', __('Send Newsletter'))
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="subscriber-send-container">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Send Newsletter') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active text-uppercase">{{ __('Newsletter Information') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('newsletter.send') }}" method="post" class="form-horizontal">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="title">{{ __('Title') }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="{{ __('Title') }}" class="form-control" id="title" name="title" required maxlength="191" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{  old('title') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label require" for="description">{{ __('Description') }}</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" rows="5" name="description" id="">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-8 px-0">
                                    <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Send') }}</span></button>
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
