<?php
//delete item
if(isset($_GET['crtid'])){

	include "include_scripts/database_connect.php";

	$deleteID = $_GET['crtid'];

	$sql = mysql_query("DELETE FROM `cart` WHERE `cart_id`='$deleteID'");

	HEADER('location:cart.php');
	exit();
}
?>