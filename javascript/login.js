const form = document.querySelector('.login form');
const continueBtn = document.querySelector('.button input');
const errorText = form.querySelector('.error-txt');


form.addEventListener('submit', e => e.preventDefault());

continueBtn.onclick = () => {
    let xhr  = new XMLHttpRequest();
    xhr.open("POST","php/login.php",true);
    xhr.onload =  () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){
                    location.href = 'users.php';
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    } 

    //send data 

    let formData  = new FormData(form); //create new formdata
    xhr.send(formData); //send form data to php
}