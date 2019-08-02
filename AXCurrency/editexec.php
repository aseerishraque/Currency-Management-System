<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$id = ($_POST['id']);
$fname = ($_POST['fname']);
$lname = ($_POST['lname']);
$contact = ($_POST['contact']);
$country = ($_POST['country']);
$city = ($_POST['city']);
$address = ($_POST['address']);
$gender = ($_POST['gender']);

mysqli_query($bd,"UPDATE customer SET fname='$fname', lname='$lname', contact='$contact', country='$country', city='$city', address='$address', gender='$gender' WHERE id='$id'");
header("location: customer.php");
?>