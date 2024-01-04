let c=1;
document.getElementById('upload-btn').onclick=function(){
    let x = document.getElementById("addons-form-container");
    if(c===1){
        x.style.display = "block";
        c=0;
    }
    else{
        x.style.display = "none";
        c=1;
    }
};

var close = document.getElementsByClassName("addon-alert-closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){
            div.style.display = "none";
        }, 600);
    }
}

let triggers = document.querySelectorAll('.addon-modal-trigger');

if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
    httpRequest = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 6 and older
    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}


triggers.forEach((trigger) => {
    trigger.addEventListener('click', function() {
        clearForm();
        addonModalToggle();
        setFormName(this.dataset.name);
        getAddonFormData(this.dataset.url);
    });
});

document.querySelector('.addon-modal-close').addEventListener('click', function() {
    addonModalToggle();
});

function getAddonFormData(url) {
    if (url === '#') {
        return;
    }
    toggleAddonLoading();
    httpRequest.onreadystatechange = handleResponse;
    httpRequest.open('GET', url, true);
    httpRequest.send();
}

function addonModalToggle() {
    document.querySelector('.addon-modal-window').classList.toggle('addon-modal-hidden');
}

function handleResponse() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        toggleAddonLoading();
        if (httpRequest.status === 200) {
            let response = JSON.parse(httpRequest.responseText);
            if (response.status) {
                generateForm(response.html);
            }
        } else {
            alert('There was a problem with the request.');
            addonModalToggle();
        }
    }
}

function generateForm(html) {
    var div = document.createElement("div");
    div.innerHTML = html;
    document.querySelector('.modal-form-data .form').appendChild(div);
}

function setFormName(name) {
    document.querySelector('.addon-modal-title').innerHTML = name;
}

function toggleAddonLoading() {
    document.querySelector('.addon-form-loading').classList.toggle('addon-modal-dnone');

}

function clearForm() {
    document.querySelector('.modal-form-data .form').innerHTML = '';
    setFormName('');
}
