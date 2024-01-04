@extends('vendor.layouts.app')
@section('page_title', __('Show :x', ['x' => __('Review')]))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="brand-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('review.index') }}">{{ __('Reviews') }} </a> >>{{ __('View') }}</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>{{ __(':x Information',['x' => __('Review')]) }}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Item') }} :</span>
                    <div class="col-sm-2">
                        <span class="mb-0">{{ optional($reviews->item)->name }}</span>
                    </div>
                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Rating') }} :</span>
                    <div class="col-sm-2">
                        <span class="mb-0">{{ $reviews->rating }}</span>
                    </div>
                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Reviewed By') }} :</span>
                    <div class="col-sm-2">
                        <span class="mb-0">{{ optional($reviews->user)->name }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Comment') }} :</span>
                    <div class="col-sm-10">
                        <span class="mb-0"> {{ $reviews->comments }} </span>
                    </div>
                </div>
            </div>
        </div>

        @if (count($files) > 0)
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Files') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row pt-4 pb-4 px-3">
                        @foreach ($files as $file)
                            @php
                                $url = url('public/dist/js/html5lightbox/no_preview.png?v'). $file->id;
                                $extra = '';
                                $div = '';
                                $fileName = !empty($file->original_file_name) ? $file->original_file_name : $file->file_name;
                                if (in_array($file->extension, array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'flv', 'webm', 'mp4', 'ogv', 'swf', 'm4v', 'ogg'))) {
                                  $url = url($filePath) .'/'. $file->file_name;
                                } elseif (in_array($file->extension, array('csv', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'txt'))) {
                                  $url = '#pdiv-'. $file->id;
                                  $extra = 'data-width=900 data-height=600';
                                  $div = '<div id="pdiv-'. $file->id .'" class="display_none">
                                            <div class="lightboxcontainer">
                                              <iframe width="100%" height="100%" src="//docs.google.com/gview?url='. url($filePath) .'/'. $file->file_name .'&embedded=true" frameborder="0" allowfullscreen></iframe>
                                              <div class="clear_both"></div>
                                            </div>
                                          </div>';
                                }
                            @endphp
                            <a <?= $extra ?> href="{{ $url }}" data-attachment="<?= $file->id; ?>" class="html5lightbox" title="{{ $fileName }}" data-group="{{ $reviews->item_id }}">
                                <div class="previewer-file-total-div">
                                    <div class="previewer-file-thumbnail-div">
                                        @if (in_array($file->extension, array('jpg', 'png', 'jpeg', 'gif')))
                                            <img class="previewer-thumbnail-size" src="{{ $url }}">
                                        @else
                                            <i class="{{ $file->icon }} center f-50 previewer-icon-position" style="color:{{ setColor($file->extension) }};" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <div class="previewer-file-name-div">
                                        <div>
                                            <i class="{{ $file->icon }} f-20" style="color:{{ setColor($file->extension) }};" aria-hidden="true"></i>
                                            <span class="f-12 previewer-file-name">{{ strlen($fileName) > 15 ? substr_replace($fileName, "..", 15) : $file->original_file_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?= $div ?>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('public/dist/js/html5lightbox/html5lightbox.js?v=1.0') }}"></script>
    <script src="{{ asset('public/dist/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/review.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
