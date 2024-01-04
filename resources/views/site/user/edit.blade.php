@extends('../site/layouts.user_panel.app')
@section('page_title', __('Profile'))
@section('content')
    <!-- My profile -->
    <div class="dark:bg-red-1 h-full xl:px-74p px-5 pt-30p xl:pt-14" id="site-user-edit-container">
        <div>
            <div class="flex lg:items-center">
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
                    {{ __('Your Profile') }}
                </h1>
            </div>
            <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-2 text-20 text-gray-10 leading-6">
                {{ __('What you show about yourself to the world..') }}</p>

        </div>
        <div class=" flex lg:mt-75p mt-10 dm-bold font-bold text-gray-12 lg:text-2xl text-base uppercase">
            <svg class="mr-3 mt-1 lg:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                <path d="M13.8111 0.06563C13.6306 0.0984421 13.3298 0.176373 13.1451 0.246098C12.3974 0.520903 12.6423 0.30352 7.19391 5.4961C4.26774 8.28106 2.06773 10.4098 1.9732 10.541C1.88727 10.6641 1.77125 10.8691 1.71969 11.0004C1.66383 11.1275 1.4232 12.116 1.18688 13.1947C0.684141 15.4547 0.65836 15.6926 0.856016 16.2258C0.989219 16.5826 1.22125 16.9271 1.48336 17.1486C1.8443 17.4521 2.46734 17.6777 2.9357 17.6777C3.09899 17.6777 6.77711 17.001 7.40875 16.8533C7.52477 16.8246 7.7611 16.7385 7.93727 16.6605C8.25524 16.517 8.34977 16.4309 13.3384 11.673C18.6923 6.5625 18.658 6.59942 18.9287 5.97598C19.122 5.52071 19.1994 5.17207 19.2252 4.63477C19.2595 3.79395 19.0533 3.05977 18.5806 2.39122C18.2756 1.95235 16.9779 0.717777 16.617 0.520903C15.7834 0.06563 14.7693 -0.0984325 13.8111 0.06563ZM14.8381 2.13692C15.2806 2.21485 15.5213 2.37071 16.1959 3.02696C16.8705 3.68321 17.0037 3.88008 17.0896 4.33535C17.1455 4.65118 17.0638 5.08594 16.8877 5.36895C16.8189 5.48379 14.8638 7.39102 11.8861 10.2539L6.99625 14.9502L4.97242 15.2742C3.86383 15.4547 2.9443 15.59 2.9357 15.5818C2.92711 15.5736 3.09898 14.7 3.31813 13.6459L3.71344 11.7223L8.5861 7.0711C12.8529 2.99414 13.4888 2.40352 13.7166 2.29688C14.1162 2.10411 14.417 2.06309 14.8381 2.13692Z" fill="#2C2C2C" />
                <path d="M1.41481 19.0431C0.757386 19.2728 0.551136 20.1341 1.03239 20.6591C1.10114 20.7371 1.24293 20.8396 1.33746 20.8888L1.51364 20.9791L9.82809 20.9914C19.0836 20.9996 18.4261 21.0201 18.7742 20.7207C18.873 20.6386 18.9847 20.4951 19.0277 20.4049C19.1222 20.208 19.1351 19.8224 19.0492 19.6297C18.959 19.4205 18.7226 19.1908 18.4863 19.0883L18.2715 18.9898L9.91403 18.9939C3.59333 18.9939 1.52223 19.0062 1.41481 19.0431Z" fill="#2C2C2C" />
            </svg>
            <svg class="mr-3 mt-1 lg:hidden block" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                <path d="M9.42511 0.0406275C9.31026 0.0609398 9.11886 0.109182 9.00128 0.152346C8.5255 0.322463 8.68136 0.187893 5.21417 3.40235C3.35206 5.12637 1.95206 6.44414 1.89191 6.52539C1.83722 6.60156 1.76339 6.72852 1.73058 6.80977C1.69503 6.88848 1.54191 7.50039 1.39151 8.16816C1.07159 9.56719 1.05519 9.71445 1.18097 10.0445C1.26573 10.2654 1.41339 10.4787 1.58019 10.6158C1.80987 10.8037 2.20636 10.9434 2.50441 10.9434C2.60831 10.9434 4.94894 10.5244 5.35089 10.433C5.42472 10.4152 5.57511 10.3619 5.68722 10.3137C5.88956 10.2248 5.94972 10.1715 9.12433 7.22617C12.5314 4.0625 12.5095 4.08535 12.6817 3.69942C12.8048 3.41758 12.854 3.20176 12.8704 2.86914C12.8923 2.34863 12.761 1.89414 12.4603 1.48028C12.2661 1.2086 11.4403 0.444338 11.2107 0.322463C10.6802 0.0406275 10.0349 -0.060935 9.42511 0.0406275ZM10.0786 1.32285C10.3603 1.3711 10.5134 1.46758 10.9427 1.87383C11.372 2.28008 11.4567 2.40195 11.5114 2.68379C11.547 2.8793 11.495 3.14844 11.3829 3.32363C11.3392 3.39473 10.095 4.57539 8.20011 6.34766L5.08839 9.25488L3.8005 9.45547C3.09503 9.56719 2.50987 9.65098 2.50441 9.6459C2.49894 9.64082 2.60831 9.1 2.74776 8.44746L2.99933 7.25664L6.10011 4.37735C8.81534 1.85352 9.22003 1.48789 9.36495 1.42188C9.61925 1.30254 9.81066 1.27715 10.0786 1.32285Z" fill="#2C2C2C" />
                <path d="M1.53674 11.5953C1.11838 11.7375 0.987131 12.2707 1.29338 12.5957C1.33713 12.644 1.42737 12.7074 1.48752 12.7379L1.59963 12.7938L6.89065 12.8014C12.7805 12.8065 12.3621 12.8192 12.5836 12.6338C12.6465 12.583 12.7176 12.4942 12.7449 12.4383C12.8051 12.3164 12.8133 12.0778 12.7586 11.9584C12.7012 11.8289 12.5508 11.6867 12.4004 11.6233L12.2637 11.5623L6.94534 11.5649C2.92307 11.5649 1.6051 11.5725 1.53674 11.5953Z"fill="#2C2C2C" />
            </svg>
            <p>{{ __('edit profile') }}</p>
        </div>
        <form class="" action="{{ route('site.userProfileUpdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="border mt-5 w-1425p lg:block hidden border-line"></div>
            <div>
                <p class="dm-bold font-bold text-gray-12 lg:block hidden uppercase text-lg leading-6 mt-10">{{ __('Profile Display') }}
                </p>
                <div class="mt-25p flex">
                    <img class="lg:h-32 lg:w-32 h-24 w-24 rounded-full" id="blah" src="{{ $user->fileUrl() }}" alt="your image" />
                    <div class="lg:mt-27p mt-1 ml-23p text-center">
                            <label class="dm-sans flex cursor-pointer items-center justify-center lg:py-3.5 py-2.5 font-medium lg:text-sm text-13 text-white whitespace-nowrap lg:w-141p w-32 lg:h-46p h-10 bg-gray-12 mb-9p rounded" for="imgInp">
                                <input class="sr-only cursor-pointer" accept="image/*" type='file' id="imgInp" name="image" />{{ __('Change Photo') }}</label>
                        <div x-data="{ showModal1: false }" :class="{ 'overflow-y-hidden': showModal1 }">
                            <a href="javascript:void(0)" @click="showModal1 = true" class="dm-sans text-gray-10 font-medium lg:text-sm text-13 hover:text-gray-12">{{ __('Remove') }}</a>

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
                                        <div class=" flex justify-end mt-8 mr-30p mb-0">
                                            <button type="button" @click="showModal1 = false" class="dm-sans items-center transition duration-200 rounded pb-4 pt-3 cursor-pointer font-medium text-sm text-gray-12 w-141p h-46p bg-white border border-gray-2 mb-7p hover:border-gray-12">
                                                {{ __('Cancel') }}
                                            </button>

                                            <a href="{{ route('site.userProfileDelete') }}" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer py-3.5 px-6 font-medium text-sm text-white w-141p h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">
                                                {{ __('Yes, Delete') }}
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p class="dm-bold font-bold text-gray-12 uppercase lg:text-lg text-base leading-6 lg:mt-60p mt-10">{{ __('personal information') }}</p>
                <div class="items-center xl:w-1/2 lg:w-ful mt-27p">
                    <div>
                            <div class="grid grid-cols-2 lg:gap-3 gap-15p">
                                <div class=" mb-0">
                                    <label class=" text-sm dm-sans font-medium capitalize text-gray-12 require-profile" for="name">
                                        {{ __('Name ') }}</label>
                                    <input class="border-gray-2 rounded-sm pr-3 w-full lg:h-46p h-10 roboto-medium pl-18p font-medium text-sm text-gray-10 form-control border focus:border-gray-12" type="text" name="name" id="name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="text-sm dm-sans font-medium capitalize text-gray-12 require-profile" for="email">
                                        {{ __('Email Address') }}</label>
                                    <input class="border-gray-2 rounded-sm w-full lg:h-46p h-10 roboto-medium pl-18p font-medium text-sm text-gray-10 form-control focus:border-gray-12" type="email" name="email" id="email" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="grid lg:grid-cols-2 grid-cols-1 flex lg:gap-3">
                                <div class="mb-3">
                                    <label class="text-sm dm-sans font-medium capitalize text-gray-12 require-profile" for="select">{{ __('Gender ') }}</label>
                                    <select id="select" required
                                        oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                        class="border-gray-2 rounded-sm w-full h-46p roboto-medium pl-18p font-medium text-sm text-gray-10 form-control appearance-none" name="gender">
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>
                                            {{ __('Male') }}</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                            {{ __('Female') }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class=" mb-3p capitalize dm-sans font-medium text-sm text-gray-12" for="Date">{{ __('Date of Birth ') }}</label>
                                    <input datepicker class="border-gray-2 rounded-sm w-full h-46p pl-18p roboto-medium uppercase font-medium text-sm text-gray-10 form-control focus:border-gray-12" type="date" name="birthday" id="date" value="{{ $user->birthday }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class=" whitespace-nowrap text-sm dm-sans font-medium capitalize text-gray-12"
                                    for="number"> {{ __('Phone Number ') }}</label>
                                <input class="border-gray-2 rounded-sm w-full lg:h-46p h-10 roboto-medium pl-18p font-medium text-sm text-gray-10 form-control focus:border-gray-12"
                                    name="phone" type="tel" id="phone" value="{{ $user->phone }}">
                            </div>
                            <div class="mb-3">
                                <label class=" text-sm dm-sans font-medium pr-60 capitalize text-gray-12 require-profile" for="address">
                                    {{ __('Address') }}</label>
                                <input class="border-gray-2 rounded-sm w-full lg:h-46p h-10 roboto-medium pl-18p font-medium text-sm text-gray-10 form-control focus:border-gray-12" type="text" name="address" id="address" required
                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="flex mt-5">
                            <div  class="lg:order-none order-last lg:ml-0 ml-3 dm-sans text-center transition duration-200 rounded py-3.5  cursor-pointer font-medium text-sm  text-gray-12 w-141p h-46p bg-white border border-gray-2 mb-7p hover:border-gray-12">
                                <a href="{{ route('site.userProfile') }}"> {{ __('Cancel') }}</a>
                            </div>
                            <button class="dm-sans lg:ml-3 ml-0 transition duration-200 items-center cursor-pointer py-3.5 px-6 font-medium text-sm whitespace-nowrap  text-white w-141p h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Save Changes') }} </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('/public/dist/js/custom/user.min.js') }}"></script>
@endsection
