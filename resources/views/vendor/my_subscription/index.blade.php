@extends('vendor.layouts.app')
@section('page_title', __('My Subscription'))
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="my_subscription-container">
  <div class="card">
    <div class="card-header">
        <h5><a href="#"></a>{{ __('My Subscription') }}</h5>
    </div>
    <div class="card-body p-0">
        <div class="row no-gutters">
            @if ($subscriptions->count() > 0)
                @foreach($subscriptions as $subscription)

                    <div class="col-sm-8 p-3 border-bottom">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="text-light-gray font-bold">{{ ucfirst($subscription->package->name) }} <span class="{{ $subscription->status == 'active' ? 'btn-green' : 'btn-red' }} ml-2 text-light">{{ __(ucfirst($subscription->status)) }}</span></h4>
                                        <p>{{ __('Package code') }}: <span class="font-bold">{{ $subscription->package->code }}</span></p>
                                    </div>
                                    <div>
                                        <div class="">
                                            <label for="" class="cr mr-3 text-light {{ $subscription->is_renewed == 1 ? 'btn-green' : 'btn-red' }}">{{ $subscription->is_renewed == 1 ? __('Renewed') : __('Not renewed') }}</label>
                                        </div>
                                        <div class="">
                                            <label for="" class="cr mr-3 text-light {{ $subscription->is_customized == 1 ? 'btn-green' : 'btn-red' }}">{{ $subscription->is_customized == 1 ? __('Customized') : __('Not customized') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="mr-4">
                                        <p class="font-14 m-0">{{ __('Started On') }}</p>
                                        <p class="text-light-gray font-14 font-bold mt-1">{{ timeZoneformatDate($subscription->billing_date) }}</p>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-14 m-0">{{ __('Next Renew') }}</p>
                                        <p class="text-light-gray font-14 font-bold mt-1">{{ timeZoneformatDate($subscription->next_billing_date) }}</p>
                                    </div>
                                    <div class="mx-4">
                                        <p class="font-14 m-0">{{ __('Billing Cycle') }}</p>
                                        <p class="text-light-gray font-14 font-bold mt-1">{{ ucfirst($subscription->billing_cycle) }}</p>
                                    </div>
                                    <div class="mx-4">
                                        <p class="font-14 m-0">{{ __('Price') }}</p>
                                        <p class="text-light-gray font-14 font-bold mt-1">{{ $subscription->package->price == 0 ? __('Free') : '$' . number_format((float)$subscription->package->price, $digit['decimal_digits'], '.', '') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 bg-gray border bt-0 d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            @if ($subscription->is_renewed == 0 && $subscription->package->price > 0)
                                <a href="#" class="btn btn-primary d-block font-bold custom-btn-small bg-light-blue mb-2">{{ __('Renew Package') }}</a>
                            @elseif ($subscription->is_renewed == 1 && $subscription->package->price > 0)
                            <button type="button" data-toggle="modal" data-target="#cancel-{{ $subscription->id }}" class="btn btn-primarybtn btn-danger d-block font-bold custom-btn-small bg-light-red mb-2">{{ __('Cancel Package') }}</button>
                            <div class="modal fade" id="cancel-{{ $subscription->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <form action="{{ url('vendor/my-subscription/cancel/' . $subscription->id) }} method='GET'">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">{{ __('Cancel') . ' ' . $subscription->package->name . ' ' . __('Package') }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="form-group text-left">
                                                <label class="control-label require" for="">{{ __('To cancel this subscription, please enter your password.') }}</label>
                                                <input type="password" class="form-control" name="password" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Cancel Package') }}</button>
                                      </div>
                                  </div>
                                </div>
                                </form>
                            </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 p-3">
                    <h3 class="text-red text-center">{{ __('You have not subscribed any package') }}</h3>
                </div>
            @endif
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
        <h5>{{ __('Upgrade your next package') }}</h5>
    </div>
    <div class="card-body p-0">
        @foreach($packages as $key => $package)
        @if ($package->price > 0)
            <div class="row no-gutters">
                <div class="col-12 p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-4">
                            <div class="d-flex">
                                <h4 class="text-light-gray font-bold d-inline">{{ ucfirst($package->name) }} </h4>
                                <span data-toggle="modal" data-target="#package-{{ $key }}" class="information ml-1"><img src="{{ asset('public/dist/img/info-btn.png') }}" alt=""></span>
                            </div>
                            <p class="mb-0">{{ __('Package code') }}: <span class="font-bold">{{ $package->code }}</span></p>
                        </div>
                        <p class="text-dark font-14 font-bold mt-1">{{ $package->price == 0 ? __('Free') : '$' . number_format((float)$package->price, $digit['decimal_digits'], '.', '') }} / <span class="text-light-gray">{{ $package->billing_cycle }}</span></p>

                        <a href="#" class="btn btn-primary d-block font-bold bg-light-blue custom-btn-small disabled">{{ __('Upgrade now') }}</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="package-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">{{ $package->name . ' ' . __('Package description') }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      {{ $package->description }}
                    </div>
                  </div>
                </div>
            </div>
        @endif
        @endforeach
        @if (count($packages) == 0)
            <h4 class="text-center py-4 text-red">{{ __('Sorry! There are no available package.') }}</h4>
        @endif
    </div>
  </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/shops.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection

