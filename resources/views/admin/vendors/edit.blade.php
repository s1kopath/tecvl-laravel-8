@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Vendor')]))
@section('css')
    {{-- Data table --}}
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
    {{-- Select2  --}}
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    {{-- LightBox  --}}
    <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
    {{-- Media manager --}}
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="vendor-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendors.index') }}">{{ __('Vendors') }} </a> >>{{ __('Edit :x', ['x' => __('Vendor')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('vendors.update', $vendors->id) . '?shop=' . $shop_exist }}" method="post" id="vandorAdd" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase">{{ __(':x Information',['x' => __('Vendor')]) }}</a>
                            </li>
                        </ul>
                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 control-label require">{{ __('Name') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" value="{{ $vendors->name }}" required maxlength="80" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 control-label require">{{ __('Email') }}</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $vendors->email }}" placeholder="{{ __('Email') }}" required maxlength="100" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-3 control-label require">{{ __('Phone') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Phone') }}" class="form-control phone-number" id="phone" name="phone" value="{{ $vendors->phone }}" required maxlength="45" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="formal_name" class="col-sm-3 control-label">{{ __('Formal Name') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="formal_name" name="formal_name"  placeholder="{{ __('Formal Name') }}" maxlength="100" value="{{ $vendors->formal_name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alias" class="col-sm-3 control-label">{{ __('Website') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="website" name="website"  placeholder="{{ __('Website') }}" maxlength="255" pattern="(http[s]?:\/\/)?(www\.)?([\.]?[a-z]+[a-zA-Z0-9\-]{1,})?[\.]?[a-z]+[a-zA-Z0-9\-]+\.[a-zA-Z]{2,5}([\.]?[a-zA-Z]{2,5})?" data-pattern="{{ __('Enter a valid :x.', [ 'x' => __('URL')]) }}" value="{{ $vendors->website }}">
                                            </div>
                                        </div>
                                        @if(!empty($commission) && $commission->is_active == 1)
                                        <div class="form-group row">
                                            <label for="sell_commissions" class="col-sm-3 control-label">{{ __('Commission') }}(%)</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control positive-float-number" id="sell_commissions" name="sell_commissions" value="{{ formatCurrencyAmount($vendors->sell_commissions) }}" max="100" data-max="{{ __('The value not more than be :x', ['x' => 100]) }}">
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <label for="Status" class="col-sm-3 control-label require">{{ __('Status') }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="Pending" {{ $vendors->status == "Pending" ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                                    <option value="Active" {{ $vendors->status == "Active" ? 'selected' : ''}}>{{ __('Active') }}</option>
                                                    <option value="Inactive" {{ $vendors->status == "Inactive" ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">{{ __('Picture') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file" data-val="single" id="image-status">
                                                    <label class="custom-file-label overflow_hidden" for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="divNote">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9" id='note_txt_1'>
                                                <div class="d-flex">
                                                    <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                    <ul>
                                                        <li>{{ __('Allowed File Extensions: jpg, png, gif, bmp') }}</li>
                                                        <li>{{ __('Maximum File Size :x', ['x' => preference('file_size') . 'MB']) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-9">
                                                <div class="fixSize">
                                                    <a class="cursor_pointer" href='{{ $vendors->fileUrl() }}'  data-lightbox="image-1"> <img class="profile-user-img img-responsive fixSize" src='{{ $vendors->fileUrl() }}' alt="" class="img-thumbnail attachment-styles"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10 px-0 m-l-5">
                                    <button class="btn btn-primary custom-btn-small" type="submit" id="btnSubmit"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                                    <a href="{{ request('shop') ? route('shop.index') : route('vendors.index') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12" id="vendor-shop-list-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendors.index') }}">{{ __('Vendor') }} </a> >>{{ __('Shops') }}</h5>
                @if (in_array('Modules\Shop\Http\Controllers\ShopController@create', $prms))
                    <div class="card-header-right d-inline-block">
                        <a href="{{ route('shop.create') . '?vendor_id=' . $vendors->id }}" class="btn btn-outline-primary custom-btn-small">
                        <span class="fa fa-plus"> &nbsp;</span>{{ __('Add :x', ['x' =>__('Shop')]) }}
                        </a>
                    </div>
                @endif

            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="shop-tab" data-toggle="tab" href="#shop" role="tab" aria-controls="home" aria-selected="true">{{ __('Shops') }}</a>
                        </li>
                    </ul>
                    <div class="col-sm-12 tab-content" id="myTabContent">

                        <div class="tab-pane fade active show list-container" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                            <div class="card-body p-0">
                                <div class="pt-2">
                                    <div class="table-responsive" id="shop-table">
                                        <table id="dataTableBuilder" class="table table-bordered table-hover table-striped dt-responsive w-100">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Shop Name') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Website') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Address') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                @if (array_intersect(['Modules\Shop\Http\Controllers\ShopController@edit', 'Modules\Shop\Http\Controllers\ShopController@destroy'], $prms))
                                                    <th width="5%">{{ __('Action') }}</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shops as $shop)
                                                    <tr>
                                                        <td><a href="{{ route('shop.edit', ['id' => $shop->id]) . '?vendor=true' }}">{!! wrapIt($shop->name, 10, ['columns' => 5]) !!}</a></td>
                                                        <td>{{ wrapIt($shop->email, 20, ['columns' => 5]) }}</td>
                                                        <td>{{ wrapIt($shop->website, 20, ['columns' => 5]) }}</td>
                                                        <td>{{ wrapIt($shop->phone, 15, ['columns' => 5]) }}</td>
                                                        <td>{{ wrapIt($shop->address, 10, ['columns' => 5]) }}</td>
                                                        <td>
                                                            @if($shop->status == 'Active')
                                                                <span class="badge theme-bg text-white f-12">{{ __('Active') }}</span>
                                                            @else
                                                                <span class="badge theme-bg2 text-white f-12">{{ __('Inactive') }}</span>
                                                            @endif
                                                        </td>
                                                        @if (array_intersect(['Modules\Shop\Http\Controllers\ShopController@edit', 'Modules\Shop\Http\Controllers\ShopController@destroy'], $prms))
                                                            <td>
                                                                @if (in_array('Modules\Shop\Http\Controllers\ShopController@edit', $prms))
                                                                    <a title="{{ __('Edit :x', ['x' => __('Shop')]) }}" href="{{ route('shop.edit', ['id' => $shop->id, 'vendor' => true]) }}" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>
                                                                @endif

                                                                @if (in_array('Modules\Shop\Http\Controllers\ShopController@destroy', $prms))
                                                                    <form method="post" action="{{ route('shop.destroy', ['id' => $shop->id]) . '?vendor_id=' . $vendors->id }}" id="delete-shops-{{ $shop->id }}" accept-charset="UTF-8" class="display_inline">
                                                                        @csrf
                                                                        <button title="{{ __('Delete :x', ['x' => __('Shop')]) }}" class="btn btn-xs btn-danger" type="button" data-id='{{ $shop->id }}' data-label="Delete" data-delete="shops" data-toggle="modal" data-target="#confirmDelete" data-title="{{ __('Delete :x', ['x' => __('Shop')]) }}" data-message="{{ __('Are you sure to delete this?') }}">
                                                                            <i class="feather icon-trash-2"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.includes.delete-modal')
    @include('mediamanager::image.modal_image')

@endsection

@section('js')
    <script type="text/javascript">
        "use strict";
        var vendor_id = '{{ isset($shops[0]->vendor_id) ? $shops[0]->vendor_id : null }}';
        var pdf = "{{ (in_array('Modules\Shop\Http\Controllers\ShopController@shopPdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('Modules\Shop\Http\Controllers\ShopController@shopCsv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset('public/dist/plugins/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{ asset('public/dist/js/custom/common.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/vendors.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/fileupload/js/dropzone.min.js') }}"></script>
@endsection
