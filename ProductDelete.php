<?php 
	include('connect.php');
	if(isset($_REQUEST['pid']))
	{
		$productid=$_REQUEST['pid'];
		$delete="DELETE from Product where ProductID='$productid'";
		$query=mysqli_query($connection,$delete);
		if($query)
		{
			echo "<script>alert('Product Delete Successful')</script>";
			echo "<script>window.location='ProductList.php'</script>";
		}
	}
 ?>