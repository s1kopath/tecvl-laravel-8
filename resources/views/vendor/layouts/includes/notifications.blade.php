<div id="notifications" class="row no-print">
    <div class="col-md-12">
        @if($errors->any())
        <div class="noti-alert pad no-print">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="noti-alert pad no-print">
            @foreach (['success', 'danger', 'fail', 'warning', 'info'] as $msg)
                @if($message = Session::get($msg))
                    <div class="alert alert-{{ $msg == 'fail' ? 'danger' : $msg }}">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @break
                @endif
            @endforeach

            @impersonated
            <div class="alert alert-info }}">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ __('You are impersonating as this user.') }} <a class="btn btn-info btn-sm" href="{{ route('impersonator-cancel') }}">{{ __('Cancel Impersonating') }}</a></strong>
            </div>
            @endimpersonated
        </div>
    </div>
</div>

