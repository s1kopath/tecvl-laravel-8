/*Toggle dropdown list*/
  /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

  var userMenuDiv = document.getElementById("userMenu");
  var userMenu = document.getElementById("userButton");

  document.onclick = check;

  function check(e) {
      var target = (e && e.target) || (event && event.srcElement);

      //User Menu
      if (!checkParent(target, userMenuDiv) && userMenuDiv != null) {
          // click NOT on the menu
          if (checkParent(target, userMenu)) {
              // click on the link
              if (userMenuDiv.classList.contains("invisible")) {
                  userMenuDiv.classList.remove("invisible");
              } else {
                  userMenuDiv.classList.add("invisible");
              }
          } else {
              // click both outside link and outside menu, hide menu
              userMenuDiv.classList.add("invisible");
          }
      }

  }

  function checkParent(t, elm) {
      while (t.parentNode) {
          if (t == elm) {
              return true;
          }
          t = t.parentNode;
      }
      return false;
  }

/*Dropdown Menu*/
$('.dropdown').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menu').slideToggle(300);
});
$('.dropdown').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown-menu').slideUp(300);
});
$('.dropdown .dropdown-menu li').click(function () {
    $(this).parents('.dropdown').find('').text($(this).text());
    $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/


$('.dropdown-menu li').click(function () {
    let parent = getDropdoenParent(this)
var input = '' + $(parent).find('input').val() + '',
  msg = '<span class="msg"> ';
  $(parent).find(".msg").html(msg + input + '</span>');
});


function getDropdoenParent(child){
    return child.closest(".dropdown")
}

// language ltr rtl
document.documentElement.dir = $('#directionSwitch').data("value") == 'ltr' ? 'ltr' : 'rtl';
$('.lang').on('click', function() {
    document.documentElement.dir = $(this).data("value") == 'ltr' ? 'ltr' : 'rtl';
})


  if ($('.main-body .page-wrapper').find('#checkout-container').length){

	$(".payment-product").click(function () {
        $(".payment-product").removeClass("unselected");
        $(".payment-product").removeClass("selected");
        $(this).addClass("selected").siblings().addClass("unselected");
	});
    // accordion js
    document.addEventListener('alpine:init', () => {
        Alpine.store('accordion', {
            tab: 0
        });

        Alpine.data('accordion', (idx) => ({
            init() {
                this.idx = idx;
            },
            idx: -1,
            handleClick() {
                this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
            },
            handleRotate() {
                return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
            },
            handleToggle() {
                return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
            }
        }));
    })

  }

