<?php
 // Browse Items
 session_start();
 include_once("./products.php");
 
 // print_r($products);

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

<h1 class="display-1 browse__header">Electonic deals</h1>

<div class="container">
  <div class="row">
    <?php
    foreach($products as $key => $item) {
      ?>
        <div class="col-md-4">
          <div class="card product-card" style="width: 18rem;">
            <img src="<?php echo $item["img"] ?>" class="card-img-top" alt="item image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $item["title"] ?></h5>
              <p class="card-text"><?php echo $item["description"] ?></p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
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