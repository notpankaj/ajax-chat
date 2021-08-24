function togglePass(){
    if(pswField.getAttribute('type') == 'password'){
        pswField.setAttribute('type','text');
        showHideBtn.classList.add('active');
    }else {
        pswField.setAttribute('type','password');
        showHideBtn.classList.add('active');
    }
}
const pswField = document.querySelector('form .field input[type="password"]');
const showHideBtn = document.querySelector('form .field i');
showHideBtn.addEventListener('click',togglePass);
