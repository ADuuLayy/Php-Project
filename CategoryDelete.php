<?php 
	include('connect.php');
	if(isset($_REQUEST['cid']))
	{
		$categoryid=$_REQUEST['cid'];
		$delete="DELETE from Category where CategoryID='$categoryid'";
		$query=mysqli_query($connection,$delete);
		if($query)
		{
			echo "<script>alert('Category Delete Successful')</script>";
			echo "<script>window.location='CategoryList.php'</script>";
		}
	}
 ?>