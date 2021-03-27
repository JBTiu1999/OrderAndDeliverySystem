<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
	session_start();
	
	if(!isset($_SESSION['username'])){
		header('location: adminLogin.php');
	}
	
	include '../viewAndControl/databaseView.php';
	include '../viewAndControl/databaseControl.php';
	
	$orderidAll = getOrders('orderid');
	$orderidUnassigned = getOrders('orderidUnassigned');
	$orderlistUnassigned = getOrders('orderlistUnassigned');
	$customernameUnassigned = getOrders('customeridUnassigned');
	$orderPriceUnassigned = getOrders('orderPriceUnassigned');
	$couriersAvailable = getCouriers('couriername');
	$orderstatusUnassigned = getOrders('orderstatusUnassigned');
	$orderidAssigned = getOrders('orderidAssigned');
	$orderlistAssigned = getOrders('orderlistAssigned');
	$customernameAssigned = getOrders('customeridAssigned');
	$orderPriceAssigned = getOrders('orderPriceAssigned');
	$orderstatusAssigned = getOrders('orderstatusAssigned');
	$courierNameAssigned = getOrders('courierNameAssigned');
	$orderidDelivered = getOrders('orderidDelivered');
	$orderlistDelivered = getOrders('orderlistDelivered');
	$customernameDelivered = getOrders('customeridDelivered');
	$orderPriceDelivered = getOrders('orderPriceDelivered');
	$orderstatusDelivered = getOrders('orderstatusDelivered');
	$courierNameDelivered = getOrders('courierNameDelivered');
	
	$cssNumber=0;
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
	
	function ShowHideDiv() {
        var unassignedTable = document.getElementById("unassignedTable");
        var selectFunction = document.getElementById("selectFunction");
        unassignedTable.style.display = selectFunction.value == "unassigned" ? "block" : "none";
		assignedTable.style.display = selectFunction.value == "assigned" ? "block" : "none";
		deliveredTable.style.display = selectFunction.value == "delivered" ? "block" : "none";
    }
</script>

