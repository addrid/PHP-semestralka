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
$count = $db->query("SELECT COUNT(id) FROM matches")->fetchColumn();

$stmt = $db->prepare("SELECT * FROM matches ORDER BY last_updated_at DESC LIMIT 10 OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();

$stmt2 = $db->prepare("SELECT m.*, t1.id as tid1, t1.name as t1name, t2.id as tid2, t2.name as t2name
                                FROM matches m INNER JOIN teams t1 ON (t1.id = m.team1)
                                               INNER JOIN teams t2 ON (t2.id = m.team2) 
                                ORDER BY last_updated_at DESC");
$stmt2->execute();
$matches = $stmt2->fetchAll();

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
	
	<h1>Matches (<?= $count ?> total)</h1>
    <div class="links"><a href="newmatch.php">New match</a></div>
	
	<br/><br/>
	
	<?php if ($count > 0) { ?>
		
		<table>

			<tr>
		
				<th>Match Date</th>
                <th>Match Time</th>
				<th>Team 1</th>
				<th>Team 2</th>
				<th>Result</th>
			
		
			</tr>
	
			<?php foreach($matches as $row) { ?>

				<tr>
					<td><?= $row['matchdate'] ?></td>
                    <td><?= $row['matchtime'] ?></td>
					<td><?= $row['t1name'] ?></td>
					<td><?= $row['t2name'] ?></td>
					<td><?= $row['t1score'] ?>:<?= $row['t2score'] ?></td>
				</tr>
		
				<?php } ?>

		</table>
		
		<br/>
		<br/>

		<?php } ?>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>

