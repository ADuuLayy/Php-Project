<?php 
	include('connect.php');
	include('Header.php');
	if(isset($_REQUEST['sid']))
	{
		$supplierid=$_REQUEST['sid'];
		$select="SELECT * FROM Supplier where SupplierID='$supplierid'";
		$query=mysqli_query($connection,$select);
		if($query)
		{
			$data=mysqli_fetch_array($query);
			$supplierid=$data['SupplierID'];
			$companyname=$data['CompanyName'];
		}
	}
	if(isset($_POST['btnupdate']))
	{
		$sid=$_POST['txtsid'];
		$sname=$_POST['txtsname'];
		$update="UPDATE Supplier set CompanyName='$sname' where SupplierID='$sid'";
		$query=mysqli_query($connection,$update);
		if($query)
		{
			echo "<script> alert('Supplier Update Successful')</script>";
			echo "<script>window.location='SupplierList.php'</script>";
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action ="SupplierUpdate.php" method="POST">
 		<input type="hidden" name="txtsid" value="<?php echo $supplierid?>">
		<input type="hidden" name="txtbid" value="<?php echo $brandid?>">
		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="BrandList.php">Supplier List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier Update</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Supplier Update</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Supplier Update Entry</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Company Name</label>
						<input type="text" name="txtsname" class="form-control" value="<?php echo $companyname?>" required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnupdate"class="btn btn-primary wow zoomIn">Update</button>
                    <a class="btn btn-primary wow zoomIn" href="SupplierList.php" >Return to Supplier List</a>
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