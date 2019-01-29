<?php

require 'db.php';
require 'user_required.php';

# offset pro strankovani
if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

# celkovy pocet tymu pro strankovani
$count = $db->query("SELECT COUNT(id) FROM teams")->fetchColumn();

$stmt = $db->prepare("SELECT * FROM teams ORDER BY name DESC LIMIT 10 OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$teams = $stmt->fetchAll();

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

<h1>Teams (<?= $count ?> total)</h1>

<div class="links"><a href="newteam.php">New team</a></div>

<br/><br/>

<?php if ($count > 0) { ?>

    <table>

        <tr>

            <th>Name</th>
            <th>Acronym</th>
            <th>Nationality</th>
            <th>Since</th>
            <th>numOfPlayers</th>
            <th></th>

        </tr>

        <?php foreach($teams as $row) { ?>

            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['acronym'] ?></td>
                <td><?= $row['nationality'] ?></td>
                <td><?= $row['since'] ?></td>
                <td><?= $row['numOfPlayers'] ?></td>

                <td class="center">
                    <a href='./teamplayers.php?id=<?= $row['id'] ?>'>Show players</a>
                </td>

            </tr>

        <?php } ?>

    </table>

    <br/>

    <div class="pagination">
        <?php for($i=1; $i<=ceil($count/10); $i++) { ?>

            <a class="<?= $offset/10+1==$i ? "active" : ""  ?>" href="./teams.php?offset=<?= ($i-1)*10 ?>"><?= $i ?></a>

        <?php } ?>
    </div>

    <br/>

    <?php } ?>
    <div id="footer">Created by © Daniel Navrátil 2017</div>
</div>
</body>

</html>
