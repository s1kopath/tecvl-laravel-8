document.getElementById('filter-btn').addEventListener('click', () => {
    $(document.getElementById('filter-nav')).toggleClass('act');
     $('.overlay-test').show();
     $('html, body').css({
             overflow: 'hidden',
             height: '100vh'
         });
 });

 $('.overlay-test').click(function (event){
         $(this).hide();
         $(document.getElementById('filter-nav')).toggleClass('act');
         $('html, body').css({
             overflow: 'scroll',
             height: 'auto'
         });
  });

  $(document).on('click', '.selected-category,.button-update,.option-checkbox,.item-brand,.item-ratings,.sort_by,.price_range,.clear_all', function() {
     $('html, body').css({
             overflow: 'scroll',
             height: 'auto'
         });
  });
