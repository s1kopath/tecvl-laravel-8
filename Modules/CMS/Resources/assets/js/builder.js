"use strict";

var pendingForm;
const alertBox = $(".js-alert");

$(document).on("submit", "form#layout_selector", function (e) {
    e.preventDefault();
    let url = this.action.replace(
        "__file",
        this.querySelector("#l_layout").value
    );
    updateFormButton(this);
    ajaxRequest($(this), url, replaceForm);
});

$(document).on("change", ".category_type", function () {
    if (this.value == "selectedCategories") {
        this.closest("form").querySelector(".cats").classList.remove("d-none");
        $(this.closest("form")).find(".cats .crequired").attr("required", "");
    } else {
        this.closest("form").querySelector(".cats").classList.add("d-none");
        $(this.closest("form")).find(".cats .crequired").removeAttr("required");
    }
});

$(document).on("submit", "form.component_form", function (e) {
    e.preventDefault();
    let url = this.action.replace("__id", __page);
    processComponentForm(getDraggableParent(this));
    if (validateFormData(this)) {
        updateFormButton(getDraggableParent(this));
        ajaxRequest($(this), url, updateComponent, "post");
    }
});

$(document).on("keyup", "#section_name", function () {
    let parent = getDraggableParent(this);
    parent.querySelector(".header-title").innerHTML = this.value;
});

$(document).on("click", "#update_page", function (e) {
    let componentOrders = sortable.sortable("toArray", {
        attribute: "data-id",
    });
    let data = [];
    componentOrders.filter(Boolean).forEach((it, i) => {
        data.push({ id: it, level: i });
    });
    $(this).find(".loading-spinner").toggleClass("d-none");
    updateCustomForm(JSON.stringify(data));
    ajaxRequest($("#internal_form"), __savePageUrl, pageUpdated, "post");
});

$(document).on("click", "#add-new-widget", function () {
    sortable.append(selector);
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    updateSelect2Fields();
});

$(document).on("change", "#l_category", function () {
    $(".layoutBlocks").hide();
    $("#" + this.value).show();
});

const ajaxRequest = (form, url, callBack, method = "get") => {
    let serializedData = {};
    if (form) {
        var $inputs = form.find("input, select, button, textarea");
        form.serializeArray().forEach((x) => {
            let [name, value] = [x.name, x.value];
            if (name.endsWith("[]")) {
                name = name.slice(0, -2);
                if (!serializedData[name]) {
                    serializedData[name] = [];
                }
                serializedData[name].push(value);
            } else {
                serializedData[name] = value;
            }
        });
        $inputs.prop("disabled", true);
    }
    pendingForm = form;

    let basic = {
        method: method,
        headers: {
            "Content-Type": "application/json",
        },
    };
    if (method === "POST" || method === "post") {
        basic.body = JSON.stringify(serializedData);
    }
    fetch(url, basic)
        .then((response) => response.json())
        .then((data) => {
            callBack(form, data.body);
            $inputs.prop("disabled", false);
        })
        .catch((error) => {
            $inputs.prop("disabled", false);
            operationFailed(jsLang("Operation failed."));
            updateAjaxMessage(form, jsLang("Operation failed."), "danger");
            updateFormButton(form);
            throw error;
        });
};

const replaceForm = (child, html) => {
    let parent = getDraggableParent(child);
    parent.find(".header-title").html(html.title);
    parent.find(".header-text").append(html.header);
    parent.find(".dd-content").remove();
    parent.append(html.html);
    $("#update_page .loading-spinner").toggleClass("d-none");
    operationSuccess(
        jsLang(
            "Section added. Please fill up the section information and save."
        )
    );

    updateSelect2Fields();
};

const updateComponent = (child, response) => {
    child.find(".component").val(response);
    updateFormButton(getDraggableParent(child));
    updateAjaxMessage(getDraggableParent(child), jsLang("Section updated."));
    getDraggableParent(child).data({ id: response });
    getDraggableParent(child).data({ id: response });
    operationSuccess(jsLang("Section Updated"));
};

const processComponentForm = (grid) => {
    let componentId = $(grid).data("id");
    let order;
    if (componentId) {
        let orderArray = sortable
            .sortable("toArray", { attribute: "data-id" })
            .filter(Boolean);
        order = orderArray.indexOf($(grid).data("id").toString());
    } else {
        order = Array.from(grid.parentNode.children).indexOf(grid);
    }
    grid.querySelector("input.order").value = order;
};

