
<?php

// This is a sample code in case you wish to check the username from a mysql db table
include('db.php');
if($_GET['id'])
{
$id=$_GET['id'];
$result = mysqli_query($bd,"SELECT * FROM bank_transfer where id='$id'");
while($row = mysqli_fetch_array($result))
  {
  $d=$row['debit'];
  $c=$row['credit'];
  $b=$row['bank_name'];
  $pesoval=$row['pesoval'];
  }
  if($d=='0'){
  mysqli_query($bd,"UPDATE bank_account SET debit=debit, credit=credit-'$c', balance=balance+'$c' WHERE bank_name='$b'");
  mysqli_query($bd,"UPDATE other_bank_account SET debit=debit, credit=credit-'$c', balance=balance+'$c', pesoval=pesoval+'$pesoval' WHERE bank_name='$b'");
  }
  if($d!='0'){
  mysqli_query($bd,"UPDATE bank_account SET debit=debit-'$d', credit=credit, balance=balance-'$d' WHERE bank_name='$b'");
  mysqli_query($bd,"UPDATE other_bank_account SET debit=debit-'$d', credit=credit, balance=balance-'$d', pesoval=pesoval-'$pesoval' WHERE bank_name='$b'");
  }
 $sql = "delete from bank_transfer where id='$id'";
 mysqli_query($bd, $sql);
}

?>