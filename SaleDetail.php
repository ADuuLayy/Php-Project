<?php  
session_start();
include('connect.php');
include('Header2.php');
include('ShoppingCartFunction.php');

if(isset($_GET['ProductID'])) 
{
	$ProductID=$_GET['ProductID'];

	$query="SELECT p.*,b.BrandID,b.BrandName,c.CategoryID,c.CategoryName 
			FROM product p,Category c,Brand b 
			WHERE p.ProductID='$ProductID' 
			AND p.BrandID=b.BrandID
			AND p.CategoryID=c.CategoryID
			";
	$result=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($result);

	$ProductImage=$row['ProductImage'];
	list($width,$height)=getimagesize($ProductImage);
	$w=$width/2;
	$h=$height/2;
}

if(isset($_POST['btnAdd2Cart'])) 
{
	$ProductID=$_POST['txtProductID'];
	$BuyQuantity=$_POST['txtBuyQuantity'];

	AddProduct($ProductID,$BuyQuantity);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Details :</title>
</head>
<body>
<form action="SaleDetail.php" method="post">
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Product Details for <?php echo $row['ProductName'] ?></h1>
            </div>
        </div>
</div>
<table align="center" cellpadding="10px">
<tr>
	<td>
		<img id="PImage" src="<?php echo $ProductImage ?>" width="200px" height="200px">
		<hr/>
	</td>
	<td>
		<table>
		<tr>
			<td>ProductName :</td>
			<td>
				<b><?php echo $row['ProductName'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Brand :</td>
			<td>
				<b><?php echo $row['BrandName'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Category :</td>
			<td>
				<b><?php echo $row['CategoryName'] ?></b>
			</td>
		</tr>
		<tr>
			<td>Price :</td>
			<td>
				<b><?php echo $row['Price'] ?> MMK</b>
			</td>
		</tr>
		<tr>
			<td>Buy Quantity :</td>
			<td>
				<input type="hidden" name="txtProductID" value="<?php echo $row['ProductID'] ?>">
				<input type="number" name="txtBuyQuantity" value="1" />
				<input type="submit" name="btnAdd2Cart" class="btn btn-primary wow zoomIn" value="Add to Cart" />
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2">
	Description :
	<hr/>
	<?php echo $row['Description'] ?>
	</td>
</tr>
</table>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>