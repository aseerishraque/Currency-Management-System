<?php
include('db.php');
require_once('auth.php');
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
//Function to sanitize values received from the form. Prevents SQL injection

//Sanitize the POST values 
$transactiontype= ($_POST['transactiontype']);
$sourceoffund= ($_POST['sourceoffund']);
$gffg= ($_POST['transaction']);
$currency= ($_POST['currency']);
$modeoftrans= ($_POST['modeoftrans']);
$amount = ($_POST['amount']);
$cusname = ($_POST['amots']);
$currency = ($_POST['currency']);
$serial = ($_POST['serial']);
$bname = ($_POST['bname']);
$da=date("Y-m-d");
$brach=$_SESSION['SESS_LAST_NAME'];
$resultf = mysqli_query($bd,"SELECT * FROM transaction where transaction_nu='$gffg' and serial='$serial'");
while($rowf = mysqli_fetch_array($resultf))
	{
	$cccvvv=$rowf['cusname'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Duplicate Serial Number';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
	exit();
	}
	}
	}
$result = mysqli_query($bd,"SELECT * FROM rates where currency='$currency'");
while($row = mysqli_fetch_array($result))
	{
		if ($transactiontype=='Buy'){
		$cur=$row['buyrate'];
		}
		if ($transactiontype=='Sell'){
		$cur=$row['rate'];
		}
	}
$total=$amount*$cur;
if(($currency=='USD') && ($bname!=''))
	{
		if($transactiontype=='Buy'){
		$rem = ($_POST['remarks']);
		mysqli_query($bd,"UPDATE bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount' WHERE bank_code='$bname'");
		mysqli_query($bd,"INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','$amount','0','$bname','$rem','$total')");
//mysqli_query($bd,"UPDATE bank_account SET debit=debit, credit=credit+$total, balance=balance+(debit-credit) WHERE bank_name='$sourceoffund'");
		}
		if($transactiontype=='Sell'){
		$rem = ($_POST['remarks']);
		mysqli_query($bd,"UPDATE bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount' WHERE bank_code='$bname'");
		mysqli_query($bd,"INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','0','$amount','$bname','$rem','$total')");
//mysqli_query($bd,"UPDATE bank_account SET debit=debit+$total, credit=credit, balance=balance+(debit-credit) WHERE bank_name='$sourceoffund'");
		}
	}
if(($currency!='USD') && ($bname!='')){
if($transactiontype=='Buy'){
		$rem = ($_POST['remarks']);
		mysqli_query($bd,"UPDATE other_bank_account SET debit=debit+$amount, credit=credit+0, balance=balance+'$amount', pesoval=pesoval+'$total' WHERE bank_code='$bname'");
		mysqli_query($bd,"INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','$amount','0','$bname','$rem','$total')");
		}
		if($transactiontype=='Sell'){
		$rem = ($_POST['remarks']);
		mysqli_query($bd,"UPDATE other_bank_account SET debit=debit+0, credit=credit+$amount, balance=balance-'$amount', pesoval=pesoval-'$total' WHERE bank_code='$bname'");
		mysqli_query($bd,"INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','0','$amount','$bname','$rem','$total')");
		}
}
mysqli_query($bd,"INSERT INTO transaction (transaction_nu, amount, currency, rate, serial, netconvert, cusname, trans_type, pitsa, mode, branch)
VALUES ('$gffg','$amount','$currency','$cur','$serial','$total','$cusname','$transactiontype','$da','$modeoftrans','$brach')");
header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
?>