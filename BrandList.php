<?php 
    include('connect.php');
    include('Header.php');
?>

<html>
<head>
    <title>Brand List</title>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    
    <form action="BrandList.php" method="POST">
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
                        <li class="breadcrumb-item"><a href="Brand.php">Brand</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brand List</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Brand List</h1>
            </div>
        </div>
    </div>
            <table id="tableid" class="display">
                <thead>
                <tr>
                    <th>Brand ID</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $select="Select * from Brand";
                    $query=mysqli_query($connection,$select);
                    $count=mysqli_num_rows($query);
                    if($count>0)
                    {
                        for ($i=0; $i <$count ; $i++) 
                        { 
                           $data=mysqli_fetch_array($query);
                           $brandid=$data['BrandID'];
                           $brandname=$data['BrandName'];
                           echo "<tr>
                           <td>$brandid</td>
                           <td>$brandname</td>
                           <td>

                           <a href='BrandUpdate.php?bid=$brandid'>Update</a> |
                           <a href='BrandDelete.php?bid=$brandid'>Delete</a>

                           </td>
                           </td>";
                        }
                    }
                 ?>
                 <tbody>
            </table>
            <table border="1px" align="center">
                <tr>
                    <td><a class="btn btn-primary wow zoomIn" href="Brand.php">Go Back to Brand Entry</a></td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>
<?php 
    include('Footer.php');
?>