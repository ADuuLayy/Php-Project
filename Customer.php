<?php 
	session_start();
    include ('connect.php');
	include('Header1.php');
    if(isset($_POST['btnsubmit']))
    {
    	$customername=$_POST['txtcustomername'];
		$phonenumber=$_POST['txtphoneno'];
        $address=$_POST['txtaddress'];
    	$password=$_POST['txtpassword'];
        
        $select="SELECT * FROM customer where CustomerName='$customername' ";
        $query=mysqli_query($connection,$select);
        $count=mysqli_num_rows($query);
        if($count>0)
        {
            echo"<script> alert('Customer Name Already Exist!') </script>"; 
        }

        else
        {

        $insert= "INSERT INTO customer(CustomerName,PhoneNumber,Address,Password)
        VALUES('$customername','$phonenumber','$address','$password') ";

        $query=mysqli_query($connection,$insert);	 
        if($query)
        {
        	echo "<script>alert('Successfully Registered Customer')</script>";
        }
        }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Point Of Sale System</title>
</head>
<body>
	<form action="Customer.php" method="POST">
	<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Customer Register</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Customer Register</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Customer Name</label>
                            <input type="text" name="txtcustomername" class="form-control" placeholder="Full name.." required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Phone Number</label>
                            <input type="text" name="txtphoneno" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Address</label>
                            <input type="text" name="txtaddress" class="form-control" placeholder="Enter Address" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Password</label>
                            <input type="password" name="txtpassword" class="form-control" placeholder="Enter Customer Password" required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnsubmit"class="btn btn-primary wow zoomIn">Register</button>
                    <a href="CustomerLogin.php" class="btn btn-primary wow zoomIn">Already Have Acc? Click To Login</a>
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