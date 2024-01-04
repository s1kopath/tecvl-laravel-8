<div id="modal-img-des-container"  class="d-flex flex-wrap justify-content-start mt-3">
  @if(!empty($files))
  @foreach($files as $file)
   <div class="modal-img-des border border-1 rounded ml-3 mb-3" id="{{ $file->id }}">
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ $file->fileUrlNew(['id' => $file->id, 'type' => 'items']) }}" alt="Card image cap">
      </div>
      <div class="card-body">
        <p class="m-0 font-weight-bold">{{ isset($file->params) && !empty($file->params['type']) ?  $file->params['type'] : '' }}</p>
        <small>{{ isset($file->params) && !empty($file->params['size']) ?  $file->params['size'] : '' }} {{ __('kb') }}</small>
      </div>
   </div>
   @endforeach
   @endif
</div>