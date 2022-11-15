<?php 
	include('connect.php');
	include('Header.php');
	if(isset($_REQUEST['cid']))
	{
		$categoryid=$_REQUEST['cid'];
		$select="SELECT * FROM Category where CategoryID='$categoryid'";
		$query=mysqli_query($connection,$select);
		if($query)
		{
			$data=mysqli_fetch_array($query);
			$categoryid=$data['CategoryID'];
			$categoryname=$data['CategoryName'];
		}
	}
	if(isset($_POST['btnupdate']))
	{
		$cid=$_POST['txtcid'];
		$cname=$_POST['txtcname'];
		$update="UPDATE Category set CategoryName='$cname' where CategoryID='$cid'";
		$query=mysqli_query($connection,$update);
		if($query)
		{
			echo "<script> alert('Category Update Successful')</script>";
			echo "<script>window.location='CategoryList.php'</script>";
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action ="CategoryUpdate.php" method="POST">
 		<input type="hidden" name="txtcid" value="<?php echo $categoryid?>">
		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="CategoryList.php">Category List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category Update</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Category Update</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Category Update Entry</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Category Name</label>
                            <input type="text" name="txtcname"  value="<?php echo $categoryname?>" class="form-control" placeholder="Full name..">
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnupdate"class="btn btn-primary wow zoomIn">Update</button>
                    <a class="btn btn-primary wow zoomIn" href="CategoryList.php" >Return to Category List</a>
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