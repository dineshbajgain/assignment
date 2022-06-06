<?php include 'header.php';?>
<?php // <--- do NOT put anything before this PHP tag
	include('functions.php');
	$cookieMessage = getCookieMessage();
?>
	<div class="text-center"> <h3>Sign Up Form</h3></div>
	<?php
		// display any error messages. TODO style this message so that it is noticeable.
		echo $cookieMessage;
	?>
<form action = 'AddNewCustomer.php' method = 'POST' class='SignUp'>
		<!-- 
			TODO make a sign up <form>, don't forget to use <label> tags, <fieldset> tags and placeholder text. 
			all inputs are required.
			
			
			
			
			Make sure you <input> tag names match the names in AddNewCustomer.php
			
			your form tag should use the POST method. don't forget to specify the action attribute.
		-->
		<fieldset>
		  <div>
            <label for="UserName">Username:</label>
            <input type="text" name="UserName" id="UserName" placeholder="myselfsamip" required>
        </div>
        <div>
            <label for="FirstName">FirstName:</label>
            <input type="text" name="FirstName" id="FirstName"  placeholder="Samip" required>
        </div>
        <div>
            <label for="LastName">LastName:</label>
            <input type="text" name="LastName" id="LastName" placeholder="Shrestha" required>
        </div>
        <div>
          <label for="Address">Address:</label>
            <input type="text" name="Address" id="Address" placeholder="3 Stanleynley Streeet Glenroy" required>
        </div>
         <div>
          <label for="City">City:</label>
            <input type="text" name="City" id="City" placeholder="Melbourne" required>
        </div>
        <button class='btn' style='margin: 0 auto;
    display: block;' type="submit">Register</button>
        
		</fieldset>
		

	</form>
<?php include 'footer.php';?>
	