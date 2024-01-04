<div id="notifications" class="row no-print">
    <div class="col-md-12">
        @if ($errors->any())
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
                @if ($message = Session::get($msg))
                    <div class="alert alert-{{ $msg == 'fail' ? 'danger' : $msg }}">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @break
            @endif
        @endforeach
    </div>
    <div class="noti-alert pad no-print js-alert d-none">
        <div class="alert alert-success">
            <button type="button" class="close">×</button>
            <strong><span class="d-block alertText"></span></strong>
        </div>
    </div>
</div>
</div>
