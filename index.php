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
$count = 5;

$stmt = $db->prepare("SELECT m.*, t1.id as tid1, t1.name as t1name, t2.id as tid2, t2.name as t2name
                                FROM matches m INNER JOIN teams t1 ON (t1.id = m.team1)
                                               INNER JOIN teams t2 ON (t2.id = m.team2) 
                                ORDER BY last_updated_at DESC LIMIT 5");
$stmt->execute();
$matches = $stmt->fetchAll();

$stmt2 = $db->prepare("SELECT a.*, u.id, u.email 
                                 FROM articles a INNER JOIN users u ON (a.author = u.id) ORDER BY posted DESC LIMIT 5");
$stmt2->execute();
$articles = $stmt2->fetchAll();

$stmt3 = $db->prepare("SELECT surname, goals FROM players ORDER BY goals DESC LIMIT 5");
$stmt3->execute();
$players = $stmt3->fetchAll();


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

        <div id="content">
            <?php foreach($articles as $row) { ?>

            <table>
                <tr class="artitle">
                    <td><?= $row['title'] ?></td>
                </tr>
                <tr class="arinfo">
                    <td>Posted: <?= $row['posted'] ?> by <?= $row['email'] ?> </td>
                </tr>
                <tr class="arcontent">
                    <td><?= $row['content'] ?></td>
                </tr>
                <?php } ?>
            </table>

        </div>
        <div id="rightbar">
            <h1>LATEST MATCHES</h1>
            <table>

                <?php foreach($matches as $row) { ?>

                <tr>
                    <?php if ($row['t1score'] < $row['t2score']) {?>
                        <td class="red"><?= $row['t1name'] ?></td>
                        <td>vs</td>
                        <td class="green"><?= $row['t2name'] ?></td>
                    <?php } elseif ($row['t1score'] == $row['t2score']) { ?>
                        <td class="yellow"><?= $row['t1name'] ?></td>
                        <td>vs</td>
                        <td class="yellow"><?= $row['t2name'] ?></td>
                    <?php } else { ?>
                        <td class="green"><?= $row['t1name'] ?></td>
                        <td>vs</td>
                        <td class="red"><?= $row['t2name'] ?></td>
                    <?php } ?>
                    <td><?= $row['t1score'] ?>:<?= $row['t2score'] ?></td>

                </tr>


                <?php } ?>
            </table>

            <h1>TOP SCORERS</h1>
            <table>

                <?php $place=1;
                foreach($players as $row) {
                ?>

                    <tr>
                        <td><?php echo $place ?>.</td>
                        <td><?= $row['surname'] ?></td>
                        <td class="bold"><?= $row['goals'] ?></td>
                    </tr>

                <?php $place++;
                } ?>
            </table>
        </div>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>


</body>

</html>

