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
	<link rel="stylesheet" href='./style.css'>
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

      <div class="main-container card-grid">
			
			<? 
				foreach($recipes as $key => $res) {

					?>
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<h5 class="card-title"><? echo $res["title"]; ?></h5>
							<p class="card-text"><? echo $res["description"]; ?></p>

							<button type="button" class="btn btn-secondary btn-delete" data-id="<? echo $res["id"]; ?>">
								Delete
							</button>
							<button type="button" class="btn btn-primary btn-update" data-id="<? echo $res["id"]; ?>">
								Modify
							</button>
						</div>
					</div>
					<?
				}
			
			?>
			
			
			</div>
			<!-- Delete Modal -->
			<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="delete-modal-title">Delete</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Are you sure you want to delete this recipe?
							<span id="delete-res-id"></span>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</main>

  </div>
  <?php include("../footer.php"); ?>
	<script>
		$(".btn-delete").click(function() {
			const id = $(this).data("id");
			console.log("delete => ", id);

			$("#delete-res-id").html(id);
			$("#delete-modal").modal('show');
		})
		$(".btn-update").click(function() {
			const id = $(this).data("id");
			console.log("update => ", id);

		})

	</script>
</body>

</html>