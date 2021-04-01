function id(id){
    return document.getElementById(id);
}
function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+
    ((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}
function login(form){
    if(form.email.value == ""){
        id("message").textContent="please enter your email";
        form.email.focus();
        return;
    }
    else
        id("message").textContent="";
    if(form.password.value == ""){
        id("message").textContent="please enter the password";
        form.password.focus();
        return;
    }
    else
        id("message").textContent="";
    
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var check = this.responseText;
            alert(check);
            if(check == "true"){
                setCookie('email',form.email.value,10);
                location.replace("accountPage.php");
            }
            else if(check == "false"){
                id("message").textContent="wrong email or password";
                return;
            }
            else{
                id("message").textContent="...error";		
                return;
            }
        }
    }
    ajax.open("POST","..\controllers\index.php");
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("email="+form.email.value+"&password="+form.password.value);
}