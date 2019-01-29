<?php

require 'db.php';
require 'user_required.php';

$stmt1 = $db->prepare("SELECT * FROM articles WHERE id=? LIMIT 1");
$stmt1->execute(array($_GET['id']));
$articles = $stmt1->fetchAll();

foreach ($articles as $article){
$title = $article['title'];
$content= $article['content'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt2 = $db->prepare("UPDATE articles SET title=?, content=? WHERE id=?");
	$stmt2->execute(array($_POST['title'], $_POST['content'], (int)$_GET['id']));

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
        <div class="forms">
	    <h1>Edit article #<?=$_GET['id']?></h1>
	    <form action="" method="POST">
	  
        Title<br/>
		<input type="text" name="title" value="<?=$title?>" required /><br/>

        Content<br/>
        <textarea name="content" required /><?=$content?></textarea><br/>

        <a href="articles.php">Cancel</a>
        <input type="submit" value="Save">

	    </form>
        </div>
    </div>
    <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>
