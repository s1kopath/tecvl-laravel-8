"use strict";
let radioSwitch= false;
$('.radio-test').click(function() {
   $('.radio-error-msg').hide();
   radioSwitch= true;
});

$('.save-add-func').click(function() {
if(!radioSwitch){
 $('.radio-error-msg').show();
}
else{
   $('.radio-error-msg').hide();
}
})