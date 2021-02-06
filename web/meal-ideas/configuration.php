<?php
  session_start();
  include("db-helpers.php");


  $meals = getAllMeals();
	$ingredients = getAllIngredients();
?>

<!DOCTYPE html>
<html>

<head>
  <title>My Recipes</title>
  <?php include("../header.php"); ?>
	<link rel="stylesheet" href='./style.css'>
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
					<a class="nav-link" href="/meal-ideas/myRecipes.php">My Recipes</a>
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

			<div class="config-container">
				<div>
					<h3 class="sub-header">Available Ingredients</h3>
					<ul class="list-group list-group-flush ingredient-list">
						<?php
							foreach($ingredients as $key => $val) {
								?>
									<li class="list-group-item ingredient">
										<? echo $val ?>
									</li>
								<?php
							}
						?>
					</ul>
				</div>
				<div>
					<h3 class="sub-header">Available Meals</h3>
					<ul class="list-group list-group-flush ingredient-list">
						<?php
							foreach($meals as $key => $val) {
								?>
									<li class="list-group-item ingredient">
										<? echo $val ?>
									</li>
								<?php
							}
						?>
					</ul>
				</div>
			</div>
		</main>

  </div>
  <?php include("../footer.php"); ?>
	<script src='/main.js'></script>
</body>

</html>