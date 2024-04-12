const search=document.querySelector(".users .search input"),
searchBtn=document.querySelector(".users .search button"),
userList=document.querySelector(".users .user-list");

searchBtn.onclick=()=>{
    search.classList.toggle("active");
    search.focus();
    searchBtn.classList.toggle("active");
    search.value="";
}
search.onkeyup=()=>{
    let searchText= search.value;

    if(searchText!=""){
        searchBtn.classList.add("active");
    }else{
        searchBtn.classList.remove("active");
    }

    let req=new XMLHttpRequest();
    req.open("Post","php/search.php",true);
    req.onload=()=>{
        if(req.readyState===XMLHttpRequest.DONE) {
            if(req.status===200){
                let data=req.response;
                userList.innerHTML=data;
            }
        }
    }
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.send("searchText="+ searchText);
}
setInterval(()=>{
    let req=new XMLHttpRequest();
    req.open("Get","php/user.php",true);
    req.onload=()=>{
        if(req.readyState===XMLHttpRequest.DONE) {
            if(req.status===200){
                let data=req.response;
                if(!search.classList.contains('active')){
                    userList.innerHTML=data;
                }
            }
        }
    }
    req.send();
},500);