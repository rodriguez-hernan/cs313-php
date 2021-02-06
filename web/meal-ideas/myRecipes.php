<?php
  session_start();
	include("db-helpers.php");

	$user = $_SESSION["user"];
	$recipes = getAllRecipesByUserId($user["id"]);

	print_r($recipes);
?>

<!DOCTYPE html>
<html>

<head>
  <title>My Recipes</title>
  <?php include("../header.php"); ?>
	<link rel="stylesheet" href='/styles.css'>
</head>

<body>
  <div class="container">
		<header>
			<h1>My Recipes</h1>

			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/explore.php">Explore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">My Recipes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/index.php">Ideas</a>
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
			
			<? 
				foreach($recipes as $key => $res) {

					?>
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<h5 class="card-title"><? echo $res["title"]; ?></h5>
							<p class="card-text"><? echo $res["description"]; ?></p>
							<a href="#" class="btn btn-secondary btn-delete">Delete</a>
							<a href="#" class="btn btn-primary btn-modify">Modify</a>
						</div>
					</div>
					<?
				}
			
			?>
			
			
			</div>
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>