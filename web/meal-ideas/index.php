<?php
  session_start();
	include("db-helpers.php");
	$user = ["id" => 1, "username" => "Russell Nelson", "email" => "russell_n@byui.edu"];
  $_SESSION["user"] = $user;


	$recipes = getAllRecipesByUserId($user["id"]);
	$meals = getAllMeals();
	$ingredients = getAllIngredients();
	$recipesArray = array();
	foreach($recipes as $key => $val) {
		echo "<br />";
		print_r($val);
		array_push($recipesArray, $val["id"]);
	}

	$mealAsoc = getMealsAsocByRecipe($recipesArray);
	$ingredientAsoc = getIngredientsAsocByRecipe($recipesArray);

	print "<br/>mealAsoc <br/>";
	print_r($mealAsoc);
	print "ingredientAsoc <br/>";
	print_r($ingredientAsoc);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Meal Ideas</title>
  <?php include("../header.php"); ?>
	<link rel="stylesheet" href='/styles.css'>
</head>

<body>
  <div class="container">
		<header>
			<h1 class="header-title">Meal ideas!</h1>

			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/explore.php">Explore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/myRecipes.php">My Recipes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Ideas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/newRecipe.php">New Recipe</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/configuration.php">Configuration</a>
				</li>
			</ul>
		</header>
		<main>

			Meal Ideas
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>