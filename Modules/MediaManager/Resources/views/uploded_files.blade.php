@extends('admin.layouts.app')
@section('page_title', __('Media Manager'))
@section('css')
  <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/fileupload/css/fileupload.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection
@section('content')

    <div class="col-sm-12" id="media-manager-container">
          <div class="card">
            <div class="card-header-right d-inline-block">
              @if (in_array('Modules\MediaManager\Http\Controllers\MediaManagerController@create', $prms))
                  <a href="{{ route('mediaManager.create') }}" class="btn btn-outline-primary custom-btn-small add-files-btn">
                  <span class="fa fa-plus"> &nbsp;</span>{{ __('Add Files') }}
                  </a>
              @endif
            </div>
            <form action='{{ route("mediaManager.uplodedFiles") }}' method="get" class="form-horizontal" id="media-list" enctype="multipart/form-data">
                 <div class="card-header row">
                    <div class="col-md-3">
                        <h5 class="mb-0 h6">{{ __('All files') }}</h5>
                    </div>
                    <div class="col-md-3 ml-auto mr-0 my-3 my-md-0">
                          <div class="dropdown">
                              <select class="form-control form-control-xs sort-option" name="sort_value">
                                <option <?= request()->sort_value == 'newest' ? ' selected' : '' ?> value="newest">{{ __('Sort by newest') }}</option>
                                <option <?= request()->sort_value == 'oldest' ? ' selected' : '' ?> value="oldest">{{ __('Sort by oldest') }}</option>
                              </select>
                          </div>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control form-control-xs" name="search" placeholder="Search your files" value="">
                    </div>
                    <div class="col-md-auto mt-3 mt-md-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary px-3 py-1">{{ __('Search') }}</button>
                    </div>
                </div>
            </form>
                <div class="card-block">
                    <div class="row">
                      @foreach($files as $file)
                        <div class="col-lg-2 col-sm-6">
                            <div class="thumbnail mb-4 border border-1 rounded position-relative">
                                <div class="position-absolute dropdown-list">
                                  <span class="dropdown-icon"  data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></span>
                                  <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="#" id="{{ $file->id }}" type="{{ $file->params['type'] }}" size="{{ $file->params['size'] }}" name="{{ $file->original_file_name }}" user="{{ isset($file->user) && !empty($file->user->name) ? $file->user->name : '' }}" time="{{ $file->created_at }}">
                                        <span class="mr-2"><i class="fa fa-info-circle"></i></span>
                                       {{ __('Details Info') }}</a>
                                        <a class="dropdown-item" href="{{ route('mediaManager.download', ['id' => $file->id]) }}">
                                        <span class="mr-2"><i class="fa fa-download"></i></span>
                                        {{ __('Download') }}</a>
                                        <a class="dropdown-item copy-link" data-url = "{{ $file->fileUrlNew(['id' => $file->id, 'type' => 'items']) }}" href="javascript:void(0)">
                                        <span class="mr-2"><i class="fa fa-copy"></i></span>
                                        {{ __('Copy Link') }}</a>
                                        <a class="dropdown-item delete-image" data-id="{{ $file->id }}" href="javascript:void(0)">
                                        <span class="mr-2"><i class="fa fa-trash"></i></span>
                                        {{ __('Delete') }}</a>
                                  </div>
                                </div>
                                <div class="thumb-{{ $file->id }}" id="modal-img-des-container">
                                      <img src="{{ $file->fileUrlNew(['id' => $file->id, 'type' => 'items']) }} " id="{{ $file->id }}" alt="" class="img-fluid img-thumbnail image-id p-4 upload-img-size">
                                </div>
                                <div class="pl-2 pb-1">
                                <p class="img-type">{{ isset($file->type) && !empty($file->type) ?  $file->type : '' }}<br>
                                <small>{{ isset($file->params['size']) && !empty($file->params['size']) ?  number_format((float) $file->params['size'], preference('decimal_digits'), '.', ',') : '' }} kb</small></p>
                                </div>
                                <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">{{ __('File Info') }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                                        <div>
                                            <div class="form-group">
                                              <label>{{ __('File Name') }}</label>
                                              <input type="text" class="form-control" id="file-name" value="" disabled="">
                                            </div>
                                            <div class="form-group">
                                              <label>{{ __('File Type') }}</label>
                                              <input type="text" class="form-control" id="file-type" value="" disabled="">
                                            </div>
                                            <div class="form-group">
                                              <label>{{ __('File Size') }}</label>
                                              <input type="text" class="form-control" id="file-size" value="" disabled="">
                                            </div>
                                            <div class="form-group">
                                              <label>{{ __('Uploaded By') }}</label>
                                              <input type="text" class="form-control" id="uploded-by" value="" disabled="">
                                            </div>
                                            <div class="form-group">
                                              <label>{{ __('Uploaded At') }}</label>
                                              <input type="text" class="form-control" id="uploded-date" value="" disabled="">
                                            </div>
                                            <div class="form-group text-center">
                                                  <a class="btn btn-secondary" href="{{ route('mediaManager.download', ['id' => $file->id]) }}" target="_blank" download="Group 1255.png">{{ __('Download') }}</a>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      @endforeach  
                    </div>    
                </div>
        </div>
        <div class="custom-pagination-brand-blue"> {{ $files->links() }} </div>
    </div>
   
@endsection
@section('js')
<script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/datta-able/plugins/fileupload/js/dropzone.min.js') }}"></script>
<script src="{{ asset('Modules/MediaManager/Resources/assets/js/media-manager.min.js') }}"></script>
@endsection
