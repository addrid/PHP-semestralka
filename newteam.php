<?php

require 'db.php';
require 'user_required.php';
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$stmt = $db->prepare("INSERT INTO teams(name, acronym, nationality, since) VALUES (?, ?, ?, ?)");
	$stmt->execute(array($_POST['name'], $_POST['acronym'], $_POST['nationality'], $_POST['since']));
		
	header('Location: index.php');
	
}

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Football app</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div id="container">
    <div id="header">
        <img src="images/header.jpg" alt="Football app"/>
    </div>
    <?php include 'navbar.php' ?>

    <div id="formcontent">
        <div class="forms">
	    <h1>New Team</h1>
	
        <form action="" method="POST">
	        Name<br/>
            <input type="text" name="name" value="" required /><br/><br/>

            Acronym (5 míst, velká písmena)<br/>
            <input type="text" name="acronym" maxlength="5" minlength="5" value="" pattern="[A-Z]{5}" required /><br/><br/>

            Nationality<br/>
            <input type="text" name="nationality" value="" required /><br/><br/>

            Since<br/>
            <input type="date" name="since" value="" required /><br/><br/>
            <br/>
            <input type="submit" value="Save"> or <a href="index.php">Cancel</a>
		</form>
        </div>
    </div>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>

</body>

</html>
