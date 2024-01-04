@extends('formbuilder::layouts.master')

@section('content')
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Form Successfully submitted') }}</h5>
                <div class="card-header-right d-inline-block">
                    <div class="btn-toolbar float-md-right" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            @auth
                                <a href="{{ route('formbuilder::my-submissions.index') }}"
                                    class="btn btn-primary btn-sm float-md-right">
                                    <i class="fa fa-th-list"></i> {{ __('Go To My Submissions') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="card-body">
                        <h3 class="text-center text-success">
                            {{ __('Your entry for " :x " was successfully submitted.', ['x' => $form->name ]) }}
                        </h3>
                        <p class="text-center"><a class="text-success"
                                href="{{ route('login') }}"><u>{{ __('Return Home') }}</u></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
