<!doctype html>
<?php

	session_start();
	include '../viewAndControl/databaseView.php';
	include '../viewAndControl/databaseControl.php';
	
	if(!isset($_SESSION['name'])){
		header("location: user.php");
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../css/bootsnip.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Welcome!</title>
	</head>
	<body>
		
		<div class="wrapper fadeInDown">
			<div id="formContent">
			<br><br>
			<font class="fadeIn first" > <h1>Welcome, <?php echo $_SESSION['name'] ?>!</h1> <br><br>
				<form method="post">
				<font class='fadeIn first'>Your order has been submitted!</font><br>
					<form class='fadeIn second' method='post'>
						<input type = 'submit' name='goback' value='Back to Customer Page'>
					</form>
				<?php
					if(isset($_POST['goback'])){
						$ordersInserted = implode(', ', $_SESSION['orderedProduct']);
						$insertedName = $_SESSION['name'];
						addOrders($insertedName, $ordersInserted, $_SESSION['totalPrice']);
						session_destroy();
						header("location: user.php");
					}
						
				?>