<?php
	require_once('auth.php');
?>
<html>
<head>
<title>Currency Exchange System</title>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
  </script>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>	
</head>
<body>
<div id="mainwrapper">
<h1>
<a id="addq" href="btransferhome.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
<label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
	<a rel="facebox" href="addbankaccount.php" id="addq"><img src="images/edit.gif">Add Account</a>
	 
</h1>
		<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th> Bank Code </th>
					<th> Bank Name </th>
					<th> Currency </th>
					<th> Account Number </th>
					<th> Debit </th>
					<th> Credit </th>
					<th> Balance </th>
					<?php
					if ($_SESSION['SESS_FIRST_NAME']=="1")
					{
					?>
					<th> Action </th>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
				$result = mysqli_query($bd,"SELECT * FROM bank_account ORDER BY bank_code ASC");
				while($row = mysqli_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['bank_code'].'</td>';
						echo '<td>'.$row['bank_name'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>'.$row['account_num'].'</td>';
						echo '<td>'.$row['debit'].'</td>';
						echo '<td>'.$row['credit'].'</td>';
						echo '<td>'.$row['balance'].'</td>';
						if ($_SESSION['SESS_FIRST_NAME']=="1")
						{
						echo '<td><div align="center"><a rel="facebox" href="editaccount.php?id='.$row['id'].'" title="Click To Edit"><img src="images/edit.gif"></a> | <a href="#" id="'.$row['id'].'" class="delbutton" title="Click To Delete"><img src="images/delete.gif"></a></div></td>';
						}
						echo '</tr>';
					}
				?> 
				<tr><td colspan="4"><strong>Total<strong></td>
				<td style="border-left: 1px solid #C1DAD7;">
				<?php
					$results = mysqli_query($bd,"SELECT sum(debit) FROM bank_account");
							while($row2 = mysqli_fetch_array($results))
							  {
							   $gggg=$row2['sum(debit)'];
							   echo $gggg;
							  }
				?>
				</td>
				<td>
				<?php
					$results = mysqli_query($bd,"SELECT sum(credit) FROM bank_account");
							while($row2 = mysqli_fetch_array($results))
							  {
							   $gggg=$row2['sum(credit)'];
							   echo $gggg;
							  }
				?>
				</td>
				<td>
				<?php
					$results = mysqli_query($bd,"SELECT sum(balance) FROM bank_account");
							while($row2 = mysqli_fetch_array($results))
							  {
							   $gggg=$row2['sum(balance)'];
							   echo $gggg;
							  }
				?>
				</td>
				</tr>
			</tbody>
		</table>
		<INPUT type="button" value="Print" onClick="window.open('reportaccount.php','mywindow','width=600,height=300,scrollbars=yes')">
</div>

  <script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteaccount.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>

</body>
</html>
