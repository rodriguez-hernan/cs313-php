<?php
require "dbConnection.php";
$db = get_db();
print_r($_POST);

$wrongPassword = "";
$wrongFormatPassword = "";

if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $password = $_POST["password"];
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $secondPassword = $_POST["confirm-password"];

  $correctPassword = preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/', $password);


  if (!$correctPassword) {
    $wrongFormatPassword = "Password must contain at least 7 characters and 1 number";
  } else {
    if ($password != $secondPassword) {
      $wrongPassword = "*Password must match";
    } else {
      insertIntoDB($username, $passwordHash);
      header('Location: ./sign-in.php');
      die();
    }
  }


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
</head>

<body>
  <div class="container">
    <form method="POST">
      <div class="mb-3">
        <label for="userName" class="form-label">User Name</label>
        <input required type="text" class="form-control" id="userName" name="userName">
      </div>
      <div class="mb-3">
        <p style="color:red;"><? echo $wrongFormatPassword; ?></p>
        <label for="password" class="form-label">Password</label>
        <input
          required
          type="password"
          name="password"
          class="form-control"
          id="password"
          pattern="^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$"
        >
      </div>
      <div class="mb-3">
        
        <label for="confirm-password" class="form-label">
          Confirm password 
          <span style="color:red;"><? echo $wrongPassword; ?></span>
        </label>
        <input required type="password" name="confirm-password" class="form-control" id="confirm-password">
      </div>
      <input type="hidden" value="signIn" name="submit">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div>
      <a href="./sign-in.php">Sign in</a>
    </div>
  </div>
  <?php include("../footer.php"); ?>
</body>

</html>