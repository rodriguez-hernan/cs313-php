<?php
require "dbConnection.php";
$db = get_db();
session_start();
print_r($_POST);
$wrongPassword = false;

if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $password = $_POST["password"];
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  $user = getUserAndPassword($username);


  if (password_verify($password, $user["password"])) {
    $_SESSION["username"] = $username;
    $_SESSION["userId"] = $user["id"];

    header('Location: ./index.php');
    die();
  } else {
    $wrongPassword = true;
  }
}

function getUserAndPassword($username) {
  global $db;
	$sql = "SELECT * FROM userslogin WHERE username=:username";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(":username", $username, PDO::PARAM_STR);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Sign In</title>
  <?php include("../header.php"); ?>
  <link rel="stylesheet" href='./style.css'>
</head>

<body>

  <h1>Sign in!</h1>

  <?
    if($wrongPassword) {

      echo "<h2>Wrong password</h2>";      
    }
  ?>

  <div class="container">
    <form method="POST">
      <div class="mb-3">
        <label for="userName" class="form-label">User Name</label>
        <input type="text" class="form-control" id="userName" name="userName">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
      <input type="hidden" value="signIn" name="submit">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div>
      <a href="./sign-up.php">Sign up</a>
    </div>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>