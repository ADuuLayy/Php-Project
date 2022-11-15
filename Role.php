<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnSave'])) 
{
	$txtRole=$_POST['txtRole'];
	$rdoStatus=$_POST['rdoStatus'];

	$Check="SELECT * FROM role WHERE Role='$txtRole' ";
	$result=mysqli_query($connection,$Check);
	$count=mysqli_num_rows($result);

	if($count > 0) 
	{
		echo "<script>window.alert('Role Already Exist!')</script>";
		echo "<script>window.location='Role.php'</script>";
	}
	else
	{
		$Insert="INSERT INTO role
				 (Role,Status)
				 VALUES
				 ('$txtRole','$rdoStatus')
				 ";
		$result=mysqli_query($connection,$Insert);
	}

	if($result) 
	{
		echo "<script>window.alert('Successfully Saved Role')</script>";
		echo "<script>window.location='Role.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Role Entry : " . mysqli_error($connection) . "</p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Role Entry</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body>
<form action="Role.php" method="post">

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
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Role</h1>
            </div>
        </div>
        </div>
		<div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Role Entry</h1>

			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Role</label>
                            <input type="text" name="txtRole" class="form-control" placeholder="Eg. Sales Manager." required>
                    </div>
                </div>
				<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-3 wow fadeInLeft">
                        <label for="fullName">Status: </label>
						<input type="radio" name="rdoStatus" value="Active" checked />Active
						<input type="radio" name="rdoStatus" value="InActive" />InActive                    </div>
                </div>
				<div>
                    <button type="submit" name="btnSave"class="btn btn-primary wow zoomIn">Save</button>
					<button type="reset" name="btnClear"class="btn btn-primary wow zoomIn">Clear</button>
                </div>
</form>
</div>
</div>
<hr/>

<?php  
$Query="SELECT * FROM Role";
$result=mysqli_query($connection,$Query);
$count=mysqli_num_rows($result);

if($count < 1) 
{
	echo "<p>No Record Found!</p>";
}
else
{
?>
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>RoleID</th>
		<th>Role</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php  
	for($i=0;$i<$count;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$RoleID=$rows['RoleID'];

		echo "<tr>";
			echo "<td>" . $RoleID . "</td>";
			echo "<td>" . $rows['Role'] . "</td>";
			echo "<td>" . $rows['Status'] . "</td>";
			echo "<td>
					<a href='RoleUpdate.php?RoleID=$RoleID'>Update</a> |
					<a href='RoleDelete.php?RoleID=$RoleID'>Delete</a>
				  </td>";
		echo "</tr>";			
	}
	?>
	</tbody>
	</table>

<?php
}
?>

</fieldset>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>
