<?php
// Get the form input

$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$major = htmlspecialchars($_POST["major"]);
$continents = $_POST["continents"];
$comments = htmlspecialchars($_POST["comments"]);
$continentMap = array("NA"=>"North America",
    "SA"=>"South America",
    "AS"=>"Asia",
    "EU"=>"Europe",
    "AU"=>"Australia",
    "AF"=>"Africa",
    "AN"=>"Antarctica")

?>
<!DOCTYPE html>
<html>
<head>
	<title>The Results</title>
</head>
<body>
	<h1>Here are the results...</h1>
	<p>Your name is: <?=$name ?></p>
	<p>Your email is: <a href="mailto:<?=$email ?>"><?=$email ?></a></p>
	<p>Your major is: <?=$major ?></p>
    <p>Comments: <?=$comments?></p>
	<p>You have visited the following continents:</p>

    <?php
    foreach ($continents as $continent)
    {
        $continent_checked = htmlspecialchars($continent);
        if (array_key_exists($continent_checked,$continentMap)){
            echo "<p>$continentMap[$continent_checked]</p>";
        }
    }
    ?>

</body>
</html>