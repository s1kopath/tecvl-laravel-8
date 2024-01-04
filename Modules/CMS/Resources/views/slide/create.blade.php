@extends('admin.layouts.app')
@section('page_title', __('Slide'))
@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
@endsection
@section('content')
<div class="col-sm-12 list-container" id="slide-add-container">
    <div class="card">
        <div class="card-body">
            <div class="row mt-3" id="theme-container">
                <div class="col-3 pr-0" aria-labelledby="navbarDropdown">
                    <div class="card card-info mx-auto-sm box-shadow-unset" id="nav">
                        <ul class="nav flex-column nav-pills mt-14 pr-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <nav id="column_left">
                                <div class="card-header pb-39 p-t-20 border-bottom mb-2">
                                    <h5><a href="javascript:void(0)" id="general-settings">{{ __('Slide') }}</a></h5>
                                </div>
                                <ul class="nav nav-list flex-column mt-25 mr-30">
                                    <li><a class="nav-link text-left tab-name" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-image-and-button" role="tab" aria-controls="v-pills-image-and-button" aria-selected="true" data-id = "Image & Button">{{ __('Image and Button') }}</a></li>
                                    <li><a class="nav-link text-left tab-name" id="v-pills-title-tab" data-toggle="pill" href="#v-pills-title" role="tab" aria-controls="v-pills-title" aria-selected="true" data-id ="Title">{{ __('Title') }}</a></li>
                                    <li><a class="nav-link text-left tab-name" id="v-pills-sub-title-tab" data-toggle="pill" href="#v-pills-sub-title" role="tab" aria-controls="v-pills-sub-title" aria-selected="true" data-id = "Sub Title">{{ __('Sub Title') }}</a></li>
                                    <li><a class="nav-link text-left tab-name" id="v-pills-description-tab" data-toggle="pill" href="#v-pills-description" role="tab" aria-controls="v-pills-description" aria-selected="true" data-id = "Description">{{ __('Description') }}</a></li>
                                </ul>
                            </nav>
                        </ul>
                    </div>
                </div>
                <div class="col-9 pl-0">
                    <div class="card box-shadow-unset">
                        <div class="card-body border-bottom">
                            <ul class="d-flex my-3 ml-neg-40">
                                <a class="slide-create slide" href="#" data-toggle="tooltip" data-placement="top" title="{{ __('Add slide') }}">
                                    <li class="list-unstyled mr-30 active submitting"><span class="d-block add-slide "><i class="fa fa-plus fa-2x"></i></span></li>
                                    <div class="boxes d-none">
                                        <div class="box"></div>
                                        <div class="box"></div>
                                        <div class="box"></div>
                                        <div class="box"></div>
                                    </div>

                                </a>
                                @foreach ($slider->slides as $slide)
                                    <a href="#" class="slide-edit slide mr-30" data-id="{{ $slide->id }}">
                                        <li class="list-unstyled"><img width="70" height="70" class="rounded" src="{{ $slide->fileUrl() }}" alt="chat-user"></li>
                                        <div class="boxes d-none">
                                            <div class="box"></div>
                                            <div class="box"></div>
                                            <div class="box"></div>
                                            <div class="box"></div>
                                        </div>
                                        @if (in_array('Modules\CMS\Http\Controllers\SlideController@delete', $prms))
                                            <form method="post" action="{{ route('slide.delete', ['id' => $slide->id]) }}" id="delete-slide-{{ $slide->id }}" accept-charset="UTF-8" class="display_inline">
                                                @csrf
                                                <span class="close-slide delete-button" data-toggle="modal" data-label="Delete" data-delete="slide" data-target="#confirmDelete"
                                                    data-id="{{ $slide->id }}" title="{{ __('Delete slide') }}" data-title="{{ __('Delete :x', ['x' => __('Slide')]) }}" data-message="{{ __('Are you sure to delete this?') }}">
                                                    &#10060;
                                                </span>
                                            </form>
                                        @endif
                                        {{-- <span class="close-slide">&#10060;</span> --}}
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div id="load-data">
                        @include('cms::partials.add_slide')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- Delete slide --}}
    @include('admin.layouts.includes.delete-modal')

    @include('mediamanager::image.modal_image')
@endsection
@section('js')
    <script src="{{asset('public/dist/plugins/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/condition.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/theme.min.js') }}"></script>
    <script src="{{ asset('Modules/CMS/Resources/assets/js/slider.min.js') }}"></script>
@endsection
