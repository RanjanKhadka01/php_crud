<?php
$con = new mysqli('localhost', 'root', '', 'crud_php');

if(!$con) {
    die(mysqli_error($con));
}

?>