<?php 
	session_start();
	include('connect.php');
	include ('Header.php');
	include('AutoIDFunction.php');
	include('PurchaseFunction.php');

if(isset($_GET['btnsave']))
{
	$cboSupplierID=$_GET['cboSupplierID'];
	$EmployeeID=$_GET['cboEmployeeID'];
	$txtpurchaseID=$_GET['txtpurchaseID'];
	$txtpurchaseDate=$_GET['txtpurchaseDate'];
	$txtgovtax=$_GET['txtgovtax'];
	$TotalPrice=CalculateTotalAmount();
	$TotalQuantity=CalculateTotalQuantity();
	$GovTax=CalculateTax();
	$GrandTotal=(CalculateTotalAmount() * CalculateTotalQuantity() + CalculateTax());
	$Status="Pending";
	$insert_Pur="INSERT INTO purchase
				(PurchaseID, PurchaseDate, SupplierID, EmployeeID, TotalPrice , GovTax, GrandTotal, TotalQuantity, PurchaseStatus)
				VALUES
				('$txtpurchaseID','$txtpurchaseDate','$cboSupplierID','$EmployeeID','$TotalPrice','$GovTax', '$GrandTotal', '$TotalQuantity','$Status')";
	$ret=mysqli_query($connection,$insert_Pur);
	$size=count($_SESSION['PurchaseFunction']);
	for($i=0; $i<$size; $i++) 
	{ 
		$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['Price'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['Quantity'];

		$insert_PDetail="INSERT INTO purchase_detail
						(PurchaseID,ProductID,PurchasePrice,PurchaseQuantity)
						VALUES 
						('$txtpurchaseID','$ProductID','$PurchasePrice','$PurchaseQuantity')";
		$ret=mysqli_query($connection,$insert_PDetail);

		$insert_PDetail="Update Product set Quantity=Quantity+ '$PurchaseQuantity' where ProductID='$ProductID'";
		$ret=mysqli_query($connection,$insert_PDetail);
	}
	if($ret)
	{
		unset($_SESSION['PurchaseFunction']);

		echo "<script>window.alert('Purchase Process Complete.')</script>";
		echo "<script>window.location='Purchase.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Purchase: " . mysqli_error($connection) . "</p>";
	}
}

	if(isset($_GET['action']))
{
	$action=$_GET['action'];

	if($action==='add')
	{
		$ProductID=$_GET['cboProductID'];
		$PurchasePrice=$_GET['txtpurchaseprice'];
		$PurchaseQuantity=$_GET['txtpurchasequantity'];
		Add($ProductID,$PurchasePrice,$PurchaseQuantity);
	}
	elseif($action==='remove')
	{
		$ProductID=$_GET['ProductID'];
		Remove($ProductID);
	}
}
	


 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="Purchase.php" method="GET">
		<input type="hidden" name="action" value="add">
		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Purchase</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Purchase</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Enter Product Purchase Info</h1>
			<table align="center" cellpadding="5px">
				<tr>
					<td>PurchaseID</td>
					<td>
						<input type="text" name="txtpurchaseID" value="<?php echo AutoID('purchase','PurchaseID','PUR-',6) ?>" readonly required/>
					</td>
				</tr>
				<tr>
					<td>Purchase Date</td>
					<td>
						<input type="text" name="txtpurchaseDate" value="<?php echo date('Y-m-d') ?>" readonly required/>
					</td>
				</tr>
				
				<tr>
					<td>GovTax</td>
					<td>
					<input type="number" name="txtgovtax" placeholder="0" value="<?php echo CalculateTax () ?>" required readonly/> MMK
					</td>
				</tr>
				<tr>
					<td>Total Amount</td>
					<td>
						<input type="number" name="texttotalamount" placeholder="0" value="<?php echo CalculateTotalAmount () ?>" required readonly/> MMK
					</td>
				</tr>

				<tr>
					<td>Total Quantity</td>
					<td>
						<input type="number" name="txttotalqty" placeholder="0" value="<?php echo CalculateTotalQuantity () ?>" readonly/> pcs 
					</td>
				</tr>
				<tr>
					<td>ProductID</td>
					<td>
						<select name="cboProductID">
							<option>---Select ProductID---</option>
							<<?php 
								$query="SELECT * FROM Product";
								$ret=mysqli_query($connection,$query);
								$count=mysqli_num_rows($ret);

								for ($i=0; $i < $count; $i++) 
								{
									$arr=mysqli_fetch_array($ret);
									$ProductID=$arr['ProductID'];
									$ProductName=$arr['ProductName'];
									echo "<option value='$ProductID'>" . $ProductID . '~' . $ProductName . "</option>"; 
								}
							 ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Purchase Price</td>
					<td>
						<input type="number" name="txtpurchaseprice"  placeholder="0"> MMK
					</td>
				</tr>
				<tr>
					<td>Purchase Quantity</td>
					<td>
						<input type="number" name="txtpurchasequantity" placeholder="0"> MMK
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" class="btn btn-primary wow zoomIn" name="btnAdd" value="Add"/>
						<input type="reset" class="btn btn-primary wow zoomIn" name="Clear"/>
					</td>
				</tr>
			</table>
			<h2 align="center">Product List</h2>
		<?php 
			if(!isset($_SESSION['PurchaseFunction']))
			{
				echo "<p>No Purchase Record Found</p>";
				exit();
			}
		 ?>
		<table align="center" border="1" cellpadding="3px">
		<tr>
			<th>Image</th>
			<th>ProductID</th>
			<th>ProductName</th>
			<th>Purchase Price</th>
			<th>Purchase Qty</th>
			<th>Grand Total</th>
			<th>Action</th>
		</tr>
	
<?php 
	$size=count($_SESSION['PurchaseFunction']);
	for ($i=0; $i<$size ; $i++) 
	{ 
		$Image1=$_SESSION['PurchaseFunction'][$i]['Image1'];
		$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
		$ProductName=$_SESSION['PurchaseFunction'][$i]['ProductName'];
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['Price'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['Quantity'];
		$GrandTotal=($PurchasePrice*$PurchaseQuantity) + CalculateTax();

		echo "<tr>";
		echo "<td><img src='$Image1' width='100px' height='100px'/></td>";
		echo "<td>$ProductID</td>";
		echo "<td>$ProductName</td>";
		echo "<td>$PurchasePrice</td>";
		echo "<td>$PurchaseQuantity</td>";
		echo "<td>$GrandTotal MMK</td>";
		
		echo "<td><a href='Purchase.php?action=remove&&ProductID=$ProductID'>Remove</a></td>";

		echo "</tr>";
	}
 ?>

 	<tr>
					<td>Net Amount</td>
					<td>
						<?php 
								$netamount=CalculateTotalAmount()-CalculateTax();
						 ?>
						<input type="number" name="txtnetamount" placeholder="0" 
						value="<?php echo $netamount ?>" readonly/> MMK
					</td>
				</tr>
				<tr>
					<td>SupplierID</td>
					<td>
						<select name="cboSupplierID">
							<option>---Select SupplierID---</option>
							<<?php 
								$query="SELECT * FROM Supplier";
								$ret=mysqli_query($connection,$query);
								$count=mysqli_num_rows($ret);

								for ($i=0; $i < $count; $i++) 
								{
									$arr=mysqli_fetch_array($ret);
									$SupplierID=$arr['SupplierID'];
									$CompanyName=$arr['CompanyName'];
									echo "<option value='$SupplierID'>" . $SupplierID . '~' . $CompanyName . "</option>"; 
								}
							 ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Employee Name</td>
					<td>
						<select name="cboEmployeeID">
							<option>---Select EmployeeName---</option>
							<<?php 
								$query="SELECT * FROM Employee";
								$ret=mysqli_query($connection,$query);
								$count=mysqli_num_rows($ret);

								for ($i=0; $i < $count; $i++) 
								{
									$arr=mysqli_fetch_array($ret);
									$EmployeeID=$arr['EmployeeID'];
									$EmployeeName=$arr['EmployeeName'];
									echo "<option value='$EmployeeID'>" . $EmployeeID . '~' . $EmployeeName . "</option>"; 
								}
							 ?>
						</select>
					</td>
					<td>
						<input type="submit" class="btn btn-primary wow zoomIn" name="btnsave" value="Save">
					</td>
				</tr>
 </table>
				</div>
				</div>
			</form>
</body>
</html>
<?php 
    include('Footer.php');
?>