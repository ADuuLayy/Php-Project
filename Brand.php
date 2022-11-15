<?php 
    include('connect.php');
    include('Header.php');
    if(isset($_POST['btnsubmit']))
    {
        $brandname=$_POST['txtbrandname'];

        $select="SELECT * FROM Brand where BrandName='$brandname'";
        $query=mysqli_query($connection,$select);
        $count=mysqli_num_rows($query);
        if($count>0)
        {
            echo"<script> alert('Brand Name Already Exist!') </script>"; 
        }

        else
        {

            $insert="INSERT INTO Brand(BrandName) values('$brandname')" ;
            $query=mysqli_query($connection,$insert);
            if($query) 
            {
                echo "<script>alert('Successfully Saved Brand Name')</script>";
            }

        }
    }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Brand Entry</title>
</head>
<body>
    <form action="Brand.php" method="POST">
        <div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Brand</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Brand Entry</h1>

            <form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Brand Name</label>
                            <input type="text" name="txtbrandname" class="form-control" placeholder="Full name.." required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnsubmit"class="btn btn-primary wow zoomIn">Save</button>
                    <a class="btn btn-primary wow zoomIn" href="BrandList.php" >Click Here To See Brand List</a>
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