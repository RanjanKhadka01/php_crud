<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$name = $email = $password = $number = $gender = "";
$nameErr = $emailErr = $passwordErr = $numberErr = $genderErr = "";

if (isset($_POST['register'])) {
  if (empty($_POST['name'])) {
    $nameErr = "Name is required";
  } else {
    $name = $_POST['name'];
    if (!preg_match("/^[a-zA-Z-']*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST['email'])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid Email";
    }
  }

  if (empty($_POST['password'])) {
    $passwordErr = "Password is required";
  } else {
    $password = $_POST['password'];
  }

  if (empty($_POST['number'])) {
    $numberErr = "Number is required";
  } else {
    $number = $_POST['number'];
    if (!preg_match("/^[0-9]{10}$/", $number)) {
      $numberErr = "Invalid mobile number";
    }
  }

  if (empty($_POST['gender'])) {
    $genderErr = "Gender is required";
  } else {
    $gender = $_POST['gender'];
  }

  if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($numberErr) && empty($genderErr)) {
    $sql = "INSERT INTO `register` (name, email, password, number, gender) VALUES ('$name', '$email', '$password', '$number', '$gender')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo "Data inserted successfully";
    } else {
      echo "Error while inserting data: " . mysqli_error($con);
    }
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
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name">
    <span class="text-danger"><?php echo $nameErr; ?></span>
  </div>

  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" name="email">
    <span class="text-danger"><?php echo $emailErr; ?></span>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
    <span class="text-danger"><?php echo $passwordErr; ?></span>
  </div>

  <div class="mb-3">
    <label class="form-label">Number</label>
    <input type="text" class="form-control" name="number">
    <span class="text-danger"><?php echo $numberErr; ?></span>
  </div>

  <div class="mb-3">
  <select class="form-select" name="gender">
  <option selected>Select Gender</option>
  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="others">Others</option>
  <span class="text-danger"><?php echo $genderErr; ?></span>
</select>
  </div>
  
  <button type="submit" class="btn btn-primary" name="register">Register</button><br>
  <a href="login.php">Already Register..</a>
</form>
</div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>