<?php

require 'db.php';
require 'admin_required.php';
require 'user_required.php';

$stmt = $db->prepare("SELECT id, name FROM teams");
$stmt->execute();
$teams = $stmt->fetchAll();

$stmt1 = $db->prepare("SELECT firstname, surname, age, city, description FROM players WHERE id=? LIMIT 1");
$stmt1->execute(array($_GET['id']));
$players = $stmt1->fetchAll();

foreach ($players as $player){
$firstname = $player['firstname'];
$surname= $player['surname'];
$age= $player['age'];
$city= $player['city'];
$description= $player['description'];
$desc = substr($description, 3, -4);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $merge = "<p>".$_POST['description']."</p>";

    $teamname = $_POST['selected_text'];
    $teamid = $db->query("SELECT id FROM teams WHERE name = '$teamname'")->fetchColumn();

    $stmt = $db->prepare("SELECT last_updated_at FROM players WHERE id = ?");
    $stmt->execute(array($_GET['id']));
    $current_last_updated_at = $stmt->fetchColumn();

    $stmt2 = $db->prepare("UPDATE players SET firstname=?, surname=?, age=?, city=?, description=?, team=?, last_edit_starts_by_id=? WHERE id=?");
	$stmt2->execute(array($_POST['firstname'], $_POST['surname'], (int)$_POST['age'], $_POST['city'], $merge, (int)$teamid, $current_user['id'], $_GET['id']));

    $stmt3 = $db->prepare("UPDATE teams SET numOfPlayers = (SELECT COUNT(*) FROM players WHERE team=teams.id)");
    $stmt3->execute(array((int)$teamid));

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
	    <h1>Edit player #<?=$_GET['id']?></h1>
	    <form action="" method="POST">
	  
        Firstname<br/>
		<input type="text" name="firstname" value="<?=$firstname?>" required /><br/>

        Surname<br/>
        <input type="text" name="surname" value="<?=$surname?>" required /><br/>

        Age<br/>
        <input type="number" name="age" value="<?=$age?>" min="15" max="60" required /><br/>

        City<br/>
        <input type="text" name="city" value="<?=$city?>" required /><br/>

        Team<br/>
        <?php echo "<select name='name' onchange=\"document.getElementById('selected_text').value=this.options[this.selectedIndex].text\">";
        echo "<option>-- Select Item --</option>";

        foreach($teams as $row) {
            echo "<option value='$row[name]'>$row[name]</option>";
        }
        echo "</select>";
        ?><br/><br/>

        Description<br/>
        <textarea name="description" required /><?=$desc?></textarea><br/>

        <input type="hidden" name="selected_text" id="selected_text" value="" required /><br/>

        <a href="players.php">Cancel</a>
        <input type="submit" value="Save">

	    </form>
        </div>
    </div>
    <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>
