<?php
session_start();

if(!isset($_SESSION["manager"])){
	header("location:admin_log_in.php");
	exit();
}

include "../include_scripts/database_connect.php";
//checking session value in database

$manager = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["manager"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

$sql = mysql_query("SELECT * FROM admin WHERE username= '".$manager."' AND password= '".$password."'");

if(!mysql_num_rows($sql) >= 1)
    {
    die();
	}
	
while($row = mysql_fetch_array($sql)) {
    $id = $row['id'];
    $user = $row['username'];
	$pass = $row['password'];	
	}   
	
if(!strcmp($user,$manager)==0 && !strcmp($pass,$password)==0)
	{
		echo "Goodbye.";
	} 
?>
<?php
//delete item
if(isset($_GET['deleteid'])){

	$deleteID = $_GET['deleteid'];

	$sql = mysql_query("SELECT * FROM `products` WHERE `id`='$deleteID'");

	while ($row = mysql_fetch_array($sql)) {
		$productName = $row['product_name'];
	}
	echo "Do you want to delete this product --- '$productName'? 
	<a href='inventory_delete.php?yesdelete=$deleteID'>YES</a> |
	<a href='inventory_list.php'> NO. Go back</a>";
	exit();
}
	
if(isset($_GET['yesdelete'])){
	$id_to_delete = $_GET['yesdelete'];

	$sql = mysql_query("DELETE FROM `products` WHERE `id`='$id_to_delete' LIMIT 1") or die('Error: Could not delete.');
	}
	
	$pic_to_delete = "../style/inventory_image/$id_to_delete.jpg";
	if(file_exists($pic_to_delete)){
		unlink($pic_to_delete);
	}

	header('location:inventory_list.php');
	exit();
?>