const form  = document.querySelector('.typing-area');
const input = form.querySelector('.input-filed');
const sendBtn = form.querySelector('button');
const chatBox = document.querySelector('.chat-box');

form.onsubmit = e => e.preventDefault();

sendBtn.addEventListener('click',(e)=>{
    const msg = input.value;
    
    let xhr  = new XMLHttpRequest();
    xhr.open("POST","php/insert-chat.php",true);
    xhr.onload =  () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                input.value = "";
            }
        }
    } 

    //send data 

    let formData  = new FormData(form); //create new formdata
    xhr.send(formData); //send form data to php
    
});

// dynamic chat
setInterval(() => {
    let xhr  = new XMLHttpRequest();
    xhr.open("POST","php/get-chat.php",true);
    xhr.onload =  () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                chatBox.innerHTML = data;
            }
        }
    } 
    let formData  = new FormData(form); 
    xhr.send(formData);
},500);