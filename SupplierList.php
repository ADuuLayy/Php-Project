<?php 
    include ('connect.php');
    include ('Header.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Supplier List</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<form action="SupplierList.php" method="POST">
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
                        <li class="breadcrumb-item"><a href="Supplier.php">Supplier</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier List</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Supplier List</h1>
            </div>
        </div>
    </div>
            <table id="tableid" class="display">
                <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $select="Select * from Supplier";
                    $query=mysqli_query($connection,$select);
                    $count=mysqli_num_rows($query);
                    if($count>0)
                    {
                        for ($i=0; $i <$count ; $i++) 
                        { 
                           $data=mysqli_fetch_array($query);
                           $supplierid=$data['SupplierID'];
                           $companyname=$data['CompanyName'];
                           echo "<tr>
                           <td>$supplierid</td>
                           <td>$companyname</td>
                           <td>

                           <a href='SupplierUpdate.php?sid=$supplierid'>Update</a> |
                           <a href='SupplierDelete.php?sid=$supplierid'>Delete</a>

                           </td>
                           </td>";
                        }
                    }
                 ?>
                 <tbody>
            </table>
            <table border="1px" align="center">
                <tr>
                    <td><a class="btn btn-primary wow zoomIn" href="Supplier.php">Go Back to Supplier Entry</a></td>
                </tr>
            </table>
	</form>
</body>
</html>
<?php 
    include('Footer.php');
?>
