function handleClick(){
    searchBar.classList.toggle('active');
    searchBar.value= "";
    searchBar.focus();
    searchBtn.classList.toggle('active');
}

//user fetch
const userList =  document.querySelector('.users-list');
setInterval(() => {
    let xhr  = new XMLHttpRequest();
    xhr.open("GET","php/users.php",true);
    xhr.onload =  () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains('active')){
                    userList.innerHTML = data;
                }
            }
        }
    } 
    xhr.send();
},500);

const handleSearch = (e) => {
    let searchTerm = e.target.value;

    if(!searchTerm == ""){
        searchBar.classList.add('active');
    }else{
    searchBar.classList.remove('active');
    }

    
    let xhr  = new XMLHttpRequest();
    xhr.open("POST","php/search.php",true);
    xhr.onload =  () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                userList.innerHTML = data;
            }
        }
    } 
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded')
    xhr.send("searchTerm="+searchTerm);
}


const searchBar = document.querySelector('.users .search input');
const searchBtn = document.querySelector('.users .search button');
searchBtn.addEventListener('click',handleClick);
searchBar.addEventListener('keyup',handleSearch);
