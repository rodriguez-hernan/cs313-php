<?php
  session_start();
  include("db-helpers.php");

	print_r($_POST);

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

      <h4>Add a new recipe to your list!</h4>

      <div>
        <form id="new-recipe-form">
          <div class="mb-3">
            <label for="recipe-title" class="form-label">Recipe Title</label>
            <input type="text" class="form-control" id="recipe-title" aria-describedby="recipeTitle" name="title">
          </div>
          <div class="mb-3">
            <label for="recipe-process" class="form-label">Recipe steps or comments</label>
            <textarea class="form-control" name="description" rows="4" cols="50" id="recipe-process"></textarea>
          </div>

          <div class="mb-3 form-check">

						<div class="filters flex">
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
          
					<button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

    </main>

  </div>
  <?php include("../footer.php"); ?>

	<script>
		$("#new-recipe-form").submit(function( event ) {

			// event.preventDefault();
			var $form = $( this ),
					title = $form.find( "input[name='title']" ).val(),
					description = $form.find( "input[name='description']" ).val(),
					mealList = $form.find( "input[name='meal_list']" ).val(),
					ingredientList = $form.find( "input[name='ingredient_list']" ).val();
		
			//Ajax Function to send a get request
			$.ajax({
				type: "POST",
				data: {
					"title": title,
					"description": description,
					"mealList": mealList,
					"ingredientList": ingredientList
				},
				success: function(response){
						//if request if made successfully then the response represent the data
						console.log("POSTED!");
						// $( "#result" ).empty().append( response );
				}
			});
		})
	</script>
</body>

</html>