<?php  
session_start();
include('connect.php');
include('AutoIDFunction.php');
include('PurchaseFunction.php');

if(isset($_POST['btnConfirm'])) 
{
	$txtPOID=$_POST['txtPOID'];

	$result=mysqli_query($connection,"SELECT * FROM purchase_detail WHERE PurchaseOrderID='$txtPOID' ");

	while($arr=mysqli_fetch_array($result)) 
	{
		$ProductID=$arr['ProductID'];
		$PurchaseQuantity=$arr['PurchaseQuantity'];

		$UpdateQty="UPDATE product
					SET 
					Quantity=Quantity + '$PurchaseQuantity'
					WHERE ProductID='$ProductID'
					";
		$ret=mysqli_query($connection,$UpdateQty);			# code...
	}

	$UpdateStatus="UPDATE purchase
				  SET
				  Status='Confirmed'
				  WHERE PurchaseID='$txtPOID'
				  ";
	$ret=mysqli_query($connection,$UpdateStatus);

	if($ret) 
	{
		echo "<script>window.alert('Successfully Confirmed Purchase !')</script>";
		echo "<script>window.location='EmployeeDashboard.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Purchase Confirmed: " . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['PurchaseID'])) 
{
	//Single
	$PurchaseID=$_GET['PurchaseID'];

	$Query1="SELECT po.*,sup.SupplierID,sup.SupplierName,st.EmployeeID,st.EmployeeName
			FROM purchaseorder po,staff st, supplier sup
			WHERE po.PurchaseID='$PurchaseID'
			AND po.EmployeeID=st.EmployeeID
			AND po.SupplierID=sup.SupplierID 
			";
	$result1=mysqli_query($connection,$Query1);
	$row1=mysqli_fetch_array($result1);

	//Repeat
	$Query2="SELECT po.*,pod.*,p.ProductID,p.ProductName
			FROM purchase po,purchase_detail pod, product p
			WHERE po.PurchaseID=pod.PurchaseID
			AND pod.PurchaseID='$PurchaseID'
			AND pod.ProductID=p.ProductID ";
	$result2=mysqli_query($connection,$Query2);
	$count=mysqli_num_rows($result2);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchase Details</title>
</head>
<body>
<form action="PurchaseDetails.php" method="post">
<fieldset>
<legend>Purchase Details :</legend>
<table align="center" border="1" cellpadding="5px">
<tr>
	<td>PurchaseID</td>
	<td>
		<b><?php echo $row1['PurchaseID'] ?></b>
	</td>
	<td>Status</td>
	<td>
		<b><?php echo $row1['Status'] ?></b>
	</td>
</tr>
<tr>
	<td>PO Date</td>
	<td>
		<b><?php echo $row1['PurchaseDate'] ?></b>
	</td>
	<td>Report Date</td>
	<td>
		<b><?php echo date('Y-m-d') ?></b>
	</td>
</tr>
<tr>
	<td>SupplierInfo</td>
	<td>
		<b><?php echo $row1['SupplierName'] ?></b>
	</td>
	<td>StaffInfo</td>
	<td>
		<b><?php echo $row1['EmployeeName'] ?></b>
	</td>
</tr>
<tr>
	<td colspan="4">
	<table cellpadding="5px" border="1" width="100%">
	<tr>
		<th>ProductID</th>
		<th>ProductName</th>
		<th>PurchasePrice</th>
		<th>PurchaseQuantity</th>
		<th>Sub-Total</th>
	</tr>
	<?php
	for($i=0;$i<$count;$i++) 
	{ 
		$row=mysqli_fetch_array($result2);

		echo "<tr>";
			echo "<td>" . $row['ProductID'] . "</td>";
			echo "<td>" . $row['ProductName'] . "</td>";
			echo "<td>" . $row['PurchasePrice'] . " USD</td>";
			echo "<td>" . $row['PurchaseQuantity'] . " pcs</td>";
			echo "<td>" . $row['PurchaseQuantity'] * $row['PurchasePrice']  . " USD</td>";
		echo "</tr>";			
	}
	?>
	</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="right">
	TotalAmount : <b><?php echo $row1['TotalAmount'] ?> USD</b>
	<hr/>
	TotalQuantity : <b><?php echo $row1['TotalQuantity'] ?> pcs</b>
	<hr/>
	VAT (5%) : <b><?php echo $row1['GovTax'] ?> USD</b>
	<hr/>
	GrandTotal : <b><?php echo $row1['PurchasePrice'] ?> USD</b>
	<hr/>
	<input type="hidden" name="txtPOID" value="<?php echo $row1['PurchaseID'] ?>" />
	<input type="submit" name="btnConfirm" value="Confirm PO" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>