
<?php

// This is a sample code in case you wish to check the username from a mysql db table
include('db.php');
if($_GET['id'])
{
$id=$_GET['id'];
 $sql = "delete from transaction where id='$id'";
 mysqli_query($bd, $sql);
}

?>