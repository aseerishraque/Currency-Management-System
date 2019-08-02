<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$bcode = ($_POST['bcode']);
$bname = ($_POST['bname']);
$anum = ($_POST['anum']);
$cur =($_POST['cur']);
$deb =($_POST['deb']);
$cred = ($_POST['cred']);
$balance =($_POST['balance']);
$id = ($_POST['id']);

mysqli_query($bd,"UPDATE bank_account SET bank_code='$bcode', bank_name='$bname', currency='$cur', account_num='$anum', debit='$deb', credit='$cred', balance='$balance' WHERE id='$id'");
header("location: banktransfer.php");
?>