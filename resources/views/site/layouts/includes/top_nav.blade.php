<section class="color_switch_bac">
        <div class="mx-4 pt-2p lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 font-medium text-base flex justify-between items-center h-16 md:h-10 roboto-medium">
            <div class="flex items-center">
                <div class="hidden md:block space-x-6 ">
                    <ul class="flex flex-col sm:flex-row text-xs">
                        <li>
                            <a href="#" class="w-fill flex">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.37104 0.70694L1.84948 0.228499C2.15415 -0.0761661 2.64811 -0.0761666 2.95277 0.228499L4.97006 2.24579C5.27472 2.55045 5.27472 3.04441 4.97006 3.34908L3.57172 4.74742C3.33855 4.98059 3.28074 5.3368 3.42821 5.63175C4.28072 7.33676 5.66324 8.71928 7.36826 9.57179C7.6632 9.71926 8.01941 9.66145 8.25259 9.42828L9.65092 8.02994C9.95559 7.72528 10.4495 7.72528 10.7542 8.02994L12.7715 10.0472C13.0762 10.3519 13.0762 10.8459 12.7715 11.1505L12.2931 11.629C10.6459 13.2761 8.03822 13.4614 6.17467 12.0638L5.23194 11.3567C3.87173 10.3366 2.66343 9.12827 1.64327 7.76806L0.936223 6.82533C-0.461438 4.96178 -0.276117 2.3541 1.37104 0.70694Z" fill="#2C2C2C"/>
                                </svg>

                                <span class="pl-2 rtl-direction-space -mt-0.5">{{ $company_phone }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="w-fill flex pl-3">
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.781049 0.815917C0 1.63183 0 2.94503 0 5.57143V7.42857C0 10.055 0 11.3682 0.781049 12.1841C1.5621 13 2.81918 13 5.33333 13H10.6667C13.1808 13 14.4379 13 15.219 12.1841C16 11.3682 16 10.055 16 7.42857V5.57143C16 2.94503 16 1.63183 15.219 0.815917C14.4379 0 13.1808 0 10.6667 0H5.33333C2.81918 0 1.5621 0 0.781049 0.815917ZM3.15973 2.94167C2.75126 2.6572 2.19938 2.7725 1.92707 3.19921C1.65475 3.62591 1.76513 4.20243 2.1736 4.4869L7.01387 7.8578C7.61102 8.27368 8.38898 8.27368 8.98613 7.8578L13.8264 4.4869C14.2349 4.20243 14.3452 3.62591 14.0729 3.19921C13.8006 2.7725 13.2487 2.6572 12.8403 2.94167L8 6.31257L3.15973 2.94167Z" fill="#2C2C2C"/>
                                </svg>
                                <span class="pl-2 rtl-direction-space -mt-0.5">{{ $company_email }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="md:hidden">
                    <svg class="burger pointer" width="27" height="21" viewBox="0 0 27 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 18.5233C0 17.6563 0.737949 16.9535 1.64826 16.9535H11.5378C12.4481 16.9535 13.186 17.6563 13.186 18.5233C13.186 19.3902 12.4481 20.093 11.5378 20.093H1.64826C0.737949 20.093 0 19.3902 0 18.5233Z" fill="#2C2C2C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.0465C0 9.00615 0.749663 8.16278 1.67442 8.16278H18.4186C19.3434 8.16278 20.093 9.00615 20.093 10.0465C20.093 11.0869 19.3434 11.9302 18.4186 11.9302H1.67442C0.749663 11.9302 0 11.0869 0 10.0465Z" fill="#2C2C2C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.56977C0 0.702809 0.755519 0 1.6875 0H25.3125C26.2445 0 27 0.702809 27 1.56977C27 2.43673 26.2445 3.13953 25.3125 3.13953H1.6875C0.755519 3.13953 0 2.43673 0 1.56977Z" fill="#2C2C2C"/>
                    </svg>
                </div>

                <div class="md:hidden ml-10">
                    <a href="{{ route('site.index') }}">
                        <img class="x:w-29" width="154.92px" height="24.4px" src="{{ asset('public/frontend/assets/img/product/logo-2.png') }}" alt="">
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <div class="hidden md:block">
                    @php
                        $languages  = \App\Models\Language::getAll()->where('status', 'Active');
                    @endphp
                    <ul class="flex flex-col sm:flex-row">
                        <li class="flex items-center">
                            <a href="{{ route('site.compare') }}" class="flex w-fill pr-30p">
                                <div class="flex items-center justify-center text-xss roboto-medium rounded-full mr-7p w-4 h-4 bg-reds-3 text-white" id="totalCompareItem">
                                    {{ \App\Compare\Compare::totalItem() != 0 ? \App\Compare\Compare::totalItem() : ''  }}
                                </div>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.0488 0.0126572C2.01118 0.0194979 1.8949 0.043438 1.79229 0.0639582C1.68969 0.0844793 1.46055 0.169981 1.2827 0.255483C1.01252 0.385445 0.909917 0.457267 0.677352 0.689831C0.444787 0.925816 0.372966 1.025 0.243003 1.29518C0.0412193 1.71585 -0.00324155 1.91422 0.000178515 2.36908C0.00701865 2.93682 0.171182 3.38484 0.547389 3.84313C0.776534 4.12016 1.22114 4.4177 1.59393 4.53741L1.72047 4.57845L1.73415 7.44104C1.74783 10.6217 1.73415 10.4439 1.98382 10.9535C2.27794 11.5588 2.84225 12.0171 3.50575 12.1881C3.68359 12.236 3.95036 12.2497 4.93534 12.2599L6.14604 12.277L5.69459 12.7285L5.24656 13.1765L5.65697 13.5869L6.06738 13.9973L7.06262 13.0055C7.60983 12.4583 8.07838 11.9658 8.10574 11.9042C8.1673 11.764 8.1673 11.5793 8.10574 11.4391C8.07838 11.3775 7.60983 10.8851 7.06262 10.3378L6.06738 9.34602L5.65697 9.75643L5.24656 10.1668L5.69801 10.6217L6.15288 11.0766L4.93876 11.0663L3.72463 11.0561L3.55363 10.9637C3.34842 10.8543 3.12954 10.632 3.0201 10.4233L2.93802 10.2694L2.92776 7.42394L2.92092 4.58187L3.04746 4.53741C4.08032 4.20566 4.76433 3.14886 4.63779 2.09548C4.51809 1.12418 3.89906 0.382025 2.97222 0.0981588C2.74307 0.0263376 2.19928 -0.0249634 2.0488 0.0126572ZM2.59601 1.20626C3.13296 1.34648 3.47497 1.78425 3.47497 2.33488C3.47497 2.60849 3.41341 2.80685 3.2595 3.01548C3.04404 3.31986 2.71229 3.48403 2.3224 3.48745C1.76835 3.48745 1.33058 3.14544 1.19036 2.59481C1.03988 1.99288 1.41267 1.37726 2.0317 1.20968C2.27452 1.1447 2.35319 1.1447 2.59601 1.20626Z" fill="#2C2C2C"/>
                                    <path d="M6.89801 1.02512C6.34738 1.57575 5.88225 2.07166 5.86173 2.12296C5.81385 2.25634 5.81727 2.4376 5.87541 2.56757C5.90277 2.62913 6.37132 3.12162 6.91853 3.66883L7.91377 4.66065L8.32418 4.25024L8.73459 3.83983L8.28314 3.38496L7.82827 2.93009L9.04239 2.94036L10.2565 2.95062L10.4275 3.04296C10.6327 3.1524 10.8516 3.3747 10.9611 3.58333L11.0431 3.73723L11.0534 6.58273L11.0602 9.4248L10.9337 9.46926C10.5199 9.60265 10.065 9.92071 9.80849 10.2627C9.48358 10.6902 9.33652 11.1314 9.33652 11.6718C9.33652 12.3216 9.55882 12.8551 10.0171 13.3134C10.3215 13.6178 10.5985 13.7854 11.026 13.9154C11.3886 14.0282 11.9289 14.0282 12.2915 13.9154C13.0883 13.6691 13.6561 13.1082 13.8955 12.325C14.2477 11.1759 13.6116 9.91729 12.4659 9.50005L12.2607 9.4248L12.247 6.57931C12.2367 4.01084 12.2299 3.71671 12.1786 3.51493C11.9973 2.84801 11.5219 2.27002 10.9132 1.97932C10.4754 1.77411 10.4002 1.76385 9.06291 1.74675L7.83511 1.72965L8.28656 1.2782L8.73459 0.830173L8.33102 0.426605C8.11213 0.207721 7.92061 0.0264578 7.91377 0.0264578C7.90351 0.0264578 7.44522 0.477906 6.89801 1.02512ZM12.0589 10.5808C12.4112 10.7039 12.6882 11.022 12.7908 11.4119C12.9994 12.2327 12.2196 13.0125 11.3988 12.8038C10.6498 12.6123 10.2873 11.836 10.6225 11.1451C10.8721 10.6321 11.5048 10.3824 12.0589 10.5808Z" fill="#2C2C2C"/>
                                </svg>
                                <span class="text-xs rtl-direction-space -mt-0.5 ml-7p">Compare</span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block w-fill pr-30p">
                                <span class="text-xs font-bold">{{ $currency_symbol }}</span>
                                <span class="text-xs rtl-direction-space -mt-0.5 ml-0.5">{{ $currency_name }}</span>
                            </a>
                        </li>

                        @if ($languages->isNotEmpty())

                        <button class="rtl-direction-space-left flex items-center">
                            <span class="mr-6 text-sm roboto-medium text-gray-12">
                                <svg class="-mr-2 inline-block" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.22222 0V4.27867C5.02711 4.15124 3.92648 3.73362 3.09069 3.09917C2.62635 2.74669 2.26451 2.34416 2.00906 1.91439C3.10808 0.870404 4.57949 0.169659 6.22222 0ZM7.77778 0V4.27867C8.97289 4.15124 10.0735 3.73362 10.9093 3.09917C11.3736 2.7467 11.7355 2.34416 11.9909 1.91439C10.8919 0.870406 9.42051 0.169659 7.77778 0ZM13.0019 3.13255C12.6939 3.53233 12.3204 3.90054 11.8902 4.22711C10.7609 5.08438 9.30819 5.60689 7.77778 5.73959L7.77778 7.26013C8.41133 7.31505 9.03445 7.437 9.62923 7.62402C10.4661 7.88714 11.2354 8.27553 11.8902 8.77263C12.3177 9.09708 12.692 9.46462 13.0021 9.86715C13.6356 8.88358 14 7.73154 14 6.5C14 5.26833 13.6356 4.11619 13.0019 3.13255ZM11.991 11.0856C11.7336 10.653 11.3698 10.2501 10.9093 9.90056C10.4086 9.52047 9.80605 9.21303 9.13305 9.00142C8.69923 8.86501 8.24368 8.77083 7.77778 8.72112V13C9.42054 12.8303 10.892 12.1296 11.991 11.0856ZM6.22222 13L6.22222 8.72112C5.75632 8.77083 5.30077 8.86501 4.86695 9.00142C4.19395 9.21303 3.5914 9.52047 3.09069 9.90056C2.63019 10.2501 2.26635 10.653 2.00901 11.0856C3.10803 12.1296 4.57946 12.8303 6.22222 13ZM0.997862 9.86715C1.30804 9.46462 1.68235 9.09708 2.10976 8.77263C2.76462 8.27553 3.53394 7.88714 4.37077 7.62402C4.96555 7.437 5.58867 7.31505 6.22222 7.26013V5.73959C4.69181 5.60689 3.23909 5.08438 2.10976 4.22711C1.67956 3.90054 1.30615 3.53233 0.998052 3.13255C0.364433 4.11618 0 5.26833 0 6.5C0 7.73154 0.364361 8.88358 0.997862 9.86715Z" fill="#2C2C2C"/>
                                </svg>
                            </span>

                            @php
                                $langData = Cache::get(config('cache.prefix') . '-user-language-'. optional(Auth::guard('user')->user())->id);
                                if (!auth()->user()) {
                                    $langData = Cache::get(config('cache.prefix') . '-guest-language-'. request()->server('HTTP_USER_AGENT'));
                                }
                                if (empty($langData)) {
                                    $langData = $dflt_lang;
                                }

                            @endphp
                            <div id="directionSwitch" class="dropdown rounded shadow-none relative z-50 lang-dropdown lang"  data-value={{ $languages->where("short_name",$langData)->first()->direction }}>
                                <div class="select flex justify-between items-center lang-p">
                                    <p class="msg roboto-medium msg-color mr-1.5"> {{ $languages->where("short_name",$langData)->first()->name }} </p>
                                    <svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.737986 8.80039e-09L3.5 2.60691L6.26201 7.46738e-08L7 0.696543L3.5 4L3.93933e-08 0.696543Z" fill="#2c2c2c"/>
                                    </svg>
                                </div>
                                <input type="hidden" name="Showing" value="English">
                                <ul class="dropdown-menu top-8">
                                    @foreach ($languages as $language)
                                    <li id="{{ $language->name }}"  class="Showing lang text-gray-10 {{ $langData == $language->short_name ? 'bg-yellow-1 text-gray-12' : '' }}">
                                        <a class="roboto-medium text-xs lang"  data-shortname="{{ $language->short_name }}">{{ $language->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </button>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="md:hidden">
                <div class="flex justify-end items-end rev">
                    <ul class="flex ">
                        <li>
                            @if(isset(Auth::user()->roles[0]->type) && Auth::user()->roles[0]->type == 'global' &&
                            Auth::user()->roles[0]->slug == 'super-admin' || isset(Auth::user()->roles[0]->type) &&
                            Auth::user()->roles[0]->type == 'global' && Auth::user()->roles[0]->slug == 'customer')
                            <!--user dropdown start-->
                            <div class="flex relative inline-block">
                                <div class="relative text-sm" x-data="{ open: false }" x-cloak>
                                    <button @click="open = !open"
                                     class="flex items-center focus:outline-none ">
                                            <div class="flex flex-col justify-center mr-4 bg-gray-100 items-center h-9 w-9 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                <img class="h-9 w-9 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer" src="{{ Auth::user()->fileUrl() }}"
                                            alt="Avatar of User">
                                            </div>
                                    </button>

                                    <div x-show.transition="open" @click.away="open = false"
                                        class="absolute right-0 w-40 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 overflow-auto z-50">
                                        <ul class="list-reset text-gray-600">
                                            <li class="flex">
                                                <a href="{{ route('site.dashboard') }}" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                  <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                  </svg>
                                                  <span>{{__('My Account') }}</span>
                                                </a>
                                            </li>

                                            <li class="flex">
                                                <a href="#" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                  <svg class="w-4 h-4 mr-2 ml-0.5 text-gray-500" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                                  </svg>
                                                  <span class="ml-0.5">Notifications</span>
                                                </a>
                                            </li>

                                            <li class="flex">
                                                <a href="{{ route('site.logout') }}" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                  <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                                  </svg>
                                                  <span>{{ __('Logout') }}</span>
                                                </a>
                                              </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- user dropdown end -->
                            @else
                            <!-- unauthenticated -->
                            <div class="flex flex-col justify-center mr-4 items-center cursor-pointer open-login-modal mt-2">
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4102 2.38517C8.43424 2.38517 6.83243 3.98698 6.83243 5.96291C6.83243 7.93885 8.43424 9.54066 10.4102 9.54066C12.3861 9.54066 13.9879 7.93885 13.9879 5.96291C13.9879 3.98698 12.3861 2.38517 10.4102 2.38517ZM4.44727 5.96291C4.44727 2.66969 7.11695 0 10.4102 0C13.7034 0 16.3731 2.66969 16.3731 5.96291C16.3731 9.25614 13.7034 11.9258 10.4102 11.9258C7.11695 11.9258 4.44727 9.25614 4.44727 5.96291Z" fill="#2C2C2C"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.00564 15.9486C5.86929 14.8761 8.11934 14.311 10.4085 14.311C12.6976 14.311 14.9477 14.8761 16.8113 15.9486C18.6743 17.0207 20.0908 18.5688 20.7471 20.4058C20.9687 21.0261 20.6455 21.7085 20.0253 21.9301C19.405 22.1517 18.7226 21.8286 18.501 21.2083C18.0701 20.0024 17.0911 18.8615 15.6216 18.0159C14.1528 17.1706 12.3198 16.6961 10.4085 16.6961C8.49717 16.6961 6.66414 17.1706 5.19535 18.0159C3.72586 18.8615 2.74681 20.0024 2.31597 21.2083C2.09437 21.8286 1.41193 22.1517 0.791676 21.9301C0.171426 21.7085 -0.151748 21.0261 0.0698463 20.4058C0.726164 18.5688 2.14268 17.0207 4.00564 15.9486Z" fill="#2C2C2C"/>
                                </svg>
                            </div>
                            @endif
                        </li>

                        <li>
                            <div x-data="setup()" id="testing" class="z-50 -ml-2">
                                <div>
                                    <form action="#" class="flex-1">
                                    </form>
                                    <div class="items-center ml-4 sm:flex">
                                        <button @click="isSettingsPanelOpen = true"
                                            class="relative z-10 block rounded-md focus:outline-none justify-between">
                                            <div class="flex flex-col justify-center mr-1 items-center">
                                                <div slot="icon" class="relative mt-2">
                                                    <div class="absolute roboto-bold flex justify-center items-center text-xss rounded-full h-4 w-4 -mt-2 -mr-2 px-1 font-bold right-1 bg-red-700 text-white"
                                                        id="totalCartItemM">
                                                        {{ $carts->count() }}
                                                    </div>
                                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.3679 5.78949C6.39191 5.78949 6.41601 5.7895 6.44019 5.7895L16.5154 5.78949C17.465 5.78944 18.2871 5.78939 18.951 5.87559C19.6645 5.96825 20.3495 6.17646 20.926 6.70696C21.5026 7.23745 21.767 7.9028 21.9186 8.60618C22.0596 9.26056 22.1278 10.0799 22.2066 11.0261L22.8076 18.2378C22.8094 18.26 22.8113 18.2821 22.8131 18.3042C22.8573 18.8333 22.8999 19.3428 22.8769 19.7641C22.8511 20.2363 22.7372 20.7863 22.3085 21.2523C21.8797 21.7183 21.3411 21.8774 20.8726 21.9423C20.4547 22.0002 19.9434 22.0001 19.4125 22C19.3903 22 19.3681 22 19.3459 22H3.53742C3.51521 22 3.49303 22 3.47089 22C2.93991 22.0001 2.42867 22.0002 2.01072 21.9423C1.54226 21.8774 1.00367 21.7183 0.57488 21.2523C0.146095 20.7863 0.0321996 20.2363 0.00644191 19.7641C-0.0165386 19.3428 0.0260147 18.8333 0.0702098 18.3042C0.0720531 18.2821 0.0738993 18.26 0.0757437 18.2379L0.670717 11.0982C0.672725 11.0741 0.674724 11.0501 0.676717 11.0261C0.755516 10.0799 0.823746 9.26056 0.964776 8.60618C1.11637 7.9028 1.38075 7.23745 1.95729 6.70696C2.53383 6.17646 3.21884 5.96825 3.93238 5.87559C4.59621 5.78939 5.41838 5.78944 6.3679 5.78949ZM4.23059 8.1721C3.76657 8.23235 3.61353 8.32995 3.52533 8.4111C3.43714 8.49225 3.32717 8.63666 3.22859 9.09408C3.12301 9.58394 3.06509 10.2515 2.9785 11.2905L2.38353 18.4302C2.3318 19.051 2.30563 19.3966 2.31879 19.6379C2.31896 19.6411 2.31914 19.6441 2.31932 19.6471C2.3223 19.6476 2.32534 19.648 2.32844 19.6484C2.56788 19.6816 2.91449 19.6842 3.53742 19.6842H19.3459C19.9689 19.6842 20.3155 19.6816 20.5549 19.6484C20.558 19.648 20.561 19.6476 20.564 19.6471C20.5642 19.6441 20.5644 19.6411 20.5645 19.6379C20.5777 19.3966 20.5515 19.051 20.4998 18.4302L19.9048 11.2905C19.8182 10.2515 19.7603 9.58394 19.6548 9.09408C19.5562 8.63666 19.4462 8.49225 19.358 8.4111C19.2698 8.32995 19.1168 8.23235 18.6527 8.1721C18.1558 8.10757 17.4858 8.10528 16.4432 8.10528H6.44019C5.39755 8.10528 4.72753 8.10757 4.23059 8.1721Z" fill="#2C2C2C"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.81024 11.5789C6.17075 11.5789 5.65234 11.0605 5.65234 10.421L5.65234 5.78945C5.65234 2.59202 8.24438 -1.75202e-05 11.4418 -1.60496e-05C14.6392 -1.64864e-05 17.2313 2.59202 17.2313 5.78945L17.2313 10.421C17.2313 11.0605 16.7129 11.5789 16.0734 11.5789C15.4339 11.5789 14.9155 11.0605 14.9155 10.421L14.9155 5.78945C14.9155 3.87099 13.3603 2.31577 11.4418 2.31577C9.52335 2.31577 7.96813 3.87099 7.96813 5.78945L7.96813 10.421C7.96813 11.0605 7.44972 11.5789 6.81024 11.5789Z" fill="#2C2C2C"/>
                                                    </svg>

                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>


                                <!-- Backdrop -->
                                <div x-show="isSettingsPanelOpen"
                                    class="fixed inset-0 bg-black bg-opacity-50 z-50 hideme hidden"
                                    @click="isSettingsPanelOpen = false" aria-hidden="false"></div>
                                <section x-transition:enter="transform transition-transform duration-300"
                                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                                    x-transition:leave="transform transition-transform duration-300"
                                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                                    x-show="isSettingsPanelOpen"
                                    class="fixed inset-y-0 right-0 w-400p bg-white z-50 hideme hidden">
                                    <div class="">
                                        <div class="px-30p">
                                            <div class="w-full flex justify-between items-center relative border-b border-gray-2">
                                                <div class="flex items-center">
                                                    <span class="mr-2 text-gray-12">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.95145 10.8918C5.39254 10.8918 4.93945 10.4388 4.93945 9.87985L4.93945 5.83186C4.93945 3.03731 7.20488 0.771874 9.99944 0.771875C12.794 0.771874 15.0594 3.03731 15.0594 5.83186L15.0594 9.87985C15.0594 10.4388 14.6063 10.8918 14.0474 10.8918C13.4885 10.8918 13.0354 10.4388 13.0354 9.87985L13.0354 5.83186C13.0354 4.15513 11.6762 2.79587 9.99944 2.79587C8.32271 2.79587 6.96345 4.15513 6.96345 5.83186L6.96345 9.87985C6.96345 10.4388 6.51036 10.8918 5.95145 10.8918Z" fill="currentColor"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.56553 5.83203C5.58652 5.83203 5.60758 5.83204 5.62871 5.83204L14.4345 5.83203C15.2643 5.83199 15.9829 5.83194 16.5631 5.90728C17.1867 5.98826 17.7854 6.17025 18.2893 6.6339C18.7932 7.09754 19.0243 7.67906 19.1568 8.29382C19.28 8.86574 19.3397 9.58182 19.4085 10.4088L19.9338 16.7119C19.9354 16.7312 19.937 16.7505 19.9386 16.7698C19.9773 17.2323 20.0145 17.6776 19.9944 18.0458C19.9719 18.4585 19.8723 18.9392 19.4976 19.3465C19.1228 19.7538 18.6521 19.8929 18.2426 19.9496C17.8773 20.0002 17.4305 20.0001 16.9665 20C16.9471 20 16.9277 20 16.9083 20H3.0917C3.07229 20 3.05291 20 3.03355 20C2.56948 20.0001 2.12265 20.0002 1.75736 19.9496C1.34793 19.8929 0.877202 19.7538 0.502445 19.3465C0.127687 18.9392 0.0281424 18.4585 0.00563022 18.0458C-0.0144547 17.6776 0.0227368 17.2323 0.0613632 16.7698C0.0629743 16.7505 0.0645879 16.7312 0.0661998 16.7119L0.586205 10.4718C0.58796 10.4508 0.589708 10.4298 0.59145 10.4088C0.66032 9.58183 0.719952 8.86574 0.843213 8.29382C0.975704 7.67906 1.20678 7.09754 1.71067 6.6339C2.21456 6.17025 2.81326 5.98826 3.4369 5.90728C4.01708 5.83194 4.73565 5.83199 5.56553 5.83203ZM3.69753 7.91443C3.29198 7.96709 3.15822 8.05239 3.08114 8.12332C3.00406 8.19424 2.90794 8.32045 2.82178 8.72023C2.72951 9.14838 2.67888 9.73178 2.60321 10.6399L2.0832 16.88C2.03799 17.4225 2.01511 17.7246 2.02662 17.9356C2.02677 17.9383 2.02692 17.941 2.02708 17.9436C2.02968 17.944 2.03234 17.9443 2.03505 17.9447C2.24432 17.9737 2.54726 17.976 3.0917 17.976H16.9083C17.4527 17.976 17.7557 17.9737 17.9649 17.9447C17.9677 17.9443 17.9703 17.944 17.9729 17.9436C17.9731 17.941 17.9732 17.9383 17.9734 17.9356C17.9849 17.7246 17.962 17.4225 17.9168 16.88L17.3968 10.6399C17.3211 9.73178 17.2705 9.14838 17.1782 8.72023C17.0921 8.32045 16.9959 8.19424 16.9189 8.12332C16.8418 8.05239 16.708 7.96709 16.3025 7.91443C15.8681 7.85803 15.2826 7.85603 14.3713 7.85603H5.62871C4.71745 7.85603 4.13186 7.85803 3.69753 7.91443Z" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                 <h3 class="dm-bold font-bold text-22">{{ __('Shopping Cart') }}</h3>
                                                </div>

                                                <div class="flex items-center">
                                                    <button @click="isSettingsPanelOpen = false" class="flex text-2xl items-center justify-center ml-2 py-6 lg:py-7 focus:outline-none transition-opacity hover:opacity-60" aria-label="close">
                                                        <span class="dm-sans font-medium text-gray-10 text-base">Close</span>
                                                        <span class="text-gray-10 pl-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1016 0L8.62991 1.50221L11.016 3.93778H1.04064C0.46591 3.93778 0 4.41335 0 5C0 5.58665 0.46591 6.06222 1.04064 6.06222H11.016L8.62991 8.49779L10.1016 10L15 5L10.1016 0Z" fill="currentColor"/>
                                                        </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                             <!-- Empty Card -->
                                             <div id="emptyCartM" class="flex flex-col items-center justify-center absolute inset-0">
                                                 <div class="flex justify-center items-center rounded-full">
                                                    <span class="text-gray-10 text-4xl block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="36" viewBox="0 0 31 36" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38222 6.84833C3.93638 7.30009 3.87492 7.60249 3.87492 7.74983C3.87492 7.89717 3.93638 8.19958 4.38222 8.65133C4.83629 9.11141 5.58938 9.61461 6.67294 10.079C8.83316 11.0048 11.9525 11.6247 15.4997 11.6247C19.0468 11.6247 22.1662 11.0048 24.3264 10.079C25.4099 9.61461 26.163 9.11141 26.6171 8.65133C27.0629 8.19958 27.1244 7.89717 27.1244 7.74983C27.1244 7.60249 27.0629 7.30009 26.6171 6.84833C26.163 6.38825 25.4099 5.88505 24.3264 5.42067C22.1662 4.49486 19.0468 3.87492 15.4997 3.87492C11.9525 3.87492 8.83316 4.49486 6.67294 5.42067C5.58938 5.88505 4.83629 6.38825 4.38222 6.84833ZM5.14653 1.85906C7.89486 0.681202 11.5566 0 15.4997 0C19.4427 0 23.1045 0.681202 25.8528 1.85906C27.2235 2.44651 28.4566 3.19577 29.3751 4.12645C30.3018 5.06547 30.9993 6.29213 30.9993 7.74983C30.9993 9.20753 30.3018 10.4342 29.3751 11.3732C28.4566 12.3039 27.2235 13.0532 25.8528 13.6406C23.1045 14.8185 19.4427 15.4997 15.4997 15.4997C11.5566 15.4997 7.89486 14.8185 5.14653 13.6406C3.77582 13.0532 2.54277 12.3039 1.62426 11.3732C0.697534 10.4342 0 9.20753 0 7.74983C0 6.29213 0.697534 5.06547 1.62426 4.12645C2.54277 3.19577 3.77582 2.44651 5.14653 1.85906Z" fill="#898989"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.59121 5.84409C2.64398 5.65267 3.65259 6.35094 3.844 7.40371L7.60672 28.0987C12.0728 32.1731 18.9272 32.1731 23.3933 28.0987L27.156 7.40371C27.3474 6.35094 28.356 5.65267 29.4088 5.84409C30.4616 6.0355 31.1598 7.04411 30.9684 8.09688L27.1008 29.3686C27.0256 29.7826 26.8258 30.1638 26.5283 30.4613C20.4375 36.5521 10.5625 36.5521 4.47173 30.4613C4.17418 30.1638 3.97444 29.7826 3.89916 29.3686L0.0315873 8.09688C-0.159825 7.04411 0.538442 6.0355 1.59121 5.84409Z" fill="#898989"/>
                                                        </svg>
                                                    </span>
                                                 </div>
                                                 <h3 class="dm-sans font-medium text-gray-10 text-xl pt-2">{{ __('Your cart is empty') }}</h3>
                                                 <p class="px-12 text-center roboto-regular font-normal text-13 text-gray-10 pt-2">{{ __('No items added in your cart. Please add product to your cart list.') }}</p>
                                            </div>
                                         <!-- Empty Card End -->
                                        </div>

                                        <div class="w-full px-30p scrollbar-w-2 hidden md:block z-50  h-690p overflow-auto pb-120p mt-10p" id="cart-headerM">
                                            @forelse($carts as $key => $cart)
                                            <div class="flex cursor-pointer border-gray-100 cart-item-header mt-6"
                                                id="cart-item-headerM-{{ $key }}">
                                                <div class="h-72p w-24 border border-gray-2 rounded">
                                                    <img src="{{ $cart['photo'] }}" class="h-full w-full p-0.5" alt="img product">
                                                </div>
                                                <div class="flex flex-col justify-center text-sm w-64 ml-5">
                                                    <a href="{{ route('site.itemDetails', ['code' => $cart['item_code'], 'name' => cleanedUrl($cart['name'])]) }}"><div class="dm-sans font-medium text-gray-12 text-18 pb-2">{{ trimWords($cart['name'],16)}}</div></a>
                                                    @php
                                                    $optionNameHeader = json_decode($cart['option_name']);
                                                    $optionHeader = json_decode($cart['option']);
                                                    @endphp
                                                    @if($optionNameHeader != null && count($optionNameHeader) > 0)
                                                    @foreach($optionNameHeader as $opKey => $name)
                                                    @endforeach
                                                    @endif
                                                    <div class="cart-item-quantity roboto-medium font-medium text-gray-10 text-base leading-5">{{
                                                        $cart['quantity'] }} X {{
                                                        formatCurrencyAmount($cart['price']) }}
                                                    </div>
                                                </div>
                                                <div class="flex flex-col w-18 font-medium justify-center ml-10">
                                                    <a href="javascript:void(0)"
                                                        class="w-4 h-4 rounded-full cursor-pointer text-red-700 delete-cart-item"
                                                        data-index="{{ $key }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="#898989"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9897 0.455612C11.3822 -0.151871 10.3973 -0.151871 9.78981 0.455612L0.45648 9.78895C-0.151003 10.3964 -0.151003 11.3814 0.45648 11.9888C1.06396 12.5963 2.04889 12.5963 2.65637 11.9888L11.9897 2.6555C12.5972 2.04802 12.5972 1.06309 11.9897 0.455612Z" fill="#898989"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            @empty

                                            @endforelse
                                            @php
                                            $totalPrice = $carts->sum(function ($carts) {
                                            return $carts['price'] * $carts['quantity'];
                                            });
                                            @endphp

                                             <div class="absolute justify-center bg-white flex flex-col inset-x-0 px-30p mt-30p bottom-5">
                                                  <div class="border-t border-gray-2">
                                                        <div class="pt-4 pb-30p flex justify-between dm-sans font-medium text-gray-12 text-22">
                                                            <p class="">{{ __('Subtotal') }}:</p>
                                                            <p id="cart-item-total-priceM">{{ formatNumber($totalPrice)}}</p>
                                                        </div>
                                                        @if ($totalPrice > 0)
                                                            <div id="view-cart-displayM" class="bg-white text-gray-12 border border-gray-2 p-2 w-full rounded mb-10p">
                                                                <a href="{{ route('site.cart') }}" class="flex justify-center px-4 py-2 rounded font-bold cursor-pointer dm-bold text-18">
                                                                {{ __('View Cart') }}
                                                                </a>

                                                            </div>
                                                        @endif
                                                        <div id="checkout-displayM" class="{{ $totalPrice > 0 ? 'bg-gray-12 text-white' : 'text-gray-10 bg-gray-11'}}  p-2 w-full rounded">
                                                                <a id="checkout-displayM" href="{{ route('site.checkOut',['select' => 'all']) }}" class="flex justify-center px-4 py-2  font-bold cursor-pointer dm-bold text-18">

                                                                    {{ __('Go to Checkout') }}
                                                                </a>
                                                        </div>
                                                        @if ($totalPrice > 0)
                                                            <div class="text-gray-10 mt-5"
                                                            aria-label="Clear All" id="cart_clear_allM">
                                                              <div id="clear-all-displayM" class="flex justify-center items-center cursor-pointer">
                                                                    <p class="mr-2 dm-sans font-medium text-gray-10">{{ __('Clear All') }}
                                                                        </p>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83333 11.6667C5.3731 11.6667 5 11.2937 5 10.8334L5 8.33341C5 7.87318 5.3731 7.50008 5.83333 7.50008C6.29357 7.50008 6.66667 7.87318 6.66667 8.33341L6.66667 10.8334C6.66667 11.2937 6.29357 11.6667 5.83333 11.6667Z" fill="#898989"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.16732 11.6667C8.70708 11.6667 8.33398 11.2937 8.33398 10.8334L8.33398 8.33341C8.33398 7.87318 8.70708 7.50008 9.16732 7.50008C9.62755 7.50008 10.0007 7.87318 10.0007 8.33341L10.0007 10.8334C10.0007 11.2937 9.62756 11.6667 9.16732 11.6667Z" fill="#898989"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.8552 5.01385C0.657717 5.00037 0.399686 4.99992 0 4.99992V3.33325C0.00891358 3.33325 0.0177978 3.33325 0.0266526 3.33325C0.0445462 3.33325 0.0623196 3.33325 0.0799725 3.33325H14.92C14.9377 3.33325 14.9555 3.33325 14.9733 3.33325L15 3.33325V4.99992C14.6003 4.99992 14.3423 5.00037 14.1448 5.01385C13.9548 5.02681 13.8824 5.04899 13.8478 5.06335C13.6436 5.14793 13.4813 5.31016 13.3968 5.51435C13.3824 5.54903 13.3602 5.62139 13.3473 5.81139C13.3338 6.00887 13.3333 6.2669 13.3333 6.66659L13.3333 11.7214C13.3334 12.4602 13.3334 13.0967 13.2649 13.6064C13.1914 14.1527 13.0258 14.6763 12.6011 15.101C12.1764 15.5257 11.6528 15.6914 11.1065 15.7648C10.5968 15.8333 9.96027 15.8333 9.22153 15.8333H5.77847C5.03973 15.8333 4.40322 15.8333 3.89351 15.7648C3.34724 15.6914 2.82362 15.5257 2.3989 15.101C1.97418 14.6763 1.80856 14.1527 1.73512 13.6064C1.66659 13.0967 1.66662 12.4602 1.66666 11.7214L1.66667 6.66659C1.66667 6.2669 1.66622 6.00887 1.65274 5.81139C1.63978 5.62139 1.6176 5.54903 1.60323 5.51435C1.51865 5.31016 1.35643 5.14793 1.15224 5.06335C1.11756 5.04899 1.0452 5.02681 0.8552 5.01385ZM11.8107 4.99992H3.18933C3.26749 5.23126 3.29962 5.46462 3.31554 5.69793C3.33335 5.95898 3.33334 6.27439 3.33333 6.63993L3.33333 11.6666C3.33333 12.4758 3.3351 12.9989 3.38692 13.3843C3.43552 13.7458 3.51397 13.8591 3.57741 13.9225C3.64085 13.9859 3.75414 14.0644 4.11559 14.113C4.50101 14.1648 5.0241 14.1666 5.83333 14.1666H9.16667C9.9759 14.1666 10.499 14.1648 10.8844 14.113C11.2459 14.0644 11.3592 13.9859 11.4226 13.9225C11.486 13.8591 11.5645 13.7458 11.6131 13.3843C11.6649 12.9989 11.6667 12.4758 11.6667 11.6666V6.63993C11.6667 6.27439 11.6666 5.95898 11.6845 5.69793C11.7004 5.46462 11.7325 5.23126 11.8107 4.99992Z" fill="#898989"/>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.67175 0.101025C8.31844 0.0332505 7.90785 0 7.50015 0C7.09245 4.96705e-08 6.68185 0.0332505 6.32855 0.101025C6.15192 0.134907 5.979 0.179406 5.82234 0.238021C5.68005 0.291261 5.48597 0.37965 5.32178 0.532849C4.98526 0.84682 4.96699 1.37414 5.28096 1.71065C5.57723 2.0282 6.06348 2.06237 6.40011 1.8014C6.40204 1.80065 6.40412 1.79985 6.40639 1.799C6.45085 1.78237 6.52809 1.7598 6.64254 1.73785C6.87139 1.69395 7.17407 1.66667 7.50015 1.66667C7.82623 1.66667 8.12891 1.69395 8.35775 1.73785C8.4722 1.7598 8.54944 1.78237 8.59391 1.799C8.59617 1.79985 8.59826 1.80065 8.60018 1.8014C8.93681 2.06237 9.42306 2.0282 9.71933 1.71065C10.0333 1.37414 10.015 0.846819 9.67852 0.532848C9.51432 0.37965 9.32025 0.29126 9.17795 0.23802C9.02129 0.179405 8.84837 0.134907 8.67175 0.101025Z" fill="#898989"/>
                                                                    </svg>
                                                               </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                              </div>

                                        </div>

                                    </div>
                                </section>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="overlay" class="fixed z-50 top-0 left-0 bg-darken-4"></div>

        <div id="sidenav" class="flex flex-col fixed z-50 top-0 left-0 bg-gray-12 text-gray-2">

            <div class="mx-5">
                <div class="close flex items-center justify-center relative pointer mb-2 float-right mt-30p">
                    <svg class="cross" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9897 0.455612C11.3822 -0.151871 10.3973 -0.151871 9.78981 0.455612L0.45648 9.78895C-0.151003 10.3964 -0.151003 11.3814 0.45648 11.9888C1.06396 12.5963 2.04889 12.5963 2.65637 11.9888L11.9897 2.6555C12.5972 2.04802 12.5972 1.06309 11.9897 0.455612Z" fill="white"/>
                    </svg>
                </div>

                <div class="flex items-center mt-30p">
                    <a href="{{ route('site.index') }}">
                        <img width="139.71px" height="22px" src="{{ asset('public/frontend/assets/img/product/logo-6.png') }}" alt="">
                    </a>
                </div>

                <div class="flex items-center cursor-pointer mt-30p">
                    @if(isset(Auth::user()->roles[0]->type) && Auth::user()->roles[0]->type == 'global' &&
                    Auth::user()->roles[0]->slug == 'super-admin' || isset(Auth::user()->roles[0]->type) &&
                    Auth::user()->roles[0]->type == 'global' && Auth::user()->roles[0]->slug == 'customer')
                    <!--user dropdown start-->
                    <div class="flex relative inline-block">
                        <div class="relative text-sm">
                            <button class="flex items-center focus:outline-none ">
                                    <div class="flex flex-col justify-center bg-gray-100 items-center h-12 w-12 rounded-full cursor-pointer">
                                        <img class="h-12 w-12 rounded-full pink-blue cursor-pointer" src="{{ Auth::user()->fileUrl() }}"
                                    alt="Avatar of User">
                                    </div>
                            </button>
                        </div>
                    </div>
                    <!-- user dropdown end -->
                    @else
                    <svg class="open-login-modal" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="25" cy="25" r="25" fill="#3C3C3C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.7266 18C23.0697 18 21.7266 19.3431 21.7266 21C21.7266 22.6569 23.0697 24 24.7266 24C26.3834 24 27.7266 22.6569 27.7266 21C27.7266 19.3431 26.3834 18 24.7266 18ZM19.7266 21C19.7266 18.2386 21.9651 16 24.7266 16C27.488 16 29.7266 18.2386 29.7266 21C29.7266 23.7614 27.488 26 24.7266 26C21.9651 26 19.7266 23.7614 19.7266 21Z" fill="#ABABAB"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3588 29.3732C20.9215 28.4738 22.8082 28 24.7277 28C26.6472 28 28.5339 28.4738 30.0966 29.3732C31.6587 30.2722 32.8465 31.5702 33.3968 33.1106C33.5826 33.6307 33.3116 34.203 32.7915 34.3888C32.2714 34.5746 31.6992 34.3036 31.5134 33.7835C31.1521 32.7723 30.3312 31.8157 29.099 31.1066C27.8674 30.3978 26.3303 30 24.7277 30C23.125 30 21.588 30.3978 20.3564 31.1066C19.1242 31.8157 18.3032 32.7723 17.942 33.7835C17.7562 34.3036 17.1839 34.5746 16.6638 34.3888C16.1437 34.203 15.8728 33.6307 16.0586 33.1106C16.6089 31.5702 17.7967 30.2721 19.3588 29.3732Z" fill="#ABABAB"/>
                    </svg>
                    @endif
                    <div class="ml-3">
                        <p class="dm-bold font-bold text-sm">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                <p class="open-login-modal">No Account</p>
                            @endauth
                        </p>
                        <p class="roboto-medium font-medium text-11 mt-0.5 cursor-pointer">
                            @auth
                                {{ Auth::user()->email }}
                                @else
                                <p class="open-login-modal">Create or login now</p>
                            @endauth
                        </p>
                    </div>
                </div>

                <div class="flex items-center mt-35p">
                    <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.8877 1.82952C5.38875 2.1649 4.79817 2.67836 3.94593 3.4218L3.04594 4.2069C2.07069 5.05765 1.75458 5.35299 1.58498 5.72828C1.41463 6.10522 1.40008 6.54516 1.40008 7.85203V11.736C1.40008 12.619 1.40152 13.2121 1.45995 13.6544C1.51589 14.0779 1.61252 14.2565 1.72659 14.3726C1.83897 14.487 2.0096 14.583 2.41987 14.6392C2.85156 14.6983 3.43139 14.6998 4.30004 14.6998H9.69996C10.5686 14.6998 11.1484 14.6983 11.5801 14.6392C11.9904 14.583 12.161 14.487 12.2734 14.3726C12.3875 14.2565 12.4841 14.0779 12.54 13.6544C12.5985 13.2121 12.5999 12.619 12.5999 11.736V7.85204C12.5999 6.54516 12.5854 6.10522 12.415 5.72828C12.2454 5.35299 11.9293 5.05765 10.9541 4.2069L10.0541 3.4218C9.20183 2.67836 8.61125 2.1649 8.1123 1.82952C7.62942 1.50494 7.30682 1.39998 7 1.39998C6.69318 1.39998 6.37058 1.50494 5.8877 1.82952ZM5.10671 0.667625C5.71201 0.260758 6.30804 0 7 0C7.69196 0 8.28799 0.260758 8.89329 0.667624C9.47411 1.05804 10.1306 1.63076 10.9392 2.33611L11.8744 3.15192C11.9112 3.18405 11.9476 3.21574 11.9835 3.24702C12.8054 3.96323 13.3799 4.4639 13.6908 5.15174C14.0009 5.83803 14.0005 6.60465 14 7.70605C13.9999 7.75407 13.9999 7.80272 13.9999 7.85204V11.7837C13.9999 12.6066 14 13.2929 13.928 13.8378C13.8521 14.412 13.6851 14.9334 13.272 15.3538C12.8572 15.776 12.34 15.9482 11.7699 16.0262C11.2321 16.0998 10.5557 16.0998 9.74887 16.0998H4.25112C3.44434 16.0998 2.76788 16.0998 2.23008 16.0262C1.66003 15.9482 1.14281 15.776 0.727991 15.3538C0.314855 14.9334 0.147889 14.412 0.0720281 13.8378C4.9191e-05 13.2929 7.1385e-05 12.6066 9.79206e-05 11.7837L9.89219e-05 7.85203C9.89219e-05 7.80272 7.35546e-05 7.75406 4.8521e-05 7.70604C-0.000526334 6.60465 -0.000926452 5.83803 0.309224 5.15174C0.620073 4.4639 1.19463 3.96323 2.01654 3.24702C2.05243 3.21574 2.0888 3.18405 2.12564 3.15192L3.06084 2.3361C3.86938 1.63076 4.52589 1.05803 5.10671 0.667625Z" fill="#DFDFDF"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.19922 10.4999C4.19922 9.72668 4.82601 9.09988 5.5992 9.09988H8.39916C9.17235 9.09988 9.79914 9.72668 9.79914 10.4999V15.3998C9.79914 15.7864 9.48574 16.0998 9.09915 16.0998C8.71256 16.0998 8.39916 15.7864 8.39916 15.3998V10.4999H5.5992V15.3998C5.5992 15.7864 5.2858 16.0998 4.89921 16.0998C4.51261 16.0998 4.19922 15.7864 4.19922 15.3998V10.4999Z" fill="#DFDFDF"/>
                    </svg>
                    <p class="dm-sans text-sm font-medium ml-13p">Home</p>
                </div>

                <div class="flex items-center mt-5">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 1.16667C3.77834 1.16667 1.16667 3.77834 1.16667 7C1.16667 10.2217 3.77834 12.8333 7 12.8333C10.2217 12.8333 12.8333 10.2217 12.8333 7C12.8333 3.77834 10.2217 1.16667 7 1.16667ZM0 7C0 3.13401 3.13401 0 7 0C10.866 0 14 3.13401 14 7C14 10.866 10.866 14 7 14C3.13401 14 0 10.866 0 7Z" fill="#DFDFDF"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3292 3.67087C10.4854 3.82711 10.54 4.0582 10.4701 4.26782L9.01175 8.64282C8.95369 8.817 8.817 8.95369 8.64282 9.01175L4.26782 10.4701C4.0582 10.54 3.82711 10.4854 3.67087 10.3292C3.51463 10.1729 3.46008 9.94183 3.52995 9.73222L4.98828 5.35722C5.04635 5.18303 5.18303 5.04635 5.35722 4.98828L9.73222 3.52995C9.94183 3.46008 10.1729 3.51463 10.3292 3.67087ZM6.00285 6.00285L5.00568 8.99435L7.99718 7.99718L8.99435 5.00568L6.00285 6.00285Z" fill="#DFDFDF"/>
                    </svg>
                    <p class="dm-sans text-sm font-medium ml-13p">Track Order</p>
                </div>
            </div>
            <hr class="my-5 h-px border-t border-gray-600 mx-5">

            <div id="accordian" class="relative flex-1 px-5">
                <ul class="flex flex-col space-y-6 dm-sans font-medium text-sm">
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Electronic Devices</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Reports</a></li>
                            <li><a href="#">Search</a></li>
                            <li><a href="#">Graphs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Smart Phones</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Today's tasks</a></li>
                            <li class="active">
                                <div class="flex justify-between items-center">
                                    <p><a href="#">Smart Phones</a></p>
                                    <h3>
                                        <a class="clicks rotate" href="#">
                                            <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                            </svg>
                                        </a>
                                    </h3>
                                </div>
                                <ul>
                                    <li><a href="#">Today's tasks</a></li>
                                    <li><a href="#">Urgent</a></li>
                                    <li>
                                        <div class="flex justify-between items-center">
                                            <p><a href="#">Smart Phones</a></p>
                                            <h3>
                                                <a class="clicks rotate" href="#">
                                                    <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                                    </svg>
                                                </a>
                                            </h3>
                                        </div>
                                        <ul>
                                            <li><a href="#">Today's tasks</a></li>
                                            <li><a href="#">Urgent</a></li>
                                            <li><a href="#">Overdues</a></li>
                                            <li><a href="#">Recurring</a></li>
                                            <li><a href="#">Settings</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Recurring</a></li>
                                    <li><a href="#">Settings</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Recurring</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">TV & Home Appliances</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Current Month</a></li>
                            <li><a href="#">Current Week</a></li>
                            <li><a href="#">Previous Month</a></li>
                            <li><a href="#">Previous Week</a></li>
                            <li><a href="#">Next Month</a></li>
                            <li><a href="#">Next Week</a></li>
                            <li><a href="#">Team Calendar</a></li>
                            <li><a href="#">Private Calendar</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Toys & Pets</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Fashion & Lifestyle</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Toys & Pets</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Kitchen & Cooking</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Home & Office</a></p>
                            <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p><a href="#">Toys & Pets</a></p>
                             <h3>
                                <a class="clicks rotate" href="#">
                                    <p class="flex justify-end">
                                        <svg class="" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.870679 3.60997e-07L-3.02758e-07 0.948839L3.25864 4.5L3.18147e-07 8.05116L0.87068 9L5 4.5L0.870679 3.60997e-07Z" fill="#DFDFDF"/>
                                        </svg>
                                    </p>
                                </a>
                            </h3>
                        </div>
                        <ul class="mt-3">
                            <li><a href="#">Global favs</a></li>
                            <li><a href="#">My favs</a></li>
                            <li><a href="#">Team favs</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="mt-5">
                    <a class="flex items-center">
                        <span class="dm-sans font-medium text-sm cursor-pointer uppercase">
                            See All Categories
                        </span>
                        <svg class="ml-2.5" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4L10.7071 3.29289L11.4142 4L10.7071 4.70711L10 4ZM1 5C0.447715 5 0 4.55228 0 4C0 3.44772 0.447715 3 1 3V5ZM7.70711 0.292893L10.7071 3.29289L9.29289 4.70711L6.29289 1.70711L7.70711 0.292893ZM10.7071 4.70711L7.70711 7.70711L6.29289 6.29289L9.29289 3.29289L10.7071 4.70711ZM10 5H1V3H10V5Z" fill="#DFDFDF"/>
                        </svg>
                    </a>
                </div>
            </div>
            <hr class="my-5 h-px border-t border-gray-600 mx-5">
            <div class="mx-5 pb-7">
                    @auth
                    <a href="{{ route('site.logout') }}">
                        <div class="flex items-center">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8075 2.05033C11.1229 1.7349 11.6343 1.7349 11.9497 2.05033C12.9287 3.02929 13.5954 4.27657 13.8655 5.63444C14.1356 6.99231 13.997 8.39977 13.4672 9.67885C12.9373 10.9579 12.0401 12.0512 10.889 12.8204C9.73785 13.5895 8.38447 14.0001 7 14.0001C5.61553 14.0001 4.26215 13.5895 3.11101 12.8204C1.95987 12.0512 1.06266 10.9579 0.532846 9.67886C0.00303305 8.39977 -0.13559 6.99231 0.134506 5.63444C0.404602 4.27657 1.07129 3.02929 2.05025 2.05033C2.36568 1.7349 2.87708 1.7349 3.1925 2.05033C3.50793 2.36575 3.50793 2.87715 3.1925 3.19258C2.43945 3.94563 1.92662 4.90507 1.71885 5.94959C1.51108 6.9941 1.61772 8.07676 2.02527 9.06067C2.43282 10.0446 3.12297 10.8855 4.00847 11.4772C4.89396 12.0689 5.93502 12.3847 7 12.3847C8.06498 12.3847 9.10604 12.0689 9.99153 11.4772C10.877 10.8855 11.5672 10.0446 11.9747 9.06067C12.3823 8.07676 12.4889 6.9941 12.2811 5.94959C12.0734 4.90507 11.5605 3.94563 10.8075 3.19258C10.4921 2.87715 10.4921 2.36575 10.8075 2.05033Z" fill="#DFDFDF"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.9991 -3.38342e-08C7.44517 -5.25204e-08 7.80679 0.361616 7.80679 0.807692L7.80679 3.90384C7.80679 4.34992 7.44517 4.71154 6.9991 4.71154C6.55302 4.71154 6.19141 4.34992 6.19141 3.90384L6.19141 0.807692C6.19141 0.361616 6.55302 -1.51481e-08 6.9991 -3.38342e-08Z" fill="#DFDFDF"/>
                            </svg>
                            <p class="ml-3 dm-sans font-medium text-sm">Logout</p>
                        </div>
                    </a>
                    @else
                    <div class="flex items-center">
                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.49627 1.4486C6.66013 1.21709 7.86651 1.33591 8.96285 1.79003C10.0592 2.24415 10.9962 3.01317 11.6555 3.99985C12.3148 4.98653 12.6667 6.14655 12.6667 7.33321C12.6667 8.51988 12.3148 9.6799 11.6555 10.6666C10.9962 11.6533 10.0592 12.4223 8.96285 12.8764C7.86651 13.3305 6.66013 13.4493 5.49627 13.2178C4.3324 12.9863 3.26332 12.4149 2.42422 11.5758L1.48143 12.5186C2.50699 13.5441 3.81365 14.2426 5.23615 14.5255C6.65865 14.8085 8.13312 14.6633 9.47309 14.1082C10.8131 13.5532 11.9583 12.6133 12.7641 11.4073C13.5699 10.2014 14 8.78359 14 7.33321C14 5.88284 13.5699 4.46504 12.7641 3.2591C11.9583 2.05316 10.8131 1.11324 9.47309 0.558211C8.13312 0.00317755 6.65866 -0.142045 5.23615 0.140909C3.81365 0.423862 2.50699 1.12228 1.48143 2.14785L2.42422 3.09064C3.26332 2.25154 4.3324 1.68011 5.49627 1.4486Z" fill="#DFDFDF"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.51974 3.58344L5.4786 4.41635L7.27874 6.66651H0.665929C0.297745 6.66651 -0.000726121 6.96499 -0.000726121 7.33317C-0.000726121 7.70135 0.297745 7.99982 0.665929 7.99982H7.27874L5.4786 10.25L6.51974 11.0829L9.51953 7.33317L6.51974 3.58344Z" fill="#DFDFDF"/>
                        </svg>
                        <p class="ml-3 dm-sans font-medium text-sm open-login-modal">Login</p>
                    </div>
                @endauth
            </div>
        </div>
</section>
