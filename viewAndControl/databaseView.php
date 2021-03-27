<?php
	
	function getCustomers(){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT customername from customers";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row['customername']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	
	function getItem($columnName){
		include 'dbh.inc.php';
			
		$resultArray = array();
		
		$sql = "SELECT $columnName from products";
				
		$result = mysqli_query($link, $sql);

		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row[$columnName]);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getOrders($columnName){
		include 'dbh.inc.php';
		$resultArray = array();
		if($columnName == 'customeridUnassigned'){
			
			$resultArray = array();
			
			$sql = "SELECT customerid from orders WHERE orderstatus = 'For Delivery'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT customername from customers where customerid = $row[customerid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									array_push($resultArray ,$row['customername']);
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if($columnName == 'customeridAssigned'){
			
			$resultArray = array();
			
			$sql = "SELECT customerid from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT customername from customers where customerid = $row[customerid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									array_push($resultArray ,$row['customername']);
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if($columnName == 'customeridDelivered'){
			
			$resultArray = array();
			
			$sql = "SELECT customerid from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT customername from customers where customerid = $row[customerid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									array_push($resultArray ,$row['customername']);
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderidUnassigned'){
			$sql = "SELECT orderid from orders WHERE orderstatus = 'For Delivery'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderid']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderidAssigned'){
			$sql = "SELECT orderid from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderid']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderidDelivered'){
			$sql = "SELECT orderid from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderid']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderlistUnassigned'){
			$sql = "SELECT orderlist from orders WHERE orderstatus = 'For Delivery'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderlist']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderlistAssigned'){
			$sql = "SELECT orderlist from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderlist']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderlistDelivered'){
			$sql = "SELECT orderlist from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderlist']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderstatusUnassigned'){
			$sql = "SELECT orderstatus from orders WHERE orderstatus = 'For Delivery'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderstatus']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderstatusAssigned'){
			$sql = "SELECT orderstatus from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderstatus']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderstatusDelivered'){
			$sql = "SELECT orderstatus from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderstatus']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderPriceUnassigned'){
			$sql = "SELECT orderprice from orders WHERE orderstatus = 'For Delivery'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderprice']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderPriceAssigned'){
			$sql = "SELECT orderprice from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderprice']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if ($columnName == 'orderPriceDelivered'){
			$sql = "SELECT orderprice from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row['orderprice']);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if($columnName == 'courierNameAssigned'){
			
			$resultArray = array();
			
			$sql = "SELECT courierid from orders WHERE orderstatus = 'Delivery In Progress'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT couriername from couriers where courierid = $row[courierid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									array_push($resultArray ,$row['couriername']);
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else if($columnName == 'courierNameDelivered'){
			
			$resultArray = array();
			
			$sql = "SELECT courierid from orders WHERE orderstatus = 'Order Delivered'";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT couriername from couriers where courierid = $row[courierid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									array_push($resultArray ,$row['couriername']);
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		else{
			$sql = "SELECT $columnName from orders";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						array_push($resultArray ,$row[$columnName]);
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			return $resultArray;
		}
		
	}
	
	function getCouriers($columnName){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT $columnName from couriers WHERE CourierAvailable = '1'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row[$columnName]);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getCouriersUsername(){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT username from couriers";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row['username']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getCouriersPassword(){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT password from couriers";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row['password']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getCourierAccounts($columnName){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT $columnName from couriers";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray ,$row[$columnName]);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getCourierName($columnName, $condition){
		include 'dbh.inc.php';
			
		$resultValue = "";
				
		$sql = "SELECT $columnName from couriers WHERE username = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$resultValue = $row[$columnName];
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultValue;
	}
	
	function getCourieridForCourier($condition){
		include 'dbh.inc.php';
			
		$resultValue = "";
				
		$sql = "SELECT courierid from couriers WHERE username = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$resultValue = $row['courierid'];
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultValue;
	}
	
	function getOrderidForCourier($condition){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT orderid from orders WHERE courierid = $condition";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray, $row['orderid']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getcourierNameForCourier($condition){
		include 'dbh.inc.php';
			
		$resultValue = "";
				
		$sql = "SELECT couriername from couriers WHERE username = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$resultValue = $row['couriername'];
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultValue;
	}
	
	function getCustomerNameForCourier($condition){
		include 'dbh.inc.php';
			
		$resultValue = "";
				
		$sql = "SELECT customerid from orders WHERE orderid = $condition";
			
			$result = mysqli_query($link, $sql);
			if($result){
				if (mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$sql2 = "SELECT customername from customers where customerid = $row[customerid]";
						$result2 = mysqli_query($link, $sql2);
						if($result2){
							if (mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
									$resultValue = $row['customername'];
								}
							}
							//clear result variable
							mysqli_free_result($result2);
						}
					}
				}
				//clear result variable
				mysqli_free_result($result);
			}
			else{
				echo "";
			}
			mysqli_close($link);
			
		return $resultValue;
	}
	
	function getOrderlistForCourier($condition){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT orderlist from orders WHERE courierid = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray, $row['orderlist']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getOrderpriceForCourier($condition){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT orderprice from orders WHERE courierid = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray, $row['orderprice']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
	
	function getOrderstatusForCourier($condition){
		include 'dbh.inc.php';
			
		$resultArray = array();
				
		$sql = "SELECT orderstatus from orders WHERE courierid = '$condition'";
				
		$result = mysqli_query($link, $sql);
		if($result){
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					array_push($resultArray, $row['orderstatus']);
				}
			}
			//clear result variable
			mysqli_free_result($result);
		}
		else{
			echo "";
		}
		mysqli_close($link);
		return $resultArray;
	}
?>