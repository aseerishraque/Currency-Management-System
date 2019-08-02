<?php
include('db.php');
$username=$_POST['username'];
$adminpass=$_POST['adminpass'];
mysqli_query($bd,"INSERT INTO power (username, adminpass)
VALUES ('$username', '$adminpass')");
header("location: home.php");
?> 