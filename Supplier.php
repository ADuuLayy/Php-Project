<?php 
    include ('connect.php');
	include('Header.php');
    if(isset($_POST['btnsubmit']))
    {
    	$companyname=$_POST['txtcompanyname'];
    	$phonenumber=$_POST['txtphonenumber'];

		$select="SELECT * FROM Supplier where CompanyName='$companyname'";
		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			echo"<script> alert('Company Name Already Exist!') </script>"; 
		}

		else
		{
        $insert= "INSERT INTO supplier(companyname,phonenumber)
        VALUES('$companyname','$phonenumber') ";

        $query=mysqli_query($connection,$insert);	 
        if($query)
        {
        	echo "<script>alert('Successfully Saved Supplier')</script>";
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
	<form action="Supplier.php" method="POST">
	<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Supplier </h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Supplier Entry</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Company Name</label>
                        <input type="text" name="txtcompanyname" class="form-control" placeholder="Enter Company Name.." required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Phone Number</label>
                        <input type="text" name="txtphonenumber" class="form-control" placeholder="Enter Phone Number.." required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnsubmit"class="btn btn-primary wow zoomIn">Save</button>
                    <a class="btn btn-primary wow zoomIn" href="SupplierList.php" >Click Here To See Supplier List</a>
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
