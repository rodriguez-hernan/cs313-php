<?php
  session_start();
    

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
			<h1>New Recipe</h1>

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
					<a class="nav-link active" aria-current="page" href="#">New Recipe</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/meal-ideas/configuration.php">Configuration</a>
				</li>
			</ul>
		</header>
		<main>

      Comming Soon...
		</main>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>