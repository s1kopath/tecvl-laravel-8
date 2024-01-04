@extends('../site/layouts.user_panel.app')
@section('page_title', __('Setting'))
@section('content')
    <!-- My profile -->
    <div class="dark:bg-red-1 settings-page h-full xl:pl-74p px-5 pt-30p lg:pt-14 bg-white">
        <div>
            <div class="flex items-center">
                <span class="mr-4 hidden lg:block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="53" height="44" viewBox="0 0 53 44" fill="none">
                        <rect x="36.1779" y="27.377" width="16.6222" height="16.6222" rx="2" fill="#FCCA19" />
                        <rect width="32.2667" height="32.2667" rx="2" fill="#FCCA19" />
                    </svg>
                </span>
                <span class="mr-4 mt-1 lg:hidden block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="32" viewBox="0 0 39 32"
                        fill="none">
                        <rect x="26.3115" y="19.9111" width="12.0891" height="12.0891" rx="2"
                            fill="#FCCA19" />
                        <rect width="23.4671" height="23.4671" rx="2" fill="#FCCA19" />
                    </svg>
                </span>
                <h1 class="dark:text-gray-2 dm-sans font-medium lg:pt-0 text-2xl lg:text-4xl text-gray-12 mb-1 dark:text-gray-2">
                    {{ __('Settings') }}
                </h1>
            </div>
            <p class="dark:text-gray-2 lg:mt-1.5 roboto-medium font-medium text-base lg:text-xl mt-4 text-20 text-gray-10 leading-6">
                {{ __('Configure your account settings and be secured') }}</p>
        </div>
        <div class="flex lg:mt-75p mt-30p mb-5 dm-bold font-bold text-gray-12 lg:text-2xl text-lg uppercase">
            <p>{{ __('security settings') }}</p>
        </div>
        <div class="bg-white w-full" x-data="{ selected: 1 }">
            <ul class="shadow-box">
                <li class="relative xl:w-2/3 2xl:w-1/2 w-full border rounded border-gray-2">
                    <div>
                        <div class="accordion__button w-full cursor-pointer lg:px-30p px-15p lg:py-30p py-4">
                            <p class="text-gray-12 leading-6 text-left mb-2 lg:text-lg text-base dm-sans font-medium">
                                {{ __('Change Password') }} <br>
                               <span class="text-gray-10 lg:text-base text-sm text-left roboto-medium font-medium">
                                    {{ __('You set a unique password to protect your account.') }}</span>
                            </p>
                        </div>
                        <div class="px-5 py-0 accordion__details robot-medium font-medium text-justify lg:text-sm text-13 text-gray-10">
                            <div>
                                <div class="h-370p w-full">
                                    <form action="{{ route('site.userProfileUpdatePassword') }}" method="POST"
                                        class="lg:px-40 px-5 pt-3p" id="password-validate-submi">
                                        @csrf
                                        <div class="lg:pr-7 pr-0">
                                            <div class="flex flex-col">
                                                <label class="require-profile mb-3p dm-sans font-medium text-sm text-gray-12"
                                                    for="old_password">{{ __('Old Password') }} </label>
                                                <input type="password" id="old_password" name="old_password" class="px-18p w-full lg:h-46p h-10 pt-15p text-gray-10  border rounded-sm focus:outline-none focus:border-gray-12 border-gray-2 form-control" placeholder="{{ __('****************') }}" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Old Password'), 'x' => 5]) }}">
                                            </div>
                                            <div class="flex flex-col mt-15p">
                                                <label class="require-profile mb-3p leading-none dm-sans font-medium text-sm text-gray-12"
                                                    for="new_password">{{ __('New Password') }} </label>
                                                <input type="password" id="new_password" name="new_password" class="px-18p w-full lg:h-46p h-10 pt-15p text-gray-10 border rounded-sm focus:outline-none focus:border-gray-12 border-gray-2 form-control password-validation" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('New Password'), 'x' => 5]) }}">
                                            </div>
                                            <div class="flex flex-col mt-15p">
                                                <label class="require-profile leading-18p mb-3p dm-sans font-medium text-sm text-gray-12"
                                                    for="confirm_password">{{ __('Confirm Password') }} </label>
                                                <input type="password" id="confirm_password" name="confirm_password" class="px-18p w-full lg:h-46p h-10 pt-15p text-gray-10 border rounded-sm focus:outline-none focus:border-gray-12 border-gray-2 form-control" required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :x characters.', ['x' => __('Confirm Password'), 'x' => 5]) }}">
                                            </div>
                                            <div class="flex mt-5 mb-3p justify-end">
                                                <div class="dm-sans flex items-center justify-center transition duration-200 rounded   cursor-pointer font-medium text-sm text-gray-12 w-141p lg:h-46p h-10 bg-white border border-gray-2 mb-7p hover:border-gray-12"><a href="{{ route('site.userSetting') }}"> {{ __('Cancel') }}</a>
                                                </div>
                                                <button type="submit" class="dm-sans ml-3 transition duration-200 items-center cursor-pointer  whitespace-nowrap font-medium text-sm text-white w-141p lg:h-46p h-10 bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Save Change') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- delete account --}}
                @if (optional(optional(auth()->user()->roleUsers)->roles)->slug != 'super-admin')
                    <li class="relative xl:w-2/3 2xl:w-1/2 w-full border rounded mt-5 border-gray-2">
                        <div>
                            <div class="accordion__button w-full cursor-pointer lg:px-30p px-15p lg:py-30p py-5">
                                <p class="text-gray-12 leading-6 text-left mb-2 lg:text-lg text-base dm-sans font-medium">
                                    {{ __('Delete Account') }}<br><span class="text-gray-10  lg:text-base text-sm text-left roboto-medium font-medium">{{ __("You can't get back your account anymore.") }}</span>
                                </p>
                            </div>
                            <div class="px-5 py-0 accordion__details robot-medium font-medium lg:text-sm text-13 text-gray-10">
                                <div class="border-gray-2 w-full rounded" id="delete">
                                    <div class="w-full lg:px-40 px-5">
                                        <div class="lg:pt-30p pt-5">
                                            <div class="flex">
                                                <svg class="lg:block hidden" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                    <circle cx="16" cy="16" r="16" fill="#F9E8E8" />
                                                    <path d="M17.7925 8L17.5367 18.9463H15.3411L15.0746 8H17.7925ZM15 22.3037C15 21.9129 15.1279 21.586 15.3837 21.3231C15.6466 21.0531 16.009 20.9181 16.4709 20.9181C16.9256 20.9181 17.2845 21.0531 17.5474 21.3231C17.8103 21.586 17.9417 21.9129 17.9417 22.3037C17.9417 22.6803 17.8103 23.0036 17.5474 23.2736C17.2845 23.5365 16.9256 23.668 16.4709 23.668C16.009 23.668 15.6466 23.5365 15.3837 23.2736C15.1279 23.0036 15 22.6803 15 22.3037Z" fill="#C8191C" />
                                                </svg>
                                                <svg class="lg:hidden block" xmlns="http://www.w3.org/2000/svg"
                                                    width="26" height="26" viewBox="0 0 26 26" fill="none">
                                                    <circle cx="13" cy="13" r="13" fill="#F9E8E8" />
                                                    <path d="M14.4564 6.5L14.2486 15.3938H12.4646L12.2481 6.5H14.4564ZM12.1875 18.1217C12.1875 17.8042 12.2914 17.5386 12.4993 17.325C12.7129 17.1056 13.0073 16.9959 13.3826 16.9959C13.7521 16.9959 14.0436 17.1056 14.2572 17.325C14.4709 17.5386 14.5777 17.8042 14.5777 18.1217C14.5777 18.4277 14.4709 18.6904 14.2572 18.9098C14.0436 19.1234 13.7521 19.2302 13.3826 19.2302C13.0073 19.2302 12.7129 19.1234 12.4993 18.9098C12.2914 18.6904 12.1875 18.4277 12.1875 18.1217Z"fill="#C8191C" />
                                                </svg>
                                                <span class="dm-sans font-medium lg:text-lg text-sm text-gray-12 inline-block ml-2.5 mt-1 leading-6">{{ __('Are you sure you want to delete this account?') }}</span>
                                            </div>
                                            <div class="roboto-medium ml-10 font-medium mt-2 lg:text-sm text-11 text-left text-gray-10">
                                                <p> {!! chunk_split(__('Once deleted, every information and files will be lost forever.'), 42, '<br>') !!}
                                                </p>
                                            </div>
                                        </div>
                                        <form action="{{ route('site.userDelete') }}" method="post"
                                            class="lg:pr-6 pr-0">
                                            @csrf
                                            <div class="lg:mt-30p mt-6 lg:pr-6 pr-0">
                                                <p class="text-left mb-3p dm-sans font-medium text-sm text-gray-12"> {{ __('Enter password to delete your account.') }} </p>
                                                <div>
                                                    <input class="px-18p w-full lg:h-46p h-10 pt-15p text-gray-10  border rounded-sm focus:outline-none focus:border-gray-12 border-gray-2 form-control block" type="password" name="password" id="password" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                </div>
                                                <div class="flex mt-5 justify-end">
                                                    <button type="button" class="dm-sans items-center transition duration-200 rounded mb-10 pt-3 pb-3.5 cursor-pointer font-medium text-sm text-gray-12 w-141p h-46p bg-white border border-gray-2 hover:border-gray-12" @click="selected !== 2 ? selected = 2 : selected = null">
                                                        {{ __('Go Back') }}
                                                    </button>
                                                    <button type="submit" class="dm-sans ml-3 transition duration-200 cursor-pointer font-medium text-sm text-white w-141p h-46p bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 rounded">
                                                        {{ __('Delete Account') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    @php
    $uppercase = $lowercase = $number = $symbol = $length = 0;
    if (env('PASSWORD_STRENGTH') != null && env('PASSWORD_STRENGTH') != '') {
        $length = filter_var(env('PASSWORD_STRENGTH'), FILTER_SANITIZE_NUMBER_INT);
        $conditions = explode('|', env('PASSWORD_STRENGTH'));
        $uppercase = in_array('UPPERCASE', $conditions);
        $lowercase = in_array('LOWERCASE', $conditions);
        $number = in_array('NUMBERS', $conditions);
        $symbol = in_array('SYMBOLS', $conditions);
    }
    @endphp
@endsection
@section('js')
    <script src="{{ asset('/public/dist/js/custom/site/password-validation.min.js') }}"></script>
    <script src="{{ asset('/public/dist/js/custom/site/settings.min.js') }}"></script>
    <script src="{{ asset('/public/dist/js/custom/validation.min.js') }}"></script>
@endsection
