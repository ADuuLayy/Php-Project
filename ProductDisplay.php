<?php  
session_start();
include('connect.php');
include('Header2.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Display</title>
</head>
<body>
<form action="ProductDisplay.php" method="post">
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Product List</h1>
            </div>
        </div>
</div>
<table width="100%">
<tr>
	<td align="right">
		<input type="text" class="input-group-text" name="txtData" placeholder="Enter Search Product" />
		<input type="submit" class="btn btn-primary wow zoomIn" name="btnSearch" value="Search" />
	</td>
</tr>
</table>
<hr/>
<table align="center" cellpadding="10px">
<?php 

if(isset($_POST['btnSearch'])) 
{
	$txtData=$_POST['txtData'];

	$query1="SELECT * FROM product WHERE ProductName LIKE '%$txtData%' OR Price='$txtData' ";
	$result1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($result1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM product
				 WHERE ProductName LIKE '%$txtData%' 
				 OR Price='$txtData'
				 LIMIT $i,4";
		$result2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($result2);

		echo "<tr>";
		for($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($result1);

			$ProductID=$row['ProductID'];
			$ProductName=$row['ProductName'];
			$Price=$row['Price'];
			$ProductImage=$row['ProductImage'];

			list($width,$height)=getimagesize($ProductImage);
			$w=$width/2;
			$h=$height/2;
		?>
			<td>
				<img src="<?php echo $ProductImage ?>" width="200px" height="200px">
				<hr/>
				<b><p><?php echo $ProductName ?></p></b>
				<b><p><?php echo $Price ?> MMK</p></b>
				<hr/>
				<a class="btn btn-primary wow zoomIn" href="SaleDetail.php?ProductID=<?php echo $ProductID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}
}
else
{
	$query1="SELECT * FROM product";
	$result1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($result1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM product
				 LIMIT $i,4";
		$result2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($result2);

		echo "<tr>";
		for($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($result1);

			$ProductID=$row['ProductID'];
			$ProductName=$row['ProductName'];
			$Price=$row['Price'];
			$ProductImage=$row['ProductImage'];

			list($width,$height)=getimagesize($ProductImage);
			$w=$width/2;
			$h=$height/2;
		?>
			<td>
				<img src="<?php echo $ProductImage ?>" width="200px" height="200px">
				<hr/>
				<b><p><?php echo $ProductName ?></p></b>
				<b><p><?php echo $Price ?> MMK</p></b>
				<hr/>
				<a class="btn btn-primary wow zoomIn" href="SaleDetail.php?ProductID=<?php echo $ProductID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}
}


?>
</table>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>