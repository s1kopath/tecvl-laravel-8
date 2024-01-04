@extends('admin.layouts.app')
@section('page_title', __('Homepage Builder'))
@section('content')
    @include('mediamanager::image.modal_image')

    @php
    $homeService = new \Modules\CMS\Service\HomepageService();
    @endphp

    <!-- Main content -->
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-7">
                        <h5>
                            <a href="{{ route('page.home') }}">{{ __('Homepages') }}</a>
                            >>
                            <a href="javascript:void();">{{ $page->name }}</a>

                        </h5>
                    </div>
                    <div class="col-sm-5 d-flex justify-content-end">
                        <div class="form-group d-flex">
                            <button class="btn btn-success btn-sm" id="update_page" type="submit"><i class="feather icon-save mr-1"></i>{{ __('Save') }}
                                <div class="spinner-border border1px loading-spinner d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                        <div class="form-group d-flex">
                            <a class="btn btn-sm btn-info" href="{{ route('site.page', $page->slug) }}"
                                target="_blank"><i class="feather icon-eye mr-1"></i>{{ __('Preview') }}</a>
                        </div>
                        <div class="form-group d-flex">
                            <button class="btn btn-sm btn-primary" id="add-new-widget"><i class="feather icon-plus mr-1"></i>{{ __('Add Section') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-block pt-2 px-2">
                    <ul id="sortable" class="selector">
                        @foreach ($page->components as $component)
                            <li class="ui-state-default" data-id="{{ $component->id }}">
                                <div class="component-header">
                                    <i class="feather feather icon-move"></i>
                                    <div class="header-text">
                                        <h5 class="header-title">
                                            {{ componentValue($component, 'title') ?? optional($component->layout)->name }}
                                        </h5>
                                        @include('cms::pieces.header-badges', ['layout' => $component->layout])
                                    </div>
                                    <div class="header-btns">
                                        <span class="header-btn delete-button" data-toggle="modal"
                                            data-target="#confirmDelete" data-component="{{ $component->name ?? '' }}"
                                            data-component-id="{{ $component->id }}">
                                            <i class="feather icon-trash-2"></i>
                                        </span>
                                        <span class="header-btn folding closed btn-primary">
                                            <i class="feather icon-chevron-up"></i>
                                        </span>
                                    </div>

                                </div>
                                @include('cms::edit.' . $component->layout->file)
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <form action="#" id="internal_form">
                @csrf
                <input type="hidden" name="data" id="data">
            </form>
        </div>
    </div>
    <div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">{{ __('Delete Section') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure to delete this section?') }}</p>
                    <p><strong>{{ __('Section') }}:</strong><span class="ml-" id="component-title"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary custom-btn-small"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" id="confirmDeleteSubmitBtn" data-task="1"
                        class="btn btn-danger custom-btn-small delete-section-btn">{{ __('Delete') }}
                        <div class="spinner-border ml-2 d-none delete-loading" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <span class="ajax-loading"></span>
                </div>
            </div>
        </div>
    </div>


@endsection



@push('styles')
    <link href="{{ asset('Modules/CMS/Resources/assets/css/draganddrop.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    @endpush @section('js')
    <script src="{{ asset('public/dist/plugins/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('Modules/CMS/Resources/assets/js/jquery-ui.js') }}"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                axis: "y",
                cursor: "move",
            });
        });
    </script>

    <script>
        let selectorData = @json($layouts);
        const selector = `{!! $selector !!}`;
        const sortable = $('#sortable');
        let request;
        let __page = {{ $page->id }};
        const __gridDeleteUrl = `{{ route('builder.delete', ['id' => $page->id]) }}`;
        const __savePageUrl = "{{ route('builder.order', ['id' => $page->id]) }}";
        let popupNotification;
        let deletingSectionId;
        let deletingSection;
    </script>
    <script src="{{ asset('Modules/CMS/Resources/assets/js/builder.min.js') }}"></script>
@endsection
