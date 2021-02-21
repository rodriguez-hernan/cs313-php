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

function updateRecipe($id, $title, $description, $meals, $ingredients, $userId) {
	global $db;
	$sql1 = "UPDATE Recipe SET title = '$title', processdescription = '$description' WHERE recipeid = $id";

	$stmt1 = $db->prepare($sql1);
	$stmt1->execute();

	// delete all RecipeMealTag where recipeId is $id
	$sql2 = "DELETE FROM RecipeMealTag WHERE recipeId='$id' ";
	$stmt2 = $db->prepare($sql2);
	$stmt2->execute();
	// insert into RecipeMealTag $id $userId and foreach $meals
	$mealsArray = explode(',', strval($meals));
	$sql3 = "INSERT INTO RecipeMealTag (recipeId, mealtagid, userid) VALUES ";
	foreach($mealsArray as $meal) {
		$sql3 =  $sql3 . "($id, $meal, $userId), ";
	}
	$sql3 = substr($sql3, 0, -1);
	echo $sql3;
	$stmt3 = $db->prepare($sql3);
	$stmt3->execute();

	// delete all recipeIngredientTag where recipeId is $id	
	$sql4 = "DELETE FROM recipeIngredientTag WHERE recipeId='$id' ";
	$stmt4 = $db->prepare($sql4);
	$stmt4->execute();
	// insert into recipeIngredientTag $id $userId and foreach $ingredients
	$ingredientsArray = explode(',', strval($ingredients));
	$sql5 = "INSERT INTO recipeIngredientTag (recipeId, ingredienttagid, userid) VALUES ";
	foreach($ingredientsArray as $ing) {
		$sql5 = $sql5 . "($id, $ing, $userId), ";
	}
	$sql5 = substr($sql5, 0, -1);
	echo $sql5;
	$stmt5 = $db->prepare($sql5);
	$stmt5->execute();

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
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$master[$id]["ingredients"][] = $row['ingredienttagid'];
		}

		// add meals array
		$sql = "SELECT * FROM RecipeMealTag WHERE recipeid='$id' AND userid='$userid' ";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$master[$id]["meals"][] = $row['mealtagid'];
		}

	}


	return $master;
}

?>