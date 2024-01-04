<section class="md:border-b sticky top-0 z-40 md:bg-white bg-gray-12 max-h-24">

    <div class="py-4">
        <div class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 grid md:grid-cols-12 gap-2">
            <div class="col-span-2 md:col-span-1 lg:col-span-2 hidden md:block">
                <div class="h-9 w-63 pt-1p">
                    <a href="{{ route('site.index') }}">
                        <img class="mt-3 md:w-36 lg:w-auto" width="191.42px" height="30.14px" src="{{ asset('public/frontend/assets/img/product/logo-5.png') }}" alt="">
                    </a>
                </div>
            </div>

            <div class="md:col-span-7 col-span-12 md:pl-28 md:-ml-1 mx-1">
                <form method="GET" action="{{ route('site.searchByKeyWord','') }}">
                <div class="relative rounded input-width border search-border search-placeholder bg-white mt-2">
                    <input type="search" name="keyword" placeholder="{{ __('Type your product name..') }}" value="{{ $searchKeyword ?? null }}" id="itemSearch" class="bg-transparent h-10 w-full text-sm focus:outline-none pl-12 pr-10"/>

                    <button type="submit" class="absolute left-0 -top-1 mt-3 ml-3 pr-2 border-r border-gray-300 h-6 search-btn">
                        <svg class="h-4 w-4 fill-current text-gray-500" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2C13.3137 2 16 4.68629 16 8C16 11.3137 13.3137 14 10 14C6.68629 14 4 11.3137 4 8C4 4.68629 6.68629 2 10 2ZM18 8C18 3.58172 14.4183 0 10 0C5.58172 0 2 3.58172 2 8C2 12.4183 5.58172 16 10 16C14.4183 16 18 12.4183 18 8Z" fill="#2C2C2C"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.70711 13.2929C4.31658 12.9024 3.68342 12.9024 3.29289 13.2929L0.292893 16.2929C-0.0976315 16.6834 -0.0976315 17.3166 0.292893 17.7071C0.683417 18.0976 1.31658 18.0976 1.70711 17.7071L4.70711 14.7071C5.09763 14.3166 5.09763 13.6834 4.70711 13.2929Z" fill="#2C2C2C"/>
                        </svg>

                    </button>

                    <button type="submit" class="absolute right-0 -top-1 mt-3 ml-3 pr-2 h-6 search-btn">

                        <svg class="h-4 w-4 fill-current text-gray-500" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 9C2.44772 9 2 8.55228 2 8L2 1C2 0.447716 2.44771 -3.91405e-08 3 -8.74228e-08C3.55228 -1.35705e-07 4 0.447716 4 1L4 8C4 8.55228 3.55228 9 3 9Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 5C8.44772 5 8 4.55228 8 4L8 1C8 0.447715 8.44771 -9.13278e-08 9 -2.03986e-07C9.55228 -3.16645e-07 10 0.447715 10 1L10 4C10 4.55228 9.55228 5 9 5Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 16C2.44772 16 2 15.5523 2 15L2 12C2 11.4477 2.44771 11 3 11C3.55228 11 4 11.4477 4 12L4 15C4 15.5523 3.55228 16 3 16Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 16C14.4477 16 14 15.5523 14 15L14 13C14 12.4477 14.4477 12 15 12C15.5523 12 16 12.4477 16 13L16 15C16 15.5523 15.5523 16 15 16Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 16C8.44772 16 8 15.5523 8 15L8 8C8 7.44772 8.44771 7 9 7C9.55228 7 10 7.44772 10 8L10 15C10 15.5523 9.55228 16 9 16Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 4C6 3.44772 6.44772 3 7 3L11 3C11.5523 3 12 3.44772 12 4C12 4.55228 11.5523 5 11 5L7 5C6.44772 5 6 4.55228 6 4Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 11.4477 0.447715 11 1 11L5 11C5.55228 11 6 11.4477 6 12C6 12.5523 5.55228 13 5 13L1 13C0.447715 13 0 12.5523 0 12Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 13C12 12.4477 12.4477 12 13 12L17 12C17.5523 12 18 12.4477 18 13C18 13.5523 17.5523 14 17 14L13 14C12.4477 14 12 13.5523 12 13Z" fill="#898989"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 10C14.4477 10 14 9.55228 14 9L14 1C14 0.447715 14.4477 -3.42479e-08 15 -7.64949e-08C15.5523 -1.18742e-07 16 0.447715 16 1L16 9C16 9.55228 15.5523 10 15 10Z" fill="#898989"/>
                            </svg>
                    </button>
                </div>
                </form>
            </div>

            <div class="col-span-3 md:col-span-4 lg:col-span-3 hidden md:block">
                <div class="flex justify-end items-end rev">
                    <ul class="flex ">
                        <li>
                            @php
                                if (!auth()->user()) {
                                    $ckname = explode("_", Auth::getRecallerName())[2];
                                    $value = Cookie::get($ckname);
                                    if (!is_null($value)) {
                                        $rememberedUser = explode(".", explode($ckname, decrypt($value))[1]);
                                        if ($rememberedUser[1] == 'user' && Auth::guard('user')->loginUsingId($rememberedUser[0]))
                                        {
                                            $ckkey = encrypt($ckname . Auth::user()->id . ".user");
                                            Cookie::queue($ckname, $ckkey, 2592000);
                                        }
                                    }
                                }

                            @endphp
                            @auth
                            <!--user dropdown start-->
                            <div class="relative inline-block mt-2 mr-3">
                                <div class="relative text-sm">
                                    <button id="userButton" class="flex items-center focus:outline-none ">
                                            <div class="flex flex-col justify-center mr-4 bg-gray-100 items-center h-9 w-9 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer">
                                                <img class="h-9 w-9 rounded-full pink-blue dark:text-gray-2 hover:text-purple-500 cursor-pointer" src="{{ Auth::user()->fileUrl() }}"
                                            alt="Avatar of User">
                                            </div>
                                    </button>

                                    <div id="userMenu"
                                        class="absolute right-0 w-40 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 overflow-auto z-50 invisible">
                                        <ul class="list-reset text-gray-600">
                                            <li class="flex">
                                                <a href="{{ route('site.dashboard') }}" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                  <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                  </svg>
                                                  <span>{{__('My Account') }}</span>
                                                </a>
                                            </li>

                                            @if (auth()->user()->roles()->first()->slug == 'super-admin')
                                                <li class="flex">
                                                    <a href="{{ route('dashboard') }}" target="_blank" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                        <svg class="w-3 h-3 mr-3" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19 0H10V2H15.5858L7.2929 10.2929C6.90237 10.6834 6.90237 11.3166 7.2929 11.7071C7.68342 12.0976 8.31658 12.0976 8.70711 11.7071L17 3.41421V9H19V0Z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.90036 3.04616C4.39908 3.00096 5.04698 3 6 3C6.55229 3 7 2.55229 7 2C7 1.44772 6.55229 1 6 1L5.95396 1C5.05849 0.999985 4.31952 0.999972 3.71983 1.05432C3.09615 1.11085 2.52564 1.23242 2 1.5359C1.39192 1.88697 0.886973 2.39192 0.535898 3C0.232418 3.52564 0.11085 4.09615 0.0543234 4.71983C-2.83718e-05 5.31953 -1.50204e-05 6.05851 2.38419e-07 6.95399V12.0705C-3.60012e-05 13.4247 -6.65188e-05 14.5413 0.118752 15.4251C0.243496 16.3529 0.515463 17.1723 1.17157 17.8284C1.82768 18.4845 2.64711 18.7565 3.57494 18.8812C4.4587 19.0001 5.57532 19 6.92946 19H12.046C12.9415 19 13.6805 19 14.2802 18.9457C14.9039 18.8892 15.4744 18.7676 16 18.4641C16.6081 18.113 17.113 17.6081 17.4641 17C17.7676 16.4744 17.8891 15.9039 17.9457 15.2802C18 14.6805 18 13.9415 18 13.046L18 13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13C16 13.953 15.999 14.6009 15.9538 15.0996C15.9099 15.5846 15.8305 15.8295 15.732 16C15.5565 16.304 15.304 16.5565 15 16.732C14.8295 16.8305 14.5846 16.9099 14.0996 16.9538C13.6009 16.999 12.953 17 12 17H7C5.55752 17 4.57625 16.9979 3.84143 16.8991C3.13538 16.8042 2.80836 16.6368 2.58579 16.4142C2.36322 16.1916 2.19584 15.8646 2.10092 15.1586C2.00212 14.4237 2 13.4425 2 12V7C2 6.04698 2.00096 5.39908 2.04616 4.90036C2.09011 4.41539 2.16951 4.17051 2.26795 4C2.44349 3.69596 2.69596 3.44349 3 3.26795C3.17051 3.16951 3.41539 3.09011 3.90036 3.04616Z" />
                                                        </svg>
                                                      <span>{{ __('Admin Panel') }}</span>
                                                    </a>
                                                </li>
                                                @endif

                                                @if (auth()->user()->roles()->first()->slug == 'super-admin' || auth()->user()->roles()->first()->slug == 'vendor-admin')

                                                <li class="flex">
                                                    <a href="{{ route('vendor-dashboard') }}" target="_blank" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                        <svg class="w-3 h-3 mr-3" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19 0H10V2H15.5858L7.2929 10.2929C6.90237 10.6834 6.90237 11.3166 7.2929 11.7071C7.68342 12.0976 8.31658 12.0976 8.70711 11.7071L17 3.41421V9H19V0Z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.90036 3.04616C4.39908 3.00096 5.04698 3 6 3C6.55229 3 7 2.55229 7 2C7 1.44772 6.55229 1 6 1L5.95396 1C5.05849 0.999985 4.31952 0.999972 3.71983 1.05432C3.09615 1.11085 2.52564 1.23242 2 1.5359C1.39192 1.88697 0.886973 2.39192 0.535898 3C0.232418 3.52564 0.11085 4.09615 0.0543234 4.71983C-2.83718e-05 5.31953 -1.50204e-05 6.05851 2.38419e-07 6.95399V12.0705C-3.60012e-05 13.4247 -6.65188e-05 14.5413 0.118752 15.4251C0.243496 16.3529 0.515463 17.1723 1.17157 17.8284C1.82768 18.4845 2.64711 18.7565 3.57494 18.8812C4.4587 19.0001 5.57532 19 6.92946 19H12.046C12.9415 19 13.6805 19 14.2802 18.9457C14.9039 18.8892 15.4744 18.7676 16 18.4641C16.6081 18.113 17.113 17.6081 17.4641 17C17.7676 16.4744 17.8891 15.9039 17.9457 15.2802C18 14.6805 18 13.9415 18 13.046L18 13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13C16 13.953 15.999 14.6009 15.9538 15.0996C15.9099 15.5846 15.8305 15.8295 15.732 16C15.5565 16.304 15.304 16.5565 15 16.732C14.8295 16.8305 14.5846 16.9099 14.0996 16.9538C13.6009 16.999 12.953 17 12 17H7C5.55752 17 4.57625 16.9979 3.84143 16.8991C3.13538 16.8042 2.80836 16.6368 2.58579 16.4142C2.36322 16.1916 2.19584 15.8646 2.10092 15.1586C2.00212 14.4237 2 13.4425 2 12V7C2 6.04698 2.00096 5.39908 2.04616 4.90036C2.09011 4.41539 2.16951 4.17051 2.26795 4C2.44349 3.69596 2.69596 3.44349 3 3.26795C3.17051 3.16951 3.41539 3.09011 3.90036 3.04616Z" />
                                                        </svg>
                                                      <span>{{ __('Vendor Panel') }}</span>
                                                    </a>
                                                </li>
                                            @endif

                                            <li class="flex">
                                                <a href="#" class="inline-flex items-center w-full px-2 py-1 text-sm transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                  <svg class="w-4 h-4 mr-2 ml-0.5 text-gray-500" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                                  </svg>
                                                  <span class="ml-0.5">{{ __('Notifications') }}</span>
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
                            <div class="flex flex-col justify-center mr-7 items-center cursor-pointer open-login-modal mt-2">
                                    <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7274 20.4471C19.2716 19.1713 18.2672 18.0439 16.8701 17.2399C15.4729 16.4358 13.7611 16 12 16C10.2389 16 8.52706 16.4358 7.12991 17.2399C5.73276 18.0439 4.72839 19.1713 4.27259 20.4471" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="12" cy="8" r="4" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <p class="text-xs text-xss font-medium text-gray-10 roboto-medium mt-0.5 text-center">Account</p>
                            </div>
                            @endauth
                        </li>

                        <li>
                            <div class="flex flex-col justify-center -ml-6 items-center">
                                <a href="{{ route('site.wishlist') }}"
                                class="relative md:px-2 lg:px-4 py-2 block w-fill">
                                <div slot="icon" class="relative">
                                    @php
                                        $class = \App\Models\User::totalWishlist() != 0 ? 'h-4 w-4' : '';
                                    @endphp
                                    <div class="absolute text-xss rounded-full roboto-medium {{ $class }} flex items-center justify-center -top-2 right-0 bg-reds-3 text-white" id="totalWishlistItem">
                                        {{ \App\Models\User::totalWishlist() != 0 ? \App\Models\User::totalWishlist() : ''}}
                                    </div>

                                    <svg class="mt-0.5 ml-2" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z" stroke="#2C2C2C" stroke-width="2"/>
                                    </svg>
                                    <p class="text-xs text-xss font-medium text-gray-10 mt-1 roboto-medium" text-center>Wishlist</p>
                                </div>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div x-data="setup()" id="testing" class="z-50 -ml-2">
                                <div>
                                    <form action="#" class="flex-1">
                                    </form>
                                    <div class="items-center ml-4 sm:flex">
                                        <button @click="isSettingsPanelOpen = true"
                                            class="relative z-10 block rounded-md focus:outline-none justify-between">
                                            <div class="flex flex-col justify-center lg:mr-2 items-center">
                                                <div slot="icon" class="relative mt-2">
                                                    <div class="absolute text-xss roboto-medium flex items-center justify-center rounded-full h-4 w-4 right-2 -top-1.5 bg-reds-3 text-white"
                                                        id="totalCartItem">
                                                        {{ $carts->count() }}
                                                    </div>
                                                    <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 12L8 8C8 5.79086 9.79086 4 12 4V4C14.2091 4 16 5.79086 16 8L16 12" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M3.69435 12.6678C3.83942 10.9269 3.91196 10.0565 4.48605 9.52824C5.06013 9 5.9336 9 7.68053 9H16.3195C18.0664 9 18.9399 9 19.514 9.52824C20.088 10.0565 20.1606 10.9269 20.3057 12.6678L20.8195 18.8339C20.904 19.8474 20.9462 20.3542 20.6491 20.6771C20.352 21 19.8435 21 18.8264 21H5.1736C4.15655 21 3.64802 21 3.35092 20.6771C3.05382 20.3542 3.09605 19.8474 3.18051 18.8339L3.69435 12.6678Z" stroke="#2C2C2C" stroke-width="2"/>
                                                    </svg>
                                                    <p class="text-xs text-xss font-medium text-gray-10 roboto-medium text-center mt-0.5">Your Cart</p>
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
                                             <div id="emptyCart" class="flex flex-col items-center justify-center absolute inset-0">
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

                                        <div class="w-full px-30p scrollbar-w-2 hidden md:block z-50  h-690p overflow-auto pb-120p mt-10p" id="cart-header">
                                            @forelse($carts as $key => $cart)
                                            <div class="flex cursor-pointer border-gray-100 cart-item-header mt-6"
                                                id="cart-item-header-{{ $key }}">
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
                                                            <p id="cart-item-total-price">{{ formatNumber($totalPrice)}}</p>
                                                        </div>
                                                        @if ($totalPrice > 0)
                                                            <div id="view-cart-display" class="bg-white text-gray-12 border border-gray-2 p-2 w-full rounded mb-10p">
                                                                <a href="{{ route('site.cart') }}" class="flex justify-center px-4 py-2 rounded font-bold cursor-pointer dm-bold text-18">
                                                                {{ __('View Cart') }}
                                                                </a>

                                                            </div>
                                                        @endif
                                                        <div id="checkout-display" class="{{ $totalPrice > 0 ? 'bg-gray-12 text-white' : 'text-gray-10 bg-gray-11'}}  p-2 w-full rounded">
                                                                <a id="checkout-display" href="{{ route('site.checkOut',['select' => 'all']) }}" class="flex justify-center px-4 py-2  font-bold cursor-pointer dm-bold text-18">

                                                                    {{ __('Go to Checkout') }}
                                                                </a>
                                                        </div>
                                                        @if ($totalPrice > 0)
                                                            <div class="text-gray-10 mt-5"
                                                            aria-label="Clear All" id="cart_clear_all">
                                                              <div id="clear-all-display" class="flex justify-center items-center cursor-pointer">
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

                        <li>
                            <a href="{{ route('site.trackOrder') }}"
                                class="relative sm:px-4 py-2 block w-fill ">
                                <div slot="icon" class="relative flex flex-col justify-center items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.66667C7.39763 3.66667 3.66667 7.39763 3.66667 12C3.66667 16.6024 7.39763 20.3333 12 20.3333C16.6024 20.3333 20.3333 16.6024 20.3333 12C20.3333 7.39763 16.6024 3.66667 12 3.66667ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z" fill="#2C2C2C"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7559 7.2441C16.9791 7.46729 17.0571 7.79743 16.9573 8.09688L14.8739 14.3469C14.791 14.5957 14.5957 14.791 14.3469 14.8739L8.09688 16.9573C7.79743 17.0571 7.46729 16.9791 7.2441 16.7559C7.02091 16.5328 6.94297 16.2026 7.04279 15.9032L9.12612 9.65317C9.20907 9.40433 9.40433 9.20907 9.65317 9.12612L15.9032 7.04279C16.2026 6.94297 16.5328 7.02091 16.7559 7.2441ZM10.5755 10.5755L9.15097 14.8491L13.4245 13.4245L14.8491 9.15097L10.5755 10.5755Z" fill="#2C2C2C"/>
                                    </svg>

                                    <p class="text-xs text-xss font-medium text-gray-10 roboto-medium text-center mt-0.5">{{ __('Track Order') }}</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Start Header -->
    </div>
</section>

<script>
    const setup = () => {
        return {
            isSidebarOpen: false,
            currentSidebarTab: null,
            isSettingsPanelOpen: false,
            isSubHeaderOpen: false,
            watchScreen() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false
                }
            },
        }
    }

    // loading time
    $(document).ready(function () {
        document.querySelectorAll('.hideme').forEach(divs => {
            divs.classList.toggle('hidden')
        });
    });



</script>
