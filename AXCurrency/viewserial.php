<?php
include('db.php');
$id=$_GET['id'];
$resulti = mysqli_query($bd,"SELECT * FROM transaction WHERE transaction_nu='$id'");
while($rowi = mysqli_fetch_array($resulti))
{
echo $rowi['serial'].', ';
}
?>