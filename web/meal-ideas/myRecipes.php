<?php
  session_start();
	include("db-helpers.php");

	print_r($_POST);

	if (isset($_POST) && isset($_POST["delete"])) {
		$id = $_POST["id"];
		deleteRecipe($id);
	}

	$user = $_SESSION["user"];
	$recipes = getAllRecipesByUserId($user["id"]);

	// print_r($recipes);
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
					<div class="card" id="card-<? echo $res["id"]; ?>" style="width: 18rem;">
						<div class="card-body">
							<h5 class="card-title"><? echo $res["title"]; ?></h5>
							<p class="card-text"><? echo $res["description"]; ?></p>

							<button
								type="button"
								class="btn btn-secondary btn-delete"
								data-id="<? echo $res["id"]; ?>"
								onclick="openDeleteModal('<? echo $res['id']; ?>');"
							>
								Delete
							</button>
							<button
								type="button"
								class="btn btn-primary btn-update"
								data-id="<? echo $res["id"]; ?>"
								onclick="openUpdateModal('<? echo $res['id']; ?>');"
							>
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
							<input type="hidden" name="id" id="delete-recipe-id">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="delete-recipe">Delete</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modify Modal -->
			<div class="modal fade" id="modify-modal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="delete-modal-title"><span id="header-update-res-title"></span></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3 col-6">
								<label for="recipe-title" class="form-label">Recipe Title</label>
								<input type="text" class="form-control" id="update-res-title" aria-describedby="recipeTitle" name="title">
							</div>
							<div class="mb-3 col-6">
								<label for="recipe-process" class="form-label">Recipe steps or comments</label>
								<textarea class="form-control" name="description" rows="4" cols="50" id="recipe-process"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="rec-id-update" value="">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="update-recipe">Update</button>
						</div>
					</div>
				</div>
			</div>
		</main>

  </div>
  <?php include("../footer.php"); ?>
	<script>

	function openUpdateModal(id) {
		console.log("update => ", id);

		$("#rec-id-update").val(id);

		const card = $(`#card-${id}`);

		const title = card.find( ".card-title" ).text();
		const description = card.find( ".card-text" ).text();
		
		console.log("title", title)
		console.log("description", description)
		
		$("#recipe-process").val(description);
		$("#update-res-title").val(title);
		$("#header-update-res-title").html(title);

		$("#modify-modal").modal('show');
	}

	function openDeleteModal(id) {
		console.log("delete => ", id);

		$("#delete-res-id").html(id);
		$("#delete-recipe-id").val(id);
		$("#delete-modal").modal('show');
	}

	$("#update-recipe").click(function() {

		const description = $("#recipe-process").val();
		const title = $("#update-res-title").val();
		const id = $("#rec-id-update").val();
		const action = "update";
		const data = {
			id, title, description, action,
		}
		// console.table("UPDATE", data );

		const cardId = `#card-${id}`;
		$.ajax({
			type: "POST",
			url: "update-recipe.php",
			data: data,
			success: function(result) {
				$(cardId).empty().append(result);
				$("#modify-modal").modal('hide');
			},
		});

	});

	$("#delete-recipe").click(function() {
		const id = $("#delete-recipe-id").val();
		const action = "delete";
		const data = {id, action};

		const cardId = `#card-${id}`;
		$.ajax({
			type: "POST",
			data: data,
			success: function(result) {
				$(cardId).remove();
				$("#delete-modal").modal('hide');
			},
		});

	})

	</script>
</body>

</html>