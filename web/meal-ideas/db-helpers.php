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
			"description" => $row['processdescription'],
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
    $master[$id] = $meal;
		// array_push($master, [ $id => $meal ]);
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
		$master[$id] = $ingredient;
    // array_push($master, [ $id => $ingredient ]);
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
	//echo $sql; 
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	$master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $recipeID = $row['recipeid'];
		$mealTagID = $row['mealtagid'];
    array_push($master, [ 'recipeid' => $recipeID, 'mealtagid' => $mealTagID ]);
  }
  
  return $master;
}

function getIngredientsAsocByRecipe($recipes) {
	global $db;
	$recipeIds = implode("','", $recipes);
  $sql = "SELECT * FROM recipeingredienttag WHERE recipeid IN ('$recipeIds')";
	//echo $sql; 
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	$master = array();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    $recipeID = $row['recipeid'];
		$ingredientTagID = $row['ingredienttagid'];
    array_push($master, [ 'recipeid' => $recipeID, 'ingredienttagid' => $ingredientTagID ]);
  }
  
  return $master;
}

function insertNewRecipe($title, $description, $meals, $ingredients, $userId) {
	global $db;
  $sqlRecipe = "INSERT INTO Recipe (title, processDescription) values ('$title', '$description')";
	
	$stmt = $db->prepare($sqlRecipe);
	$stmt->execute();
	$id = $db->lastInsertId();

	$sqlUser = "INSERT INTO UserRecipe (userid, recipeid) values ($userId, $id)";
	$stmt2 = $db->prepare($sqlUser);
	$stmt2->execute();

	$sqlMeals = "INSERT INTO RecipeMealTag (recipeid, mealtagid, userid) values ";
	if ($meals) {
		foreach ($meals as $key => $value) {
			$sqlMeals = $sqlMeals . "('$id', '$value', '$userId'),";
		}

		$sqlMeals = substr($sqlMeals, 0, -1);
		//echo "<br/> sqlMeals: " . $sqlMeals;
		$stmt3 = $db->prepare($sqlMeals);
		$stmt3->execute();
	}

	$sqlIngredients = "INSERT INTO recipeIngredientTag (recipeid, ingredienttagid, userid) values ";
	if ($ingredients) {
		foreach ($ingredients as $key => $value) {
			$sqlIngredients = $sqlIngredients . "('$id', '$value', '$userId'),";
		}
		$sqlIngredients = substr($sqlIngredients, 0, -1);
		//echo "<br/> sqlIngredients: " . $sqlIngredients;
		$stmt4 = $db->prepare($sqlIngredients);
		$stmt4->execute();
	}
}

function updateRecipe($id, $title, $description) {
	global $db;
	$sql = "UPDATE Recipe SET title = '$title', processdescription = '$description' WHERE recipeid = $id";

	$stmt2 = $db->prepare($sql);
	$stmt2->execute();
}

function deleteRecipe($id) {
	global $db;
	$sql = "DELETE FROM recipe WHERE recipeid='$id' ";
	$stmt = $db->prepare($sql);
	$stmt->execute();
}

function getRecipeIngredientMeals($recipes, $userid) {
	global $db;

	$master = array();
	foreach ($recipes as $key => $val) {
		$id = $val["id"];
		$master[$id] = $val;

		// add ingredient array
		$sql = "SELECT * FROM recipeIngredientTag WHERE recipeid='$id' AND userid='$userid' ";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$master[$id]["ingredients"][] = $row['ingredienttagid'];
		}

		// add meals array
		$sql = "SELECT * FROM RecipeMealTag WHERE recipeid='$id' AND userid='$userid' ";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$master[$id]["meals"][] = $row['mealtagid'];
		}

	}


	return $master;
}

?>