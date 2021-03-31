// $(document).ready(function(){
//     $("#submit-btn").click(function(e){
//        // e.preventDefault();
//         var username = $("#email").val().trim();
//         var password = $("#password").val().trim();
//         console.log("Working");
//         if( username != "" && password != "" ){
//             $.ajax({
//                 url:'..\controllers\index.php',
//                 type:'post',
//                 data:{username:username,password:password},
//                 success:function(response){
//                     console.log(data);
//                     var msg = "";
//                     if(response == 1){
//                         window.location = "accountPage.php";
//                     }else{
//                         msg = "Invalid username and password!";
//                         console.log("Working with wrong creds");
//                     }
//                     $("#message").html(msg);
//                     console.log(response);
//                 }
//             });
//         }
//     });
// });
setTimeout(5000);
function login(event) {
	event.preventDefault();
var xhttp = new XMLHttpRequest();
        var formData = new FormData(event.target);
        let _this = this;
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var user=JSON.parse(this.responseText);
                console.log(user);
                if (user.verified=== true) {  
                    localStorage.setItem('user',this.responseText);
                    window.location.href = "..\controllers\accountPage.php";
                }
                else {
                    document.getElementById("#message").innerHTML = "Error";
                }
            }
        };
        xhttp.open("POST", "..\controllers\index.php", true);


        console.log(formData);
        xhttp.send(formData);

}