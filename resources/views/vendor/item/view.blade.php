@extends('vendor.layouts.app')
@section('page_title', __('View :x', ['x' => __('Item')]))
@section('css')
    {{-- LightBox  --}}
    <link rel="stylesheet" href="{{asset('public/dist/plugins/lightbox/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.css') }}" type="text/css"/>
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="item-view-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendor.items') }}">{{ __('Items') }} </a> >>{{ __('View :x', ['x' => __('Item')]) }}</h5>
            </div>
            <div class="col-sm-12 m-t-20 form-tabs">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information', ['x' => __('Basic')]) }}</a>
                    </li>
                    @if(optional($item->itemDetail)->is_track_inventory == 1)
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="inventory-tab" data-toggle="tab" data-rel="" href="#inventory" role="tab" aria-controls="inventory" aria-selected="false">{{ __('Inventory') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" data-rel="" href="#option" role="tab" aria-controls="option" aria-selected="false">{{ __('Option') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" data-rel="" href="#related" role="tab" aria-controls="related" aria-selected="false">{{ __('Related Items') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" data-rel="" href="#cross_sale" role="tab" aria-controls="cross_sells" aria-selected="false">{{ __('Cross Sale') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" data-rel="" href="#up_sale" role="tab" aria-controls="up_sells" aria-selected="false">{{ __('Up Sale') }}</a>
                    </li>
                </ul>
                <input type="hidden" value="{{ $item->id }}" name="item_id" id="item_id">
                <div class="col-sm-12 tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-sm-12">
                            <div class="row">
                                @if($item->file()->get()->isNotEmpty())
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <div class="fixSize">
                                            @foreach($item->filesUrl() as $key => $image)
                                                <a class="cursor_pointer {{ $key == 0 ? '' :  'display-none'}}" href='{{ $image }}'  data-lightbox="image-1"> <img class="profile-user-img img-responsive fixSize" src='{{ $image }}' alt="" class="img-thumbnail attachment-styles"></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-sm-4"></div>
                                @endif
                            </div>
                            <div class="card-header">
                                <h6 class="mb-0 font-bold h6">{{ __(':x Information',['x' => __('Basic')]) }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Name') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ $item->name }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Category') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ isset($item->itemCategory) && isset($item->itemCategory->category) ? $item->itemCategory->category->name : '' }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Brand') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ optional($item->brand)->name }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Item Code') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ $item->item_code }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('SKU') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ $item->sku }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Price') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ formatCurrencyAmount($item->price) }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Available :x',['x' => __('From')]) }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ !empty($item->available_from) ? formatDate($item->available_from) : '' }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Available :x',['x' => __('To')]) }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ !empty($item->available_to) ? formatDate($item->available_to) : '' }}</span>
                                    </div>
                                    <span class="text-left font-bold mb-0 col-sm-2">{{ __('Vendor') }}:</span>
                                    <div class="col-sm-2">
                                        <span class="mb-0">{{ optional($item->vendor)->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h6 class="mb-0 font-bold h6">{{ __(':x Information',['x' => __('Attribute')]) }}</h6>
                            </div>
                            <div class="card-body">
                                @php $even = 0; $attCount = count($itemAttribute)@endphp
                                @foreach($itemAttribute as $key => $attribute)
                                    @if ($even%2 == 0)
                                        <div class="form-group row">
                                            @endif

                                            <span class="text-left font-bold mb-0 col-sm-3">{{ ucfirst(optional($attribute->attribute)->name) }}:</span>
                                            <div class="col-sm-3">
                                                <span class="mb-0">{{ optional($attribute->attribute)->type == "multiple_select" ? implode(",", json_decode($attribute->payloads)) : $attribute->payloads }}</span>
                                            </div>

                                            @if ($even%2 != 0)
                                        </div>
                                    @endif
                                    @php $even++; @endphp
                                @endforeach
                            </div>
                            @if($attCount%2 != 0)
                        </div>
                        @endif
                    </div>

                </div>

                <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action='{{ route('vendor.item.related',"inventory") }}' class="form-horizontal" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="item_id" id="item_id">
                                <div class="row">
                                    <div class="col-sm-12 m-t-10 p-2">
                                        <div class="inv-container">
                                            <div class="inv-content">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr class="tbl_header_color">
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Vendor') }}</th>
                                                            <th>{{ __('Quantity') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($item->itemOption as $option)
                                                            @foreach($option->inventories as $inventory)
                                                                <tr>
                                                                    <td>
                                                                        <span> {{ $inventory->label }} </span>
                                                                    </td>
                                                                    <td>
                                                                        <span> {{ optional($inventory->vendor)->name }} </span>
                                                                    </td>
                                                                    <td>
                                                                        <span> <input type="text" name="qty[]" class="form-control positive-float-number" value="{{ $inventory->quantity }}"></span>
                                                                        <input type="hidden" name="inventory_ids[]" value="{{ $inventory->id }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary custom-btn-small float-left" type="submit" id="submit">{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="option" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action='{{ route('vendor.item.related',"option") }}' class="form-horizontal" method="POST">
                                @csrf
                                @php $count = 1; $opKey = 1;@endphp
                                @foreach($item_option as  $option)
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="option_name" class="col-sm-4 control-label margin-neg-top-1p">{{ __('Name') }}
                                                </label>
                                                <div class="col-sm-8 margin-top-1p">
                                                    <span class="mb-0">{{ $option->name }}</span>
                                                    <input type="hidden" name="options[]" id="option-id-{{$opKey}}" class="option_id" value="{{ $option->id }}">
                                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="type" class="col-sm-4 control-label margin-neg-top-1p">{{ __('Type') }}</label>
                                                <div class="col-sm-8 margin-top-1p">
                                                    <span class="mb-0">{{ ucwords(str_replace("_"," ",$option->type)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="is_required" class="col-sm-5 control-label margin-neg-top-1p">{{ __('Required') }}</label>
                                                <div class="col-sm-7 margin-top-1p">
                                                    <span class="mb-0">{{ $option->is_required == 1 ? __('Yes') : __('No')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive option_div" id="option_div-{{$opKey++}}">
                                        <table class="options table table-bordered">
                                            <thead>
                                            <tr>
                                                @if(in_array($option->type, labelRequiredElement()))
                                                    <th class="text-center">{{ __('Label') }}</th>
                                                @endif
                                                <th class="text-center">{{ __('Price') }}</th>
                                                <th class="text-center">{{ __('Price type') }}</th>
                                                <th class="text-center">{{ __('File') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="option-values-1">
                                            @php $payloads = json_decode($option->payloads)@endphp
                                            @foreach($payloads->option_price_type as $key => $data)
                                                <tr draggable="false" id="option-value-rowid-1" class="option-value-rowid text-center">
                                                    @if(in_array($option->type, labelRequiredElement()))
                                                        <td>
                                                            <span class="mb-0">{{ $payloads->label[$key] }}</span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <span class="mb-0">{{ $payloads->option_price[$key]->option_price }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="mb-0">{{ $data }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropzone-attachments" id="dropzone-attachments-{{ $count }}">
                                                            <div class="event-attachments">
                                                                <div class="add-attachments" id="add-attachments-{{ $count }}"><i class="fa fa-plus"></i></div>
                                                            </div>
                                                        </div>
                                                        <div id="uploader-text-{{ $count++ }}"></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach

                                <button class="btn btn-primary custom-btn-small float-left" type="submit" id="submit">{{ __('Submit') }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action='{{ route('vendor.item.related',"relate") }}' class="form-horizontal" method="POST">
                                @csrf
                                <div class="col-sm-8 mb-3">
                                    <div class="form-group row mb-0">
                                        <label class="col-md-2 col-form-label">{{ __('Add')  }}&nbsp;&nbsp;<span class="searchItemTh"> {{ __('Item')  }} </span></label>
                                        <input class="form-control auto col-md-9" data-type="related" placeholder="{{ __('Search Item') }}" id="search">
                                        <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="no_div_relate" tabindex="0">
                                            <li>{{ __('No record found')  }} </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div id="error_message" class="text-danger col-md-10 p-0"></div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                                <div class="row">
                                    <div class="col-sm-12 m-t-10 p-2">
                                        <div class="inv-container">
                                            <div class="inv-content">
                                                <div id="itemInputContainer" class="table-responsive">
                                                    <table class="table display-none" id="related-item-table">
                                                        <thead>
                                                        <tr class="tbl_header_color">
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Code') }}</th>
                                                            <th>{{ __('SKU') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="item_data">
                                                        @foreach($item_relate as $relate)
                                                            <tr class="relate-item-value-rowid">
                                                                <td>
                                                                    <span> {{ optional($relate->relatedItem)->name }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($relate->relatedItem)->item_code }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($relate->relatedItem)->sku }} </span>
                                                                    <input type="hidden" value="{{ optional($relate->relatedItem)->id }}" name="related_item_id[]">
                                                                </td>
                                                                <td class="text-center delete">
                                                                    <button type="button" class="btn btn-xs btn-danger delete-item-value-row" data-itemId="{{ optional($relate->relatedItem)->id }}" data-type="relate" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                        <i class="feather icon-trash-2"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                    <div class="alert alert-primary display-none" role="alert" id="select_first_related">
                                                        {{ __('Add your first item here') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary custom-btn-small float-left" type="submit" id="submit">{{ __('Submit') }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="cross_sale" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action='{{ route('vendor.item.related',"cross") }}' class="form-horizontal" method="POST">
                                @csrf
                                <div class="col-sm-8 mb-3">
                                    <div class="form-group row mb-0">
                                        <label class="col-md-2 col-form-label">{{ __('Add')  }}&nbsp;&nbsp;<span class="searchItemTh"> {{ __('Item')  }} </span></label>
                                        <input class="form-control auto col-md-9" data-type="cross" placeholder="{{ __('Search Item') }}" id="search_cross">
                                        <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="no_div_cross" tabindex="0">
                                            <li>{{ __('No record found')  }} </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div id="error_message" class="text-danger col-md-10 p-0"></div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                                <div class="row">
                                    <div class="col-sm-12 m-t-10 p-2">
                                        <div class="inv-container">
                                            <div class="inv-content">
                                                <div id="itemInputContainer" class="table-responsive">
                                                    <table class="table display-none" id="cross-item-table">
                                                        <thead>
                                                        <tr class="tbl_header_color">
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Code') }}</th>
                                                            <th>{{ __('SKU') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="item_data_cross">
                                                        @foreach($item_cross as $cross)
                                                            <tr class="relate-item-value-rowid">
                                                                <td>
                                                                    <span> {{ optional($cross->crossItem)->name }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($cross->crossItem)->item_code }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($cross->crossItem)->sku }} </span>
                                                                    <input type="hidden" value="{{ optional($cross->crossItem)->id }}" name="related_item_id[]">
                                                                </td>
                                                                <td class="text-center delete">
                                                                    <button type="button" class="btn btn-xs btn-danger delete-item-value-row" data-itemId="{{ optional($cross->crossItem)->id }}" data-type="cross" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                        <i class="feather icon-trash-2"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="alert alert-primary display-none" role="alert" id="select_first_cross">
                                                        {{ __('Add your first item here') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary custom-btn-small float-left" type="submit" id="submit">{{ __('Submit') }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="up_sale" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action='{{ route('vendor.item.related',"up") }}' class="form-horizontal" method="POST">
                                @csrf
                                <div class="col-sm-8 mb-3">
                                    <div class="form-group row mb-0">
                                        <label class="col-md-2 col-form-label">{{ __('Add')  }}&nbsp;&nbsp;<span class="searchItemTh"> {{ __('Item')  }} </span></label>
                                        <input class="form-control auto col-md-9" data-type="up" placeholder="{{ __('Search Item') }}" id="search_up">
                                        <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="no_div_up" tabindex="0">
                                            <li>{{ __('No record found')  }} </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div id="error_message" class="text-danger col-md-10 p-0"></div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                                <div class="row">
                                    <div class="col-sm-12 m-t-10 p-2">
                                        <div class="inv-container">
                                            <div class="inv-content">
                                                <div id="itemInputContainer" class="table-responsive">
                                                    <table class="table display-none" id="up-item-table">
                                                        <thead>
                                                        <tr class="tbl_header_color">
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Code') }}</th>
                                                            <th>{{ __('SKU') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="item_data_up">
                                                        @foreach($item_up as $up)
                                                            <tr class="relate-item-value-rowid">
                                                                <td>
                                                                    <span> {{ optional($up->upItem)->name }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($up->upItem)->item_code }} </span>
                                                                </td>
                                                                <td>
                                                                    <span> {{ optional($up->upItem)->sku }} </span>
                                                                    <input type="hidden" value="{{ optional($up->upItem)->id }}" name="related_item_id[]">
                                                                </td>
                                                                <td class="text-center delete">
                                                                    <button type="button" class="btn btn-xs btn-danger delete-item-value-row" data-itemId="{{ optional($up->upItem)->id }}" data-type="up" data-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                                                        <i class="feather icon-trash-2"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="alert alert-primary display-none" role="alert" id="select_first_up">
                                                        {{ __('Add your first item here') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary custom-btn-small float-left" type="submit" id="submit">{{ __('Submit') }}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('public/dist/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- dropzone JS -->
    <script src="{{ asset('public/dist/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/item.min.js') }}"></script>
    <script src="{{asset('public/dist/plugins/lightbox/js/lightbox.min.js')}}"></script>
@endsection
