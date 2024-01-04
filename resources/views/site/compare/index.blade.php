@extends('../site/layouts.app')
@section('page_title', __('Compare List'))
@section('css')

@endsection

@section('content')

    <section id="compare-details-container" class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-6">
            <div class="relative">
                <div class="promote-img rounded-md">
                </div>
                <div class="absolute top-0 p-6">
                    <p class="text-lg font-medium text-gray-10 dm-sans">NEW ARRIVALS</p>
                    <p class="text-gray-12 font-bold text-2.5xl -mt-1.5 uppercase dm-bold">JEANS COLLECTION</p>
                    <p class="text-base dm-sans">Starting from <span class="text-orange-1 dm-sans font-medium">$9.99</span></p>
                    <div class="flex text-gray-12 border-gray-800 border rounded-sm text-xs justify-center p-2 w-29 mt-3 hover:bg-gray-12 hover:text-white cursor-pointer">
                        <p class="pr-5p font-medium">Shop Now</p>
                        <svg class="mt-5p" width="10" height="7" viewBox="0 0 10 7" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.7344 0L5.75327 1.05155L7.34399 2.75644H0.69376C0.310607 2.75644 0 3.08934 0 3.5C0 3.91066 0.310607 4.24356 0.69376 4.24356H7.34399L5.75327 5.94845L6.7344 7L10 3.5L6.7344 0Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>


        {{-- breadcrumbs --}}
        <nav class="my-8 container mx-auto px-4 text-gray-600 text-sm" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <span>
                        <svg class="mr-1.5"  xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.35643 1.89407C4.93608 2.1717 4.43485 2.59943 3.69438 3.23412L2.916 3.9013C2.0595 4.63545 1.82512 4.85827 1.69934 5.13174C1.57357 5.4052 1.55692 5.72817 1.55692 6.85625V10.1569C1.55692 10.9127 1.55857 11.4013 1.60698 11.7613C1.65237 12.099 1.72565 12.2048 1.7849 12.264C1.84416 12.3233 1.94997 12.3966 2.28759 12.442C2.64759 12.4904 3.13619 12.492 3.89206 12.492H8.56233C9.31819 12.492 9.80679 12.4904 10.1668 12.442C10.5044 12.3966 10.6102 12.3233 10.6695 12.264C10.7287 12.2048 10.802 12.099 10.8474 11.7613C10.8958 11.4013 10.8975 10.9127 10.8975 10.1569V6.85625C10.8975 5.72817 10.8808 5.4052 10.755 5.13174C10.6293 4.85827 10.3949 4.63545 9.53838 3.9013L8.76 3.23412C8.01953 2.59943 7.5183 2.1717 7.09795 1.89407C6.69581 1.62848 6.44872 1.55676 6.22719 1.55676C6.00566 1.55676 5.75857 1.62848 5.35643 1.89407ZM4.49849 0.595063C5.03749 0.239073 5.5849 0 6.22719 0C6.86948 0 7.41689 0.239073 7.95589 0.595063C8.4674 0.932894 9.04235 1.42573 9.7353 2.01972L10.5515 2.71933C10.5892 2.75162 10.6264 2.78347 10.6632 2.81492C11.3564 3.40806 11.8831 3.85873 12.1694 4.48124C12.4557 5.10375 12.4551 5.79693 12.4543 6.70926C12.4543 6.75764 12.4542 6.80662 12.4542 6.85625L12.4542 10.2081C12.4543 10.8981 12.4543 11.4927 12.3903 11.9688C12.3217 12.479 12.167 12.9681 11.7703 13.3648C11.3736 13.7615 10.8845 13.9162 10.3742 13.9848C9.89812 14.0488 9.30358 14.0488 8.61355 14.0488H3.84083C3.1508 14.0488 2.55626 14.0488 2.08015 13.9848C1.56991 13.9162 1.08082 13.7615 0.68411 13.3648C0.2874 12.9681 0.132701 12.479 0.064101 11.9688C9.07021e-05 11.4927 0.000124017 10.8981 0.000162803 10.2081L0.000164659 6.85625C0.000164659 6.80662 0.000122439 6.75763 8.07765e-05 6.70926C-0.000705247 5.79693 -0.00130245 5.10374 0.285011 4.48124C0.571324 3.85873 1.09802 3.40806 1.79122 2.81492C1.82798 2.78347 1.8652 2.75162 1.90288 2.71933L2.68126 2.05215C2.69391 2.0413 2.70652 2.03049 2.71909 2.01972C3.41204 1.42573 3.98698 0.932893 4.49849 0.595063Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50293 9.37853C3.50293 8.51876 4.19991 7.82178 5.05969 7.82178H7.39482C8.25459 7.82178 8.95158 8.51876 8.95158 9.37853V13.2704C8.95158 13.7003 8.60309 14.0488 8.1732 14.0488C7.74331 14.0488 7.39482 13.7003 7.39482 13.2704V9.37853H5.05969V13.2704C5.05969 13.7003 4.71119 14.0488 4.28131 14.0488C3.85142 14.0488 3.50293 13.7003 3.50293 13.2704V9.37853Z" fill="#898989"/>
                        </svg>
                    </span>
                    <a class="text-gray-10 roboto-medium font-medium text-sm" href="{{ route('site.index') }}">{{ __('Home') }}</a>
                </li>
                <span class="mr-2 ml-2">/</span>
                <li>
                    <a class="text-gray-12 roboto-medium font-medium text-sm" href="{{ route('site.compare') }}" aria-current="page">{{ __('Compare Items') }}</a>
                </li>
            </ol>
        </nav>

        <!-- Compare Products Start -->
        <section>
            <div>
                <div class="block w-full overflow-auto">
                    <table class="compare-table">
                        <tbody>
                            <tr>
                                <td class="text-15 text-gray-10 pr-12 dm-sans font-medium whitespace-nowrap text-right w-28">{{ __('Products') }}</td>
                                @php $index = 1 @endphp
                                @foreach($compareItems['itemName'] as $key => $itemName)
                                <td class="value-{{ $key }} pb-30p pr-2.5 relative text-center">
                                    <div href="" class="bg-gray-11 rounded h-225p w-225p flex justify-center items-center mb-13p mt-14">
                                        <img  src="{{ $itemName['image'] }}"  alt="product image" class="w-28 h-28">
                                    </div>
                                    <a href="{{ route('site.itemDetails', ['code' => $itemName['item_code'], 'name' => cleanedUrl($itemName['name'])]) }}" class="dm-sans font-medium text-sm text-gray-12 whitespace-wrap">{{ trimWords($itemName['name'], 25) }}
                                    </a>
                                    <button class="btn btn-remove absolute left-25 top-2 pt-2.5 pb-25p px-3.5 compareRemove" data-itemId = "{{ $key }}">
                                        <div title='clear field' id='clear' class='clear-field text-gray-10'>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 13 13" fill="currentColor">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455734 0.455612C1.06322 -0.151871 2.04814 -0.151871 2.65562 0.455612L11.989 9.78895C12.5964 10.3964 12.5964 11.3814 11.989 11.9888C11.3815 12.5963 10.3965 12.5963 9.78907 11.9888L0.455734 2.6555C-0.151749 2.04802 -0.151749 1.06309 0.455734 0.455612Z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9888 0.455612C11.3814 -0.151871 10.3964 -0.151871 9.78896 0.455612L0.455626 9.78895C-0.151857 10.3964 -0.151857 11.3814 0.455626 11.9888C1.06311 12.5963 2.04803 12.5963 2.65551 11.9888L11.9888 2.6555C12.5963 2.04802 12.5963 1.06309 11.9888 0.455612Z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </td>
                                @endforeach

                            </tr>
                            <tr class="bg-gray-11 h-20">
                                <td class="text-15 text-gray-10 dm-sans font-medium  py-6 pr-12 pl-6 text-right whitespace-nowrap w-28">{{ __('Price') }}</td>

                                @foreach($compareItems['price'] as $key => $price)
                                <td class="value-{{ $key }} roboto-medium font-medium text-sm text-gray-12">
                                    {{ $currency_symbol }}{{ formatCurrencyAmount($price) }}
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="text-15 text-gray-10 dm-sans font-medium py-6 pr-12 pl-6 text-right  whitespace-nowrap h-20 w-28">{{ __('Availability') }}</td>
                                @foreach($compareItems['availability'] as $key => $av)
                                <td class="value-{{ $key }} rounded roboto-medium font-medium text-sm {{ $av == true ? 'text-green-1' : 'text-orange-1'}}">
                                    {{ $av == true ? __('Available') : __('Not Available') }}
                                </td>
                                @endforeach
                            </tr>
                            <tr class="bg-gray-11">
                                <td class="text-15 text-gray-10 dm-sans font-medium py-6 pr-12 pl-6  whitespace-nowrap pt-7 text-right w-28 align-middle">{{ __('Summary') }}</td>

                                @foreach($compareItems['summary'] as $key => $summery)
                                <td class="value-{{ $key }} roboto-medium font-medium text-sm  text-gray-10 pr-4 pt-8 pb-7 w-56"> {{ $summery }}</td>
                                @endforeach

                            </tr>
                            <tr class="h-20">
                                <td class="text-15 text-gray-10 dm-sans font-medium py-6 pr-12 pl-6 text-right  whitespace-nowrap w-28">{{ __('Rating & Reviews') }}
                                </td>

                                @foreach($compareItems['rating'] as $key => $rating)
                                    <td class="value-{{ $key }}">
                                        <div class="flex items-center text-yellow-1">
                                            @if($rating > 0)
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if ($rating >= $i)
                                                        <span class="pr-1.5 value-{{$key}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                                            <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    @else
                                                        <span class="pr-1.5 value-{{$key}}">
                                                            <svg width="17" height="16" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 17 16" fill="currentColor">
                                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    @endif
                                                @endfor
                                                    <span class="rating-count roboto-medium font-medium text-13 text-gray-10"> ({{ $compareItems['ratingCount'][$key] ?? 0 }} {{ __('Reviews') }}) </span>
                                             @else
                                                 <span> {{ __('Not reviewed yet') }} </span>
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                           </tr>
                            <tr class="bg-gray-11 text-gray-10 h-20">
                                <td class="text-15 dm-sans font-medium py-6 pr-12 pl-6 text-right w-28 whitespace-nowrap">{{ __('Category') }}</td>
                                @foreach($compareItems['category'] as $key => $category)
                                <td class="value-{{ $key }} roboto-medium font-medium text-sm">{{ $category }}</td>
                                @endforeach
                            </tr>
                            <tr class="h-20 text-gray-10">
                                <td class="text-15 dm-sans font-medium py-6 pr-12 pl-6 text-right w-28 whitespace-nowrap">{{ __('SKU') }}</td>
                                @foreach($compareItems['sku'] as $key => $sku)
                                <td class="value-{{ $key }} roboto-medium font-medium text-sm">{{ $sku }}</td>
                                @endforeach
                            </tr>
                            @foreach($compareItems['allAttribute'] as $key => $attribute)
                                @if(in_array($attribute->id, $compareItems['itemAttribute']))
                                    <tr class="{{ $key%2 == 0 ? "bg-gray-11 h-20" : "h-20 text-gray-10"  }}">
                                        <td class="text-15 text-gray-10 dm-sans font-medium py-6 pr-12 pl-6 text-right w-28 whitespace-nowrap">{{ $attribute->name }}</td>
                                            @foreach($compareItems['itemId'] as $id)
                                            <td class="roboto-medium font-medium text-sm value-{{$id}}">{{ findAttributeValue($attribute->id, $id) }}</td>
                                            @endforeach
                                    </tr>
                                @endif
                            @endforeach
                            <tr class="text-gray-10 bg-gray-11 h-20">
                                <td class="text-15 dm-sans font-medium py-6 pr-12 pl-6 text-right w-28 whitespace-nowrap">{{ __('Brand') }}</td>
                                @foreach($compareItems['brand'] as $key => $brand)
                                <td class="value-{{ $key }} roboto-medium font-medium text-sm">{{ $brand }}</td>
                                @endforeach
                            </tr>
                            <tr>
                               <td class="text-15 text-gray-10 dm-sans font-medium py-6 pr-12 pl-6 align-top text-right w-28 h-20 whitespace-nowrap">{{ __('Actions') }}</td>
                                @php $userId = isset(Auth::user()->id) ? Auth::user()->id : null @endphp
                                @foreach($compareItems['itemName'] as $key => $itemName)
                               <td class="py-7 value-{{ $key }}">
                                   <div class="flex flex-col">
                                       <a href="javascript:void(0)" class="wishlist roboto-medium font-medium text-sm text-gray-10 hover:text-gray-12" data-id = {{ $key }}>
                                             {{-- Please dont remove it, keeping it for the backend functionality --}}
                                            {{-- <span>
                                                <svg class="inline-block mr-1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" class="{{ wishListActive($key, $userId) == true ? 'color_fill svg-bg' : 'text-gray-10'  }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </span>{{ __('Save for Later') }} --}}
                                            <span>
                                                <svg class="inline-block mr-1 -mt-1" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#2c2c2c" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </span>{{ __('Save for Later') }}
                                      </a>
                                       @if(!hasOption($key))
                                          <a href="javascript:void(0)" class="add-to-cart roboto-medium font-medium text-sm text-gray-10 mt-3 hover:text-gray-12" data-itemId = {{ $key }}>
                                              <span>
                                                    <svg class="inline-block mr-2 -mt-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 17 17" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7307 4.04761C4.74854 4.04761 4.76644 4.04761 4.7844 4.04761L12.2693 4.04761C12.9747 4.04757 13.5855 4.04753 14.0786 4.1121C14.6087 4.18151 15.1176 4.33748 15.5459 4.73486C15.9742 5.13223 16.1707 5.63063 16.2833 6.15751C16.388 6.64769 16.4387 7.26141 16.4973 7.97021L16.9437 13.3723C16.9451 13.3889 16.9465 13.4055 16.9478 13.422C16.9807 13.8184 17.0123 14.2 16.9952 14.5156C16.9761 14.8693 16.8915 15.2813 16.5729 15.6303C16.2544 15.9794 15.8543 16.0986 15.5062 16.1472C15.1957 16.1906 14.8159 16.1905 14.4215 16.1905C14.405 16.1905 14.3886 16.1905 14.3721 16.1905H2.62795C2.61145 16.1905 2.59497 16.1905 2.57852 16.1905C2.18406 16.1905 1.80426 16.1906 1.49376 16.1472C1.14574 16.0986 0.745622 15.9794 0.427078 15.6303C0.108534 15.2813 0.0239211 14.8693 0.00478568 14.5156C-0.0122865 14.2 0.0193263 13.8184 0.0521587 13.422C0.0535282 13.4055 0.0548997 13.3889 0.0562699 13.3723L0.498275 8.02419C0.499766 8.00615 0.501252 7.98816 0.502732 7.97023C0.561272 7.26142 0.611959 6.64769 0.716731 6.15751C0.829348 5.63063 1.02576 5.13223 1.45407 4.73486C1.88238 4.33748 2.39127 4.18151 2.92136 4.1121C3.41452 4.04753 4.0253 4.04757 4.7307 4.04761ZM3.1429 5.83235C2.79818 5.87749 2.68448 5.9506 2.61897 6.01138C2.55345 6.07217 2.47175 6.18034 2.39851 6.52298C2.32008 6.88993 2.27705 7.38994 2.21273 8.16825L1.77072 13.5164C1.73229 13.9814 1.71285 14.2403 1.72263 14.4211C1.72275 14.4234 1.72288 14.4257 1.72302 14.428C1.72523 14.4283 1.72749 14.4286 1.72979 14.429C1.90767 14.4538 2.16517 14.4558 2.62795 14.4558H14.3721C14.8348 14.4558 15.0923 14.4538 15.2702 14.429C15.2725 14.4286 15.2748 14.4283 15.277 14.428C15.2771 14.4257 15.2772 14.4234 15.2774 14.4211C15.2872 14.2403 15.2677 13.9814 15.2293 13.5164L14.7873 8.16825C14.7229 7.38994 14.6799 6.88993 14.6015 6.52298C14.5283 6.18034 14.4466 6.07217 14.381 6.01138C14.3155 5.9506 14.2018 5.87749 13.8571 5.83235C13.4879 5.78401 12.9902 5.7823 12.2156 5.7823H4.7844C4.00983 5.7823 3.51208 5.78401 3.1429 5.83235Z" fill="currentColor"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.93808 8.09521C4.44629 8.09521 4.04761 7.73278 4.04761 7.28569L4.04761 4.0476C4.04761 1.81216 6.04101 -2.31605e-05 8.49999 -2.25427e-05C10.959 -2.28786e-05 12.9524 1.81216 12.9524 4.0476L12.9524 7.28569C12.9524 7.73278 12.5537 8.09521 12.0619 8.09521C11.5701 8.09521 11.1714 7.73278 11.1714 7.28569L11.1714 4.0476C11.1714 2.70633 9.97538 1.61902 8.49999 1.61902C7.0246 1.61902 5.82856 2.70633 5.82856 4.0476L5.82856 7.28569C5.82856 7.73278 5.42988 8.09521 4.93808 8.09521Z" fill="currentColor"/>
                                                    </svg>
                                               </span>{{ __('Add to cart') }}
                                           </a>
                                       @else
                                           <a href="javascript:void(0)" class="open-view-modal roboto-medium font-medium text-sm text-gray-10 mt-3 hover:text-gray-12" data-itemId = {{ $key }}>
                                                <span>
                                                  <svg class="inline-block mr-1.5" xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.77051 9C10.8751 9 11.7705 8.10457 11.7705 7C11.7705 5.89543 10.8751 5 9.77051 5C8.66594 5 7.77051 5.89543 7.77051 7C7.77051 8.10457 8.66594 9 9.77051 9ZM9.77051 11C11.9796 11 13.7705 9.20914 13.7705 7C13.7705 4.79086 11.9796 3 9.77051 3C7.56137 3 5.77051 4.79086 5.77051 7C5.77051 9.20914 7.56137 11 9.77051 11Z" fill="#898989"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.42941 3.63233C4.11029 4.58138 3.03435 5.74418 2.35413 6.57005C2.25436 6.69118 2.17984 6.78179 2.11811 6.86149C2.06925 6.92459 2.03813 6.96852 2.01782 7C2.03813 7.03148 2.06925 7.07541 2.11811 7.13851C2.17984 7.21821 2.25436 7.30882 2.35413 7.42995C3.03435 8.25582 4.11029 9.41862 5.42941 10.3677C6.75643 11.3224 8.24447 12 9.77027 12C11.2961 12 12.7841 11.3224 14.1111 10.3677C15.4303 9.41862 16.5062 8.25582 17.1864 7.42995C17.2862 7.30882 17.3607 7.21821 17.4224 7.13851C17.4713 7.07541 17.5024 7.03147 17.5227 7C17.5024 6.96852 17.4713 6.92458 17.4224 6.86149C17.3607 6.78179 17.2862 6.69118 17.1864 6.57005C16.5062 5.74418 15.4303 4.58138 14.1111 3.63233C12.7841 2.6776 11.2961 2 9.77027 2C8.24447 2 6.75643 2.6776 5.42941 3.63233ZM4.26138 2.00884C5.76442 0.927471 7.66034 0 9.77027 0C11.8802 0 13.7761 0.927472 15.2792 2.00885C16.7901 3.0959 17.9903 4.40025 18.7302 5.29853C18.7538 5.32717 18.7784 5.35662 18.8037 5.38694C19.1171 5.76236 19.5406 6.26957 19.5406 7C19.5406 7.73043 19.1171 8.23764 18.8037 8.61306C18.7784 8.64338 18.7538 8.67283 18.7302 8.70148C17.9903 9.59976 16.7901 10.9041 15.2792 11.9912C13.7761 13.0725 11.8802 14 9.77027 14C7.66034 14 5.76442 13.0725 4.26138 11.9912C2.75044 10.9041 1.55022 9.59975 0.810357 8.70147C0.786765 8.67283 0.762175 8.64338 0.736868 8.61306C0.423444 8.23764 -5.96046e-08 7.73043 0 7C0 6.26957 0.423445 5.76236 0.736869 5.38694C0.762176 5.35662 0.786766 5.32717 0.810358 5.29852C1.55022 4.40024 2.75044 3.0959 4.26138 2.00884Z" fill="#898989"/>
                                                  </svg>
                                                </span>
                                               {{ __('Quick View') }}
                                           </a>
                                       @endif
                                   </div>
                               </td>
                                @endforeach

                            </tr>
                        </tbody>
                    </table>
                    <div id="compareEmpty" class="flex justify-center items-center flex-col mt-10 mb-20">
                        <div>
                            <img src="{{ asset('public\frontend\assets\img\compare\emp-com.svg')}}" alt="">
                        </div>
                        <div>
                            <span class="block text-center dm-sans font-medium text-gray-10 text-xl mt-7">There are no items added for comparison yet</span>
                             <span class="text-center block dm-sans font-medium text-gray-10 text-sm mt-3">To compare items,</span>
                             <span class="text-center block dm-sans font-medium text-gray-10 text-sm"> click on the <a href="#"><img class="inline px-1 cursor-pointer" src="{{ asset('public\frontend\assets\img\compare\empty-click.svg')}}" alt=""></a> button on the item page.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Compare Products end -->
    </section>
    <!-- Details section end -->



@include('../site/layouts/partials.product_section')
@endsection
@section('js')
    <script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/wishlist.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/compare.min.js') }}"></script>
@endsection
