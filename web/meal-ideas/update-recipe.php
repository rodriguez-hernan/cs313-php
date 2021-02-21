<?php 
session_start();
include("db-helpers.php");

$userId = $_SESSION["userId"];

$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$meals = $_POST["meals"];
$ingredients = $_POST["ingredients"];

/* echo "<br/> $meals <br/>";
echo "<br/> $ingredients <br/>"; */


updateRecipe($id, $title, $description, $meals, $ingredients, $userId);

?>

<div class="card-body">
  <h5 class="card-title"><? echo $title; ?></h5>
  <p class="card-text"><? echo $description; ?></p>

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