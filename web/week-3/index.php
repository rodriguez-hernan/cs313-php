<?php
$majors = [
    "Computer Science",
    "Web Design and Development",
    "Computer Information Technology",
    "Computer Engineering"
];

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Survey</title>
</head>

<body>
<form method="POST" action="getForm.php">
    <p>Please answer the following questions:</p>
    Name: <input type="text" placeholder="Name" name="name">
    <br>
    Email: <input type="text" placeholder="Email Address" name="email">
    <br>
    Major:
    <br>
    <!-- Notice that each radio button has the same name, but
    different a different id -->
    <?php
    foreach ($majors as $major) {
        ?>
        <input type="radio" name="major" value="<?php echo $major ?>"><?php echo $major ?><br>
        <?php
    }
    ?>
    <br>
    <label for="comments">Comments:</label><br>
    <textarea id="comments" name="comments" rows="4" cols="50"></textarea>
    <br>
    <br>
    Which continents have you visited?
    <br>
    <input type="checkbox" name="continents[]" value="NA">North America<br>
    <input type="checkbox" name="continents[]" value="SA">South America<br>
    <input type="checkbox" name="continents[]" value="AS">Asia America<br>
    <input type="checkbox" name="continents[]" value="EU">Europe<br>
    <input type="checkbox" name="continents[]" value="AF">Africa<br>
    <input type="checkbox" name="continents[]" value="AU">Australia<br>
    <input type="checkbox" name="continents[]" value="AN">Antarctica<br>
    <br>
    <input type="submit" value="Submit Answers">
</form>

</body>

</html>
