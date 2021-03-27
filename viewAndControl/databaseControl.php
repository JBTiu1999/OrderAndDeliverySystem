<?php

	function addOrders($value, $value2, $value3){
		include 'dbh.inc.php';
		
		$sql = "INSERT INTO customers(customerName) VALUES ('$value')";
		
		if(!mysqli_query($link, $sql)){
		}
		
		$sql = "INSERT INTO orders(OrderList, CustomerID, OrderPrice) 
		VALUES ('$value2', (SELECT CustomerID FROM customers WHERE CustomerName = '$value'), $value3)";
			
		if(!mysqli_query($link, $sql)){
		}
		mysqli_close($link);
	}
	
	function deleteDataFromDatabase($value, $tableName){
		include 'dbh.inc.php';
		
		$sql = "DELETE FROM $tableName WHERE orderid = $value";
		
		if(!mysqli_query($link, $sql)){
		}
		
		mysqli_close($link);
	}
	
	function updateOrdersGetCourierID($couriername, $orderid){
		include 'dbh.inc.php';
		
		$sql = "UPDATE orders SET courierid = (SELECT courierid from couriers where couriername = '$couriername'), OrderStatus = 'Delivery In Progress' where orderid = $orderid";
		
		if(!mysqli_query($link, $sql)){
		}
		
		$sql = "UPDATE couriers SET CourierAvailable = 0 WHERE CourierName = '$couriername'";
		if(!mysqli_query($link, $sql)){
		}
		mysqli_close($link);
	}
	
	function orderDelivered($orderid, $courierid){
		include 'dbh.inc.php';
		
		$sql = "UPDATE orders SET orderstatus = 'Order Delivered' where courierid = $courierid";
		
		if(!mysqli_query($link, $sql)){
		}
		
		$sql = "UPDATE couriers SET CourierAvailable = 1 WHERE courierid = $courierid";
		if(!mysqli_query($link, $sql)){
		}
		
		$sql = "UPDATE orders SET orderDelivered = 1 WHERE courierid = $courierid";
		if(!mysqli_query($link, $sql)){
		}
		mysqli_close($link);
	}

?>