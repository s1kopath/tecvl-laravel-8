"use strict";
var currentImageInput;
$(document).on("click", "#image-status", function () {
    $("#exampleModalCenter").modal("show");
    currentImageInput = this;
});
$("#exampleModalCenter").on("show.bs.modal", function (e) {
    $("#file-id").val($(e.relatedTarget).attr("id"));
    $("#file-name").val($(e.relatedTarget).attr("name"));
    $("#file-type").val($(e.relatedTarget).attr("type"));
    $("#file-size").val($(e.relatedTarget).attr("size"));
    $("#uploded-by").val($(e.relatedTarget).attr("user"));
    $("#uploded-date").val($(e.relatedTarget).attr("time"));
    $(".page-link").addClass("modal-paginator");
});

if ($(".main-body .page-wrapper").find("#exampleModalCenter").length) {
    $(document).ready(function () {
        $(".pagination li a").addClass("custom-paginator");
    });
}

let images = [];
const image_show = () => {
    let image = "";
    images.forEach((i) => {
        image += `<div class="image_container d-flex flex-column justify-content-center align-items-start position-relative m-3">
              <img src= ${i.url} alt="Image">
              <p class="m-1">${
                  i.name.slice(0, 15).split(".")[0] +
                  "." +
                  i.file.type.split("/")[1]
              }</p>
              <small class="ml-1">${(i.size * 0.001).toFixed(2)} kb</small>
              <span class="position-absolute rounded-circle text-center img-remove-icon img-del" onclick="delete_image(${images.indexOf(
                  i
              )})">&times;</span>
          </div>`;
    });
    return image;
};

const delete_image = (e) => {
    if (images.length < 2) {
        addFiles();
    }
    images.splice(e, 1);
    document.getElementById("img-container").innerHTML = image_show();
};

const addFiles = () => {
    $("#add-files").css("display", "flex");
    $("#add-more-files").addClass("add-more-files");
};

const check_duplicate = (name) => {
    let image = true;
    if (images.length > 0) {
        for (let img of images) {
            if (img.name === name) {
                image = false;
                break;
            }
        }
    }
    return image;
};

$(document).on("click", "#clear-items", function () {
    addFiles();
    images = [];
    image_show();
    removeAllChildNodes(document.getElementById("img-container"));
});

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

$(document).on("click", ".img-remove-icon", function () {
    $(this).parent().hide();
});

$(document).on("click", ".close", function () {
    $(".item-border").remove();
});

$(document).on("click", ".modal-img-des", function () {
    if ($.trim($("#image-status").attr("data-val")) == "single") {
        $(".modal-img-des").each(function () {
            $(this).removeClass("item-border");
        });
        $(this).toggleClass("item-border");
    } else {
        $(this).toggleClass("item-border");
    }

    var numItems = $(".item-border").length;
    $("#add-file-count").text(numItems);
});

$(document).on("click", ".modal-img-des", function () {
  $('.btn-file-add').attr('data-info',$(this).find('img').attr('src').split(".").pop());
  $('.btn-file-add').attr('data-size', $(this).find('small').text().split(" ").shift());
});

$("#clear-item").click(function () {
    $(".modal-img-des").removeClass("item-border");
    $("#add-file-count").text(0);
});

$("#select-file").click(function () {
    $("#select-items").show();
    $("#browse-file").hide();
    $("#file-count").show();
    $("#upload-card-header").show();
    $(this).addClass("modal-title-color");
    $("#upload-new").removeClass("modal-title-color");
    $("#clear-items").hide();
    fetch_data(1);
});

$("#upload-new").click(function () {
    $("#select-items").hide();
    $("#upload-card-header").hide();
    $("#file-count").hide();
    $("#browse-file").show();
    $(this).addClass("modal-title-color");
    $("#select-file").removeClass("modal-title-color");
    $("#clear-items").removeClass("d-none");
    $("#clear-items").show();
});

$(".btn-file-add").click(function () {
    $("#exampleModalCenter").modal("hide");
    getImages();
});

