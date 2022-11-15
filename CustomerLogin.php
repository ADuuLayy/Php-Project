<?php  
session_start();
include('connect.php');
include('Header1.php');
if(isset($_POST['btnLogin'])) 
{
	$customername=$_POST['txtcustomername'];
	$password=$_POST['txtPassword'];

	$CheckAccount="SELECT * FROM customer where CustomerName='$customername' and password='$password'";
	$result=mysqli_query($connection,$CheckAccount);
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	if($count < 1) 
	{
		echo "<script>window.alert('Customer Name or Password Incorrect')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
	}
	else
	{
		$_SESSION['CustomerID']=$arr['CustomerID'];
		$_SESSION['CustomerName']=$arr['CustomerName'];
        $_SESSION['PhoneNumber']=$arr['PhoneNumber'];
        $_SESSION['Address']=$arr['Address'];

		echo "<script>window.alert('Successfully Login as Customer!')</script>";
		echo "<script>window.location='CustomerDashboard.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
</head>
<body>
<form action="CustomerLogin.php" method="post">
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Customer Login</h1>
            </div>
        </div>
</div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Customer Login</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Customer Name</label>
                            <input type="text" name="txtcustomername" class="form-control" placeholder="Enter Customer Name" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Password</label>
                            <input type="password" name="txtPassword" class="form-control" placeholder="XXXXXXXXXXXXXX" required>
                    </div>
				</div>
                <div>
                    <button type="submit" name="btnLogin"class="btn btn-primary wow zoomIn">Login</button>
					<button type="reset" name="btnClear"class="btn btn-primary wow zoomIn">Clear</button>
                    <a href="Customer.php" class="btn btn-primary wow zoomIn">Doesn't Have Acc? Click To Register</a>
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