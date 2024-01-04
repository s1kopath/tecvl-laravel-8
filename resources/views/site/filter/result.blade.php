<div class="flex search-result">
    <div class="w-24% mt-19p hidden md:block">
        <div class="border rounded-md px-5 pt-30p pb-2.5">
            <div class="flex justify-between">
                <p class="uppercase roboto-medium text-lg text-gray-12">{{ __('Filters') }}</p>
                <div class="flex items-center clear_all">
                    <p class="mr-1.5 roboto-medium text-xs text-gray-10 font-medium cursor-pointer">{{ __('Clear All') }}</p>
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L7.70711 6.29289C8.09763 6.68342 8.09763 7.31658 7.70711 7.70711C7.31658 8.09763 6.68342 8.09763 6.29289 7.70711L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.70711 0.292893C7.31658 -0.0976311 6.68342 -0.0976311 6.29289 0.292893L0.292893 6.29289C-0.0976315 6.68342 -0.0976315 7.31658 0.292893 7.70711C0.683417 8.09763 1.31658 8.09763 1.70711 7.70711L7.70711 1.70711C8.09763 1.31658 8.09763 0.683417 7.70711 0.292893Z" fill="#898989"/>
                    </svg>
                </div>
            </div>
            {{--category--}}
            <div class="mt-2.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Related Categories') }}
                    </h3>
                </div>
                <ul class="mt-13p cate-hover">
                    @foreach($categories as $category)
                    <li class="mt-5p category-select">
                        <a href="javascript:void(0)" class="selected roboto-medium font-medium text-15 text-gray-10 selected-category {{ isset($requestValue['data']['category']) && $requestValue['data']['category'] == $category['id'] ? 'text-color-black' : '' }}" data-id="{{ $category['id'] }}">
                            {{ $category['name'] }}
                        </a>
                    </li>
                    @endforeach
                     <input type="hidden" id="selectedCategory" value="{{ $selectedCategory }}">
                </ul>
            </div>
            {{--price range--}}
            <div class="mt-0.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Price Range') }}
                    </h3>
                </div>
                <ul class="mt-13p">
                    <li class="mt-5p">
                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 5000 && $requestValue['data']['max'] == 10000 ? 'text-color-black' : '' }}" data-min="5000" data-max="10000">
                            $5000 - $10000
                        </a>
                    </li>

                    <li class="mt-5p">
                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 1000 && $requestValue['data']['max'] == 5000 ? 'text-color-black' : '' }}" data-min="1000" data-max="5000">
                            $1000 - $5000
                        </a>
                    </li>

                    <li class="mt-5p">
                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 100 && $requestValue['data']['max'] == 1000 ? 'text-color-black' : '' }}" data-min="100" data-max="1000">
                            $100 - $1000
                        </a>
                    </li>

                    <li class="mt-5p">
                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 10 && $requestValue['data']['max'] == 100 ? 'text-color-black' : '' }}" data-min="10" data-max="100">
                            $10 - $100
                        </a>
                    </li>
                </ul>
            </div>
            {{--min max--}}
            <form class="mt-18p">
                <div class="flex mb-2">
                    <div class="flex items-center">
                        <label class="block tracking-wide text-gray-10 text-sm roboto-medium font-medium mr-7p" for="Min-range">
                            {{ __('Min') }}.
                        </label>
                        <input class="appearance-none block w-68p h-30p text-gray-10 text-sm font-medium  border border-solid border-gray-200 rounded-sm focus:outline-none focus:bg-white focus:border-gray-500 min_desktop positive-int-number" id="price_minimum" type="text" placeholder="" value="{{ isset($requestValue['data']['min']) && strlen($requestValue['data']['min']) > 0 ? $requestValue['data']['min'] : ''  }}">
                    </div>

                    <div class="flex items-center ml-13p">
                        <label class="block tracking-wide text-gray-10 text-sm font-medium  roboto-medium mr-7p" for="Max-range">
                            {{ __('Max') }}.
                        </label>
                        <input class="appearance-none block w-68p h-30p text-gray-10 text-sm font-medium border border-solid border-gray-200 rounded-sm focus:outline-none focus:bg-white focus:border-gray-500 max_desktop positive-int-number" id="price_maximum" type="text" placeholder="" value="{{ isset($requestValue['data']['max']) && strlen($requestValue['data']['max']) > 0 ? $requestValue['data']['max'] : ''  }}">
                    </div>
                </div>
                <button class="px-2 border rounded mt-2 dm-bold text-sm text-gray-12 w-full h-10 hover:border-gray-12 duration-100 button-update">
                    {{ __('Update') }}
                </button>
            </form>
            {{--color--}}
            @php $count = 0; @endphp
            @foreach($itemOptions as $option)
                @if($option['option'] == "Color")
            <div class="mt-1.5">
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ $option['option'] }}
                    </h3>
                </div>
                <div class="mt-18p">
                    @foreach($option['label'] as $key => $label)
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
                    <div class="flex items-center c-check mb-2.5 relative">
                        <div class="rounds relative -ml-4">
                            <input type="checkbox" id="result-checkbox-{{ $count }}" name="label[]" data-inputtype="checkbox" class="option-checkbox" data-option="{{ $option['option'] }}" value="{{ $label }}" {{ isset($requestValue['data']['options']) && isset($requestValue['data']['labels']) && in_array($option['option'], $requestValue['data']['options']) && in_array($label, $requestValue['data']['labels']) ? 'checked' : '' }}>
                            <label class="{{ $colorClass }}" for="result-checkbox-{{ $count }}"></label>
                        </div>
                        <label for="checkbox-{{ $count++ }}" class="flex items-center ml-8 roboto-medium text-15 text-gray-10 cursor-pointer">
                            {{ $label }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
                @else
            {{--size--}}
            <div>
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ $option['option'] }}
                    </h3>
                </div>
                <div class="mt-4">
                    @foreach($option['label'] as $key => $label)
                    <div class="flex items-center c-check mb-5p">
                        <input id="result-checkbox-{{ $count }}" type="checkbox" name="label[]" data-option="{{ $option['option'] }}" value="{{ $label }}" class="option-checkbox" {{ isset($requestValue['data']['options']) && isset($requestValue['data']['labels']) && in_array($option['option'], $requestValue['data']['options']) && in_array($label, $requestValue['data']['labels']) ? 'checked' : '' }}>
                        <label for="result-checkbox-{{ $count }}" class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                            {{ $label }}
                        </label>
                    </div>
                        @php $count++ @endphp
                    @endforeach
                </div>
            </div>
                @endif
            @endforeach
            {{--Brand & Option--}}
            <div>
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Brand') }}
                    </h3>
                </div>
                <div class="mt-15p">
                    @foreach($brandIdNames as $key => $brand)
                    <div class="flex items-center c-check mb-5p relative">
                        <input id="brand-checkbox-{{ $key }}" class="item-brand" type="checkbox" name="brands[]" data-id="{{ $brand['id'] }}" value="{{ $brand['id'] }}" {{ isset($requestValue['data']['brands']) && in_array($brand['id'], $requestValue['data']['brands']) ? 'checked' : '' }}>
                        <label for="brand-checkbox-{{ $key }}" class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                            {{ $brand['name'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            {{--ratings--}}
            <div>
                <div class="border-one pb-3">
                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                        {{ __('Ratings') }}
                    </h3>
                </div>

                <div class="radio-stars mt-0.5">
                    @for($i = 1; $i <= 5; $i++)
                    <input class="sr-only" id="radio-{{ $i }}" name="radio-star" class="item-ratings" type="radio" value="{{ $i }}" {{ isset($requestValue['data']['rating']) && $requestValue['data']['rating'] == $i ? 'checked' : '' }}/>
                    <label class="radio-star item-ratings" for="radio-{{ $i }}" data-rating="{{ $i }}"></label>
                    @endfor
                    <span class="radio-star-total roboto-medium"> {{ __('Stars') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="z-50 fixed w-full min-h-screen top-0 right-0 bg-darken-4 overlay-test hidden"></div>
    <div class="w-full md:w-76% mt-2.5 pb-14">
        <div class="flex justify-between">
            <div id="res-drawer" class="md:hidden">
                <div id="filter-btn" class="mt-2">
                    <button class="bg-gray-12 text-white x:text-xs text-sm rounded x:px-2 px-6 x:py-2.5 py-2">
                        <span class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.16753 6.5C1.76866 6.5 1.44531 6.17665 1.44531 5.77778L1.44531 0.722222C1.44531 0.32335 1.76866 -2.82681e-08 2.16753 -6.31387e-08C2.56641 -9.80092e-08 2.88976 0.32335 2.88976 0.722222L2.88976 5.77778C2.88976 6.17665 2.56641 6.5 2.16753 6.5Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.49957 3.61108C6.10069 3.61108 5.77734 3.28773 5.77734 2.88886L5.77734 0.722195C5.77734 0.323323 6.10069 -2.72457e-05 6.49957 -2.7327e-05C6.89844 -2.74084e-05 7.22179 0.323322 7.22179 0.722195L7.22179 2.88886C7.22179 3.28773 6.89844 3.61108 6.49957 3.61108Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.16753 11.5557C1.76866 11.5557 1.44531 11.2323 1.44531 10.8334L1.44531 8.66678C1.44531 8.2679 1.76866 7.94455 2.16753 7.94455C2.56641 7.94455 2.88976 8.2679 2.88976 8.66677L2.88976 10.8334C2.88976 11.2323 2.56641 11.5557 2.16753 11.5557Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8336 11.5557C10.4347 11.5557 10.1113 11.2323 10.1113 10.8334L10.1113 9.389C10.1113 8.99013 10.4347 8.66678 10.8335 8.66678C11.2324 8.66677 11.5558 8.99012 11.5558 9.389L11.5558 10.8334C11.5558 11.2323 11.2324 11.5557 10.8336 11.5557Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.49957 11.5557C6.10069 11.5557 5.77734 11.2323 5.77734 10.8334L5.77734 5.77789C5.77734 5.37901 6.10069 5.05566 6.49956 5.05566C6.89844 5.05566 7.22179 5.37901 7.22179 5.77789L7.22179 10.8334C7.22179 11.2323 6.89844 11.5557 6.49957 11.5557Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.33203 2.88897C4.33203 2.4901 4.65538 2.16675 5.05425 2.16675L7.94314 2.16675C8.34201 2.16675 8.66536 2.4901 8.66536 2.88897C8.66536 3.28784 8.34201 3.61119 7.94314 3.61119L5.05425 3.61119C4.65538 3.61119 4.33203 3.28784 4.33203 2.88897Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8.66656C0 8.26769 0.32335 7.94434 0.722222 7.94434L3.61111 7.94434C4.00998 7.94434 4.33333 8.26769 4.33333 8.66656C4.33333 9.06543 4.00998 9.38878 3.61111 9.38878H0.722222C0.32335 9.38878 0 9.06543 0 8.66656Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.66797 9.38897C8.66797 8.9901 8.99132 8.66675 9.39019 8.66675H12.2791C12.678 8.66675 13.0013 8.9901 13.0013 9.38897C13.0013 9.78784 12.678 10.1112 12.2791 10.1112H9.39019C8.99132 10.1112 8.66797 9.78784 8.66797 9.38897Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8336 7.22217C10.4347 7.22217 10.1113 6.89882 10.1113 6.49995L10.1113 0.722168C10.1113 0.323296 10.4347 -5.43842e-05 10.8335 -5.44147e-05C11.2324 -5.44452e-05 11.5558 0.323295 11.5558 0.722168L11.5558 6.49995C11.5558 6.89882 11.2324 7.22217 10.8336 7.22217Z" fill="white"/>
                                </svg>
                        </span>
                        Filter
                    </button>
                </div>
                <div id="filter-nav" class="overflow-auto min-h-screen w-63 bg-white fixed top-0 right-0 bottom-0 z-50">
                   <div>
                        <div class="border rounded-md px-5 pt-30p pb-2.5">
                            <div class="flex justify-between">
                                <p class="uppercase roboto-medium text-lg text-gray-12">{{ __('Filters') }}</p>
                                <div class="flex items-center clear_all">
                                    <p class="mr-1.5 roboto-medium text-xs text-gray-10 font-medium cursor-pointer">{{ __('Clear All') }}</p>
                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L7.70711 6.29289C8.09763 6.68342 8.09763 7.31658 7.70711 7.70711C7.31658 8.09763 6.68342 8.09763 6.29289 7.70711L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.70711 0.292893C7.31658 -0.0976311 6.68342 -0.0976311 6.29289 0.292893L0.292893 6.29289C-0.0976315 6.68342 -0.0976315 7.31658 0.292893 7.70711C0.683417 8.09763 1.31658 8.09763 1.70711 7.70711L7.70711 1.70711C8.09763 1.31658 8.09763 0.683417 7.70711 0.292893Z" fill="#898989"/>
                                    </svg>
                                </div>
                            </div>
                            {{--category--}}
                            <div class="mt-2.5">
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ __('Related Categories') }}
                                    </h3>
                                </div>
                                <ul class="mt-13p cate-hover">
                                    @foreach($categories as $category)
                                    <li class="mt-5p category-select">
                                        <a href="javascript:void(0)" class="selected roboto-medium font-medium text-15 text-gray-10 selected-category {{ isset($requestValue['data']['category']) && $requestValue['data']['category'] == $category['id'] ? 'text-color-black' : '' }}" data-id="{{ $category['id'] }}">
                                            {{ $category['name'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                    <input type="hidden" id="selectedCategory" value="{{ $selectedCategory }}">
                                </ul>
                            </div>
                            {{--price range--}}
                            <div class="mt-0.5">
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ __('Price Range') }}
                                    </h3>
                                </div>
                                <ul class="mt-13p">
                                    <li class="mt-5p">
                                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 5000 && $requestValue['data']['max'] == 10000 ? 'text-color-black' : '' }}" data-min="5000" data-max="10000">
                                            $5000 - $10000
                                        </a>
                                    </li>

                                    <li class="mt-5p">
                                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 1000 && $requestValue['data']['max'] == 5000 ? 'text-color-black' : '' }}" data-min="1000" data-max="5000">
                                            $1000 - $5000
                                        </a>
                                    </li>

                                    <li class="mt-5p">
                                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 100 && $requestValue['data']['max'] == 1000 ? 'text-color-black' : '' }}" data-min="100" data-max="1000">
                                            $100 - $1000
                                        </a>
                                    </li>

                                    <li class="mt-5p">
                                        <a href="javascript:void(0)" class="roboto-medium font-medium text-15 text-gray-10 price_range {{ isset($requestValue['data']['min']) && isset($requestValue['data']['max']) && $requestValue['data']['min'] == 10 && $requestValue['data']['max'] == 100 ? 'text-color-black' : '' }}" data-min="10" data-max="100">
                                            $10 - $100
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            {{--min max--}}
                            <form class="mt-18p">
                                <div class="flex mb-2">
                                    <div class="flex items-center">
                                        <label class="block tracking-wide text-gray-10 text-sm roboto-medium font-medium mr-7p" for="Min-range">
                                            {{ __('Min') }}.
                                        </label>
                                        <input class="appearance-none block w-68p h-30p text-gray-10 text-sm font-medium  border border-solid border-gray-200 rounded-sm focus:outline-none focus:bg-white focus:border-gray-500 min_desktop positive-int-number" id="price_minimum" type="text" placeholder="" value="{{ isset($requestValue['data']['min']) && strlen($requestValue['data']['min']) > 0 ? $requestValue['data']['min'] : ''  }}">
                                    </div>

                                    <div class="flex items-center ml-13p">
                                        <label class="block tracking-wide text-gray-10 text-sm font-medium  roboto-medium mr-7p" for="Max-range">
                                            {{ __('Max') }}.
                                        </label>
                                        <input class="appearance-none block w-68p h-30p text-gray-10 text-sm font-medium border border-solid border-gray-200 rounded-sm focus:outline-none focus:bg-white focus:border-gray-500 max_desktop positive-int-number" id="price_maximum" type="text" placeholder="" value="{{ isset($requestValue['data']['max']) && strlen($requestValue['data']['max']) > 0 ? $requestValue['data']['max'] : ''  }}">
                                    </div>
                                </div>
                                <button class="px-2 border rounded mt-2 dm-bold text-sm text-gray-12 w-full h-10 hover:border-gray-12 duration-100 button-update">
                                    {{ __('Update') }}
                                </button>
                            </form>
                            {{--color--}}
                            @php $count = 0; @endphp
                            @foreach($itemOptions as $option)
                                @if($option['option'] == "Color")
                            <div class="mt-1.5">
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ $option['option'] }}
                                    </h3>
                                </div>
                                <div class="mt-18p">
                                    @foreach($option['label'] as $key => $label)
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
                                    <div class="flex items-center c-check mb-2.5 relative">
                                        <div class="rounds relative -ml-4">
                                            <input type="checkbox" id="result-checkbox-{{ $count }}" name="label[]" data-inputtype="checkbox" class="option-checkbox" data-option="{{ $option['option'] }}" value="{{ $label }}" {{ isset($requestValue['data']['options']) && isset($requestValue['data']['labels']) && in_array($option['option'], $requestValue['data']['options']) && in_array($label, $requestValue['data']['labels']) ? 'checked' : '' }}>
                                            <label class="{{ $colorClass }}" for="result-checkbox-{{ $count }}"></label>
                                        </div>
                                        <label for="checkbox-{{ $count++ }}" class="flex items-center ml-8 roboto-medium text-15 text-gray-10 cursor-pointer">
                                            {{ $label }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                                @else
                            {{--size--}}
                            <div>
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ $option['option'] }}
                                    </h3>
                                </div>
                                <div class="mt-4">
                                    @foreach($option['label'] as $key => $label)
                                    <div class="flex items-center c-check mb-5p">
                                        <input id="result-checkbox-{{ $count }}" type="checkbox" name="label[]" data-option="{{ $option['option'] }}" value="{{ $label }}" class="option-checkbox" {{ isset($requestValue['data']['options']) && isset($requestValue['data']['labels']) && in_array($option['option'], $requestValue['data']['options']) && in_array($label, $requestValue['data']['labels']) ? 'checked' : '' }}>
                                        <label for="result-checkbox-{{ $count }}" class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                                            {{ $label }}
                                        </label>
                                    </div>
                                        @php $count++ @endphp
                                    @endforeach
                                </div>
                            </div>
                                @endif
                            @endforeach
                            {{--Brand & Option--}}
                            <div>
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ __('Brand') }}
                                    </h3>
                                </div>
                                <div class="mt-15p">
                                    @foreach($brandIdNames as $key => $brand)
                                    <div class="flex items-center c-check mb-5p relative">
                                        <input id="brand-checkbox-{{ $key }}" class="item-brand" type="checkbox" name="brands[]" data-id="{{ $brand['id'] }}" value="{{ $brand['id'] }}" {{ isset($requestValue['data']['brands']) && in_array($brand['id'], $requestValue['data']['brands']) ? 'checked' : '' }}>
                                        <label for="brand-checkbox-{{ $key }}" class="flex items-center ml-3 roboto-medium text-15 text-gray-10 cursor-pointer">
                                            {{ $brand['name'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--ratings--}}
                            <div>
                                <div class="border-one pb-3">
                                    <h3 class="text-base roboto-medium font-medium text-gray-12">
                                        {{ __('Ratings') }}
                                    </h3>
                                </div>

                                <div class="radio-stars mt-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                    <input class="sr-only" id="radio-{{ $i }}" name="radio-star" class="item-ratings" type="radio" value="{{ $i }}" {{ isset($requestValue['data']['rating']) && $requestValue['data']['rating'] == $i ? 'checked' : '' }}/>
                                    <label class="radio-star item-ratings" for="radio-{{ $i }}" data-rating="{{ $i }}"></label>
                                    @endfor
                                    <span class="radio-star-total roboto-medium"> {{ __('Stars') }}</span>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>

            <span class="text-left dm-sans text-lg flex justify-items-center md:pl-30p mt-3" id="found_total_item">
            </span>
            <nav class="text-right">
                <button class="rtl-direction-space-left mt-2">
                    <span class="mr-5 text-sm roboto-medium text-gray-12 hidden md:inline-block">{{ __('Sort By:') }}</span>
                    <div class="filter-dropdown dropdown rounded shadow-none border relative z-30">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> Price Low to High </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>

                        </div>
                        <input type="hidden" name="sort_by" value="Price Low to High">
                        <ul class="dropdown-menu">
                            <li id="Price Low to High" class="sort_by bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">{{ __('Price Low to High') }}</a>
                            </li>
                            <li id="Price High to Low" class="sort_by">
                                <a class="roboto-medium text-xs">{{ __('Price High to Low') }}</a>
                            </li>
                            <li id="Avg. Ratting" class="sort_by">
                                <a class="roboto-medium text-xs">{{ __('Avg. Ratting') }}</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="rtl-direction-space-left mt-2 mb-3 hidden md:inline-block">
                    <span class="mr-5 text-sm roboto-medium text-gray-12">Showing:</span>
                    <div class="dropdown rounded shadow-none border relative z-30 showing-width">
                        <div class="select flex justify-between items-center">
                            <p class="msg roboto-medium"> 1 </p>
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>

                        </div>
                        <input type="hidden" name="Showing" value="1">
                        <ul class="dropdown-menu show-list">
                            <li id="1" class="Showing text-center bg-yellow-1 text-gray-12">
                                <a class="roboto-medium text-xs">1</a>
                            </li>
                            <li id="2" class="Showing">
                                <a class="roboto-medium text-xs">2</a>
                            </li>
                            <li id="3" class="Showing">
                                <a class="roboto-medium text-xs">3</a>
                            </li>
                            <li id="4" class="Showing">
                                <a class="roboto-medium text-xs">4</a>
                            </li>
                        </ul>
                    </div>
                </button>

                <button class="ml-1.5 hidden">
                    <div class="mb-3 flex items-center c-select relative">
                        <span class="mr-2.5 text-sm roboto-medium text-gray-12">Showing:</span>
                        <select class="mi form-select w-11 appearance-none block px-3 py-1.5 text-sm roboto-regular font-normal text-gray-10 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-200
                                rounded-sm
                                transition-all
                                ease
                                m-0" aria-label="Default select example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <div class="absolute right-2">
                            <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#898989"/>
                            </svg>
                        </div>

                    </div>
                </button>

                <button type="button" class="mx-1  sm:inline-block text-gray-200 md:ml-3 duration-700" x-on:click="layout = 'grid'"
                        x-bind:class="{'text-gray-10': layout === 'grid'}">
                    <svg class="-mb-5p" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"/>
                        <path d="M6.78564 0H12.2142V5.42857H6.78564V0Z" fill="currentColor"/>
                        <path d="M13.5713 0H18.9999V5.42857H13.5713V0Z" fill="currentColor"/>
                        <path d="M13.5713 6.78564H18.9999V12.2142H13.5713V6.78564Z" fill="currentColor"/>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"/>
                        <path d="M6.78564 13.5715H12.2142V19.0001H6.78564V13.5715Z" fill="currentColor"/>
                        <path d="M13.5713 13.5715H18.9999V19.0001H13.5713V13.5715Z" fill="currentColor"/>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"/>
                        <path d="M6.78564 6.78564H12.2142V12.2142H6.78564V6.78564Z" fill="currentColor"/>
                    </svg>
                </button>

                <button type="button" class="mx-1 py-3  sm:inline-block text-gray-200 duration-700" x-on:click="layout = 'list'"
                        x-bind:class="{'text-gray-10': layout === 'list'}">
                    <svg class="-mb-5p" width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.78564 0H23.0714V5.42857H6.78564V0Z" fill="currentColor"/>
                        <path d="M0 0H5.42857V5.42857H0V0Z" fill="currentColor"/>
                        <path d="M0 6.78564H5.42857V12.2142H0V6.78564Z" fill="currentColor"/>
                        <path d="M0 13.5715H5.42857V19.0001H0V13.5715Z" fill="currentColor"/>
                        <path d="M6.78564 6.78564H23.0714V12.2142H6.78564V6.78564Z" fill="currentColor"/>
                        <path d="M6.78564 13.5715H23.0714V19.0001H6.78564V13.5715Z" fill="currentColor"/>
                    </svg>
                </button>

            </nav>
        </div>


        <div class="sm:col-span-5 md:col-span-5 lg:col-span-3 mt-8 md:mt-0"
             x-bind:class="{'pb-4 lg:col-span-2': layout === 'list','p-3 xl:col-span-2 2xl:col-span-3': layout === 'grid-two'}">

            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 md:pl-4 lg:gap-x-30p gap-y-4 lg:pl-30p mt-1"
                 x-bind:class="{'grid grid-cols-2 md:grid-cols-3': layout === 'grid','space-y-5': layout === 'list'}">
                {{-- item list --}}
                @if(count($items) > 0)
                @foreach($items as $item)
                    @if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from))
                        @if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to))
                <div x-bind:class="{'flex space-x-4 md:space-x-30p': layout === 'list',}">
                    <div class="bg-gray-11 rev-img rounded-md relative flex items-center justify-center">
                        <div x-bind:class="{'h-103p w-103p xxs:w-44 xxs:h-44 sm:h-56 sm:w-56 md:h-60 md:w-60': layout === 'list','h-40 xxs:h-48 sm:h-60 md:h-52 lg:h-60': layout === 'grid'}" class="md:p-10 flex justify-center items-center">
                            <img  x-bind:class="{'h-24 w-24 xxs:h-32 xxs:w-32 sm:h-40 sm:w-40 md:ml-1 md:h-36 md:w-36 lg:h-40 lg:w-40': layout === 'grid','h-16 w-16 xxs:h-28 xxs:w-28 sm:h-40 sm:w-40 md:h-40 md:w-40': layout === 'list'}"  src="{{ $item->fileUrl() }}"
                                 alt="">
                        </div>

                        <div class="opacity-0 md:hover:opacity-100 duration-300 absolute inset-0 z-10 flex justify-center items-center text-xl text-white font-semibold">
                            <div class="absolute flex justify-center h-6 w-6 cursor-pointer top-0 right-4">
                                <a href="javascript:void(0)" class="relative sm:px-4 py-2 w-fill">
                                    <div slot="icon" class="relative hidden md:block">
                                        @if(!hasOption($item->id))
                                            <a href="javascript:void(0)" class="add-to-cart" data-itemId={{ $item->id }}>
                                                <div class="h-7 w-7 p-1 mt-2 text-gray-12 hover:bg-yellow-1 duration-100 border border-gray-2 rounded-full bg-white flex justify-center items-center">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.99642 6.79516C3.62113 6.79516 3.31689 6.49093 3.31689 6.11564L3.31689 3.39756C3.31689 1.52111 4.83805 -4.74667e-05 6.7145 -4.70749e-05C8.59095 -4.73313e-05 10.1121 1.52111 10.1121 3.39756L10.1121 6.11564C10.1121 6.49093 9.80788 6.79517 9.43259 6.79517C9.0573 6.79517 8.75306 6.49093 8.75307 6.11564L8.75306 3.39756C8.75306 2.27169 7.84037 1.359 6.7145 1.359C5.58863 1.359 4.67594 2.27169 4.67594 3.39756L4.67594 6.11564C4.67594 6.49093 4.37171 6.79516 3.99642 6.79516Z" fill="#2C2C2C"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.73706 3.39771C3.75116 3.39771 3.7653 3.39771 3.77949 3.39771L9.69225 3.39771C10.2495 3.39767 10.732 3.39765 11.1216 3.44823C11.5403 3.50261 11.9423 3.6248 12.2807 3.93613C12.619 4.24745 12.7742 4.63792 12.8631 5.05071C12.9459 5.43474 12.9859 5.91556 13.0322 6.47087L13.3849 10.7031C13.3859 10.7161 13.387 10.7291 13.3881 10.7421C13.414 11.0526 13.439 11.3516 13.4255 11.5988C13.4104 11.876 13.3436 12.1987 13.0919 12.4722C12.8403 12.7457 12.5242 12.8391 12.2493 12.8772C12.004 12.9111 11.704 12.9111 11.3924 12.911C11.3794 12.911 11.3664 12.911 11.3533 12.911H2.07597C2.06294 12.911 2.04992 12.911 2.03692 12.911C1.72532 12.9111 1.42529 12.9111 1.18001 12.8772C0.90509 12.8391 0.589011 12.7457 0.337374 12.4722C0.0857374 12.1987 0.0188967 11.876 0.0037805 11.5988C-0.00970586 11.3516 0.015267 11.0526 0.0412033 10.7421C0.0422851 10.7291 0.0433685 10.7161 0.0444509 10.7031L0.393617 6.51316C0.394795 6.49902 0.395969 6.48493 0.397138 6.47088C0.443382 5.91557 0.483423 5.43474 0.566189 5.05071C0.655152 4.63792 0.810309 4.24745 1.14866 3.93613C1.487 3.6248 1.88901 3.50261 2.30776 3.44823C2.69733 3.39765 3.17983 3.39767 3.73706 3.39771ZM2.48276 4.79596C2.21045 4.83132 2.12063 4.8886 2.06888 4.93622C2.01712 4.98385 1.95258 5.0686 1.89473 5.33703C1.83277 5.62452 1.79878 6.01625 1.74796 6.62602L1.3988 10.816C1.36844 11.1803 1.35308 11.3832 1.36081 11.5248C1.36091 11.5266 1.36101 11.5284 1.36111 11.5302C1.36286 11.5305 1.36465 11.5307 1.36647 11.531C1.50699 11.5504 1.71039 11.552 2.07597 11.552H11.3533C11.7189 11.552 11.9223 11.5504 12.0628 11.531C12.0647 11.5307 12.0665 11.5305 12.0682 11.5302C12.0683 11.5284 12.0684 11.5266 12.0685 11.5248C12.0762 11.3832 12.0609 11.1803 12.0305 10.816L11.6813 6.62602C11.6305 6.01625 11.5965 5.62452 11.5346 5.33703C11.4767 5.0686 11.4122 4.98385 11.3604 4.93622C11.3087 4.8886 11.2189 4.83132 10.9466 4.79596C10.6549 4.75809 10.2617 4.75675 9.64983 4.75675H3.77949C3.1676 4.75675 2.7744 4.75809 2.48276 4.79596Z" fill="#2C2C2C"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        @endif
                                        @php
                                            $wishlisted = false;
                                            if (auth()->user()) {
                                                $wishlisted = $item->isWishlist($item->id, optional(auth()->user())->id);
                                            }
                                        @endphp
                                        <div data-id="{{ $item->id }}" class="wishlist h-7 w-7 p-1 mt-2 text-gray-12 hover:bg-yellow-1 duration-100 border border-gray-2 rounded-full bg-white flex justify-center items-center {{ $wishlisted ? 'remove-wishlist bg-yellow-1' : 'add-wishlist' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div data-itemId="{{ $item->id }}" class="h-7 w-7 mt-2 text-gray-12 hover:bg-yellow-1 border border-gray-2 duration-100 rounded-full bg-white flex justify-center items-center add-to-compare">
                                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.04937 0.737095C2.01173 0.743939 1.89539 0.767892 1.79274 0.788423C1.69008 0.808954 1.46082 0.8945 1.28288 0.980046C1.01256 1.11008 0.9099 1.18193 0.677215 1.41462C0.44453 1.65073 0.372671 1.74996 0.242641 2.02029C0.0407524 2.44117 -0.00373152 2.63964 -0.000309674 3.09474C0.00653401 3.66277 0.170782 4.11103 0.547185 4.56956C0.776448 4.84673 1.22129 5.14443 1.59427 5.26419L1.72088 5.30525L1.73456 8.16933C1.74825 11.3516 1.73456 11.1737 1.98436 11.6836C2.27864 12.2892 2.84324 12.7478 3.50708 12.9188C3.68501 12.9668 3.95192 12.9804 4.93741 12.9907L6.14874 13.0078L5.69706 13.4595L5.2488 13.9078L5.65942 14.3184L6.07004 14.729L7.06579 13.7367C7.61329 13.1892 8.08208 12.6964 8.10946 12.6348C8.17105 12.4945 8.17105 12.3098 8.10946 12.1695C8.08208 12.1079 7.61329 11.6151 7.06579 11.0676L6.07004 10.0753L5.65942 10.4859L5.2488 10.8965L5.70048 11.3516L6.15558 11.8068L4.94083 11.7965L3.72608 11.7862L3.55498 11.6938C3.34967 11.5843 3.13068 11.3619 3.02118 11.1532L2.93905 10.9992L2.92879 8.15223L2.92194 5.30868L3.04855 5.26419C4.08195 4.93227 4.76632 3.87492 4.63971 2.821C4.51994 1.84919 3.90059 1.10665 2.97327 0.822641C2.74401 0.750783 2.19993 0.699455 2.04937 0.737095ZM2.59687 1.93132C3.1341 2.07161 3.47628 2.50961 3.47628 3.06053C3.47628 3.33427 3.41469 3.53274 3.26071 3.74147C3.04513 4.04602 2.71321 4.21026 2.32312 4.21369C1.76878 4.21369 1.33079 3.8715 1.19049 3.32059C1.03993 2.71834 1.41291 2.10241 2.03226 1.93474C2.27521 1.86972 2.35392 1.86972 2.59687 1.93132Z" fill="#2C2C2C"/>
                                                <path d="M6.90107 1.74983C6.35015 2.30075 5.88478 2.79692 5.86425 2.84825C5.81634 2.9817 5.81976 3.16305 5.87794 3.29308C5.90531 3.35468 6.3741 3.84742 6.9216 4.39492L7.91735 5.38725L8.32797 4.97663L8.7386 4.56601L8.28691 4.1109L7.83181 3.6558L9.04656 3.66607L10.2613 3.67633L10.4324 3.76872C10.6377 3.87822 10.8567 4.10064 10.9662 4.30937L11.0483 4.46335L11.0586 7.31033L11.0654 10.1539L10.9388 10.1984C10.5248 10.3318 10.0697 10.65 9.81305 10.9922C9.48798 11.42 9.34084 11.8614 9.34084 12.402C9.34084 13.0522 9.56326 13.586 10.0218 14.0445C10.3263 14.3491 10.6035 14.5167 11.0312 14.6468C11.3939 14.7597 11.9346 14.7597 12.2973 14.6468C13.0946 14.4004 13.6626 13.8392 13.9022 13.0556C14.2546 11.9059 13.6181 10.6466 12.4718 10.2292L12.2665 10.1539L12.2528 7.3069C12.2426 4.7371 12.2357 4.44282 12.1844 4.24093C12.003 3.57368 11.5274 2.99538 10.9183 2.70453C10.4803 2.49922 10.405 2.48895 9.06709 2.47184L7.83865 2.45473L8.29033 2.00305L8.7386 1.55479L8.33482 1.15101C8.11582 0.932014 7.9242 0.750657 7.91735 0.750657C7.90709 0.750657 7.44856 1.20234 6.90107 1.74983ZM12.0646 11.3105C12.4171 11.4336 12.6942 11.7519 12.7969 12.142C13.0056 12.9632 12.2255 13.7434 11.4042 13.5347C10.6548 13.343 10.2921 12.5663 10.6275 11.8751C10.8772 11.3618 11.5103 11.112 12.0646 11.3105Z" fill="#2C2C2C"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <button class="open-view-modal hidden md:block" data-itemid="{{ $item->id }}">
                                <p class="text-gray-12 font-medium absolute inset-x-0 bottom-0 p-1.5 text-center text-sm bg-yellow-1">
                                    {{ __('Quick View') }}</p>
                            </button>
                        </div>
                    </div>
                    <div x-bind:class="{'text-left flex flex-col justify-center': layout === 'list', 'text-center mt-3': layout === 'grid' }">
                        <p x-bind:class="{'text-11 xxs:text-15 sm:text-15 md:text-13': layout === 'list', 'text-11 sm:text-13': layout === 'grid' }" class="text-11 md:text-13 text-gray-10 roboto-medium">{{ $item->itemCategory->category->name ?? null }}</p>
                        <a href="{{ route('site.itemDetails', ['code' => $item->item_code, 'name' => cleanedUrl($item->name)]) }}"><p x-bind:class="{'px-4': layout === 'grid', 'sm:text-lg': layout === 'list'}" class="text-13 md:text-base text-gray-12 dm-sans font-medium mt-0.5">{{ trimWords($item->name, 50) }}</p>
                        </a>
                        <p class="text-sm md:text-20 text-gray-12 dm-bold mt-1.5" x-bind:class="{'mt-5p sm:text-xl': layout === 'list', }">
                            {{ $item->isDiscountable() ? formatNumber($item->discounted_price) : formatNumber($item->price) }}
                        </p>
                        <div class="item-rating mt-1p">
                            <div class="self-top">
                                <ul class="flex space-x-2p md:space-x-5p" x-bind:class="{'justify-start mt-1.5': layout === 'list', 'justify-center mt-1': layout === 'grid' }">
                                    @for($i = 1; $i <= 5; $i++)
                                     @if ($item->review_average >= $i)
                                    <li class="mt-1 w-18p md:w-4">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="#FCCA19"/>
                                            </svg>
                                    </li>
                                     @else
                                    <li class="mt-1 w-18p md:w-4">
                                        <svg width="17" height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg" class="h-22p w-22p text-gray-300" fill="currentColor">
                                            <path d="M6.23333 0L7.6328 4.30712H12.1616L8.49772 6.96907L9.89719 11.2762L6.23333 8.61425L2.56947 11.2762L3.96894 6.96907L0.305081 4.30712H4.83386L6.23333 0Z" fill="currentColor"></path>
                                        </svg>
                                    </li>
                                    @endif
                                    @endfor
                                    <li class="mt-1 text-gray-10 text-13 roboto-medium">
                                        ({{ !empty($item->review_average) ? $item->review_average : 0 }})
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <p  x-bind:class="{'hidden md:block text-gray-10 roboto-medium font-medium text-sm mt-1.5': layout === 'list', 'hidden': layout === 'grid' }">
                            {{ $item->summary }}
                        </p>

                        <div x-bind:class="{'hidden md:block text-gray-10 mt-15p': layout === 'list', 'hidden': layout === 'grid' }">
                            <a href="javascript:void(0)" class="add-to-cart" id="item-add-to-cart" data-itemid="{{ $item->id }}">
                                <button class="border font-bold w-48 h-12 rounded flex justify-center items-center hover:border-gray-12 duration-100">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.95246 8.4209C4.48737 8.4209 4.11035 8.04387 4.11035 7.57879L4.11035 4.21038C4.11035 1.88497 5.99547 -0.00014617 8.32087 -0.000145534C10.6463 -0.000145851 12.5314 1.88497 12.5314 4.21038L12.5314 7.57879C12.5314 8.04387 12.1544 8.4209 11.6893 8.4209C11.2242 8.4209 10.8472 8.04387 10.8472 7.57879L10.8472 4.21038C10.8472 2.81513 9.71612 1.68406 8.32087 1.68406C6.92563 1.68406 5.79456 2.81513 5.79456 4.21038L5.79456 7.57879C5.79456 8.04387 5.41754 8.4209 4.95246 8.4209Z" fill="#2C2C2C"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.6312 4.21045C4.64866 4.21045 4.66619 4.21045 4.68377 4.21045L12.0112 4.21045C12.7018 4.21041 13.2997 4.21038 13.7825 4.27307C14.3015 4.34045 14.7996 4.49189 15.2189 4.8777C15.6382 5.26351 15.8305 5.7474 15.9408 6.25895C16.0433 6.73486 16.093 7.33073 16.1503 8.0189L16.5873 13.2638C16.5887 13.2799 16.59 13.296 16.5914 13.312C16.6235 13.6969 16.6545 14.0674 16.6377 14.3738C16.619 14.7172 16.5362 15.1172 16.2243 15.4561C15.9125 15.795 15.5208 15.9108 15.1801 15.958C14.8761 16.0001 14.5043 16 14.1181 15.9999C14.102 15.9999 14.0859 15.9999 14.0698 15.9999H2.57267C2.55652 15.9999 2.54039 15.9999 2.52428 15.9999C2.13812 16 1.7663 16.0001 1.46234 15.958C1.12164 15.9108 0.729939 15.795 0.418095 15.4561C0.106251 15.1172 0.0234179 14.7172 0.00468502 14.3738C-0.0120281 14.0674 0.0189198 13.6968 0.0510617 13.312C0.0524023 13.296 0.0537449 13.2799 0.0550863 13.2638L0.487794 8.07131C0.489254 8.05379 0.490709 8.03632 0.492158 8.01892C0.549466 7.33074 0.599088 6.73487 0.701656 6.25895C0.811904 5.7474 1.00418 5.26351 1.42349 4.8777C1.84279 4.49189 2.34098 4.34045 2.85992 4.27307C3.3427 4.21038 3.94064 4.21041 4.6312 4.21045ZM3.07679 5.94325C2.73932 5.98708 2.62802 6.05806 2.56388 6.11708C2.49974 6.17609 2.41976 6.28112 2.34806 6.61378C2.27128 6.97005 2.22916 7.45551 2.16618 8.21118L1.73348 13.4037C1.69585 13.8551 1.67682 14.1065 1.68639 14.2821C1.68652 14.2843 1.68665 14.2866 1.68678 14.2887C1.68894 14.2891 1.69115 14.2894 1.69341 14.2897C1.86755 14.3138 2.11963 14.3157 2.57267 14.3157H14.0698C14.5228 14.3157 14.7749 14.3138 14.949 14.2897C14.9513 14.2894 14.9535 14.2891 14.9557 14.2887C14.9558 14.2866 14.9559 14.2843 14.956 14.2821C14.9656 14.1065 14.9466 13.8551 14.909 13.4037L14.4762 8.21118C14.4133 7.45551 14.3711 6.97005 14.2944 6.61378C14.2227 6.28112 14.1427 6.17609 14.0785 6.11708C14.0144 6.05806 13.9031 5.98708 13.5656 5.94325C13.2042 5.89632 12.7169 5.89466 11.9587 5.89466H4.68377C3.92549 5.89466 3.43821 5.89632 3.07679 5.94325Z" fill="#2C2C2C"/>
                                    </svg>
                                    <span class="pl-2 dm-bold font-bold text-gray-12 text-sm">{{ __('Add to Cart') }}</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                        @endif
                    @endif
                @endforeach
                @else
                    <span>{{ __('No Item Found') }}!</span>
                @endif
            </div>
        </div>

        @if ($items->hasPages())
        <div class="flex text-gray-700 justify-center pt-5 mt-25p border-t ml-30p">
            @if(!$items->onFirstPage())
            <a href="{{$items->previousPageUrl()}}" class="relative process-prev mr-1 flex justify-center items-center cursor-pointer dark:text-white page-link">
                <svg class="absolute" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.59216 0L4.6714 1.05155L2.92161 2.75644H10.2369C10.6583 2.75644 11 3.08934 11 3.5C11 3.91066 10.6583 4.24356 10.2369 4.24356H2.92161L4.6714 5.94845L3.59216 7L0 3.5L3.59216 0Z" fill="#898989" fill-opacity="0.5"/>
               </svg>
                <p class="roboto-medium text-sm text-gray-10 mr-3">{{ __('Prev') }}</p>
            </a>
            @endif
            @if($items->currentPage() > 3)
                    <a href="{{ $items->currentPage() == 1 ? 'javascript:void(0)' : $items->url(1)}}" class="w-8 flex justify-center items-center cursor-pointer leading-5 roboto-medium text-15 {{ $items->currentPage() == 1 ? 'bg-yellow-1' : 'text-gray-10 page-link' }}  hover:text-gray-12">1</a>
            @endif
            @if($items->currentPage() > 4)
                    <a href="javascript:void(0)" class="w-8 flex justify-center items-center cursor-pointer leading-5 roboto-medium text-15 text-gray-10 hover:text-gray-12">...</a>
            @endif
            <div class="flex h-8 font-medium">
                @foreach(range(1, $items->lastPage()) as $i)
                    @if($i >= $items->currentPage() - 2 && $i <= $items->currentPage() + 2)
                        <a href="{{ $items->currentPage() == $i ? 'javascript:void(0)' : $items->url($i) }}" class="w-8 flex justify-center items-center cursor-pointer leading-5 roboto-medium text-15 {{ $items->currentPage() == $i ? 'bg-yellow-1' : 'text-gray-10 page-link' }}  hover:text-gray-12">
                            {{$i}}
                        </a>
                    @endif
                @endforeach

                @if($items->currentPage() < $items->lastPage() - 3)
                    <a href="javascript:void(0)" class="w-8 flex justify-center items-center cursor-pointer leading-5 roboto-medium text-15 text-gray-10 hover:text-gray-12">...</a>
                @endif
                @if($items->currentPage() < $items->lastPage() - 2)
                    <a href="{{ $items->url($items->lastPage()) }}" class="w-8 flex justify-center items-center cursor-pointer leading-5 roboto-medium text-15 {{ $items->currentPage() == $i ? 'bg-yellow-1' : 'text-gray-10' }}  hover:text-gray-12 page-link">
                        {{ $items->lastPage() }}
                    </a>
                @endif

            </div>
                @if($items->hasMorePages())
                    <a href="{{$items->nextPageUrl()}}" class="relative process-next ml-1 flex justify-center items-center cursor-pointer page-link">
                        <p class="roboto-medium text-sm text-gray-10 mr-3">{{ __('Next') }}</p>
                        <svg class="absolute" width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.40784 0L6.3286 1.05155L8.07839 2.75644H0.763135C0.341667 2.75644 0 3.08934 0 3.5C0 3.91066 0.341667 4.24356 0.763135 4.24356H8.07839L6.3286 5.94845L7.40784 7L11 3.5L7.40784 0Z" fill="#898989"/>
                        </svg>
                    </a>
                @endif
        </div>
        @endif
    </div>
</div>
<input type="hidden" id="selectedSubcategory" value="{{ json_encode($subCategory) }}">

<script src="{{ asset('public\dist\js\custom\site\res-filter.min.js') }}"></script>


