<?php
require "dbConnection.php";
session_start();
$db = get_db();

if(isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  header('Location: ./sign-in.php');
  die();
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
		<h1>Welcome <? echo $username; ?></h1>

  </div>
  <?php include("../footer.php"); ?>
</body>

</html>