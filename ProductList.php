<?php 
    include ('connect.php');
    include ('Header.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Product List</title>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<form action="ProductList.php" method="POST" enctype="multipart/form-data">
    <script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
    </script>
    <div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="Product.php">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product List</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Product List</h1>
            </div>
        </div>
    </div>
            <table id="tableid" class="display">
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>ProductImage</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $select="Select * from Product";
                    $query=mysqli_query($connection,$select);
                    $count=mysqli_num_rows($query);
                    if($count>0)
                    {
                        for ($i=0; $i <$count ; $i++) 
                        { 
                           $data=mysqli_fetch_array($query);
                           $productid=$data['ProductID'];
                           $productname=$data['ProductName'];
                           $price=$data['Price'];
                           $quantity=$data['Quantity'];
                           $productimage=$data['ProductImage'];
                           $description=$data['Description'];
                           echo "<tr>
                           <td>$productid</td>
                           <td>$productname</td>
                           <td>$price</td>
                           <td>$quantity</td>
                           <td><img src='$productimage' width='200px' height='200px'></td>
                           <td>$description</td>
                           <td>

                           <a href='ProductUpdate.php?pid=$productid'>Update</a> |
                           <a href='ProductDelete.php?pid=$productid'>Delete</a>

                           </td>
                           </td>";
                        }
                    }
                    ?>
                    <tbody>
            </table>
            <table border="1px" align="center">
                <tr>
                    <td><a class="btn btn-primary wow zoomIn" href="Product.php">Go Back to Product Entry</a></td>
                </tr>
            </table>
	</form>
</body>
</html>
<?php 
    include('Footer.php');
?>
