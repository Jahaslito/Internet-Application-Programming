 <?php
include_once 'user.php';
include_once 'db.php';
$con = new DBConnector();
$pdo = $con->connectToDB();
  session_start();
  if (isset($_SESSION['email'])){
    $email =  $_SESSION['email'];
    $user = new User($email, "pass");
   
  $user->getData($pdo);
  
  }else{
    echo "Session not found!";
  }
  
 ?> 
 <!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<title>Account</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="..\styles\accountPage.css">
</head>
<body>

<!-- <div class="header">
 --><div class="btn-group" style="align-items: right;">
  <a type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="left: 1245px; margin-top: 5px; margin-right: 3px; box-shadow: currentColor;">
  	Hi  <?php
    echo $user->getFullName();
    ?>
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <form action="..\controllers\index.php" method="POST">
    <button class="dropdown-item fa fa-sign-out" type="submit" >Logout</button>
    <input type="hidden" value="logout" name="event">
    </form>
  </div>
</div>
</div>

<!-- <div class="sidebar">
	<i class="fa fa-user"> Profile</i>
</div> -->
<div class="header">
  <p class="fa fa-cog"> 
    Account settings
  </p>
</div>
<div class="body">

<div class="sidebar">
<div class="card" style="width: 18rem;">
  <div class="card-header fa fa-user">
   <?php
    echo $user->getFullName();
    ?> 
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item fa fa-shopping-cart"> Orders</li>
    <li class="list-group-item fa fa-money"> Payment</li>
    <form action="..\controllers\index.php" method="POST">
    <input type="hidden" value="logout" name="event">
    <button class="list-group-item fa fa-sign-out">Logout</button>
    </form>
  </ul>
</div>
</div>
<div class="col-md-8" style="margin-top: 20px;">
                  <div class="card mb-3" style="width: 500px; height: 500px;">
                    <div class="card-body">
                      <div class="row">
                      	<img src="https://images.unsplash.com/photo-1497044383938-c0486a41b655?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mjd8fHNoYWRvd3xlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="..." class="img-thumbnail">
                        <br>
                        <!-- <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div> -->
                        <div class="col-sm-9 text-secondary">
                          <button type="button" class="btn btn-dark">Change photo</button>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $user->getFullName()?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $user->getEmail()?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          0987654321
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">City Of Residence</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $user->getCityOfResidence()?>
                        </div>
                      </div>
                    </div>
                  </div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Change Password</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Old Password:</label>
            <input type="Password" class="form-control" id="recipient-name" name="oldPassword">
          </div>
          <input type="hidden" value="changePassword" name="event">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">New Password:</label>
            <input type="Password" class="form-control" id="recipient-name" name="newPassword">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Confirm Password:</label>
            <input type="Password" class="form-control" id="recipient-name" name="conffirmPassword">
          </div>
         
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Change password</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>
                </div>
     <!-- </div> -->
</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>