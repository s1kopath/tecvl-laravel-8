@extends('admin.layouts.app')
@section('page_title', __('Media-Manager'))
@section('css')
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/fileupload/css/fileupload.min.css') }}">
@endsection
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5><a href="{{ route('blog.index') }}">{{ __('File Upload') }}</a></h5>
            <div class="card-header-right d-inline-block">
                <a href="{{ route('mediaManager.uplodedFiles') }}" class="btn btn-outline-primary custom-btn-small">
                <span> &nbsp;</span>{{ __('File List') }}
                </a>
            </div>
        </div>
        <div class="card-block">
            <form action="{{ route("mediaManager.store") }}" class="dropzone">
                @csrf
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/fileupload/js/dropzone.min.js') }}"></script>
@endsection
