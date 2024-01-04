@extends('admin.layouts.app')
@section('page_title', 'CMS')
@section('content')

    <!-- Main content -->
    <div class="col-sm-12 list-container" id="coupon-list-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('page.home') }}">{{ 'Homepages' }}</a></h5>
                <div class="card-header-right d-inline-block">
                    @if (in_array('Modules\CMS\Http\Controllers\CMSController@create', $prms))
                        <a href="{{ route('page.home.create') }}" class="btn btn-outline-primary custom-btn-small">
                            <span class="fa fa-plus"> &nbsp;</span>{{ __('New Homepage') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body px-0">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12 row m-0 p-0">
                        @forelse ($pages as $page)
                            <div class="col-12 col-sm-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="card-title text-editable d-flex justify-content-between">
                                            <h5>{{ $page->name }}
                                            </h5>
                                            <span class="header-btn folding editable" data-id="{{ $page->id }}"
                                                data-toggle="tooltip" data-placement="top" title="{{ __('Quick edit') }}"
                                                data-original-title="{{ __('Quick edit') }}">
                                                <i class="feather icon-edit-2"></i>
                                            </span>
                                        </div>
                                        @if ($page->default)
                                            <span class="badge badge-success">{{ __('Default') }}</span>
                                        @else
                                            @if ($page->status == 'Active')
                                                <span class="badge badge-info">{{ $page->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $page->status }}</span>
                                            @endif
                                        @endif
                                        <p class="card-text">
                                        <dl class="dl-horizontal row">
                                            <dt class="col-12">{{ __('Meta Informations') }}:</dt>
                                            <dt class="col-sm-4">{{ __('Title') }}</dt>
                                            <dd class="col-sm-8">{{ formatString($page->meta_title, 40) }}</dd>
                                            <dt class="col-sm-4">{{ __('Description') }}</dt>
                                            <dd class="col-sm-8">{{ formatString($page->meta_description) }}</dd>
                                        </dl>
                                        </p>
                                        <div class="header-btns">
                                            <a href="{{ route('site.page', $page->slug) }}" target="_blank"
                                                class="header-btn folding closed btn-primary hw-1-8rem"
                                                data-toggle="tooltip" data-placement="top" title="{{ __('View page') }}"
                                                data-original-title="{{ __('View page') }}">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                            <a href="{{ route('page.home.edit', $page->slug) }}"
                                                class="header-btn folding closed btn-primary hw-1-8rem"
                                                data-toggle="tooltip" data-placement="top" title="{{ __('Edit page') }}"
                                                data-original-title="{{ __('Edit page') }}">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                            <a href="{{ route('builder.edit', $page->slug) }}" target="_blank"
                                                class="header-btn folding closed btn-primary hw-1-8rem"
                                                data-toggle="tooltip" data-placement="top"
                                                title="{{ __('Edit with pagebuilder') }}"
                                                data-original-title="{{ __('Edit it pagebuilder') }}">
                                                <i class="feather icon-grid"></i>
                                            </a>
                                            <span class="header-btn delete-button hw-1-8rem" data-toggle="tooltip"
                                                data-id="{{ $page->id }}" data-toggle="modal" data-placement="top"
                                                title="{{ __('Delete page') }}"
                                                data-original-title="{{ __('Delete page') }}">
                                                <i class="feather icon-trash-2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{ __('No pages available.') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('cms::pieces.delete-modal')

    <div id="updatePage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatePageLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">{{ __('Update page') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer d-block">
                    <form method="post" action="{{ route('page.update', ['id' => '__id__']) }}" id="updatePageFrom">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3" for="pageName">{{ __('Name') }}</label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" required name="name" id="pageName"
                                    placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3" for="PageSlug">{{ __('Slug') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" class="form-control" required id="pageSlug"
                                    placeholder="Slug">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 mt-2" for="status">{{ __('Status') }}</label>
                            <div class="col-sm-9">
                                <input name="status" type="hidden" value="Inactive">
                                <div class="switch d-inline">
                                    <input name="status" class="status_c" type="checkbox" id="switch-1" value="Active"
                                        checked="">
                                    <label for="switch-1" class="cr"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 mt-2" for="default">{{ __('Default') }}</label>
                            <div class="col-sm-9 d-flex">
                                <input name="default" type="hidden" value="0">
                                <div class="switch d-inline mt-4">
                                    <input name="default" class="default_c" type="checkbox" id="switch-2" value="1"
                                        checked="">
                                    <label for="switch-2" class="cr"></label>
                                </div>
                                <div class="mt-2">
                                    <span class="badge badge-danger mt-1">Note!</span>
                                    <small class="mt-1 ml-2">Status must be active to make it default.</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-secondary btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </form>
                    <span class="ajax-loading"></span>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link href="{{ asset('Modules/CMS/Resources/assets/css/draganddrop.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('Modules/CMS/Resources/assets/js/app.min.js') }}"></script>
    <script>
        let tempId;
        let pages = {!! json_encode($pages->toArray()) !!};
        const updateForm = $('#updatePageFrom');
        let updatePageUrl = "{{ route('page.update', ['id' => '__id__']) }}";
        let deletePageUrl = "{{ route('page.delete', ['id' => '__id__']) }}";

        $('.editable').click(function() {
            tempId = $(this).data('id');
            let page = pages.find(page => page.id == tempId);
            updateFormFields(updateForm, page, [{
                    id: '#pageName',
                    type: 'val',
                    key: 'name'
                },
                {
                    id: '#pageSlug',
                    type: 'val',
                    key: 'slug'
                },
                {
                    id: '#switch-1',
                    type: 'prop',
                    key: 'status',
                    val: 'Active'
                },
                {
                    id: '#switch-2',
                    type: 'prop',
                    key: 'default',
                    val: 1
                }
            ]);
            updateForm.attr('action', updatePageUrl.replace('__id__', tempId));
            $('#updatePage').modal('show');
        })
    </script>
@endsection
