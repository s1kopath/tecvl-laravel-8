<?php 
$files = App\Models\File::getAllFiles();
  ?>
<div id="MyPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
                <h4 class="modal-title">
                </h4>
            </div>
            <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- [ Gallery-Grid ] start -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                  @foreach($files as $file)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="thumbnail mb-4">
                                            <div class="thumb-{{ $file->id }}">
                                                    <img src="{{ $file->fileUrlNew(['id' => $file->id]) }}" id="{{ $file->id }}" alt="" class="img-fluid img-thumbnail image-id">
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-0">
                      <div class="form-group row">
                          <label for="btn_save" class="col-sm-3 control-label"></label>
                          <div class="col-sm-12">
                              <button type="button"
                                      class="btn btn-primary custom-btn-small select-image float-right">{{ __('Submit') }}</button>
                              <button type="button" class="btn btn-secondary custom-btn-small float-right"
                                      data-dismiss="modal">{{ __('Close') }}</button>
                          </div>
                      </div>
                  </div>
                    <!-- [ Gallery-Grid ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
        </div>
    </div>
</div>