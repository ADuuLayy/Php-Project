<?php 
	session_start();
    include ('connect.php');
	include('Header.php');
    if(isset($_POST['btnsubmit']))
    {
    	$productname=$_POST['txtproductname'];
    	$brandid=$_POST['cbobrandname'];
    	$categoryid=$_POST['cbocategoryname'];
   		$price=$_POST['txtprice'];
    	$quantity=$_POST['txtquantity'];
    	$description=$_POST['txtdescription'];

        $Image1=$_FILES['txtproductimage']['name'];
    	$Folder="Images/";
        $filename=$Folder . '_' . $Image1;
    	$copied=copy($_FILES['txtproductimage']['tmp_name'], $filename);

		if(!$copied)
		{
			echo "<p>Cannot Upload Image1</p>";
			exit();
		}

  	    $insert="INSERT INTO product(ProductName,BrandID,CategoryID,Price,Quantity,ProductImage,Description)
        VALUES('$productname','$brandid','$categoryid','$price','$quantity','$filename','$description')";

        $query=mysqli_query($connection,$insert);	 
        if($query)
        {
        	echo "<script>alert('Successfully Saved Product')</script>";
        }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="Product.php" method="POST" enctype="multipart/form-data">
	<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Product</h1>
            </div>
        </div>
    </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Product Entry</h1>
			<form class="contact-form mt-5">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Product Name</label>
            <input type="text" name="txtproductname" class="form-control" placeholder="Enter Product Name.." required>
          </div>
          <div class="col-sm-2 py-3 wow fadeInRight">
            <label for="emailAddress">Brand Name</label>
            <?php 
						$select="SELECT * FROM Brand";
						$query=mysqli_query($connection,$select);
						$count=mysqli_num_rows($query);
						if($count>0)
						{
							echo"<select name='cbobrandname'>";
							echo"<option>Select Brand Name</option>";
							for ($i=0; $i <$count ; $i++) 
							{ 
								$data=mysqli_fetch_array($query);
								$brandid=$data['BrandID'];
								$brandname=$data['BrandName'];
								echo"<option value='$brandid'>$brandname</option>";
							}
							echo "</select>";
						}
					 ?>
          </div>
          <div class="col-sm-6 py-5 wow fadeInRight">
            <label for="subject">Category Name</label>
            <?php 
						$select="SELECT * FROM Category";
						$query=mysqli_query($connection,$select);
						$count=mysqli_num_rows($query);
						if($count>0)
						{
							echo"<select name='cbocategoryname'>";
							echo "<option>Select Category Name</option>";
							for ($i=0; $i <$count ; $i++) 
							{ 
								$data=mysqli_fetch_array($query);
								$categoryid=$data['CategoryID'];
								$categoryname=$data['CategoryName'];
								echo"<option value='$categoryid'>$categoryname</option>";
							}
							echo "</select>";
						}
					 ?>
          </div>
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Quantity</label>
            <input type="number" name="txtquantity" class="form-control" placeholder="Enter Product Quantity.." required>
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Price</label>
            <input type="number" name="txtprice" class="form-control" placeholder="Enter Product Price.." required>
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Product Image</label>
            <input type="file" name="txtproductimage" class="form-control" placeholder="Enter Product Image.." required> 
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Description</label>
            <textarea name="txtdescription" class="form-control" rows="8" placeholder="Enter Description.."></textarea>
          </div>
        </div>
		<div>
        <button type="submit" name="btnsubmit" class="btn btn-primary wow zoomIn">Submit</button>
		<a class="btn btn-primary wow zoomIn" href="ProductList.php" >Click Here To See Product List</a>
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