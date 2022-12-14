<?php  
session_start();
include('connect.php');
include('Header2.php');
include('ShoppingCartFunction.php');

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action == 'Remove') 
	{
		$ProductID=$_GET['ProductID'];
		RemoveProduct($ProductID);
	}
	elseif ($action == 'ClearAll') 
	{
		ClearAll();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
</head>
<body>
<form action="ShoppingCart.php" method="post">
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Shopping Cart</h1>
            </div>
        </div>
</div>
<?php  
if (!isset($_SESSION['ShoppingCartFunction'])) 
{
	echo "<p>Empty Cart</p>";
	echo "<a href='ProductDisplay.php'>Back to Product List</a>";
}
else
{
?>
	<table border="1" cellpadding="3px" width="100%">
	<tr>
		<th>Image</th>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>Price</th>
		<th>BuyQuantity</th>
		<th>GrandTotal</th>
		<th>Action</th>
	</tr>
	<?php
	$count=count($_SESSION['ShoppingCartFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCartFunction'][$i]['ProductID'];
		$ProductImage=$_SESSION['ShoppingCartFunction'][$i]['ProductImage'];
		echo "<tr>";
			echo "<td>
				  <img src='$ProductImage' width='100px' height='100px' />
				 </td>";
			echo "<td>" . $_SESSION['ShoppingCartFunction'][$i]['ProductID'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunction'][$i]['ProductName'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunction'][$i]['Price'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunction'][$i]['BuyQuantity'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunction'][$i]['Price']  * $_SESSION['ShoppingCartFunction'][$i]['BuyQuantity'] . "</td>";
			echo "<td>
					<a href='ShoppingCart.php?action=Remove&ProductID=$ProductID'>Remove</a>
				  </td>";
		echo "</tr>";			
	}
	?>
	<tr>
		<td colspan="7" align="right">
		Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
		<hr/>
		Total Amount : <b><?php echo CalculateTotalAmount() ?> MMK</b>
		<hr/>
		VAT (5%) : <b><?php echo CalculateTotalAmount() * 0.05 ?> MMK</b>
		<hr/>
		GrandTotal : <b><?php echo CalculateTotalAmount() + (CalculateTotalAmount() * 0.05) ?> MMK</b>
		<hr/>
		
		<a href='ProductDisplay.php' class="btn btn-primary wow zoomIn">Back to Product List</a>
		
		<a href="ShoppingCart.php?action=ClearAll" class="btn btn-primary wow zoomIn">Empty Cart</a>
		
		<a href="Checkout.php" class="btn btn-primary wow zoomIn">Make Checkout</a>	
		</td>
	</tr>
	</table>
<?php
}
?>

</form>
</body>
</html>
<?php 
    include('Footer.php');
?>