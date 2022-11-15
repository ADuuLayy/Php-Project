<?php  
session_start();
include('connect.php');
include('Header.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtRoleID=$_POST['txtRoleID'];
	$txtRole=$_POST['txtRole'];
	$rdoStatus=$_POST['rdoStatus'];

	$Update="UPDATE role
			 SET 
			 Role='$txtRole',
			 Status='$rdoStatus'
			 WHERE 
			 RoleID='$txtRoleID'
			 ";
	$result=mysqli_query($connection,$Update);
	
	if($result) 
	{
		echo "<script>window.alert('Successfully Updated!')</script>";
		echo "<script>window.location='Role.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Role Update : " . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['RoleID'])) 
{
	$RoleID=$_GET['RoleID'];

	$Query="SELECT * FROM role WHERE RoleID='$RoleID' ";
	$result=mysqli_query($connection,$Query);
	$arr=mysqli_fetch_array($result);
}	
else
{
	$RoleID="";
	echo "<script>window.location='Role.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Role Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body>
<form action="RoleUpdate.php" method="post">
		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="RoleList.php">Role List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role Update</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Role Update</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Role Update Entry</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Role</label>
						<input type="text" name="txtRole" class="form-control" value="<?php echo $arr['Role'] ?>" required />
                    </div>
					<div class="col-sm-7 py-3 wow fadeInLeft">
                        <label for="fullName">Status: </label>
						<?php  
							if($arr['Status'] == "Active") 
							{
								echo "<input type='radio' name='rdoStatus' value='Active' checked />Active";
								echo "<input type='radio' name='rdoStatus' value='InActive' />InActive";
							}
							else
							{
								echo "<input type='radio' name='rdoStatus' value='Active'  />Active";
								echo "<input type='radio' name='rdoStatus' value='InActive' checked />InActive";
							}
						?>
                    </div>
                </div>
                <div>
					<input type="hidden" name="txtRoleID" value="<?php echo $arr['RoleID'] ?>">
                    <button type="submit" name="btnUpdate"class="btn btn-primary wow zoomIn">Update</button>
					<button type="reset" name="btnClear"class="btn btn-primary wow zoomIn">Clear</button>
                    <a class="btn btn-primary wow zoomIn" href="RoleList.php" >Return to Role List</a>
                </div>
            </form>
        </div>
    </div>
</form>
</table>
</fieldset>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>