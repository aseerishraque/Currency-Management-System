<?php
require_once('auth.php');
include('db.php');


$amount=($_POST['amount']);
$fddd= ($_POST['fddd']);
$tddd= ($_POST['tddd']);
$rem='from '.$fddd;
function createRandomPassword() {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}
$finalcode='BS-'.createRandomPassword();
$da=date("Y-m-d");
$resultx = mysqli_query($bd,"SELECT * FROM other_bank_account WHERE bank_code='$tddd'");
				while($rowx = mysqli_fetch_array($resultx))
					{
					$tttttt=$rowx['currency'];
					}
$resultxs = mysqli_query($bd,"SELECT * FROM rates WHERE currency='$tttttt'");
				while($rowxs = mysqli_fetch_array($resultxs))
					{
					$jkjk=$rowxs['rate'];
					}
$fdbn=$amount*$jkjk;
mysqli_query($con,"UPDATE bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount' WHERE bank_code='$tddd'");
mysqli_query($con,"UPDATE bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount' WHERE bank_code='$fddd'");
mysqli_query($con,"UPDATE other_bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount', pesoval=pesoval+'$fdbn' WHERE bank_code='$tddd'");
mysqli_query($con,"UPDATE other_bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount', pesoval=pesoval-'$fdbn' WHERE bank_code='$fddd'");
mysqli_query($con,"INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$finalcode','$da','$amount','0','$tddd','$rem','$amount')");
header("location: home.php");
?>