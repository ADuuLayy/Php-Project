<?php 
	session_start();
    include ('connect.php');
	include('Header.php');
    if(isset($_POST['btnsubmit']))
    {
    	$employeename=$_POST['txtemployeename'];
		$cboRoleID=$_POST['cboRoleID'];
    	$employeeemail=$_POST['txtemployeeemail'];
		$phonenumber=$_POST['txtphoneno'];
		$dob=$_POST['txtdob']; 
    	$password=$_POST['txtpassword'];
        
        $select="SELECT * FROM employee where EmployeeName='$employeename' ";
        $query=mysqli_query($connection,$select);
        $count=mysqli_num_rows($query);
        if($count>0)
        {
            echo"<script> alert('Employee Name Already Exist!') </script>"; 
        }

        else
        {

        $insert= "INSERT INTO employee(EmployeeName,RoleID,EmployeeEmail,PhoneNumber,DateOfBirth,Password)
        VALUES('$employeename','$cboRoleID','$employeeemail','$phonenumber','$dob','$password') ";

        $query=mysqli_query($connection,$insert);	 
        if($query)
        {
        	echo "<script>alert('Successfully Registered Employee')</script>";
        }
        }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Point Of Sale System</title>
</head>
<body>
	<form action="Employee.php" method="POST">
	<div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="EmployeeDashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employee</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Employee</h1>
            </div>
        </div>
        </div>
        <div class="page-section">
            <div class="container">
            <h1 class="text-center wow fadeInUp">Employee Register</h1>
			<form class="contact-form mt-5">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Employee Name</label>
                            <input type="text" name="txtemployeename" class="form-control" placeholder="Full name.." required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Role :</label>
                        <select name="cboRoleID">
						<option>--Choose Role--</option>
						<?php  
							$RoleData="SELECT * FROM Role";
							$result=mysqli_query($connection,$RoleData);
							$count=mysqli_num_rows($result);

							for($i=0;$i<$count;$i++) 
								{	 
									$row=mysqli_fetch_array($result);
									$RoleID=$row['RoleID'];
									$Role=$row['Role'];

								echo "<option value='$RoleID'>$RoleID - $Role</option>";
								}
						?>
						</select>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Employee Email</label>
                            <input type="email" name="txtemployeeemail" class="form-control" placeholder="Enter Employee Email" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Phone Number</label>
                            <input type="text" name="txtphoneno" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Password</label>
                            <input type="password" name="txtpassword" class="form-control" placeholder="Enter Employee Password" required>
                    </div>
					<div class="col-sm-6 py-2 wow fadeInLeft">
                        <label for="fullName">Date Of Birth</label>
                            <input type="date" name="txtdob" class="form-control" required>
                    </div>
                </div>
                <div>
                    <button type="submit" name="btnsubmit"class="btn btn-primary wow zoomIn">Register</button>
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