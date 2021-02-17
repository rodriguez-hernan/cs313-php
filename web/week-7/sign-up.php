<?php
require "dbConnection.php";
$db = get_db();



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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>