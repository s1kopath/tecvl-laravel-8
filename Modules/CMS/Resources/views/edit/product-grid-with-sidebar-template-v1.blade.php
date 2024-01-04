    @php
        $collapse__id = 'collapse_' . randomString();
        $switch_id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $component = $component ?? null;
        $data = getComponentProperties($component);
        $component = $component ?? null;
    @endphp
    <div class="card dd-content {{ $editorClosed ?? 'card-hide' }}">
        <div class="card-body">
            <form class="form-parent component_form" action="{{ route('builder.update', ['id' => '__id']) }}"
                novalidate data-type="component" method="post">
                @csrf
                @include('cms::hidden_fields')
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                            value="{{ componentValue($component, 'title') ?? '' }}" name="title" required>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-md-3 control-label">{{ __('Options') }}</label>
                    <div class="col-md-8">
                        <div class="row parent-class m-0 p-0">
                            <div class="col-md-3">
                                <input type="hidden" name="see_more" value="0">
                                <div class="form-group">
                                    <div class="switch d-inline m-r-10">
                                        <label class="control-label">{{ __('See More') }}</label>
                                        <input class="seeMore" type="checkbox" value="1" id="{{ $switch_id }}"
                                            name="see_more"
                                            {{ builderGetValue($data, 'see_more') == 1 ? 'checked' : '' }}>
                                        <label for="{{ $switch_id }}" class="cr"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 moreLink {{ componentValue($component, 'see_more', 'd-none') }}">
                                <div class="form-group row ">
                                    <label class="col-sm-12 control-label require">{{ __('More Link') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control more-link {{ componentValue($component, 'see_more') ? 'crequired' : '' }}"
                                            value="{{ builderGetValue($data, 'more_link') ?? '' }}"
                                            {{ componentValue($component, 'see_more') ? 'required' : '' }}
                                            name="more_link">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-md-12 control-label require">{{ __('Sidebar') }}</label>
                                    <div class="col-sm-12">
                                        <select name="sidebar" class="form-control sidebar_options select3 crequired"
                                            required>
                                            <option value="0">{{ __('No Sidebar') }}</option>
                                            <option
                                                {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'slider' ? 'selected' : '' }}
                                                value="slider">{{ __('Slider') }}</option>
                                            <option
                                                {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'slide' ? 'selected' : '' }}
                                                value="slide">{{ __('Slide') }}</option>
                                            <option
                                                {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'flash_sale' ? 'selected' : '' }}
                                                value="flash_sale">{{ __('Flash Sale Item') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-3 sidebarOption {{ componentValue($component, 'sidebar') ? '' : 'd-none' }}">
                                <div class="form-group row">
                                    <label class="col-md-12 control-label require">{{ __('Position') }}</label>
                                    <div class="col-sm-12">
                                        <select name="sidebar_position"
                                            class="form-control select3 sidebar-position {{ componentValue($component, 'sidebar') ? 'crequired' : '' }}"
                                            {{ componentValue($component, 'sidebar') ? 'required' : '' }}>
                                            <option
                                                {{ $data && isset($data['sidebar_position']) && $data['sidebar_position'] == 'left' ? 'selected' : '' }}
                                                value="left">{{ __('Left') }}</option>
                                            <option
                                                {{ $data && isset($data['sidebar_position']) && $data['sidebar_position'] == 'right' ? 'selected' : '' }}
                                                value="right">{{ __('Right') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Showcase Data') }}</label>
                    <div class="col-sm-8">
                        <select name="showcase_type" class="form-control select3 crequired" required>
                            @foreach (\Modules\CMS\Utility\CMSUtility::productTypes() as $key => $value)
                                <Option
                                    {{ componentValue($component ?? null, 'showcase_type') == $key ? 'selected' : '' }}
                                    value="{{ $key }}">{{ $value }}</Option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group row form-parent bannerOptions"
                    style="display: {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'slide' ? 'flex' : 'none' }};">
                    <label class="col-md-3 control-label require">{{ __('Slide') }}</label>
                    <div class="col-md-8">
                        <div class="form-group parent-class row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            value="{{ $data && isset($data['u_subtitle_slide']) ? $data['u_subtitle_slide'] : '' }}"
                                            name="u_subtitle_slide">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            value="{{ $data && isset($data['l_subtitle_banner']) ? $data['l_subtitle_banner'] : '' }}"
                                            name="l_subtitle_banner">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label">{{ __('Title') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control has-image"
                                            value="{{ $data && isset($data['title_banner']) ? $data['title_banner'] : '' }}"
                                            name="title_banner">
                                        <div class="d-flex mt-2 mb-3">
                                            <span class="badge badge-danger h-100 mt-1">Note!</span>
                                            <small
                                                class="mt-1 ml-2">{{ __("Please leave the title empty if you don't want to show the banner.") }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label require">{{ __('Image') }}</small></label>
                                    <div class="col-sm-12 image-box">
                                        <div class="custom-file media-manager" data-returnType="ids" data-val="single"
                                            id="image-status">
                                            <input
                                                class="custom-file-input form-control is-image {{ componentValue($component, 'title_banner') ? 'crequired' : '' }}"
                                                name="image_banner"
                                                {{ componentValue($component, 'title_banner') ? 'required' : '' }}
                                                id="validatedCustomFile" maxlength="50" accept="image/*"
                                                value="{{ builderGetValue($data, 'image_banner') }}"
                                                oninvalid="this.setCustomValidity({{ __('Please select an image.') }})">
                                            <label class="custom-file-label overflow_hidden"
                                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                                            <div class="d-flex mt-2 mb-3">
                                                <span class="badge badge-danger h-100 mt-1">Note!</span>
                                                <small
                                                    class="mt-1 ml-2">{{ __('Required only if title is not empty.') }}</small>
                                            </div>
                                        </div>
                                        <div class="preview-image">
                                            @if (builderGetValue($data, 'image_banner'))
                                                @include('cms::pieces.uploded_image', [
                                                    'files' => [$homeService->getImage(builderGetValue($data, 'image_banner'), true)],
                                                ])
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            value="{{ $data && isset($data['button_banner']) ? $data['button_banner'] : '' }}"
                                            name="button_banner">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label">{{ __('Link') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            value="{{ $data && isset($data['link_banner']) ? $data['link_banner'] : '' }}"
                                            name="link_banner">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row form-parent sliderOptions"
                    style="display: {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'slider' ? 'flex' : 'none' }};">
                    <label class="col-md-3 control-label require">{{ __('Slider') }}</label>
                    <div class="col-md-8">
                        <div class="accordion" id="accordionExample">
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingOne">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Slider #1') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class=" card-body collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['u_subtitle_slider1']) ? $data['u_subtitle_slider1'] : '' }}"
                                                        name="u_subtitle_slider1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['l_subtitle_slider1']) ? $data['l_subtitle_slider1'] : '' }}"
                                                        name="l_subtitle_slider1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row parent-class m-0 p-0">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-12 control-label require">{{ __('Title') }}</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-image crequired"
                                                            required
                                                            value="{{ $data && isset($data['title_slider1']) ? $data['title_slider1'] : '' }}"
                                                            name="title_slider1">
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
                                                                class="custom-file-input form-control  is-image crequired"
                                                                name="image_slider1" id="validatedCustomFile"
                                                                maxlength="50" accept="image/*"
                                                                {{ componentValue($component, 'title_slider1') ? 'required' : '' }}
                                                                value="{{ builderGetValue($data, 'image_slider1') }}"
                                                                oninvalid="this.setCustomValidity({{ __('Please select an image.') }})">
                                                            <label class="custom-file-label overflow_hidden"
                                                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                        </div>
                                                        <div class="preview-image">
                                                            @if (builderGetValue($data, 'image_slider1'))
                                                                @include('cms::pieces.uploded_image', [
                                                                    'files' => [$homeService->getImage(builderGetValue($data, 'image_slider1'), true)],
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['button_slider1']) ? $data['button_slider1'] : '' }}"
                                                        name="button_slider1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 control-label">{{ __('Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['link_slider1']) ? $data['link_slider1'] : '' }}"
                                                        name="link_slider1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingTwo">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Slider #2') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class="collapse card-body" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['u_subtitle_slider2']) ? $data['u_subtitle_slider2'] : '' }}"
                                                        name="u_subtitle_slider2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['l_subtitle_slider2']) ? $data['l_subtitle_slider2'] : '' }}"
                                                        name="l_subtitle_slider2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row parent-class m-0 p-0">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 control-label">{{ __('Title') }}</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-image"
                                                            value="{{ $data && isset($data['title_slider2']) ? $data['title_slider2'] : '' }}"
                                                            name="title_slider2">
                                                        <div class="d-flex mt-2 mb-3">
                                                            <span class="badge badge-danger h-100 mt-1">Note!</span>
                                                            <small class="mt-1 ml-2">Please leave the title empty
                                                                if you don't want
                                                                to show the
                                                                banner.</small>
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
                                                                name="image_slider2" id="validatedCustomFile"
                                                                maxlength="50" accept="image/*" required
                                                                {{ componentValue($component, 'title_slider2') ? 'required' : '' }}
                                                                value="{{ builderGetValue($data, 'image_slider2') }}"
                                                                oninvalid="this.setCustomValidity({{ __('Please select an image.') }})">
                                                            <label class="custom-file-label overflow_hidden"
                                                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                        </div>
                                                        <div class="preview-image">
                                                            @if (builderGetValue($data, 'image_slider2'))
                                                                @include('cms::pieces.uploded_image', [
                                                                    'files' => [$homeService->getImage(builderGetValue($data, 'image_slider2'), true)],
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['button_slider2']) ? $data['button_slider2'] : '' }}"
                                                        name="button_slider2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 control-label">{{ __('Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['link_slider2']) ? $data['link_slider2'] : '' }}"
                                                        name="link_slider2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header p-2" id="headingThree">
                                    <div class="mb-0 ac-switch collapsed d-flex closed justify-content-between align-items-center w-full curson-pointer"
                                        data-toggle="collapse" data-target="#{{ $ac = 'ac' . randomString() }}"
                                        aria-expanded="true" aria-controls="{{ $ac }}">
                                        <div>{{ __('Slider #3') }}</div>
                                        <span class="b-icon">
                                            <i class="feather icon-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="{{ $ac }}" class="card-body collapse"
                                    aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Upper Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['u_subtitle_slider3']) ? $data['u_subtitle_slider3'] : '' }}"
                                                        name="u_subtitle_slider3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label ">{{ __('Lower Subtitle') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['l_subtitle_slider3']) ? $data['l_subtitle_slider3'] : '' }}"
                                                        name="l_subtitle_slider3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row parent-class m-0 p-0">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-12 control-label ">{{ __('Title') }}</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-image"
                                                            value="{{ $data && isset($data['title_slider3']) ? $data['title_slider3'] : '' }}"
                                                            name="title_slider3">
                                                        <div class="d-flex mt-2 mb-3">
                                                            <span
                                                                class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                            <small
                                                                class="mt-1 ml-2">{{ __("Please leave the title empty if you don't want to show the banner.") }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-12 control-label">{{ __('Image') }}</label>

                                                    <div class="col-sm-12">
                                                        <div class="custom-file media-manager" data-returnType="ids"
                                                            data-val="single" id="image-status">
                                                            <input
                                                                class="custom-file-input is-image form-control crequired"
                                                                name="image_slider3" id="validatedCustomFile"
                                                                maxlength="50" accept="image/*"
                                                                {{ componentValue($component, 'title_slider1') ? 'required' : '' }}
                                                                value="{{ builderGetValue($data, 'image_slider3') }}"
                                                                oninvalid="this.setCustomValidity({{ __('Please select an image.') }})">
                                                            <label class="custom-file-label overflow_hidden"
                                                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                        </div>
                                                        <div class="preview-image">
                                                            @if (builderGetValue($data, 'image_slider3'))
                                                                @include('cms::pieces.uploded_image', [
                                                                    'files' => [$homeService->getImage(builderGetValue($data, 'image_slider3'), true)],
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-12 control-label">{{ __('Button Text') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['button_slider3']) ? $data['button_slider3'] : '' }}"
                                                        name="button_slider3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 control-label">{{ __('Link') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        value="{{ $data && isset($data['link_slider3']) ? $data['link_slider3'] : '' }}"
                                                        name="link_slider3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row form-parent flashOptions"
                    style="display: {{ $data && isset($data['sidebar']) && $data['sidebar'] == 'flash_sale' ? 'flex' : 'none' }};">
                    <label class="col-md-3 control-label require">{{ __('Banner') }}</label>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label require">{{ __('Badge Text') }}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control crequired"
                                            value="{{ $data && isset($data['badge_text']) ? $data['badge_text'] : '' }}"
                                            required name="badge_text">
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
