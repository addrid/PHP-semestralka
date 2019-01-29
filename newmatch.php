<?php

require 'db.php';
require 'user_required.php';

$stmt = $db->prepare("SELECT id, name FROM teams");
$stmt->execute();
$teams = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['team1'] == $_POST['team2']) {
        echo "You can't play against yourself!";
    } else {

        $team1name = $_POST['selected_text'];
        $team2name = $_POST['selected_text2'];

        $t1 = $db->query("SELECT id FROM teams WHERE name = '$team1name'")->fetchColumn();
        $t2 = $db->query("SELECT id FROM teams WHERE name = '$team2name'")->fetchColumn();

        $stmt2 = $db->prepare("INSERT INTO matches(team1, team2, t1score, t2score, matchdate, matchtime) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->execute(array((int)$t1, (int)$t2, (int)$_POST['t1score'], (int)$_POST['t2score'], $_POST['matchdate'], $_POST['matchtime']));

        header('Location: matches.php');

    }
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

	<h1>New match</h1>

	<form action="" method="POST">
	  
		Team 1<br/>
        <?php echo "<select name='team1' onchange=\"document.getElementById('selected_text').value=this.options[this.selectedIndex].text\">";
            echo "<option>-- Select Item --</option>";

            foreach($teams as $row) {
            echo "<option value='$row[name]'>$row[name]</option>";
            }
        echo "</select>";
        ?><br/><br/>

        Team 2<br/>
        <?php echo "<select name='team2' onchange=\"document.getElementById('selected_text2').value=this.options[this.selectedIndex].text\">";
        echo "<option>-- Select Item --</option>";

        foreach($teams as $row) {
            echo "<option value='$row[name]'>$row[name]</option>";
        }
        echo "</select>";
        ?><br/><br/>


        <input type="hidden" name="selected_text" id="selected_text" value="" />
        <input type="hidden" name="selected_text2" id="selected_text2" value="" />

        Team 1 score<br/>
        <input type="number" name="t1score" min="0" max="20" value="" required /><br/><br/>

        Team 2 score<br/>
		<input type="number" name="t2score" min="0" max="20" value="" required /><br/><br/>

		Date<br/>
        <input type="date" name="matchdate" value="" required /><br/><br/>

        Time<br/>
        <input type="time" name="matchtime" value="" required /><br/><br/>
				
		<br/>
		
		<input type="submit" value="Save"> or <a href="matches.php">Cancel</a>
		
	</form>

    <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>
