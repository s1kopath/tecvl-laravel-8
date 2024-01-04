//notification modal interactive start
let notificationModal = document.querySelector('.notification-modal');
let a=0;
// when users clicked on the notifications icon
document.querySelector('.notifications-show-hide').addEventListener('click', function () {
        if(a==0){
            notificationModal.style.display = 'block';
            a=1;
        }
        else{
            notificationModal.style.display = 'none';
            a=0;
        }
    })
// when users clicked on the outside of notifications modal
document.addEventListener('click',function(e){
        if(e.target.closest('.notification-modal') || e.target.closest('.notifications-show-hide')) 
        {
            return;
        }
        else
        {
            notificationModal.style.display = 'none';
            a=0;
        }
    })
//notification modal interactive end