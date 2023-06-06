<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
    
<title>Shop</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    
    <div class="sticky">
        
    <nav class="stroke" id="mainNav">
        <ul>
        	<li><a href="index.html">Home</a></li>
            <li><a href="/luca/index.html#Gallery">Gallery</a></li>
 	    <li><a href="php/shop.php">Shop</a></li> <!-- Shop.php file -->
            <li><a href="/luca/index.html#About">About Us</a></li>
            <li><a href="/luca/index.html#Contact">Contact</a></li>
        </ul>
  </nav>
    </div>

    <div class="header">
        
       <a name="Home"><img src="product-images/Logo.jpeg" alt="Luca Loaves Logo">  
      </a>
           
        
</div>


<div id="shopping-cart">
<div class="txt-heading">
  <h1>Your Order</h1>
</div>

<a id="btnEmpty" href="shop.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="shop.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records"><i><b>Your Cart is Empty</b></i></div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading"><b>Products</b></div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="shop.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
		
	<?php
		}
	}
	?>

</div>


</br>
</br>
</br>
</br>
<div style="clear:both;"></div>
</br>
</br>

<div class="footer">
        
         <a name="Contact"><h2 style="text-transform: uppercase;">Contact Details</h2></a>
     <h5>
        300 Pits Street, Sydney <br>
        Tel. (Bakery) 02 9180 2221 <br>
        Mob. 041 231 231 <br>
        Fax 02 9230 1234 <br>
        <a href="mailto: infoLucaloaves.com.au" style="color: white">
        Email: info@LLbakery.com.au </a> <br>
        <a href="http://www.lucabakery.com.au" style="color: white">Web http://www.lucaloaves.com.au </a> <br>

      </h5>
    <img src="product-images/breads-sydney-bourke-street-bakery.jpeg" alt="Breads" style="padding-bottom: 100px">
    
  <h5 style="text-align: center">
      @2021 Luca Loaves Bakery, All Rights Reserved
</h5>
</div>
</br>
</br>
</br>
</BODY>
</HTML>