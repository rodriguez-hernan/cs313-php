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
   <h1 class="display-1">Projects and Assignments</h1>  

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page">Projects</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="content">
        <h3>Assignments</h3>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        CSE 341: Web Backend Development II
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            <li><a href="./week-2/index.php">Week 2 - Client side practice</a></li>
                            <li><a href="./week-3/index.php">Week 3 - Php forms</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
<?php
include("./footer.php");
?>
</body>
</html>