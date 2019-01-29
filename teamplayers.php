<?php
require 'db.php';
require 'user_required.php';

# offset pro strankovani
if (isset($_GET['offset'])) {
	$offset = (int)$_GET['offset'];
} else {
	$offset = 0;
}

# celkovy pocet zbozi pro strankovani
$actualid = $_GET['id'];
$count = $db->query("SELECT COUNT(id) FROM players where team=$actualid")->fetchColumn();

$team = $db->prepare("SELECT name FROM teams WHERE id=?");
$team->execute(array($_GET['id']));

$stmt = $db->prepare("SELECT * FROM players WHERE team=? ORDER BY firstname DESC");
$stmt->execute(array($_GET['id']));
$players = $stmt->fetchAll();
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>Football app</title>
	
	<link rel="stylesheet" type="text/css" href="./styles.css">
	
</head>

<body>

    <div id="container">
    <div id="header">
        <img src="images/header.jpg" alt="Football app"/>
    </div>

	<?php include 'navbar.php' ?>
	
	<h1>Players of team <?=$_GET['id']?> (total: <?= $count ?>)</h1>

	<br/><br/>

	<br/><br/>
	
	<?php if ($count > 0) { ?>
		
		<table>
			<tr>
				<th>Firstname</th>
				<th>Surname</th>
				<th>Age</th>
				<th>City</th>
                <th>Description</th>
			</tr>
	
			<?php foreach($players as $row) { ?>

            <tr>
                <td><?= $row['firstname'] ?></td>
                <td><?= $row['surname'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['city'] ?></td>
                <td><?= $row['description'] ?></td>
            </tr>
		
            <?php } ?>

		</table>
		<br/>

		<div class="pagination">	
		<?php for($i=1; $i<=ceil($count/10); $i++) { ?>

		<a class="<?= $offset/10+1==$i ? "active" : ""  ?>" href="./teamplayers.php?offset=<?= ($i-1)*10 ?>"><?= $i ?></a>

		<?php } ?>
		</div>

		<br/>

		<?php } ?>
        <div class="links"><a href="./teams.php">Back</a></div>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>

