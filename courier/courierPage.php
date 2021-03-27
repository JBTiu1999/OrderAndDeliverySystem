<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
	function orderDeliveredCheck($value){
		include '../viewAndControl/dbh.inc.php';
			
		$booleanValue = false;
		$resultValue = 0;
		$sql = "SELECT orderdelivered from orders WHERE orderid = $value";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$resultValue = $row['orderdelivered'];
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		
		if($resultValue == 1){
			$booleanValue = true;
		}
		mysqli_close($link);
		return $booleanValue;
	}

	session_start();
	if(!isset($_SESSION['username'])){
		header('location: courierLogin.php');
	}
	include '../viewAndControl/databaseView.php';
	include '../viewAndControl/databaseControl.php';
	$orderid = getOrderidForCourier($_SESSION['courierid']);
	$orderlist = getOrderlistForCourier($_SESSION['courierid']);
	$orderprice = getOrderpriceForCourier($_SESSION['courierid']);
	$orderstatus = getOrderstatusForCourier($_SESSION['courierid']);
	
	
	//put only the orders assigned to the courier
?>
<script>
	function logout() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}
	// Close the dropdown menu if the user clicks outside of it
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}
</script>

<style>

	<?php
		for($i=0; $i<count($orderid); $i++){
	?>
		#cm-popup-<?php echo $i ?>{
			display:none;
			box-shadow: 0 0 10px #888888;
			position:fixed;
			left:50%;
			transform:translateY(-70%)translateX(-60%);
			width:50%;
			height:250px;
			background:#FFFFFF;
	   }
		.cm-btn-<?php echo $i ?>{
			border:none;
			background:#405080;
			color:white;
			border-radius:2px;
		}
	<?php
		}
	?>

</style>
</head>
<body>
<header>
  <div class="container bg-info p-5 ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="row">
			<div class="col-md-6 text-left">
				<div class="dropdown">
					<button onclick="logout()" class="dropbtn"><span class="navbar-toggler-icon"></span></button>
					<div id="myDropdown" class="dropdown-content">
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 text-right">
				<font class="navbar-brand">Welcome, <?php echo $_SESSION['couriername'] ?></font>
			</div>
		</div>
    </nav>
  </div>
</header>
<!---->
<main>
<div class="container my-5">
       <div class="card-body text-center">
    <h4 class="card-title">Orders Assigned</h4>
    <p class="card-text">Below is the order assigned to you</p>
  </div>
    <div class="card">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Order Details </th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
				<form method = "post">
					<?php
						for($i=0; $i<count($orderid); $i++){
					?>
							<tr>
								<th scope='row'> <?php echo $orderid[$i] ?> </th>
								<td> <?php echo getCustomerNameForCourier($orderid[$i]); ?> </td>
								<td>
									<button class='btn btn-sm btn-info' type="button" name='details<?php echo $i ?>' onclick="document.getElementById('cm-popup-<?php echo $i ?>').style.display='block'">Details</button> 
									<div id="cm-popup-<?php echo $i ?>">
										<h2 style="width:100%;color:white;text-align:center;padding:1%;background:#405080;">
											<?php
												echo getCustomerNameForCourier($orderid[$i]) . " Order Details";
											?>
											<button
												class="cm-btn-<?php echo $i ?>"
												style="background:red;position:absolute;top:0%;right:0%;width:40x; height:40px;"
												onclick="document.getElementById('cm-popup-<?php echo $i ?>').style.display='none'"
												type="button">
												x
											</button>
										</h2>
										<center>
											<table style="width:80%;text-align:center;height:100px;">
												<tr>
													<td>Order ID: </td>
													<td><?php echo $orderid[$i] ?></td>
												</tr>
												<tr>
													<td>Orders: </td>
													<td><?php echo $orderlist[$i] ?></td>
												</tr>
												<tr>
													<td>Total Price: </td>
													<td><?php echo $orderprice[$i] ?></td>
												</tr>
												<tr>
													<td>Order Status: </td>
													<td><?php echo $orderstatus[$i] ?></td>
												</tr>
											</table>
										</center>
									</div>
								</td>
								<td> 
								<?php
									if(orderDeliveredCheck($orderid[$i])){
										echo "<img src = 'images/check.jpg' style = 'height:20px; width:20px; '></img>";
									}
									else{
								?>
										<form method = "post">
											<input type="submit" class='btn btn-sm btn-success' name='delivered' value = "Order Delivered"><i class='fas fa-trash-alt'> 
											<?php
											if(isset($_POST['delivered'])){
												orderDelivered($orderid[$i], $_SESSION['courierid']);
												echo "<meta http-equiv='refresh' content='0'>";
											}
											?>
										</form>
								<?php
									}
								?>
								</td>
							</tr>
					<?php
						}
					?>
				</form>
            </tbody>
         </table>
    </div>

</div>
</main>
<footer >
  <div class="container bg-info p-5">

	</div>
</footer>
</body>
</html>