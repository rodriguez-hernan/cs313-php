<?php 
include("db-helpers.php");

$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$meals = $_POST["meals"];
$ingredients = $_POST["ingredients"];

echo "<br/> $meals <br/>";
echo "<br/> $ingredients <br/>";


updateRecipe($id, $title, $description);

$meals = getAllMeals();
$ingredients = getAllIngredients();
?>

<div class="card-body">
  <h5 class="card-title"><? echo $title; ?></h5>
  <p class="card-text"><? echo $description; ?></p>

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

  <button
    type="button"
    class="btn btn-secondary btn-delete"
    data-id="<? echo $id; ?>"
    onclick="openDeleteModal('<? echo $id; ?>');"
  >
    Delete
  </button>
  <button
    type="button"
    class="btn btn-primary btn-update"
    data-id="<? echo $id; ?>"
    onclick="openUpdateModal('<? echo $id; ?>');"
  >
    Modify
  </button>
</div>