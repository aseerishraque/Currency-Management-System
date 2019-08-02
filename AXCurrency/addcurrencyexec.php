<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$currency = ($_POST['currency']);
$dfdfdf = ($_POST['currency_name']);
$rate =($_POST['rate']);
$brate = ($_POST['brate']);

mysqli_query($bd,"INSERT INTO rates (currency, rate, buyrate, name)
VALUES ('$currency','$rate','$brate','$dfdfdf')");
header("location: editrates.php");
?>