<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$id = ($_POST['id']);
$rate = ($_POST['rate']);
$amount = ($_POST['amount']);
$pesoval = $rate*$amount;

mysqli_query($bd,"UPDATE report SET rate='$rate', amount='$amount', pesoval='$pesoval' WHERE id='$id'");
mysqli_query($bd,"UPDATE transaction SET rate='$rate', amount='$amount', netconvert='$pesoval' WHERE transaction_nu='$gggg'");
header("location: masterfile.php");
?>