<?php
session_start();

$logout = "&bull; <a href='login.php'>log in</a> &bull;";
$login = "";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
  
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "include_scripts/database_connect.php";

$sql = mysql_query("SELECT * FROM `user` WHERE `user_name`='$user' AND `password`='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
    $username = $row['user_name'];
    $password = $row['password']; 
  }   
  
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
  {
  header('location:http://localhost/OnlineMegaShop/');
  exit();
  }
}
}
?>
<?php
//For sign_up process
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['user_name']) &&isset($_POST['email']) && 
	isset($_POST['password']) && isset($_POST['address']) && isset($_POST['Province']) && isset($_POST['country']) && 
	isset($_POST['phone']) && isset($_POST['zip'])){
	
	include "database_connect.php";
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];		
	$password = $_POST['password'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$Province = $_POST['Province'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	$zip = $_POST['zip'];

	$sql = mysql_query("INSERT INTO `user`
		(`first_name`, `last_name`, `user_name`, `password`, `email`, `address`, `province`, `country`, `phone_number`, `zip_code`) 
		VALUES 
		('$first_name','$last_name','$user_name','$password','$email','$address','$Province','$country','$phone','$zip')");

	if(!$sql){
	die(mysql_error());
	} 
	else if($sql){
	header('location:http://localhost/OnlineMegaShop/');
	exit();
	}	
}	
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MEGAstallBD.com &middot; Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="../style/css/new.css" rel="stylesheet">
    <link href="../style/css/index.css" rel="stylesheet">
    <link href="../style/css/new-responsive.css" rel="stylesheet">
    <link href="../style/css/todc-new.css" rel="stylesheet">
    <link href="../style/css/sign.css" rel="stylesheet">
    <link rel="shortcut icon" href="../style/img/favicon.ico">
   <link rel="icon" type="image/gif" href="../style/img/animated_favicon1.gif">
  
  </head>

  <body>

    <div class="container">
    <div class="masthead">
    <h3 class="muted">MEGAstallBD.com</h3><p class="text-right" id='logTxt'><?php echo $logout; ?> <?php echo $login; ?></p>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
              <li class='<?php echo $home; ?>'><a href="../index.php">Home</a></li>
              <li class='<?php echo $cat; ?>'><a href="../category.php">Category</a></li>
              <li class='<?php echo $prod; ?>'><a href="">Products</a></li>
              <li class='<?php echo $cart; ?>'><a href="../cart.php"><img class='headCartICO' src='../style/img/Cart.png'>&nbsp;My Cart</a></li>
              <li class='<?php echo $serv; ?>'><a href="#">Services</a></li>
              <li class='<?php echo $cntct; ?>'><a href="../contact.php">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
</div>
    	<div class='insideContainer'>

  <form class="form-horizontal" action='signup.php' method='POST'>
  	<div class="control-group">
    <label class="control-label" for="first_name">First Name</label>
    <div class="controls">
      <input type="text" name='first_name' id="first_name" placeholder="Ex: Mizanur">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="last_name">Last Name</label>
    <div class="controls">
      <input type="text" name='last_name' id="last_name" placeholder="Ex: Rahman">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="user_name">User Name</label>
    <div class="controls">
      <input type="text" name='user_name' id="user_name" placeholder="Ex: Zihan24">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input type="password" name='password' id="password" placeholder="********">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="email" name='email' id="email" placeholder="Ex: Mizan@nstu.com">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="address">Address</label>
    <div class="controls">
      <input type="text" name='address' id="address" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Province">Province</label>
    <div class="controls">
      <input type="text" name='Province' id="Province" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="country">Country</label>
    <div class="controls">
      <input type="text" name='country' id="country" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="phone">Phone Number</label>
    <div class="controls">
      <input type="text" name='phone' id="phone" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="zip">Zip Code</label>
    <div class="controls">
      <input type="text" name='zip' id="zip" placeholder="">
    </div>
  </div>

  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox"> Remember me
      </label>
      <button type="submit" class="btn btn-info">Sign in</button>
    </div>
  </div>
</form>
</div>
</div>
    <!-- javascript-->
    <script src="../style/js/jquery.js"></script>
    <script src="../style/js/new-transition.js"></script>
    <script src="../style/js/new-alert.js"></script>
    <script src="../style/js/new-modal.js"></script>
    <script src="../style/js/new-dropdown.js"></script>
    <script src="../style/js/new-scrollspy.js"></script>
    <script src="../style/js/new-tab.js"></script>
    <script src="../style/js/new-tooltip.js"></script>
    <script src="../style/js/new-popover.js"></script>
    <script src="../style/js/new-button.js"></script>
    <script src="../style/js/new-collapse.js"></script>
    <script src="../style/js/new-carousel.js"></script>
    <script src="../style/js/new-typeahead.js"></script>

  </body>
</html>