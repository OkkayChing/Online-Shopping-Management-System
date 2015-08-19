<?php
//checking privilege
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
date_default_timezone_set('GMT');

//Get data from database
$product_list = "";
$sql=mysql_query("SELECT * FROM products");
$productCount = mysql_num_rows($sql);

if($productCount > 0){
	while($row = mysql_fetch_array($sql)){
		$id = $row["id"];
		$product_name = $row["product_name"];
		$date_added = strftime("%b %d, %Y",strtotime($row["date_added"]));
		$product_list .= ">> $id - $product_name - $date_added &nbsp;&nbsp;&nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_delete.php?deleteid=$id'>delete</a> <br/>";
		}
	}
else{
	$product_list = "You have no products in your store yet.";
	}
?>
<?php
if(isset($_POST['product_name'])){
$pid = $_POST['thisID'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$details = $_POST['details'];

$sql = mysql_query("UPDATE `products` SET `product_name`='$product_name',`price`='$price',`details`='$details',
    `category`='$category',`subcategory`='$subcategory' WHERE `id`='$pid'");

if($_FILES['fileField']['tmp_name']){
$newname = "$pid.jpg";
move_uploaded_file($_FILES['fileField']['tmp_name'],"../style/inventory_image/$newname");
header("location:inventory_list.php");
}
header("location: inventory_list.php");
exit();
}	
?>
<?php
//edit item
if(isset($_GET['pid'])){
	 
date_default_timezone_set('GMT');

//Get data from database
$targetID = $_GET['pid'];
$sql=mysql_query("SELECT * FROM `products` WHERE `id`='$targetID' LIMIT 1");
$productCount = mysql_num_rows($sql);

if($productCount > 0){
	while($row = mysql_fetch_array($sql)){
		
        $productID = $row["id"];
		$product_name = $row["product_name"];
		$price = $row["price"];
        $details = $row["details"];
		$category = $row["category"];
		$subcategory = $row["subcategory"];

        $sbSQL = mysql_query("SELECT * FROM `saubcategory` WHERE `subcategory_id`='$subcategory'");

        while($row = mysql_fetch_array($sbSQL)){
            $sbcat = $row['subcategory_name'];
        }

		}
	}
else{
	echo 'Sorry. Try again.';
	exit();
	}
	}

?>
<?php
//category list
$catSQL = mysql_query("SELECT * FROM `category`");
$catList ="";

while($row = mysql_fetch_array($catSQL)){
    $catName = $row['Category_name'];

    $catList .= "<option value='$catName'>$catName</option>";
}

//subcategory list
$subcatSQL = mysql_query("SELECT * FROM `saubcategory`");
$subcatList ="";

while($row = mysql_fetch_array($subcatSQL)){
    $subcatID = $row['subcategory_id'];
    $subcatName = $row['subcategory_name'];

    $subcatList .= "<option value='$subcatID'>$subcatName</option>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>Inventory List</title>
	<link rel="stylesheet" href="style/style.css" />
</head>

<body style="background-color:#fbf9f9;">
     <fieldset style="margin-left:130px;margin-right:130px;">
	<div align="center" id="mainWrapper" >
        <div id="content"><br/>
        <div align="right" style="margin-right:32px"><a href="inventory_list.php#inventoryForm">+Add new item</a></div>
          <div align="left" style="margin-left:24px">
            <p><strong>Inventory List</strong></p>
            <?php echo $product_list; ?>
</div>
<hr/>
<a name="inventoryForm" id="inventoryForm"></a>
<h2 style="text-decoration:underline;">Add New Inventory Form</h2>
<form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myForm" method="POST">
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td width="20%">Product Name:</td>
            <td width="80%"><label> <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>"> </label></td>
        </tr>
        <tr>
        	<td width="20%">Product Price:</td>
            <td width="80%"><label><input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>">$</label></td>
        </tr>
        <tr>
        	<td width="20%">Category:</td>
            <td ><label>
            		<select name="category" id="category">
                    <?php echo $catList; ?>
                    </select>
            	</label><span class='selectedTxt'>Selected: <?php echo $category; ?></span>
            </td>
        </tr>
        <tr>
        	<td width="20%">SubCategory:</td>
            <td><label>
            		<select name="subcategory" id="subcategory">
                    <?php echo $subcatList; ?>
                    </select>
            	</label><span class='selectedTxt'>Selected: <?php echo $sbcat; ?></span>
            </td>
        </tr>
        <tr>
        	<td width="20%">Product Details:</td>
            <td width="80%"><label> <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea> </label></td>
        </tr>
        <tr>
        	<td width="20%">Product Image:</td>
            <td width="80%"><label> <input name="fileField" type="file" id="fileField" /> </label></td>
        </tr>
        <tr>
        	<td width="20%">&nbsp;</td>
            <td width="80%"><label>
            <input name="thisID" type="hidden" value="<?php echo $targetID; ?>">
            <input name="button" type="submit" id="button" value="Change Now!"> </label></td>
        </tr>
        
    </table>
</form>
        </div>
        
    </div>
	 </fieldset>
     <?php include_once("../template_footer.php"); ?>
</body>

</html>