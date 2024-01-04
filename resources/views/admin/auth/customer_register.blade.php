<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon icon -->
   
    <link rel="stylesheet" href="{{ asset('public/datta-able/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/custom.min.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <form action="{{ route('customerRegistration.store') }}" method="POST" accept-charset="UTF-8" id="customerRegistration">
                    {!! csrf_field() !!}
                    @foreach (['success', 'danger', 'fail', 'warning', 'info'] as $msg)
                        @if($message = Session::get($msg))
                            <div class="alert alert-{{ $msg == 'fail' ? 'danger' : $msg }}">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>
                            </div>
                            @break
                        @endif
                    @endforeach
                    <div class="form-group has-feedback" id="name-group">
                        <input type="text" class="form-control" placeholder="Name" name="name" required='required' value="{{ old('first_name') }}">
                        @if($errors->has('first_name'))
                            <p class="text-danger">{{$errors->first('first_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group has-feedback" id="email-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" required='required' value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <p class="text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group has-feedback" id="password-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required='required'>
                        @if($errors->has('password'))
                            <p class="text-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>
                    <div class="form-group has-feedback" id="password-confirmation-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required='required'>
                        @if($errors->has('password_confirmation'))
                            <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                        @endif
                    </div>
                    <button type=submit>Sign up</button>
                    <div>
                        <p>{{ __('Already have an account?') }} <a href="{{url('/customer')}}"><span class="color_green">{{ __('Log In') }}</span></a></p>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

