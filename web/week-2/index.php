<?php ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2</title>
    
</head>
<?php
include("../header.php");
?>
<body>
    <div class="container">
        <h1>Week 2 activity</h1>
        
        <div class="color-div first">
            This is the first div
        </div>
        <div class="color-div second">
            this would be the second
        </div>
        <div class="color-div third">
            and last but not least, the third one
        </div>
        
        <div class="btn">
            <button id="click-btn" class="btn btn-primary">Click Me!</button>
        </div>

        <div class="input-group mb-3">
            <input
              type="color"
              id="color-input"
              aria-label="change color"
              aria-describedby="button-color-change"
            >
            <button
              class="btn btn-outline-secondary"
              type="button"
              id="change-color-btn"
            >
              Change color
            </button>
        </div>
        <div class="input-group mb-3">
            <button
              type="button"
              class="btn btn-primary"
              id="toggle-btn"
            >
              Toggle div
            </button>
        </div>
    </div>
</body>

<?php
include("../footer.php");
?>
</html>