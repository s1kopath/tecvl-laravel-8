@extends('formbuilder::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h5 class="card-title">{{ $form->name }}</h5>
                    </div>
                    <form action="{{ route('formbuilder::form.submit', $form->identifier) }}" method="POST"
                        id="submitForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div id="fb-render"></div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary confirm-form" data-form="submitForm"
                                data-message="Submit your entry for '{{ $form->name }}'?">
                                <i class="fa fa-submit"></i> {{ __('Submit Form') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\render-form.min.js') }}" defer></script>
@endsection
