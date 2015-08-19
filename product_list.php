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
if(isset($_GET['cid']) && isset($_GET['sid'])){

include "include_scripts/database_connect.php";

$catID = $_GET['cid'];
$subcatID = $_GET['sid'];
$subList = '';

$subSQL = mysql_query("SELECT * FROM `saubcategory` WHERE `category_id`='$catID'");
		
while($row = mysql_fetch_array($subSQL)) {
$subcatTitle = $row['subcategory_name'];
$subID = $row['subcategory_id'];

$subList .= "<li><a href='product_list.php?cid=$catID&sid=$subID'>$subcatTitle</a></li><br/>";

date_default_timezone_set('GMT');
$dynamicList = "";

$sql=mysql_query("SELECT * FROM `products` WHERE `subcategory`='$subcatID' ORDER BY `date_added`");
$productCount = mysql_num_rows($sql);

if($productCount > 0){
  while($row = mysql_fetch_array($sql)){
    $id = $row["id"];
    $product_name = $row["product_name"];
    $price = $row["price"];
    $date_added = strftime("%b %d, %Y",strtotime($row["date_added"]));
    $dynamicList .= "
        <table width='350' border='0' cellpadding='6'>
            <tr>
              <td width='104'><a href='product.php?pid=$id'>
        <img class='productIMG' src='style/inventory_image/$id.jpg' alt='$product_name' width='102' height='96' border='1'></a>
        </td>
        <td width='144' valign='top'>Product title: $product_name<br>
        Product price: $$price<br>
        <a href='product.php?pid=$id'>View product details</a></td>
            </tr>
        </table>
          ";
    }
  }
else{
  $dynamicList = "Sorry. We have no products in this category in our store yet.";
  }
}
}
else{
  header('location:category.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MEGAstallBD.com &middot; Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="style/css/new.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
    <link href="style/css/new-responsive.css" rel="stylesheet">
    <link href="style/css/todc-new.css" rel="stylesheet">
    <link href="style/css/category.css" rel="stylesheet">
    <link href="style/css/product.css" rel="stylesheet">
    <link rel="shortcut icon" href="style/img/favicon.ico">
   <link rel="icon" type="image/gif" href="style/img/animated_favicon1.gif">
  
  </head>

  <body>

    <div class="container">

    <?php 
    $home = '';
    $cat = '';
    $prod = 'active';
    $serv = '';
    $cart = '';
    $cntct = '';
    include "template_header.php"; 
    ?>

      <hr>
      <div class="row-fluid">

        <div class='sidebar'>
			<div class='sidebarTop'><p class='sidebarTopTxt'>Select Subcategory:</p></div>
			<div class='sidebarTop2nd'>
				<ul class='catList'>
					<?php echo $subList; ?>
				</ul>
			</div>
      	</div>

      	<div class='contentBoard'>
          <div class='insideTableContent'>
      		<table width="700" border="0">
            <tr>
              <td width="330" align="center" valign="top" style="text-decoration:none; color:#429344;"><p><h3 style="text-decoration:underline;" >Newest items available for the customers to sell</h3></p>
              <fieldset><p><?php echo $dynamicList; ?></p></fieldset>
              <p>&nbsp;</p></td>
            </tr>
          </table>
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
