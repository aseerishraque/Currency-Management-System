<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$id = ($_POST['id']);
$rate = ($_POST['rate']);
$brate = ($_POST['brate']);

mysqli_query($bd,"UPDATE rates SET rate='$rate', buyrate='$brate' WHERE id='$id'");
header("location: editrates.php");
?>