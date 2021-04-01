function checkpw(form){
    if(form.password.value != form.confirmPassword.value){
        id("message").textContent="The passwords entered do not match !";
        form.username.focus();
        return;
    }
    else
        id("message").textContent="";
}

changePassword(event){
    event.preventDefault();
    var xhttp = new XMLHttpRequest();
    var formData = new FormData(event.target);
    let _this = this;
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        
        _this.setState({errorMessage:this.responseText,displayError:{display:'block'}});
      }

    };
    xhttp.open("POST", "..\controllers\index.php", true);


    console.log(formData);
    xhttp.send(formData);

  }
  