<form action="{{ route('recaptcha.store') }}" method="post">
    @csrf
    <div class="addon-modal-body">
        <div class="addon-modal-form-row">
            <label for="siteKey" class="addon-modal-label">{{ __('Site Key') }}<span class="addon-modal-danger">*</span>:</label>
            <div class="addon-modal-field">
                <input type="text" class="addon-modal-input"
                placeholder="{{ __('Enter recaptcha site key') }}" name="siteKey" required
                value="{{ env('NOCAPTCHA_SITEKEY') }}">
            </div>
        </div>

        <div class="addon-modal-form-row">
            <label for="secretKey" class="addon-modal-label">{{ __('Secret Key') }}<span class="addon-modal-danger">*</span>:</label>
            <div class="addon-modal-field">
                <input type="text" class="addon-modal-input"
                placeholder="{{ __('Enter recaptcha secret key') }}" name="secretKey" required
                value="{{ env('NOCAPTCHA_SECRET') }}">
            </div>
        </div>

        <div class="addon-modal-foot">
            <button class="addon-modal-submit">{{ __('Submit') }}</button>
        </div>
    </div>
</form>
