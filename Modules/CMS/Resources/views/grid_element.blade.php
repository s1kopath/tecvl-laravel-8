<div data-gs-x="0" data-gs-y="{{ $component->level }}" data-gs-width="12" data-gs-height="1"
    data-component="{{ $component->id }}"
    class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide ui-resizable-disabled" data-open="0"
    style="z-index: 9;">
    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se"
        style="z-index: 90; display: none;"></div>
    @include('cms::edit.' . $component->layout->file)
</div>
