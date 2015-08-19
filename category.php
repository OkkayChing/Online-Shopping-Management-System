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

$catSQL = mysql_query("SELECT * FROM `category` ORDER BY `Category_id`");

$catList = '';
$subcatList = '';
		
while($row = mysql_fetch_array($catSQL)) {
$catTitle = $row['Category_name'];
$catID = $row['Category_id'];

$catList .= "<li><a href='category.php?cid=$catID'>$catTitle</a></li><br/>";

$subcatSQL = mysql_query("SELECT * FROM `saubcategory` WHERE Category_id=$catID");

while($row = mysql_fetch_array($subcatSQL)) {
$subId = $row['subcategory_id'];
$strTitle = $row['subcategory_name'];
$desc = $row['subcategory_desc'];	

$subcatList .= "<div class='objects'>
      			<p class='objectsTitle'>
      			<a href='category.php?cid=$catID'>$catTitle</a>
      			&nbsp;&nbsp;&#187;&nbsp;&nbsp;
      			<a href='product_list.php?cid=$catID&sid=$subId'>$strTitle</a>
      			<p>
      			<hr>
      			<p class='objectsContent'><span>$desc</span></p>
      			<hr>
      			</div>";	  
}

}
?>
<?php
if(isset($_GET["cid"])){

$catID = $_GET["cid"];
$subcatList = "";

$subcatSQL = mysql_query("SELECT * FROM `saubcategory` WHERE Category_id='$catID'");

while($row = mysql_fetch_array($subcatSQL)) {
$subId = $row['subcategory_id'];
$strTitle = $row['subcategory_name'];
$desc = $row['subcategory_desc'];

$catSQL = mysql_query("SELECT * FROM `category`  WHERE Category_id='$catID'");

while($row = mysql_fetch_array($catSQL)){
$catTitle = $row['Category_name'];
}

$subcatList .= "<div class='objects'>
      			<p class='objectsTitle'>
      			<a href='category.php?cid=$catID'>$catTitle</a>
      			&nbsp;&nbsp;&#187;&nbsp;&nbsp;
      			<a href='product_list.php?cid=$catID&sid=$subId'>$strTitle</a>
      			<p>
      			<hr>
      			<p class='objectsContent'><span>$desc</span></p>
      			<hr>
      			</div>";	  
}
}
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MEGAstallBD.com &middot; Category</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="style/css/new.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
    <link href="style/css/new-responsive.css" rel="stylesheet">
    <link href="style/css/todc-new.css" rel="stylesheet">
    <link href="style/css/category.css" rel="stylesheet">
    <link rel="shortcut icon" href="style/img/favicon.ico">
   <link rel="icon" type="image/gif" href="style/img/animated_favicon1.gif">
  
  </head>

  <body>

    <div class="container">

    <?php 
    $home = '';
    $cat = 'active';
    $prod = '';
    $serv = '';
    $cart = '';
    $cntct = '';
    include "template_header.php"; 
    ?>

      <hr>
      <div class="row-fluid">

        <div class='sidebar'>
			<div class='sidebarTop'><p class='sidebarTopTxt'>Select Category:</p></div>
			<div class='sidebarTop2nd'>
				<ul class='catList'>
					<?php echo $catList; ?>
				</ul>
			</div>
      	</div>

      	<div class='contentBoard'>
      		<?php echo $subcatList; ?>
      	</div>
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
