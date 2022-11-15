<?php  
session_start();
include('connect.php');
include('Header2.php');
include('AutoIDFunction.php');
include('ShoppingCartFunction.php');


if(isset($_POST['btnCheckout'])) 
{
	$txtSaleID=$_POST['txtSaleID'];
	$txtSaleDate=$_POST['txtSaleDate'];
	$CustomerID=$_SESSION['CustomerID'];
	$rdoDeliveryType=$_POST['rdoDeliveryType'];
	$rdoPaymentType=$_POST['rdoPaymentType'];
	$txtCardNo=$_POST['txtCardNo'];
	$Status="Pending";
	$DeliveryStatus="Pending";


	$TotalAmount=CalculateTotalAmount() + (CalculateTotalAmount() * 0.05);
	$TotalQuantity=CalculateTotalQuantity();


	if ($rdoDeliveryType == "SameAddress") 
	{
		$CustomerName=$_SESSION['CustomerName'];
		$Phone=$_SESSION['PhoneNumber'];
		$DeliverAddress=$_SESSION['Address'];
	}
	else
	{
		$CustomerName=$_POST['txtCustomerName'];
		$PhoneNumber=$_POST['txtPhoneNumber'];
		$DeliverAddress=$_POST['txtAddress'];
	}

	$InsertSale="INSERT INTO `Sale`
				  (`SaleID`, `SaleDate`, `CustomerID`, `PaymentType`, `CardNo`, `TotalQuantity`, `TotalAmount`, `Status`) 
				  VALUES
				  ('$txtSaleID','$txtSaleDate','$CustomerID','$rdoPaymentType', '$txtCardNo','$TotalQuantity','$TotalAmount','$Status')
				  ";
	$result=mysqli_query($connection,$InsertSale);

    $InsertDelivery="INSERT INTO `delivery`
					(`DeliverAddress`, `DeliveryStatus`) 
					VALUES ('$DeliverAddress', '$DeliveryStatus')";
    $result=mysqli_query($connection,$InsertDelivery);

	$count=count($_SESSION['ShoppingCartFunction']);

	for ($i=0; $i < $count; $i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCartFunction'][$i]['ProductID'];
		$Price=$_SESSION['ShoppingCartFunction'][$i]['Price'];
		$BuyQuantity=$_SESSION['ShoppingCartFunction'][$i]['BuyQuantity'];

		$InsertSD="INSERT INTO `sale_detail`
				 (`SaleID`, `ProductID`, `Price`, `Quantity`) 
				 VALUES
				 ('$txtSaleID','$ProductID','$Price','$BuyQuantity')
				  ";
		$result=mysqli_query($connection,$InsertSD);
	}

	if($result) 
	{
		unset($_SESSION['ShoppingCartFunction']);

		echo "<script>window.alert('Successfully Completed Checkout Process!')</script>";
		echo "<script>window.location='ProductDisplay.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Checkout : " . mysqli_error($connection) . "</p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
function SameAddress()
{
	document.getElementById('SameAddress').style.display="block";
	document.getElementById('OtherAddress').style.display="none";
}
function OtherAddress()
{
	document.getElementById('SameAddress').style.display="none";
	document.getElementById('OtherAddress').style.display="block";
}
function COD()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="none";
}
function Card()
{
	document.getElementById('CardPayment').style.display="block";
	document.getElementById('Kpay').style.display="none";
}
function Kpay()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="block";
}
</script>

</head>
<body>
<form action="Checkout.php" method="post">
<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
    </script>
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Checkout Page</h1>
            </div>
        </div>
</div>
<table cellpadding="5px" align="center">
<tr>
	<td>SaleID :</td>
	<td>
		<input type="text" name="txtSaleID" value="<?php echo AutoID('sale','SaleID','ORD-',6) ?>" readonly>
	</td>
	<td>Total Amount :</td>
	<td>
		<b><?php echo CalculateTotalAmount() ?> USD</b>
	</td>
    <td>VAT (5%)</td>
	<td>
		<b><?php echo CalculateTotalAmount() * 0.05 ?> USD</b>
	</td>
</tr>
<tr>
	<td>SaleDate :</td>
	<td>
		<input type="text" name="txtSaleDate" value="<?php echo date('Y-m-d') ?>" readonly>
	</td>
	<td>Total Quantity :</td>
	<td>
		<b><?php echo CalculateTotalQuantity() ?> pcs</b>
	</td>
</tr>
</table>
<hr/>
<div align="center">
<p><b><u>Delivery Details </u></b></p>
<input type="radio" name="rdoDeliveryType" value="SameAddress" onClick="SameAddress()" checked />Same Address
<input type="radio" name="rdoDeliveryType" value="OtherAddress" onClick="OtherAddress()" />Other Address
</div>
<div id="SameAddress" style="display: block;" align="center">
<table>
	<tr>
		<td>Customer Name :</td>
		<td>
			<b><?php echo $_SESSION['CustomerName'] ?></b>
		</td>
	</tr>
	<tr>
		<td>Address :</td>
		<td>
			<b><?php echo $_SESSION['Address'] ?></b>
		</td>
	</tr>
	<tr>
		<td>Phone :</td>
		<td>
			<b><?php echo $_SESSION['PhoneNumber'] ?></b>
		</td>
	</tr>
</table>
</div>

<div id="OtherAddress" style="display: none;" align="center">
<table>
	<tr>
		<td>Customer Name :</td>
		<td>
			<input type="text" name="txtCustomerName" placeholder="Eg. Alan" />
		</td>
	</tr>
	<tr>
		<td>Phone :</td>
		<td>
			<input type="text" name="txtPhoneNumber" placeholder="+95-----------" />
		</td>
	</tr>
	<tr>
		<td>Address :</td>
		<td>
			<textarea name="txtAddress" cols="30" placeholder="Room No / Street Name / etc."></textarea>
		</td>
	</tr>
</table>
</div>


<hr/>
<div align="center">
<p><b><u>Payment Details </u></b></p>
<input type="radio" name="rdoPaymentType" value="COD" checked onClick="COD()" />Cash on Delivery
<input type="radio" name="rdoPaymentType" value="Card" onClick="Card()" />Card Payment
<input type="radio" name="rdoPaymentType" value="KPay" onClick="Kpay()" />Kpay
</div>
<div id="CardPayment" style="display: none" align="center">
<table>
<tr>
	<td>
		<input type="text" name="txtCardNo" placeholder="Enter Card Number" /> |
		<input type="text" name="txtSecurityNo" placeholder="Security Code" size="9" /> 
	</td>
</tr>
<tr>
	<td>
		<input type="text" name="txtMonth" placeholder="JAN" size="5" />
		<input type="text" name="txtYear" placeholder="2021" size="5" />
	</td>
</tr>
</table>
</div>

<div id="Kpay" style="display: none" align="center">
<p><b>KBZ Pay No : 23546125798462</b></p>
<img src="Images/kpay.png" width="100px" height="100px" />
</div>

<hr/>
<div align="center">
<input type="submit" name="btnCheckout" class="btn btn-primary wow zoomIn" value="Checkout" />
<input type="reset" name="btnClear" class="btn btn-primary wow zoomIn" value="Clear" />
<hr/>
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
	<table id="tableid" class="display">
    <thead>
	<tr>
		<th>Image</th>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>Price</th>
		<th>Buy Quantity</th>
		<th>Total Amount</th>
	</tr>
	</thead>
	<tbody>
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
		echo "</tr>";			
	}
	?>
	<tbody>
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