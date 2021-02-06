<?php
require "dbConnection.php";
$db = get_db();

function getAllRecipesByUserId($id) {
  global $db;

  $sql = "SELECT
						rp.recipeid,
						rp.title, 
						rp.processDescription, 
						us.userName
					FROM UserRecipe ur 
						JOIN Users us 
							using(userid) 
						JOIN Recipe rp 
							using(recipeid)
					WHERE userid = $id";

	$statement = $db->prepare($sql);
	$statement->execute();

	$recipeList = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{		
		array_push($recipeList, [
			"id" => $row['recipeid'], 
			"title" => $row['title'], 
			"description" => $row['processdescription'], 
			"userName" => $row['username']
			]);
	}
	return $recipeList;
}

function getAllRecipes() {
	global $db;

  $sql = "SELECT * FROM recipe";
	$statement = $db->prepare($sql);
	$statement->execute();
	$recipeList = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{		
		array_push($recipeList, [
			"id" => $row['recipeid'], 
			"title" => $row['title'], 
			"description" => $row['processDescription'],
			]);
	}
	return $recipeList;
}

function getAllMeals() {
  global $db;

  $sql = "SELECT * FROM mealtag;";
	$statement = $db->prepare($sql);
	$statement->execute();

  $master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $id = $row['mealtagid'];
		$meal = $row['tagname'];
    array_push($master, [ $id => $meal ]);
  }
  
  return $master;
}

function getAllIngredients() {
	global $db;

  $sql = "SELECT * FROM ingredienttag;";
	$statement = $db->prepare($sql);
	$statement->execute();

  $master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $id = $row['ingredienttagid'];
		$ingredient = $row['tagname'];
    array_push($master, [ $id => $ingredient ]);
  }
  
  return $master;
}

function getUserByEmail($email) {
	global $db;

  $sql = "SELECT * FROM users WHERE email='$email'";
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	$userData = ["name" => $row["username"], "email" => $row["email"]];
	$user = [$row["userid"] => $userData];
	
	return $user;
}

function getMealsAsocByRecipe($recipes) {
	global $db;
	$recipeIds = implode("','", $recipes);
  $sql = "SELECT * FROM recipemealtag WHERE recipeid IN ('$recipeIds')";
	echo $sql; 
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	$master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $recipeID = $row['recipeID'];
		$mealTagID = $row['mealTagID'];
    array_push($master, [ 'recipeID' => $recipeID, 'mealTagID' => $mealTagID ]);
  }
  
  return $master;
}

function getIngredientsAsocByRecipe($recipes) {
	global $db;
	$recipeIds = implode("','", $recipes);
  $sql = "SELECT * FROM recipeingredienttag WHERE recipeid IN ('$recipeIds')";
	echo $sql; 
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	$master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $recipeID = $row['recipeID'];
		$ingredientTagID = $row['ingredientTagID'];
    array_push($master, [ 'recipeID' => $recipeID, 'ingredientTagID' => $ingredientTagID ]);
  }
  
  return $master;
}

?>