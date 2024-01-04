@extends('admin.layouts.app2')

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">{{ __('OTP') }}</p>
    <form action='{{ route('password.reset', ['token = null']) }}' method="get">
        @csrf
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="{{ __('Enter OTP') }}" name="token"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <button type="submit" class="btn btn-primary shadow-2 mb-4">{{ __('Continue') }}</button>
    </form>
    <a href="{{ route('login') }}">{{ __('Log In') }}</a><br>
</div>
@endsection
