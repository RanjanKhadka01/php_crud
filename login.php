<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "Select * from `register` where email = '$email' and password = '$password'";
  $result = mysqli_query($con, $sql);
  
  $search = mysqli_num_rows($result);

  if($search){
    header('location: display.php');
  }else{
    echo "Invalid Email or Password";
  }
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="card">
      <div class="container my-5">
    <form method="post" action="">

  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" name="email">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>

  
  <button type="submit" class="btn btn-primary" name="login">Login</button><br>
  <a href="register.php">Don't Have an Account?</a>
</form>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>