<style>

	<?php
		for($i=0; $i<count($orderidAll); $i++){
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
	.cm-btn-<?php echo $i?>{
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
  <div class="container bg-info p-5">
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
				<font class="navbar-brand">Welcome, Admin!</font>
			</div>
		</div>
    </nav>
  </div>
</header>
<br>
<center>
	Which table would you like to manage?<br>
    <select id = "selectFunction" onchange = "ShowHideDiv()">
		<option value="none">--Select a table--</option>
        <option value="unassigned">Unassigned Orders Table</option>
        <option value="assigned">Assigned Orders Table</option>
		<option value="delivered">Delivered Orders Table</option>
	</select>
</center>
<!---->
<main>
<div id="unassignedTable" class="container my-5" style="display: none">
       <div class="card-body text-center">
    <h4 class="card-title">Manage Orders</h4>
    <p class="card-text">Listed below are the orders made by clients with no assigned couriers</p>
  </div>
    <div class="card">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Courier</th>
                <th scope="col">Action </th>
                <th scope="col">Order Details</th>
              </tr>
            </thead>
            <tbody>
				<form method = "post">
					<?php
						for($i=$cssNumber; $i<count($orderidUnassigned); $i++, $cssNumber++){
					?>
							<tr>
								<th scope='row'> <?php echo $orderidUnassigned[$i] ?> </th>
								<td> <?php echo $customernameUnassigned[$i] ?> </td>
								<td>
								<select name="selectCourier-<?php echo $i ?>" id="selectCourier-<?php echo $i ?>">
									<option value='none' name='assign-<?php echo $orderidUnassigned[$i] ?>'>-Assign Courier-</option>
								<?php
									foreach($couriersAvailable as $value){
										echo "<option name='assign-$i' value='$value'> $value</option>";
									}
								?>
								</select>
								</td>
								<td>
									<input type="submit" class='btn btn-sm btn-danger' name='submit<?php echo $orderidUnassigned[$i] ?>' value="Delete"><i class='fas fa-trash-alt'> 
									<?php
									if(isset($_POST['submit'.$orderidUnassigned[$i]])){
										deleteDataFromDatabase($orderidUnassigned[$i], 'orders');
										echo "<meta http-equiv='refresh' content='0'>";
									}
									?>
								</td>
								<td>
									<button class='btn btn-sm btn-info' type="button" name='details<?php echo $i ?>' onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='block'">Details</button> 
									<div id="cm-popup-<?php echo $cssNumber ?>">
										<h2 style="width:100%;color:white;text-align:center;padding:1%;background:#405080;">
											<?php
												echo $customernameUnassigned[$i] . " Order Details";
											?>
											<button
												class="cm-btn-<?php echo $cssNumber?>"
												style="background:red;position:absolute;top:0%;right:0%;width:40x; height:40px;"
												onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='none'"
												type="button">
												x
											</button>
										</h2>
										<center>
											<table style="width:80%;text-align:center;height:100px;">
												<tr>
													<td>Order ID: </td>
													<td><?php echo $orderidUnassigned[$i]?></td>
												</tr>
												<tr>
													<td>Orders: </td>
													<td><?php echo $orderlistUnassigned[$i]?></td>
												</tr>
												<tr>
													<td>Total Price: </td>
													<td><?php echo $orderPriceUnassigned[$i]?></td>
												</tr>
												<tr>
													<td>Order Status: </td>
													<td><?php echo $orderstatusUnassigned[$i] ?></td>
												</tr>
											</table>
										</center>
									</div>
								</td>
							</tr>
					<?php
						}
					?>
					<tr>
					<td colspan = 5 style="text-align:right; padding-right:160px;"><input type="submit" name="assignCouriers" value="Save"></style></td>
					<?php
						if(isset($_POST['assignCouriers'])){
							$duplicateCourier = 0;
							for($i=0; $i<count($orderidUnassigned); $i++){
								if($duplicateCourier == 1)
									break;
								for($j=0; $j<count($orderidUnassigned); $j++){
									if($i == $j){
										continue;
									}
									if($_POST['selectCourier-' . $i] == $_POST['selectCourier-' . $j] && $_POST['selectCourier-' . $i] != 'none'){
										echo "
											<div class='row'>
											<div class = 'col-1'></div>
												<div class = 'col-10'>
													<div class='alert alert-danger' role='alert'>
														You can only assign one courier per order!
													</div>
												</div>
											<div class = 'col-1'></div>
											</div>
										";
										$duplicateCourier = 1;
									}
								}
							}
							if ($duplicateCourier == 0){
								for($i=0; $i<count($orderidUnassigned); $i++){
									if($_POST['selectCourier-' . $i] != 'none'){
										updateOrdersGetCourierID($_POST['selectCourier-' . $i], $orderidUnassigned[$i]);
										echo "<meta http-equiv='refresh' content='0'>";
									}
								}
							}
						}
					?>
					</tr>
				</form>
            </tbody>
         </table>
    </div>
</div>
<div id="assignedTable" class="container my-5" style="display: none">
       <div class="card-body text-center">
    <h4 class="card-title">Manage Orders</h4>
    <p class="card-text">Listed below are the orders made by clients with assigned couriers</p>
  </div>
    <div class="card">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Courier Assigned </th>
                <th scope="col">Order Details</th>
              </tr>
            </thead>
            <tbody>
				<form method = "post">
					<?php
						for($i=0; $i<count($orderidAssigned); $i++, $cssNumber++){
					?>
							<tr>
								<th scope='row'> <?php echo $orderidAssigned[$i] ?> </th>
								<td> <?php echo $customernameAssigned[$i] ?> </td>
								<td>
									<?php echo $courierNameAssigned[$i] ?>
								</td>
								<td>
									<button class='btn btn-sm btn-info' type="button" name='details<?php echo $i ?>' onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='block'">Details</button> 
									<div id="cm-popup-<?php echo $cssNumber ?>">
										<h2 style="width:100%;color:white;text-align:center;padding:1%;background:#405080;">
											<?php
												echo $customernameAssigned[$i] . " Order Details";
											?>
											<button
												class="cm-btn-<?php echo $cssNumber?>"
												style="background:red;position:absolute;top:0%;right:0%;width:40x; height:40px;"
												onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='none'"
												type="button">
												x
											</button>
										</h2>
										<center>
											<table style="width:80%;text-align:center;height:100px;">
												<tr>
													<td>Order ID: </td>
													<td><?php echo $orderidAssigned[$i]?></td>
												</tr>
												<tr>
													<td>Orders: </td>
													<td><?php echo $orderlistAssigned[$i]?></td>
												</tr>
												<tr>
													<td>Total Price: </td>
													<td><?php echo $orderPriceAssigned[$i]?></td>
												</tr>
												<tr>
													<td>Order Status: </td>
													<td><?php echo $orderstatusAssigned[$i] ?></td>
												</tr>
											</table>
										</center>
									</div>
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
<div id="deliveredTable" class="container my-5" style="display: none">
       <div class="card-body text-center">
    <h4 class="card-title">Manage Orders</h4>
    <p class="card-text">Listed below are the delivered orders</p>
  </div>
    <div class="card">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Courier Assigned </th>
                <th scope="col">Order Details</th>
              </tr>
            </thead>
            <tbody>
				<form method = "post">
					<?php
						for($i=0; $i<count($orderidDelivered); $i++, $cssNumber++){
					?>
							<tr>
								<th scope='row'> <?php echo $orderidDelivered[$i] ?> </th>
								<td> <?php echo $customernameDelivered[$i] ?> </td>
								<td>
									<?php echo $courierNameDelivered[$i] ?>
								</td>
								<td>
									<button class='btn btn-sm btn-info' type="button" name='details<?php echo $i ?>' onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='block'">Details</button> 
									<div id="cm-popup-<?php echo $cssNumber ?>">
										<h2 style="width:100%;color:white;text-align:center;padding:1%;background:#405080;">
											<?php
												echo $customernameDelivered[$i] . " Order Details";
											?>
											<button
												class="cm-btn-<?php echo $i?>"
												style="background:red;position:absolute;top:0%;right:0%;width:40x; height:40px;"
												onclick="document.getElementById('cm-popup-<?php echo $cssNumber?>').style.display='none'"
												type="button">
												x
											</button>
										</h2>
										<center>
											<table style="width:80%;text-align:center;height:100px;">
												<tr>
													<td>Order ID: </td>
													<td><?php echo $orderidDelivered[$i]?></td>
												</tr>
												<tr>
													<td>Orders: </td>
													<td><?php echo $orderlistDelivered[$i]?></td>
												</tr>
												<tr>
													<td>Total Price: </td>
													<td><?php echo $orderPriceDelivered[$i] ?></td>
												</tr>
												<tr>
													<td>Order Status: </td>
													<td><?php echo $orderstatusDelivered[$i] ?></td>
												</tr>
											</table>
										</center>
									</div>
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