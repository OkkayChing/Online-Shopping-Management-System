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
if(isset($_GET['pid'])){

date_default_timezone_set('GMT');
  include "include_scripts/database_connect.php";

  $id = preg_replace('#[^0-9]#i','', $_GET['pid']);

  $sql=mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");

  $productCount = mysql_num_rows($sql);

  if($productCount > 0){
  while($row = mysql_fetch_array($sql)){
    $id = $row["id"];
    $product_name = $row["product_name"];
    $price = $row["price"];
    $details = $row["details"];
    $category = $row["category"];
  $sbcategory = $row["subcategory"];

    $ssql = mysql_query("SELECT `subcategory_name` FROM `saubcategory` WHERE `subcategory_id`='$sbcategory'");

    while($row = mysql_fetch_array($ssql)){
      $subcategory = $row['subcategory_name'];
    }

    $date_added = strftime("%b %d, %Y",strtotime($row["date_added"]));    
    }
    }
    else{
    echo "No details with that ID.";
    exit();
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
    <title>MEGAstallBD.com &middot; Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="style/css/new.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
    <link href="style/css/new-responsive.css" rel="stylesheet">
    <link href="style/css/todc-new.css" rel="stylesheet">
    <link href="style/css/category.css" rel="stylesheet">
    <link href="style/css/product_details.css" rel="stylesheet">
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

      	<div class='contentBoard'>
          <div class='insideTable'>
      		 <table width="900" border="0">
            <tr>
              <td width="233" align="centre" valign="top" class='DetailProductPic'>
                <p><h3>
                  <img src="style/inventory_image/<?php echo $id; ?>.jpg" width="149" height="173" alt="<?php echo $product_name; ?>"/></h3>
                </p>
          
                <p><a href="style/inventory_image/<?php echo $id; ?>.jpg">View the full size image</a></p>
      
                <p>&nbsp;</p>
              </td>

              <td width="657" align="left" valign="top" class='DetailProductList'>
                <p><h3>
                <span width="657" align="centre" valign="top" class='DetailProductListTitle'>Product Details</span>
                </h3></p>
      
              <p>Product name: <span><?php echo $product_name; ?></span></p>
              <p>Category: <span><?php echo $category; ?></span></p>
              <p>Subcategory: <span><?php echo $subcategory; ?></span></p>
              <p>Relational info: <span><?php echo $details; ?></span></p>
              <p>Product Price: <span><?php echo $price; ?><b>$</b></span></p>
              <div>
                <a href="cart.php?pid=<?php echo $id; ?>"><img class='cartICO' src='style/img/add2cart.png'></a>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;
              <div>
                <a href="#"><img class='cartICO2' src='style/img/buyNow.png'></a>
              </div>
              </td>
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
