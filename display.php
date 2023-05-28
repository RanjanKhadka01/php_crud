<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'connect.php';


if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $sql = "SELECT name FROM `register` WHERE id = " . intval($id);
  $result = mysqli_query($con, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    echo $name;

    $_SESSION['name'] = $name;
  } else {
    $_SESSION['name'] = "Guest";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .navbar{
        display: flex;
        /* flex-direction: row-reverse; */
      }
      .a{
        background-color: wheat;
        border-radius: 25px;
        height: 25px;
        width: 30px;
        padding: 2px 5px;
      }
    </style>
</head>
<body>
    <div class="container">

    <div class="header">
      <div class="navbar">
      <span>Welcome <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></span>
        <!-- <span>Welcome <?php echo $_SESSION['name']; ?></span> -->
     <button><a href="logout.php"><i class="fa-solid fa-user a"></i></a></button>
      </div>
    </div>

        <button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add User</a></button>

        <table class="table">
  <thead>
    <tr>
      <th scope="col">SN. No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Password</th>
      <th scope="col">Photo</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>

  <?php
  
  $sql = "Select * from `user`";
  $result = mysqli_query($con, $sql);
  $serialNumber = 1;
  if($result){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];
        $photo = $row['photos'];
        echo '<tr>
        <th scope="row">'.$serialNumber.'</th>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$mobile.'</td>
        <td>'.$password.'</td>
        <td><img src="uploads/'.$photo.'" alt="User Photo" height="50"></td>
        <td>
    <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
    <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
</td>
      </tr>';
      $serialNumber++;
    }
    
  }
  
  ?>
  </tbody>
</table>
    </div>
</body>
</html>