function id(id){
    return document.getElementById(id);
}
function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+
    ((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}
function checkpw(form){
    if(form.password.value != form.confirmPassword.value){
        id("message").textContent="The passwords entered do not match !";
        form.username.focus();
        return;
    }
    else
        id("message").textContent="";
}
function register(form){
    if(form.fullName.value == ""){
        id("message").textContent="please enter your name";
        form.fullName.focus();
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
    if(form.email.value == ""){
        id("message").textContent="please enter your email";
        form.email.focus();
        return;
    }
    else
        id("message").textContent="";
    if(form.city_of_residence.value == ""){
        id("message").textContent="please enter the city of residence";
        form.city_of_residence.focus();
        return;
    }
    else
        id("message").textContent="";
    if(form.confirmPassword.value == ""){
        id("message").textContent="please enter the confirm password";
        form.confirmPassword.focus();
        return;
    }
    else
        id("message").textContent="";
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            var check = this.responseText;
            if(check == "true"){
                setCookie('fullName',form.fullName.value,10);
                alert("success");
                location.replace("accountPage.php");
            }
            else if(check == "same"){
                id("check").textContent="this email has been used";
                return;
            }
            else if(check == "false"){
                id("check").textContent="wrong email or password";
                return;
            }
            else{
                id("check").textContent=check;
                return;
            }
        }
    }
    ajax.open("POST","..\controllers\index.php");
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("fullName="+form.fullName.value+"&password="+form.password.value+"email="+form.email.value+"city_of_residence="+form.city_of_residence.value);		
}