"use strict";
const sellerImages = $('.seller-images').children();
for (let i = 0; i < sellerImages.length; i++) {
    $(sellerImages[i]).css({
        'z-index': sellerImages.length - i
    });
}

let titles = document.querySelectorAll('.accordion__title');
for (let i = 0; i < titles.length; i++) {
  titles[i].addEventListener('click', e => {
    for (let x of titles) {
      if (x !== e.target) {
        x.classList.remove('accordion__title--active');
        x.nextElementSibling.style.maxHeight = 0;
        x.nextElementSibling.style.padding = 0;
      }
    }
    e.target.classList.toggle('accordion__title--active');
    let description = e.target.nextElementSibling;

    if (e.target.classList.contains('accordion__title--active')) {
      description.style.maxHeight = description.scrollHeight + 'px';
    } else {
      description.style.maxHeight = 0;
      description.style.padding = 0;
    }
  });
}