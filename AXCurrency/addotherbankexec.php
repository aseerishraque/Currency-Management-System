<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values
$bcode = ($_POST['bcode']);
$bname =($_POST['bname']);
$anum = ($_POST['anum']);
$cur = ($_POST['cur']);
$deb = ($_POST['deb']);
$cred = ($_POST['cred']);
$balance = ($_POST['balance']);
$mmmm = ($_POST['pesoval']);

mysqli_query($bd,"INSERT INTO other_bank_account (bank_code, bank_name, currency, account_num, debit, credit, balance, pesoval)
VALUES ('$bcode','$bname','$cur','$anum','$deb','$cred','$balance','$mmmm')");
header("location: addotherbank.php");
?>