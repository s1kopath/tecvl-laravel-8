'use strict';

if ($('.main-body .page-wrapper').find('.list-container').length) {
  $(document).on("click", "#tablereload", function(event) {
    event.preventDefault();
    $("#dataTableBuilder").DataTable().ajax.reload();
  });

  $('#confirmDelete').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget);
    var modal = $(this);
    $('#confirmDeleteSubmitBtn').attr('data-task', '').removeClass('delete-task-btn');
    if (button.data("label") == 'Delete') {
      modal.find('#confirmDeleteSubmitBtn').addClass('delete-task-btn').attr('data-id', button.data('id')).show();
      modal.find('#confirmDeleteLabel').text(button.data('title'));
      modal.find('.modal-body').text(button.data('message'));
    }

    $('#confirmDeleteSubmitBtn').on('click', function() {
      $('#delete-' + button.attr('data-delete') + '-' + $(this).attr('data-id')).trigger('submit');
    })
  });
}

