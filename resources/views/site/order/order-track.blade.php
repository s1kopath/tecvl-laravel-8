@extends('../site/layouts.app')

@section('page_title', __('Order Track'))
@section('content')

    <div class="mt-12 flex justify-center">
        <form class="w-4/12" action="{{ route('site.trackOrder') }}" method="POST">
            @csrf
            <div class="">
                <label class="block text-gray-500 mb-2" for="order">
                    {{ __('Order number') }}
                </label>

                <div class="flex">
                    <input type="text"
                        name="reference"
                        class="rounded-none rounded-l-lg outline-none bg-gray-50 border text-gray-900 focus:ring-green-500 focus:border-green-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="Enter your order number"
                        required>
                    <button type="submit" class="inline-flex items-center px-3 rounded-r text-sm bg-green-500 text-white hover:text-white hover:bg-green-600 font-semibold duration-200">
                        {{ __('Go') }}
                    </button>
                </div>
                @if (request()->isMethod('post') && !isset($order))
                    <span class="text-sm text-red-500">{{ __('Order number is invalid.') }}</span>
                @endif
            </div>
        </form>
    </div>
    @if (request()->isMethod('post') && isset($order))
    <!-- Order Status start -->
        @php
            if (count($orderStatus) <= 2) {
                $display = 'w-4/12';
            } else if (count($orderStatus) <= 3) {
                $display = 'w-6/12';
            } else if (count($orderStatus) <= 4) {
                $display = 'w-8/12';
            } else {
                $display = 'w-full';
            }
        @endphp
        <div class="mt-12 flex justify-center items-center">
            <div class="flex lg:{{ $display }} w-full">
                @foreach ($orderStatus as $key => $status)
                    @if($order->is_delivery == 1)
                        @if($status->order_by <=  optional($order->orderStatus)->order_by)
                    <div class="w-3/12">
                        <div class="relative">
                            @php
                                $active = $order->orderStatus->order_by >= $status->order_by ? true : false;
                                $orderDate = $status->orderHistories()->latest()->first();
                                if ($loop->first) {
                                    $class = 'w-1/2 right-0';
                                } else if ($loop->last || $status->order_by == optional($order->orderStatus)->order_by) {
                                    $class = 'w-1/2 left-0';
                                } else {
                                    $class = 'w-full';
                                }
                            @endphp

                            <span class="h-10 w-10 lg:h-12 lg:w-12 mx-auto border-solid border-2 md:border-4 border-white dark:border-gray-2 flex items-center justify-center {{ $active ? 'bg-green-500' : 'bg-gray-500' }} rounded-full mb-3 z-10 relative">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="text-white h-6 w-6" height="50" width="50" xmlns="http://www.w3.org/2000/svg"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                                </svg>
                            </span>
                            <div class="absolute {{ $class }} top-1/2 h-1 {{ $active ? 'bg-green-500' : 'bg-gray-500' }}"></div>
                        </div>
                        <p class="text-xs lg:text-base text-center dark:text-gray-2">{{ $status->name }}</p>

                        <p class="text-center text-xs text-gray-500">
                            @if (!empty($orderDate) && $active)
                                {{ timeZonegetTime($orderDate->created_at) }}<br>
                                {{ timeZoneformatDate($orderDate->created_at) }}
                            @endif
                        </p>
                    </div>
                        @endif
                    @else
                        <div class="w-3/12">
                            <div class="relative">
                                @php
                                    $active = $order->orderStatus->order_by >= $status->order_by ? true : false;
                                    $orderDate = $status->orderHistories()->latest()->first();
                                    if ($loop->first) {
                                        $class = 'w-1/2 right-0';
                                    } else if ($loop->last) {
                                        $class = 'w-1/2 left-0';
                                    } else {
                                        $class = 'w-full';
                                    }
                                @endphp

                                <span class="h-10 w-10 lg:h-12 lg:w-12 mx-auto border-solid border-2 md:border-4 border-white dark:border-gray-2 flex items-center justify-center {{ $active ? 'bg-green-500' : 'bg-gray-500' }} rounded-full mb-3 z-10 relative">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="text-white h-6 w-6" height="50" width="50" xmlns="http://www.w3.org/2000/svg"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                                </svg>
                            </span>
                                <div class="absolute {{ $class }} top-1/2 h-1 {{ $active ? 'bg-green-500' : 'bg-gray-500' }}"></div>
                            </div>
                            <p class="text-xs lg:text-base text-center dark:text-gray-2">{{ $status->name }}</p>

                            <p class="text-center text-xs text-gray-500">
                                @if (!empty($orderDate) && $active)
                                    {{ timeZonegetTime($orderDate->created_at) }}<br>
                                    {{ timeZoneformatDate($orderDate->created_at) }}
                                @endif
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    <!-- Order status end -->
    @endif

    @include('../site/layouts/partials.product_section')
@endsection

