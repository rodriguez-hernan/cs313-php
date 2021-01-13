<?php
include("../header.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2</title>
    <link rel="stylesheet" href='../styles.css'>
    <script src='../main.js'></script>
</head>
<body>
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
        <button id="click-btn">Click Me!</button>
    </div>
    
    <div class="change-color">
        <label for="color">Change color</label>
        <input id="color-input" name="color" type="color" onchange="changeColor()" />
    </div>
</body>

<?php
include("../footer.php");
?>