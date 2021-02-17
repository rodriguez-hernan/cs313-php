<?php
require "dbConnection.php";
$db = get_db();
print_r($_POST);


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