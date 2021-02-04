<?php
require "dbConnection.php";
$db = get_db();

function getAllRecipesByUserId($id) {
  global $db;

  $sql = "SELECT book, chapter, verse, content FROM scripture";
	$statement = $db->prepare();
	$statement->execute();

	// Go through each result
	/* while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$book = $row['book'];
		$chapter = $row['chapter'];
		$verse = $row['verse'];
		$content = $row['content'];

		echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>";
	} */
}

function getAllRecipes() {

}

function getAllMeals() {
  global $db;

  $sql = "SELECT * FROM ingredienttag;";
	$statement = $db->prepare($sql);
	$statement->execute();

  $master = array();
	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $id = $row['ingredienttagid'];
		$ingredient = $row['tagname'];
    array_push($master, [ $id => $ingredient ]);
  }
  
  return $master;
}

function getUserByEmail($email) {

}

function getAllRecipesByMeal($mealId) {

}

?>