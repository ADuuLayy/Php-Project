<?php  
function AddProduct($ProductID,$BuyQuantity)
{
	include('connect.php');

	$Query="SELECT * FROM product WHERE ProductID='$ProductID' ";
	$result=mysqli_query($connection,$Query);
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	if($count < 1) 
	{
		echo "<p>No Product Found.</p>";
		exit();
	}

	if ($BuyQuantity < 1) 
	{
		echo "<p>Incorrect Quantity.</p>";
		exit();

	}

	if(isset($_SESSION['ShoppingCartFunction'])) 
	{	
		$index=IndexOf($ProductID);

		if($index == -1) 
		{
			$count=count($_SESSION['ShoppingCartFunction']);

			$_SESSION['ShoppingCartFunction'][$count]['ProductID']=$ProductID;
			$_SESSION['ShoppingCartFunction'][$count]['BuyQuantity']=$BuyQuantity;

			$_SESSION['ShoppingCartFunction'][$count]['ProductName']=$arr['ProductName'];
			$_SESSION['ShoppingCartFunction'][$count]['Price']=$arr['Price'];
			$_SESSION['ShoppingCartFunction'][$count]['ProductImage']=$arr['ProductImage'];
		}
		else
		{
			$_SESSION['ShoppingCartFunction'][$index]['BuyQuantity']+=$BuyQuantity;
		}
	}
	else // for array zero position
	{
		$_SESSION['ShoppingCartFunction']=array();

		$_SESSION['ShoppingCartFunction'][0]['ProductID']=$ProductID;
		$_SESSION['ShoppingCartFunction'][0]['BuyQuantity']=$BuyQuantity;

		$_SESSION['ShoppingCartFunction'][0]['ProductName']=$arr['ProductName'];
		$_SESSION['ShoppingCartFunction'][0]['Price']=$arr['Price'];
		$_SESSION['ShoppingCartFunction'][0]['ProductImage']=$arr['ProductImage'];
	}

	echo "<script>window.location='ShoppingCart.php'</script>";

}

function IndexOf($ProductID)
{
	if (!isset($_SESSION['ShoppingCartFunction'])) 
	{
		return -1;
	}

	$count=count($_SESSION['ShoppingCartFunction']);

	if($count < 1)
	{
		return -1;
	}
	else
	{
		for ($i=0; $i < $count; $i++) 
		{ 
			if ($ProductID == $_SESSION['ShoppingCartFunction'][$i]['ProductID']) 
			{
				return $i;
			}	
		}
		return -1;
	}
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$count=count($_SESSION['ShoppingCartFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$Price=$_SESSION['ShoppingCartFunction'][$i]['Price'];
		$BuyQuantity=$_SESSION['ShoppingCartFunction'][$i]['BuyQuantity'];

		$TotalAmount += ($Price * $BuyQuantity);
	}
	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$count=count($_SESSION['ShoppingCartFunction']);

	for($i=0;$i<$count;$i++) 
	{ 
		$BuyQuantity=$_SESSION['ShoppingCartFunction'][$i]['BuyQuantity'];

		$TotalQuantity += ($BuyQuantity);
	}
	return $TotalQuantity;
}

function RemoveProduct($ProductID)
{
	$index=IndexOf($ProductID);

	unset($_SESSION['ShoppingCartFunction'][$index]);
	$_SESSION['ShoppingCartFunction']=array_values($_SESSION['ShoppingCartFunction']);

	echo "<script>window.location='ShoppingCart.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['ShoppingCartFunction']);
	echo "<script>window.location='ShoppingCart.php'</script>";

}


?>