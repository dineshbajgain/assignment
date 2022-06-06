<?php include 'header.php';?>
<?php

// did the user provided an OrderID via the URL?
if(isset($_GET['OrderID']))
{
	$UnsafeOrderID = $_GET['OrderID'];
	
	include('functions.php');
	$dbh = connectToDatabase();
	
	// select the order details and customer details. (you need to use an INNER JOIN)
	// but only show the row WHERE the OrderID is equal to $UnsafeOrderID.
	$statement = $dbh->prepare('
		SELECT * 
		FROM Orders 
		INNER JOIN Customers ON Customers.CustomerID = Orders.CustomerID 
		WHERE OrderID = ? ; 
	');
	$statement->bindValue(1,$UnsafeOrderID);
	$statement->execute();
	
	// did we get any results?
	if($row1 = $statement->fetch(PDO::FETCH_ASSOC))
	{
		// Output the Order Details.
		$FirstName = makeOutputSafe($row1['FirstName']); 
		$LastName = makeOutputSafe($row1['LastName']); 
		$OrderID = makeOutputSafe($row1['OrderID']); 
		$UserName = makeOutputSafe($row1['UserName']);
		$Address = makeOutputSafe($row1['Address']);
		$City = makeOutputSafe($row1['City']);		
		$DateTime = date('m/d/Y H:i:s',makeOutputSafe($row1['TimeStamp']));
		
		// display the OrderID
		echo "<h2>OrderID: $OrderID</h2>";
		echo "<h2>DateTime: $DateTime</h2>";
		
		// its up to you how the data is displayed on the page. I have used a table as an example.
		// the first two are done for you.
		echo "<table>";
		echo "<tr><th>UserName:</th><td>$UserName</td></tr>";
		echo "<tr><th>Customer Name:</th><td>$FirstName $LastName </td></tr>";
		echo "<tr><th>Address:</th><td>$Address </td></tr>";
		echo "<tr><th>City:</th><td>$City </td></tr>";
		
		//TODO show the Customers Address and City.
		//TODO show the date and time of the order.
		
		echo "</table>";
		
		// TODO: select all the products that are in this order (you need to use INNER JOIN)
		// this will involve three tables: OrderProducts, Products and Brands.
		$statement2 = $dbh->prepare('
			
			SELECT * FROM  OrderProducts
			INNER JOIN Products
			ON OrderProducts.ProductID = Products.ProductID
			INNER JOIN Brands
			ON  Brands.BrandID = Products.BrandID
			WHERE OrderID = ? ; 
		');
		$statement2->bindValue(1,$UnsafeOrderID);
		$statement2->execute();
		
		$totalPrice = 0;
		echo "<h2>Order Details:</h2>";
		
		// loop over the products in this order. 
		while($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
		{
			//NOTE: pay close attention to the variable names.
			$ProductID = makeOutputSafe($row2['ProductID']); 
			$Description = makeOutputSafe($row2['Description']); 
			$BrandID = makeOutputSafe($row2['BrandID']);
			$BrandName = makeOutputSafe($row2['BrandName']); 
			$Price = makeOutputSafe($row2['Price']);
			$Quantity = makeOutputSafe($row2['Quantity']);			
			
			// TODO show the Products Description, Brand, Price, Picture of the Product and a picture of the Brand.
			
				echo "<div class = 'productBox'>";	
				echo "$Description <br/>";
				echo "$BrandName <br/>";
				echo "$Price <br/>";
				
				// TODO The product Picture must also be a link to ViewProduct.php.
				echo "<a href='../Lab07/ViewProduct.php?ProductID=$ProductID'><img src='../IFU_Assets/ProductPictures/$ProductID.jpg' alt ='' /></a>  ";
				//echo "<br>";
				echo "<img src = '../IFU_Assets/BrandPictures/$BrandID.jpg' alt='BrandID' id='brandImage'/>";
				echo "</div> \n";	
			
			
			
			

			// TODO add the price to the $totalPrice variable.
			$totalPrice = $totalPrice + $Quantity* $Price;
		}		
		
		//TODO display the $totalPrice .
		echo "Total Amount : $totalPrice";
	}
	else 
	{
		echo "System Error: OrderID not found";
	}
}
else
{
	echo "System Error: OrderID was not provided";
}
?>
<?php include 'footer.php';?>