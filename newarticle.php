<?php

require 'db.php';
require 'user_required.php';
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $db->prepare("INSERT INTO articles(title, author, content) VALUES (?, ?, ?)");
	$stmt->execute(array($_POST['title'], $current_user['id'], $_POST['content']));
		
	header('Location: articles.php');
	
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
        <h1>New article</h1>


        <form action="" method="POST">

            Title<br/>
            <input type="text" name="title" value="" required/><br/><br/>

            Content<br/>
            <textarea name="content" required /></textarea><br/>

            <br/>
            <input type="hidden" name="author">
            <input type="submit" value="Save"> or <a href="articles.php">Cancel</a>

        </form>

    </div>
        <div id="footer">Created by © Daniel Navrátil 2017</div>

    </div>

</body>

</html>
