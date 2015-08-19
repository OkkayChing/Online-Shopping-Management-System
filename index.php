<?php
session_start();

$logout = "<a href='include_scripts/login.php'>log in</a> &bull; <a href='include_scripts/signup.php'>sign up</a>";
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
  $logout = "";
  $login = "<a href='include_scripts/log.php'>view activity</a> &bull; <a href='include_scripts/logout.php'>log out</a>";
  }
}
}
?>
<?php
include "include_scripts/database_connect.php";

//Get data from database
$dynamicList = "";
$lstsql=mysql_query("SELECT * FROM `category` LIMIT 3");
$productCount = mysql_num_rows($lstsql);

if($productCount > 0){
  while($row = mysql_fetch_array($lstsql)){
    $cat_id = $row["Category_id"];
    $cat_name = $row["Category_name"];
    $desc = $row["Category_desc"];
    $dynamicList .= "
        <div class='span4' id='cat'>
          <h2>$cat_name</h2>
          <p><img class='listPic' src='style/img/$cat_id.jpg'></p>
          <p>$desc<p><a class=btn href='category.php?cid=$cat_id'>View details &raquo;</a></p>
        </div>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MEGAstallBD.com &middot; Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="style/css/new.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
    <link href="style/css/new-responsive.css" rel="stylesheet">
    <link href="style/css/todc-new.css" rel="stylesheet">
    <link rel="shortcut icon" href="style/img/favicon.ico">
   <link rel="icon" type="image/gif" href="style/img/animated_favicon1.gif">
  
  </head>

  <body>

    <div class="container">

    <?php 
    $home = 'active';
    $cat = '';
    $prod = '';
    $serv = '';
    $cart = '';
    $cntct = '';
    include "template_header.php"; 
    ?>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1><img class='titlePic' src="style/img/HomeLogo.png" alt="logo"/></h1>
        <p class="lead">We have the best thing all over the internet available in our store.
          We provide 24 hour service with lot of products and great quality.</p>
          <h2><p>
            <span class='titleMoto1'>Discover</span> &#45; 
            <span class='titleMoto2'>Exclusive</span> &#45; 
            <span class='titleMoto3'>Safety</span> &#45; 
            <span class='titleMoto4'>Guarantee</span>
          </p></h2>
        <a class="btn btn-large btn-success" href="category.php">Discover today</a>
      </div>

      <hr>

      <!-- Latest Content -->
      <div class="row-fluid">
        <?php echo $dynamicList; ?>
      </div>

      <hr>

      <?php
        include 'template_footer.php';
      ?>

    </div>

    <!-- javascript-->
    <script src="style/js/jquery.js"></script>
    <script src="style/js/new-transition.js"></script>
    <script src="style/js/new-alert.js"></script>
    <script src="style/js/new-modal.js"></script>
    <script src="style/js/new-dropdown.js"></script>
    <script src="style/js/new-scrollspy.js"></script>
    <script src="style/js/new-tab.js"></script>
    <script src="style/js/new-tooltip.js"></script>
    <script src="style/js/new-popover.js"></script>
    <script src="style/js/new-button.js"></script>
    <script src="style/js/new-collapse.js"></script>
    <script src="style/js/new-carousel.js"></script>
    <script src="style/js/new-typeahead.js"></script>

  </body>
</html>