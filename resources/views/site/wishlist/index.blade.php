@extends('../site/layouts.user_panel.app')
@section('page_title', __('Wishlist'))
@section('content')
    <!-- My profile -->
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
                <h1 class="dark:text-gray-2 dm-sans font-medium lg:pt-0 text-2xl lg:text-4xl text-gray-12 mb-1 dark:text-gray-2">
                    {{ __('Your Wishlist') }}
                </h1>
            </div>
            <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-4 text-20 text-gray-10 leading-6">
                {{ __('Saved for later, products you may love to buy now..') }}</p>
        </div>
        @if (count($wishlists) > 0)
            <div>
                <div class="lg:flex lg:justify-between lg:mt-7 mt-5">
                    <div class="mt-14 lg:block hidden dm-bold font-bold text-gray-12 text-2xl uppercase">
                        <p>{{ __('wishLIST list') }}</p>
                    </div>
                    <div class="text-lg mt-30p lg:hidden block dm-bold font-bold text-gray-12 lg:text-2xl uppercase">
                        <p>{{ __('wishLIST ') }}</p>
                    </div>
                    <div class="flex justify-between lg:mt-10 mt-15p">
                        <h1 class="dm-sans font-medium mt-2 lg:text-lg text-sm whitespace-nowrap text-gray-12 mr-15p"> {{ __('Filter By') }}
                        </h1>
                        <div class="flex">
                            <div x-data="{ dropdownOpen: false }">
                                <div>
                                    <button @click="dropdownOpen = !dropdownOpen" class="inline-flex justify-between lg:w-168p w-24 border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-10 hover:bg-gray-11">
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
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z" fill="#898989" />
                                            </svg>
                                        </span>
                                        <span class="mt-2 lg:hidden block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z" fill="#898989" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full z-10">
                                </div>
                                <div x-show="dropdownOpen"
                                    class="absolute lg:w-168p w-24 border-t-0 border-gray-2 border bg-white z-20">
                                    @foreach ($filterDay as $key => $value)
                                        <a href="{{ request()->fullUrlWithQuery(['filter_day' => $key]) }}" class="block whitespace-nowrap pt-3.5 lg:w-168p w-24 lg:text-sm text-xss roboto-medium text-gray-10 font-medium border-t-0 capitalize lg:h-47p hover:bg-gray-11 hover:text-gray-12">
                                            @if (request('filter_day') == $key)
                                                <span class="text-green-1 ml-1">✓</span>
                                                <span
                                                    class="inline-block ml-1.5 lg:ml-3 text-green-1">{{ $value }}</span>
                                            @elseif(request('filter_day') == null && $key === 'all_time')
                                                <span class="text-green-1 ml-1.5 lg:ml-1">✓</span>
                                                <span class="inline-block lg:ml-1 pb-2 text-green-1">{{ __('All Time') }}</span>
                                            @else
                                                <span class="inline-block ml-1.5 lg:ml-2">{{ $value }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div x-data="{ dropdownOpen: false }">
                                <div class="flex items-center ml-3">
                                    <button @click="dropdownOpen = !dropdownOpen" class="inline-flex justify-between lg:w-168p w-24 rounded-sm border border-gray-2 px-2 lg:py-2.5 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none dark:bg-gray-2">
                                        <div class="roboto-medium font-medium text-gray-10 lg:text-base text-xss whitespace-nowrap dark:text-gray-2">
                                            <span>In Stock</span>
                                        </div>
                                        <span class="mt-2 hidden lg:block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.89383e-08 1.21895L1.37054 1.63436e-08L6.5 4.5621L11.6295 1.3868e-07L13 1.21895L6.5 7L6.89383e-08 1.21895Z" fill="#898989" />
                                            </svg>
                                        </span>
                                        <span class="mt-2 lg:hidden block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4" viewBox="0 0 8 4" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93933e-08 0.696543L0.843412 1.00576e-08L4 2.60691L7.15659 8.53415e-08L8 0.696543L4 4L3.93933e-08 0.696543Z" fill="#898989" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full z-10">
                                </div>
                                <div x-show="dropdownOpen"
                                    class="absolute lg:w-168p w-24 border-t-0 border-gray-2 border bg-white z-20 ml-3">
                                    <a href="#" class=" block whitespace-nowrap py-2.5 lg:w-168p w-24 lg:text-sm text-xss roboto-medium text-gray-10 font-medium border-t-0 capitalize lg:h-47p hover:bg-gray-11 hover:text-gray-12">
                                        <span class="ml-2">{{ __('Stock Out') }}</span>
                                    </a>
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
                        @if (!empty($wishlists[0]))
                            <tr class="text-left bg-gray-11 border border-gray-2 dark:bg-gray-2">
                                <th class="pl-10 py-4 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Image') }}
                                </th>
                                <th class="w-96 py-3 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Item Name') }}
                                </th>
                                <th class="py-3 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Price') }}
                                </th>
                                <th class="py-3 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Availability') }}
                                </th>
                                <th class="py-3 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Date') }}
                                </th>
                                <th class="py-3 dm-sans font-medium text-gray-12 text-xl dark:text-gray-2">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if (!empty($wishlists[0]))
                            @foreach ($wishlists as $wishlist)
                                <tr class="focus-within:bg-gray-200 overflow-hidden border border-gray-2">
                                    <td class="pl-10 py-5 dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="bg-gray-11 h-58p w-58p justify-center flex items-center">
                                            <img src="{{ $wishlist->item->fileUrl() }}" alt="item"
                                                class="flex h-7 w-7 m-3 justify-center text-center" />
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10 dark:text-gray-2 py-4 flex items-center">
                                            <a href="{{ route('site.itemDetails', ['code' => optional($wishlist->item)->item_code, 'name' => cleanedUrl(optional($wishlist->item)->name)]) }}">{{ trimWords($wishlist->item->name) }}</a>
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10 dark:text-gray-2 pr-7 py-4 flex items-center"> {{ formatCurrencyAmount(optional($wishlist->item)->price) }}
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10">
                                            {{ __('In Stock') . '(3)' }}
                                        </span>
                                    </td>
                                    <td class="dark:border-t-gray-2 dark:bg-gray-3">
                                        <span class="roboto-medium font-medium text-gray-10 dark:text-gray-2 py-4 flex items-center"> {{ formatDate($wishlist->created_at) }}
                                        </span>
                                    </td>
                                    <td class="text-center dark:border-t-gray-2 dark:bg-gray-3">
                                        <div x-data="{ showModal1: false }" :class="{ 'overflow-y-hidden': showModal1 }">
                                            <main class="w-full flex flex-col sm:flex-row items-center">
                                                <button class="dark:text-gray-2 py-4" @click="showModal1 = true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.02924 12.0576C5.55357 12.0576 5.16797 11.672 5.16797 11.1963L5.16797 8.61252C5.16797 8.13685 5.55357 7.75124 6.02924 7.75124C6.50491 7.75124 6.89052 8.13685 6.89052 8.61252L6.89052 11.1963C6.89052 11.672 6.50491 12.0576 6.02924 12.0576Z"fill="#898989" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.47456 12.0576C8.99889 12.0576 8.61328 11.672 8.61328 11.1963L8.61328 8.61252C8.61328 8.13685 8.99889 7.75124 9.47456 7.75124C9.95022 7.75124 10.3358 8.13685 10.3358 8.61252L10.3358 11.1963C10.3358 11.672 9.95023 12.0576 9.47456 12.0576Z" fill="#898989" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.883875 5.18226C0.67977 5.16833 0.413088 5.16786 0 5.16786V3.44531C0.00921245 3.44531 0.0183945 3.44531 0.0275462 3.44531C0.0460398 3.44531 0.0644092 3.44531 0.082654 3.44531H15.4203C15.4385 3.44531 15.4569 3.44531 15.4754 3.44531L15.5029 3.44531V5.16786C15.0899 5.16786 14.8232 5.16833 14.6191 5.18226C14.4227 5.19565 14.3479 5.21858 14.3121 5.23342C14.101 5.32084 13.9334 5.48851 13.846 5.69954C13.8311 5.73538 13.8082 5.81017 13.7948 6.00654C13.7809 6.21064 13.7804 6.47732 13.7804 6.89041L13.7804 12.1147C13.7804 12.8783 13.7805 13.5361 13.7097 14.0629C13.6337 14.6275 13.4626 15.1687 13.0236 15.6077C12.5847 16.0466 12.0435 16.2178 11.4789 16.2937C10.9521 16.3645 10.2942 16.3645 9.53072 16.3644H5.97222C5.20871 16.3645 4.55086 16.3645 4.02406 16.2937C3.45948 16.2178 2.91829 16.0466 2.47933 15.6077C2.04037 15.1687 1.8692 14.6275 1.7933 14.0629C1.72247 13.5361 1.7225 12.8783 1.72255 12.1148L1.72255 6.89041C1.72255 6.47732 1.72208 6.21064 1.70816 6.00654C1.69476 5.81017 1.67183 5.73538 1.65699 5.69954C1.56957 5.48851 1.40191 5.32084 1.19087 5.23342C1.15503 5.21858 1.08024 5.19565 0.883875 5.18226ZM12.2067 5.16786H3.29627C3.37705 5.40696 3.41026 5.64815 3.42671 5.88928C3.44512 6.15908 3.44511 6.48506 3.4451 6.86286L3.4451 12.0581C3.4451 12.8944 3.44693 13.4351 3.50048 13.8334C3.55071 14.207 3.6318 14.3241 3.69736 14.3896C3.76292 14.4552 3.88001 14.5363 4.25358 14.5865C4.65193 14.6401 5.19256 14.6419 6.02892 14.6419H9.47402C10.3104 14.6419 10.851 14.6401 11.2494 14.5865C11.6229 14.5363 11.74 14.4552 11.8056 14.3896C11.8711 14.3241 11.9522 14.207 12.0025 13.8334C12.056 13.4351 12.0578 12.8944 12.0578 12.0581V6.86286C12.0578 6.48506 12.0578 6.15908 12.0762 5.88928C12.0927 5.64815 12.1259 5.40696 12.2067 5.16786Z" fill="#898989" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96309 0.104413C8.59794 0.0343653 8.17358 0 7.75221 0C7.33084 5.1336e-08 6.90648 0.0343654 6.54133 0.104413C6.35878 0.139431 6.18006 0.185421 6.01815 0.246001C5.87108 0.301027 5.6705 0.39238 5.5008 0.550715C5.153 0.875213 5.13412 1.42022 5.45862 1.76801C5.76482 2.0962 6.26738 2.13152 6.61529 1.8618C6.61728 1.86102 6.61944 1.8602 6.62178 1.85932C6.66773 1.84213 6.74756 1.81881 6.86585 1.79612C7.10237 1.75074 7.4152 1.72255 7.75221 1.72255C8.08922 1.72255 8.40205 1.75074 8.63857 1.79612C8.75686 1.81881 8.83669 1.84213 8.88264 1.85932C8.88498 1.8602 8.88714 1.86102 8.88913 1.8618C9.23704 2.13152 9.7396 2.0962 10.0458 1.76801C10.3703 1.42021 10.3514 0.875212 10.0036 0.550714C9.83392 0.392379 9.63334 0.301026 9.48627 0.246001C9.32436 0.185421 9.14564 0.13943 8.96309 0.104413Z" fill="#898989" />
                                                    </svg>
                                                </button>
                                                <h1 @click="showModal1 = true" class="roboto-medium font-medium text-gray-10 cursor-pointer ml-2.5">{{ __('Remove') }}</h1>
                                            </main>
                                            <!-- Modal1 -->
                                            <div class="fixed inset-0 w-full h-full bg-black bg-opacity-50 pt-60 duration-300 overflow-y-auto"x-show="showModal1" x-transition:enter="transition duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                                                    <div class="relative modal-h-w bg-white shadow-lg rounded-md text-gray-900 z-50"
                                                        @click.away="showModal1 = false" x-show="showModal1" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
                                                        x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100"
                                                        x-transition:leave-end="scale-0">
                                                        <div class=" grid grid-cols-4 gap-32 items-center">
                                                            <div class="flex col-span-3">
                                                                <div class="flex flex-col justify-center bg-red-100 mt-30p ml-30p items-center h-10 w-10 rounded-full dark:text-gray-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                                        <circle cx="16" cy="16" r="16" fill="#F9E8E8" />
                                                                        <path d="M17.7925 8L17.5367 18.9463H15.3411L15.0746 8H17.7925ZM15 22.3037C15 21.9129 15.1279 21.586 15.3837 21.3231C15.6466 21.0531 16.009 20.9181 16.4709 20.9181C16.9256 20.9181 17.2845 21.0531 17.5474 21.3231C17.8103 21.586 17.9417 21.9129 17.9417 22.3037C17.9417 22.6803 17.8103 23.0036 17.5474 23.2736C17.2845 23.5365 16.9256 23.668 16.4709 23.668C16.009 23.668 15.6466 23.5365 15.3837 23.2736C15.1279 23.0036 15 22.6803 15 22.3037Z" fill="#C8191C" />
                                                                    </svg>
                                                                </div>
                                                                <span class="inline-block leading-4 ml-2 mt-10 dm-sans font-medium text-lg text-gray-12">{{ __('Are you sure you want to delete this?') }}</span>
                                                            </div>
                                                            <svg class="mr-30p mt-7 cursor-pointer hover:text-gray-12 text-gray-10" @click="showModal1 = false" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="currentColor" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9887 0.455612C11.3812 -0.151871 10.3963 -0.151871 9.78884 0.455612L0.455503 9.78895C-0.151979 10.3964 -0.151979 11.3814 0.455503 11.9888C1.06298 12.5963 2.04791 12.5963 2.65539 11.9888L11.9887 2.6555C12.5962 2.04802 12.5962 1.06309 11.9887 0.455612Z" fill="currentColor" />
                                                            </svg>
                                                        </div>
                                                        <p class=" text-gray-10 -mt-1 roboto-medium font-medium text-sm -ml-10">
                                                            {{ __('Please keep in mind that once deleted, you can not undo it.') }}
                                                        </p>
                                                        <div class=" flex justify-end mt-8 mr-30p mb-0">
                                                            <button class="dm-sans items-center transition duration-200 rounded pb-4 pt-3 cursor-pointer font-medium text-sm text-gray-12 w-141p h-46p bg-white border border-gray-2 mb-7p hover:border-gray-12" @click="showModal1 = false">{{ __('Cancel') }}
                                                            </button>
                                                            <form action="{{ route('wishlist.destroy', ['id' => $wishlist->item->id]) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer py-3.5 px-6 font-medium text-sm text-white w-141p h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Yes, Delete') }}
                                                                </button>
                                                            </form>
                                                        </div>
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
            @if (count($wishlists) == 0)
                <div class="flex flex-col justify-center items-center lg:mt-216p mt-90p">
                    <span class="hidden lg:block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="106" height="106" viewBox="0 0 106 106" fill="none">
                            <path d="M6.31466 0.35157C4.96895 0.848442 4.03731 1.51094 3.292 2.5461C2.33966 3.8711 2.07052 5.11329 2.07052 8.23946C2.07052 10.7031 2.02911 11.0758 1.65645 11.5934C1.40802 11.9246 0.97325 12.732 0.662703 13.3945L0.103719 14.5953L0.0416094 49.6871C0.000203108 80.866 0.0209062 85.0273 0.31075 87.0355C0.97325 91.5281 2.83653 96.0621 5.46583 99.4988C6.19044 100.451 6.21114 100.513 6.21114 102.397C6.21114 104.55 6.43888 105.275 7.267 105.71C7.99161 106.082 8.5713 106.082 9.29591 105.71C10.124 105.275 10.3518 104.55 10.3518 102.397C10.3518 100.513 10.3725 100.451 11.0971 99.4988C13.7057 96.0828 15.569 91.5695 16.2315 87.1184C16.5213 85.2137 16.5627 81.1559 16.5627 54.8836V24.8434H17.8049C19.2541 24.8434 20.1029 25.1953 20.4549 25.982C20.6412 26.3754 20.7033 29.191 20.7033 36.4578C20.7033 47.2441 20.7033 47.2648 21.842 47.7824C22.9393 48.2793 24.2022 47.8652 24.6162 46.8508C24.8026 46.416 24.844 43.4555 24.8026 35.816C24.7404 25.6922 24.7197 25.3402 24.3057 24.4086C23.2084 22.0484 21.3244 20.8891 18.4053 20.7441L16.6041 20.6613L16.5213 17.618C16.4592 14.8645 16.3971 14.4918 15.9002 13.3945C15.5897 12.732 15.1549 11.9453 14.9272 11.6348C14.5959 11.1379 14.5131 10.6203 14.451 7.8668C14.3682 4.30586 14.1404 3.49844 12.8568 2.00782C11.3869 0.330864 8.44708 -0.414444 6.31466 0.35157ZM9.29591 4.43008C10.0619 4.84415 10.3518 5.56876 10.3518 7.10078V8.38438H8.28145H6.21114V7.03868C6.23184 5.56876 6.52169 4.84415 7.267 4.43008C7.9088 4.07813 8.592 4.07813 9.29591 4.43008ZM10.5588 13.1254C10.9936 13.3945 11.5525 13.9949 11.8217 14.4297C12.2772 15.1336 12.3186 15.5063 12.3807 17.9492L12.4635 20.7027H8.30216H4.14083V18.3633C4.14083 17.1004 4.24434 15.6926 4.36856 15.2578C4.6377 14.3055 5.942 12.9184 6.87364 12.6492C7.97091 12.318 9.66856 12.525 10.5588 13.1254ZM12.4221 52.9996V81.1559H8.28145H4.14083V52.9996V24.8434H8.28145H12.4221V52.9996ZM12.1529 86.4766C11.8838 89.0645 10.0412 93.9711 8.69552 95.648L8.28145 96.1656L7.86739 95.648C6.52169 93.9711 4.67911 89.0645 4.40997 86.4766L4.28575 85.2965H8.28145H12.2772L12.1529 86.4766Z" fill="#B0B0B0" />
                            <path d="M36.9139 15.1956C33.1667 16.1065 29.9991 19.3776 29.2124 23.1456C29.0467 23.9116 28.9846 33.8491 28.9846 56.8295V89.437H25.6721C22.0698 89.437 21.4694 89.5819 20.9932 90.4928C20.3307 91.7971 20.8897 95.1096 22.2768 97.9252C23.0842 99.5608 23.5604 100.203 25.0303 101.673C26.521 103.163 27.1421 103.619 28.7776 104.405C32.235 106.103 30.6616 106.02 59.7288 105.958L85.4006 105.896L86.5807 105.42C89.2307 104.343 91.1768 102.583 92.419 100.078C93.6198 97.6768 93.5784 99.0639 93.5784 65.9803V35.6088H98.9612C104.903 35.6088 105.317 35.526 105.773 34.4081C105.959 33.9733 106 32.0893 105.959 27.5139L105.897 21.2202L105.234 19.8331C104.323 17.9077 103.164 16.7069 101.28 15.7753L99.7065 15.0092L68.8588 14.9678C44.6569 14.9471 37.7628 14.9885 36.9139 15.1956ZM89.9967 20.1229L89.5413 21.2202L89.4378 59.1069L89.3342 96.9936L88.7545 98.1737C87.9678 99.7678 86.4358 101.134 84.9245 101.569C81.9846 102.439 78.8585 100.969 77.5542 98.153C77.2022 97.3456 77.1194 96.7038 77.0573 94.1987C77.0366 92.5424 76.8917 90.9276 76.7674 90.617C76.2913 89.3749 77.3264 89.437 54.2424 89.437H33.1253V56.9745C33.1253 21.3444 33.0632 23.3733 34.3674 21.5721C35.0507 20.6198 36.21 19.771 37.4108 19.3362C38.0526 19.1085 42.8971 19.0671 64.3249 19.0463H90.4729L89.9967 20.1229ZM99.9963 19.7503C100.431 20.0194 100.99 20.6198 101.259 21.0546C101.735 21.8206 101.756 22.0069 101.818 26.6444L101.88 31.4682H97.7397H93.5784V27.0584C93.5784 24.6155 93.6819 22.3174 93.8061 21.8827C94.0753 20.9303 95.3795 19.5432 96.3112 19.2741C97.4085 18.9428 99.1061 19.1499 99.9963 19.7503ZM72.9167 95.6893C73.0409 97.9873 73.4963 99.6643 74.428 101.072L74.9456 101.859H54.4909C32.2143 101.859 32.9596 101.9 30.4339 100.679C28.1979 99.6022 25.7342 96.5381 25.1753 94.1366L25.051 93.5776H48.9217H72.8131L72.9167 95.6893Z"fill="#B0B0B0" />
                            <path d="M51.7788 27.6589C48.5905 28.5078 45.8991 31.3441 45.1538 34.5945C44.8226 35.9816 44.8847 38.7144 45.2573 39.9773C46.3546 43.6625 48.3007 45.9191 56.3128 52.7925C60.5777 56.457 61.0124 56.6847 62.1511 56.0843C63.062 55.6082 71.2191 48.4035 73.0823 46.4367C75.132 44.2836 76.0843 42.9171 76.9745 40.7433C77.4507 39.6046 77.5128 39.1492 77.5128 37.1617C77.5128 35.2777 77.43 34.6566 77.0159 33.6421C76.0429 31.0957 74.5523 29.398 72.3577 28.28C68.8382 26.5203 64.9667 27.2035 62.1511 30.0812L61.2609 30.9921L60.1636 29.9156C57.907 27.6589 54.8429 26.8308 51.7788 27.6589ZM55.6089 31.7789C57.1409 32.4207 58.5073 33.9941 59.1284 35.8574C59.5011 36.996 60.3292 37.6793 61.323 37.6793C62.0683 37.6793 62.9999 36.789 63.4347 35.6296C64.2214 33.5593 65.6499 32.0894 67.2855 31.6546C70.6808 30.7437 73.7862 33.8285 73.4343 37.7414C73.1859 40.5156 71.1984 43 64.946 48.3621L61.2402 51.5296L57.9277 48.6933C52.255 43.8695 50.2882 41.7371 49.4394 39.5011C49.0253 38.3832 48.9425 36.3543 49.2738 35.1535C50.0191 32.5242 53.2488 30.7851 55.6089 31.7789Z" fill="#B0B0B0" />
                            <path d="M42.4623 64.8836C40.6611 65.8773 41.4272 68.7344 43.4768 68.7344C44.5326 68.7344 45.5471 67.7199 45.5471 66.6848C45.5471 65.132 43.8287 64.1176 42.4623 64.8836Z" fill="#B0B0B0" />
                            <path d="M50.7435 64.8837C49.3564 65.6497 49.3978 67.8442 50.8263 68.486C51.5923 68.838 79.2517 68.838 80.0177 68.486C80.6181 68.2169 81.1564 67.3474 81.1564 66.6642C81.1564 65.981 80.6181 65.1114 80.0177 64.8423C79.1896 64.4696 51.4267 64.511 50.7435 64.8837Z" fill="#B0B0B0" />
                            <path d="M42.4623 77.3055C40.6611 78.2992 41.4272 81.1562 43.4768 81.1562C44.5326 81.1562 45.5471 80.1418 45.5471 79.1066C45.5471 77.5539 43.8287 76.5394 42.4623 77.3055Z" fill="#B0B0B0" />
                            <path d="M50.7435 77.3056C49.3564 78.0716 49.3978 80.2661 50.8263 80.9079C51.5923 81.2599 79.2517 81.2599 80.0177 80.9079C80.6181 80.6388 81.1564 79.7692 81.1564 79.086C81.1564 78.4028 80.6181 77.5333 80.0177 77.2642C79.1896 76.8915 51.4267 76.9329 50.7435 77.3056Z" fill="#B0B0B0" />
                        </svg>
                    </span>
                    <span class="lg:hidden block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 75 75" fill="none">
                            <path d="M4.46753 0.248543C3.51538 0.600105 2.8562 1.06886 2.32886 1.80128C1.65503 2.73878 1.4646 3.61768 1.4646 5.8296C1.4646 7.57276 1.4353 7.83643 1.17163 8.20264C0.995851 8.43702 0.688233 9.00831 0.468507 9.47706L0.072999 10.3267L0.0290536 35.1558C-0.000243232 57.2163 0.0144052 60.1606 0.219483 61.5815C0.688233 64.7603 2.00659 67.9683 3.86694 70.3999C4.37964 71.0737 4.39429 71.1177 4.39429 72.4507C4.39429 73.9741 4.55542 74.4868 5.14136 74.7944C5.65405 75.0581 6.06421 75.0581 6.57691 74.7944C7.16284 74.4868 7.32398 73.9741 7.32398 72.4507C7.32398 71.1177 7.33862 71.0737 7.85132 70.3999C9.69702 67.9829 11.0154 64.7896 11.4841 61.6401C11.6892 60.2925 11.7185 57.4214 11.7185 38.8325V17.5776H12.5974C13.6228 17.5776 14.2234 17.8267 14.4724 18.3833C14.6043 18.6616 14.6482 20.6538 14.6482 25.7954C14.6482 33.4272 14.6482 33.4419 15.4539 33.8081C16.2302 34.1597 17.1238 33.8667 17.4168 33.1489C17.5486 32.8413 17.5779 30.7466 17.5486 25.3413C17.5046 18.1782 17.49 17.9292 17.197 17.27C16.4207 15.6001 15.0876 14.7798 13.0222 14.6772L11.7478 14.6187L11.6892 12.4653C11.6453 10.5171 11.6013 10.2534 11.2498 9.47706C11.03 9.00831 10.7224 8.45167 10.5613 8.23194C10.3269 7.88038 10.2683 7.51417 10.2244 5.56593C10.1658 3.04639 10.0046 2.47511 9.09644 1.42042C8.0564 0.233894 5.97632 -0.293449 4.46753 0.248543ZM6.57691 3.13428C7.1189 3.42725 7.32398 3.93995 7.32398 5.02393V5.93214H5.85913H4.39429V4.97999C4.40894 3.93995 4.61402 3.42725 5.14136 3.13428C5.59546 2.88526 6.07886 2.88526 6.57691 3.13428ZM7.47046 9.28663C7.77808 9.47706 8.17359 9.90186 8.36402 10.2095C8.68628 10.7075 8.71558 10.9712 8.75952 12.6997L8.81812 14.648H5.87378H2.92944V12.9927C2.92944 12.0991 3.00269 11.103 3.09058 10.7954C3.28101 10.1216 4.20386 9.14014 4.86304 8.94971C5.63941 8.71534 6.84058 8.86182 7.47046 9.28663ZM8.78882 37.4995V57.4214H5.85913H2.92944V37.4995V17.5776H5.85913H8.78882V37.4995ZM8.59839 61.186C8.40796 63.0171 7.10425 66.4888 6.1521 67.6753L5.85913 68.0415L5.56616 67.6753C4.61402 66.4888 3.3103 63.0171 3.11987 61.186L3.03198 60.3511H5.85913H8.68628L8.59839 61.186Z" fill="#B0B0B0" />
                            <path d="M26.118 10.7516C23.4666 11.3961 21.2254 13.7106 20.6688 16.3766C20.5516 16.9186 20.5077 23.9498 20.5077 40.2096V63.2809H18.1639C15.6151 63.2809 15.1903 63.3834 14.8534 64.028C14.3846 64.9508 14.7801 67.2946 15.7616 69.2868C16.3329 70.444 16.6698 70.8981 17.7098 71.9381C18.7645 72.9928 19.204 73.3151 20.3612 73.8717C22.8075 75.0729 21.6942 75.0143 42.2606 74.9703L60.4246 74.9264L61.2596 74.5895C63.1346 73.8278 64.5116 72.5827 65.3905 70.8102C66.2401 69.111 66.2108 70.0924 66.2108 46.6842V25.195H70.0194C74.2235 25.195 74.5164 25.1364 74.8387 24.3453C74.9706 24.0377 74.9998 22.7047 74.9706 19.4674L74.9266 15.0143L74.4579 14.0329C73.8133 12.6705 72.993 11.8209 71.66 11.1618L70.5467 10.6198L48.7206 10.5905C31.5965 10.5758 26.7186 10.6051 26.118 10.7516ZM63.6766 14.2379L63.3543 15.0143L63.2811 41.8209L63.2079 68.6276L62.7977 69.4625C62.2411 70.5905 61.1571 71.5573 60.0877 71.8649C58.0077 72.4801 55.7957 71.4401 54.8729 69.4479C54.6239 68.8766 54.5653 68.4225 54.5213 66.65C54.5067 65.4782 54.4041 64.3356 54.3162 64.1159C53.9793 63.2369 54.7118 63.2809 38.3788 63.2809H23.4373V40.3121C23.4373 15.1022 23.3934 16.5377 24.3163 15.2633C24.7997 14.5895 25.62 13.9889 26.4696 13.6813C26.9237 13.5202 30.3514 13.4909 45.5125 13.4762H64.0135L63.6766 14.2379ZM70.7518 13.9743C71.0594 14.1647 71.4549 14.5895 71.6454 14.8971C71.9823 15.4391 71.9969 15.5709 72.0409 18.8522L72.0848 22.2653H69.1551H66.2108V19.1452C66.2108 17.4166 66.284 15.7907 66.3719 15.483C66.5623 14.8092 67.4852 13.8278 68.1444 13.6373C68.9207 13.403 70.1219 13.5495 70.7518 13.9743ZM51.5916 67.7047C51.6795 69.3307 52.0018 70.5172 52.661 71.5133L53.0272 72.07H38.5545C22.7928 72.07 23.3202 72.0993 21.5331 71.235C19.951 70.4733 18.2079 68.3053 17.8123 66.6061L17.7245 66.2106H34.6141H51.5184L51.5916 67.7047Z" fill="#B0B0B0" />
                            <path d="M36.6356 19.5699C34.3798 20.1705 32.4755 22.1773 31.9481 24.4771C31.7138 25.4586 31.7577 27.3922 32.0214 28.2857C32.7977 30.8931 34.1747 32.4898 39.8436 37.3531C42.8612 39.9459 43.1688 40.107 43.9745 39.6822C44.619 39.3453 50.3905 34.2476 51.7089 32.856C53.1591 31.3326 53.8329 30.3658 54.4628 28.8277C54.7997 28.0221 54.8436 27.6998 54.8436 26.2935C54.8436 24.9605 54.785 24.5211 54.4921 23.8033C53.8036 22.0015 52.7489 20.8004 51.1962 20.0094C48.7059 18.7642 45.9667 19.2476 43.9745 21.2838L43.3446 21.9283L42.5682 21.1666C40.9716 19.5699 38.8036 18.984 36.6356 19.5699ZM39.3456 22.4849C40.4296 22.939 41.3964 24.0523 41.8358 25.3707C42.0995 26.1764 42.6854 26.6597 43.3886 26.6597C43.9159 26.6597 44.5751 26.0299 44.8827 25.2096C45.4393 23.7447 46.4501 22.7047 47.6073 22.3971C50.0096 21.7525 52.2069 23.9351 51.9579 26.7037C51.7821 28.6666 50.3759 30.4244 45.952 34.2183L43.33 36.4596L40.9862 34.4527C36.9725 31.0396 35.5809 29.5308 34.9804 27.9488C34.6874 27.1578 34.6288 25.7222 34.8632 24.8726C35.3905 23.0123 37.6757 21.7818 39.3456 22.4849Z" fill="#B0B0B0" />
                            <path d="M30.0438 45.9082C28.7693 46.6113 29.3113 48.6328 30.7615 48.6328C31.5086 48.6328 32.2264 47.915 32.2264 47.1826C32.2264 46.084 31.0106 45.3662 30.0438 45.9082Z" fill="#B0B0B0" />
                            <path d="M35.9032 45.908C34.9218 46.4499 34.951 48.0027 35.9618 48.4568C36.5038 48.7058 56.0741 48.7058 56.6161 48.4568C57.0409 48.2664 57.4217 47.6511 57.4217 47.1677C57.4217 46.6843 57.0409 46.0691 56.6161 45.8787C56.0301 45.615 36.3866 45.6443 35.9032 45.908Z" fill="#B0B0B0" />
                            <path d="M30.0438 54.6973C28.7693 55.4004 29.3113 57.4219 30.7615 57.4219C31.5086 57.4219 32.2264 56.7041 32.2264 55.9717C32.2264 54.873 31.0106 54.1553 30.0438 54.6973Z" fill="#B0B0B0" />
                            <path d="M35.9032 54.697C34.9218 55.239 34.951 56.7917 35.9618 57.2458C36.5038 57.4949 56.0741 57.4949 56.6161 57.2458C57.0409 57.0554 57.4217 56.4402 57.4217 55.9568C57.4217 55.4734 57.0409 54.8581 56.6161 54.6677C56.0301 54.404 36.3866 54.4333 35.9032 54.697Z" fill="#B0B0B0" />
                        </svg>
                    </span>
                    <h1 class="text-center dm-sans font-medium lg:text-32 text-lg text-gray-14 mt-22p">{{ __('We’re sorry!') }}<br>
                        <span>{{ __('You haven’t saved anything for later.') }}</span>
                    </h1>
                </div>
            @endif
        </div>
        <div>
            <div class="block mt-15p lg:hidden">
                @if (count($wishlists) > 0)
                    @foreach ($wishlists as $wishlist)
                        <div class="flex cursor-pointer justify-between p-15p border-t border border-gray-2">
                            <div class="flex">
                                <div class="my-auto" x-data="{ showModal1: false }" :class="{ 'overflow-y-hidden': showModal1 }">
                                    <button class="dark:text-gray-2" @click="showModal1 = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.42" height="11" viewBox="0 0 11 11" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.05258 8.10547C3.73283 8.10547 3.47363 7.84627 3.47363 7.52653L3.47363 5.7897C3.47363 5.46995 3.73283 5.21075 4.05258 5.21075C4.37232 5.21075 4.63152 5.46995 4.63152 5.7897L4.63152 7.52653C4.63152 7.84627 4.37232 8.10547 4.05258 8.10547Z" fill="#898989" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.36849 8.10547C6.04875 8.10547 5.78955 7.84627 5.78955 7.52653L5.78955 5.7897C5.78955 5.46995 6.04875 5.21075 6.36849 5.21075C6.68824 5.21075 6.94744 5.46995 6.94744 5.7897L6.94744 7.52653C6.94744 7.84627 6.68824 8.10547 6.36849 8.10547Z" fill="#898989" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.594135 3.48299C0.456937 3.47363 0.277675 3.47332 0 3.47332V2.31543C0.00619255 2.31543 0.0123647 2.31543 0.0185164 2.31543C0.0309477 2.31543 0.0432955 2.31543 0.0555595 2.31543H10.3654C10.3777 2.31543 10.39 2.31543 10.4025 2.31543L10.421 2.31543V3.47332C10.1433 3.47332 9.96404 3.47363 9.82685 3.48299C9.69485 3.492 9.64458 3.50741 9.62049 3.51739C9.47863 3.57615 9.36592 3.68885 9.30716 3.83071C9.29718 3.8548 9.28178 3.90507 9.27277 4.03707C9.26341 4.17427 9.26309 4.35353 9.26309 4.6312L9.2631 8.14296C9.26313 8.65619 9.26315 9.0984 9.21554 9.45252C9.16452 9.83203 9.04945 10.1958 8.75439 10.4909C8.45932 10.7859 8.09554 10.901 7.71604 10.952C7.36192 10.9996 6.91972 10.9996 6.40649 10.9996H4.01449C3.50127 10.9996 3.05906 10.9996 2.70494 10.952C2.32544 10.901 1.96166 10.7859 1.66659 10.4909C1.37153 10.1958 1.25646 9.83203 1.20544 9.45252C1.15783 9.09841 1.15786 8.6562 1.15789 8.14298L1.15789 4.6312C1.15789 4.35353 1.15757 4.17427 1.14821 4.03707C1.13921 3.90507 1.1238 3.8548 1.11382 3.83071C1.05506 3.68885 0.942353 3.57615 0.800495 3.51739C0.776403 3.50741 0.726133 3.492 0.594135 3.48299ZM8.20525 3.47332H2.21573C2.27003 3.63404 2.29235 3.79616 2.30341 3.95825C2.31579 4.13961 2.31578 4.35873 2.31577 4.61268L2.31577 8.10486C2.31577 8.66706 2.317 9.03047 2.353 9.29824C2.38676 9.54935 2.44127 9.62805 2.48534 9.67213C2.52941 9.7162 2.60812 9.7707 2.85923 9.80447C3.127 9.84047 3.4904 9.84169 4.0526 9.84169H6.36838C6.93058 9.84169 7.29399 9.84047 7.56175 9.80447C7.81286 9.7707 7.89157 9.7162 7.93564 9.67213C7.97971 9.62805 8.03422 9.54935 8.06798 9.29824C8.10398 9.03047 8.10521 8.66706 8.10521 8.10486V4.61268C8.1052 4.35873 8.10519 4.13961 8.11757 3.95825C8.12863 3.79616 8.15095 3.63404 8.20525 3.47332Z" fill="#898989" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.02526 0.0701854C5.77981 0.0231002 5.49456 0 5.21131 0C4.92807 3.45077e-08 4.64282 0.0231002 4.39736 0.0701855C4.27466 0.0937243 4.15453 0.124639 4.04569 0.165361C3.94683 0.202348 3.812 0.263755 3.69793 0.370187C3.46414 0.588313 3.45145 0.95466 3.66957 1.18845C3.8754 1.40905 4.21322 1.43279 4.44709 1.25149C4.44842 1.25097 4.44987 1.25041 4.45144 1.24983C4.48234 1.23827 4.53599 1.22259 4.61551 1.20734C4.77449 1.17684 4.98477 1.15789 5.21131 1.15789C5.43785 1.15789 5.64813 1.17684 5.80712 1.20734C5.88663 1.22259 5.94029 1.23827 5.97118 1.24983C5.97275 1.25041 5.97421 1.25097 5.97554 1.25149C6.20941 1.43279 6.54722 1.40905 6.75305 1.18845C6.97118 0.954659 6.95848 0.588312 6.7247 0.370187C6.61062 0.263755 6.47579 0.202348 6.37694 0.16536C6.2681 0.124639 6.14797 0.0937242 6.02526 0.0701854Z" fill="#898989" />
                                        </svg>
                                    </button>
                                    <!-- Modal1 -->
                                    <div class="fixed inset-0 bg-black bg-opacity-50 pt-60 duration-300 overflow-y-auto"
                                        x-show="showModal1" x-transition:enter="transition duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0">
                                        <div class="relative sm:w-1/2 sm:mx-auto mx-5 my-10 opacity-100">
                                            <div class="relative px-4 bg-white shadow-lg rounded-md text-gray-900 z-50"
                                                @click.away="showModal1 = false" x-show="showModal1"
                                                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
                                                x-transition:leave="transition transform duration-300"
                                                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                                                <div class=" grid grid-cols-2 gap-32 items-center">
                                                    <div class="flex col-span-3">
                                                        <div class="flex flex-col justify-center bg-red-100 mt-30p items-center h-10 w-10 rounded-full dark:text-gray-2">
                                                            <svg class="" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                                                <circle cx="13" cy="13" r="13" fill="#F9E8E8" />
                                                                <path d="M14.4564 6.5L14.2486 15.3938H12.4646L12.2481 6.5H14.4564ZM12.1875 18.1217C12.1875 17.8042 12.2914 17.5386 12.4993 17.325C12.7129 17.1056 13.0073 16.9959 13.3826 16.9959C13.7521 16.9959 14.0436 17.1056 14.2572 17.325C14.4709 17.5386 14.5777 17.8042 14.5777 18.1217C14.5777 18.4277 14.4709 18.6904 14.2572 18.9098C14.0436 19.1234 13.7521 19.2302 13.3826 19.2302C13.0073 19.2302 12.7129 19.1234 12.4993 18.9098C12.2914 18.6904 12.1875 18.4277 12.1875 18.1217Z"  fill="#C8191C" />
                                                            </svg>
                                                        </div>
                                                        <span class="inline-block leading-4 mb-0.5 ml-2 pr-3 mt-10 dm-sans font-medium text-sm text-gray-12">{{ __('Are you sure you want to delete this?') }}</span>
                                                    </div>
                                                </div>
                                                <p class=" text-gray-10 -mt-1 roboto-medium font-medium text-11 ml-12 pr-10">
                                                    {{ __('Please keep in mind that once deleted, you can not undo it.') }}
                                                </p>
                                                <div class=" flex justify-center mt-6 pb-5">
                                                    <button class="dm-sans items-center transition duration-200 rounded pb-4 pt-3 cursor-pointer font-medium text-xs text-gray-12 w-36 h-10 bg-white border border-gray-2 mb-7p hover:border-gray-12" @click="showModal1 = false">{{ __('Cancel') }}
                                                    </button>
                                                    <form action="{{ route('wishlist.destroy', ['id' => $wishlist->item->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button @click="showModal1 = true" type="submit" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer py-3.5 font-medium text-xs text-white w-36 h-10 bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Yes, Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class=" flex items-center ml-2 bg-gray-11 rounded">
                                    <img src="{{ $wishlist->item->fileUrl() }}" alt="item"
                                        class="flex w-6 h-6 m-3 justify-center text-center" />
                                </span>
                                <div class="my-auto">
                                    <p class="roboto-medium ml-2.5 font-medium whitespace-nowrap text-gray-10 text-xss dark:text-gray-2">
                                        {{ formatDate($wishlist->created_at) }}</p>
                                    <p class="ml-2.5 roboto-medium font-medium text-xs text-gray-12 pr-2.5">
                                        {{ trimWords($wishlist->item->name) }}
                                    </p>
                                </div>
                            </div>
                            <div class="my-auto text-right">
                                <p class="roboto-medium whitespace-nowrap font-medium text-xss text-gray-10">{{ __('In Stock') . '(3)' }}
                                </p>
                                <p class="roboto-medium font-medium text-gray-12 text-15 text-right dark:text-gray-2">
                                    {{ formatCurrencyAmount(optional($wishlist->item)->price) }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $wishlists->links('site.layouts.partials.pagination') }}
        </div>
    </div>
@endsection
