@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Pages')]))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/summer-note/summernote.min.css') }}">
@endsection
@section('content')
    <div class="col-sm-12" id="page-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('page.create') }}">{{ isset($isHome) ? __('Homepage') : __('Page') }}</a> >> <a
                        href="{{ route('site.page', $page->slug) }}">{{ $page->name }}</a> >> {{ __('Edit') }}</h5>
            </div>
            <div class="card-body p-0" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Page')]) }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">{{ __('SEO Fields') }}</a>
                        </li>
                    </ul>
                    <form action='{{ route('page.update', $page->id) }}' method="post" class="form-horizontal"
                        id="userEdit" enctype="multipart/form-data">

                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <input type="hidden" value="{{ $page->id }}" name="id">
                                <input type="hidden" name="type" value="{{ $page->type }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label require pr-0">{{ __('Name') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control"
                                                    id="name" name="name" required minlength="3"
                                                    value="{{ !empty(old('name')) ? old('name') : $page->name }}"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Name'), 'x' => 10]) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label require pr-0">{{ __('Slug') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="{{ __('Slug') }}" class="form-control"
                                                    id="slug" name="slug" required minlength="3"
                                                    value="{{ !empty(old('name')) ? old('name') : $page->slug }}"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Name'), 'x' => 10]) }}">
                                            </div>
                                        </div>
                                        @if ($page->type != 'home')
                                            <div class="form-group row">
                                                <label for="description"
                                                    class="col-sm-2 col-form-label require pr-0">{{ __('Description') }}
                                                </label>
                                                <div class="col-sm-10 editor">
                                                    <textarea class="form-control description1 sm_note" required name="description"
                                                        id="summernote"> {{ $page->description }} </textarea>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label for="Status"
                                                class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="status" value="Inactive">
                                                <div class="switch d-inline m-r-10">
                                                    <input class="status status_c" type="checkbox" value="Active"
                                                        name="status" id="is_private"
                                                        {{ $page->status == 'Active' ? 'checked' : '' }}>
                                                    <label for="is_private" class="cr"></label>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($page->type == 'home')
                                            <div class="form-group row">
                                                <label for="Status"
                                                    class="col-sm-2 col-form-label">{{ __('Default') }}</label>
                                                <div class="col-sm-10 d-flex">
                                                    <input type="hidden" name="default" value="0">
                                                    <div class="switch d-inline m-r-10 mt-4">
                                                        <input class="is_private default_c" type="checkbox" value="1"
                                                            name="default" id="default"
                                                            {{ $page->default == 1 ? 'checked' : '' }}>
                                                        <label for="default" class="cr"></label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <span class="badge badge-danger mt-1">{{ __('Note') }}!</span>
                                                        <small
                                                            class="mt-1 ml-2">{{ __('Status must be active to make it default.') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="meta_title"
                                                class="col-sm-2 text-left col-form-label require">{{ __('Meta Title') }}</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" required id="password"
                                                    name="meta_title" placeholder="{{ __('Meta Title') }}"
                                                    value="{{ !empty(old('meta_title')) ? old('meta_title') : $page->meta_title }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="meta_description"
                                                class="col-sm-2 text-left col-form-label require">{{ __('Meta Description') }}</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" required
                                                    name="meta_description">{{ !empty(old('meta_description')) ? old('meta_description') : $page->meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">{{ __('Meta Image') }}</label>
                                            <div class="col-sm-8">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control" name="image"
                                                        id="validatedCustomFile" accept="image/*">
                                                    <label class="custom-file-label overflow_hidden"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <div class="fixSize">
                                                    <a class="cursor_pointer" href='{{ $page->fileUrl() }}'
                                                        data-lightbox="image-1"> <img
                                                            class="profile-user-img img-responsive fixSize"
                                                            src='{{ $page->fileUrl() }}' alt=""
                                                            class="img-thumbnail attachment-styles"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 px-0 m-l-5">
                                <button class="btn btn-primary custom-btn-small page-submit" type="submit"
                                    id="btnSubmit1">{{ __('Submit') }}</button>
                                <a href="{{ route(isset($isHome) ? 'page.home' : 'page.index') }}"
                                    class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
                                @if ($page->type == 'home')
                                    <a href="{{ route('builder.edit', ['slug' => $page->slug]) }}"
                                        class="btn btn-warning custom-btn-small">{{ __('Page Builder') }}</a>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/datta-able/plugins/summer-note/summernote.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('Modules/CMS/Resources/assets/js/page.min.js') }}"></script>
    <script src="{{ asset('Modules/CMS/Resources/assets/js/app.min.js') }}"></script>
@endsection
