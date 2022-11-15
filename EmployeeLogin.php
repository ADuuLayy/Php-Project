<?php  
session_start();
include('connect.php');
include('Header1.php');
if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$CheckAccount="SELECT s.*,r.RoleID,r.Role 
				   FROM employee s, role r
				   WHERE EmployeeEmail='$txtEmail'
				   AND Password='$txtPassword'
				   AND s.RoleID=r.RoleID ";
	$result=mysqli_query($connection,$CheckAccount);
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	if($count < 1) 
	{
		echo "<script>window.alert('Email or Password Incorrect')</script>";
		echo "<script>window.location='EmployeeLogin.php'</script>";
	}
	else
	{
		$_SESSION['EmployeeID']=$arr['EmployeeID'];
		$_SESSION['EmployeeName']=$arr['EmployeeName'];
		$_SESSION['Role']=$arr['Role'];

		echo "<script>window.alert('Successfully Login as Employee!')</script>";
		echo "<script>window.location='EmployeeDashboard.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>
</head>
<body>
<form action="EmployeeLogin.php" method="post">
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Employee Login</h1>
            </div>
        </div>
</div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Employee Login</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Email</label>
                            <input type="email" name="txtEmail" class="form-control" placeholder="example@domain.com" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Password</label>
                            <input type="password" name="txtPassword" class="form-control" placeholder="XXXXXXXXXXXXXX" required>
                    </div>
				</div>
                <div>
                    <button type="submit" name="btnLogin"class="btn btn-primary wow zoomIn">Login</button>
					<button type="reset" name="btnClear"class="btn btn-primary wow zoomIn">Clear</button>
                </div>
			</form>
		</div>
		</div>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>