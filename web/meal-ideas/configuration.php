<?php
  session_start();
  include("db-helpers.php");


  $meals = getAllMeals();
	$ingredients = getAllIngredients();

  print_r($meals);
	print "<br />";
	print_r($ingredients);
?>

<!DOCTYPE html>
<html>

<head>
  <title>My Recipes</title>
  <?php include("../header.php"); ?>
</head>

<body>
  <div class="container">
		<header>
			<h1>Configuration</h1>

			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/explore.php">Explore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/myRecipe.php">My Recipes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/index.php">Ideas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/newRecipe.php">New Recipe</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Configuration</a>
				</li>
			</ul>
		</header>
		<main>

      Configuration
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>