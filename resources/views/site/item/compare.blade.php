@extends('../site/layouts.app')
@section('page_title', __('Details'))
@section('css')
<link rel="stylesheet" href="{{ asset('public/frontend/assets/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/assets/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/assets/slick/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/assets/slick/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/assets/product-carousel-magnifying/jquery.exzoom.css') }}">

@endsection

@section('content')

<section id="item-details-container">

    {{-- breadcrumbs --}}
    <nav class="text-black my-4 container mx-auto px-4 text-gray-600 text-sm" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
          <li class="flex items-center">
            <a href="#">First Level</a>
            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
          </li>
          <li class="flex items-center">
            <a href="#">Second Level</a>
            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
          </li>
          <li class="flex items-center">
            <a href="#">Third Level</a>
            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
          </li>
          <li class="flex items-center">
            <a href="#">Fourth Level</a>
            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
          </li>
          <li>
            <a href="#" class="text-gray-500" aria-current="page">Final Level</a>
          </li>
        </ol>
    </nav>

    <!-- Compare Product Start -->
    <section>
        <div class="compare-products container mx-auto px-4">
           <div class="compare-products-table-responsive">
           <table class="table table-bordered compare-table">
            <tbody>
               <tr>
                   <td>Product Overview</td> 
                   <td>
                       <a href="" class="product-image">
                          <img src="{{asset('public/frontend/assets/img/product/compare-1.jpeg')}}"  alt="product image" class=""></a>
                        <a href="" class="product-name text-green-500 color_switch">Apple MacBook Air (13-inch, 8GB RAM, 256GB Storage, 1.6GHz Intel Core i5) - Gold</a>
                        <button class="btn btn-remove">
                               <div title='clear field' id='clear' class='clear-field'  >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                        </button>
                    </td>
                    <td>
                        <a href="" class="product-image">
                            <img src="{{asset('public/frontend/assets/img/product/compare-2.jpg')}}" alt="product image" class=""></a> 
                        <a href="" class="product-name text-green-500">Hot Mens Parka Coats Men Winter Warm Hooded</a> 
                       <button class="btn btn-remove">
                                <div title='clear field' id='clear' class='clear-field'  >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                        </button>
                    </td>
                    <td>
                        <a href="" class="product-image"><img src="{{asset('public/frontend/assets/img/product/compare-3.jpeg')}}" alt="product image" class=""></a> 
                        <a href=""class="product-name text-green-500">Apple 32-inch Pro Display XDR with Retina 6K Display</a> 
                        <button class="btn btn-remove">
                                <div title='clear field' id='clear' class='clear-field'  >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Description</td> 
                    <td>Stunning 13.3-Inch Retina Display with True Tone withTouch ID. Dual-core 8th-Generation Intel Core i5 Processor with Intel UHD Graphics 617. Fast SSD Storage and 8GB memory.
                    </td>
                    <td>Brand Name: CARSONYEUNG Closure Type: zipper Item Type: Outerwear &amp; Coats Model Number: JK-LMMY90 Sleeve Style: REGUfAR Thickness: Thick （Winter) Hooded: Yes
                    </td>
                    <td>32-inch LCD display with Retina 6K resolution (6016 by 3384 pixels)Pro Stand and VESA Mount Adapter sold separately Extreme Dynamic Range (XDR) Brightness: 1000 nits sustained, 1600 nits peakContrast ratio: 1,000,000:1 P3 wide color gamut, 10-bit color depth Superwide viewing angle Reference modes One Thunderbolt 3 port, three USB-C ports
                    </td>
                </tr>

                <tr>
                    <td>Rating</td> 
                    <td>
                        <div class="compare-products-rating">
                           <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <span class="rating-count">(0)</span> 
                        </div>
                    </td> 
                    <td>
                        <div class="compare-products-rating">
                           <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <span class="rating-count">(0)</span> 
                        </div>
                    </td> 
                    <td>
                        <div class="compare-products-rating">
                           <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <span class="rating-count">(0)</span> 
                        </div>
                    </td>      
                <tr>
                    <td>Price</td> 
                    <td><span class="product-price ">$949.99</span></td>
                    <td><span class="product-price">$35.05</span></td>
                    <td><span class="product-price">$5,899.00</span></td>
                </tr>

                <tr>
                    <td>Availability</td> 
                    <td><span class="stock-status in-stock">
                        In Stock</span>
                    </td>
                    <td><span class="stock-status out-stock">
                        Out of Stock
                        </span>
                    </td>
                    <td><span class="stock-status in-stock">
                        In Stock
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>Targeted Group</td> 
                    <td>–</td>
                    <td>Men, Women</td>
                    <td>–</td>
                </tr>

                <tr>
                    <td>Size</td> 
                    <td> –</td>
                    <td>SM, M, L, XL, XXL</td>
                    <td> –</td>
                </tr>

                <tr><td>Brand</td> 
                    <td>–</td>
                    <td>–</td>
                    <td>Apple</td>
               </tr>

               <tr>
                   <td>Display</td> 
                   <td>–</td>
                   <td>–</td>
                   <td>55 inch AMOLED</td>
               </tr>

               <tr>
                   <td>Resolution</td> 
                   <td>–</td>
                   <td>–</td>
                   <td>3,840 x 2,160</td>
               </tr>

               <tr>
                   <td>Color Family</td>
                   <td>Gold, Space Grey, Sliver</td>
                   <td>–</td>
                   <td>Space Grey, Sliver</td>
               </tr>

               <tr>
                   <td>Laptop Brand</td>
                   <td>APPLE</td>
                   <td>–</td>
                   <td>–</td>
               </tr>

               <tr>
                   <td>Processor Brand</td>
                   <td> INTEL</td>
                   <td>–</td>
                   <td>–</td>
               </tr>

               <tr>
                   <td>Processor</td> 
                   <td>10th Gen. Intel Core i5</td>
                   <td>–</td>
                   <td>–</td>
               </tr>
               
               <tr><td>CPU Core Quantity</td> 
                   <td>Dual Core</td>
                   <td>–</td>
                   <td>–</td>
               </tr>

               <tr>
                   <td>SSD</td> 
                   <td>128GB, 256GB</td>
                   <td>–</td>
                   <td>–</td>
               </tr>

               <tr>
                   <td>RAM</td>
                   <td>4GB, 8GB</td>
                   <td>–</td>
                   <td>–</td>
               </tr>

               <tr>
                   <td>HDD</td>
                   <td>500GB</td>
                   <td>–</td>
                   <td>–</td>
               </tr>
               <tr>
                  <td>Battery</td>
                  <td>58.0-watt-hour lithium-polymer battery</td>
                  <td>–</td>
                  <td>–</td>
               </tr>

               <tr>
                   <td>Actions</td> 
                   <td>
                       <button title="Wishlist" class="btn btn-wishlist"><i class="fa-heart fa"></i></button> 
                       <button title="Add to cart" class="btn btn-add-to-cart"><i class="fa fa-shopping-cart"></i></button>
                    </td>
                    <td>
                        <button title="Wishlist" class="btn btn-wishlist"><i class="fa-heart fa"></i></button> 
                        <button title="Add to cart" class="btn btn-add-to-cart"><i class="fa fa-shopping-cart"></i></button>
                    </td>
                        <td><button title="Wishlist" class="btn btn-wishlist"><i class="fa-heart fa"></i></button> 
                        <button title="Add to cart" class="btn btn-add-to-cart"><i class="fa fa-shopping-cart"></i></button>
                    </td>
                </tr>

            </tbody>
           </table>
           </div>
        </div>
    </section>
   <!-- Compare Product end -->
</section>
<!-- Details section end -->



@include('../site/layouts/partials.product_section')
@endsection
@section('js')
<script src="{{ asset('public/dist/js/custom/site/item-details.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/description-tabs.js') }}"></script>
<script src="{{ asset('public/frontend/assets/slick/jquery.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/slick/slick.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/slick/script.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/flatpickr.min.js') }}"></script>

<script src="{{ asset('public/frontend/assets/product-carousel-magnifying/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/product-carousel-magnifying/jquery.exzoom.js') }}"></script>
<script src="{{ asset('public/frontend/assets/product-carousel-magnifying/exzoom.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/wishlist.js?v=1.4') }}"></script>
@endsection
