<?php
require "dbConnection.php";
$db = get_db();
print_r($_POST);

$wrongPassword = "";

if(isset($_POST["submit"])) {
  $username = $_POST["userName"];
  $password = $_POST["password"];
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $secondPassword = $_POST["confirm-password"];

  $correctPassword = preg_match('^\w{7,40}.*[0-9].*$', $password);

  echo "<br /> correct?  $correctPassword";

  if ($password != $secondPassword) {
    $wrongPassword = "*Password must match";
  } else {
    insertIntoDB($username, $passwordHash);
    header('Location: ./sign-in.php');
    die();
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
      <div class="mb-3">
        
        <label for="confirm-password" class="form-label">
          Confirm password 
          <span style="color:red;"><? echo $wrongPassword; ?></span>
        </label>
        <input type="password" name="confirm-password" class="form-control" id="confirm-password">
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