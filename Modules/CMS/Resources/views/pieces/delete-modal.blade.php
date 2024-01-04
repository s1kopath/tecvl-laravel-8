<div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">{{ __('Delete page') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure to delete this page?') }}</p>
                <form action="#" id="internal_form" method="post">
                    @csrf
                    <input type="hidden" name="data" id="data">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary custom-btn-small" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" id="confirmDeleteSubmitBtn" data-task="1"
                    class="btn btn-danger custom-btn-small delete-section-btn">{{ __('Delete') }}
                    <div class="spinner-border ml-2 d-none delete-loading" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
                <span class="ajax-loading"></span>
            </div>
        </div>
    </div>
</div>
