<?php 
	include('connect.php');
	include('Header.php');
	if(isset($_REQUEST['bid']))
	{
		$brandid=$_REQUEST['bid'];
		$select="SELECT * FROM Brand where BrandID='$brandid'";
		$query=mysqli_query($connection,$select);
		if($query)
		{
			$data=mysqli_fetch_array($query);
			$brandid=$data['BrandID'];
			$brandname=$data['BrandName'];
		}
	}
	if(isset($_POST['btnupdate']))
	{
		$bid=$_POST['txtbid'];
		$bname=$_POST['txtbname'];
		$update="UPDATE Brand set BrandName='$bname' where BrandID='$bid'";
		$query=mysqli_query($connection,$update);
		if($query)
		{
			echo "<script> alert('Brand Update Successful')</script>";
			echo "<script>window.location='BrandList.php'</script>";
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action ="BrandUpdate.php" method="POST">
 		<input type="hidden" name="txtbid" value="<?php echo $brandid?>">
		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="BrandList.php">Brand List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brand Update</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Brand Update</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Brand Update Entry</h1>

            <form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Brand Name</label>
                            <input type="text" name="txtbname"  value="<?php echo $brandname?>" class="form-control" placeholder="Full name..">
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnupdate"class="btn btn-primary wow zoomIn">Update</button>
                    <a class="btn btn-primary wow zoomIn" href="BrandList.php" >Return to Brand List</a>
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