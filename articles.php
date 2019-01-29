<?php
require 'db.php';
require 'user_required.php';

# offset pro strankovani
if (isset($_GET['offset'])) {
	$offset = (int)$_GET['offset'];
} else {
	$offset = 0;
}

$count = $db->query("SELECT COUNT(id) FROM articles")->fetchColumn();

$stmt = $db->prepare("SELECT * FROM articles ORDER BY posted DESC LIMIT 5 OFFSET ?");
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
	
	<h1>Articles (<?= $count ?> total)</h1>

	<div class="links"><a href="newarticle.php">New article</a></div>
	
	<br/><br/>
	
	<?php if ($count > 0) { ?>
		
		<table>

			<tr>

				<th>Title</th>
				<th>Posted</th>
				<th>Author</th>
				<th>Content</th>
                <th></th>
			
		
			</tr>
	
			<?php foreach($players as $row) { ?>

				<tr>
					<td><?= $row['title'] ?></td>
					<td><?= $row['posted'] ?></td>
					<td><?= $row['author'] ?></td>
					<td><?= $row['content'] ?></td>
				
					<td class="center">
						<a href='./editarticle.php?id=<?= $row['id'] ?>'>Edit</a>
					</td>
				
				</tr>
		
				<?php } ?>

		</table>
		
		<br/>
		
		<div class="pagination">	
		<?php for($i=1; $i<=ceil($count/5); $i++) { ?>

		<a class="<?= $offset/5+1==$i ? "active" : ""  ?>" href="./articles.php?offset=<?= ($i-1)*5 ?>"><?= $i ?></a>

		<?php } ?>
		</div>

		<br/>

		<?php } ?>
        <div id="footer">Created by © Daniel Navrátil 2017</div>
    </div>
</body>

</html>

