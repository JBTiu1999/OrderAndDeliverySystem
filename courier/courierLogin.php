<!doctype html>
<?php
	include '../viewAndControl/databaseView.php';
	
	$courierUsername = getCouriersUsername();
	$courierPassword = getCouriersPassword();
	$courierAccounts = array(array());
	
	for($i=0;$i<count($courierUsername);$i++){
	$courierAccounts[$i]["username"] = $courierUsername[$i];
	$courierAccounts[$i]["password"] = $courierPassword[$i];
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../css/bootsnip.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Welcome, User!</title>
	</head>
	<body>
	<div class="wrapper fadeInDown">
		<div id="formContent">
		
		<br>
		<font color="#000000" class="fadeIn first"> Welcome, Courier! </font><br><br>

		
		<form form name = "login" method = "post">
			<input type="text" name="username" id="login" class="fadeIn second" name="login" placeholder="login">
			<input type="password" name="password" id="password" class="fadeIn third" name="login" placeholder="password">
			<input type="submit" name="submit" class="fadeIn fourth" value="Log In">
		</form>
		<a href="../index.php" class="fadeIn fourth">Go back</a>
		<?php
		if(isset($_POST['submit'])){
			$wrongCredentials = 0;
			for($i=0; $i<count($courierUsername); $i++){
				if($wrongCredentials == 1){
					break;
					header('location: courierLogin.php');
				}
				if($_POST['username'] == $courierAccounts[$i]['username']){
					if($_POST['password'] == $courierAccounts[$i]['password']){
						session_start();
						$_SESSION['username'] = $_POST['username'];
						$_SESSION['password'] = $_POST['password'];
						$_SESSION['couriername'] = getCourierNameForCourier($_POST['username']);
						$_SESSION['courierid'] = getCourieridForCourier($_POST['username']);
						header('location: courierPage.php');
					}
					else{
						$wrongCredentials = 1;
						echo "
						<div class='row'>
						<div class = 'col-2'></div>
						<div class = 'col-8'>
							<div class='alert alert-danger' role='alert'>
								Wrong courier credentials!
							</div>
						</div>
						<div class = 'col-2'></div>
						</div>
					";
					}
				}
			}
		}
		?>
		</div>
		
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</body>
</html>