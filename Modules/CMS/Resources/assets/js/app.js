"use strict";

$("#pageName").on("keyup", function () {
    let slug = $(this)
        .val()
        .toLowerCase()
        .replace(/ /g, "-")
        .replace(/[^\w-]+/g, "");
    $("#pageSlug").val(slug);
});

const updateFormFields = (form, data, values) => {
    values.forEach((item) => {
        if (item.type == "val") {
            $(form).find(item.id).val(data[item.key]);
        } else if (item.type == "prop") {
            $(form)
                .find(item.id)
                .prop("checked", data[item.key] == item.val);
        }
    });
};

$(".delete-section-btn").click(function () {
    $(".delete-loading").removeClass("d-none");
    $("#internal_form").attr("action", deletePageUrl.replace("__id__", tempId));
    $("#internal_form").trigger("submit");
});

$(".delete-button").click(function () {
    tempId = $(this).data("id");
    $("#confirmDelete").modal("show");
});

$(".default_c").on("change", function () {
    if (!$(".status_c").is(":checked")) {
        $(this).prop("checked", false);
    }
});

$(".status_c").on("change", function () {
    if (!$(this).is(":checked")) {
        $(".default_c").prop("checked", false);
    }
});
