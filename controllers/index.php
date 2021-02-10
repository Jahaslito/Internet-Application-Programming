<?php 
include_once 'user.php';
include_once 'db.php';
$con = new DBConnector();
$pdo = $con->connectToDB();
$event = $_POST['event'];
if ($event == "register") {     
       //register   
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $city_of_residence = $_POST['city_of_residence'];
    $password = $_POST['password'];
    $user = new User($email, $password);
    $user->setFullName($fullName);
    $user->setCityOfResidence($city_of_residence);
    echo $user->register($pdo);
} else if($event=="login"){   
         //login 
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User($email, $password);
    if ($user->login($pdo)){
        header("Location: http://localhost/IAP/controllers/accountPage.php");
        die;
    }
    echo $user->login($pdo);
}else if($event=="logout"){   
    //log
session_start();

User::logout();  

}else if($event == "changePassword"){
    session_start();
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
   
    if ( $user->changePassword($pdo, $oldPassword, $newPassword, $confirmPassword) ){
        header("Location: http://localhost/IAP/Views/login.html");
        die;
    }
}
 ?>
