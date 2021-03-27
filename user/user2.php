<!doctype html>
<?php

	session_start();
	
	if(!isset($_SESSION['name'])){
		header("location: user.php");
	}
	$currentOrders = $_SESSION['orderedProduct'];
	
	include '../viewAndControl/databaseView.php';
	include '../viewAndControl/databaseControl.php';
	$itemsProductName = getItem('productName');
	$itemsProductType = getItem('productType');
	$itemsProductPrice = getItem('productPrice');
	$totalPrice = $_SESSION['totalPrice'];
	
	$products = array(array());
				
	for($i=0;$i<count($itemsProductName);$i++){
		$products[$i]["productName"] = $itemsProductName[$i];
		$products[$i]["productType"] = $itemsProductType[$i];
		$products[$i]["productPrice"] = $itemsProductPrice[$i];
	}
	
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="../css/bootsnip.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script>
			function generateProducts(s1, s2){
				var s1 = document.getElementById(s1);
				var s2 = document.getElementById(s2);
				s2.innerHTML = "";
				
				var prodTypes = <?php echo json_encode($itemsProductType); ?>;
				var prodNames = <?php echo json_encode($itemsProductName); ?>;
			
				if(s1.value != "none"){
					for(var i in prodTypes){
						if(prodTypes[i] == s1.value){
							var newOption = document.createElement("option");
							newOption.value = prodNames[i];
							newOption.innerHTML = prodNames[i];
							s2.options.add(newOption);
						}
					}
					s2.style.display = "block";
				}
			}
		</script>
		<title>Welcome!</title>
	</head>
	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
			<br><br>
			<font class="fadeIn first" > <h1>Welcome, <?php echo $_SESSION['name']?>!</h1> <br><br>
				<form method="post">
					
					<font class="fadeIn third">Type of product you wish to order: &nbsp&nbsp&nbsp</font>
					<select class="fadeIn third" id="selectOne" name="pTypes" onchange="generateProducts('selectOne', 'itemsSelect')">
					<option selected value="none">--Select--</option>
					<?php
						
						foreach(array_unique($itemsProductType) as $value){
							echo "<option value='$value'> $value</option>";
						}
					?>
					</select>
					<br>
					<center><select class='fadeIn first' name="pNames" id='itemsSelect' style="display: none">
					</select></center>
					<br><br>
					<input type="submit" name="submit" class="fadeIn fifth" value="Submit">
				</form>
				<?php
					if(isset($_POST['submit'])){
						if($_POST['pTypes'] == "none"){
							echo "
							<div class='row'>
							<div class = 'col-1'></div>
								<div class = 'col-10'>
									<div class='alert alert-danger' role='alert'>
										Please enter your name and select a product type!
									</div>
								</div>
							<div class = 'col-1'></div>
							</div>
							";
						}
						else{
							for($i=0;$i<count($itemsProductPrice);$i++){
								if($products[$i]["productName"] == $_POST['pNames']){
									$totalPrice += $products[$i]["productPrice"];
									array_push($_SESSION['priceArray'], $products[$i]["productPrice"]);
								}
							}
							$_SESSION['totalPrice'] = $totalPrice;
							unset($_SESSION['orderedProduct']);
							array_push($currentOrders, $_POST['pNames']);
							$_SESSION['orderedProduct'] = $currentOrders;
							header("Location: userConfirm.php");
						}
					}
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
					echo "Your total purchase price is: " . $_SESSION['totalPrice'];
				?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</body>
</html>