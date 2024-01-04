@extends('../site/layouts.user_panel.app')
@section('page_title', __('Refund Details'))
@section('content')
    <div class="dark:bg-red-1 h-full xl:px-74p px-5 pt-30p xl:pt-14">
        <div class="flex justify-between">
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
                        {{ __('Refund Details') }}
                    </h1>
                </div>
                <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-2 text-20 text-gray-10 leading-6"> {{ __('We got you covered about your concern..') }}</p>
            </div>
            <div class="lg:block hidden">
                <a href="{{ route('site.refundRequest') }}" class="flex relative mt-2 arrow-hover font-medium dm-sans text-gray-10 text-base pl-4 rounded-sm">
                    <svg class="mt-2 mr-2 absolute" width="15" height="10" viewBox="0 0 15 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.70711 0L6.12132 1.41421L3.82843 3.70711H13.4142C13.9665 3.70711 14.4142 4.15482 14.4142 4.70711C14.4142 5.25939 13.9665 5.70711 13.4142 5.70711H3.82843L6.12132 8L4.70711 9.41421L0 4.70711L4.70711 0Z"
                            fill="currentColor" />
                    </svg>
                    <span class="ml-4 dm-sans font-medium">{{ __('Back') }}</span>
                </a>
            </div>
        </div>
        <div class="lg:flex mt-74p">
            <div class="lg:w-480p">
                <div>
                    <div class="flex cursor-pointer rounded justify-between xl:p-10 p-5 xl:pr-20 border-t border border-gray-2">
                        <div >
                            <div>
                                <p class=" text-gray-10 lg:text-sm text-13 roboto-medium font-medium lg:mb-2  mb-1.5 uppercase">
                                    {{ __('Reference') }}
                                </p>
                                <p class="dm-bold text-lg font-bold text-gray-12">
                                    {{ $refund->reference }}
                                </p>
                            </div>
                            <div class="mt-8 justify-start items-start">
                                <p class=" text-gray-10 lg:text-sm text-13 roboto-medium font-medium lg:mb-2 mb-1.5 uppercase">
                                    {{ __('Refund Reason') }}
                                </p>
                                <p class="dm-sans text-lg font-medium text-gray-12">{{ optional($refund->refundReason)->name }}</p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-gray-10 lg:text-sm text-13 roboto-medium font-medium mb-2 uppercase">
                                    {{ __('Status') }}
                                </p>

                                @php
                                    $color = ['Opened' => 'bg-gray-11 ; text-gray-10 ', 'In progress' => 'bg-green-2 ; text-green-1', 'Accepted' => 'bg-green-2 ; text-green-1', 'Declined' => 'bg-pinks-2 ; text-reds-3'];
                                @endphp
                                <p class="{{ $color[$refund->status] }} roboto-medium font-medium px-4 py-1 text-center rounded  text-base dark:text-gray-2">
                                    {{ $refund->status }}
                                </p>
                            </div>
                            <div class="mt-8 justify-start items-start">
                                <p class="text-gray-10 lg:text-sm text-13 roboto-medium font-medium mb-2 uppercase">
                                    {{ __('Refund Amount') }}
                                </p>
                                <p class="dm-sans text-lg font-medium text-gray-12">
                                    {{ formatNumber($refund->quantity_sent * optional($refund->orderDetail)->price) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:p-10 p-5 border lg:mt-50p mt-5  border-gray-2 rounded">
                    <p class="dm-bold font-bold lg:mb-5 mb-4 text-gray-12 lg:text-xl text-base">{{ __('Product Details') }}</p>
                    <div class="flex justy-center items-center lg:mb-10 mb-5">
                        <div class="bg-gray-11 lg:h-28 h-72p lg:w-28 w-72p justify-center  flex items-center rounded">
                            <img class="lg:h-16 h-11 lg:w-16 w-11" src="{{ optional(optional($refund->orderDetail)->item)->fileUrl() }}"
                                alt="" />
                        </div>
                        <div class="text-left items-center ml-5 dm-sans  text-gray-12">
                            <p class="text-sm lg:text-lg font-bold">{{ formatNumber(optional($refund->orderDetail)->price) }}</p>
                            <p class="text-13 lg:text-lg">
                                {{ trimWords(optional(optional($refund->orderDetail)->item)->name, 50) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-10">
                        <div class="roboto-medium font-medium capitalize lg:text-base text-xs mr-50p text-gray-10">
                            <p>{{ __('Seller') }}</p>
                            @if ($refund->orderDetail->payloads != null)
                            @foreach (json_decode($refund->orderDetail->payloads)->option_name as $payload)
                                <p>{{ $payload }}</p>
                            @endforeach
                            @endif
                            <p>qty</p>
                        </div>
                        <div class="roboto-medium font-medium capitalize lg:text-base text-xs text-gray-10">
                            <p><span class="mr-3 whitespace-nowrap">:</span>{{ __(optional(optional($refund->orderDetail)->vendor)->name) }} </p>
                            @if ($refund->orderDetail->payloads != null)
                            @foreach (json_decode($refund->orderDetail->payloads)->options as $payload)
                                <p><span class="mr-3">:</span>{{ $payload }}</p>
                            @endforeach
                            @endif
                            <p><span class="mr-3">:</span>{{ $refund->quantity_sent }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="dm-sans lg:text-sm text-xs font-medium text-gray-12 lg:mb-4 mb-3">{{ __('Uploaded Pictures') }}:</p>
                        <div class="flex flex-wrap">
                            @foreach ($refund->filesUrlold() as $file)
                                <img class="lg:h-70p h-54p lg:w-70p w-54p rounded lg:mr-18p mr-4" src="{{ $file }}" alt="" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if ($refund->status == 'In progress')
                <div class="w-572-h-586 refund-details lg:ml-50p lg:p-10 lg:mt-0 mt-5 p-0 lg:border lg:border-gray-2 lg:rounded">
                    <p class="dm-bold font-bold mb-5 text-gray-12 lg:text-xl text-lg">{{ __('Track Your Request') }}</p>
                    <div>
                        <div class="flex flex-col max-h-128 overflow-auto">
                            @foreach ($refundProcesses as $process)
                            <div class="flex justify-between mb-9">
                                <div class="flex">
                                    <div class="flex flex-col justify-center items-center relative">
                                        <svg class="rounded-full h-6 w-6 p-1.5 border border-green-3"
                                            xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8"
                                            fill="none">
                                            <circle cx="4" cy="4" r="4" transform="rotate(90 4 4)" fill="#33C172" />
                                        </svg>
                                    </div>

                                    <div class="ml-5">
                                        <p class="dm-sans font-medium text-gray-19 lg:text-base text-sm">{{ $process->user->name }} ({{ (auth()->user()->roles->first()->name == $process->user->roles()->first()->name) ? __('You') : $process->user->roles()->first()->name }})</p>
                                        <p class="lg:text-13 text-xs roboto-medium text-gray-19 font-medium">
                                           {{ $process->note }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="dm-sans whitespace-nowrap font-medium text-gray-12 text-base">{{ formatDate($process->created_at) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if (in_array($refund->status, ['Opened', 'In progress']))
                <div class="ml-50p w-572 mt-2">
                    <form action="{{ route('site.refundProcess') }}" method="post">
                        @csrf
                        <input type="hidden" name="refund_id" value="{{ $refund->id }}">
                        <textarea name="note" id="" class="border-gray-2 w-full" rows="3" placeholder="{{ __('Enter your message here...') }}"></textarea>
                        <div class="flex">
                            <button type="submit" class="w-full dm-sans transition duration-200 items-center cursor-pointer py-3.5 font-medium text-sm whitespace-nowrap text-white h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Send') }}</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
            <div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/site/common.min.js') }}"></script>
@endsection
