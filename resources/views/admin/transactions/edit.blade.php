@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Transaction')]))
@section('css')
{{-- Select2  --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="col-sm-12" id="transaction-edit-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('transaction.index') }}">{{ __('Transactions') }}</a> >> {{ __('Edit :x', ['x' => __('Transaction')]) }}</h5>
                <div class="card-header-right">
                    <div class="d-flex mr-4 mt-2">
                        <h4 class="text-secondary mr-1 font-18 font-bold">{{ __('Status') }}: </h4>
                        @php
                            $color = ['Pending' => 'text-warning', 'Accepted' => 'text-primary', 'Rejected' => 'text-red'];
                        @endphp
                        <h4 class="{{ $color[$transaction->status] }} ml-1 font-18">{{ $transaction->status }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase">{{ __('Transaction Information') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('transaction.update', ['id' => $transaction->id]) }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-7 border p-3">
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('User') }}</div>
                                            <div class="col-sm-8">{{ optional($transaction->user)->name }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Transaction Type') }}</div>
                                            <div class="col-sm-8">{{ $transaction->transaction_type }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Currency') }}</div>
                                            <div class="col-sm-8">{{ optional($transaction->currency)->name }}</div>
                                        </div>
                                        @if ($transaction->transaction_type == 'Withdrawal')
                                            <div class="form-group row mt-25">
                                                <div class="col-sm-4 font-bold text-left">{{ __('Payment Method') }}</div>
                                                <div class="col-sm-8">{{ optional($transaction->withdrawalMethod)->method_name }}</div>
                                            </div>
                                            @php
                                                $params = (array) json_decode($transaction->user()->first()->withdrawalSettings()->where('withdrawal_method_id', $transaction->withdrawal_method_id)->first()->param);
                                            @endphp
                                            @foreach ($params as $key => $value)
                                                <div class="form-group row mt-25">
                                                    <div class="col-sm-4 font-bold text-left">{{str_replace("_"," ", ucfirst($key))  }}</div>
                                                    <div class="col-sm-8">{{ $value }}</div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="form-group row mt-25 order-details-body">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Transaction Date') }}</div>
                                            <div class="col-sm-8 paid-on">
                                                {{ timezoneFormatDate($transaction->transaction_date) }}
                                                @if ($transaction->transaction_type == 'Order')
                                                    <a href="{{ route('order.view', ['id' => $transaction->order_id]) }}" target="_blank">({{ __('View order details') }})</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <label class="col-sm-4 font-bold text-left" for="status">{{ __('Status') }}</label>
                                            <div class="col-sm-8">
                                                @if ($transaction->status == 'Rejected')
                                                    <div class="form-group row" id="divNote">
                                                        <div class="" id='note_txt_1'>
                                                            <div class="">
                                                                <p class="font-12 bg-light-red text-white px-2 py-1 rounded ml-3">{{ __("Rejected status can't be changed") }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-50">
                                                        <select class="form-control select2" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            <option value="">{{ __('Select One') }}</option>
                                                            <option value="Pending" {{ old('status', $transaction->status) == "Pending" ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                                            <option value="Accepted" {{ old('status', $transaction->status) == "Accepted" ? 'selected' : ''}}>{{ __('Accepted') }}</option>
                                                            <option value="Rejected" {{ old('status', $transaction->status) == "Rejected" ? 'selected' : ''}}>{{ __('Rejected') }}</option>
                                                        </select>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-sm-8 px-0">
                                            @if ($transaction->status != 'Rejected')
                                                <button class="btn btn-primary custom-btn-small" type="submit" id="submitBtn"><i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Update') }}</span></button>
                                            @endif
                                            <a href="{{ route('transaction.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-5 ">
                                        <div class="border  p-2">
                                            <div class="row mt-2">
                                                <div class="col-5 text-right font-bold">{{ __('Amount') }}</div>
                                                <div class="col-7">{{ formatNumber($transaction->amount) }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-5 text-right font-bold">{{ __('Charge') }}</div>
                                                <div class="col-7">{{ formatNumber($transaction->charge_amount) }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-5 text-right font-bold">{{ __('Commission') }}</div>
                                                <div class="col-7">{{ formatNumber($transaction->commision_amount) }}</div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-5 text-right font-bold">{{ __('Discount') }}</div>
                                                <div class="col-7">{{ formatNumber($transaction->discount_amount) }}</div>
                                            </div>
                                            <hr>
                                            <div class="row mt-2">
                                                <div class="col-5 text-right font-bold">{{ __('Total') }}</div>
                                                <div class="col-7">{{ formatNumber($transaction->total_amount) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
