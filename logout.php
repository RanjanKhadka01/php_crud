<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

session_destroy();
echo "<script>alert('Logout Successfully')</script>";
header("Location: login.php");

?>