"use strict";

if ($(".main-body .page-wrapper").find("#page-container").length) {
    $(document).ready(function () {
        $("#summernote").summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link"]],
                ["view", ["codeview", "help"]],
            ],
        });
    });
}

$(document).on("keyup", "#name", function () {
    var str = this.value.replace(/[&\/\\#@,+()$~%.'":*?<>{}]/g, "");
    if (str.length > 5) {
        let slug = document.querySelector("#slug");
        slug.value = str.trim().toLowerCase().replace(/\s/g, "-");
        slug.setCustomValidity("");
        if (slug.parentNode.querySelector(".error")) {
            slug.parentNode.querySelector(".error").remove();
        }
    }
});

$(document).on("keyup", ".note-editable", function () {
    let str = $(this).html();
    if (str.length > 0) {
        let textarea = this.closest(".editor").querySelector(".sm_note");
        textarea.setCustomValidity("");
        if (textarea.closest(".editor").querySelector(".error")) {
            textarea.closest(".editor").querySelector(".error").remove();
        }
    }
});

$("#btnSubmit").on("click", function (e) {
    if (
        $("#name").val() == "" ||
        $("#slug").val() == "" ||
        $("#description").val() == ""
    ) {
        $("#home").addClass("active show");
        $('[href="#home"]').tab("show").addClass("active");
        $("#profile").removeClass("active show");
        $("#home").attr("aria-labelledby").val("home-tab");
        e.preventDefault();
    }
});

$(".page-submit").click(function (e) {
    var arr = ["#home", "#profile"];
    setTimeout(() => {
        for (const key in arr) {
            if ($(arr[key]).find(".error").length) {
                var target = $(arr[key]).attr("aria-labelledby");
                console.log(target)
                $("#" + target).trigger("click");
                break;
            }
        }
    }, 100);
});
