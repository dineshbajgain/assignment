<?php include 'header.php';?>
<?php // <--- do NOT put anything before this PHP tag
	include('functions.php');
	$cookieMessage = getCookieMessage();
?>


	<?php
		// display any cookie messages. TODO style this message so that it is noticeable.
		echo $cookieMessage;
		
		if(isset($_GET['search']))
		{
			$searchString = $_GET['search'];
		}
		// if the user did NOT provided a search string, assume an empty string
		else
		{
			$searchString = "";
		}
		$safeSearchString = htmlspecialchars($searchString, ENT_QUOTES,"UTF-8"); //Task 8B
		$SqlSearchString = "%$safeSearchString%"; //Task 8B
		
		echo "<form action='ProductList.php' method='GET' class='search-container'>"; 		
		echo "<input id='searchHome' name = 'search' type = 'text'  />";
		echo "<input class='btn' style='width: 161px;' value='Search' type = 'submit'/>"; 
		echo "</form>";
		
	?>
	
	<div class="slider-container">
  <div class="slider">
    <div class="slides">
      <div id="slides__1" class="slide">
		<img src="https://m.media-amazon.com/images/I/61DUO0NqyyL._SX3000_.jpg" alt="">
        <a class="slide__prev" href="#slides__4" title="Next"></a>
        <a class="slide__next" href="#slides__2" title="Next"></a>
      </div>
      <div id="slides__2" class="slide">
	  <img src="https://m.media-amazon.com/images/I/61TD5JLGhIL._SX3000_.jpg" alt="">
        <a class="slide__prev" href="#slides__1" title="Prev"></a>
        <a class="slide__next" href="#slides__3" title="Next"></a>
      </div>
      <div id="slides__3" class="slide">
	  <img src="https://m.media-amazon.com/images/I/71qid7QFWJL._SX3000_.jpg" alt="">

        <a class="slide__prev" href="#slides__2" title="Prev"></a>
        <a class="slide__next" href="#slides__4" title="Next"></a>
      </div>
      <div id="slides__4" class="slide">
	  <img src="https://m.media-amazon.com/images/I/61-8rBAD68L._SX3000_.jpg" alt="">
        <a class="slide__prev" href="#slides__3" title="Prev"></a>
        <a class="slide__next" href="#slides__1" title="Prev"></a>
      </div>
    </div>
    <div class="slider__nav">
      <a class="slider__navlink" href="#slides__1"></a>
      <a class="slider__navlink" href="#slides__2"></a>
      <a class="slider__navlink" href="#slides__3"></a>
      <a class="slider__navlink" href="#slides__4"></a>
    </div>
  </div>
</div>

	<?php
		// display any cookie messages. TODO style this message so that it is noticeable.
		echo $cookieMessage;
	?>
	
		<!-- 
		
			// TODO put a search box here and a submit button.
			
			// TODO the rest of this page is your choice, but you must not leave it blank.
			
			Possible ideas:
			•	List the 10 most recently purchased products.
			•	Use a CSS Animated Slider.
			•	Display any sales or promotions (using an image)

		-->

		<?php include 'footer.php';?>
