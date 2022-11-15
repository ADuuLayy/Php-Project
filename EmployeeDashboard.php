<?php  
session_start();
include('connect.php');
include('Header.php');
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
                <h1 class="font-weight-normal">Welcome <?php echo $_SESSION['EmployeeName'] . ' | ' . $_SESSION['Role']  ?></h1>
				<a class="btn btn-primary wow zoomIn" href="Purchase.php" >Click To Purchase Product</a>
            </div>
        </div>
</div>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>