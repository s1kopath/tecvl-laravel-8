@extends('../site/layouts.user_panel.app')
@section('page_title', __('Reviews'))
@section('content')
    <!-- My Review -->
    <div class="dark:bg-red-1 h-full xl:px-74p px-5 pt-30p xl:pt-14">
        <div>
            <div class="flex items-center">
                <span class="mr-4 hidden lg:block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="53" height="44" viewBox="0 0 53 44" fill="none">
                        <rect x="36.1779" y="27.377" width="16.6222" height="16.6222" rx="2" fill="#FCCA19" />
                        <rect width="32.2667" height="32.2667" rx="2" fill="#FCCA19" />
                    </svg>
                </span>
                <span class="mr-4 mt-1 lg:hidden block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="32" viewBox="0 0 39 32" fill="none">
                        <rect x="26.3115" y="19.9111" width="12.0891" height="12.0891" rx="2" fill="#FCCA19" />
                        <rect width="23.4671" height="23.4671" rx="2" fill="#FCCA19" />
                    </svg>
                </span>
                <h1 class=" dark:text-gray-2 dm-sans font-medium lg:pt-0 text-2xl lg:text-4xl text-gray-12 mb-1 dark:text-gray-2">
                    {{ __('Reviews') }}
                </h1>
            </div>
            <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-2 text-20 text-gray-10 leading-6">
                {{ __('Feedbacks you gave on the products that you bought..') }}</p>
        </div>
        @if (count($reviews) > 0)
            <div>
                <div class="lg:flex lg:justify-between lg:mt-7 mt-5">
                    <div class="mt-14 lg:block hidden dm-bold font-bold text-gray-12 text-2xl uppercase">
                        <p>{{ __('Reviews list') }}</p>
                    </div>
                    <div class="text-lg mt-30p lg:hidden block dm-bold font-bold text-gray-12 lg:text-2xl uppercase">
                        <p>{{ __('Reviews ') }}</p>
                    </div>
                    <div class="flex justify-between lg:mt-10 mt-15p">
                        <h1 class="dm-sans font-medium mt-2 lg:text-lg text-sm whitespace-nowrap text-gray-12 mr-15p">
                            Filter By</h1>
                        <div class="flex">
                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <div>
                                    <button @click="dropdownOpen = !dropdownOpen"
                                        class="inline-flex justify-between lg:w-168p w-24 border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-10 hover:bg-gray-11">
                                        <div class="roboto-medium font-medium text-gray-10 lg:text-base text-xss whitespace-nowrap dark:text-gray-2">
                                            @php
                                                $filterDay = [
                                                    'today' => __('Today'),
                                                    'last_week' => __('Last 7 Days'),
                                                    'last_month' => __('Last 30 Days'),
                                                    'last_year' => __('Last 12 Months'),
                                                    'all_time' => __('All Time'),
                                                ];
                                            @endphp
                                            @foreach ($filterDay as $key => $value)
                                                @if (request('filter_day') == $key)
                                                    <span>{{ $value }}</span>
                                                @elseif(request('filter_day') == null && $key === 'all_time')
                                                    <span>{{ __('All Time') }}</span>
                                                @endif
                                            @endforeach
                                            @if (request('filter_day') && !in_array(request('filter_day'), array_flip($filterDay)))
                                                <span>{{ __('All Time') }}</span>
                                            @endif
                                        </div>
                                        <span class="mt-2 hidden lg:block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7"
                                                fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z"
                                                    fill="#898989" />
                                            </svg>
                                        </span>
                                        <span class=" mt-2 lg:hidden block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4"
                                                fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z"
                                                    fill="#898989" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                                </div>
                                <div x-show="dropdownOpen" class="absolute right-0 lg:w-168p w-24 border-t-0 border-gray-2 border bg-white z-20">
                                    @foreach ($filterDay as $key => $value)
                                        <a href="{{ request()->fullUrlWithQuery(['filter_day' => $key]) }}"
                                            class="block whitespace-nowrap pt-3.5 lg:w-168p w-24 lg:text-sm text-xss roboto-medium text-gray-10 font-medium border-t-0 capitalize lg:h-47p hover:bg-gray-11 hover:text-gray-12">
                                            @if (request('filter_day') == $key)
                                                <span class="text-green-1 ml-1.5 lg:ml-1">✓</span>
                                                <span class="inline-block ml-1.5 lg:ml-3 text-green-500">{{ $value }}</span>
                                            @elseif(request('filter_day') == null && $key === 'all_time')
                                                <span class="text-green-1 ml-1.5 lg:ml-1">✓</span>
                                                <span class="inline-block lg:ml-1 text-green-1 pb-3.5">{{ __('All Time') }}</span>
                                            @else
                                                <span class="inline-block ml-1.5 lg:ml-2">{{ $value }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <div class="flex items-center ml-3">
                                    <button @click="dropdownOpen = !dropdownOpen"
                                        class="inline-flex justify-between lg:w-168p w-24 lg:rounded-sm rounded border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none dark:bg-gray-2">
                                        <div class="roboto-medium font-medium text-gray-10 lg:text-base text-xss whitespace-nowrap dark:text-gray-2">
                                            @if (isset(request()->filter_status))
                                                <span>{{ ucfirst(request()->filter_status) }}</span>
                                            @else
                                                <span>{{ __('All Status') }}</span>
                                            @endif
                                        </div>
                                        <span class="mt-2 hidden lg:block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7"
                                                fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z" fill="#898989" />
                                            </svg>
                                        </span>
                                        <span class=" mt-2 lg:hidden block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z" fill="#898989" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full z-10">
                                </div>
                                <div x-show="dropdownOpen" class="absolute right-0 border border-t-0 border-gray-2 lg:w-168p w-24 bg-white z-20">
                                    <div class=" roboto-medium font-medium lg:text-sm text-xss text-gray-10">
                                        <a href="{{ request()->fullUrlWithQuery(['filter_status' => 'approve']) }}" class="block lg:h-47p lg:text-sm text-xss capitalize hover:text-gray-12 hover:bg-gray-2 pt-4">
                                            @if (request('filter_status') == 'approve')
                                                <span class="text-green-1 ml-1.5">✓</span>
                                                <span class="inline-block ml-1.5 text-green-1 lg:ml-1">{{ __('Approve') }}</span>
                                            @else
                                                <span class="inline-block ml-1.5 lg:ml-2">{{ __('Approve') }}</span>
                                            @endif
                                        </a>
                                        <a href="{{ request()->fullUrlWithQuery(['filter_status' => 'unapprove']) }}"
                                            class="block lg:text-sm text-xss capitalize hover:text-gray-12 hover:bg-gray-2 py-4">
                                            @if (request('filter_status') == 'unapprove')
                                                <span class="text-green-1 ml-1.5">✓</span>
                                                <span class="inline-block ml-1.5 text-green-1 lg:ml-3">{{ __('Unapprove') }}</span>
                                            @else
                                                <span class="inline-block ml-1.5 lg:ml-2">{{ __('Unapprove') }}</span>
                                            @endif
                                        </a>
                                        <a href="{{ url()->current().'?'.http_build_query(request()->except('filter_status')) }}"
                                            class="block lg:text-sm text-xss capitalize hover:text-gray-12 hover:bg-gray-2 py-4">
                                            @if (!isset(request()->filter_status))
                                                <span class="text-green-500 ml-1.5">✓</span>
                                                <span class="inline-block ml-1.5 text-green-1 lg:ml-3">{{ __('All Status') }}</span>
                                            @else
                                                <span class="inline-block ml-1.5 lg:ml-2 ">{{ __('All Status') }}</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="lg:py-23p py-0">
            <div class="overflow-x-auto hidden lg:block rounded-sm">
                <table class="w-full whitespace-nowrap bg-white dark:bg-gray-2 overflow-hidden">
                    <thead>
                        @if ($reviews->count() > 0)
                            <tr class="text-left bg-gray-11 border border-gray-2 dark:bg-gray-2">
                                <th class="w-96 pl-10 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Item Name') }}
                                </th>
                                <th class="w-72 px-5 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Rating') }}
                                </th>
                                <th class="py-4 px-2 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Date') }}
                                </th>
                                <th class="py-4 px-6 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Status') }}
                                </th>
                                <th class="py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if ($reviews->count() > 0)
                            @foreach ($reviews as $review)
                                <tr class="focus-within:bg-gray-200 overflow-hidden border border-gray-2">
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3 pl-10">
                                        <span class="roboto-medium font-medium text-gray-10 dark:text-gray-2 py-4 flex items-center">
                                            <a href="{{ route('site.itemDetails', ['code' => $review->item->item_code, 'name' => cleanedUrl($review->item->name)]) }}">{{ trimWords($review->item->name) }}
                                            </a>
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <div class='rating-stars flex items-center pl-4'>
                                            <ul id='stars'>
                                                @php
                                                    $ratingCount = 0;
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class='text-sm star'>
                                                        @if ($i <= $review->rating)
                                                            @php
                                                                $ratingCount++;
                                                            @endphp
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                                viewBox="0 0 17 16" fill="none">
                                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="#FCCA19" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                                viewBox="0 0 17 16" fill="none">
                                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="#C4C4C4" />
                                                            </svg>
                                                        @endif
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span class="roboto-medium font-medium text-gray-10 -mt-1 ml-2.5">
                                                {{ $ratingCount }} {{ __('stars') }}</span>
                                        </div>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span
                                            class="roboto-medium font-medium text-gray-10 dark:text-gray-2 px-2 py-4 flex items-center">{{ formatDate($review->created_at) }}
                                        </span>
                                    </td>
                                     <td class="dark:border-t-gray-2 dark:bg-gray-3 pl-7">
                                            @if ($review->status == 'Active')
                                                <span class="roboto-medium font-medium text-gray-10 py-1">{{ __('Approved') }}</span>
                                            @else
                                                <span class="roboto-medium font-medium text-gray-10 py-1">{{ __('Unapprove') }}</span>
                                            @endif
                                        </td>

                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <div x-data="{ showModal1: false }" :class="{ 'overflow-y-hidden': showModal1 }">
                                            <main class="w-full flex flex-col sm:flex-row items-center">
                                                <div class="flex flex-col py-22p">
                                                    <div class="flex items-center justify-center">
                                                        <button class="dark:text-gray-2" @click="showModal1 = true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.02924 12.0576C5.55357 12.0576 5.16797 11.672 5.16797 11.1963L5.16797 8.61252C5.16797 8.13685 5.55357 7.75124 6.02924 7.75124C6.50491 7.75124 6.89052 8.13685 6.89052 8.61252L6.89052 11.1963C6.89052 11.672 6.50491 12.0576 6.02924 12.0576Z" fill="#898989" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.47456 12.0576C8.99889 12.0576 8.61328 11.672 8.61328 11.1963L8.61328 8.61252C8.61328 8.13685 8.99889 7.75124 9.47456 7.75124C9.95022 7.75124 10.3358 8.13685 10.3358 8.61252L10.3358 11.1963C10.3358 11.672 9.95023 12.0576 9.47456 12.0576Z" fill="#898989" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.883875 5.18226C0.67977 5.16833 0.413088 5.16786 0 5.16786V3.44531C0.00921245 3.44531 0.0183945 3.44531 0.0275462 3.44531C0.0460398 3.44531 0.0644092 3.44531 0.082654 3.44531H15.4203C15.4385 3.44531 15.4569 3.44531 15.4754 3.44531L15.5029 3.44531V5.16786C15.0899 5.16786 14.8232 5.16833 14.6191 5.18226C14.4227 5.19565 14.3479 5.21858 14.3121 5.23342C14.101 5.32084 13.9334 5.48851 13.846 5.69954C13.8311 5.73538 13.8082 5.81017 13.7948 6.00654C13.7809 6.21064 13.7804 6.47732 13.7804 6.89041L13.7804 12.1147C13.7804 12.8783 13.7805 13.5361 13.7097 14.0629C13.6337 14.6275 13.4626 15.1687 13.0236 15.6077C12.5847 16.0466 12.0435 16.2178 11.4789 16.2937C10.9521 16.3645 10.2942 16.3645 9.53072 16.3644H5.97222C5.20871 16.3645 4.55086 16.3645 4.02406 16.2937C3.45948 16.2178 2.91829 16.0466 2.47933 15.6077C2.04037 15.1687 1.8692 14.6275 1.7933 14.0629C1.72247 13.5361 1.7225 12.8783 1.72255 12.1148L1.72255 6.89041C1.72255 6.47732 1.72208 6.21064 1.70816 6.00654C1.69476 5.81017 1.67183 5.73538 1.65699 5.69954C1.56957 5.48851 1.40191 5.32084 1.19087 5.23342C1.15503 5.21858 1.08024 5.19565 0.883875 5.18226ZM12.2067 5.16786H3.29627C3.37705 5.40696 3.41026 5.64815 3.42671 5.88928C3.44512 6.15908 3.44511 6.48506 3.4451 6.86286L3.4451 12.0581C3.4451 12.8944 3.44693 13.4351 3.50048 13.8334C3.55071 14.207 3.6318 14.3241 3.69736 14.3896C3.76292 14.4552 3.88001 14.5363 4.25358 14.5865C4.65193 14.6401 5.19256 14.6419 6.02892 14.6419H9.47402C10.3104 14.6419 10.851 14.6401 11.2494 14.5865C11.6229 14.5363 11.74 14.4552 11.8056 14.3896C11.8711 14.3241 11.9522 14.207 12.0025 13.8334C12.056 13.4351 12.0578 12.8944 12.0578 12.0581V6.86286C12.0578 6.48506 12.0578 6.15908 12.0762 5.88928C12.0927 5.64815 12.1259 5.40696 12.2067 5.16786Z" fill="#898989" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96309 0.104413C8.59794 0.0343653 8.17358 0 7.75221 0C7.33084 5.1336e-08 6.90648 0.0343654 6.54133 0.104413C6.35878 0.139431 6.18006 0.185421 6.01815 0.246001C5.87108 0.301027 5.6705 0.39238 5.5008 0.550715C5.153 0.875213 5.13412 1.42022 5.45862 1.76801C5.76482 2.0962 6.26738 2.13152 6.61529 1.8618C6.61728 1.86102 6.61944 1.8602 6.62178 1.85932C6.66773 1.84213 6.74756 1.81881 6.86585 1.79612C7.10237 1.75074 7.4152 1.72255 7.75221 1.72255C8.08922 1.72255 8.40205 1.75074 8.63857 1.79612C8.75686 1.81881 8.83669 1.84213 8.88264 1.85932C8.88498 1.8602 8.88714 1.86102 8.88913 1.8618C9.23704 2.13152 9.7396 2.0962 10.0458 1.76801C10.3703 1.42021 10.3514 0.875212 10.0036 0.550714C9.83392 0.392379 9.63334 0.301026 9.48627 0.246001C9.32436 0.185421 9.14564 0.13943 8.96309 0.104413Z" fill="#898989" />
                                                            </svg>
                                                        </button>
                                                        <h1 @click="showModal1 = true" class="roboto-medium font-medium text-gray-10 cursor-pointer ml-2.5">
                                                            {{ __('Remove') }}
                                                        </h1>
                                                    </div>
                                                </div>
                                            </main>
                                            <!-- Modal1 -->
                                            <div class="fixed inset-0 w-full h-full bg-black bg-opacity-50 pt-60 duration-300 overflow-y-auto" x-show="showModal1" x-transition:enter="transition duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition duration-300"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                                                    <div class="relative modal-h-w bg-white shadow-lg rounded-md text-gray-900 z-50"
                                                        @click.away="showModal1 = false" x-show="showModal1" x-transition:enter="transition transform duration-300"
                                                        x-transition:enter-start="scale-0"
                                                        x-transition:enter-end="scale-100"
                                                        x-transition:leave="transition transform duration-300"
                                                        x-transition:leave-start="scale-100"
                                                        x-transition:leave-end="scale-0">
                                                        <div class=" grid grid-cols-4 gap-32 items-center">
                                                            <div class="flex col-span-3">
                                                                <div class="flex flex-col justify-center bg-red-100 mt-30p ml-30p items-center h-10 w-10 rounded-full dark:text-gray-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                        height="32" viewBox="0 0 32 32" fill="none">
                                                                        <circle cx="16" cy="16" r="16" fill="#F9E8E8" />
                                                                        <path d="M17.7925 8L17.5367 18.9463H15.3411L15.0746 8H17.7925ZM15 22.3037C15 21.9129 15.1279 21.586 15.3837 21.3231C15.6466 21.0531 16.009 20.9181 16.4709 20.9181C16.9256 20.9181 17.2845 21.0531 17.5474 21.3231C17.8103 21.586 17.9417 21.9129 17.9417 22.3037C17.9417 22.6803 17.8103 23.0036 17.5474 23.2736C17.2845 23.5365 16.9256 23.668 16.4709 23.668C16.009 23.668 15.6466 23.5365 15.3837 23.2736C15.1279 23.0036 15 22.6803 15 22.3037Z" fill="#C8191C" />
                                                                    </svg>
                                                                </div>
                                                                <span class="inline-block leading-4 ml-2 mt-10 dm-sans font-medium text-lg text-gray-12">{{ __('Are you sure you want to delete this?') }}</span>
                                                            </div>
                                                            <svg class="mr-30p mt-7 right-0 cursor-pointer hover:text-gray-12 text-gray-10" @click="showModal1 = false"
                                                                xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                                viewBox="0 0 13 13" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="currentColor" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9887 0.455612C11.3812 -0.151871 10.3963 -0.151871 9.78884 0.455612L0.455503 9.78895C-0.151979 10.3964 -0.151979 11.3814 0.455503 11.9888C1.06298 12.5963 2.04791 12.5963 2.65539 11.9888L11.9887 2.6555C12.5962 2.04802 12.5962 1.06309 11.9887 0.455612Z" fill="currentColor" />
                                                            </svg>
                                                        </div>
                                                        <p class=" text-gray-10 -mt-1 roboto-medium font-medium text-sm ml-77p">
                                                            {{ __('Please keep in mind that once deleted, you can not undo it.') }}
                                                        </p>
                                                        <div class=" flex justify-end mt-8 mr-30p mb-0">
                                                            <button class="dm-sans items-center transition duration-200 rounded pb-4 pt-3 cursor-pointer font-medium text-sm text-gray-12 w-141p h-46p bg-white border border-gray-2 mb-7p hover:border-gray-12" @click="showModal1 = false"> {{ __('Cancel') }} </button>
                                                            <form action="{{ route('site.review.destroy', ['id' => $review->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer py-3.5 px-6 font-medium text-sm text-white w-141p h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Yes, Delete') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @if (count($reviews) == 0)
                    <div class="flex flex-col justify-center items-center lg:mt-216p mt-90p ">
                        <span class="hidden lg:block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104"fill="none">
                                <path d="M7.12988 0.325191C3.67676 1.25957 0.954883 4.06269 0.223633 7.47519C-0.0810547 8.958 -0.0810547 34.0846 0.223633 35.5877C0.873633 38.6955 3.27051 41.4174 6.35801 42.5955C6.96738 42.8393 8.24707 42.9611 10.9689 43.0424L14.7268 43.1643L18.383 48.0393L22.0393 52.9143L22.8924 52.9752L23.7455 53.0361L27.4627 48.0596L31.1799 43.083L63.4768 43.0627C84.4799 43.0627 96.0783 42.9814 96.6674 42.8393C100.141 42.0471 103.147 38.8986 103.797 35.3643C104.081 33.8814 104.061 9.14082 103.797 7.69863C103.31 5.09863 101.4 2.43769 99.1658 1.25957C96.6471 -0.0810585 99.1252 0.000190735 60.7346 0.000190735C25.9393 0.000190735 25.8783 0.000190735 25.4314 0.406441C24.9033 0.893944 24.8424 1.95019 25.2689 2.55957C25.5533 2.9455 26.2236 2.9455 60.8768 3.04707L96.1799 3.14863L97.3377 3.71738C98.6377 4.34707 99.7752 5.52519 100.425 6.90644C100.852 7.82051 100.852 7.96269 100.852 21.5314V35.2424L100.283 36.4002C99.5924 37.8221 98.2315 39.0611 96.769 39.6096C95.6721 40.0158 95.3471 40.0158 62.8674 40.0158H30.1033L29.5143 40.5033C29.2096 40.7674 27.6252 42.7783 26.0002 44.9721C24.3752 47.1455 23.0143 48.933 22.9533 48.9533C22.8924 48.9533 21.4502 47.1049 19.7643 44.8299C18.058 42.5549 16.5346 40.5643 16.3314 40.4018C16.0674 40.1783 15.0111 40.0971 11.8018 40.0158C7.75957 39.9143 7.57676 39.8939 6.60176 39.3658C5.28145 38.6752 4.02207 37.3143 3.53457 36.0346C3.16895 35.1002 3.14863 34.3283 3.14863 21.4299V7.82051L3.71738 6.66269C4.36738 5.34238 5.5252 4.20488 6.88613 3.57519C7.75957 3.18925 8.24707 3.14863 13.6705 3.04707C19.1752 2.9455 19.5611 2.92519 19.8252 2.55957C20.2924 1.88926 20.1908 0.893944 19.5814 0.426754C19.0533 0.020504 18.8096 0.000190735 13.6299 0.020504C9.5877 0.020504 7.94238 0.101753 7.12988 0.325191Z" fill="#B0B0B0" />
                                <path d="M21.5923 10.4406C21.247 10.7453 20.5158 11.9844 19.7439 13.65L18.4642 16.3922L15.3767 16.8391C12.0252 17.3469 11.3752 17.5703 11.0095 18.3828C10.4205 19.6625 10.6642 20.1094 13.4267 22.75L15.6611 24.8828L15.133 27.7062C14.8486 29.2703 14.6252 30.8344 14.6252 31.1594C14.6455 32.1953 15.6408 33.1094 16.7377 33.1094C17.022 33.1094 18.5048 32.4594 20.0486 31.6469L22.8314 30.1844L25.6955 31.6469C27.2595 32.4594 28.7423 33.1094 29.0064 33.1094C29.7783 33.1094 30.5908 32.5609 30.8955 31.8703C31.1189 31.2812 31.0986 30.8344 30.6111 28.0516L30.0627 24.8828L32.2767 22.75C35.0392 20.1094 35.283 19.6625 34.6939 18.3828C34.3283 17.5703 33.6377 17.3266 30.3064 16.8391L27.2392 16.3719L25.9189 13.5891C25.1064 11.9031 24.3752 10.6437 24.0502 10.3797C23.3189 9.81094 22.3236 9.83125 21.5923 10.4406ZM24.0502 16.6156C24.7408 17.9969 25.3298 18.8906 25.6142 19.0531C26.0205 19.2562 29.7173 19.9062 30.5095 19.9062C30.6314 19.9062 29.9002 20.7594 28.8845 21.8156C26.772 23.9687 26.7923 23.8469 27.3205 26.8125C27.7877 29.4531 27.9095 29.3719 25.5533 28.1125C24.3955 27.5234 23.197 27.0156 22.872 27.0156C22.5267 27.0156 21.3486 27.5031 20.1705 28.1328C17.7939 29.3922 17.9158 29.4734 18.383 26.8125C18.9111 23.8469 18.9314 23.9687 16.8189 21.8156C15.8033 20.7594 15.072 19.9062 15.1939 19.9062C15.9861 19.9062 19.683 19.2562 20.0892 19.0531C20.3736 18.8906 20.9627 17.9969 21.6533 16.6156C22.2627 15.3969 22.7908 14.4219 22.8517 14.4219C22.9127 14.4219 23.4408 15.3969 24.0502 16.6156Z" fill="#B0B0B0" />
                                <path d="M50.9034 10.2782C50.4565 10.5219 50.0096 11.2735 48.9128 13.5282C48.1409 15.1329 47.43 16.4532 47.3284 16.4532C46.3737 16.4532 41.2346 17.3672 40.869 17.611C40.2596 17.9766 39.7924 19.0735 39.9549 19.7235C40.0159 19.9875 41.1128 21.2672 42.3925 22.5672L44.7284 24.9438L44.2003 28.0922C43.6315 31.5454 43.6518 31.9313 44.6065 32.6829C45.48 33.3735 46.1503 33.2313 49.1768 31.6266L51.98 30.1641L54.8034 31.6266C57.7487 33.1704 58.4596 33.3532 59.2925 32.7844C60.2675 32.0938 60.3284 31.4844 59.7596 28.0719L59.2518 24.9641L61.6081 22.5672C63.8831 20.2719 63.9846 20.1297 63.9846 19.3172C63.9846 17.936 63.2737 17.3875 61.1409 17.0829C60.1862 16.9407 58.744 16.7375 57.9315 16.6157L56.4487 16.3922L54.9456 13.4266C53.8284 11.1719 53.3409 10.3797 52.9143 10.1969C52.2237 9.87192 51.6143 9.89223 50.9034 10.2782ZM53.1581 16.5547C53.7471 17.7125 54.4378 18.8094 54.7018 18.9719C54.9456 19.1547 56.1643 19.4391 57.3831 19.6219C58.6221 19.8047 59.6581 19.9875 59.719 20.0485C59.78 20.1094 59.0284 20.9016 58.0534 21.8157C57.0784 22.7297 56.2456 23.7047 56.1643 23.9891C56.1034 24.2532 56.2253 25.5329 56.4487 26.8125C56.6925 28.0719 56.8753 29.1485 56.8753 29.1891C56.8753 29.2297 55.9003 28.7625 54.7018 28.1329C53.5034 27.5235 52.2643 27.0157 51.9596 27.0157C51.655 27.0157 50.4565 27.5235 49.2784 28.1532C48.08 28.7829 47.1253 29.2094 47.1253 29.1079C47.1253 29.0063 47.3081 27.9297 47.5315 26.711C47.755 25.4922 47.8768 24.3141 47.8159 24.0704C47.755 23.8469 46.8815 22.8313 45.8659 21.8157L44.0581 19.9672L46.4346 19.6422C47.755 19.4594 49.0346 19.1547 49.2987 18.9922C49.5628 18.8094 50.2534 17.7125 50.8425 16.5547C51.4112 15.3766 51.9393 14.4219 52.0003 14.4219C52.0612 14.4219 52.5893 15.3766 53.1581 16.5547Z" fill="#B0B0B0" />
                                <path d="M79.9703 10.3598C79.625 10.6239 78.8328 11.9239 78 13.6098L76.5984 16.3926L74.4047 16.7176C73.2063 16.9208 71.7844 17.1239 71.236 17.1848C69.6922 17.4083 68.8391 18.5051 69.1438 19.8458C69.225 20.2114 70.1391 21.2473 71.5813 22.6489L73.8969 24.8833L73.4094 27.6254C72.7594 31.302 72.7797 31.7692 73.511 32.5208C74.425 33.4348 75.0344 33.3129 78.3047 31.6473L81.1688 30.1848L83.9516 31.6473C86.8359 33.1708 87.3844 33.3129 88.3391 32.8051C89.4359 32.2567 89.5172 31.627 88.8875 28.052L88.3391 24.8833L90.5531 22.7504C92.7672 20.6176 93.2344 20.0286 93.2344 19.3989C93.2344 18.7692 92.6047 17.7333 92.1172 17.5098C91.8328 17.3676 90.2484 17.0833 88.5828 16.8395L85.5766 16.3926L84.175 13.5692C83.4031 12.0051 82.6109 10.6036 82.4281 10.4208C81.8391 9.89263 80.6203 9.85201 79.9703 10.3598ZM82.3063 16.5754C82.875 17.7536 83.525 18.8301 83.7688 18.9926C83.9922 19.1348 85.2719 19.4192 86.5922 19.6223L88.9688 19.9676L87.1406 21.8364C85.0484 23.9692 85.0688 23.9083 85.6172 27.0161C85.7797 27.9708 85.9219 28.8645 85.9219 29.0067C85.9219 29.1489 85.0688 28.8036 83.8297 28.1333C82.6313 27.5036 81.4734 27.0161 81.1281 27.0161C80.8031 27.0161 79.5844 27.5239 78.4266 28.1333C77.2688 28.7426 76.2938 29.2504 76.2734 29.2504C76.2531 29.2504 76.3953 28.2754 76.6188 27.0567C77.1672 23.9489 77.1266 23.8067 75.0141 21.6942C74.0391 20.7192 73.3485 19.9067 73.4906 19.9067C74.2016 19.9067 77.8375 19.277 78.2844 19.0739C78.65 18.8911 79.1375 18.1801 79.9297 16.6161C80.5594 15.4176 81.1078 14.4223 81.1688 14.4223C81.2297 14.4223 81.7375 15.3973 82.3063 16.5754Z" fill="#B0B0B0" />
                                <path d="M19.6016 58.5002C7.19067 60.4502 -1.48277 71.9471 0.223479 84.2158C1.4016 92.7471 7.45473 100.06 15.5797 102.781C19.0735 103.939 22.6282 104.244 26.2641 103.696C31.261 102.944 35.2016 100.933 38.9188 97.2158C41.0719 95.0627 42.0469 93.7018 43.3266 91.2033C47.0844 83.7487 46.2516 74.4049 41.2141 67.6002C39.7719 65.6705 36.8469 62.969 34.8969 61.7705C31.3219 59.5565 27.7875 58.5205 23.5625 58.3987C22.0594 58.358 20.2719 58.3987 19.6016 58.5002ZM27.8485 62.0143C29.7985 62.5221 32.4797 63.7408 34.1047 64.858C34.5922 65.183 35.6079 66.0565 36.3797 66.7674C42.8594 72.9018 44.4844 82.4487 40.3407 90.3096C39.8532 91.2033 39.1219 92.4221 38.675 92.9908C37.9235 94.0065 37.8829 94.0471 37.7 93.6002C36.1157 89.4971 33.8407 86.694 30.6516 84.8049C29.9813 84.419 29.3719 84.094 29.2907 84.094C29.2094 84.094 29.0266 84.0127 28.8641 83.9112C28.6407 83.769 28.7829 83.5252 29.5141 82.7533C34.3282 77.7362 31.8704 69.3065 25.086 67.5393C19.3579 66.0565 13.6094 70.5252 13.6094 76.4768C13.6094 78.7518 14.5032 81.0268 16.0875 82.7737L16.9813 83.7487L15.7219 84.3987C12.2891 86.1862 9.72973 89.0502 8.32817 92.6455L7.77973 94.0471L6.90629 92.8893C5.72817 91.3049 4.18442 88.0346 3.63598 85.9221C3.25004 84.5002 3.16879 83.6471 3.16879 81.1487C3.14848 78.4268 3.20942 77.8783 3.71723 76.0909C4.75317 72.333 6.52035 69.408 9.40473 66.7065C12.411 63.883 15.661 62.319 20.3125 61.4659C20.5969 61.4252 21.9579 61.4049 23.3594 61.4455C25.2485 61.4862 26.386 61.6283 27.8485 62.0143ZM24.7813 70.6268C26.2032 71.0737 27.8282 72.5768 28.4579 73.9783C29.1079 75.4612 29.1079 77.4924 28.4782 78.9143C27.8891 80.194 26.7922 81.3315 25.4922 82.0221C24.05 82.7737 21.6735 82.794 20.211 82.0627C18.0782 81.0268 16.6563 78.7924 16.6563 76.4971C16.6563 72.2721 20.7391 69.3268 24.7813 70.6268ZM25.4922 86.0237C27.8485 86.5112 29.7172 87.5674 31.586 89.4565C33.3938 91.2846 34.2875 92.808 34.8766 95.1237L35.2422 96.5049L34.5313 97.1143C33.3938 98.069 29.5141 99.8768 27.5235 100.385C24.9438 101.035 20.8 101.035 18.1797 100.385C16.2297 99.8971 12.8375 98.3533 11.4157 97.2971C10.4204 96.5455 10.3594 96.1393 10.9485 94.433C13.1016 88.1565 19.1141 84.683 25.4922 86.0237Z" fill="#B0B0B0" />
                                <path  d="M55.9203 60.5314C53.4625 60.897 51.7969 62.9689 51.7969 65.6907C51.7969 68.0267 53.1984 70.1392 55.0469 70.647C55.7578 70.8501 61.1203 70.8907 78.2234 70.8501L100.486 70.7892L101.461 70.1798C102.131 69.7532 102.619 69.2251 103.066 68.4532C103.634 67.4579 103.695 67.1532 103.695 65.711C103.695 64.2689 103.634 63.9642 103.066 62.9689C102.294 61.5876 101.116 60.7954 99.4297 60.5314C97.9875 60.2876 57.525 60.3079 55.9203 60.5314ZM100.161 64.147C100.953 65.0407 100.994 66.3204 100.222 67.2142L99.6937 67.8439H77.7969H55.9203L55.3922 67.3157C54.0719 65.9954 54.7219 63.9235 56.5703 63.5173C56.7937 63.4564 66.5641 63.436 78.2641 63.4564L99.5719 63.4767L100.161 64.147Z" fill="#B0B0B0" />
                                <path d="M56.0424 75.9688C54.783 76.1922 54.0314 76.5985 53.1783 77.5531C52.2846 78.5485 51.9189 79.5844 51.9189 81.1485C51.9189 82.7328 52.2846 83.7484 53.1986 84.7641C54.7018 86.45 52.7518 86.3281 77.858 86.3281C102.05 86.3281 100.73 86.3891 102.152 85.1906C104.366 83.3219 104.346 79.0156 102.111 77.0453C101.096 76.1516 100.121 75.8875 97.7846 75.8875C95.3471 75.8672 94.8596 76.111 94.8596 77.3906C94.8596 78.5281 95.3064 78.8125 97.1143 78.8125C99.1861 78.8125 100.08 79.0969 100.547 79.8891C100.771 80.2547 100.953 80.8031 100.953 81.1078C100.953 81.8188 100.466 82.7938 99.958 83.0781C99.694 83.2203 92.3408 83.2813 77.7971 83.2813H56.0221L55.433 82.6922C54.2549 81.5141 54.8033 79.4828 56.4283 79.0156C56.9158 78.8938 62.8674 78.8125 73.2674 78.8125H89.3549L89.6596 78.3656C90.0861 77.7563 90.0658 76.9235 89.5986 76.3547L89.2127 75.8672L73.0846 75.8469C64.2283 75.8266 56.5502 75.8875 56.0424 75.9688Z" fill="#B0B0B0" />
                                <path d="M56.0219 91.4063C53.6047 91.8125 52 93.9047 52 96.5859C52 98.7391 53.0156 100.486 54.7219 101.278C55.6969 101.725 56.0016 101.766 59.3531 101.766C62.8266 101.766 62.9484 101.745 63.2531 101.319C63.6797 100.709 63.6594 99.8766 63.1922 99.3078C62.8062 98.8406 62.6844 98.8203 59.475 98.7594C56.225 98.6984 56.1641 98.6781 55.6156 98.1703C54.4172 97.0125 54.8234 95.0219 56.3672 94.4938C56.9766 94.2906 61.6281 94.25 78.4469 94.2906L99.775 94.3516L100.364 95.0219C101.136 95.8953 101.197 97.1953 100.466 98.0484L99.9781 98.6172L84.5406 98.7188C69.7328 98.8203 69.0828 98.8406 68.6766 99.2063C68.1281 99.7141 68.0875 100.953 68.6156 101.441C68.9609 101.745 70.2812 101.766 84.8453 101.725L100.689 101.664L101.664 101.055C104.894 99.0438 104.691 93.6406 101.319 91.8734L100.242 91.3047L78.6094 91.2844C66.7062 91.2641 56.55 91.325 56.0219 91.4063Z" fill="#B0B0B0" />
                            </svg>
                        </span>
                        <span class="block lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 75 75" fill="none">
                                <g clip-path="url(#clip0_5607_4178)">
                                    <path d="M5.14136 0.234371C2.65112 0.908199 0.688232 2.92968 0.160889 5.39062C-0.0588379 6.45996 -0.0588379 24.5801 0.160889 25.6641C0.629639 27.9053 2.35815 29.8682 4.58472 30.7178C5.02417 30.8936 5.94702 30.9814 7.90991 31.04L10.6199 31.1279L13.2566 34.6436L15.8933 38.1592L16.5085 38.2031L17.1238 38.2471L19.8044 34.6582L22.4851 31.0693L45.7761 31.0547C60.9226 31.0547 69.2869 30.9961 69.7117 30.8936C72.2166 30.3223 74.3845 28.0518 74.8533 25.5029C75.0584 24.4336 75.0437 6.59179 74.8533 5.55175C74.5017 3.67675 73.1248 1.75781 71.5134 0.908199C69.697 -0.0585976 71.4841 -3.8147e-06 43.7986 -3.8147e-06C18.7058 -3.8147e-06 18.6619 -3.8147e-06 18.3396 0.292965C17.9587 0.644527 17.9148 1.40625 18.2224 1.8457C18.4275 2.12402 18.9109 2.12402 43.9011 2.19726L69.3601 2.2705L70.1951 2.68066C71.1326 3.13476 71.9529 3.98437 72.4216 4.98046C72.7293 5.63964 72.7293 5.74218 72.7293 15.5273V25.415L72.3191 26.25C71.8211 27.2754 70.8396 28.1689 69.7849 28.5645C68.9939 28.8574 68.7595 28.8574 45.3367 28.8574H21.7087L21.2839 29.209C21.0642 29.3994 19.9216 30.8496 18.7498 32.4316C17.5779 33.999 16.5964 35.2881 16.5525 35.3027C16.5085 35.3027 15.4685 33.9697 14.2527 32.3291C13.0222 30.6885 11.9236 29.2529 11.7771 29.1357C11.5867 28.9746 10.825 28.916 8.5105 28.8574C5.59546 28.7842 5.46362 28.7695 4.7605 28.3887C3.80835 27.8906 2.90015 26.9092 2.54858 25.9863C2.28491 25.3125 2.27026 24.7559 2.27026 15.4541V5.63964L2.68042 4.80468C3.14917 3.85254 3.98413 3.03222 4.96558 2.57812C5.59546 2.2998 5.94702 2.2705 9.85816 2.19726C13.8279 2.12402 14.1062 2.10937 14.2966 1.8457C14.6335 1.3623 14.5603 0.644527 14.1209 0.307613C13.74 0.0146446 13.5642 -3.8147e-06 9.82886 0.0146446C6.91382 0.0146446 5.7273 0.0732384 5.14136 0.234371Z" fill="#B0B0B0" />
                                    <path d="M15.5713 7.5293C15.3222 7.74902 14.7949 8.64258 14.2382 9.84375L13.3154 11.8213L11.0888 12.1436C8.67184 12.5098 8.20309 12.6709 7.93941 13.2568C7.51461 14.1797 7.69039 14.502 9.68258 16.4062L11.2939 17.9443L10.913 19.9805C10.708 21.1084 10.5468 22.2363 10.5468 22.4707C10.5615 23.2178 11.2793 23.877 12.0703 23.877C12.2754 23.877 13.3447 23.4082 14.458 22.8223L16.4648 21.7676L18.5302 22.8223C19.6582 23.4082 20.7275 23.877 20.9179 23.877C21.4746 23.877 22.0605 23.4814 22.2802 22.9834C22.4414 22.5586 22.4267 22.2363 22.0752 20.2295L21.6797 17.9443L23.2763 16.4062C25.2685 14.502 25.4443 14.1797 25.0195 13.2568C24.7558 12.6709 24.2578 12.4951 21.8554 12.1436L19.6435 11.8066L18.6914 9.7998C18.1054 8.58398 17.5781 7.67578 17.3437 7.48535C16.8164 7.0752 16.0986 7.08984 15.5713 7.5293ZM17.3437 11.9824C17.8418 12.9785 18.2666 13.623 18.4716 13.7402C18.7646 13.8867 21.4306 14.3555 22.0019 14.3555C22.0898 14.3555 21.5625 14.9707 20.83 15.7324C19.3066 17.2852 19.3213 17.1973 19.7021 19.3359C20.039 21.2402 20.1269 21.1816 18.4277 20.2734C17.5927 19.8486 16.7285 19.4824 16.4941 19.4824C16.2451 19.4824 15.3955 19.834 14.5459 20.2881C12.832 21.1963 12.9199 21.2549 13.2568 19.3359C13.6377 17.1973 13.6523 17.2852 12.1289 15.7324C11.3964 14.9707 10.8691 14.3555 10.957 14.3555C11.5283 14.3555 14.1943 13.8867 14.4873 13.7402C14.6923 13.623 15.1171 12.9785 15.6152 11.9824C16.0546 11.1035 16.4355 10.4004 16.4795 10.4004C16.5234 10.4004 16.9043 11.1035 17.3437 11.9824Z" fill="#B0B0B0" />
                                    <path d="M36.7086 7.41178C36.3863 7.58756 36.064 8.12956 35.273 9.75553C34.7164 10.9128 34.2037 11.8649 34.1304 11.8649C33.442 11.8649 29.7359 12.5241 29.4722 12.6999C29.0328 12.9635 28.6959 13.7546 28.8131 14.2233C28.857 14.4137 29.648 15.3366 30.5709 16.2741L32.2554 17.988L31.8746 20.2585C31.4644 22.7487 31.4791 23.027 32.1675 23.569C32.7974 24.0671 33.2808 23.9645 35.4634 22.8073L37.4849 21.7526L39.5211 22.8073C41.6451 23.9206 42.1578 24.0524 42.7584 23.6423C43.4615 23.1442 43.5054 22.7048 43.0953 20.2438L42.7291 18.0026L44.4283 16.2741C46.0689 14.6188 46.1422 14.5163 46.1422 13.9303C46.1422 12.9342 45.6295 12.5387 44.0914 12.319C43.4029 12.2165 42.3629 12.07 41.7769 11.9821L40.7076 11.821L39.6236 9.68229C38.8179 8.05632 38.4664 7.48503 38.1588 7.35319C37.6607 7.11881 37.2213 7.13346 36.7086 7.41178ZM38.3345 11.9382C38.7593 12.7731 39.2574 13.5641 39.4478 13.6813C39.6236 13.8132 40.5025 14.0182 41.3814 14.1501C42.275 14.2819 43.022 14.4137 43.066 14.4577C43.1099 14.5016 42.5679 15.0729 41.8648 15.7321C41.1617 16.3913 40.5611 17.0944 40.5025 17.2995C40.4586 17.4899 40.5465 18.4128 40.7076 19.3356C40.8834 20.2438 41.0152 21.0202 41.0152 21.0495C41.0152 21.0788 40.3121 20.7419 39.4478 20.2878C38.5836 19.8483 37.69 19.4821 37.4703 19.4821C37.2506 19.4821 36.3863 19.8483 35.5367 20.3024C34.6724 20.7565 33.9839 21.0641 33.9839 20.9909C33.9839 20.9176 34.1158 20.1413 34.2769 19.2624C34.4381 18.3835 34.5259 17.5339 34.482 17.3581C34.4381 17.1969 33.8082 16.4645 33.0757 15.7321L31.772 14.3991L33.4859 14.1647C34.4381 14.0329 35.3609 13.8132 35.5513 13.696C35.7418 13.5641 36.2398 12.7731 36.6646 11.9382C37.0748 11.0885 37.4556 10.4001 37.4996 10.4001C37.5435 10.4001 37.9244 11.0885 38.3345 11.9382Z" fill="#B0B0B0" />
                                    <path d="M57.6706 7.47089C57.4216 7.66132 56.8503 8.59882 56.2497 9.81464L55.239 11.8215L53.657 12.0559C52.7927 12.2023 51.7673 12.3488 51.3718 12.3928C50.2585 12.5539 49.6433 13.3449 49.863 14.3117C49.9216 14.5754 50.5808 15.3225 51.6208 16.3332L53.2907 17.9445L52.9392 19.9221C52.4704 22.5734 52.4851 22.9103 53.0124 23.4523C53.6716 24.1115 54.1111 24.0236 56.4695 22.8225L58.5349 21.7678L60.5417 22.8225C62.6218 23.9211 63.0173 24.0236 63.7058 23.6574C64.4968 23.2619 64.5554 22.8078 64.1013 20.2297L63.7058 17.9445L65.3025 16.4064C66.8991 14.8684 67.2361 14.4435 67.2361 13.9894C67.2361 13.5353 66.782 12.7883 66.4304 12.6271C66.2253 12.5246 65.0827 12.3195 63.8816 12.1437L61.7136 11.8215L60.7029 9.78535C60.1462 8.65742 59.5749 7.64667 59.4431 7.51484C59.0183 7.13398 58.1394 7.10468 57.6706 7.47089ZM59.3552 11.9533C59.7654 12.8029 60.2341 13.5793 60.4099 13.6965C60.571 13.799 61.4939 14.0041 62.446 14.1506L64.1599 14.3996L62.8415 15.7473C61.3327 17.2853 61.3474 17.2414 61.7429 19.4826C61.8601 20.1711 61.9626 20.8156 61.9626 20.9182C61.9626 21.0207 61.3474 20.7717 60.4538 20.2883C59.5896 19.8342 58.7546 19.4826 58.5056 19.4826C58.2712 19.4826 57.3923 19.8488 56.5573 20.2883C55.7224 20.7277 55.0193 21.0939 55.0046 21.0939C54.99 21.0939 55.0925 20.3908 55.2536 19.5119C55.6491 17.2707 55.6198 17.1682 54.0964 15.6447C53.3933 14.9416 52.8952 14.3557 52.9978 14.3557C53.5105 14.3557 56.1325 13.9016 56.4548 13.7551C56.7185 13.6232 57.07 13.1105 57.6413 11.9826C58.0954 11.1184 58.4909 10.4006 58.5349 10.4006C58.5788 10.4006 58.945 11.1037 59.3552 11.9533Z" fill="#B0B0B0" />
                                    <path d="M14.1354 42.1872C5.18523 43.5935 -1.06965 51.8845 0.16082 60.7322C1.01043 66.8845 5.37566 72.1579 11.235 74.1208C13.7546 74.9558 16.318 75.1755 18.9401 74.78C22.5436 74.238 25.3854 72.7878 28.0661 70.1072C29.6188 68.5544 30.322 67.573 31.2448 65.7712C33.9548 60.3952 33.3542 53.657 29.7214 48.7497C28.6813 47.3581 26.572 45.4099 25.1657 44.5456C22.5876 42.949 20.0387 42.2019 16.9919 42.114C15.9079 42.0847 14.6188 42.114 14.1354 42.1872ZM20.0827 44.7214C21.4889 45.0876 23.4225 45.9665 24.5944 46.7722C24.946 47.0066 25.6784 47.6365 26.235 48.1492C30.9079 52.573 32.0798 59.4577 29.0915 65.1267C28.7399 65.7712 28.2126 66.6501 27.8903 67.0603C27.3483 67.7927 27.319 67.822 27.1872 67.4997C26.0446 64.5408 24.404 62.5193 22.1042 61.157C21.6208 60.8786 21.1813 60.6443 21.1227 60.6443C21.0641 60.6443 20.9323 60.5857 20.8151 60.5124C20.654 60.4099 20.7565 60.2341 21.2839 59.6775C24.7555 56.0593 22.9831 49.9802 18.0905 48.7058C13.9596 47.6365 9.81414 50.8591 9.81414 55.1511C9.81414 56.7917 10.4587 58.4324 11.6012 59.6921L12.2458 60.3952L11.3376 60.864C8.86199 62.1531 7.01629 64.2185 6.00555 66.8113L5.61004 67.822L4.98016 66.987C4.13055 65.8445 3.01726 63.4861 2.62176 61.9626C2.34344 60.9372 2.28484 60.322 2.28484 58.5202C2.27019 56.5574 2.31414 56.1618 2.68035 54.8728C3.42742 52.1628 4.70184 50.0534 6.78191 48.1052C8.94988 46.0691 11.2936 44.9411 14.6481 44.3259C14.8532 44.2966 15.8346 44.282 16.8454 44.3113C18.2077 44.3406 19.028 44.4431 20.0827 44.7214ZM17.8708 50.9324C18.8962 51.2546 20.068 52.3386 20.5221 53.3493C20.9909 54.4187 20.9909 55.8835 20.5368 56.9089C20.112 57.8318 19.321 58.6521 18.3835 59.1501C17.3434 59.6921 15.6296 59.7068 14.5749 59.1794C13.0368 58.4324 12.0114 56.821 12.0114 55.1658C12.0114 52.1189 14.9557 49.9949 17.8708 50.9324ZM18.3835 62.0359C20.0827 62.3874 21.4304 63.1492 22.778 64.5115C24.0817 65.8298 24.7262 66.9284 25.1511 68.5984L25.4147 69.5945L24.902 70.0339C24.0817 70.7224 21.2839 72.0261 19.8483 72.3923C17.988 72.8611 14.9997 72.8611 13.11 72.3923C11.7038 72.0408 9.2575 70.9275 8.23211 70.1658C7.51434 69.6238 7.47039 69.3308 7.89519 68.1003C9.44793 63.574 13.7839 61.0691 18.3835 62.0359Z" fill="#B0B0B0" />
                                    <path d="M40.3267 43.6519C38.5542 43.9156 37.353 45.4097 37.353 47.3726C37.353 49.0572 38.3638 50.5806 39.6968 50.9468C40.2095 51.0933 44.0767 51.1226 56.4106 51.0933L72.4653 51.0494L73.1685 50.6099C73.6519 50.3023 74.0034 49.9214 74.3257 49.3648C74.7358 48.647 74.7798 48.4273 74.7798 47.3873C74.7798 46.3472 74.7358 46.1275 74.3257 45.4097C73.769 44.4136 72.9194 43.8423 71.7036 43.6519C70.6636 43.4761 41.4839 43.4908 40.3267 43.6519ZM72.231 46.2593C72.8022 46.9039 72.8315 47.8267 72.2749 48.4712L71.894 48.9253H56.103H40.3267L39.9458 48.5445C38.9937 47.5923 39.4624 46.0982 40.7954 45.8052C40.9565 45.7613 48.0024 45.7466 56.4399 45.7613L71.8062 45.7759L72.231 46.2593Z" fill="#B0B0B0" />
                                    <path d="M40.4146 54.7847C39.5063 54.9459 38.9644 55.2388 38.3491 55.9273C37.7046 56.6451 37.4409 57.3922 37.4409 58.5201C37.4409 59.6627 37.7046 60.3951 38.3638 61.1275C39.4478 62.3433 38.0415 62.2554 56.147 62.2554C73.5933 62.2554 72.6411 62.2994 73.6665 61.4351C75.2632 60.0875 75.2485 56.982 73.6372 55.5611C72.9048 54.9166 72.2017 54.7261 70.5171 54.7261C68.7593 54.7115 68.4077 54.8873 68.4077 55.8101C68.4077 56.6304 68.73 56.8355 70.0337 56.8355C71.5278 56.8355 72.1724 57.0406 72.5093 57.6119C72.6704 57.8756 72.8023 58.2711 72.8023 58.4908C72.8023 59.0035 72.4507 59.7066 72.0845 59.9117C71.8941 60.0142 66.5913 60.0582 56.103 60.0582H40.3999L39.9751 59.6334C39.1255 58.7838 39.521 57.3189 40.6929 56.982C41.0444 56.8941 45.3364 56.8355 52.8364 56.8355H64.438L64.6577 56.5133C64.9653 56.0738 64.9507 55.4732 64.6138 55.0631L64.3355 54.7115L52.7046 54.6968C46.3179 54.6822 40.7808 54.7261 40.4146 54.7847Z" fill="#B0B0B0" />
                                    <path d="M40.3999 65.918C38.6567 66.2109 37.4995 67.7197 37.4995 69.6533C37.4995 71.2061 38.2319 72.4658 39.4624 73.0371C40.1655 73.3594 40.3853 73.3887 42.8022 73.3887C45.3071 73.3887 45.395 73.374 45.6147 73.0664C45.9224 72.627 45.9077 72.0264 45.5708 71.6162C45.2925 71.2793 45.2046 71.2646 42.8901 71.2207C40.5464 71.1768 40.5024 71.1621 40.1069 70.7959C39.2427 69.9609 39.5356 68.5254 40.6489 68.1445C41.0884 67.998 44.4429 67.9688 56.5718 67.998L71.9526 68.042L72.3774 68.5254C72.9341 69.1553 72.978 70.0928 72.4507 70.708L72.0991 71.1182L60.9663 71.1914C50.2876 71.2646 49.8188 71.2793 49.5259 71.543C49.1304 71.9092 49.1011 72.8027 49.4819 73.1543C49.731 73.374 50.6831 73.3887 61.186 73.3594L72.6118 73.3154L73.3149 72.876C75.644 71.4258 75.4976 67.5293 73.0659 66.2549L72.2895 65.8447L56.689 65.8301C48.105 65.8154 40.7808 65.8594 40.3999 65.918Z" fill="#B0B0B0" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_5607_4178">
                                        <rect width="75" height="75" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <h1 class="text-center dm-sans font-medium lg:text-32 text-lg text-gray-14 mt-22p">
                            {{ __('We’re sorry!') }}<br>
                            <span>{{ __("You haven't reviewed any product yet.") }}</span>
                        </h1>
                    </div>
            @endif
        </div>
        <div>
            <div class="block mt-15p lg:hidden">
                @if (count($reviews) > 0)
                    @foreach ($reviews as $review)
                        <div class="flex cursor-pointer justify-between p-15p border-t border border-gray-2">
                            <div class=" flex">
                                <img width="100" class="p-3 ml-2 bg-gray-11 rounded" src="{{ $review->item->fileUrl() }}" alt="">
                                <div class="my-auto">
                                    <div class="flex items-center pl-2.5">
                                        <div class='rating-stars'>
                                            <ul id='stars'>
                                                @php
                                                    $ratingCount = 0;
                                                @endphp
                                                 @for ($i = 1; $i <= 5; $i++)
                                                    <li class='text-sm star'>
                                                        @if ($i <= $review->rating)
                                                            @php
                                                                $ratingCount++;
                                                            @endphp
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                                viewBox="0 0 17 16" fill="none">
                                                                <path
                                                                    d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z"
                                                                    fill="#FCCA19" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                                viewBox="0 0 17 16" fill="none">
                                                                <path d="M8.5 0L10.4084 5.87336L16.584 5.87336L11.5878 9.50329L13.4962 15.3766L8.5 11.7467L3.50383 15.3766L5.41219 9.50329L0.416019 5.87336L6.59163 5.87336L8.5 0Z" fill="#C4C4C4" />
                                                            </svg>
                                                        @endif
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <div x-data="{ showModal1: false }" :class="{ 'overflow-y-hidden': showModal1 }">
                                            <button class="dark:text-gray-2 ml-2" @click="showModal1 = true">
                                                <svg class="-mt-3" xmlns="http://www.w3.org/2000/svg" width="10.42" height="11" viewBox="0 0 11 11" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.05258 8.10547C3.73283 8.10547 3.47363 7.84627 3.47363 7.52653L3.47363 5.7897C3.47363 5.46995 3.73283 5.21075 4.05258 5.21075C4.37232 5.21075 4.63152 5.46995 4.63152 5.7897L4.63152 7.52653C4.63152 7.84627 4.37232 8.10547 4.05258 8.10547Z" fill="#898989" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.36849 8.10547C6.04875 8.10547 5.78955 7.84627 5.78955 7.52653L5.78955 5.7897C5.78955 5.46995 6.04875 5.21075 6.36849 5.21075C6.68824 5.21075 6.94744 5.46995 6.94744 5.7897L6.94744 7.52653C6.94744 7.84627 6.68824 8.10547 6.36849 8.10547Z" fill="#898989" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.594135 3.48299C0.456937 3.47363 0.277675 3.47332 0 3.47332V2.31543C0.00619255 2.31543 0.0123647 2.31543 0.0185164 2.31543C0.0309477 2.31543 0.0432955 2.31543 0.0555595 2.31543H10.3654C10.3777 2.31543 10.39 2.31543 10.4025 2.31543L10.421 2.31543V3.47332C10.1433 3.47332 9.96404 3.47363 9.82685 3.48299C9.69485 3.492 9.64458 3.50741 9.62049 3.51739C9.47863 3.57615 9.36592 3.68885 9.30716 3.83071C9.29718 3.8548 9.28178 3.90507 9.27277 4.03707C9.26341 4.17427 9.26309 4.35353 9.26309 4.6312L9.2631 8.14296C9.26313 8.65619 9.26315 9.0984 9.21554 9.45252C9.16452 9.83203 9.04945 10.1958 8.75439 10.4909C8.45932 10.7859 8.09554 10.901 7.71604 10.952C7.36192 10.9996 6.91972 10.9996 6.40649 10.9996H4.01449C3.50127 10.9996 3.05906 10.9996 2.70494 10.952C2.32544 10.901 1.96166 10.7859 1.66659 10.4909C1.37153 10.1958 1.25646 9.83203 1.20544 9.45252C1.15783 9.09841 1.15786 8.6562 1.15789 8.14298L1.15789 4.6312C1.15789 4.35353 1.15757 4.17427 1.14821 4.03707C1.13921 3.90507 1.1238 3.8548 1.11382 3.83071C1.05506 3.68885 0.942353 3.57615 0.800495 3.51739C0.776403 3.50741 0.726133 3.492 0.594135 3.48299ZM8.20525 3.47332H2.21573C2.27003 3.63404 2.29235 3.79616 2.30341 3.95825C2.31579 4.13961 2.31578 4.35873 2.31577 4.61268L2.31577 8.10486C2.31577 8.66706 2.317 9.03047 2.353 9.29824C2.38676 9.54935 2.44127 9.62805 2.48534 9.67213C2.52941 9.7162 2.60812 9.7707 2.85923 9.80447C3.127 9.84047 3.4904 9.84169 4.0526 9.84169H6.36838C6.93058 9.84169 7.29399 9.84047 7.56175 9.80447C7.81286 9.7707 7.89157 9.7162 7.93564 9.67213C7.97971 9.62805 8.03422 9.54935 8.06798 9.29824C8.10398 9.03047 8.10521 8.66706 8.10521 8.10486V4.61268C8.1052 4.35873 8.10519 4.13961 8.11757 3.95825C8.12863 3.79616 8.15095 3.63404 8.20525 3.47332Z" fill="#898989" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.02526 0.0701854C5.77981 0.0231002 5.49456 0 5.21131 0C4.92807 3.45077e-08 4.64282 0.0231002 4.39736 0.0701855C4.27466 0.0937243 4.15453 0.124639 4.04569 0.165361C3.94683 0.202348 3.812 0.263755 3.69793 0.370187C3.46414 0.588313 3.45145 0.95466 3.66957 1.18845C3.8754 1.40905 4.21322 1.43279 4.44709 1.25149C4.44842 1.25097 4.44987 1.25041 4.45144 1.24983C4.48234 1.23827 4.53599 1.22259 4.61551 1.20734C4.77449 1.17684 4.98477 1.15789 5.21131 1.15789C5.43785 1.15789 5.64813 1.17684 5.80712 1.20734C5.88663 1.22259 5.94029 1.23827 5.97118 1.24983C5.97275 1.25041 5.97421 1.25097 5.97554 1.25149C6.20941 1.43279 6.54722 1.40905 6.75305 1.18845C6.97118 0.954659 6.95848 0.588312 6.7247 0.370187C6.61062 0.263755 6.47579 0.202348 6.37694 0.16536C6.2681 0.124639 6.14797 0.0937242 6.02526 0.0701854Z" fill="#898989" />
                                                </svg>
                                            </button>
                                            <!-- Modal1 -->
                                            <div class="fixed inset-0 w-full h-full bg-black bg-opacity-50 pt-60 duration-300 overflow-y-auto" x-show="showModal1" x-transition:enter="transition duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition duration-300"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <div class="relative mx-5 my-10 opacity-100">
                                                    <div class="relative px-4 bg-white shadow-lg rounded-md text-gray-900 z-50"
                                                        @click.away="showModal1 = false" x-show="showModal1"
                                                        x-transition:enter="transition transform duration-300"
                                                        x-transition:enter-start="scale-0"
                                                        x-transition:enter-end="scale-100"
                                                        x-transition:leave="transition transform duration-300"
                                                        x-transition:leave-start="scale-100"
                                                        x-transition:leave-end="scale-0">
                                                        <div class=" grid grid-cols-2 gap-32 items-center">
                                                            <div class="flex col-span-3">
                                                                <div class="flex flex-col justify-center bg-red-100 mt-30p items-center h-10 w-10 rounded-full dark:text-gray-2">
                                                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="26"
                                                                        height="26" viewBox="0 0 26 26" fill="none">
                                                                        <circle cx="13" cy="13" r="13" fill="#F9E8E8" />
                                                                        <path d="M14.4564 6.5L14.2486 15.3938H12.4646L12.2481 6.5H14.4564ZM12.1875 18.1217C12.1875 17.8042 12.2914 17.5386 12.4993 17.325C12.7129 17.1056 13.0073 16.9959 13.3826 16.9959C13.7521 16.9959 14.0436 17.1056 14.2572 17.325C14.4709 17.5386 14.5777 17.8042 14.5777 18.1217C14.5777 18.4277 14.4709 18.6904 14.2572 18.9098C14.0436 19.1234 13.7521 19.2302 13.3826 19.2302C13.0073 19.2302 12.7129 19.1234 12.4993 18.9098C12.2914 18.6904 12.1875 18.4277 12.1875 18.1217Z" fill="#C8191C" />
                                                                    </svg>
                                                                </div>
                                                                <span class="inline-block leading-4 whitespace-nowrap ml-2 mt-10 dm-sans font-medium text-sm text-gray-12">{{ __('Are you sure you want to delete this?') }}</span>
                                                            </div>
                                                        </div>
                                                        <p class=" text-gray-10 -mt-1 roboto-medium font-medium text-11 ml-12 pr-10"> {{ __('Please keep in mind that once deleted, you can not undo it.') }} </p>
                                                        <div class=" flex justify-center mt-6 pb-5">
                                                            <button class="dm-sans items-center transition duration-200 rounded pb-4 pt-3 cursor-pointer font-medium text-xs text-gray-12 w-36 h-10 bg-white border border-gray-2 mb-7p hover:border-gray-12" @click="showModal1 = false"> {{ __('Cancel') }}
                                                            </button>
                                                            <form action="{{ route('site.review.destroy', ['id' => $review->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer py-3.5 px-6 font-medium text-xs text-white w-36 h-10 bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Yes, Delete') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="ml-2.5 roboto-medium font-medium text-11 text-gray-12 pr-2.5">
                                        {{ trimWords($review->item->name) }}
                                    </p>
                                </div>
                            </div>
                            <div class="my-auto text-center">
                                <p class="roboto-medium mb-1 font-medium text-xss text-gray-10 text-right">
                                    @if ($review->is_public)
                                        <span class="bg-green-2 px-1.5 py-1 text-green-1">{{ __('Approved') }}</span>
                                    @else
                                        <span class="">{{ __('Unapprove') }}</span>
                                    @endif
                                </p>
                                <p class="roboto-medium font-medium whitespace-nowrap text-gray-10 text-xss text-right dark:text-gray-2"> {{ formatDate($review->created_at) }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{ $reviews->links('site.layouts.partials.pagination') }}
        </div>
    </div>
@endsection
