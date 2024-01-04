<!--Overlay Effect-->
<div class="fixed hidden items-center inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="my-modal">
    <!--modal content-->
    <div class="relative mx-5 sm:mx-auto px-2 py-8 md:px-10 md:py-10 pt-5 border w-540px rounded-lg bg-white modal-h" id="modal-main" >
        <div id="tabs" class="c-tabs mt-4">
            <div class="grid grid-cols-2 text-center text-gray-10 text-lg">
                <div class="c-tabs-nav login-active-border active-border">
                    <a href="javaScript:void(0);" class="is-active block login-active dm-bold font-bold">{{ __('Sign In') }}</a>
               </div>
               <div class="c-tabs-nav register-active-border">
                    <a href="javaScript:void(0);" class="register-active block dm-bold font-bold">{{ __('Sign Up') }}</a>
                    <div class="c-tab-nav-marker"></div>
                </div>
            </div>

            <div class="c-tab is-active mt-3 login-active">
                <div class="c-tab__content">
                    <div class="">
                        <div class="login-message p-3 block relative">
                           <!-- login failed or successful message comimg from login js -->
                        </div>
                        <form method="post" action="" id="loginForm">
                            @csrf

                            <div class="mb-6 relative">
                                <input class="w-full border border-gray-2 rounded form-control py-4 pl-16 roboto-regular font-normal text-gray-12" type="email" id="login-email" name="email" placeholder="{{ __('Email Address') }}"  required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}">
                                <span class="absolute top-3.5 left-3 border-r h-8 border-gray-2 pl-1.5 pr-3">
                                    <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                        <path d="M16.3449 17.4054C16.8977 17.2902 17.2269 16.7117 16.9522 16.2183C16.3466 15.1307 15.3926 14.1749 14.1722 13.4465C12.6004 12.5085 10.6745 12 8.69333 12C6.71213 12 4.78628 12.5085 3.21448 13.4465C1.99405 14.1749 1.04002 15.1307 0.434441 16.2183C0.159743 16.7117 0.488979 17.2902 1.04179 17.4054C6.0886 18.4572 11.2981 18.4572 16.3449 17.4054Z" fill="#898989"/>
                                        <circle cx="8.69336" cy="5" r="5" fill="#898989"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="mb-3 relative password-container">
                                <input  class="password-field w-full border border-gray-2  rounded form-control py-4 pl-16 md:pr-12 roboto-regular font-normal text-gray-12" type="password" name="password" id="login-password" placeholder="{{ __('Password') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                <span class="absolute top-3.5 left-3 h-8  border-r border-gray-2 pl-1.5 pr-3">
                                    <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5C4 2.23858 6.23858 0 9 0C11.7614 0 14 2.23858 14 5V6C14 6.55228 13.5523 7 13 7C12.4477 7 12 6.55228 12 6V5C12 3.34315 10.6569 2 9 2C7.34315 2 6 3.34315 6 5V6C6 6.55228 5.55228 7 5 7C4.44772 7 4 6.55228 4 6V5Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.87868 5.87868C0 6.75736 0 8.17157 0 11V12C0 15.7712 0 17.6569 1.17157 18.8284C2.34315 20 4.22876 20 8 20H10C13.7712 20 15.6569 20 16.8284 18.8284C18 17.6569 18 15.7712 18 12V11C18 8.17157 18 6.75736 17.1213 5.87868C16.2426 5 14.8284 5 12 5H6C3.17157 5 1.75736 5 0.87868 5.87868ZM9 13C9.55228 13 10 12.5523 10 12C10 11.4477 9.55228 11 9 11C8.44772 11 8 11.4477 8 12C8 12.5523 8.44772 13 9 13ZM12 12C12 13.3062 11.1652 14.4175 10 14.8293V17H8V14.8293C6.83481 14.4175 6 13.3062 6 12C6 10.3431 7.34315 9 9 9C10.6569 9 12 10.3431 12 12Z" fill="#898989"/>
                                    </svg>
                                </span>
                                <span  class="password-hide absolute top-3.5 right-1.5  h-8  pl-1.5 pr-3 cursor-pointer">
                                    <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="22" height="19" viewBox="0 0 22 19" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9803 18.3977L3.07666 1.49408L4.57074 0L21.4743 16.9036L19.9803 18.3977Z" fill="#C8C8C8"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9929 17.2707L14.4406 15.7184C13.4135 16.2565 12.3254 16.5941 11.2185 16.5941C9.60656 16.5941 8.03448 15.8782 6.63251 14.8696C5.2389 13.8669 4.1022 12.6384 3.38356 11.7659C3.27816 11.638 3.19943 11.5422 3.13422 11.458C3.08259 11.3914 3.04971 11.345 3.02826 11.3117C3.04971 11.2785 3.08259 11.232 3.13422 11.1654C3.19943 11.0812 3.27816 10.9854 3.38356 10.8575C4.08655 10.004 5.18959 8.80983 6.54184 7.81967L5.03242 6.31025C3.60813 7.39869 2.47352 8.63887 1.75261 9.51414C1.72769 9.54439 1.70172 9.5755 1.67499 9.60752L1.67497 9.60754C1.34384 10.0042 0.896484 10.54 0.896484 11.3117C0.896484 12.0834 1.34384 12.6192 1.67497 13.0159L1.6752 13.0161C1.70185 13.0481 1.72775 13.0791 1.75261 13.1093C2.53426 14.0583 3.80225 15.4363 5.39852 16.5847C6.98645 17.7272 8.98944 18.707 11.2185 18.707C12.9829 18.707 14.6055 18.0932 15.9929 17.2707ZM7.84501 4.6406C8.88436 4.20027 10.0187 3.91638 11.2185 3.91638C13.4476 3.91638 15.4506 4.89623 17.0385 6.03868C18.6348 7.18712 19.9028 8.56513 20.6845 9.51414C20.7094 9.54438 20.7353 9.57548 20.7621 9.60749L20.7621 9.60754C21.0932 10.0042 21.5406 10.54 21.5406 11.3117C21.5406 12.0834 21.0932 12.6192 20.7621 13.0159C20.7354 13.0479 20.7094 13.079 20.6845 13.1093C20.1703 13.7335 19.4458 14.5433 18.5558 15.3513L17.0597 13.8553C17.8837 13.1162 18.5651 12.3589 19.0535 11.7659C19.1589 11.638 19.2376 11.5422 19.3028 11.458C19.3545 11.3914 19.3874 11.345 19.4088 11.3117C19.3873 11.2784 19.3545 11.232 19.3028 11.1654C19.2376 11.0812 19.1589 10.9854 19.0535 10.8575C18.3349 9.98496 17.1982 8.7565 15.8045 7.75385C14.4026 6.7452 12.8305 6.02933 11.2185 6.02933C10.6364 6.02933 10.0595 6.12269 9.49389 6.28948L7.84501 4.6406Z" fill="#C8C8C8"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3602 12.1556C15.4155 11.8829 15.4445 11.6007 15.4445 11.3117C15.4445 8.97781 13.5525 7.08582 11.2186 7.08582C10.9296 7.08582 10.6473 7.11483 10.3746 7.17009L15.3602 12.1556ZM7.69709 8.97478C7.25201 9.64413 6.99268 10.4476 6.99268 11.3117C6.99268 13.6456 8.88468 15.5376 11.2186 15.5376C12.0827 15.5376 12.8862 15.2783 13.5555 14.8332L11.9984 13.2761C11.7571 13.372 11.494 13.4247 11.2186 13.4247C10.0516 13.4247 9.10562 12.4787 9.10562 11.3117C9.10562 11.0363 9.15833 10.7732 9.25419 10.5319L7.69709 8.97478Z" fill="#C8C8C8"/>
                                    </svg>
                                </span>
                                <span  class="password-show absolute top-3.5 right-1.5 h-8  pl-1.5 pr-3 cursor-pointer hidden">
                                    <svg class="mt-2.5" xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.77051 9C10.8751 9 11.7705 8.10457 11.7705 7C11.7705 5.89543 10.8751 5 9.77051 5C8.66594 5 7.77051 5.89543 7.77051 7C7.77051 8.10457 8.66594 9 9.77051 9ZM9.77051 11C11.9796 11 13.7705 9.20914 13.7705 7C13.7705 4.79086 11.9796 3 9.77051 3C7.56137 3 5.77051 4.79086 5.77051 7C5.77051 9.20914 7.56137 11 9.77051 11Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.42941 3.63233C4.11029 4.58138 3.03435 5.74418 2.35413 6.57005C2.25436 6.69118 2.17984 6.78179 2.11811 6.86149C2.06925 6.92459 2.03813 6.96852 2.01782 7C2.03813 7.03148 2.06925 7.07541 2.11811 7.13851C2.17984 7.21821 2.25436 7.30882 2.35413 7.42995C3.03435 8.25582 4.11029 9.41862 5.42941 10.3677C6.75643 11.3224 8.24447 12 9.77027 12C11.2961 12 12.7841 11.3224 14.1111 10.3677C15.4303 9.41862 16.5062 8.25582 17.1864 7.42995C17.2862 7.30882 17.3607 7.21821 17.4224 7.13851C17.4713 7.07541 17.5024 7.03147 17.5227 7C17.5024 6.96852 17.4713 6.92458 17.4224 6.86149C17.3607 6.78179 17.2862 6.69118 17.1864 6.57005C16.5062 5.74418 15.4303 4.58138 14.1111 3.63233C12.7841 2.6776 11.2961 2 9.77027 2C8.24447 2 6.75643 2.6776 5.42941 3.63233ZM4.26138 2.00884C5.76442 0.927471 7.66034 0 9.77027 0C11.8802 0 13.7761 0.927472 15.2792 2.00885C16.7901 3.0959 17.9903 4.40025 18.7302 5.29853C18.7538 5.32717 18.7784 5.35662 18.8037 5.38694C19.1171 5.76236 19.5406 6.26957 19.5406 7C19.5406 7.73043 19.1171 8.23764 18.8037 8.61306C18.7784 8.64338 18.7538 8.67283 18.7302 8.70148C17.9903 9.59976 16.7901 10.9041 15.2792 11.9912C13.7761 13.0725 11.8802 14 9.77027 14C7.66034 14 5.76442 13.0725 4.26138 11.9912C2.75044 10.9041 1.55022 9.59975 0.810357 8.70147C0.786765 8.67283 0.762175 8.64338 0.736868 8.61306C0.423444 8.23764 -5.96046e-08 7.73043 0 7C0 6.26957 0.423445 5.76236 0.736869 5.38694C0.762176 5.35662 0.786766 5.32717 0.810358 5.29852C1.55022 4.40024 2.75044 3.0959 4.26138 2.00884Z" fill="#898989"/>
                                    </svg>
                                </span>
                            </div>

                            <div class="mb-4 mt-6 flex justify-between">
                                <div class="form-check">
                                    <input id="flexCheckDefault" class="form-check-input -mt-1 mr-1 h-19p w-19p border border-gray-10 form-checkbox cursor-pointer" type="checkbox" name="remember_me" id="">
                                    <label class="form-check-label roboto-medium font-medium text-gray-10  cursor-pointer" for="flexCheckDefault">{{ __('Remember Me') }}</label>
                                </div>
                                <div>
                                    <a href="{{ route('site.login.reset') }}" class="roboto-medium font-medium text-gray-10 hover:text-gray-12">{{ __('Forgot password?') }}</a>
                                </div>
                            </div>
                            @if (isRecaptchaActive())
                                <div class="mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    <span class="text-red-500 text-sm login-captcha-error-message"></span>
                                </div>
                            @endif

                            <div class="mb-4 mt-5">
                                <button class="bg-gray-12 text-white text-xl dm-bold font-bold text-center w-full p-2 py-4 rounded transition ease-in-out duration-200 hover:bg-yellow-1 hover:text-gray-12">
                                    {{ strtoupper(__('Sign In')) }}
                                    <svg role="status" class="hidden ml-4 -mt-2 w-5 h-5 text-gray-50 animate-spin dark:text-gray-600 login-modal-loader" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#00f"/>
                                    </svg>
                                </button>
                            </div>
                            @php
                                $preference = json_decode(preference("sso_service"));
                            @endphp
                            @if(is_array($preference) && count($preference) > 0)
                            <div class="mb-4 mt-7 text-lg flex items-center">
                                <hr class="border border-gray-2 w-103p">

                                <p class="roboto-medium font-medium text-gray-10 text-center px-5">{{ __('Sign in with other account') }}</p>

                                <hr class="border border-gray-2 w-103p">
                            </div>
                            <div class="flex mr-5 space-x-5 justify-center md:justify-between mt-6">
                                @if(in_array("Google", $preference))
                                <a href="{{ route('login.google') }}" class="flex justify-center items-center rounded px-2 md:px-60p transition ease-in-out duration-200 bg-reds-1 hover:bg-reds-4">
                                    <span class="mr-2.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                                <path d="M9.34166 7.44167V11.4H14.725C13.9333 13.5375 11.875 14.9625 9.5 14.9625C6.4125 14.9625 3.95833 12.5083 3.95833 9.42083C3.95833 6.33333 6.4125 3.87916 9.5 3.87916C10.6875 3.87916 11.7958 4.275 12.7458 4.90833L13.0625 5.14583L15.4375 2.05833L15.1208 1.82083C13.4583 0.633333 11.5583 0 9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5V7.52083H9.34166V7.44167Z" fill="white"/>
                                            </svg>
                                    </span>
                                    <span class="roboto-medium font-medium text-lg text-white py-2 md:py-4 relative rounded">
                                        {{ __('Google') }}
                                    </span>
                                </a>
                                @endif
                                    @if(in_array("Facebook", $preference))
                                <a href="{{ route('login.facebook') }}" class="flex justify-center items-center px-2 md:px-60p rounded transition ease-in-out duration-200 bg-blues-2 hover:bg-blues-3">
                                    <span class="mr-2.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M19 3.15026C19 1.47668 17.5233 0 15.8497 0H3.15026C1.47668 0 0 1.47668 0 3.15026V15.8497C0 17.5233 1.47668 19 3.15026 19H9.54922V11.8135H7.18653V8.66321H9.54922V7.38342C9.54922 5.21762 11.1244 3.34714 13.0933 3.34714H15.6529V6.4974H13.0933C12.7979 6.4974 12.5026 6.79275 12.5026 7.38342V8.66321H15.6529V11.8135H12.5026V19H15.8497C17.5233 19 19 17.5233 19 15.8497V3.15026Z" fill="white"/>
                                        </svg>
                                    </span>
                                    <span class="roboto-medium font-medium text-lg text-white py-2 md:py-4 relative rounded">
                                        {{ __('Facebook') }}
                                    </span>
                                </a>
                                    @endif
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- Registration --}}
            <div class="c-tab mt-8 register-active">
                <div class="c-tab__content">
                    <div class="">
                        <form action="" method="post" id="password-validate-submit">
                            @csrf
                            <div class="mb-3">
                                <a href="{{ route('login.google') }}" class="flex items-center justify-center rounded bg-reds-1 transition ease-in-out duration-200 hover:bg-reds-4">
                                    <span class="ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <rect width="44" height="44" rx="2" fill="white"/>
                                            <path d="M33.0001 22.4739C33.0001 21.551 32.9252 20.8775 32.7632 20.1791H22.2246V24.3446H28.4105C28.2858 25.3798 27.6124 26.9388 26.1157 27.9863L26.0948 28.1258L29.4269 30.7071L29.6577 30.7302C31.7779 28.7721 33.0001 25.8911 33.0001 22.4739Z" fill="#4285F4"/>
                                            <path d="M22.2245 33.4489C25.2551 33.4489 27.7993 32.4511 29.6576 30.7301L26.1156 27.9863C25.1678 28.6473 23.8957 29.1087 22.2245 29.1087C19.2563 29.1087 16.737 27.1507 15.839 24.4444L15.7073 24.4556L12.2426 27.137L12.1973 27.2629C14.0431 30.9296 17.8344 33.4489 22.2245 33.4489Z" fill="#34A853"/>
                                            <path d="M15.839 24.4444C15.602 23.746 15.4649 22.9977 15.4649 22.2245C15.4649 21.4512 15.602 20.7029 15.8265 20.0045L15.8202 19.8558L12.312 17.1313L12.1973 17.1859C11.4365 18.7074 11 20.4161 11 22.2245C11 24.0329 11.4365 25.7414 12.1973 27.263L15.839 24.4444Z" fill="#FBBC05"/>
                                            <path d="M22.2245 15.3401C24.3322 15.3401 25.7539 16.2505 26.5646 17.0114L29.7324 13.9184C27.7869 12.11 25.2551 11 22.2245 11C17.8344 11 14.0431 13.5193 12.1973 17.1859L15.8265 20.0045C16.737 17.2982 19.2563 15.3401 22.2245 15.3401Z" fill="#EB4335"/>
                                        </svg>
                                    </span>
                                    <span  class="roboto-medium font-medium text-lg text-white p-2 py-4 pl-18p w-full block">{{ __('One-Click account create with Google') }}</span>
                                </a>
                           </div>
                            <div class="mb-3">
                                <a href="{{ route('login.facebook') }}" class="flex items-center justify-center rounded transition ease-in-out duration-200 hover:bg-blues-3 bg-blues-2">
                                    <span class="ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <rect width="44" height="44" rx="2" fill="white"/>
                                            <path d="M23.789 33.9999V23.5085H27.3269L27.8566 19.4198H23.789V16.8093C23.789 15.6256 24.1192 14.8188 25.8248 14.8188L28 14.8178V11.1609C27.6236 11.1113 26.3325 11 24.8304 11C21.6942 11 19.5471 12.9053 19.5471 16.4046V19.4199H16V23.5086H19.547V34L23.789 33.9999Z" fill="#3C5A9A"/>
                                        </svg>
                                    </span>
                                    <span class="roboto-medium font-medium text-lg text-white  p-2 py-4 pl-18p w-full block">{{ __('One-Click account create with Facebook') }}<span>
                                </a>
                           </div>
                            <div class="mb-6 mt-6">
                                <h2 class="text-center dm-bold text-gray-12 text-2xl font-bold">{{ __('Fill in Information') }}</h2>
                            </div>
                            <div class="mb-5 relative">
                               <input class="w-full border border-gray-2 rounded form-control py-4 pl-16 roboto-regular font-normal text-gray-12 registration-name" type="text" name="name" placeholder="{{ __('Your Name') }}">
                                <span class="absolute top-3.5 left-3 border-r h-8 border-gray-2 pl-1.5 pr-3">
                                    <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                        <path d="M16.3449 17.4054C16.8977 17.2902 17.2269 16.7117 16.9522 16.2183C16.3466 15.1307 15.3926 14.1749 14.1722 13.4465C12.6004 12.5085 10.6745 12 8.69333 12C6.71213 12 4.78628 12.5085 3.21448 13.4465C1.99405 14.1749 1.04002 15.1307 0.434441 16.2183C0.159743 16.7117 0.488979 17.2902 1.04179 17.4054C6.0886 18.4572 11.2981 18.4572 16.3449 17.4054Z" fill="#898989"/>
                                        <circle cx="8.69336" cy="5" r="5" fill="#898989"/>
                                    </svg>
                                </span>
                                <span class="name-validation-error block text-red-500 text-sm mt-1"></span>
                            </div>
                            <div class="mb-5 relative">
                               <input class="w-full border border-gray-2 rounded form-control py-4 pl-16 roboto-regular font-normal text-gray-12 registration-email" type="email"  name="email" placeholder="{{ __('Email Address') }}" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                <span class="absolute top-3.5 left-3 border-r h-8 border-gray-2 pl-1.5 pr-3">
                                    <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.87868 0.87868C0 1.75736 0 3.17157 0 6V8C0 10.8284 0 12.2426 0.87868 13.1213C1.75736 14 3.17157 14 6 14H12C14.8284 14 16.2426 14 17.1213 13.1213C18 12.2426 18 10.8284 18 8V6C18 3.17157 18 1.75736 17.1213 0.87868C16.2426 0 14.8284 0 12 0H6C3.17157 0 1.75736 0 0.87868 0.87868ZM3.5547 3.16795C3.09517 2.8616 2.4743 2.98577 2.16795 3.4453C1.8616 3.90483 1.98577 4.5257 2.4453 4.83205L7.8906 8.46225C8.5624 8.91012 9.4376 8.91012 10.1094 8.46225L15.5547 4.83205C16.0142 4.5257 16.1384 3.90483 15.8321 3.4453C15.5257 2.98577 14.9048 2.8616 14.4453 3.16795L9 6.79815L3.5547 3.16795Z" fill="#898989"/>
                                    </svg>
                                </span>
                                <span class="email-validation-error block text-red-500 text-sm mt-1"></span>
                            </div>

                            <div class="mb-5 relative password-container">
                                <input class="password-field w-full border border-gray-2  rounded form-control py-4 pl-16 pr-12 roboto-regular font-normal text-gray-12 password-validation" type="password" id="password" name="password" placeholder="{{ __('Password') }}" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                <span class="absolute top-3.5 left-3 h-8  border-r border-gray-2 pl-1.5 pr-3">
                                   <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.87868 9.11904C0 9.99772 0 11.4119 0 14.2404V15.2404C0 19.0116 0 20.8972 1.17157 22.0688C2.34315 23.2404 4.22876 23.2404 8 23.2404H10C13.7712 23.2404 15.6569 23.2404 16.8284 22.0688C18 20.8972 18 19.0116 18 15.2404V14.2404C18 11.4119 18 9.99772 17.1213 9.11904C16.2426 8.24036 14.8284 8.24036 12 8.24036H6C3.17157 8.24036 1.75736 8.24036 0.87868 9.11904ZM9 16.2404C9.55228 16.2404 10 15.7926 10 15.2404C10 14.6881 9.55228 14.2404 9 14.2404C8.44772 14.2404 8 14.6881 8 15.2404C8 15.7926 8.44772 16.2404 9 16.2404ZM12 15.2404C12 16.5466 11.1652 17.6578 10 18.0697V20.2404H8V18.0697C6.83481 17.6578 6 16.5466 6 15.2404C6 13.5835 7.34315 12.2404 9 12.2404C10.6569 12.2404 12 13.5835 12 15.2404Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.8978 3.9514C6.07928 2.06218 9.25455 1.86447 11.6535 3.4685L12.0273 3.71839C13.8931 4.96591 14.8551 7.19065 14.4862 9.40454L12.5134 9.07576C12.7531 7.63721 12.128 6.1916 10.9156 5.38099L10.5419 5.1311C8.89174 4.02777 6.70764 4.16376 5.2071 5.46326L4.32433 6.22776C3.90685 6.58931 3.27531 6.54397 2.91375 6.12648C2.5522 5.709 2.59754 5.07746 3.01503 4.7159L3.8978 3.9514Z" fill="#898989"/>
                                    </svg>
                                </span>
                                <span  class="password-hide absolute top-3.5 right-1.5  h-8  pl-1.5 pr-3 cursor-pointer">
                                     <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="22" height="19" viewBox="0 0 22 19" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9803 18.3977L3.07666 1.49408L4.57074 0L21.4743 16.9036L19.9803 18.3977Z" fill="#C8C8C8"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9929 17.2707L14.4406 15.7184C13.4135 16.2565 12.3254 16.5941 11.2185 16.5941C9.60656 16.5941 8.03448 15.8782 6.63251 14.8696C5.2389 13.8669 4.1022 12.6384 3.38356 11.7659C3.27816 11.638 3.19943 11.5422 3.13422 11.458C3.08259 11.3914 3.04971 11.345 3.02826 11.3117C3.04971 11.2785 3.08259 11.232 3.13422 11.1654C3.19943 11.0812 3.27816 10.9854 3.38356 10.8575C4.08655 10.004 5.18959 8.80983 6.54184 7.81967L5.03242 6.31025C3.60813 7.39869 2.47352 8.63887 1.75261 9.51414C1.72769 9.54439 1.70172 9.5755 1.67499 9.60752L1.67497 9.60754C1.34384 10.0042 0.896484 10.54 0.896484 11.3117C0.896484 12.0834 1.34384 12.6192 1.67497 13.0159L1.6752 13.0161C1.70185 13.0481 1.72775 13.0791 1.75261 13.1093C2.53426 14.0583 3.80225 15.4363 5.39852 16.5847C6.98645 17.7272 8.98944 18.707 11.2185 18.707C12.9829 18.707 14.6055 18.0932 15.9929 17.2707ZM7.84501 4.6406C8.88436 4.20027 10.0187 3.91638 11.2185 3.91638C13.4476 3.91638 15.4506 4.89623 17.0385 6.03868C18.6348 7.18712 19.9028 8.56513 20.6845 9.51414C20.7094 9.54438 20.7353 9.57548 20.7621 9.60749L20.7621 9.60754C21.0932 10.0042 21.5406 10.54 21.5406 11.3117C21.5406 12.0834 21.0932 12.6192 20.7621 13.0159C20.7354 13.0479 20.7094 13.079 20.6845 13.1093C20.1703 13.7335 19.4458 14.5433 18.5558 15.3513L17.0597 13.8553C17.8837 13.1162 18.5651 12.3589 19.0535 11.7659C19.1589 11.638 19.2376 11.5422 19.3028 11.458C19.3545 11.3914 19.3874 11.345 19.4088 11.3117C19.3873 11.2784 19.3545 11.232 19.3028 11.1654C19.2376 11.0812 19.1589 10.9854 19.0535 10.8575C18.3349 9.98496 17.1982 8.7565 15.8045 7.75385C14.4026 6.7452 12.8305 6.02933 11.2185 6.02933C10.6364 6.02933 10.0595 6.12269 9.49389 6.28948L7.84501 4.6406Z" fill="#C8C8C8"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3602 12.1556C15.4155 11.8829 15.4445 11.6007 15.4445 11.3117C15.4445 8.97781 13.5525 7.08582 11.2186 7.08582C10.9296 7.08582 10.6473 7.11483 10.3746 7.17009L15.3602 12.1556ZM7.69709 8.97478C7.25201 9.64413 6.99268 10.4476 6.99268 11.3117C6.99268 13.6456 8.88468 15.5376 11.2186 15.5376C12.0827 15.5376 12.8862 15.2783 13.5555 14.8332L11.9984 13.2761C11.7571 13.372 11.494 13.4247 11.2186 13.4247C10.0516 13.4247 9.10562 12.4787 9.10562 11.3117C9.10562 11.0363 9.15833 10.7732 9.25419 10.5319L7.69709 8.97478Z" fill="#C8C8C8"/>
                                    </svg>

                                </span>
                                <span  class="password-show absolute top-3.5 right-1.5 h-8  pl-1.5 pr-3 cursor-pointer hidden">
                                    <svg class="mt-2.5" xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.77051 9C10.8751 9 11.7705 8.10457 11.7705 7C11.7705 5.89543 10.8751 5 9.77051 5C8.66594 5 7.77051 5.89543 7.77051 7C7.77051 8.10457 8.66594 9 9.77051 9ZM9.77051 11C11.9796 11 13.7705 9.20914 13.7705 7C13.7705 4.79086 11.9796 3 9.77051 3C7.56137 3 5.77051 4.79086 5.77051 7C5.77051 9.20914 7.56137 11 9.77051 11Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.42941 3.63233C4.11029 4.58138 3.03435 5.74418 2.35413 6.57005C2.25436 6.69118 2.17984 6.78179 2.11811 6.86149C2.06925 6.92459 2.03813 6.96852 2.01782 7C2.03813 7.03148 2.06925 7.07541 2.11811 7.13851C2.17984 7.21821 2.25436 7.30882 2.35413 7.42995C3.03435 8.25582 4.11029 9.41862 5.42941 10.3677C6.75643 11.3224 8.24447 12 9.77027 12C11.2961 12 12.7841 11.3224 14.1111 10.3677C15.4303 9.41862 16.5062 8.25582 17.1864 7.42995C17.2862 7.30882 17.3607 7.21821 17.4224 7.13851C17.4713 7.07541 17.5024 7.03147 17.5227 7C17.5024 6.96852 17.4713 6.92458 17.4224 6.86149C17.3607 6.78179 17.2862 6.69118 17.1864 6.57005C16.5062 5.74418 15.4303 4.58138 14.1111 3.63233C12.7841 2.6776 11.2961 2 9.77027 2C8.24447 2 6.75643 2.6776 5.42941 3.63233ZM4.26138 2.00884C5.76442 0.927471 7.66034 0 9.77027 0C11.8802 0 13.7761 0.927472 15.2792 2.00885C16.7901 3.0959 17.9903 4.40025 18.7302 5.29853C18.7538 5.32717 18.7784 5.35662 18.8037 5.38694C19.1171 5.76236 19.5406 6.26957 19.5406 7C19.5406 7.73043 19.1171 8.23764 18.8037 8.61306C18.7784 8.64338 18.7538 8.67283 18.7302 8.70148C17.9903 9.59976 16.7901 10.9041 15.2792 11.9912C13.7761 13.0725 11.8802 14 9.77027 14C7.66034 14 5.76442 13.0725 4.26138 11.9912C2.75044 10.9041 1.55022 9.59975 0.810357 8.70147C0.786765 8.67283 0.762175 8.64338 0.736868 8.61306C0.423444 8.23764 -5.96046e-08 7.73043 0 7C0 6.26957 0.423445 5.76236 0.736869 5.38694C0.762176 5.35662 0.786766 5.32717 0.810358 5.29852C1.55022 4.40024 2.75044 3.0959 4.26138 2.00884Z" fill="#898989"/>
                                    </svg>
                                </span>
                                <span class="password-validation-error block text-sm mt-1"></span>
                            </div>

                            <div class="mb-5 relative password-container">
                                <input class="password-field w-full border border-gray-2 rounded form-control py-4 pl-16 pr-12 roboto-regular font-normal text-gray-12" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                                <span class="absolute top-3.5 left-3 h-8  border-r border-gray-2 pl-1.5 pr-3">
                                   <svg class="mt-1.5" xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5C4 2.23858 6.23858 0 9 0C11.7614 0 14 2.23858 14 5V6C14 6.55228 13.5523 7 13 7C12.4477 7 12 6.55228 12 6V5C12 3.34315 10.6569 2 9 2C7.34315 2 6 3.34315 6 5V6C6 6.55228 5.55228 7 5 7C4.44772 7 4 6.55228 4 6V5Z" fill="#898989"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.87868 5.87868C0 6.75736 0 8.17157 0 11V12C0 15.7712 0 17.6569 1.17157 18.8284C2.34315 20 4.22876 20 8 20H10C13.7712 20 15.6569 20 16.8284 18.8284C18 17.6569 18 15.7712 18 12V11C18 8.17157 18 6.75736 17.1213 5.87868C16.2426 5 14.8284 5 12 5H6C3.17157 5 1.75736 5 0.87868 5.87868ZM9 13C9.55228 13 10 12.5523 10 12C10 11.4477 9.55228 11 9 11C8.44772 11 8 11.4477 8 12C8 12.5523 8.44772 13 9 13ZM12 12C12 13.3062 11.1652 14.4175 10 14.8293V17H8V14.8293C6.83481 14.4175 6 13.3062 6 12C6 10.3431 7.34315 9 9 9C10.6569 9 12 10.3431 12 12Z" fill="#898989"/>
                                    </svg>
                                </span>
                                <span  class="password-matching absolute top-3.5 right-1.5 h-8  pl-1.5 pr-3 cursor-pointer hidden">
                                    <svg class="mt-2.5" xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3163 0.462473C17.5102 -0.242925 16.3121 -0.128557 15.6403 0.717921L8.80424 9.33189C8.14548 10.162 7.77515 10.6215 7.47948 10.9039C7.47564 10.9076 7.47188 10.9112 7.46818 10.9147C7.46419 10.9115 7.46013 10.9083 7.456 10.9051C7.13719 10.6519 6.72875 10.2295 6.00113 9.4654L3.2435 6.56972C2.5015 5.79059 1.29849 5.79059 0.556498 6.56972C-0.185497 7.34886 -0.185497 8.61209 0.556498 9.39123L3.31413 12.2869C3.34002 12.3141 3.36587 12.3412 3.39168 12.3684C4.01203 13.02 4.60881 13.6469 5.16407 14.0878C5.78606 14.5817 6.60062 15.0461 7.6445 14.9963C8.68838 14.9466 9.45955 14.4067 10.0364 13.8557C10.5514 13.3639 11.0916 12.6828 11.6532 11.9749C11.6766 11.9454 11.7 11.9159 11.7235 11.8864L18.5596 3.27239C19.2313 2.42592 19.1224 1.16787 18.3163 0.462473Z" fill="#33C172"/>
                                    </svg>
                                </span>
                                <span class="confirm-password-validation-error block text-red-500"></span>
                            </div>
                            @if (isRecaptchaActive())
                                <div class="mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    <span class="text-red-500 text-sm recaptcha-validation-error"></span>
                                </div>
                            @endif
                            <div class="mb-4 form-check">
                                <label class="roboto-medium font-medium text-gray-10 cursor-pointer" for="flexCheckDefault-1">
                                    {!! __("By clicking 'Create account' you are agreeing to our :x.", ['x' => "<a href='#' class='text-blues-2'>" .  __('terms & conditions')  . "</a>" ]) !!}
                                 </label>
                            </div>

                            <div>
                                <button class="bg-gray-12 hover:bg-yellow-1 hover:text-gray-12 dm-bold font-bold py-18p text-white text-center w-full p-2 rounded text-xl transition ease-in-out duration-200 " type="submit">
                                    {{ strtoupper(__('Create account')) }}
                                    <svg role="status" class="hidden ml-4 -mt-2 w-5 h-5 text-gray-50 animate-spin dark:text-gray-600 registration-modal-loader" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#00f"/>
                                    </svg>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-close-btn ml-1 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.455612 0.455612C1.06309 -0.151871 2.04802 -0.151871 2.6555 0.455612L11.9888 9.78895C12.5963 10.3964 12.5963 11.3814 11.9888 11.9888C11.3814 12.5963 10.3964 12.5963 9.78895 11.9888L0.455612 2.6555C-0.151871 2.04802 -0.151871 1.06309 0.455612 0.455612Z" fill="#898989"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9887 0.455612C11.3812 -0.151871 10.3963 -0.151871 9.78884 0.455612L0.455503 9.78895C-0.151979 10.3964 -0.151979 11.3814 0.455503 11.9888C1.06298 12.5963 2.04791 12.5963 2.65539 11.9888L11.9887 2.6555C12.5962 2.04802 12.5962 1.06309 11.9887 0.455612Z" fill="#898989"/>
            </svg>
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
<script>
    var uppercase = "{!! $uppercase !!}";
    var lowercase = "{!! $lowercase !!}";
    var number = "{!! $number !!}";
    var symbol = "{!! $symbol !!}";
    var length = "{!! $length !!}";
    var currentUrl = "{!! session('nextUrl') !!}";
    var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
    var otpUrl = "{!! route('site.verification.otp') !!}";
    var otpActive = "{!! \App\Models\User::userVerification('otp') !!}";
</script>
@php
    session()->put('nextUrl', null);
@endphp
<script src="{{ asset('/public/dist/js/custom/site/password-validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/login.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>