function getImages() {
    $("#img-container").html("");
    var ids = [];
    $(".item-border").each(function () {
        ids.push($(this).attr("id"));
    });
    $.ajax({
        type: "POST",
        dataType: "html",
        url: SITE_URL + "/upload/image",
        data: {
            file_id: ids,
            _token: token,
        },
        success: function (data) {
            if (currentImageInput.dataset.returntype == "ids") {
                currentImageInput
                    .querySelector(".is-image")
                    .setCustomValidity("");
                currentImageInput.querySelector(".custom-file-input").value =
                    ids[0];
                $(currentImageInput.closest(".form-group"))
                    .find(".preview-image")
                    .html(data);
                    if(currentImageInput.querySelector("label.error")) {
                        currentImageInput.querySelector("label.error").remove();
                    }
            } else {
                $("#img-container").append(data);
            }
        },
    });
}

$(document).on("click", ".modal-paginator", function (event) {
    event.preventDefault();
    var page = $(this).attr("href").split("page=")[1];
    fetch_data(page);
});

function fetch_data(page) {
    $.ajax({
        url: SITE_URL + "/paginate-data?page=" + page,
        method: "POST",
        data: {
            sort: $(this).val(),
            _token: token,
        },
        success: function (data) {
            $("#modal-img-des-container").html(data);
            $("#load-data").html($("#modal-id").html());
            $(".pagination li a").addClass("modal-paginator");
        },
    });
}

$(document).on("change", ".sort-option", function () {
    $("#media-list").submit();
    $.ajax({
        type: "get",
        dataType: "html",
        url: SITE_URL + "/uploaded-files",
        data: {
            sort: $(this).val(),
            _token: token,
        },
        success: function (data) {
            $("#blog-image").append(data);
        },
    });
});

$(document).on("change", ".sort-option-modal", function () {
    $.ajax({
        type: "get",
        dataType: "html",
        url: SITE_URL + "/sort-files",
        data: {
            sort_value: $(this).val(),
            _token: token,
        },
        success: function (data) {
            $("#select-items").html("");
            $("#select-items").append(data);
        },
    });
});

$(document).on("keyup", ".search-image", function () {
    $.ajax({
        type: "get",
        dataType: "html",
        url: SITE_URL + "/sort-files",
        data: {
            sort_name: $(this).val(),
            _token: token,
        },
        success: function (data) {
            $("#select-items").html("");
            $("#select-items").append(data);
        },
    });
});

function getMaxFileId() {
    $.ajax({
        type: "get",
        dataType: "json",
        url: SITE_URL + "/max-fileid",
        data: {
            _token: token,
        },
        success: function (data) {
            return data;
        },
    });
}

$(document).on("click", ".btn-next", function () {
    var fileId =
        typeof $(".modal-img-des").last().attr("id") === "undefined"
            ? 0
            : $(".modal-img-des").last().attr("id");
    $.ajax({
        type: "get",
        dataType: "html",
        url: SITE_URL + "/paginate-files",
        data: {
            next_file_id: fileId,
            _token: token,
        },
        success: function (data) {
            $("#select-items").html("");
            $("#select-items").append(data);
        },
    });
});

$(document).on("click", ".btn-prev", function () {
    var fileId =
        typeof $(".modal-img-des").last().attr("id") === "undefined"
            ? getMaxFileId()
            : $(".modal-img-des").last().attr("id");
    $.ajax({
        type: "get",
        dataType: "html",
        url: SITE_URL + "/paginate-files",
        data: {
            previous_file_id: fileId,
            _token: token,
        },
        success: function (data) {
            $("#select-items").html("");
            $("#select-items").append(data);
        },
    });
});

$(document).on("click", ".copy-link", function () {
    navigator.clipboard.writeText($(this).attr("data-url"));
    swal(jsLang('Link copied to clipboard'), {
        icon: "success",
        buttons: [false, jsLang('Ok')],
    });
});
$(document).on("click", ".delete-image", function () {
    var r = swal({
        title: jsLang('Are you sure?'),
        icon: "warning",
        buttons: [jsLang('Cancel'), jsLang('Ok')],
        dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
      $.ajax({
        dataType: 'json',
    
        data: {
          id: $(this).attr("data-id"),
          _token: token
        },
    
        url: SITE_URL + "/delete-image",
        type: 'POST',
        success: function(response) {
          if (response.resp == 'success') {
            swal(jsLang('Successfully deleted.'), {
              icon: "success",
              buttons: [false, jsLang('Ok')],
          }).then(function(){
            window.location.reload();
        })
          } else  {
            swal(jsLang('Something went wrong'), {
              icon: "error",
              buttons: [false, jsLang('Ok')],
          });
          }
        }
      });
      }
    });
});