const getDraggableParent = (child) => {
    return child.closest(".ui-state-default");
};

const deletedGrid = (response) => {
    if (response) {
        operationSuccess(jsLang("Section deleted"));
    } else {
        operationFailed(jsLang("Couldn't delete the section"));
    }
};

const updateCustomForm = (value) => {
    document.querySelector("#internal_form #data").value = value;
};

const pageUpdated = (form, value) => {
    $("#update_page .loading-spinner").toggleClass("d-none");
    operationSuccess(jsLang("Page updated"));
};

const operationSuccess = (msg) => {
    showNotification("success", jsLang(msg));
};

const operationFailed = (msg) => {
    showNotification("danger", jsLang(msg));
};

const showNotification = (css_class, msg) => {
    alertBox.find(".alertText").html(msg);
    alertBox.find(".alert").attr("class", `alert alert-${css_class}`);
    alertBox.removeClass("d-none");
};

$(".close").click(function () {
    alertBox.addClass("d-none");
});

const showSliderOptions = (radio) => {
    let p = getDraggableParent(radio);
    $(p).find(".sliderOptions").show();
    hideBannerOptions(p);
    hideFlashOptions(p);
};

const hideSliderOptions = (p) => {
    $(p).find(".sliderOptions").hide();
};

const showBannerOptions = (radio) => {
    let p = getDraggableParent(radio);
    $(p).find(".bannerOptions").show();
    hideSliderOptions(p);
    hideFlashOptions(p);
};

const hideBannerOptions = (p) => {
    $(p).find(".bannerOptions").hide();
};

const showFlashOptions = (radio) => {
    let p = getDraggableParent(radio);
    $(p).find(".flashOptions").show();
    hideSliderOptions(p);
    hideBannerOptions(p);
};

const hideFlashOptions = (p) => {
    $(p).find(".flashOptions").hide();
};

const hideAllOptions = (radio) => {
    let p = getDraggableParent(radio);
    hideSliderOptions(p);
    hideBannerOptions(p);
    hideFlashOptions(p);
    toggleSidebar(radio, false);
};

const updateSelect2Fields = () => {
    $("select.select2").select2({
        tags: true,
        allowClear: true,
        placeholder: jsLang("Select an option"),
    });
    $(".select3").select2({
        allowClear: true,
        placeholder: jsLang("Select an option"),
    });
};

$("select.select2").select2({
    tags: true,
    allowClear: true,
    placeholder: jsLang("Select an option"),
});

$(".select3").select2({
    allowClear: true,
    placeholder: jsLang("Select an option"),
});

$(document).on("change", ".sidebar_options", function () {
    if (this.value == "0") {
        hideAllOptions(this);
    } else if (this.value == "banner") {
        showBannerOptions(this);
        toggleSidebar(this, true);
    } else if (this.value == "slider") {
        showSliderOptions(this);
        toggleSidebar(this, true);
    } else if (this.value == "flash_sale") {
        showFlashOptions(this);
        toggleSidebar(this, true);
    }
});

$(document).ready(function () {
    updateSelect2Fields();
    $(".select2").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
});

$(document).on("click", ".folding", function () {
    let parent = this.closest(".ui-state-default");
    if (this.classList.contains("closed")) {
        $(parent).find(".dd-content").removeClass("card-hide");
        $(this).removeClass("closed");
    } else {
        $(parent).find(".dd-content").addClass("card-hide");
        $(this).addClass("closed");
    }
});

$(document).on("click", ".header-text", function () {
    $(this).closest(".ui-state-default").find(".folding").trigger("click");
});

$(document).on("click", ".delete-button", function () {
    $("#component-title").html($(this).data("component"));
    deletingSection = this.closest(".ui-state-default");
    deletingSectionId = $(this).data("component-id");
});

$(document).on("click", ".delete-section-btn", function () {
    toggleDeleteLoading();
    updateCustomForm(deletingSectionId);
    if (deletingSectionId === "0" || deletingSectionId === 0) {
        gridDeleted(null, true);
    } else {
        ajaxRequest($("#internal_form"), __gridDeleteUrl, gridDeleted, "post");
    }
});

