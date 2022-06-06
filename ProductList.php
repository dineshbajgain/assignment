<?php include 'header.php';?>
	<?php 		
		// include some functions from another file.
		include('functions.php');
		
		//Task 7A
		// if the user provided a search string.
		if(isset($_GET['search']))
		{
			$searchString = $_GET['search'];
		}
		// if the user did NOT provided a search string, assume an empty string
		else
		{
			$searchString = "";
		}
		
		if(isset($_GET['sortProduct']))
		{
			$sortProductBy = $_GET['sortProduct'];
		}

		else
		{
			$sortProductBy = "pop";
		}
				
		//$SqlSearchString = "%$searchString%"; //Task 7A
		$safeSearchString = htmlspecialchars($searchString, ENT_QUOTES,"UTF-8"); //Task 8B
		$SqlSearchString = "%$safeSearchString%"; //Task 8B

		echo "<div class='filter'>";
		echo "<form class='search-container'>"; //Task 7
		// echo "<input name = 'search' type = 'text' />"; //Task 7
		// echo "<input name = 'search' type = 'text' value = '$searchString' />"; //Task 8
		echo "<input id='search' name = 'search' type = 'text' value = '$safeSearchString' />"; //Task 8B
			$xyz = " <select name='sortProduct' id='sortProduct'>
			
			  <option value='pop'>Popularity</option>
			  <option value='aToz' >Name: A to Z</option>
			  <option value='zToa'>Name: Z to A </option>
			  <option value='lToh'>Low to High</option>
			  <option value='hTol'>High to Low</option>
			  </select>";
		echo $xyz;
echo "<input class='btn' type = 'submit'/>"; //Task 7
		echo "</form>"; //Task 7
		
		//Task 9
		if(isset($_GET['page']))
		{
			$currentPage = intval($_GET['page']);
		}
		else
		{
			$currentPage = 0;
		}
				
		//echo "<form class='search-container'>";

		//echo "<input id='search' name = 'page' type = 'text' value = '$currentPage' />";
		//echo "<input class='btn' type = 'submit'/>";
		//echo "</form>";
		echo "</div>";
		$nextPage =  $currentPage + 1; //Task 9A
		//echo "<a href = 'ProductList.php?page=$nextPage&search=$safeSearchString'>Next Page</a>"; //Task 9A
		echo "<div class='next-page'><a class='btn' href = 'ProductList.php?page=$nextPage&search=$safeSearchString'>Next Page</a></div>"; //Task 9B
		echo "<br/>";
		//Task 9C
		$previousPage =  $currentPage - 1;
		if ($previousPage >= 0)
		{
			echo "<a href = 'ProductList.php?page=$previousPage&search=$safeSearchString'> Previous Page</a> <br/>";
		}
		// connect to the database using our function (and enable errors, etc)
		$dbh = connectToDatabase();
		
		// select all the products.
		//$statement = $dbh->prepare('SELECT * FROM Products;');
				
		//bind the value here
		// $statement = $dbh->prepare('SELECT * FROM Products  
		// 	WHERE Products.Description LIKE ?
		// 	;');  //Task 7A		
		
		// $statement = $dbh->prepare('SELECT * FROM Products  
			// WHERE Products.Description LIKE ? 
			// LIMIT 10 OFFSET ? * 10;');  //Task 9
		if($sortProductBy == 'aToz')
			{
				$statement = $dbh->prepare('SELECT * FROM Products LEFT JOIN OrderProducts 
					ON OrderProducts.ProductID = Products.ProductID
					WHERE Products.Description LIKE ?
					GROUP BY Products.ProductID 
					ORDER BY (Products.Description) ASC
					LIMIT 10 
					OFFSET ? * 10

			;');  	
				
			}else if($sortProductBy == 'zToa')
			{
					$statement = $dbh->prepare('SELECT * FROM Products LEFT JOIN OrderProducts 
							ON OrderProducts.ProductID = Products.ProductID
							WHERE Products.Description LIKE ?
							GROUP BY Products.ProductID 
							ORDER BY (Products.Description) DESC
							LIMIT 10 
							OFFSET ? * 10

			;');  
				
			}else if($sortProductBy == 'lToh')
			{
					$statement = $dbh->prepare('SELECT * FROM Products LEFT JOIN OrderProducts 
				ON OrderProducts.ProductID = Products.ProductID
				WHERE Products.Description LIKE ?
				GROUP BY Products.ProductID 
				ORDER BY (Products.Price) ASC
				LIMIT 10 
				OFFSET ? * 10

				;');  
			}else if($sortProductBy == 'hTol')
			{
				
				$statement = $dbh->prepare('SELECT * FROM Products LEFT JOIN OrderProducts 
				ON OrderProducts.ProductID = Products.ProductID
				WHERE Products.Description LIKE ?
				GROUP BY Products.ProductID 
				ORDER BY (Products.Price) DESC
				LIMIT 10 
				OFFSET ? * 10

				;');  
			}else
			{
				$statement = $dbh->prepare('SELECT * FROM Products LEFT JOIN OrderProducts 
			ON OrderProducts.ProductID = Products.ProductID
			WHERE Products.Description LIKE ? 
			GROUP BY Products.ProductID 
			ORDER BY COUNT(OrderProducts.OrderID) DESC
			LIMIT 10 
			OFFSET ? * 10
			;');  //Task 11		

				
			}		
		
		$statement->bindValue(1,$SqlSearchString); //Task 7A
		
		$statement->bindValue(2,$currentPage); //Task 9
			
		
		//execute the SQL.
		$statement->execute();

		// get the results
		echo '<div class="product-list">';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			// Remember that the data in the database could be untrusted data. 
			// so we need to escape the data to make sure its free of evil XSS code.
			$ProductID = htmlspecialchars($row['ProductID'], ENT_QUOTES, 'UTF-8'); 
			$Price = htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8'); 
			$Description = htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8'); 
			
			// output the data in a div with a class of 'productBox' we can apply css to this class.
			echo "<div class = 'card'>";
			// [Put Task 5A here]  
			//echo "<img src = '../IFU_Assets/ProductPictures/$ProductID.jpg' alt ='' / >"; //Task 5A
			//Task 10A
			echo "<a href='../Lab07/ViewProduct.php?ProductID=$ProductID'><img src='../IFU_Assets/ProductPictures/$ProductID.jpg' alt ='' /></a>  ";
			echo "$Description <br/>";
			echo "<p class='price'>$Price </p>";
			echo "</div> \n";			
		}
		echo '</div>'

	?>
<?php include 'footer.php';?>