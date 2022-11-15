<?php 
	include('connect.php');
	include('Header.php');
	if(isset($_POST['btnsubmit']))
	{
		$categoryname=$_POST['txtcategoryname'];

		$select="SELECT * FROM Category where CategoryName='$categoryname'";
		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			echo"<script> alert('Category Name Already Exist!') </script>"; 
		}

		else
		{

			$insert="INSERT INTO Category(CategoryName) values('$categoryname')" ;
			$query=mysqli_query($connection,$insert);
			if($query) 
			{
				echo "<script>alert('Successfully Saved Category Name')</script>";
			}

	    }
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Entry</title>
</head>
<body>
	<form action="Category.php" method="POST">
	<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Category</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Category Entry</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Category Name</label>
                            <input type="text" name="txtcategoryname" class="form-control" placeholder="Full name.." required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnsubmit"class="btn btn-primary wow zoomIn">Save</button>
                    <a class="btn btn-primary wow zoomIn" href="CategoryList.php" >Click Here To See Category List</a>
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