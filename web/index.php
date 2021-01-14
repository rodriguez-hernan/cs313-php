<?php ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hernan Rodriguez | Web Dev</title>
    
</head>
<?php
include("./header.php");
?>
<body>
  <div class="container">
   <h1 class="display-1">Hernan Rodriguez</h1>  

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/projects.php">Projects</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="content">
      <h3>About me:</h3>
      <p class="interests">
      I'm a web developer, currently living in Buenos Aires, Argentina.
      I have been married for 6 years now, and with my wife we have 2 beautiful children.
      </p>
      <br />
      <p>Here are some of my interests</p>
      <ul class="interests">
        <li>Guitars</li>
        <li>Footbal (soccer)</li>
        <li>Books!</li>
      </ul>
    </div>
  </div>
<?php
include("./footer.php");
?>
</body>
</html>