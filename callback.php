<?php

session_start();

include 'connect.php';

if (!isset($_GET["nickname"])) {
	
	header('location: dashboard.php');

}

$update = "UPDATE `users` SET `balance`=`balance`+'".$_GET["amount"]."' WHERE `nickname`='".$_GET["nickname"]."'";

$updateQuery = mysqli_query($conn, $update);

if ($updateQuery) {
	
	$select = "SELECT * FROM `users` WHERE `nickname`='".$_GET["nickname"]."'";

	$select_query = mysqli_query($conn, $select);

	if (mysqli_num_rows($select_query) > 0) {
		
		while ($row = mysqli_fetch_assoc($select_query)) {

			$balance = $row["balance"];

		}

		$_SESSION["balance"] = $balance;

		header('location: dashboard.php?funding=successful');

	}

	

}

?>