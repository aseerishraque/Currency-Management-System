<?php
	require_once('auth.php');
?>
<html>
<head>
<title>AX Currency System</title>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
<div id="mainwrapper" style="width: 500px; margin-top: 12px;">
	<h1>
	<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
	Bank Transaction Page
	</h1>
	<div id="homecontent" style="width: 385px;">
		<div style="float:left; width:auto; padding:10px;"><a id="addq" href="banktransfer.php"><img src="images/usdaccount.png" height="64" width="64"><br>USD Account</a></div>
		<div style="float:left; width:auto; padding:10px;"><a href="bankreport.php" id="addq"><img src="images/report.png" height="64" width="64"><br>Report</a></div>
		<div style="float:left; width:auto; padding:10px;"><a rel="facebox" href="debitcredit.php" id="addq"><img src="images/transaction.png" height="64" width="64"><br>Transaction</a></div>
		<div style="float:left; width:auto; padding:10px;"><a href="addotherbank.php" id="addq"><img src="images/otheraccount.png" height="64" width="64"><br>Other Bank Account</a></div>
		<div class="clearfix"></div>
	</div>

</div>
</body>
</html>
