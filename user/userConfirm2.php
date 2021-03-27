<!doctype html>
<?php

	session_start();
	$totalPrice = $_SESSION['totalPrice'];
	include '../viewAndControl/databaseView.php';
	include '../viewAndControl/databaseControl.php';
	
	$currentOrders = array();
	$currentOrders = $_SESSION['orderedProduct'];
	$priceArray = $_SESSION['priceArray'];
	
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
			<font class='fadeIn first'>You ordered the following: </font><br>
			<center>
				<table border=1px cellpadding="25" class='fadeIn second'>
					<?php
						for($i=-1; $i<count($currentOrders); $i++){
							echo "<tr>";
							if($i == -1){
								echo "<td>Product Name</td><td>Product Price</td>";
							}
							else{
								echo "<td>$currentOrders[$i]</td><td>$priceArray[$i]</td>";
							}
							echo "</tr>";
						}
					?>
				</table>
			</center>
			<br><br><br>
					<font class='fadeIn second'> Are you sure? </font><br>
					<form class='fadeIn second' method='post'>
						<input type = 'submit' name='yes' value='Yes'>
						<input type = 'submit' name='no' value='No'>
					</form>
					<?php
						if(isset($_POST['yes'])){
							header("Location: userOrderSubmitted.php");
							}
						else if(isset($_POST['no'])){
							header("Location: user.php");
						}
					?>
				