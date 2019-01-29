<?php

require 'db.php';
require 'user_required.php';

$stmt = $db->prepare("SELECT id, acronym FROM positions");
$stmt->execute();
$positions = $stmt->fetchAll();

foreach ($positions as $position){
$posid = $position['id'];
$acronym = $position['acronym'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $acro = $_POST['selected_text'];
    $count = $db->query("SELECT COUNT(id) FROM positions WHERE acronym='$acro'")->fetchColumn();

    if ($count == 0){
        echo "No position selected";
        header ('Location: players.php');
    }
    $playerid = $_GET['id'];
    $positionid = $db->query("SELECT id FROM positions WHERE acronym = '$acro'")->fetchColumn();;
    $count2 = $db->query("SELECT COUNT(id) FROM playerposition WHERE position=$positionid AND player=$playerid")->fetchColumn();

    if ((int)$count2 == 0){
        $stmt2 = $db->prepare("INSERT INTO playerposition (player, position) VALUES (?, ?)");
        $stmt2->execute(array($_GET['id'], $positionid));
    }

    header ('Location: players.php');

	
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
	    <h1>Add position to player #<?=$_GET['id']?></h1>
	    <form action="" method="POST">
	  
            Choose position<br/>
            <?php echo "<select name='position' onchange=\"document.getElementById('selected_text').value=this.options[this.selectedIndex].text\">";
            echo "<option>-- Select Item --</option>";

            foreach($positions as $row) {
                echo "<option value='$row[acronym]'>$row[acronym]</option>";
            }
            echo "</select>";
            ?><br/><br/>





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
