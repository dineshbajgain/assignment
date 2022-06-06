<?php include 'header.php';?>
<?php 
	include('functions.php');
	
?>

<?php 

	$dbh = connectToDatabase();
	
	$statement = $dbh->prepare('SELECT * FROM Customers
				JOIN Orders
				ON Customers.CustomerID = Orders.CustomerID');
	$statement->execute();

	echo "<table border='1' id='order'>

		<tr>
			<th>OrderID</th>
			<th>DateTime</th>
			<th>Customer Name</th>
			<th>Address</th>
			<th>City</th>
		</tr>";

 

		while($row = $statement->fetch(PDO::FETCH_ASSOC))

		  {
			  
			$OrderID = htmlspecialchars($row['OrderID'], ENT_QUOTES, 'UTF-8'); 
			$TimeStamp = htmlspecialchars($row['TimeStamp'], ENT_QUOTES, 'UTF-8'); 
			$DateTime = date('m/d/Y H:i:s', $TimeStamp);
			//$Username = htmlspecialchars($row['UserName'], ENT_QUOTES, 'UTF-8'); 
			$Firstname = htmlspecialchars($row['FirstName'], ENT_QUOTES, 'UTF-8'); 
			$Lastname = htmlspecialchars($row['LastName'], ENT_QUOTES, 'UTF-8'); 
			$Address = htmlspecialchars($row['Address'], ENT_QUOTES, 'UTF-8'); 
			$City = htmlspecialchars($row['City'], ENT_QUOTES, 'UTF-8');

		  echo "<tr>";

		  echo "<td><a href='../Lab07/ViewOrderDetails.php?OrderID=$OrderID'> $OrderID</a> </td>";
		  echo "<td>" . $DateTime . "</td>";
		  echo "<td>" . $Firstname . " " . $Lastname . "</td>";
		  echo "<td>" . $Address . "</td>";
		  echo "<td>" . $City . "</td>";
		  echo "</tr>";

		  }

		echo "</table>";

?>
<?php include 'footer.php';?>