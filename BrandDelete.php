<?php 
	include('connect.php');
	if(isset($_REQUEST['bid']))
	{
		$brandid=$_REQUEST['bid'];
		$delete="DELETE from Brand where BrandID='$brandid'";
		$query=mysqli_query($connection,$delete);
		if($query)
		{
			echo "<script>alert('Brand Delete Successful')</script>";
			echo "<script>window.location='BrandList.php'</script>";
		}
	}
 ?>