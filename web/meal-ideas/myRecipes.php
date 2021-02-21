<?php
  session_start();
	include("db-helpers.php");

	print_r($_POST);

	if (isset($_POST) && $_POST["action"] == "delete") {
		$id = $_POST["id"];
		deleteRecipe($id);
	}

	$userId = $_SESSION["userId"];
	$recipes = getAllRecipesByUserId($userId);

	$recipesArray = getRecipeIngredientMeals($recipes, $userId);
	$meals = getAllMeals();
	$ingredients = getAllIngredients();

	print_r($recipesArray);

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
							<div class="mt-3 filters">
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
	var recipesJson = '<? echo json_encode($recipesArray); ?>';

	function openUpdateModal(id) {
		console.log("update => ", id);
		const recipesObj = JSON.parse(recipesJson);
		
		$("#rec-id-update").val(id);

		const card = $(`#card-${id}`);

		const title = card.find( ".card-title" ).text();
		const description = card.find( ".card-text" ).text();
		
		$("#recipe-process").val(description);
		$("#update-res-title").val(title);
		$("#header-update-res-title").html(title);

		$(".meal-checks input:checkbox").each(function(){
			const mealId = parseInt($(this).val());
			let marked = false;
			if (recipesObj[id].meals) {
				marked =recipesObj[id].meals.includes(mealId);
			}
			marked ? $(this).prop( "checked", true) : $(this).prop( "checked", false);
		});

		$(".ingredient-checks input:checkbox").each(function(){
			const ingredientId = parseInt($(this).val());
			let marked = false;
			if (recipesObj[id].ingredients) {
				marked = recipesObj[id].ingredients.includes(ingredientId);
			}
			marked ? $(this).prop( "checked", true) : $(this).prop( "checked", false);
		});

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

		let meals = [];
		$(".meal-checks input:checkbox").each(function() {
			if ($(this).prop('checked')) {
				meals.push($(this).val());	
			}
		});
		meals = meals.length ? meals.join(",") : "";

		let ingredients = [];
		$(".ingredient-checks input:checkbox").each(function() {
			if ($(this).prop('checked')) {
				ingredients.push($(this).val());	
			}
		})
		ingredients = ingredients.length ? ingredients.join(",") : "";

		const data = {
			id, title, description, action, meals, ingredients
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
				location.reload(); 
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