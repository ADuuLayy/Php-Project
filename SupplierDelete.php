<?php 
	include('connect.php');
	if(isset($_REQUEST['sid']))
	{
		$supplierid=$_REQUEST['sid'];
		$delete="DELETE from Supplier where SupplierID='$supplierid'";
		$query=mysqli_query($connection,$delete);
		if($query)
		{
			echo "<script>alert('Supplier Delete Successful')</script>";
			echo "<script>window.location='SupplierList.php'</script>";
		}
	}
 ?>