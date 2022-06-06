<?php include 'header.php';?>
	<?php 
		
		// include some functions from another file.
		include('functions.php');
		
		if(isset($_GET['ProductID']))
		{		
			$productIDURL = $_GET['ProductID'];	 // Task 10
			
			// connect to the database using our function (and enable errors, etc)
			$dbh = connectToDatabase(); 
			
			//  bind the value here
			$statement = $dbh->prepare('SELECT * FROM Products INNER JOIN Brands
			ON Brands.BrandID = Products.BrandID
			WHERE Products.ProductID = ? '); //Task 10  LIMIT 10 ; //OFFSET ? * 10 
			
			$statement->bindValue(1,$productIDURL);  // Task 10
			
			//execute the SQL.
			$statement->execute();

			// get the result, there will only ever be one product with a given ID (because products ids must be unique)
			// so we can just use an if() rather than a while()
			if($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				// Task 10
				// display the details here. 
				
				//$ProductID = htmlspecialchars($row['ProductID'], ENT_QUOTES, 'UTF-8'); 
				$Price = htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8'); 
				$Description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8'); 
				$BrandName = htmlspecialchars($row['BrandName'], ENT_QUOTES, 'UTF-8'); 
				$BrandID = htmlspecialchars($row['BrandID'], ENT_QUOTES, 'UTF-8'); 
				$Website = htmlspecialchars($row['Website'], ENT_QUOTES, 'UTF-8');
// output the data in a div with a class of 'productBox' we can apply css to this class.
				echo "<div class = 'productBox flex'> <div class='product w-50'>";	
				echo "<img class='productImg' src = '../IFU_Assets/ProductPictures/$productIDURL.jpg' alt= 'productID' /> <br/>";
				echo "</div>";
				echo "<div cl	ss='product-details'>";
				echo "<p class='description'>$Description</p> <br/>";
				echo "<p class='price'>$Price </p> <br/>";
				echo "<div class='flex'><img class='brand-image' src = '../IFU_Assets/BrandPictures/$BrandID.jpg' alt='BrandID' /><br/>";
				echo "<p class='brand-name'>$BrandName </p> </div> <br/>";
				echo "<a href='$Website' target = '_blank'> $Website </a>";
				//echo "<br>";
				echo "<form action = 'AddToCart.php?ProductID=$productIDURL' method = 'POST'>";
				//echo "<input name = 'page' type = 'text' value = '$currentPage' />";
				echo "<button type='submit' name='BuyButton' value='BuyButton' class='btn' >Add To Cart</button>";
				echo "</form>";
				echo "</div> \n";
				echo "</div> \n";	

			}
			else
			{
				echo "Unknown Product ID";
			}
		}
		else
		{
			echo "No ProductID provided!";
		}
	?>
<?php include 'footer.php';?>