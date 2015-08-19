<?php
session_start();

if(isset($_POST["username"])&& isset($_POST["password"])){
	
$manager = preg_replace('#[^0-9A-Za-z]#i','',$_POST["username"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_POST["password"]);

include "../include_scripts/database_connect.php";

$sql = mysql_query("SELECT * FROM admin WHERE username= '".$manager."' AND password= '".$password."' LIMIT 1");

$row = mysql_num_rows($sql);
if($row>0){
	while($f_row = mysql_fetch_array($sql)){
		$id = $row["id"];
		}
		$_SESSION["id"]=$id;
		$_SESSION["manager"]=$manager;
		$_SESSION["password"]=$password;
		header("location: index.php");
		exit;
	}
else{
	$title = "TRY AGAIN";
echo "Error:Something is wrong. Can't log in. <a href = 'index.php'>" . $title ."</a>";	
	exit;
	}
}
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="utf-8" />
		<title>Admin Log In</title>
	</head>

	<body style="background-color:#fbf9f9;">
	<fieldset style="margin-left:130px;margin-right:130px;">
	<div align="center" id="mainWrapper" >
        <div id="content"><br/>
          <div align="left" style="margin-left:24px">
            <p><h1><strong>Log In</strong></h1></p>
				<form id="log_in_form" name="log_in_form" method="post" action="admin_log_in.php">
                Username:<br/>
                <input name="username" type="text" id="username" size="40"><br/><br/>
                Password:<br/>
                <input name="password" type="password" id="password" size="40"><br/><br/><br/>

                <input type="submit" name="button" id="button" value="Log In">

                </form>
          </div>
          <br/><br/>
        </div>
        <?php include_once("../template_footer.php"); ?>
    </div>
	</fieldset>
</body>
</html>