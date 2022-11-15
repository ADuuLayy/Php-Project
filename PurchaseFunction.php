<?php 
	function Add($ProductID,$PurchasePrice,$PurchaseQuantity)
	{
		$connection=mysqli_connect("localhost","root","","pharmacy_db");
		$query="SELECT * FROM Product WHERE ProductID='$ProductID'";
		$ret=mysqli_query($connection,$query);
		$count=mysqli_num_rows($ret);

		if($count<1)
		{
			echo "<p>No Record Found.</p>";
			exit();
		}	

		$arr=mysqli_fetch_array($ret);
		$ProductName=$arr['ProductName'];
		$Image1=$arr['ProductImage'];
		if(isset($_SESSION['PurchaseFunction']))
		{
			$index=IndexOf($ProductID);

			if($index==-1)
			{
				$size=count($_SESSION['PurchaseFunction']);

				$_SESSION['PurchaseFunction'][$size]['ProductID']=$ProductID;
				$_SESSION['PurchaseFunction'][$size]['ProductName']=$ProductName;
				$_SESSION['PurchaseFunction'][$size]['Price']=$PurchasePrice;
				$_SESSION['PurchaseFunction'][$size]['Quantity']=$PurchaseQuantity;
				$_SESSION['PurchaseFunction'][$size]['Image1']=$Image1;
			}
			else
			{
				$_SESSION['PurchaseFunction'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
			}
		}
		else
		{
			$_SESSION['PurchaseFunction']=array();
			$_SESSION['PurchaseFunction'][0]['ProductID']=$ProductID;
			$_SESSION['PurchaseFunction'][0]['ProductName']=$ProductName;
			$_SESSION['PurchaseFunction'][0]['Price']=$PurchasePrice;
			$_SESSION['PurchaseFunction'][0]['Quantity']=$PurchaseQuantity;
			$_SESSION['PurchaseFunction'][0]['Image1']=$Image1;
		}
		echo "<script>window.location='Purchase.php'</script>";
	}

function IndexOf($ProductID)
{
	if(!isset($_SESSION['PurchaseFunction']))
	{
		return -1;
	}
	$size=count($_SESSION['PurchaseFunction']);
	if($size==0)
	{
		return -1;
	}
	for($i=0; $i<$size; $i++) 
	{ 
		if($ProductID == $_SESSION['PurchaseFunction'][$i]['ProductID']) 
		{
			return $i;
		}	
	}
	return -1;
}

function Remove($ProductID)
{
	$index=IndexOf($ProductID);

	if($index!=-1)
	{
		unset($_SESSION['PurchaseFunction'][$index]);
		echo "<script>window.location='Purchase.php'</script>";
	}
}

function CalculateTotalAmount()
{
	$totalamount=0;
	$size=count($_SESSION['PurchaseFunction']);
	for($i=0; $i<$size; $i++) 
	{ 
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['Price'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['Quantity'];
		$totalamount=$totalamount + ($PurchasePrice * $PurchaseQuantity);
	}
	return $totalamount;
}

function CalculateTax()
{
	$tax=0;
	$totalamount=CalculateTotalAmount();
	$tax=$totalamount * 0.05;

	return $tax;
}

function CalculateTotalQuantity()
{
	$Qty=0;

	$size=count($_SESSION['PurchaseFunction']);

	for ($i=0; $i < $size ; $i++)
	{ 
		$quantity=$_SESSION['PurchaseFunction'][$i]['Quantity'];
		$Qty=$Qty + ($quantity);		
	}
	return $Qty;
}

 ?>