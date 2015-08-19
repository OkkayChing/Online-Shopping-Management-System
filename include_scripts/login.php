<?php
session_start();

$logout = "&bull; <a href='signup.php'>sign up</a> &bull;";
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
if(isset($_POST["username"])&& isset($_POST["password"])){
  
$username = preg_replace('#[^0-9A-Za-z]#i','',$_POST["username"]);
$password = preg_replace('#[^0-9A-Za-z]#i','',$_POST["password"]);

include "database_connect.php";

$sql = mysql_query("SELECT * FROM `user` WHERE `user_name`='$username' AND `password`='$password' LIMIT 1");

$row = mysql_num_rows($sql);

if($row>0){
  while($row = mysql_fetch_array($sql)){
    $id = $row["user_id"];
    }
    $_SESSION["id"]=$id;
    $_SESSION["user"]=$username;
    $_SESSION["password"]=$password;
    header("location: http://localhost/OnlineMegaShop/");
    exit;
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
    <link href="../style/css/login.css" rel="stylesheet">
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

      <div class="signin">
        <div class="signin-box">
          <h2 class="form-signin-heading">Sign in</h2>

          <form action='login.php' method='POST'>
            <fieldset>
              <label for="username">Username</label>
              <input type="text" class="input-block-level" name="username" id="username">
              <label for="passwd">Password</label>
              <input type="password" class="input-block-level" name="password" id="password">

              <input type="submit" class="btn btn-primary" value="Sign in">
             <label class="remember">
                <input type="checkbox" name="rememberMe" value="yes">
                <strong class="remember-label">Stay signed in</strong>
              </label>
            </fieldset>
          </form>

          <ul>
            <li>
              Don't have an account?&nbsp;&nbsp;<a id="link-forgot-pwd" href="signup.php">sign up</a>
            </li>
          </ul>
        </div>
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
