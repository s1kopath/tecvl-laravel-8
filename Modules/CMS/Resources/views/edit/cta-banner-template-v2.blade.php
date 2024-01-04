    @php
        $collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $data = getComponentProperties($component ?? null);
        $switch_id = 'switch_' . \Modules\CMS\Utility\CMSUtility::randomStr();
    @endphp
    <div class="card dd-content {{ $editorClosed ?? 'card-hide' }}">
        <div class="card-body">
            <form action="{{ route('builder.update', ['id' => '__id']) }}" data-type="component" method="post"
                class="component_form form-parent" novalidate>
                @csrf
                @include('cms::hidden_fields')
                <div class="form-group row">
                    <label class="col-md-3 control-label require">{{ __('CTA Options') }}</label>
                    <div class="col-md-8">
                        <div class="accordion" id="accordionExample">
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingOne">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Call To Action #1') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class=" card-body collapse parent-class"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'upper_st1') }}"
                                                        name="upper_st1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'lower_st1') }}"
                                                        name="lower_st1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label require">{{ __('Title') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control crequired has-image" required
                                                        value="{{ builderGetValue($data, 'title_1') }}"
                                                        name="title_1">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label require">{{ __('Image') }}</label>
                                                <div class="col-md-12">
                                                    <div class="custom-file media-manager" data-returnType="ids"
                                                        data-val="single" id="image-status">
                                                        <input class="custom-file-input form-control is-image crequired"
                                                            {{ builderGetValue($data, 'title_1') ? 'required' : '' }}
                                                            name="image1" id="validatedCustomFile" maxlength="50"
                                                            accept="image/*"
                                                            value="{{ builderGetValue($data, 'image1') }}">
                                                        <label class="custom-file-label overflow_hidden"
                                                            for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                    </div>
                                                    <div class="preview-image">
                                                        @if (builderGetValue($data, 'image1'))
                                                            @include('mediamanager::image.uploded_image', [
                                                                'files' => [$homeService->getImage(builderGetValue($data, 'image1'), true)],
                                                            ])
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-4 mb-3">
                                                <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                <small
                                                    class="mt-1 ml-2">{{ __('Only required if you add the title.') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_text1') }}"
                                                        name="btn_text1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_link1') }}"
                                                        name="btn_link1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingOne">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Call To Action #2') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class=" card-body collapse parent-class"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'upper_st2') }}"
                                                        name="upper_st2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'lower_st2') }}"
                                                        name="lower_st2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label require">{{ __('Title') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'title_2') }}"
                                                        name="title_2">
                                                    <div class="d-flex mt-2 mb-3">
                                                        <span class="badge badge-danger h-100 mt-1">Note!</span>
                                                        <small
                                                            class="mt-1 ml-2">{{ __("Please leave the title empty if you don't want to show the slide.") }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 control-label">{{ __('Image') }}</label>
                                                <div class="col-sm-12">
                                                    <div class="custom-file media-manager" data-returnType="ids"
                                                        data-val="single" id="image-status">
                                                        <input class="custom-file-input form-control is-image crequired"
                                                            name="image2" id="validatedCustomFile" maxlength="50"
                                                            accept="image/*"
                                                            {{ builderGetValue($data, 'title_2') ? 'required' : '' }}
                                                            value="{{ builderGetValue($data, 'image2') }}">
                                                        <label class="custom-file-label overflow_hidden"
                                                            for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                    </div>
                                                    <div class="preview-image">
                                                        @if (builderGetValue($data, 'image2'))
                                                            @include('mediamanager::image.uploded_image', [
                                                                'files' => [$homeService->getImage(builderGetValue($data, 'image2'), true)],
                                                            ])
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-4 mb-3">
                                                <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                <small
                                                    class="mt-1 ml-2">{{ __('Only required if you add the title.') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_text2') }}"
                                                        name="btn_text2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_link2') }}"
                                                        name="btn_link2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingOne">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Call To Action #3') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class=" card-body collapse parent-class"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'upper_st3') }}"
                                                        name="upper_st3">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'lower_st3') }}"
                                                        name="lower_st3">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label require">{{ __('Title') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control has-image"
                                                        value="{{ builderGetValue($data, 'title_3') }}"
                                                        name="title_3">
                                                    <div class="d-flex mt-2 mb-3">
                                                        <span class="badge badge-danger h-100 mt-1">Note!</span>
                                                        <small
                                                            class="mt-1 ml-2">{{ __("Please leave the title empty if you don't want to show the slide.") }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 control-label">{{ __('Image') }}</label>
                                                <div class="col-sm-12">
                                                    <div class="custom-file media-manager" data-returnType="ids"
                                                        data-val="single" id="image-status">
                                                        <input
                                                            class="custom-file-input form-control is-image crequired"
                                                            name="image3"
                                                            {{ builderGetValue($data, 'title_3') ? 'required' : '' }}
                                                            id="validatedCustomFile" maxlength="50" accept="image/*"
                                                            value="{{ builderGetValue($data, 'image3') }}">
                                                        <label class="custom-file-label overflow_hidden"
                                                            for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                    </div>
                                                    <div class="preview-image">
                                                        @if (builderGetValue($data, 'image3'))
                                                            @include('mediamanager::image.uploded_image', [
                                                                'files' => [$homeService->getImage(builderGetValue($data, 'image3'), true)],
                                                            ])
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-4 mb-3">
                                                <span
                                                    class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                <small
                                                    class="mt-1 ml-2">{{ __('Only required if you add the title.') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_text3') }}"
                                                        name="btn_text3">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ builderGetValue($data, 'btn_link3') }}"
                                                        name="btn_link3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @include('cms::pieces.submit-btn')
            </form>
        </div>
    </div>
