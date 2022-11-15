<?php  
session_start();
include('connect.php');

$RoleID=$_GET['RoleID'];

$Delete="DELETE FROM Role WHERE RoleID='$RoleID' ";
$result=mysqli_query($connection,$Delete);

if($result) 
{
	echo "<script>window.alert('Role Delete Successful')</script>";
	echo "<script>window.location='Role.php'</script>";
}
else
{
	echo "<p>Something went wrong in Role Delete : " . mysqli_error($connection) . "</p>";
}

?>