"use strict";

if ($('.main-body .page-wrapper').find('#page-container').length) {
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    });

    $(document).on('keyup', '#title', function() {
        var str = this.value.replace(/[&\/\\#@,+()$~%.'":*?<>{}]/g, "");
        $('#slug').val(str.trim().toLowerCase().replace(/\s/g, "-"));
        $(this).siblings('.error').remove();
        $('#slug').siblings('.error').remove();
    });

    $(document).on('keyup', '#slug', function() {
        var str = this.value.replace(/[&\/\\#@,+()$~%.'":*?<>{}]/g, "");
        $('#slug').val(str.trim().toLowerCase().replace(/\s/g, "-"));
    });

     $(document).on('keyup', '.note-editable', function() {
         $(this.closest(".form-group")).find(".error").remove();
    });

    $(document).on('keyup', '#summary', function() {
        $(this).siblings('.error').remove();
    });
    
}

function formValidation() {
    let status = true;
    let ids = ['#category_id' , '#title' , '#slug' , '#summernote' , '#summary'];

    for (const key in ids) {
            if ($(ids[key]).val().length == '' && $(ids[key]).siblings('.error').length == 0) {
                
                $(ids[key]).parent().append(`
                        <label class="error">${jsLang('This field is required.')}</label>
                `);
                
            status = false;
        }
    }

   if (status == false) {
        return false;
    }
    
    $('#btnSubmit').attr('disabled','true');
    return true;
}
