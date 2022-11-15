<?php  
session_start();
include('connect.php');
include('Header1.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Dashboard</title>
</head>
<body>
<form>
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Welcome From Nex Company Pharmacy</h1>
                <a class="btn btn-primary wow zoomIn" href="CustomerLogin.php" >Customer</a>
                <a class="btn btn-primary wow zoomIn" href="EmployeeLogin.php" >Employee</a>
            </div>
        </div>
</div>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>