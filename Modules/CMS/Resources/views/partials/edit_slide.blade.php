<div class="card card-info border-tl-radius-0 box-shadow-unset">
    <div class="card-body mt-neg-12">
        <form action="{{ route("slide.update", $slide->id) }}" method="post" class="form-horizontal">
            @csrf
            <div class="tab-content p-0 box-shadow-unset" id="topNav-v-pills-tabContent">
                {{-- Image and button --}}
                <div class="tab-pane fade" id="v-pills-image-and-button" role="tabpanel" aria-labelledby="v-pills-general-tab">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group row">
                                <label class="col-sm-3 text-left col-form-label">{{ __('Image') }}</label>
                                <div class="col-sm-8">
                                    <div data-toggle="modal" data-target="#exampleModalCenter" class="custom-file" data-val="single" id="image-status">
                                        <input class="custom-file-input form-control" name="attachment" id="validatedCustomFile" accept="image/*" >
                                        <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                                        <input type="hidden" name="file_id[]" value="{{ optional($slide->objectImage)->file_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_title"
                                    class="col-sm-3 text-left col-form-label">{{ __('Button Title') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="password" name="button_title" placeholder="{{ __('Button Title') }}" value="{{ $slide->button_title }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description"
                                    class="col-sm-3 text-left col-form-label">{{ __('Button Link') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="password" name="button_link" placeholder="{{ __('Button Link') }}" value="{{ $slide->button_link }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description"
                                    class="col-sm-3 text-left col-form-label">{{ __('Button Position') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="" name="button_position">
                                        <option {{ $slide->button_position == 'Left' ? 'selected' : '' }} value="Left">{{ __('Left')}}</option>
                                        <option {{ $slide->button_position == 'Right' ? 'selected' : '' }} value="Right">{{ __('Right')}}</option>
                                        <option {{ $slide->button_position == 'Center' ? 'selected' : '' }} value="Center">{{ __('Center')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label for="meta_description"
                                    class="col-sm-3 text-left col-form-label">{{ __('Slider') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="" name="slider_id">
                                        @foreach ($sliders as $key => $slider)
                                            <option value="{{ $slider->id }}" {{ $slider->id == $slide->slider_id ? 'selected' : '' }}>{{ $slider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Status" class="col-sm-3 col-form-label">{{ __('Open In New Window') }}</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="is_open_in_new_window" value="No">
                                    <div class="switch d-inline m-r-10">
                                        <input class="status" type="checkbox" value="Yes" name="is_open_in_new_window" id="is_private" {{$slide->is_open_in_new_window == 'Yes' ? 'checked' : ''}}>
                                        <label for="is_private" class="cr"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mt-neg-12" id="img-container">
                                <div class="fixSize user-img-con">
                                    <a class="cursor_pointer" href='{{ $slide->fileUrl() }}' data-lightbox="image-1"> <img class="profile-user-img img-responsive fixSize" src='{{ $slide->fileUrl() }}' alt="" class="img-thumbnail attachment-styles"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button data-id="v-pills-title-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Next') }}</button>
                                <button type="button" class="btn btn-primary form-submit custom-btn-small float-right" disabled>{{ __('Previous') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Title --}}
                <div class="tab-pane fade" id="v-pills-title" role="tabpanel" aria-labelledby="v-pills-title-tab">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="title_text" placeholder="{{ __('Title') }}" value="{{ $slide->title_text }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Size') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="title_font_size" placeholder="{{ __('Font Size') }}" value="{{ $slide->title_font_size }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Color') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="color" class="form-control" name="title_font_color" placeholder="{{ __('Font Color') }}" value="{{ $slide->title_font_color }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Direction') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="subtitle_anime" name="title_direction">
                                            <option {{ $slide->title_direction == 'left' ? 'selected' : '' }} value="left" >{{ __('Left') }}</option>
                                            <option {{ $slide->title_direction == 'right' ? 'selected' : '' }} value="right" >{{ __('Right') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Animation') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="title_animation" name="title_animation">
                                            @foreach ($animations as $key => $animation)
                                                <option value="{{ $animation }}" {{ $animation == $slide->title_animation ? 'selected' : '' }}>{{ $animation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Delay') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm" type="button">{{ __('Sec') }}</button>
                                        </div>
                                        <input type="text" placeholder="0.5" class="form-control positive-float-number" name="title_delay"
                                            value="{{ $slide->title_delay }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button data-id="v-pills-sub-title-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Next') }}</button>
                                <button data-id="v-pills-general-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Previous') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sub Title --}}
                <div class="tab-pane fade" id="v-pills-sub-title" role="tabpanel" aria-labelledby="v-pills-sub-title-tab">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="sub_title_text" placeholder="{{ __('Title') }}" value="{{ $slide->sub_title_text }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Size') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="sub_title_font_size" placeholder="{{ __('Font Size') }}" value="{{ $slide->sub_title_font_size }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Color') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="color" class="form-control" name="sub_title_font_color" placeholder="{{ __('Font Color') }}" value="{{ $slide->sub_title_font_color }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Direction') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="subtitle_anime" name="sub_title_direction">
                                            <option {{ $slide->sub_title_direction == 'left' ? 'selected' : '' }} value="left" >{{ __('Left') }}</option>
                                            <option {{ $slide->sub_title_direction == 'right' ? 'selected' : '' }} value="right" >{{ __('Right') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Animation') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="sub_title_animation" name="sub_title_animation">
                                            @foreach ($animations as $key => $animation)
                                                <option value="{{ $animation }}" {{ $animation == $slide->sub_title_animation ? 'selected' : '' }}>{{ $animation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Delay') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm" type="button">{{ __('Sec') }}</button>
                                        </div>
                                        <input type="text" placeholder="0.5" class="form-control positive-float-number" name="sub_title_delay"
                                            value="{{ $slide->sub_title_delay }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button data-id="v-pills-description-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Next') }}</button>
                                <button data-id="v-pills-title-tab" type="button" class="btn btn-primary form-submit custom-btn-small float-right switch-tab">{{ __('Previous') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Description --}}
                <div class="tab-pane fade" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="description_title_text" placeholder="{{ __('Title') }}" value="{{ $slide->description_title_text }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Size') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="description_title_font_size" placeholder="{{ __('Font Size') }}" value="{{ $slide->description_title_font_size }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Font Color') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="color" class="form-control" name="description_title_font_color" placeholder="{{ __('Font Color') }}" value="{{ $slide->description_title_font_color }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ __('Direction') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="subtitle_anime" name="description_title_direction">
                                            <option {{ $slide->description_title_direction == 'left' ? 'selected' : '' }} value="left" >{{ __('Left') }}</option>
                                            <option {{ $slide->description_title_direction == 'right' ? 'selected' : '' }} value="right" >{{ __('Right') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Animation') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" id="title_animation" name="description_title_animation">
                                            @foreach ($animations as $key => $animation)
                                                <option value="{{ $animation }}" {{ $animation == $slide->description_title_animation ? 'selected' : '' }}>{{ $animation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-14">
                                <div class="col-md-3">
                                    <label>{{ __('Delay') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm" type="button">{{ __('Sec') }}</button>
                                        </div>
                                        <input type="text" placeholder="0.5" class="form-control positive-float-number" name="description_title_delay"
                                            value="{{ $slide->description_title_delay }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary form-submit custom-btn-small float-right coupon-submit-button" id="footer-btn">{{ __('Save') }}</button>
                                <a href="{{ route('slider.index') }}" class="btn btn-primary form-submit custom-btn-small float-right coupon-submit-button">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
