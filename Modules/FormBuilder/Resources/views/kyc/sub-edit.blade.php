@extends('formbuilder::vendor-layout')

@section('content')
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-header">
                <h5><a href="#">{{ __('Edit My KYC Data') }}</a></h5>
            </div>
            <div class="card-body p-0">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12">
                        <form action="{{ route('kyc.user.update', $submission->id) }}" method="POST" id="submitForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div id="fb-render"></div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary confirm-form" data-form="submitForm"
                                    data-message="{{ __('Submit update to your entry for :x ?', ['x' => $submission->form->name]) }}">
                                    <i class="fa fa-submit"></i> {{ __('Submit Form') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.includes.delete-modal')
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($submission->form->form_builder_json) !!}
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\render-form.min.js') }}" defer></script>
@endpush
