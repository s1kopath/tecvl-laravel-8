@if ($errors->all())
    <div class="payment-alert danger">
        <p>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </p>
        <span id="payment-alert-icon"><i class="fa fa-times"></i></span>
    </div>
    <br>
@endif
