<?php 
	include('connect.php');
	include('Header.php');
	if(isset($_REQUEST['pid']))
	{
		$productid=$_REQUEST['pid'];
		$select="SELECT * FROM Product where ProductID='$productid'";
		$query=mysqli_query($connection,$select);
		if($query)
		{
			$data=mysqli_fetch_array($query);
			$productid=$data['ProductID'];
			$productname=$data['ProductName'];
			$quantity=$data['Quantity'];
			$price=$data['Price'];
			$productimage=$data['ProductImage'];
			$description=$data['Description'];
		}
	}
	if(isset($_POST['btnupdate']))
	{
		$pid=$_POST['txtpid'];
		$productname=$_POST['txtproductname'];
		$brandid=$_POST['cbobrandname'];
		$categoryid=$_POST['cbocategoryname'];
		$quantity=$_POST['txtquantity'];
		$price=$_POST['txtprice'];
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
			$update="UPDATE Product set ProductName='$productname', BrandID='$brandid', CategoryID='$categoryid', Price='$price', Quantity='$quantity', ProductImage='$filename', Description='$description' where ProductID='$pid'";
		$query=mysqli_query($connection,$update);
		if($query)
		{
			echo "<script> alert('Product Update Successful')</script>";
			echo "<script>window.location='ProductList.php'</script>";
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action ="ProductUpdate.php" method="POST" enctype="multipart/form-data">
 		<input type="hidden" name="txtpid" value="<?php echo $productid?>">

 		<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="ProductList.php">Product List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Update</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Product Update </h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Product Update Entry</h1>
			<form class="contact-form mt-5">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Product Name</label>
            <input type="text" name="txtproductname" class="form-control" value="<?php echo $productname?>" required>
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
            <label for="subject">Category Name :</label>
            		<?php 
						$select="SELECT * FROM Category";
						$query=mysqli_query($connection,$select);
						$count=mysqli_num_rows($query);
						if($count>0)
						{
							echo"<select name='cbocategoryname'>";
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
            <input type="number" name="txtquantity" class="form-control" value="<?php echo $quantity?>" required>
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Price</label>
            <input type="number" name="txtprice" class="form-control" value="<?php echo $price?>" required>
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Product Image</label>
            <input type="file" name="txtproductimage" class="form-control" value="<?php echo $productimage?>" >
          </div>
		  <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Description</label>
            <textarea name="txtdescription" class="form-control"  value="<?php echo $description?>"></textarea>
          </div>
        	</div>
			<div>
        	<button type="submit" name="btnupdate" class="btn btn-primary wow zoomIn">Submit</button>
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
