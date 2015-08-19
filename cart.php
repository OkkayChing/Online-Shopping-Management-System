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
  
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0){
  $logout = "";
  $login = "<a href='include_scripts/log.php'>view activity</a> &bull; <a href='include_scripts/logout.php'>log out</a>";
  }
}
}
else{
  header('location:include_scripts/login.php');
  exit();
}
?>
<?php
//prodcut list
$productSQL = mysql_query("SELECT * FROM `cart` WHERE `user_id`='$id' ORDER BY `cart_id`");
$product_list="";

while($row = mysql_fetch_array($productSQL)) {
$cart_id = $row['cart_id'];
$product_id = $row['product_id'];
$Qty = $row['Quantity'];
$price = $row['price'];
$date = $row['adding_date'];

$productQuery = mysql_query("SELECT * FROM `products` WHERE `id`='$product_id'");

while($row = mysql_fetch_array($productQuery)) {
$product_name = $row['product_name'];
$category = $row['category'];
$subcategory = $row['subcategory'];

$subcatQuery = mysql_query("SELECT * FROM `saubcategory` WHERE `subcategory_id`='$subcategory'");

while($row = mysql_fetch_array($subcatQuery)){
  $subcat = $row['subcategory_name'];
}
}
    
$product_list .= "<table class='contentMainTableRow' width='99%' border='0'>
                    <tr class='contentMainTableHeadRow'>
                      <td width='150' align='center'>$product_name</td>
                      <td width='130' align='center'>$category&nbsp;($subcat)</td>
                      <td width='60' align='center'>$Qty</td>
                      <td width='60' align='center'>$price</td>
                      <td width='100' align='center'>$date</td>
                      <td width='25' align='center'><a href='delete.php?crtid=$cart_id'><img class='dltICO' src='style/img/delete.png'></a></td>
                    </tr>
                  </table>";            
}
?>
<?php
//product number
$productNumberSQL = mysql_query("SELECT SUM(`Quantity`) FROM `cart` WHERE `user_id`='$id'");
$productNumber = mysql_result($productNumberSQL,0);

$productPriceSQL = mysql_query("SELECT SUM(`price`) FROM `cart` WHERE `user_id`='$id'");
$productPrice = mysql_result($productPriceSQL,0);

?>
<?php
if(isset($_GET['pid'])){

$pid = $_GET['pid'];

$priceSQL = mysql_query("SELECT * FROM `products` WHERE `id`='$pid'");

while ($row = mysql_fetch_array($priceSQL)){
  $price = $row['price'];
}

$insertSQL = mysql_query("INSERT INTO `cart`(`user_id`, `product_id`, `Quantity`, `price`, `adding_date`) 
  VALUES ('$id','$pid',1,'$price',now())");

  header('location:cart.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MEGAstallBD.com &middot; My Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="style/css/new.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
    <link href="style/css/new-responsive.css" rel="stylesheet">
    <link href="style/css/todc-new.css" rel="stylesheet">
    <link href="style/css/product_details.css" rel="stylesheet">
    <link href="style/css/cart.css" rel="stylesheet">
    <link rel="shortcut icon" href="style/img/favicon.ico">
   <link rel="icon" type="image/gif" href="style/img/animated_favicon1.gif">
  
  </head>

  <body>

    <div class="container">

    <?php 
    $home = '';
    $cat = '';
    $prod = '';
    $serv = '';
    $cart = 'active';
    $cntct = '';
    include "template_header.php"; 
    ?>

    <hr>
      <div class="row-fluid">

      	<div class='contentBoard'>
          <div class='ContentTable'>
            <table class='contentMainTableHead' width='99%' border='1'>
              <tr class='contentMainTableHeadRow'>
                <td width='150' align='center'>Product Name</td>
                <td width='130' align='center'>Product Category</td>
                <td width='60' align='center'>Quantity</td>
                <td width='60' align='center'>Price</td>
                <td width='100' align='center'>Adding date</td>
                <td width='25' align='center'></td>
              </tr>
              <?php echo $product_list; ?>
            </table>
            <br/>
          </div>
      	</div>
        <div class='PurchaseBoard'>
          <div class='PurchaseTable'>
            <div class='purchaseTxt'>
            <p class='ttlTxt'>Total Products: &nbsp;<span class='ttlTxtValue'><?php echo $productNumber; ?></span></p><br/>
            <p class='prcTxt'>With price: &nbsp;<span class='prcTxtValue'>$<?php echo $productPrice; ?></span></p>
            <p><a href="#"><img class='cartICO2' src='style/img/buyNow.png'></a></p>
            </div>
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
