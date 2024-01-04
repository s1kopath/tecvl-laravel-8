@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('Modules/CMS/Resources/assets/css/style.min.css') }}">
@endsection
@section('content')

<div class="col-md-12">
    <div class="noti-alert pad no-print" id="success-message">
        <div class="alert abc">
            <strong id="msg"></strong>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="row" id="theme-container">
        <div class="col-sm-3" aria-labelledby="navbarDropdown">
            <div class="card card-info mx-auto-sm" id="nav">
                <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <nav id="column_left">
                        <div class="card-header p-t-20">
                            <h5><a href="#" id="general-settings">{{ __('Manage') . " " . __('Themes') }}</a></h5>
                        </div>
                        <ul class="nav nav-list flex-column">
                            <li><a class="nav-link text-left tab-name"  id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true" data-id = "General">{{ __('General') }}</a></li>
                            <li><a class="nav-link text-left tab-name"  id="v-pills-search-tab" data-toggle="pill" href="#v-pills-search" role="tab" aria-controls="v-pills-search" aria-selected="true" data-id = "Search">{{ __('Search Page') }}</a></li>
                            <li><a class="nav-link text-left tab-name"  id="v-pills-details-tab" data-toggle="pill" href="#v-pills-details" role="tab" aria-controls="v-pills-details" aria-selected="true" data-id = "Details">{{ __('Product Detail Page') }}</a></li>
                            <li><a class="nav-link text-left tab-name"  id="v-pills-blog-details-tab" data-toggle="pill" href="#v-pills-blog-details" role="tab" aria-controls="v-pills-blog-details" aria-selected="true" data-id = "Blog">{{ __('Blog Detail Page') }}</a></li>
                            <li><a class="nav-link text-left tab-name"  id="v-pills-blog-category-tab" data-toggle="pill" href="#v-pills-blog-category" role="tab" aria-controls="v-pills-blog-category" aria-selected="true" data-id = "Blog Category">{{ __('Blog Category Page') }}</a></li>
                            <li>
                                <a class="accordion-heading position-relative" data-toggle="collapse" data-target="#submenu2">{{ __('Header') }} <span class="pull-right"><b class="caret"></b></span>
                                <span><i class="fa fa-angle-down position-absolute arrow-icon"></i></span>
                                </a>
                                <ul class="nav nav-list flex-column flex-nowrap collapse ml-2 vertical-class" id="submenu2">
                                      <li><a class="nav-link text-left tab-name"  id="v-pills-topNav-tab" data-toggle="pill" href="#v-pills-topNav" role="tab" aria-controls="v-pills-topNav" aria-selected="false" data-id = "Header">{{ __('Top Header') }}</a>
                                      </li>
                                      <li><a class="nav-link text-left tab-name"  id="v-pills-mainHeader-tab" data-toggle="pill" href="#v-pills-mainHeader" role="tab" aria-controls="v-pills-mainHeader" aria-selected="false" data-id = "Header">{{ __('Main Header') }}</a>
                                      </li>
                                      <li><a class="nav-link text-left tab-name"  id="v-pills-bottomHeader-tab" data-toggle="pill" href="#v-pills-bottomHeader" role="tab" aria-controls="v-pills-bottomHeader" aria-selected="false" data-id = "Header">{{ __('Bottom Header') }}</a>
                                      </li>
                                </ul> 
                            </li>
                            <li>
                                <a class="accordion-heading position-relative" data-toggle="collapse" data-target="#useful-links-v-pills-tab">{{ __('Footer') }} <span class="pull-right"><b class="caret"></b></span>
                                <span><i class="fa fa-angle-down position-absolute arrow-icon"></i></span>
                                </a>
                                <ul class="nav nav-list flex-column flex-nowrap collapse ml-2 vertical-class" id="useful-links-v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <li><a class="nav-link text-left tab-name" id="v-pills-useful-links-tab" data-toggle="pill" href="#v-pills-useful-links" role="tab" aria-controls="v-pills-useful-links" aria-selected="true" data-id = "Footer">{{ __('Useful Links') }}</a>
                                    </li>
                                    <li><a class="nav-link text-left tab-name" id="v-pills-categories-tab" data-toggle="pill" href="#v-pills-categories" role="tab" aria-controls="v-pills-categories" aria-selected="true" data-id = "Footer">{{ __('Categories') }}</a>  </li>
                                    <li><a class="nav-link text-left tab-name" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="true" data-id = "Footer">{{ __('Social') }}</a> 
                                    </li>
                                </ul>  
                            </li>
                      </ul>
                    </nav>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card card-info">
                <div class="card-header p-t-20">
                    <h5><a href="#" >{{ __('Themes') }} </a> >> <a href="#" id="theme-title" ></a></h5></div>
                      <div class="noti-alert pad no-print" id="warning-message">
                          <div class="alert warning-message">
                              <strong id="warning-msg"></strong>
                          </div>
                      </div>
                  
                <form method="post" action="" id="optionForm" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @csrf
                    <div class="tab-content" id="topNav-v-pills-tabContent">
                      {{-- Top Header --}}
                      @php $topHeader = option('top_header', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-topNav" role="tabpanel" aria-labelledby="v-pills-topNav-tab">
                            <div class="form-group row">
                              <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Top Header') }}</label>
                              <div class="col-sm-6">
                               <div class="switch d-inline m-r-10">
                                    <input type="checkbox" name="top_header" {{ $topHeader == 'on'  ? 'checked' : '' }}  id="show-top-nav">
                                    <label for="show-top-nav" class="cr"></label>
                                </div>
                              </div>
                            </div>
                            @php $showPhoneNo = option('is_phone_active', 'off') @endphp
                            <div class="row conditional" data-if="#show-top-nav">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Phone No') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_phone_active" {{ $showPhoneNo == 'on'  ? 'checked' : '' }}  id="show-phone-no">
                                          <label for="show-phone-no" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $phone = option('phone_no', '') @endphp
                                    <div class="form-group row mb-1 conditional" data-if="#show-top-nav && is_phone_active">
                                      <label for="meta_description" class="col-sm-4 text-left col-form-label ">{{ __('Phone No') }}</label>
                                      <div class="col-sm-6 test-class">
                                        <input type="text" class="form-control" name="phone_no"  placeholder="{{ __('Phone No') }}" value="{{ $phone }}" >
                                      </div>
                                    </div>
                                    @php $showEmail = option('is_email_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Email') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_email_active" {{  $showEmail == 'on'  ? 'checked' : '' }}  id="show-email">
                                          <label for="show-email" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $email = option('email', '') @endphp
                                    <div class="form-group row mb-1 conditional" data-if="#show-top-nav && is_email_active">
                                      <label for="meta_description" class="col-sm-4 text-left col-form-label ">{{ __('Email') }}</label>
                                      <div class="col-sm-6 test-class">
                                        <input type="text" class="form-control" name="email"  placeholder="{{ __('Email') }}" value="{{ $email }}">
                                      </div>
                                    </div>
                                    @php $showCurrency = option('is_currency_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Currency') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_currency_active" {{ $showCurrency == 'on'  ? 'checked' : '' }}  id="show-currency">
                                          <label for="show-currency" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $currency = option('currency', '') @endphp
                                    <div class="form-group row mb-1 conditional" data-if="#show-top-nav && is_currency_active">
                                      <label for="meta_description" class="col-sm-4 text-left col-form-label ">{{ __('Currency Name') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="currency"  placeholder="{{ __('Currency Name') }}" value="{{ $currency }}">
                                      </div>
                                    </div>
                                    @php $showLanguage = option('is_language_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Language') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_language_active" {{ $showLanguage == 'on'  ? 'checked' : '' }} id="show-language">
                                          <label for="show-language" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- main header  --}}
                        <div class="tab-pane fade" id="v-pills-mainHeader" role="tabpanel" aria-labelledby="v-pills-mainHeader-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                @php $showIcon = option('icon', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Icon') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="icon" {{ $showIcon == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-icon">
                                        <label for="show-icon" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>

                                  @php $showSearchBar = option('searchbar', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Searchbar') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="searchbar" {{ $showSearchBar == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-searchbar">
                                        <label for="show-searchbar" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>
                                  @php $showUserIcon = option('user_icon', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show User Icon') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="user_icon" {{ $showUserIcon == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-user-icon">
                                        <label for="show-user-icon" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>
                                  @php $showWishList = option('wishlist', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show wishlist') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="wishlist" {{ $showWishList == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-wishlist">
                                        <label for="show-wishlist" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>
                                  @php $showCart = option('cart', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Cart') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="cart" {{ $showCart == 'on'  ? 'checked' : '' }} value="on"type="checkbox" id="show-cart">
                                        <label for="show-cart" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>
                                  @php $showCompare = option('compare') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Compare') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input class="is_default" name="compare" {{ $showCompare == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-compare">
                                        <label for="show-compare" class="cr"></label>
                                    </div> 
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- Bottom Header --}}
                        @php $showCategory = option('is_category_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-bottomHeader" role="tabpanel" aria-labelledby="v-pills-bottomHeader-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Category') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input class="is_default" name="is_category_active" {{ $showCategory == 'on'  ? 'checked' : '' }} value="on" type="checkbox" id="show-category">
                                          <label for="show-category" class="cr"></label>
                                        </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- General --}}
                        @php $showColorPicker = option('is_color_pikcer_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Color Picker') }}</label>
                                        <div class="col-sm-6">
                                          <div class="switch d-inline m-r-10">
                                            <input class="is_default" name="is_color_pikcer_active" {{ $showColorPicker == 'on'  ? 'checked' : '' }} type="checkbox" id="color-picker">
                                            <label for="color-picker" class="cr"></label>
                                        </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- Search page --}}
                        @php $showSort = option('is_sort_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-search" role="tabpanel" aria-labelledby="v-pills-search-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Sort Option') }}</label>
                                        <div class="col-sm-6">
                                          <div class="switch d-inline m-r-10">
                                            <input class="is_default" name="is_sort_active" {{ $showSort == 'on'  ? 'checked' : '' }} type="checkbox" id="sort-active">
                                            <label for="sort-active" class="cr"></label>
                                        </div> 
                                      </div>
                                  </div>
                                  @php $showGrid = option('is_grid_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Grid Option') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_grid_active" {{ $showGrid == 'on'  ? 'checked' : '' }}  id="grid-active">
                                        <label for="grid-active" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $reletedCategory = option('is_releted_category_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Releted Categoary') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_releted_category_active" {{ $reletedCategory == 'on'  ? 'checked' : '' }}  id="show-related-category">
                                        <label for="show-related-category" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $showFilter = option('is_filter_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Filter') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_filter_active" {{ $showFilter == 'on'  ? 'checked' : '' }}  id="show-filter">
                                        <label for="show-filter" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $otherFilter = option('is_other_filter_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Filter By Others') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_other_filter_active" {{ $otherFilter == 'on'  ? 'checked' : '' }}  id="show-filter-by-others">
                                        <label for="show-filter-by-others" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- Details page --}}
                        @php $showImage = option('is_image_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Image') }}</label>
                                        <div class="col-sm-6">
                                          <div class="switch d-inline m-r-10">
                                            <input class="is_default" name="is_image_active" {{ $showImage == 'on'  ? 'checked' : '' }} type="checkbox" id="show-image">
                                            <label for="show-image" class="cr"></label>
                                        </div> 
                                      </div>
                                  </div>
                                  @php $showDescription = option('is_description_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Description') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_description_active" {{ $showDescription == 'on'  ? 'checked' : '' }}  id="show-description">
                                        <label for="show-description" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $deliveryOption = option('is_delivery_option_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Delivery Option') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_delivery_option_active" {{ $deliveryOption == 'on'  ? 'checked' : '' }}  id="show-delivery-option">
                                        <label for="show-delivery-option" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $sellerDetail = option('is_seller_details_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Seller Details') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_seller_details_active" {{ $sellerDetail == 'on'  ? 'checked' : '' }}  id="show-seller-name">
                                        <label for="show-seller-name" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $productDetail = option('is_product_detail_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Product Details') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_product_detail_active" {{ $productDetail == 'on'  ? 'checked' : '' }}  id="show-product-detail">
                                        <label for="show-product-detail" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $sameStoreProduct = option('is_same_store_product_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Same Store Product') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_same_store_product_active" {{ $sameStoreProduct == 'on'  ? 'checked' : '' }}  id="same-store-product">
                                        <label for="same-store-product" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $rating = option('is_rating_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Ratings') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_rating_active" {{ $rating == 'on'  ? 'checked' : '' }}  id="show-ratings">
                                        <label for="show-ratings" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- Blog Detail page --}}
                        @php $blogDetailsActive = option('is_blog_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-blog-details" role="tabpanel" aria-labelledby="v-pills-blog-details-tab">
                            <div class="form-group row">
                              <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Blog Section') }}</label>
                              <div class="col-sm-6">
                               <div class="switch d-inline m-r-10">
                                    <input type="checkbox" name="is_blog_active" {{ $blogDetailsActive == 'on'  ? 'checked' : '' }}  id="show-blog">
                                    <label for="show-blog" class="cr"></label>
                                </div>
                              </div>
                            </div>
                            @php $blogDetailsImage = option('is_blog_image_active', 'off') @endphp
                            <div class="row conditional" data-if="#show-blog">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Image') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_blog_image_active" {{ $blogDetailsImage == 'on'  ? 'checked' : '' }}  id="show-blog-image">
                                          <label for="show-blog-image" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $blogDetailsCategory = option('is_blog_category_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Category') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_blog_category_active" {{  $blogDetailsCategory == 'on'  ? 'checked' : '' }}  id="show-blog-category">
                                          <label for="show-blog-category" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $blogAuthorName = option('is_blog_auhtor_name_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Author Name') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_blog_auhtor_name_active" {{ $blogAuthorName == 'on'  ? 'checked' : '' }}  id="show-blog-auhtor-name">
                                          <label for="show-blog-auhtor-name" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $blogDetailsPopularPost = option('is_popular_post_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Popular Post') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_popular_post_active" {{ $blogDetailsPopularPost == 'on'  ? 'checked' : '' }}  id="show-popular-post">
                                          <label for="show-popular-post" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                    @php $blogDetailSubscribe = option('is_blog_subscribe_active', 'off') @endphp
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Subscribe') }}</label>
                                      <div class="col-sm-6">
                                        <div class="switch d-inline m-r-10">
                                          <input type="checkbox" name="is_blog_subscribe_active" {{ $blogDetailSubscribe == 'on'  ? 'checked' : '' }} id="show-blog-details-subscribe">
                                          <label for="show-blog-details-subscribe" class="cr"></label>
                                        </div> 
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Blog Category Page --}}
                        @php $categoryDetails = option('is_blog_category_details_active', 'off') @endphp
                        <div class="tab-pane fade" id="v-pills-blog-category" role="tabpanel" aria-labelledby="v-pills-blog-category-tab">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group row">
                                      <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Blog Details') }}</label>
                                        <div class="col-sm-6">
                                          <div class="switch d-inline m-r-10">
                                            <input class="is_default" name="is_blog_category_details_active" {{ $categoryDetails == 'on'  ? 'checked' : '' }} type="checkbox" id="show-blog-category-details-view">
                                            <label for="show-blog-category-details-view" class="cr"></label>
                                        </div> 
                                      </div>
                                  </div>
                                  @php $categoryDetailsList = option('is_blog_category_details_list_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Category') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_blog_category_details_list_active" {{ $categoryDetailsList == 'on'  ? 'checked' : '' }}  id="show-blog-category-details-sidebar">
                                        <label for="show-blog-category-details-sidebar" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $categoryDetailsAuthor = option('is_blog_category_author_name_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Author Name') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_blog_category_author_name_active" {{ $categoryDetailsAuthor == 'on'  ? 'checked' : '' }}  id="show-blog-single-author">
                                        <label for="show-blog-single-author" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $categoryDetailsPopularPost = option('is_blog_details_popular_post_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Popular Post') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_blog_details_popular_post_active" {{ $categoryDetailsPopularPost == 'on'  ? 'checked' : '' }}  id="show-details-popular-post">
                                        <label for="show-details-popular-post" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                                  @php $categoryDetailsSubscribe = option('is_blog_category_subscribe_active', 'off') @endphp
                                  <div class="form-group row">
                                    <label for="meta_title" class="col-sm-4 text-left col-form-label ">{{ __('Show Subscribe') }}</label>
                                    <div class="col-sm-6">
                                      <div class="switch d-inline m-r-10">
                                        <input type="checkbox" name="is_blog_category_subscribe_active" {{ $categoryDetailsSubscribe == 'on'  ? 'checked' : '' }}  id="show-blog-detail-subscribe">
                                        <label for="show-blog-detail-subscribe" class="cr"></label>
                                      </div> 
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- Useful Link --}}
                        @php $links = option('links', '') @endphp
                        <div class="tab-pane fade" id="v-pills-useful-links" role="tabpanel" aria-labelledby="v-pills-useful-links-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="meta_title" class="col-sm-2 text-left col-form-label ">{{ __('Link Title') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" id="option-name-useful-links1" name="links[title]"  placeholder="{{ __('Link Title') }}" value="{{ isset($links['title']) && !empty($links['title']) ? $links['title'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                      <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Store Location') }}</label>
                                      <div class="col-sm-6 test-class">
                                        <input type="text" class="form-control" id="option-value-useful-links2" name="links[link1]"  placeholder="{{ __('Store Location') }}" value="{{ isset($links['link1']) && !empty($links['link1']) ? $links['link1'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                      <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('latest News') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" id="option-value-useful-links3" name="links[link2]"  placeholder="{{ __('latest News') }}" value="{{ isset($links['link2']) && !empty($links['link2']) ? $links['link2'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('My Account') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-useful-links4" name="links[link3]"  placeholder="{{ __('My Account') }}" value="{{ isset($links['link3']) && !empty($links['link3']) ? $links['link3'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Size Guide') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-useful-links5" name="links[link4]"  placeholder="{{ __('Size Guide') }}" value="{{ isset($links['link4']) && !empty($links['link4']) ? $links['link4'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('FAQ') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-useful-links6" name="links[link5]"  placeholder="{{ __('FAQ') }}" value="{{ isset($links['link5']) && !empty($links['link5']) ? $links['link5'] : '' }}">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                        {{-- Category --}}
                        @php $category = option('category', '') @endphp
                        <div class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab" data-tab = "categories">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                      <label for="meta_title" class="col-sm-2 text-left col-form-label ">{{ __('Category Name') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" id="option-name-categories" name="category[title]"  placeholder="{{ __('Category Name') }}" value="{{ isset($category['title']) && !empty($category['title']) ? $category['title'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                      <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Men') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" id="option-value-categories" name="category[title1]"  placeholder="{{ __('Men') }}" value="{{ isset($category['title1']) && !empty($category['title1']) ? $category['title1'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Women') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-categories12" name="category[title2]"  placeholder="{{ __('Women') }}" value="{{ isset($category['title2']) && !empty($category['title2']) ? $category['title2'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Accessoreis') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-categories13" name="category[title3]"  placeholder="{{ __('Accessoreis') }}" value="{{ isset($category['title3']) && !empty($category['title3']) ? $category['title3'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Shoes') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-categories14" name="category[title4]"  placeholder="{{ __('Shoes') }}" value="{{ isset($category['title4']) && !empty($category['title4']) ? $category['title4'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Denim') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="option-value-categories15" name="category[title5]"  placeholder="{{ __('Denim') }}" value="{{ isset($category['title5']) && !empty($category['title5']) ? $category['title5'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           {{-- Social --}}
                        @php $social = option('social', '') @endphp
                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="meta_title" class="col-sm-2 text-left col-form-label ">{{ __('Link Title') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="social[title]"  placeholder="{{ __('Link Title') }}" value="{{ isset($social['title']) && !empty($social['title']) ? $social['title'] : ''}}" >
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                      <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Twitter') }}</label>
                                      <div class="col-sm-6 test-class">
                                        <input type="text" class="form-control" name="social[twitter]"  placeholder="{{ __('Twitter') }}" value="{{ isset($social['twitter']) && !empty($social['twitter']) ? $social['twitter'] : '' }}">
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                      <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Whatsapp') }}</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="social[whatsapp]"  placeholder="{{ __('Whatsapp') }}" value="{{ isset($social['whatsapp']) && !empty($social['whatsapp']) ? $social['whatsapp'] : '' }}" >
                                      </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('FaceBook') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="social[facebook]"  placeholder="{{ __('FaceBook') }}" value="{{ isset($social['facebook']) && !empty($social['facebook']) ? $social['facebook'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="meta_description" class="col-sm-2 text-left col-form-label ">{{ __('Gmail') }}</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="social[gmail]"  placeholder="{{ __('Gmail') }}" value="{{ isset($social['gmail']) && !empty($social['gmail']) ? $social['gmail'] : '' }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                  
                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary form-submit custom-btn-small float-right" id="footer-btn">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/condition.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/theme.min.js') }}"></script>
@endsection