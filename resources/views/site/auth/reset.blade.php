@extends('../site/layouts.app')
@section('page_title', __('Reset Password'))
@section('content')
    <div class="lg:flex" id="login-container">
        <div class="hidden lg:flex items-center justify-center bg-green-50 color_switch_log flex-1 h-screen">
            @include('../site/layouts/partials.login_signup_bac')
        </div>

        <div class="lg:w-1/2 xl:max-w-screen-sm">

            <div class="mt-10 px-12 sm:px-10 md:px-48 lg:px-12  xl:px-24 xl:max-w-2xl">
                <h2 class="text-center  font-display font-semibold lg:text-left sm:text-xl md:text-2xl lg:text-3xl md: 2xl:text-5xl
            xl:text-bold text-green-500">{{ __('Reset Password') }}</h2>
                <div class="mt-12 lg:mt-6 2xl:mt-12">
                    <form method="post" action="{{ route('site.password.resets') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-md font-bold text-gray-700 tracking-wide require">
                                    {{ __('Password') }}
                                </div>
                            </div>
                            <input class="form-control w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" type="password" id="password" name="password" placeholder="{{ __('Enter Your :?', ['?' => __('Password')]) }}"  required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':? should contain atleast :x characters.', ['?' => __('Password'), 'x' => 5]) }}">
                            <span class="password-validation-error text-sm text-red-600"></span>
                            <span id="CheckPasswordMatch"></span>
                        </div>

                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-md font-bold text-gray-700 tracking-wide require">
                                    {{ __('Confirm Password') }}
                                </div>
                            </div>
                            <input class="form-control w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 password-validation" type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Enter Your :?', ['?' => __('Confirm Password')]) }}"  required minlength="5" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-min-length="{{ __(':? should contain atleast :x characters.', ['?' => __('Password'), 'x' => 5]) }}">
                        </div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        @endif
                        @foreach (['success', 'fail'] as $msg)
                            @if($message = Session::get($msg))
                                <strong class="{{ $msg == 'fail' ? 'text-red-500' : 'text-green-400' }}">{{ $message }}</strong>
                                @break
                            @endif
                        @endforeach
                        <div class="mt-10">
                            <button type="submit" class="bg-green-500 text-white color_switch_bac color_switch_hover p-2 2xl:p-4 w-full rounded-full tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-green-600
                                shadow-lg">
                                {{ __('Reset Password') }}
                            </button>
                        </div>

                    </form>
                    <div class="mt-12 md:mb-10 text-sm font-display font-semibold text-gray-700 text-center">{{ __('Already have an account?') }} <button class="cursor-pointer text-green-500 hover:text-indigo-800 open-login-modal">{{ __('Login') }}</button>
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
    <script src="{{ asset('public/dist/js/custom/site/login.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
