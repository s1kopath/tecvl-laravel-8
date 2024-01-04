document.getElementById('payment-alert-icon').onclick=(function(){
   const delIcon= document.querySelectorAll('.payment-alert,.payment-form-alert')
   for(let icon of delIcon){
      icon.style.display='none';
   }
})

