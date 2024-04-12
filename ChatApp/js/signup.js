const form=document.querySelector('.signup form');
btn=document.querySelector('.button input')
error=form.querySelector('.error');
form.onsubmit=(e)=>{
    e.preventDefault();
}
btn.onclick=()=>{
    let req=new XMLHttpRequest();
    req.open("Post","php/signup.php",true);
    req.onload=()=>{
        if(req.readyState===XMLHttpRequest.DONE) {
            if(req.status===200){
                let data=req.response;
                if(data== 'success'){
                    location.href="user.php";
                }else{
                    error.textContent=data;
                    error.style.display="block";                    
                }
            }
        }
    }
    let formData= new FormData(form);
    req.send(formData);
}
