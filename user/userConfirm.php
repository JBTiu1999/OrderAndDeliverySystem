<!doctype html>
<?php

	session_start();
	$totalPrice = $_SESSION['totalPrice'];
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
				<font class='fadeIn first'>Do you have additional orders?</font><br>
					<form class='fadeIn second' method='post'>
						<input type = 'submit' name='yes' value='Yes'>
						<input type = 'submit' name='no' value='No'>
					</form>
				<?php
					$currentOrders = array();
					$currentOrders = $_SESSION['orderedProduct'];
							
					echo "You are currently ordering: <br>";
					for($i=0; $i<count($currentOrders); $i++){
						if($i == count($currentOrders)-1){
							echo $currentOrders[$i];
						}
						else{
							echo $currentOrders[$i] . ", ";
						}
					}
					
					echo "<br>";
					echo "Your total purchase price is: " . $totalPrice;
					
					if(isset($_POST['yes'])){
						header("Location: user2.php");
						}
					else if(isset($_POST['no'])){
						header("Location: userConfirm2.php");
					}
				?>