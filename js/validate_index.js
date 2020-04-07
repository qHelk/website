'use strict'
 let k = 0;
function validateInputEmail(element) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    let errorBlock = document.getElementById('text-error_email');
    let button = document.getElementById('feedback-btn');
    if(reg.test(element.value) == false){
        button.disabled = true;
        element.style.borderColor = 'red';
        errorBlock.innerHTML = 'Введите корректный email! (example@e-mail.com)';
    }else{
        element.style.borderColor = 'greenyellow';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 2){
        button.removeAttribute("disabled");
    }
}
function validateInputName(element) {
    let errorBlock = document.getElementById('text-error_name');
    let button = document.getElementById('feedback-btn');
    if(element.value.length <= 1){
        button.disabled = true;
        element.style.borderColor = 'red';
        errorBlock.innerHTML = 'Некорректное имя!';
    }else{
        element.style.borderColor = 'greenyellow';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 2){
        button.removeAttribute("disabled");
        
    }
}