@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Package Subscription')]))
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection

@section('content')
  <div class="col-sm-12" id="package-subscription-edit-container">
    <div class="card">
      <div class="card-header">
        <h5><a href="{{ route('packageSubscription.index') }}">{{ __('Package Subscriptions') }}</a> >> {{ __('Edit :x', ['x' => __('Package Subscription')]) }}</h5>
      </div>

      <div class="card-body table-border-style" >
        <div class="form-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Subscription Information') }}</a>
            </li>
          </ul>
            <form action="{{ route('packageSubscription.update', ['id' => $subscription->id]) }}" method="post" id="packageSubscriptionUpdate" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card shadow-1">
                            <div class="card-body">
                                <div class="ml-0 mr-lg-2">
                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="name">{{ __('Name') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Name') }}" class="form-control" id="name" name="name" value="{{ !empty(old('name')) ? old('name') : $subscription->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="package_id">{{ __('Pacakge') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2 sl_common_bx" id="package_id" name="package_id" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach($packages as $package)
                                                    <option value="{{ $subscription->package_id }}" {{ old('package_id', $subscription->package_id) == $package->id ? 'selected' : ''}}>{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_cycle">{{ __('Billing Cycle') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2 sl_common_bx" id="billing_cycle" name="billing_cycle" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <option value="">{{ __('Select One') }}</option>
                                                <option value="monthly" {{ old('billing_cycle', $subscription->billing_cycle) == "monthly" ? 'selected' : '' }}>{{ __('Monthly') }}</option>
                                                <option value="yearly" {{ old('billing_cycle', $subscription->billing_cycle) == "yearly" ? 'selected' : '' }}>{{ __('Yearly') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="activation_date">{{ __('Activation Date') }}</label>
                                        <div class="input-group date col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-calendar-alt input-group-text"></i>
                                            </div>
                                            <input class="form-control" id="activation_date" type="text" name="activation_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('activation_date')) ? old('activation_date') : $subscription->activation_date }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_date">{{ __('Billing Date') }}</label>
                                        <div class="input-group date col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-calendar-alt input-group-text"></i>
                                            </div>
                                            <input class="form-control" id="billing_date" type="text" name="billing_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('billing_date')) ? old('billing_date') : $subscription->billing_date }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="next_billing_date">{{ __('Next Billing Date') }}</label>
                                        <div class="input-group date col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-calendar-alt input-group-text"></i>
                                            </div>
                                            <input class="form-control" id="next_billing_date" type="text" name="next_billing_date" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" value="{{ !empty(old('next_billing_date')) ? old('next_billing_date') : $subscription->next_billing_date }}">
                                        </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="payment_processor">{{ __('Payment Processor') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2 sl_common_bx" id="payment_processor" name="payment_processor" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach($payments as $payment)
                                                    <option value="{{ strtolower($payment->name) }}" {{ old('payment_processor', $subscription->payment_processor) == strtolower($payment->name) ? 'selected' : ''}}>{{ $payment->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="vendor_id">{{ __('Vendor') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2 sl_common_bx" id="vendor_id" name="vendor_id" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}" {{ old('vendor_id', $subscription->vendor_id) == $vendor->id ? 'selected' : ''}}>{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="transaction_order_number">{{ __('Transaction Order No') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Transaction Order No') }}" class="form-control" id="transaction_order_number" name="transaction_order_number" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('transaction_order_number')) ? old('transaction_order_number') : $subscription->transaction_order_number }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="transaction_invoice_id">{{ __('Transaction Invoice Id') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Transaction Invoice Id') }}" class="form-control" id="transaction_invoice_id" name="transaction_invoice_id" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('transaction_invoice_id')) ? old('transaction_invoice_id') : $subscription->transaction_invoice_id }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="transaction_reference">{{ __('Transaction Reference') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Transaction Reference') }}" class="form-control" id="transaction_reference" name="transaction_reference" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('transaction_reference')) ? old('transaction_reference') : $subscription->transaction_reference }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_price">{{ __('Billing Price') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" step="any" placeholder="{{ __('Billing Price') }}" class="form-control" id="billing_price" name="billing_price" required max="99999999" min="0" data-min="{{ __('This value must be greater than 0.') }}" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('billing_price')) ? old('billing_price') : number_format((float)$subscription->billing_price, $digit['decimal_digits'], '.', '') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="amount_billed">{{ __('Amount Billed') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" step="any" placeholder="{{ __('Amount Billed') }}" class="form-control" id="amount_billed" name="amount_billed" required max="99999999" min="0" data-min="{{ __('This value must be greater than 0.') }}" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('amount_billed')) ? old('amount_billed') : number_format((float)$subscription->amount_billed, $digit['decimal_digits'], '.', '') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="amount_received">{{ __('Amount Received') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" step="any" placeholder="{{ __('Amount Received') }}" class="form-control" id="amount_received" name="amount_received" required max="99999999" min="0" data-min="{{ __('This value must be greater than 0.') }}" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('amount_received')) ? old('amount_received') : number_format((float)$subscription->amount_received, $digit['decimal_digits'], '.', '') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="amount_due">{{ __('Amount Due') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" placeholder="{{ __('Amount Due') }}" class="form-control" id="amount_due" name="amount_due" required max="99999999" min="0" data-min="{{ __('This value must be greater than 0.') }}" data-max="{{ __('The value must be :x than or equal to :y.', ['x' => __('less'), 'y' => 99999999]) }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('amount_due')) ? old('amount_due') : number_format((float)$subscription->amount_due, $digit['decimal_digits'], '.', '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card shadow-1">
                            <div class="card-body">
                                <div class="ml-0 ml-lg-2">
                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_first_name">{{ __('Billing First Name') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing First Name') }}" class="form-control" id="billing_first_name" name="billing_first_name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('billing_first_name')) ? old('billing_first_name') : $subscription->billing_first_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_last_name">{{ __('Billing Last Name') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing Last Name') }}" class="form-control" id="billing_last_name" name="billing_last_name" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  value="{{ !empty(old('billing_last_name')) ? old('billing_last_name') : $subscription->billing_last_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_name">{{ __('Billing Name') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing Name') }}" class="form-control" id="billing_name" name="billing_name" value="{{ !empty(old('billing_name')) ? old('billing_name') : $subscription->billing_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="billing_email">{{ __('Billing Email') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="email" placeholder="{{ __('Billing Email') }}" class="form-control" id="billing_email" name="billing_email" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-type-mismatch="{{ __('Enter a valid :x.', [ 'x' => strtolower(__('Email'))]) }}"  value="{{ !empty(old('billing_email')) ? old('billing_email') : $subscription->billing_email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_phone">{{ __('Billing Phone') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing Phone') }}" class="form-control" id="billing_phone" name="billing_phone" value="{{ !empty(old('billing_phone')) ? old('billing_phone') : $subscription->billing_phone }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_country">{{ __('Billing Country') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2" id="billing_country" name="billing_country">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->name }}" {{ old('billing_country', $subscription->billing_country) == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_state">{{ __('Billing State') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing State') }}" class="form-control" id="billing_state" name="billing_state" value="{{ !empty(old('billing_state')) ? old('billing_state') : $subscription->billing_state }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_city">{{ __('Billing City') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing City') }}" class="form-control" id="billing_city" name="billing_city" value="{{ !empty(old('billing_city')) ? old('billing_city') : $subscription->billing_city }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_zip">{{ __('Billing Zip') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" placeholder="{{ __('Billing Zip') }}" class="form-control" id="billing_zip" name="billing_zip" value="{{ !empty(old('billing_zip')) ? old('billing_zip') : $subscription->billing_zip }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_street_address">{{ __('Billing Street Address') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing Street Address') }}" class="form-control" id="billing_street_address" name="billing_street_address" value="{{ !empty(old('billing_street_address')) ? old('billing_street_address') : $subscription->billing_street_address }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="billing_street_address2">{{ __('Billing Street Address 2') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="text" placeholder="{{ __('Billing Street Address 2') }}" class="form-control" id="billing_street_address2" name="billing_street_address2" value="{{ !empty(old('billing_street_address2')) ? old('billing_street_address2') : $subscription->billing_street_address2 }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="is_renewed">{{ __('Renewed?') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <div class="switch d-inline m-r-10">
                                                <input class="status" type="checkbox" value="1" name="is_renewed"  id="is_renewed" {{ $subscription->is_renewed == 1 ? 'checked' : '' }}>
                                                <label for="is_renewed" class="cr"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="is_customized">{{ __('Customized?') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <div class="switch d-inline m-r-10">
                                                <input class="status" type="checkbox" value="1" name="is_customized"  id="is_customized" {{ $subscription->is_customized == 1 ? 'checked' : '' }}>
                                                <label for="is_customized" class="cr" id="customized"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters customized_records">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label" for="customized_records">{{ __('Customized Record') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <input type="number" placeholder="{{ __('Customized Record') }}" class="form-control" id="customized_records" name="customized_records" value="{{ !empty(old('customized_records')) ? old('customized_records') : $subscription->customized_records }}">
                                        </div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        <label class="col-6 col-sm-5 col-md-4 col-lg-6 col-xl-5 control-label require" for="status">{{ __('Status') }}</label>
                                        <div class="col-sm-7 col-md-7 col-lg-6 col-xl-7 mb-2 mb-sm-1">
                                            <select class="form-control select2 sl_common_bx" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <option value="">{{ __('Select One') }}</option>
                                                <option value="pending" {{ old('status', $subscription->status) == "pending" ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                <option value="active" {{ old('status', $subscription->status) == "active" ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                <option value="expired" {{ old('status', $subscription->status) == "expired" ? 'selected' : '' }}>{{ __('Expired') }}</option>
                                                <option value="paused" {{ old('status', $subscription->status) == "paused" ? 'selected' : '' }}>{{ __('Paused') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 mt-3">
                        <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Submit') }}</span></button>
                        <a href="{{ route('packageSubscription.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
<script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/package.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
