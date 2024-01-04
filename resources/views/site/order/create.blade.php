@extends('../site/layouts.user_panel.app')
@section('content')
<div class="px-4 py-8 m-2">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-2">{{ __('My Addresses') }}</h2>
    </div>
    <div class="bg-white dark:bg-gray-600 p-8 rounded-lg shadow relative hover:shadow flex flex-wrap transition duration-500">
        <section class="">
            <h1 class="text-xl font-semibold border-b pb-2 mb-4 mr-4 text-gray-700 capitalize dark:text-white">
                {{ __('New Address') }}
            </h1>
            <form action="{{ route('site.addressStore') }}" method="post">
                @csrf
                <div class="flex flex-wrap w-full">
                    <div class="w-1/2">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="first_name">{{ __('First Name') }} <span class="text-red-500">*</span></label>
                            <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="last_name">{{ __('Last Name') }} <span class="text-red-500">*</span></label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') }}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>
                    </div>
                    <div class="w-full mt-5">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="address_1">{{ __('Street Address') }} <span class="text-red-500">*</span></label>
                            <div>
                                <input id="address_1" name="address_1" type="text" value="{{ old('address_1') }}" placeholder="{{ __('Address Line 1') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control"
                                required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                            </div>
                            <input id="address_2" name="address_2" type="text" value="{{ old('address_2') }}" placeholder="{{ __('Address Line 2') . ' (' . __('optional') . ')' }}" class="mt-5 block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="w-1/2 mt-5">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="city">{{ __('City') }} <span class="text-red-500">*</span></label>
                            <input id="city" name="city" type="text" value="{{ old('city') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>
                    </div>

                    <div class="w-1/2 mt-5">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="zip">{{ __('Postcode') . ' / ' . __('ZIP') }} <span class="text-red-500">*</span></label>
                            <input id="zip" name="zip" type="text" value="{{ old('zip') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control positive-int-number"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>
                    </div>
                    <div class="w-1/2 mt-5">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="country">{{ __('Country') }} <span class="text-red-500">*</span></label>
                            <select id="country" name="country" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-blue-500 focus:outline-none form-control"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                <option value="">{{ __('Select One') }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}" {{ old('country') == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-1/2 mt-5">
                        <div class="mr-4">
                            <label class="text-dark dark:text-gray-200" for="state">{{ __('State') . ' / ' . __('Province') }} <span class="text-red-500">*</span></label>
                            <input id="state" name="state" value="{{ old('state') }}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none form-control"
                            required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        </div>
                    </div>
                    @if ($addresses->count() > 0)
                    <div x-data="{value: '0', offValue: '0', onValue:'1'}">
                        <input type="hidden" name="is_default" x-bind:value="value">
                        <div class="flex mt-5">
                            <label class="text-dark dark:text-gray-200 mr-3">{{ __('Default') }} </label>
                            <div class="flex items-center  cursor-pointer cm-toggle-wrapper" x-on:click="value = (value == onValue ? offValue : onValue);">
                                <div class="rounded-full w-12 h-6 p-0.5 bg-gray-300 bg-purple-500" :class="{'bg-gray-300': value == offValue,'bg-purple-500': value == onValue}">
                                    <div class="rounded-full w-5 h-5 bg-white transform mx-auto duration-300 ease-in-out translate-x-2" :class="{'-translate-x-2': value == offValue,'translate-x-2': value == onValue}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="w-full my-6">
                    <a href="{{ route('site.address') }}" class="border rounded text-sm py-3 mr-3 px-8 border-purple-400 hover:bg-purple-500 hover:text-white font-semibold duration-200">{{ strtoupper(__('Cancel')) }}</a>
                    <button type="submit" class="border rounded text-sm py-3 px-8 border-purple-400 bg-purple-500 text-white hover:bg-purple-600 hover:text-gray-200 font-semibold duration-200">{{ strtoupper(__('Save')) }}</button>
                </div>
            </form>
        </section>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('/public/dist/js/custom/validation.min.js') }}"></script>
@endsection
