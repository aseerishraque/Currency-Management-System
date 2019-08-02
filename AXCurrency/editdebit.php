<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$id = ($_POST['id']);
$tdate = ($_POST['tdate']);
$bname = ($_POST['bname']);
$tnum = ($_POST['tnum']);
$deb =($_POST['deb']);
$cred = ($_POST['cred']);
$remarks = ($_POST['remarks']);
mysqli_query($bd,"UPDATE bank_transfer SET trn_num='$tnum', date='$tdate', debit='$deb', credit='$cred', bank_name='$bname', remarks='$remarks' WHERE id='$id'");
header("location: debitcredit.php");
?>