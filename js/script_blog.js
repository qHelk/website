'use strict'
function sendingButton(element){
    let button = document.getElementById('sending_button');
    // let message = document.getElementById('message');
    if(element.value.length < 1){
        button.setAttribute('disabled', 'true');
        console.log(element.value.length);
    }else{
        button.removeAttribute('disabled');
        console.log(element.value.length);
    }
}