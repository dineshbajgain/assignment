<?php include 'header.php';?>
<?php 
	include('functions.php');
	
?>

<?php 

	$dbh = connectToDatabase();
	
	$statement = $dbh->prepare('SELECT *,SUM(OrderProducts.Quantity) as TotalQuantity,SUM(OrderProducts.Quantity)* Products.Price as TotalRevenue FROM Products
					LEFT JOIN Brands
					ON Products.BrandID = Brands.BrandID
					LEFT JOIN OrderProducts
					ON OrderProducts.ProductID = Products.ProductID
					GROUP BY Products.ProductID
					ORDER BY TotalRevenue DESC');
	$statement->execute();

	echo "<table border='1'>

		<tr>
			<th>ProductID</th>
			<th>Description</th>
			<th>Price</th>
			<th>Brand Name</th>
			<th>Total Quantity</th>
			<th>Total Revenue</th>
		</tr>";

 

		while($row = $statement->fetch(PDO::FETCH_ASSOC))

		  {
			  
			$ProductID = htmlspecialchars($row['ProductID'], ENT_QUOTES, 'UTF-8'); 
			$Description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8'); 
			$Price = htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8'); 
			$Brand = htmlspecialchars($row['BrandName'], ENT_QUOTES, 'UTF-8'); 
			$TotalQuantity = htmlspecialchars($row['TotalQuantity'], ENT_QUOTES, 'UTF-8'); 
			$TotalRevenue = htmlspecialchars($row['TotalRevenue'], ENT_QUOTES, 'UTF-8');

		  echo "<tr>";

		  echo "<td><a href='../Lab07/ViewProduct.php?ProductID=$ProductID'> $ProductID</a> </td>";
		  echo "<td>" . $Description . "</td>";
		  echo "<td>" . $Price . "</td>";
		  echo "<td>" . $Brand . "</td>";
		  echo "<td>" . $TotalQuantity . "</td>";
		  echo "<td>" . $TotalRevenue . "</td>";
		  echo "</tr>";

		  }

		echo "</table>";

?>
<?php include 'footer.php';?>