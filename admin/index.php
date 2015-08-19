<?php
session_start();

if(!isset($_SESSION["manager"])){
	header("location:admin_log_in.php");
	exit("You are rediracting.");
}

include "../include_scripts/database_connect.php";
//checking session value in database

$manager = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["manager"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

$sql = mysql_query("SELECT * FROM admin WHERE username= '".$manager."' AND password= '".$password."'");

if(!mysql_num_rows($sql) >= 1)
    {
    die('Complete.');
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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>Admin Area</title>
	<link rel="stylesheet" href="style/style.css" />
</head>

<body style="background-color:#fbf9f9;">
	<fieldset class='fieldset'>
	<div align="center" class="mainWrapper" >
        <div id="content">
          <div align="left" style="margin-left:24px">
            <p class='welcomeTxt'><strong>Welcome to the admin panel</strong></p>
            <ul>
            	<li><p><a href="inventory_list.php">Product List</a></p></li>
            	<li><p><a href="">User List</a></p></li>
            	<li><p><a href="">Category List</a></p></li>
            </ul>
          </div>
        </div>
    </div>
	</fieldset>
	<div class='footer'><?php include_once("../template_footer.php"); ?></div>
</body>

</html>