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
$regusername = ($_POST['regusername']);
$regpassword = ($_POST['regpassword']);
$adminpass = ($_POST['adminpass']);
$position = ($_POST['position']);
$branch = ($_POST['branch']);

 
//If there are input validations, redirect back to the login form
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
$result = mysqli_query($bd,"SELECT * FROM user where password='".md5($_POST['adminpass'])."'");
$count=mysqli_num_rows($result);

if($count!=0)
{
mysqli_query($bd,"INSERT INTO user (username, password, position, branch)
VALUES ('$regusername', '".md5($_POST['regpassword'])."', '$position', '$branch')");
$errmsg_arr[] = 'Registration Success You can now login';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
}
else{
$errmsg_arr[] = 'You dont have access to add user pls. contact the administrator';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
}
?> 