const toggleDeleteLoading = () => {
    $(".delete-loading").toggleClass("d-none");
};

const gridDeleted = (form, data) => {
    $(".modal").modal("hide");
    toggleDeleteLoading();
    if (data) {
        deletingSection.remove();
        operationSuccess("Section deleted");
    } else {
        operationFailed("Section couldn't be deleted.");
    }
    deletingSection = undefined;
    deletingSectionId = undefined;
};

const updateFormButton = (form) => {
    $(form).find(".loading-spinner").toggleClass("d-none");
    $("#update_page .loading-spinner").toggleClass("d-none");
};

const updateAjaxMessage = (form, msg, className = "success") => {
    $(form).find(".message").html(msg);
    $(form).find(".message").addClass(`text-${className}`);
    setTimeout((form) => {
        $(form).find(".message").html("");
    }, 3000);
};

$(".img-delete-icon").click(function () {
    let group = $(this).closest(".form-group");
    $(group).find(".custom-file-input").val("");
    $(this).closest(".preview-image").html("");
});

const toggleSidebar = (child, show = true) => {
    let parent = getDraggableParent(child);
    if (show) {
        $(parent).find(".sidebar-position").addClass(".crequired");
        $(parent).find(".sidebar-position").attr("required", "");
        $(parent).find(".sidebarOption").removeClass("d-none");
    } else {
        $(parent).find(".sidebar-position").removeClass(".crequired");
        $(parent).find(".sidebar-position").removeAttr("required", "");
        $(parent).find(".sidebarOption").addClass("d-none");
    }
};

$(document).on("change", ".seeMore", function () {
    let parent = getDraggableParent(this);
    if (this.checked) {
        $(this)
            .closest(".parent-class")
            .find(".more-link")
            .addClass("crequired");
        $(this)
            .closest(".parent-class")
            .find(".more-link")
            .attr("required", "");
    } else {
        $(this)
            .closest(".parent-class")
            .find(".more-link")
            .removeClass("crequired");
        $(this)
            .closest(".parent-class")
            .find(".more-link")
            .removeAttr("required");
    }
    $(parent).find(".moreLink").toggleClass("d-none");
});

$(document).on("click", ".selectable", function () {
    $(".selectable").removeClass("selectedBox");
    $("#l_layout").val($(this).data("val"));
    $(this).addClass("selectedBox");
});

const validateFormData = (form) => {
    let requiredFields = form.querySelectorAll(".crequired");
    let valid = true;
    requiredFields.forEach((field) => {
        if (
            $(field).closest(".form-parent").css("display") !== "none" &&
            !field.checkValidity()
        ) {
            valid = false;
            addErrorMessage(field);
            console.log(field.name);
        }
    });
    return valid;
};

$(document).on("keyup", ".has-image", function () {
    if (this.value.length > 1) {
        $(this).closest(".parent-class").find(".is-image").attr("required", "");
        $(this)
            .closest(".parent-class")
            .find(".is-image")
            .addClass("crequired");
    } else {
        $(this)
            .closest(".parent-class")
            .find(".is-image")
            .removeAttr("required");
        $(this)
            .closest(".parent-class")
            .find(".is-image")
            .removeClass("crequired");
        this.closest(".parent-class")
            .querySelector(".is-image")
            .setCustomValidity("");
    }
});

$(document).on("click", ".img-delete-icon", function () {
    $(this).closest(".parent-class").find(".is-image").val("");
});

$(document).on("click", ".img-remove-icon", function () {
    $(this).closest(".parent-class").find(".is-image").val("");
});

$(".is-image").on("invalid", function () {
    return false;
});

const addErrorMessage = (el) => {
    let p = el.parentNode;
    var err = p.querySelector(".error") || document.createElement("label");
    err.classList.add("error");
    err.innerHTML = "This field is required.";
    if (!p.querySelector(".error")) {
        if (p.childElementCount > 1) {
            p.append(err);
        } else {
            p.insertBefore(err, el.nextSibling);
        }
    }
};

$(document).on("input", ".crequired", function () {
    if (!(!this.value && this.value !== "0") || this.value.trim() !== "") {
        if (this.parentNode.querySelector(".error")) {
            this.parentNode.querySelector(".error").remove();
        }
    }
});
