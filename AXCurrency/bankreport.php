<?php
	require_once('auth.php');
?>
<?php
			echo '<div style="display:none;">';
			$a=$_POST['from'];
			$b=$_POST['to'];
			$bankname=$_POST['bankname'];
			echo '</div>';
?>
<html>
<head>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
</head>
<body>
<div id="mainwrapper">
<h1>
	<a id="addq" href="btransferhome.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
</h1>
<form action="bankreport.php" method="post">
From: <input name="from" type="text" class="tcal"/>
  To: <input name="to" type="text" class="tcal"/><br>
  Bank Name:
  <select name="bankname">
	<?php
	include('db.php');
	$resul = mysqli_query($bd,"SELECT * FROM bank_account ORDER BY bank_name ASC");
	while($rowh = mysqli_fetch_array($resul))
	{
	echo '<option>'.$rowh['bank_name'].'</option>';
	}
	$resul = mysqli_query($bd,"SELECT * FROM other_bank_account ORDER BY bank_name ASC");
	while($rowh = mysqli_fetch_array($resul))
	{
	echo '<option>'.$rowh['bank_name'].'</option>';
	}
	?>
  </select>
  <input name="filtercat" type="submit" value="Generate Data" />
  
</form>
<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th colspan="7" width="114"  style="border-left: 1px solid #C1DAD7"> <?php echo $bankname ?> </th>
				</tr>
				<tr>
					<th width="114"  style="border-left: 1px solid #C1DAD7"> Transaction Number </th>
					<th width="114"> Date </th>
					<th width="114"> Bank Name </th>
					<th width="114"> Debit </th>
					<th width="114"> Credit </th>
					<th width="114"> Balance </th>
					<th width="114"> Remarks </th>
				</tr>
			</thead>
			<tbody>
			<?php
			
				$resulta = mysqli_query($bd,"SELECT * FROM bank_transfer WHERE bank_name='$bankname' AND date BETWEEN '$a' AND '$b' order by date asc");
				while($row = mysqli_fetch_array($resulta))
					{
						echo '<tr>';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['trn_num'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>'.$row['bank_name'].'</td>';
						echo '<td>'.$row['debit'].'</td>';
						echo '<td>'.$row['credit'].'</td>';
						$deb=$row['debit'];
						$cred=$row['credit'];
						$balance=$deb-$cred;
						echo '<td>'.$balance.'</td>';
						echo '<td>'.$row['remarks'].'</td>';
						echo '</tr>';
					}
				?> 
				<tr><td style="border-left: 1px solid #C1DAD7;" colspan="3">&nbsp;</td>
				<td>
				<?php
				$results = mysqli_query($bd,"SELECT sum(debit) FROM bank_transfer WHERE bank_name='$bankname' AND date BETWEEN '$a' AND '$b'");
				while($row2 = mysqli_fetch_array($results))
				  {
				   $dsdsds=$row2['sum(debit)'];
				   echo $dsdsds;
				  }
				?>
				</td>
				<td>
				<?php
				$results = mysqli_query($bd,"SELECT sum(credit) FROM bank_transfer WHERE bank_name='$bankname' AND date BETWEEN '$a' AND '$b'");
				while($row2 = mysqli_fetch_array($results))
				  {
				   $gggg=$row2['sum(credit)'];
				   echo $gggg;
				  }
				?>
				</td>
				<td>
				<?php
				$fff=$dsdsds-$gggg;
				echo $fff;
				?>
				</td>
				</tr>
			</tbody>
		</table>
<br>
<INPUT type="button" value="Print" onClick="window.open('reportbanktransfer.php?from=<?php echo $a ?>&to=<?php echo $b ?>&bname=<?php echo $bankname ?>','mywindow','width=600,height=300,scrollbars=yes')">
</div>
</body>
</html>