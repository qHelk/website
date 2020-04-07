'use strict'
let k = 0;
function validateInputName(element) {
    let errorBlock = document.getElementById('text-error_name');
    let button = document.getElementById('reg_btn-submit');
    if(element.value.length <= 1){
        button.disabled = true;
        element.className = 'error-border validated-name-lastname';
        errorBlock.innerHTML = 'Некорректное имя!';
    }else{
        element.className = 'success-border validated-name-lastname';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 6){
        button.removeAttribute("disabled");
        
    }
}
function validateInputLastname(element) {
    let errorBlock = document.getElementById('text-error_lastname');
    let button = document.getElementById('reg_btn-submit');
    if(element.value.length < 2){
        button.disabled = true;
        element.className = 'error-border validated-name-lastname';
        errorBlock.innerHTML = 'Некорректная фамилия!';
    }else{
        element.className = 'success-border validated-name-lastname';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 6){
        button.removeAttribute("disabled");
    }
}
function validateInputEmail(element) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    let errorBlock = document.getElementById('text-error_email');
    let button = document.getElementById('reg_btn-submit');
    if(reg.test(element.value) == false){
        button.disabled = true;
        element.className = 'error-border';
        errorBlock.innerHTML = 'Введите корректный email! (example@e-mail.com)';
    }else{
        element.className = 'success-border';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 6){
        button.removeAttribute("disabled");
    }
}

function validateInputPassword(element) {
    let errorBlock = document.getElementById('text-error_password');
    let button = document.getElementById('reg_btn-submit');
    if(element.value.length < 5){
        button.disabled = true;
        element.className = 'error-border';
        errorBlock.innerHTML = 'Пароль должен содержать не менее 5 символов!';
    }else{
        element.className = 'success-border';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k ==6){
        button.removeAttribute("disabled");
    }
}
function validateInputVerifyPassword(element) {
    let errorBlock = document.getElementById('text-error_verifypassword');
    let button = document.getElementById('reg_btn-submit');
    let password = document.getElementById('reg_password-input')
    if(element.value != password.value ){
        button.disabled = true;
        element.className = 'error-border';
        errorBlock.innerHTML = 'Пароли не совпадают!';
    }else{
        element.className = 'success-border';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 6){
        button.removeAttribute("disabled");
    }
}

function validateInputEmailIndex(element) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    let errorBlock = document.getElementById('text-error_email');
    let button = document.getElementById('reg_btn-submit');
    if(reg.test(element.value) == false){
        button.disabled = true;
        element.className = 'error-border';
        errorBlock.innerHTML = 'Введите корректный email! (example@e-mail.com)';
    }else{
        element.className = 'success-border';
        errorBlock.innerHTML = '';
        k = k + 1;
        console.log(k);
    }
    if (k == 6){
        button.removeAttribute("disabled");
    }
}