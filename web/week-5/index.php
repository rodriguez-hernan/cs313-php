<?php

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
$sql = "SELECT ingredienttagid, tagname
        FROM public.ingredienttag";

$statement = $db->query($sql);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hernan Rodriguez | Web Dev</title>
  <link rel="stylesheet" href='./styles.css'>
</head>
<?php
include("../header.php");
?>
<body>

<h1 class="display-1 browse__header">Ingredients</h1>

<div class="container">
  <div class="row">
    <?php
    foreach($results as $key => $item) {
      ?>
        <ul>
          <?php echo "<li>$item</li>" ?>
        </ul>
      <?php
    }  
    ?>
  </div>
</div>

<script src='./main.js'></script>
<?php
include("../footer.php");
?>
</body>
</html>
