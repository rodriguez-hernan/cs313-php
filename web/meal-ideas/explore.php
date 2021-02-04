<?php
  session_start();
    

?>

<!DOCTYPE html>
<html>

<head>
  <title>Explore</title>
  <?php include("../header.php"); ?>
</head>

<body>
  <div>
		<header>
			<h1>Explore</h1>

			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Explore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/myRecipes.php">My Recipes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/index.php">Ideas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/newRecipes.php">New Recipe</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/configuration.php">Configuration</a>
				</li>
			</ul>
		</header>
		<main>

			Explore
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>