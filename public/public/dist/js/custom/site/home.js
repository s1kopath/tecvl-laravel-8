"use strict";

// Bottom nav start
var slideIndex = 1;

function plusSlides(n) {
    showSlides(0);
}

function currentSlides(n) {
    showSlides(slideIndex = n);
}

var slideIndex = 0;

let timeoutHandle;

function showSlides(auto = 1) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    if (auto) {
        timeoutHandle = window.setTimeout(showSlides, 4000);
    }
    else {
        window.clearTimeout(timeoutHandle);
        timeoutHandle = window.setTimeout(showSlides, 4000);
    }
}


// Bottom nav end

var slideIndexs = 1;

function plusSlidess(p) {
    showSlidess(slideIndexs += p);
}

function currentSlide(p) {
    showSlidess(slideIndexs = p);
}

function showSlidess(p) {
    var i;
    var slides = document.getElementsByClassName("mySlidess");
    var dotss = document.getElementsByClassName("dotss");
    if (p > slides.length) { slideIndexs = 1 }
    if (p < 1) { slideIndexs = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dotss.length; i++) {
        dotss[i].className = dotss[i].className.replace(" active", "");
    }
    slides[slideIndexs-1].style.display = "block";
    dotss[slideIndexs-1].className += " active";
}



function Tabs(options) {

    var tabs = document.querySelector(options.el);
    var initCalled = false;
    var tabNavigation = tabs.querySelector(".c-tabs-nav");
    var tabNavigationLinks = tabs.querySelectorAll(".c-tabs-nav__link");
    var tabContentContainers = tabs.querySelectorAll(".c-tab");
    var marker = options.marker ? createNavMarker() : false;
    var activeIndex = 0;

    function init() {
        if (!initCalled) {
            initCalled = true;

            for (var i = 0; i < tabNavigationLinks.length; i++) {
                var link = tabNavigationLinks[i];
                clickHandlerSetup(link, i)
            }

            if (marker) {
                setMarker(tabNavigationLinks[activeIndex]);
            }
        }
    }

    function clickHandlerSetup(link, index) {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            goToTab(index);
        })
    }

    function goToTab(index) {
        if (index >= 0 && index != activeIndex && index <= tabNavigationLinks.length) {
            tabNavigationLinks[activeIndex].classList.remove('is-active');
            tabNavigationLinks[index].classList.add('is-active');

            tabContentContainers[activeIndex].classList.remove('is-active');
            tabContentContainers[index].classList.add('is-active');

            if (marker) {
                setMarker(tabNavigationLinks[index]);
            }

            activeIndex = index;
        }
    }

    function createNavMarker() {
        var marker = document.createElement("div");
        marker.classList.add("c-tab-nav-marker");
        tabNavigation.appendChild(marker);
        return marker;
    }

    function setMarker(element) {
        marker.style.left = element.offsetLeft + "px";
        marker.style.width = element.offsetWidth + "px";
    }

        return {
            init: init,
            goToTab: goToTab
        }
}


const iniTabs = () => {
    document.querySelectorAll('.p_tabs').forEach(tab => {
        console.log(tab.id)
        var m = new Tabs({
            el: "#" + tab.id,
            marker: true
        });

        m.init();
    })
}

iniTabs();

$(document).ready(function() {

    /* Big cards slider */
    $('.slider-big-cards').slick({
        arrows: false,
        dots: false,
        infinite: true,
        initialSlide: 0.5,
        slidesToScroll: 1,
        slidesToShow: 7
    });
});

var slideInd = 0;

const showSliderr = () => {
    var i;
    var slid = document.getElementsByClassName("mySliderr");
    for (i = 0; i < slid.length; i++) {
        slid[i].style.display = "none";
    }
    slideInd++;
    if (slideInd > slid.length) { slideInd = 1 }
    slid[slideInd-1].style.display = "block";
    setTimeout(showSliderr, 4000); // Change image every 4 seconds
}


const initAllSlides = () => {
    let sliderr = document.querySelectorAll('.mySliderr');
    if(sliderr.length > 0) {
        showSliderr();
    }
    let slidess = document.querySelectorAll('.mySlidess');
    if(slidess.length > 0) {
        showSlidess(slideIndexs);
    }
    let slides = document.querySelectorAll('.mySlides');
    if(slides.length > 0) {
        showSlides();
    }
}
initAllSlides();

$('.sidebar_slider').each(function() {
    var slideInd = 0;

    var main = $(this).find('.builder_slider').get()
    builderSlider();

    function builderSlider() {
        var i;
        var slid = main;
        for (i = 0; i < slid.length; i++) {
            slid[i].style.display = "none";
        }
        slideInd++;
        if (slideInd > slid.length) { slideInd = 1 }
        slid[slideInd-1].style.display = "block";
        setTimeout(builderSlider, 4000); // Change image every 4 seconds
    }
})

