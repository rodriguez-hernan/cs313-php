<?php
  session_start();
	include("db-helpers.php");

	if(!isset($_SESSION["username"])) {
		header('Location: ./sign-in.php');
		die();
	}

/* 	$user = ["id" => 1, "username" => "Russell Nelson", "email" => "russell_n@byui.edu"];
  $_SESSION["user"] = $user; */

	print_r($_POST);

	$recipes = getAllRecipesByUserId($user["id"]);
	$meals = getAllMeals();
	$ingredients = getAllIngredients();
	$recipesArray = array();
	foreach($recipes as $key => $val) {
		array_push($recipesArray, $val["id"]);
	}

	$mealAsoc = getMealsAsocByRecipe($recipesArray);
	$ingredientAsoc = getIngredientsAsocByRecipe($recipesArray);
	
	$masterArray = array();

	$flagAll = true;
/* 	if (isset($_POST['ingredient_list'])) {
		$ing = $_POST['ingredient_list'];
		foreach($ing as $key => $val) {
			
		}
	} */

	$randomRecipeCss = "no-recipe";
	$formSubmitText = "Get idea";

/* 	print "<br/>mealAsoc <br/>";
	print_r($mealAsoc);
	print "ingredientAsoc <br/>";
	print_r($ingredientAsoc); */
?>

<!DOCTYPE html>
<html>

<head>
  <title>Meal Ideas</title>
  <?php include("../header.php"); ?>
	<link rel="stylesheet" href='./style.css'>
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

			<div class="main-container">
				<div class="row justify-content-md-center">
				<form method="POST">
					<div class="flex form-container">
						<div class="col col-md-4">
							<div class="filters">
								<div class="meal-checks">
										<h4>Meals</h4>
										<?
										foreach($meals as $key => $val) {
											$id = "meal-check-" . $key;
											?>
												<div class="form-check">
													<input class="form-check-input" name="meal_list[]" type="checkbox" id="<? echo $id ?>" value="<? echo $key ?>">
													<label class="form-check-label" for="<? echo $id ?>"><? echo $val ?></label>
												</div>
											<?
										}
									?>
								</div>
								<div class="ingredient-checks">
									<h4>Ingredients</h4>
									<?
										foreach($ingredients as $key => $val) {
											$id = "ingredient-check-" . $key;
											?>
												<div class="form-check">
													<input class="form-check-input" name="ingredient_list[]" type="checkbox" id="<? echo $id ?>" value="<? echo $key ?>">
													<label class="form-check-label" for="<? echo $id ?>"><? echo $val ?></label>
												</div>
											<?
										}
									?>
								</div>
							</div>
						</div>

						<div class="col col-md-4">
							<div class="search-btn">
								<button type="submit" class="btn btn-lg search-btn">
									<? echo $formSubmitText; ?>
								</button>
							</div>
						</div>
						<div class="col col-md-4">
							<div id="random-recipe" class='<? echo $randomRecipeCss; ?>'>
							
							</div>
						</div>
					</div>
				</form>


				</div>

			</div>
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>