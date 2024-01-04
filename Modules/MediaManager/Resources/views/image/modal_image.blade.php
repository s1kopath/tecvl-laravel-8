@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="img-preview-modal modal-dialog modal-dialog-centered mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header img-preview-modal-header">
                <p id="select-file" class="modal-title-color modal-title ml-3 mr-3 p-2" id="exampleModalLongTitle">
                    {{ __('Select File') }}</p>
                <p id="upload-new" class="modal-title p-2" id="exampleModalLongTitle">{{ __('Upload New') }}</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body img-preview-modal-body">
                <div id="upload-card-header" class="card-header row">
                    <div class="col-md-2 mr-0 my-3 my-md-0">
                        <div class="dropdown">
                            <select class="form-control form-control-xs sort-option-modal">
                                <option <?= request()->sort_value == 'largest' ? ' selected' : '' ?> value="largest">
                                    {{ __('Sort by largest') }}</option>
                                <option <?= request()->sort_value == 'smallest' ? ' selected' : '' ?> value="smallest">
                                    {{ __('Sort by smallest') }}</option>
                                <option <?= request()->sort_value == 'newest' ? ' selected' : '' ?> value="newest">
                                    {{ __('Sort by newest') }}</option>
                                <option <?= request()->sort_value == 'oldest' ? ' selected' : '' ?> value="oldest">
                                    {{ __('Sort by oldest') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 ml-auto mr-0 position-static">
                        <div class="text-right">
                            <input type="text" class="form-control form-control-xs search-image"
                                placeholder="{{ __('Search your files') }}">
                            <i class="search-icon"><span></span></i>
                        </div>
                    </div>
                </div>
                <div id="select-items">
                    <?php
                    $files = App\Models\File::simplePaginate(preference('row_per_page', 10));
                    ?>
                    <div id="modal-img-des-container" class="d-flex flex-wrap justify-content-start mt-3">
                        @include('mediamanager::image.child_paginate')
                    </div>
                </div>
                <div id="browse-file" class="h-100">
                    <div class="card-block">
                        <form action="{{ route('mediaManager.store') }}" class="dropzone">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between img-preview-modal-footer">
                <div class="d-flex flex-grow-1 overflow-hidden">
                    <div id="file-count" class="mr-3">
                        <p> <span id="add-file-count">0</span> {{ __('Files selected') }}</p>
                        <p id="clear-item" style="" class="border-0 text-danger">{{ __('Clear') }}</p>
                    </div>
                    <div id="clear-items" class="d-none">
                        <p class="border-0 text-danger mt-3 mr-3 text-nowrap">{{ __('Clear all') }}</p>
                    </div>
                    <div id="load-data">
                        {!! $files->links() !!}
                    </div>
                </div>
                <button type="button" class="btn btn-primary btn-file-add">{{ __('Add files') }}</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('Modules/MediaManager/Resources/assets/js/media-manager.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/fileupload/js/dropzone.min.js') }}"></script>
