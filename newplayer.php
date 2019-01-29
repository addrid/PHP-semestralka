<?php

require 'db.php';
require 'user_required.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $merge = "<p>".$_POST['description']."</p>";

	$stmt = $db->prepare("INSERT INTO players(firstname, surname, age, city, description, last_edit_starts_by_id) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->execute(array($_POST['firstname'], $_POST['surname'], (int)$_POST['age'], $_POST['city'], $merge, $current_user['id']));
		
	header('Location: players.php');
	
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
	    <h1>New player</h1>
	    <form action="" method="POST">
	  
        Firstname<br/>
		<input type="text" name="firstname" value="" required /><br/>

        Surname<br/>
        <input type="text" name="surname" value="" required /><br/>

        Age<br/>
        <input type="number" name="age" min="15" max="60" value="" required /><br/>

        City<br/>
        <input type="text" name="city" value="" required /><br/>

        Description<br/>
        <textarea name="description" required /></textarea><br/>

        <input type="hidden" name="id" value=""><br/>
        <input type="submit" value="Save"> or <a href="players.php">Cancel</a>
		
	    </form>
        </div>
    </div>
    <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>
