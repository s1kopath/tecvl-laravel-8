@extends('../site/layouts.app')
@section('page_title', __('Sign Up'))
@section('content')

    <div class="lg:flex" id="sign-up-container">
        <div class="hidden lg:flex items-center justify-center bg-green-50 color_switch_log flex-1 h-screen">
            @include('../site/layouts/partials.login_signup_bac')
        </div>

        <div class="lg:w-1/2 xl:max-w-screen-sm">

            <div class="mt-10 px-12 sm:px-10 md:px-48 lg:px-12  xl:px-24 xl:max-w-2xl">
                <h2 class="text-center  font-display font-semibold lg:text-left sm:text-xl md:text-2xl lg:text-3xl md: 2xl:text-5xl
            xl:text-bold text-green-500">{{ __('Sign Up') }}</h2>
                <div class="mt-12 lg:mt-6 2xl:mt-12">
                    <form method="post" action="{{ route('site.signUpStore') }}" id="password-validate-submit">
                        @csrf
                        <div>
                            <div class="text-md font-bold text-gray-700 tracking-wide require">{{ __('Name') }}</div>

                            <div class="grid grid-cols-12 relative form">
                                <div class="col-span-12">
                                    <input id='name' class="onblur-clear-this-input form-control w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter Your :x', ['x' => __('Name')]) }}" required minlength="3" value="{{ old('name') }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :y characters.', ['x' => __('Name'), 'y' => 3]) }}">
                                    @if ($errors->has('name'))
                                        @foreach($errors->get('name') as $key => $error)
                                            <span class="text-red-500 block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div title='clear field' id='clear' class='onblur-clear-icon hidden  cursor-pointer  absolute right-0 text-gray-400 p-2 pt-4 hover:text-gray-700'  >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="text-md font-bold text-gray-700 tracking-wide require">{{ __('Email') }}</div>
                            <div class="grid grid-cols-12 relative form">
                                <div class="col-span-12">
                                     <input class="onblur-clear-this-input form-control w-full text-lg py-2 focus:outline-none border-b border-gray-300 focus:border-indigo-500" type="email"  name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('Enter Your :x', ['x' => __('Email')]) }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}" >
                                     @if ($errors->has('email'))
                                        @foreach($errors->get('email') as $key => $error)
                                            <span class="text-red-500 block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div title='clear field' id='clear' class='onblur-clear-icon hidden  cursor-pointer  absolute right-0 text-gray-400 p-2 pt-4 hover:text-gray-700'  >
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                         <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-md font-bold text-gray-700 tracking-wide require">
                                    {{ __('Password') }}
                                </div>
                            </div>
                            <input class="form-control w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 password-validation" type="password" id="password" name="password" placeholder="{{ __('Enter Your :x', ['x' => __('Password')]) }}"  required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :y characters.', ['x' => __('Password'), 'y' => 5]) }}">
                            <span id="CheckPasswordMatch"></span>
                            <span class="password-validation-error block text-sm text-red-600"></span>
                            @if ($errors->has('password'))
                                @foreach ($errors->get('password') as $error)
                                    <span class="text-red-500 block">{{ $error }}</span>
                                @endforeach

                            @endif
                        </div>

                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-md font-bold text-gray-700 tracking-wide require">
                                    {{ __('Confirm Password') }}
                                </div>
                            </div>
                            <input class="form-control w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Enter Your :x', ['x' => __('Confirm Password')]) }}"  required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':x should contain at least :y characters.', ['x' => __('Password'), 'y' => 5]) }}">
                        </div>
                        <div class="mt-10">
                            <button class="bg-green-500 text-white color_switch_bac color_switch_hover p-2 2xl:p-4 w-full rounded-full tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-green-600
                        shadow-lg">
                                {{ __('Sign Up') }}
                            </button>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <hr class="w-full border-gray-300"> <span class="p-2 text-gray-400 text-xs">{{ __('OR') }}</span>
                            <hr class="w-full border-gray-300">
                        </div>
                        <div class="pt-2">
                            <p class="text-gray-700 font-bold pb-2 pl-1" style="font-size: 10px;">{{ __('You can also sign up with:') }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('login.facebook') }}" class="text-center w-1/4 mx-1 p-2 font-bold text-white bg-blue-800 rounded focus:outline-none hover:bg-blue-900" style="font-size: 12px;">{{ __('Facebook') }}</a>
                                <a href="{{ route('login.google') }}" class="text-center w-1/4 mx-1 p-2 font-bold text-white bg-red-600 rounded focus:outline-none hover:bg-red-800" style="font-size: 12px;">{{ __('Google') }}</a>
                                <button type="button" class="w-1/4 mx-1 p-2 font-bold text-white bg-blue-800 rounded focus:outline-none hover:bg-blue-900" style="font-size: 12px;">{{ __('LinkedIn') }}</button>
                                <button type="button" class="w-1/4 mx-1 p-2 font-bold text-white bg-blue-500 rounded focus:outline-none hover:bg-blue-900" style="font-size: 12px;">{{ __('Twitter') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-12 md:mb-10 text-sm font-display font-semibold text-gray-700 text-center">{{ __('Already have an account?') }} <a href="{{ route('site.login') }}" class="cursor-pointer text-green-500 hover:text-indigo-800">{{ __('Login') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @php
        $uppercase = $lowercase = $number = $symbol = $length = 0;
        if(env('PASSWORD_STRENGTH') != null && env('PASSWORD_STRENGTH') != '') {
            $length = filter_var(env('PASSWORD_STRENGTH'), FILTER_SANITIZE_NUMBER_INT);
            $conditions = explode('|', env('PASSWORD_STRENGTH'));
            $uppercase = in_array("UPPERCASE", $conditions);
            $lowercase = in_array("LOWERCASE", $conditions);
            $number = in_array("NUMBERS", $conditions);
            $symbol = in_array("SYMBOLS", $conditions);
        }

    @endphp
@endsection

@section('js')
    <script>
        var uppercase = "{!! $uppercase !!}";
        var lowercase = "{!! $lowercase !!}";
        var number = "{!! $number !!}";
        var symbol = "{!! $symbol !!}";
        var length = "{!! $length !!}";
    </script>
    <script src="{{ asset('/public/dist/js/custom/site/password-validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/common.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/sweet-alert2.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/site/sign_up.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
