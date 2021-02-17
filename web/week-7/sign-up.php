<?php
require "dbConnection.php";
$db = get_db();
print_r($_POST);

if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $password = $_POST["password"];
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  insertIntoDB($username, $passwordHash);
  header('Location: ./sign-in.php');
}

function insertIntoDB($username, $password) {
  global $db;
	$sql = "INSERT INTO userslogin (username, password) values(:username, :password)";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(":username", $username, PDO::PARAM_STR);
  $stmt->bindValue(":password", $password, PDO::PARAM_STR);
  $stmt->execute();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <?php include("../header.php"); ?>
  <link rel="stylesheet" href='./style.css'>
</head>

<body>
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

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>