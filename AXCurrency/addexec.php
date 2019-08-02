<?php
require_once('auth.php');
include('db.php');
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$fname = ($_POST['fname']);
$lname = ($_POST['lname']);
$mname = ($_POST['mname']);
$contact = ($_POST['contact']);
$country = ($_POST['country']);
$city = ($_POST['city']);
$address = ($_POST['address']);
$gender = ($_POST['gender']);
$resultf = mysqli_query($bd,"SELECT * FROM customer where fname='$fname' AND lname='$lname' AND mname='$mname' AND contact='$contact' AND gender='$gender'");
while($rowf = mysqli_fetch_array($resultf))
	{
	$cccvvv=$rowf['fname'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'User Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: customer.php");
	exit();
	}
	}
	}
mysqli_query($bd,"INSERT INTO customer (fname, lname, mname, contact, country, city, address, gender)
VALUES ('$fname','$lname','$mname','$contact','$country','$city','$address','$gender')");
header("location: customer.php");
?>