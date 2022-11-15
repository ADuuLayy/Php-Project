<?php 
	include('connect.php');
    include('Header.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Category List</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<form action="CategoryList.php" method="POST">
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
                        <li class="breadcrumb-item"><a href="Category.php">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category List</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Category List</h1>
            </div>
        </div>
    </div>
            <table id="tableid" class="display">
                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php 
                    $select="Select * from Category";
                    $query=mysqli_query($connection,$select);
                    $count=mysqli_num_rows($query);
                    if($count>0)
                    {
                        for ($i=0; $i <$count ; $i++) 
                        { 
                           $data=mysqli_fetch_array($query);
                           $categoryid=$data['CategoryID'];
                           $categoryname=$data['CategoryName'];
                           echo "<tr>
                           <td>$categoryid</td>
                           <td>$categoryname</td>
                           <td>

                           <a href='CategoryUpdate.php?cid=$categoryid'>Update</a> |
                           <a href='CategoryDelete.php?cid=$categoryid'>Delete</a>

                           </td>
                           </td>";
                        }
                    }
                 ?>
                </tbody>
            </table>
        </table>
        <table border="1px" align="center">
                <tr>
                    <td><a class="btn btn-primary wow zoomIn" href="Category.php">Go Back to Category Entry</a></td>
                </tr>
        </table>
    </fieldset>
	</form>
</body>
</html>
<?php 
	include('Footer.php');
 ?>