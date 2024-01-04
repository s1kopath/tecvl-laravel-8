@extends('admin.layouts.app')
@section('page_title', __('Blogs'))
@section('css')
   <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="blog-list-container">
  <div class="card">
    <div class="card-header">
      <h5><a href="{{ route('blog.index') }}">{{ __('Blogs') }}</a></h5>
        <div class="card-header-right d-inline-block">
        @if (in_array('Modules\Blog\Http\Controllers\BlogController@create', $prms))
                <a href="{{route('blog.create') }}" class="btn btn-outline-primary custom-btn-small"><span class="fa fa-plus"> &nbsp;</span>{{ __('Add Blog') }}</a>
            @endif
        <button class="btn btn-outline-primary custom-btn-small collapsed filterbtn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter"></span></button>
    </div>
    </div>
     <div class="card-header collapse" id="filterPanel">
      <div class="row">
        <div class="col-md-3">
         <select class="select2 filter" name="category_id">
            <option value="">{{ __('All Category') }}</option>
            @foreach ($categoaries as $categoary)
              <option value="{{ $categoary->id }}">{{ $categoary->name }}</option>
            @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <select class="select2 filter" name="author_id">
            <option value="">{{ __('All Author') }}</option>
            @foreach ($authors as $author)
              <option value="{{ $author->id }}">{{ $author->name }}</option>
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
@endsection
@section('js')
<script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('Modules/Blog/Resources/assets/js/blog.min.js') }}"></script>
<script type="text/javascript">
  'use strict';
    $(".select2").select2();
</script>
@endsection

