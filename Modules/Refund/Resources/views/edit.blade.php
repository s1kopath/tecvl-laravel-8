@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Refund')]))
@section('css')
{{-- Select2 --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="col-sm-12 list-container" id="refund-edit-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('refund.index') }}">{{ __('Refunds') }}</a> >> {{ __('Edit :x', ['x' => __('Refund')]) }}</h5>
                <div class="card-header-right">
                    <div class="d-flex mr-4 mt-2">
                        <h4 class="text-secondary mr-1 font-18 font-bold">{{ __('Status') }}: </h4>
                        @php
                            $color = ['Opened' => 'text-secondary', 'In progress' => 'text-warning', 'Accepted' => 'text-primary', 'Declined' => 'text-red'];
                        @endphp
                        <h4 class="{{ $color[$refund->status] }} ml-1 font-18">{{ $refund->status }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase">{{ __('Refund Information') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-7 border p-3">
                                    <form action="{{ route('refund.update', ['id' => $refund->id]) }}" method="post" class="form-horizontal" id="delete-refund-{{ $refund->id }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ optional($refund->user)->id }}">
                                        <input type="hidden" name="total" value="{{ $refund->quantity_sent * $refund->orderDetail->price }}">
                                        <input type="hidden" name="order_id" value="{{ $refund->orderDetail->order->reference }}">
                                        <input type="hidden" name="vendor_email" value="{{ $refund->orderDetail->vendor->email }}">
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Order Id') }}</div>
                                            <div class="col-sm-8">{{ optional(optional($refund->orderDetail)->order)->reference }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Customer') }}</div>
                                            <div class="col-sm-8">{{ optional($refund->user)->name }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Email') }}</div>
                                            <div class="col-sm-8">{{ optional($refund->user)->email }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Shipping Method') }}</div>
                                            <div class="col-sm-8">{{ $refund->shipping_method }}</div>
                                        </div>

                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Refund Reason') }}</div>
                                            <div class="col-sm-8">{{ optional($refund->refundReason)->name }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-sm-4 font-bold text-left">{{ __('Date') }}</div>
                                            <div class="col-sm-8">{{ timezoneFormatDate($refund->created_at) }}</div>
                                        </div>

                                        <div class="form-group row mt-25">
                                            <div class="col-4 text-left font-bold">{{ __('Amount') }}</div>
                                            <div class="col-8">{{ formatNumber($refund->orderDetail->price) }}</div>
                                        </div>
                                        <div class="form-group row mt-25">
                                            <div class="col-4 text-left font-bold">{{ __('Quantity') }}</div>
                                            <div class="col-8">x {{ (int) $refund->quantity_sent }}</div>
                                        </div>

                                        <div class="form-group row mt-25">
                                            <div class="col-4 text-left font-bold">{{ __('Total') }}</div>
                                            <div class="col-8">{{ formatNumber($refund->quantity_sent * $refund->orderDetail->price) }}</div>
                                        </div>

                                        <div class="form-group row mt-25">
                                            <label class="col-sm-4 font-bold text-left" for="status">{{ __('Status') }}</label>
                                            <div class="col-sm-8">
                                                @if ($refund->status == 'Declined')
                                                    <div class="form-group row" id="divNote">
                                                        <div class="" id='note_txt_1'>
                                                            <div class="">
                                                                <p class="font-12 bg-light-red text-white px-2 py-1 rounded ml-3">{{ __("Declined status can't be changed") }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($refund->status == 'Accepted')
                                                    <div class="form-group row" id="divNote">
                                                        <div class="" id='note_txt_1'>
                                                            <div class="">
                                                                <p class="font-12 bg-light-red text-white px-2 py-1 rounded ml-3">{{ __("Accepted status can't be changed") }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-50">
                                                        <select class="form-control select2" id="status" name="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                            <option value="Opened" {{ old('status', $refund->status) == "Opened" ? 'selected' : ''}}>{{ __('Opened') }}</option>
                                                            <option value="In progress" {{ old('status', $refund->status) == "In progress" ? 'selected' : ''}}>{{ __('In progress') }}</option>
                                                            <option value="Accepted" {{ old('status', $refund->status) == "Accepted" ? 'selected' : ''}}>{{ __('Accepted') }}</option>
                                                            <option value="Declined" {{ old('status', $refund->status) == "Declined" ? 'selected' : ''}}>{{ __('Declined') }}</option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-8 px-0">
                                            <button class="btn btn-primary custom-btn-small"
                                                type="button" data-id="{{ $refund->id }}"
                                                data-delete="refund" data-label="Delete"
                                                data-toggle="modal"
                                                data-target="#confirmDelete"
                                                id="submitBtn"
                                                data-title="{{ __('Update Refund Request') }}"
                                                data-message="{{ __('Are you sure to change refund status?') }}"
                                                >{{ __('Update') }}
                                            </button>
                                            <a href="{{ route('refund.index') }}" class="btn btn-info custom-btn-small">{{ __('Cancel') }}</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-5 ">
                                    <div class="border p-2">
                                        <div class="borde p-2 max-h-500 overflow-auto">
                                            @foreach ($refundProcesses as $process)
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex mb-4">
                                                        <div class="mr-2">
                                                            <svg class="refund-message-icon"
                                                                xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8"
                                                                fill="none">
                                                                <circle cx="4" cy="4" r="4" transform="rotate(90 4 4)" fill="#33C172" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h5 class="m-0">{{ $process->user->name  }} ({{ (auth()->user()->roles->first()->name == $process->user->roles()->first()->name) ? __('You') : $process->user->roles()->first()->name }})</h5>
                                                            <p class="m-0">{{ $process->note }}</p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5>{{ formatDate($process->created_at) }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        @if (in_array($refund->status, ['Opened', 'In progress']))
                                            <div class="ml-50p w-100 mt-2">
                                                <form action="{{ route('site.refundProcess') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="refund_id" value="{{ $refund->id }}">
                                                    <textarea name="note" id="" class="border border-primary p-3 w-100" rows="3" placeholder="{{ __('Enter your message here...') }}"></textarea>
                                                    <div class="flex">
                                                        <button type="submit" class="btn btn-dark w-100">{{ __('Send') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary custom-btn-small" data-dismiss="modal">{{ __('No') }}</button>
                        <button type="button" id="confirmDeleteSubmitBtn" data-task="" class="btn btn-danger custom-btn-small">{{ __('Yes') }}</button>
                        <span class="ajax-loading"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/delete-modal.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/refund.min.js') }}"></script>
@endsection
