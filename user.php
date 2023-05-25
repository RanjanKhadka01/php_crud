<?php
include 'connect.php';

//define variables and set to empty values
$name = $email = $mobile = $password = $photo = "";
$nameErr = $emailErr = $mobileErr = $passwordErr = $photoErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate name field
  if (empty($_POST['name'])) {
      $nameErr = "Name is required";
  } else {
      $name = test_input($_POST['name']);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
          $nameErr = "Only letters and white space allowed";
      }
  }

  if(empty($_POST['email'])){
    $emailErr = "Email is required";
  }else{
    $email = test_input($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $emailErr = "Invalid email format";
    }
  }


  if(empty($_POST['mobile'])){
    $mobileErr = "Mobile is required";
  }else{
    $mobile = test_input($_POST['mobile']);
      if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $mobileErr = "Invalid mobile number";
      }
  }

  if(empty($_POST['password'])){
    $passwordErr = "Password is required";
  }else{
    $password = test_input($_POST['password']);
  }

  if(empty($_POST['photo'])){
    $photoErr = "Photo is required";
  }else{
    $photo = test_input($_FILES['photo']['name']);
    $temp_image = test_input($_FILES['product_image']['temp_name']);

    move_uploaded_file($temp_image, "/uploads/$photo");
  }

  if(empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($passwordErr) && empty($photoErr)) {

    $sql = "insert into `user` (name, email, mobile, password, photos)
    values('$name', '$email', '$mobile', '$password', '$photo')";
    $result = mysqli_query($con, $sql);
    if($result) {
        // echo "Data inserted successfully";
        header('location:display.php');
    }else {
        die(mysqli_error($con));
    } 
  }
}
function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>

    <div class="container my-5">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

  <div class="mb-3">
    <label>Name</label> 
    <input type="text" class="form-control" placeholder="Enter Your Name" name="name" autocomplete="off">
    <span class="text-danger"><?php echo $nameErr; ?></span>
  </div>

  <div class="mb-3">
    <label>Email</label>
    <input type="email" class="form-control" placeholder="Enter Your Email" name="email" autocomplete="off">
    <span class="text-danger"><?php echo $emailErr; ?></span>
  </div>

  <div class="mb-3">
    <label>Mobile</label>
    <input type="text" class="form-control" placeholder="Enter Your Mobile Number" name="mobile" autocomplete="off">
    <span class="text-danger"><?php echo $mobileErr; ?></span>
  </div>

  <div class="mb-3">
    <label>Password</label>
    <input type="password" class="form-control" placeholder="Enter Your Password" name="password" autocomplete="off">
    <span class="text-danger"><?php echo $passwordErr; ?></span>
  </div>

  <div class="mb-3">
    <label>Photo</label>
    <input type="file" class="form-control" name="photo" autocomplete="off">
    <span class="file-danger text-danger"><?php echo $photoErr; ?></span>
  </div>
  
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
    </div>
  </body>
</html>