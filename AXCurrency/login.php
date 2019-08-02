
<?php
//Start session
session_start();
 
//Include database connection details
require_once('db.php');
 
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
 
//Function to sanitize values received from the form. Prevents SQL injection

 
//Sanitize the POST values
$username = ($_POST['username']);
$password = ($_POST['password']);

 
//Create query
$qry="SELECT * FROM user WHERE username='$username' AND password='".md5($_POST['password'])."'";
$result=mysqli_query($bd,$qry);
 
//Check whether the query was successful or not
if($result) 
{
	if(mysqli_num_rows($result) > 0) {
	//Login Successful
	session_regenerate_id();
	$member = mysqli_fetch_assoc($result);
	$_SESSION['SESS_MEMBER_ID'] = $member['id'];
	$_SESSION['SESS_FIRST_NAME'] = $member['position'];
	$_SESSION['SESS_LAST_NAME'] = $member['branch'];
	session_write_close();
	header("location: home.php");
	exit();
	}
	else {
		//Login failed
		$errmsg_arr[] = 'user name and password not found';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
		}
	}
}
else {
die("Query failed");
}
?>