<?php  
session_start();
include('connect.php');
include('Header2.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Dashboard</title>
</head>
<body>
<form>
<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <h1 class="font-weight-normal">Welcome <?php echo $_SESSION['CustomerName'] ?></h1>
				<a class="btn btn-primary wow zoomIn" href="ProductDisplay.php" >Click Here To Buy Product</a>
            </div>
        </div>
</div>
</form>
</body>
</html>
<?php 
    include('Footer.php');
?>