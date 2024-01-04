    @php
        $collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $data = getComponentProperties($component ?? null);
    @endphp
    <div class="card dd-content {{ $editorClosed ?? 'card-hide' }}">
        <div class="card-body">
            <form action="{{ route('builder.update', ['id' => '__id']) }}" novalidate data-type="component"
                method="post" class="component_form" class="form-horizontal">
                @csrf
                @include('cms::hidden_fields')
                <div class="form-group row">
                    <label class="col-sm-3 control-label">{{ __('Upper Subtitle') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ builderGetValue($data, 'upper_st') }}"
                            name="upper_st">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{{ __('Lower Subtitle') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{ builderGetValue($data, 'lower_st') }}"
                            name="lower_st">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Main Title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control crequired" required
                            value="{{ builderGetValue($data, 'title') }}" name="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">{{ __('Button Options') }}</label>
                    <div class="col-sm-8 row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">{{ __('Text') }}</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control"
                                        value="{{ builderGetValue($data, 'btn_text') ?? '' }}" name="btn_text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-12 control-label">{{ __('Link') }}</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control"
                                        value="{{ builderGetValue($data, 'btn_link') ?? '' }}" name="btn_link">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row form-parent parent-class">
                    <label class="col-sm-3 control-label require">{{ __('Image') }}</label>
                    <div class="col-sm-8">
                        <div class="custom-file media-manager" data-returnType="ids" data-val="single"
                            id="image-status">
                            <input class="custom-file-input form-control is-image crequired" required name="image"
                                id="validatedCustomFile" maxlength="50" accept="image/*"
                                oninvalid="this.setCustomValidity({{ __('Please select an image.') }})"
                                value="{{ builderGetValue($data, 'image') }}">
                            <label class="custom-file-label overflow_hidden"
                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                        </div>
                        <div class="preview-image">
                            @if (builderGetValue($data, 'image'))
                                @include('mediamanager::image.uploded_image', [
                                    'files' => [$homeService->getImage(builderGetValue($data, 'image'), true)],
                                ])
                            @endif
                        </div>
                    </div>
                </div>
                @include('cms::pieces.submit-btn')
            </form>
        </div>
    </div>
