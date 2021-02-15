<?php 
include("db-helpers.php");

$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];

updateRecipe($id, $title, $description);
?>

<div class="card-body">
  <h5 class="card-title"><? echo $title; ?></h5>
  <p class="card-text"><? echo $description; ?></p>

  <button type="button" class="btn btn-secondary btn-delete" data-id="<? echo $id; ?>">
    Delete
  </button>
  <button type="button" class="btn btn-primary btn-update" data-id="<? echo $id; ?>">
    Modify
  </button>
</div>