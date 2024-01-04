<link rel="stylesheet" type="text/css" href="{{ asset('Modules\Addons\Resources\assets\css\addon.min.css') }}">
<?php
$addons = \Modules\Addons\Entities\Addon::all();
$numberOfAddons = count(
    array_filter($addons, function ($addon) {
        return !$addon->get('core');
    }),
);
?>

@if (session('AddonMessage'))
    <div class="addon-alert addon-alert-{{ session('AddonStatus') == 'success' ? 'success' : 'danger' }}">
        <span class="addon-alert-closebtn">&times;</span>
        <strong>{{ session('AddonMessage') }}</strong>
    </div>
@endif

<div class="addons-section">
    <div class="addons-card">
        <h5>Addons</h5>
        <button id="upload-btn" class="upl-button">{{ __('Upload Addon') }}</button>
    </div>
    <hr>

    <div id="addons-form-container" class={{ $numberOfAddons > 0 ? 'addon-dnone' : 'addon-dblock' }}">
        <form action="{{ route('addon.upload') }}" method="post" class="addons-form" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <p>{{ __('Purchase Code') }}</p>
                    <input type="text" placeholder="Purchase Code" name="purchase_code" required>
                </div>
                <div class="input-file-container">
                    <p>{{ __('Upload module') }}</p>
                    <input type="file" name="attachment" accept=".zip,.rar,.7zip" required>

                </div>
                <div class="input-file-container">
                    <button class="submit-style" type="submit">{{ __('Submit') }}</button>
                </div>
            </div>
        </form>
        <hr>
    </div>

    <div class="addons-table-container">
        @if ($numberOfAddons > 0)
            <table>
                <thead>
                    <tr>
                        <th>Addons</th>
                        <th>Module</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addons as $addon)
                        @if ($addon->get('core'))
                            @continue
                        @endif
                        <tr>
                            <td><img class="addons-img" src="{{ addonThumbnail($addon->getName()) }}"
                                    alt="{{ $addon->getName() }}"></td>
                            <td>
                                <strong>{{ $addon->getName() }}</strong>
                                <br>
                                <br>
                                <span class="pt-2">
                                    <a href="{{ route('addon.switch-status', $addon->getAlias()) }}"
                                        class="addons-act">{{ $addon->isEnabled() ? __('Deactivate') : __('Activate') }}</a>

                                    @if (Config($addon->getLowerName() . '.options'))
                                        @foreach (Config($addon->getLowerName() . '.options') as $option)
                                            @php
                                                $link = settingsModalLink($option);
                                                $modal = settingModalStatus($option);
                                            @endphp
                                            | <a href="{{ $modal ? 'javascript:void()' : $link }}"
                                                class="addons-anchor {{ $modal ? 'addon-modal-trigger' : '' }}"
                                                data-name="{{ $addon->getName() }}" data-url={{ $link }}
                                                target="{{ isset($option['target']) ? $option['target'] : '' }}">
                                                {{ isset($option['label']) ? $option['label'] : '' }}
                                            </a>
                                        @endforeach
                                    @endif
                                </span>
                            </td>
                            <td>{{ $addon->get('description') }} <br><br> <span class="text-version">Version:
                                    <b>{{ $addon->get(__('Version'), 0) }}</b></span> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    @endif
</div>

<div class="addon-modal-window addon-modal-hidden">
    <div class="addon-modal-container">
        <div class="addon-modal-head">
            <div class="addon-modal-title"></div>
            <div class="addon-modal-close">x</div>
        </div>
        <div class="modal-form-data">
            <div class="form"></div>
            <ul class="addon-form-loading addon-modal-dnone">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

    </div>
</div>

<script src="{{ asset('Modules/Addons/Resources/assets/js/addons.min.js') }}"></script>
