<link rel="stylesheet" href="{{ asset('public/frontend/assets/swiper/swiper-bundle.min.css') }}">

<div id="item-view-load">
    <!--Overlay Effect-->
    <div class="fixed hidden items-center inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="view-modal">
        <!--modal content-->
        <div class="relative mx-auto p-30p border shadow-lg rounded-md bg-white w-11/12 lg:w-860p" id="view-modal-main">
            @if (isset($item))
                <button class="absolute right-3 -mt-18p open-view-modal-close">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.512559 0.512559C1.19597 -0.170853 2.304 -0.170853 2.98741 0.512559L13.4873 11.0125C14.1707 11.6959 14.1707 12.8039 13.4873 13.4873C12.8039 14.1707 11.6959 14.1707 11.0125 13.4873L0.512559 2.98741C-0.170853 2.304 -0.170853 1.19597 0.512559 0.512559Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4874 0.512559C12.804 -0.170853 11.696 -0.170853 11.0126 0.512559L0.512681 11.0125C-0.170731 11.6959 -0.170731 12.8039 0.512681 13.4873C1.19609 14.1707 2.30412 14.1707 2.98753 13.4873L13.4874 2.98741C14.1709 2.304 14.1709 1.19597 13.4874 0.512559Z" fill="#898989"/>
                    </svg>
                </button>
                <div class="placeholder-loader placeholder-loader-animation">
                    <div class="w-full">
                        <div class="sm:flex sm:space-x-5 flex w-full bg-white p-2 rounded-md">
                            <div class="w-full sm:w-1/2">
                                <div data-placeholder class="mb-2 h-40 md:h-96 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="mb-2 h-10 sm:h-16 overflow-hidden relative bg-gray-200"></div>

                            </div>
                            <div class="w-full sm:w-1/2 ml-4">
                                <div data-placeholder class="h-5 sm:h-10 mb-2 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-10 sm:h-14 mb-2 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-4 w-52 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-2 overflow-hidden relative bg-gray-200"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 item-view-content">
                        <div class="w-full xxs:w-72% xxs:transform xxs:translate-x-19% ">
                            <div class="product-left relative">
                                <div class="swiper-container product-slider mb-3 border rounded">
                                    <div class="swiper-wrapper">
                                        @foreach($item->filesUrl() as $image)
                                        @php
                                            $image = str_replace('\\', '/', $image);
                                        @endphp
                                        <div class="swiper-slide zoom" style="background-image: url({{ $image }}); object-fit:contain">
                                            <img class="zoom_img zm-img" src="{{ $image }}" alt="...">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="relative">
                                    <div class="swiper-container product-thumbs opacity-0" style="width:100%;height;400px">
                                        <div class="swiper-wrapper ml-11" style="transform: translate3d(-418.333px, 0px, 0px) !important; margin-left: calc(-3% - 5px);">
                                            @foreach($item->filesUrl() as $image)
                                            <div class="swiper-slide swiper-slidee">
                                                <img class="w-66p" src="{{ $image }}" alt="">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="swiper-button-next bg-white">
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 7L7.70711 7.70711L8.41421 7L7.70711 6.29289L7 7ZM1.70711 13.7071L7.70711 7.70711L6.29289 6.29289L0.292893 12.2929L1.70711 13.7071ZM7.70711 6.29289L1.70711 0.292893L0.292893 1.70711L6.29289 7.70711L7.70711 6.29289Z" fill="#898989"/>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-prev rotate-180 transform bg-white">
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 7L7.70711 7.70711L8.41421 7L7.70711 6.29289L7 7ZM1.70711 13.7071L7.70711 7.70711L6.29289 6.29289L0.292893 12.2929L1.70711 13.7071ZM7.70711 6.29289L1.70711 0.292893L0.292893 1.70711L6.29289 7.70711L7.70711 6.29289Z" fill="#898989"/>
                                        </svg>
                                    </div>
                                </div>

                                <div class="absolute right-6 z-20 bottom-25">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 18H11V16H14.5858L11.2929 12.7071C10.9024 12.3166 10.9024 11.6834 11.2929 11.2929C11.6834 10.9024 12.3166 10.9024 12.7071 11.2929L16 14.5858V11H18V18Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 18H0V11H2V14.5858L5.29289 11.2929C5.68342 10.9024 6.31658 10.9024 6.70711 11.2929C7.09763 11.6834 7.09763 12.3166 6.70711 12.7071L3.41421 16H7V18Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 7H16V3.41421L12.7071 6.70711C12.3166 7.09763 11.6834 7.09763 11.2929 6.70711C10.9024 6.31658 10.9024 5.68342 11.2929 5.29289L14.5858 2H11V0H18V7Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 3.41421V7H0V0H7V2H3.41421L6.70711 5.29289C7.09763 5.68342 7.09763 6.31658 6.70711 6.70711C6.31658 7.09763 5.68342 7.09763 5.29289 6.70711L2 3.41421Z" fill="#898989"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div>
                                <div class="flex items-center space-x-10p">
                                    <div class="flex-initial px-2 text-gray-10 bg-gray-11 rounded-sm">
                                        <p class="roboto-medium font-medium text-xs text-center py-1">{{ __('Category') }}: {{ optional($item->category()->first())->name }}</p>
                                    </div>
                                    <div class="flex-initial px-2 text-gray-10 bg-gray-11 rounded-sm py-1">
                                        @php
                                            $active = false;
                                            if (auth()->user()) {
                                                foreach (auth()->user()->wishlist as $key => $wishlist) {
                                                    if ($item->id == $wishlist->item_id) {
                                                        $active = true;
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{-- Wish-list --}}
                                        <div>
                                            <div class="flex items-center cursor-pointer text-transparent wishlist" data-id="{{ $item->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="{{ $active ? 'color_fill svg-bg ' : 'text-gray-10'  }} -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- Item name -->
                                <div class="mt-3" >
                                    <h2 class="text-gray-12 dm-bold font-bold text-sm sm:text-base md:text-lg lg:text-xl 2xl:text-22 -mt-1">{{ $item->name }}</h2>
                                </div>
                                <!-- Price -->
                                <div class="flex">
                                    @if ($item->isDiscountable())
                                        <p class="dm-bold">
                                            <span class="text-lg text-gray-12">{{ $currency_symbol }}</span> <span class="text-2.5xl text-gray-12" id="item_priceV">{{  formatCurrencyAmount($item->discounted_price) }}</span>
                                            /
                                            <span class="text-lg line-through text-gray-10 pl-1 mt-0.5">{{ $currency_symbol }}{{ formatCurrencyAmount($item->price) }}</span>
                                        </p>
                                    @else
                                        <p class="dm-bold">
                                            <span class="text-lg text-gray-12">{{ $currency_symbol }}</span> <span class="text-xl md:text-2.5xl text-gray-12" id="item_priceV">{{ formatCurrencyAmount($item->price) }}</span>
                                        </p>
                                    @endif
                                </div>

                                <div class="h-25 md:h-40 lg:h-52 overflow-auto scroll-options sm:pb-3">
                                    @php
                                        $count = 0 ;
                                        $optionBox = 0;
                                    @endphp
                                    @foreach($item->itemOption as $key => $option)
                                        @php
                                            $payloads = json_decode($option->payloads)
                                        @endphp
                                        <!-- Color section -->
                                        @if ($option->type == 'dropdown' && $option->name == "Color")
                                            <div class="flex mt-5">
                                                <p class="text-gray-12 w-1/5 text-sm mt-0.5 font-medium roboto-medium {{ $option->is_required == 1 ? 'require' : '' }}"> {{ $option->name }}</p>
                                                <div class="flex flex-wrap space-x-8 w-4/5 ml-2">
                                                    @foreach($payloads->label as $payKey => $label)
                                                        @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                            @php
                                                                $colorClass = '';
                                                                $colors = getColor();
                                                                $colorsKey = array_keys(getColor());
                                                                if (in_array(strtolower($label), $colorsKey)) {
                                                                    $colorClass = $colors[strtolower($label)];
                                                                } else {
                                                                    $colorClass = 'bg-custom-white black-check';
                                                                }
                                                            @endphp
                                                            <div class="round">
                                                                <input type="checkbox" id="checkbox-{{$count}}" class="fixed singleCheckBoxV option_priceV {{ $option->is_required == 1 ? 'required-optionV' : '' }} multiChkV-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count }}" data-option="{{ $optionBox }}" data-inputType="checkbox" data-optionRealId = "{{ $option->id }}"/>
                                                                <label class="{{ $colorClass }}" for="checkbox-{{$count++}}"></label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Size section -->
                                        @elseif ($option->type == 'dropdown' && $option->name == "Size")
                                            <div class="flex mt-5 pl-1">
                                                <p class="w-1/5 text-gray-12 text-sm font-medium roboto-medium {{ $option->is_required == 1 ? 'require' : '' }}">{{ $option->name }}</p>
                                                <div class="flex flex-wrap">
                                                    @foreach($payloads->label as $payKey => $label)
                                                        @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                            <div class="squre w-16 mr-3 mb-5">
                                                                <input type="checkbox" id="checkbox-{{$count}}" class="singleCheckBoxV option_priceV {{ $option->is_required == 1 ? 'required-optionV' : '' }} multiChkV-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count }}" data-option="{{ $optionBox }}" data-inputType="checkbox" data-optionRealId = "{{ $option->id }}"/>
                                                                <label class="{{ isset($item->itemDetail) && $item->itemDetail->is_track_inventory == 1 && !isStockAvailable($option->id, $label) ? 'check-disable' : '' }}" for="checkbox-{{$count++}}">{{ $label }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <a href=""> <p class="text-gray-10 text-sm font-medium roboto-medium ml-23 -mt-2">{{ __('See size guide') }}</p>
                                            </a>
                                        @elseif($option->type == 'dropdown')

                                            <div class="flex mt-5 option-select items-center">
                                                <h4 class="text-gray-12 text-sm font-medium roboto-medium mr-2 w-1/5 {{ $option->is_required == 1 ? 'require' : '' }}">
                                                    {{ $option->name }}
                                                </h4>
                                                <select name="option[]"
                                                    class="option_priceV {{ $option->is_required == 1 ? 'required-optionV' : '' }} outline-none rounded border border-gray-2 block whitespace-no-wrap text-gray-10 text-sm font-medium roboto-medium bg-white w-36 z-20">
                                                    <option class="border-none" value="" data-optionId="{{ $count++ }}"
                                                        data-option="{{ $optionBox }}">{{ __('Select One') }}</option>
                                                    @foreach($payloads->label as $payKey => $label)
                                                        @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                        <option class="border-none h-10" value="{{ $label }}"
                                                            data-price="{{ $payloads->option_price[$payKey]->option_price }}"
                                                            data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}"
                                                            data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">{{ $label }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @elseif($option->type == 'checkbox')
                                                <!-- Only one checkbox select -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <div>
                                                            @foreach($payloads->label as $payKey => $label)
                                                                @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                                    <div>
                                                                        <label for="option" class="inline-flex items-center">
                                                                            <input type="checkbox" class="radio singleCheckBoxV option_priceV multiChkV-{{$optionBox}}" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                                            <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'checkbox_custom')
                                                <!-- Multiple(custom) checkbox select -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        @foreach($payloads->label as $payKey => $label)
                                                            <label class="flex items-center">
                                                                <input type="checkbox" class="form-checkbox customCheckBoxV-{{$optionBox}} option_priceV" value="{{ $label }}" name="option[]" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" id="multipleV-{{ $optionBox }}">
                                                                <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'radio')
                                                <!-- Only one(custom) radio button select -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8 ">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <div>
                                                            @foreach($payloads->label as $payKey => $label)
                                                                @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                                    <div>
                                                                        <label for="option_priceV" class="inline-flex items-center">
                                                                            <input type="radio" class="form-radio option_priceV multiChkV-{{$optionBox}}" name="option-{{ $optionBox }}[]" value="{{ $label }}" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                                            <span class="ml-2 text-sm text-gray-500">{{ $label }}</span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'radio_custom')
                                            @elseif($option->type == 'multiple_select')
                                                <!-- Multiple dropdown select -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 mt-10 px-0 sm:px-5">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <div>
                                                            <select x-cloak  name="option[]" class="option_priceV multiple_select" id="multipleV-{{ $optionBox }}">
                                                                @foreach($payloads->label as $payKey => $label)
                                                                    @if(isset($payloads->option_status[$payKey]) && $payloads->option_status[$payKey] == 'Active')
                                                                        <option value="{{ $label }}" data-price="{{ $payloads->option_price[$payKey]->option_price }}" data-type="{{ $payloads->option_price_type[$payKey] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">{{ $label }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                            <div x-data="dropdown()" x-init="loadOptions()" class="flex">
                                                                <input name="values" type="hidden" x-bind:value="selectedValues()">
                                                                <div class="inline-block relative w-64">
                                                                    <div class="flex flex-col items-center relative">
                                                                        <div x-on:click="open" class="w-full">
                                                                            <div class=" p-1 flex border border-gray-200 bg-white rounded">
                                                                                <div class="flex flex-auto flex-wrap">
                                                                                    <template x-for="(option,index) in selected"
                                                                                            :key="options[option].value">
                                                                                        <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded bg-gray-100 border">
                                                                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                                                options[option] x-text="options[option].text">
                                                                                            </div>
                                                                                            <div class="flex flex-auto flex-row-reverse">
                                                                                                <div x-on:click.stop="remove(index,option)">
                                                                                                    <svg class="fill-current h-4 w-4" role="button" viewBox="0 0 20 20">
                                                                                                        <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                                                            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                                                            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                                                            C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                                                                    </svg>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </template>
                                                                                    <div x-show="selected.length == 0" class="flex-1">
                                                                                        <input placeholder="Select a option"
                                                                                            class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                                                                            x-bind:value="selectedValues()">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                                                                    <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                                        <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                                            <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                                                                c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                                                                L17.418,6.109z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                    <button type="button" x-show="isOpen() === false" @click="close"
                                                                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                                            <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                                                                c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                                                                " />
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w-full px-4">
                                                                            <div x-show.transition.origin.top="isOpen()"
                                                                                class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select"
                                                                                x-on:click.away="close">
                                                                                <div class="flex flex-col w-full overflow-y-auto">
                                                                                    <template x-for="(option,index) in options" :key="option"
                                                                                            class="overflow-auto">
                                                                                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100"
                                                                                            @click="select(index,$event)">
                                                                                            <div
                                                                                                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                                                                <div class="w-full items-center flex justify-between">
                                                                                                    <div class="mx-2 leading-6" x-model="option"
                                                                                                        x-text="option.text"></div>
                                                                                                    <div x-show="option.selected">
                                                                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                                                                            <path fill="none"
                                                                                                                d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                                                                                C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                                                                                L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </template>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'date')
                                                <!-- Date picker -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-8">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <input class="border py-2 px-3 dark:bg-gray-2 text-gray-500 outline-none rounded" type="date"
                                                            id="date" name="optionNoLabel[]" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'date_time')
                                                <!-- Date and time picker -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-10">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <div x-data
                                                            x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: true, dateFormat: 'M j, Y h:i K'});"
                                                            x-ref="datetimewidget" class="flatpickr container mx-auto col-span-6 sm:col-span-6">

                                                            <div class="flex align-middle align-content-center">
                                                                <input x-ref="datetime" type="text" id="datetime" data-input name="optionNoLabel[]" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}" class="block px-3 border text-gray-500 outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-l-md">

                                                                <p class="h-12 w-8 input-button cursor-pointer rounded-r-md inline-block border"
                                                                    title="clear" data-clear>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 ml-1"
                                                                        viewBox="0 0 20 20" fill="#c53030">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($option->type == 'time')
                                                <!-- Time -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 px-0 sm:px-5 mt-12">
                                                    <div class="col-span-2">
                                                        <h4 class="text-gray-700 text-base rtl-direction-space uppercase {{ $option->is_required == 1 ? 'require' : '' }}">
                                                            {{ $option->name }}
                                                        </h4>
                                                    </div>
                                                    <div class="col-span-3">
                                                            <div class="p-3 w-40 bg-white rounded border">
                                                                <div class="flex">
                                                                    <select name="hours" class="bg-transparent text-sm appearance-none outline-none text-gray-500" placeholder="{{ $option->name }}" data-price="{{ $payloads->option_price[0]->option_price }}" data-type="{{ $payloads->option_price_type[0] }}" data-optionId="{{ $count++ }}" data-option="{{ $optionBox }}" data-inputType="{{ $option->type }}" data-optionRealId = "{{ $option->id }}">
                                                                        @for($hour = 1; $hour <= 12 ; $hour++)
                                                                        <option value="{{ $hour }}">{{$hour}}</option>
                                                                        @endfor
                                                                    </select>
                                                                    <span class="text-sm mr-3">:</span>
                                                                    <select name="minutes" class="bg-transparent text-sm appearance-none outline-none mr-4 text-gray-500">
                                                                        @for($minute = 0; $minute <= 59 ; $minute++)
                                                                        <option value="{{ $minute }}">{{ $minute }}</option>
                                                                        @endfor
                                                                    </select>
                                                                    <select name="ampm"
                                                                            class="bg-transparent text-sm appearance-none outline-none text-gray-500">
                                                                        <option value="am">AM</option>
                                                                        <option value="pm">PM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <label class="error display-none" id="required-msgV-{{ $optionBox }}">{{ __('Please select the option') }}</label>
                                            <span class="display-none text-color-red" id="stock_qtyV-{{ $optionBox }}"></span>
                                            @php
                                                $optionBox++
                                            @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row sm:my-4 justify-start md:space-x-3 mt-5 sm:absolute bottom-5">
                                <!-- Qty section -->
                                <div class="flex items-center sm:block">
                                    <p class="sm:hidden w-1/5 text-sm roboto-medium text-gray-12 mr-2">Qty:</p>
                                    <div class="flex flex-wrap justify-start items-center space-x-5">
                                        <div class="flex flex-wrap w-135p h-11 text-xl border rounded" id="cart-item-details-{{$item->id}}">
                                            <a href="javascript:void(0)"
                                                class="cart-item-qty-dec m-auto text-2xl flex items-center font-thin text-gray-600 hover:text-gray-700  rounded-l cursor-pointer outline-none text-center"
                                                data-itemId={{ $item->id }}><span class="inline-block">
                                                    <svg class="" width="13" height="2" viewBox="0 0 13 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13 2H0L0 0H13V2Z" fill="#898989"/>
                                                    </svg>
                                                </span>
                                            </a>

                                            <div class="flex items-center dm-bold font-bold text-20 text-gray-12 text-center cart-item-quantity">1</div>
                                            <a href="javascript:void(0)"
                                                class="cart-item-qty-inc m-auto flex items-center text-2xl font-thin text-gray-600 hover:text-gray-700 h-10 rounded-r cursor-pointer text-center"
                                                data-itemId={{ $item->id }}> <span class="inline-block">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87909 -8.02595e-08L8.87909 14.077L7.04297 14.077L7.04297 0L8.87909 -8.02595e-08Z" fill="#898989"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.95643L0.923044 7.95642L0.923044 6.1203L15 6.1203L15 7.95643Z" fill="#898989"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 md:mt-0">
                                    <a href="javascript:void(0)" class="add-to-cart" id="item-add-to-cart" data-itemId={{ $item->id }}>
                                        <button
                                            class="bg-yellow-1 font-bold w-full sm:w-44 h-11 rounded flex justify-center items-center">
                                            <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.88135 10C5.32906 10 4.88135 9.55228 4.88135 9L4.88135 5C4.88135 2.23858 7.11992 -1.25946e-06 9.88135 -6.82991e-07C12.6428 -1.0602e-06 14.8813 2.23858 14.8813 5L14.8813 9C14.8813 9.55228 14.4336 10 13.8813 10C13.3291 10 12.8813 9.55228 12.8813 9L12.8813 5C12.8813 3.34315 11.5382 2 9.88135 2C8.22449 2 6.88135 3.34314 6.88135 5L6.88135 9C6.88135 9.55228 6.43363 10 5.88135 10Z" fill="#2c2c2c"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.49955 5C5.52029 5 5.5411 5 5.56198 5L14.2634 5C15.0834 4.99996 15.7934 4.99991 16.3668 5.07436C16.983 5.15438 17.5746 5.33421 18.0725 5.79236C18.5704 6.25051 18.7988 6.82513 18.9297 7.4326C19.0515 7.99774 19.1104 8.70533 19.1785 9.52254L19.6975 15.7509C19.6991 15.77 19.7007 15.7891 19.7023 15.8081C19.7404 16.2651 19.7772 16.7051 19.7573 17.069C19.7351 17.4768 19.6367 17.9518 19.2664 18.3542C18.8961 18.7567 18.431 18.8941 18.0264 18.9502C17.6654 19.0002 17.2239 19.0001 16.7653 19C16.7462 19 16.727 19 16.7079 19H3.05505C3.03587 19 3.01671 19 2.99759 19C2.53902 19.0001 2.09749 19.0002 1.73653 18.9502C1.33195 18.8941 0.866803 18.7567 0.496488 18.3542C0.126173 17.9518 0.0278088 17.4768 0.00556347 17.069C-0.0142834 16.7051 0.0224672 16.2651 0.0606358 15.8081C0.0622278 15.7891 0.0638222 15.77 0.0654151 15.7509L0.579256 9.58478C0.58099 9.56397 0.582717 9.54323 0.584438 9.52256C0.652492 8.70535 0.711417 7.99775 0.833217 7.4326C0.964137 6.82513 1.19247 6.25051 1.69039 5.79236C2.18831 5.33421 2.77991 5.15438 3.39615 5.07436C3.96946 4.99991 4.67951 4.99996 5.49955 5ZM3.6537 7.05771C3.25295 7.10975 3.12078 7.19404 3.04461 7.26412C2.96844 7.33421 2.87347 7.45892 2.78833 7.85396C2.69715 8.27703 2.64713 8.85352 2.57235 9.75087L2.05851 15.917C2.01383 16.4531 1.99123 16.7516 2.00259 16.96C2.00274 16.9627 2.00289 16.9654 2.00305 16.968C2.00562 16.9684 2.00825 16.9687 2.01093 16.9691C2.21772 16.9977 2.51706 17 3.05505 17H16.7079C17.2458 17 17.5452 16.9977 17.752 16.9691C17.7547 16.9687 17.7573 16.9684 17.7599 16.968C17.76 16.9654 17.7602 16.9627 17.7603 16.96C17.7717 16.7516 17.7491 16.4531 17.7044 15.917L17.1906 9.75087C17.1158 8.85352 17.0658 8.27703 16.9746 7.85396C16.8894 7.45892 16.7945 7.33421 16.7183 7.26412C16.6421 7.19404 16.51 7.10975 16.1092 7.05771C15.68 7.00198 15.1014 7 14.2009 7H5.56198C4.66152 7 4.08288 7.00198 3.6537 7.05771Z" fill="#2c2c2c"/>
                                            </svg>
                                            <span class="pl-2 p-5p dm-bold font-bold text-gray-12 text-lg">{{ __('Add to Cart') }}</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @else
            <div class="w-full flex placeholder-loader-animation">
                <div class="sm:flex sm:space-x-5 w-full bg-white p-2 rounded-md">
                    <div class="w-full sm:w-1/2">
                        <div data-placeholder class="mb-2 h-40 sm:h-96 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="mb-2 h-10 sm:h-16 overflow-hidden relative bg-gray-200"></div>

                    </div>
                    <div class="w-full sm:w-1/2">
                        <div data-placeholder class="h-5 sm:h-10 mb-2 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-10 sm:h-14 mb-2 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-5 sm:h-10 mb-4 w-52 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-5 sm:h-10 mb-3 w-40 overflow-hidden relative bg-gray-200"></div>
                        <div data-placeholder class="h-5 sm:h-10 mb-2 overflow-hidden relative bg-gray-200"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    var slideImagecount = @php
        echo isset($item) && $item->filesUrl() ? count($item->filesUrl()) : 0;
     @endphp;
</script>
<script defer src="{{ asset('public/frontend/assets/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/item-view.min.js') }}"></script>
