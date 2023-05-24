<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';


$id = $_GET['updateid'];
$sql = "SELECT * FROM `user` WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];

$nameErr = $emailErr = $mobileErr = $passwordErr = "";

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

  if(empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($passwordErr)) {


    $sql1 = "update `user` set name='$name', email='$email',
    mobile='$mobile', password='$password' where id=$id";
    $result = mysqli_query($con, $sql1);
    if($result) {
        // echo "Data updated successfully";
        header('location:display.php');
    }else {
        die(mysqli_error($con));
    }
  }
}
function test_input($data) {
  global $con;
      $data = trim($data);
      $data = mysqli_real_escape_string($con, $data);
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
    <title>PHP CRUD - Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h1>Update User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?updateid=' . $id); ?>">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                <span class="text-danger"><?php echo $nameErr; ?></span>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $emailErr; ?></span>
            </div>
            <div class="mb-3">
                <label>Mobile</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                <span class="text-danger"><?php echo $mobileErr; ?></span>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                <span class="text-danger"><?php echo $passwordErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>