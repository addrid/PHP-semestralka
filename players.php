<?php
// http://php.net/manual/en/session.examples.basic.php
// Sessions can be started manually using the session_start() function. If the session.auto_start directive is set to 1, a session will automatically start on request startup.

// http://stackoverflow.com/questions/4649907/maximum-size-of-a-php-session
// You can store as much data as you like within in sessions. All sessions are stored on the server. The only limits you can reach is the maximum memory a script can consume at one time, which by default is 128MB.

//http://stackoverflow.com/questions/217420/ideal-php-session-size

require 'db.php';
require 'user_required.php';

# offset pro strankovani
if (isset($_GET['offset'])) {
	$offset = (int)$_GET['offset'];
} else {
	$offset = 0;
}

$count = $db->query("SELECT COUNT(id) FROM players")->fetchColumn();
$countpos = $db->query("SELECT COUNT(id) FROM positions")->fetchColumn();

$stmt = $db->prepare("SELECT pl.*, GROUP_CONCAT(pos.acronym) as positions
                      FROM players pl LEFT JOIN playerposition pp on pl.id = pp.player
                                      LEFT JOIN positions pos on pos.id = pp.position	
                      GROUP BY pl.surname ORDER BY pl.id, pos.acronym DESC LIMIT 10 OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
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
	
	<h1>Players (<?= $count ?> total)</h1>

	<div class="links"><a href="newplayer.php">New player</a></div>
	
	<br/><br/>
	
	<?php if ($count > 0) { ?>
		
		<table>

			<tr>

				<th>Firstname</th>
				<th>Surname</th>
				<th>Age</th>
				<th>City</th>
				<th>Team ID</th>
                <th>Positions</th>
                <th></th>
			
		
			</tr>
	
			<?php foreach($players as $row) { ?>

				<tr>
					<td><?= $row['firstname'] ?></td>
					<td><?= $row['surname'] ?></td>
					<td><?= $row['age'] ?></td>
					<td><?= $row['city'] ?></td>
					<td><?= $row['team'] ?></td>
                    <td><?= $row['positions'] ?></td>
				
					<td class="center">
						<a href='./editplayer.php?id=<?= $row['id'] ?>'>Edit</a> |
						<a href='./addposition.php?id=<?= $row['id'] ?>'>Add position</a>
					</td>
				
				</tr>
		
				<?php } ?>

		</table>
		
		<br/>
		
		<div class="pagination">	
		<?php for($i=1; $i<=ceil($count/10); $i++) { ?>

		<a class="<?= $offset/10+1==$i ? "active" : ""  ?>" href="./players.php?offset=<?= ($i-1)*10 ?>"><?= $i ?></a>

		<?php } ?>
		</div>

		<br/>

		<?php } ?>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>

