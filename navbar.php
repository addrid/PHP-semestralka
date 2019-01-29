<div class="navbar" style="overflow: auto; width: 100%; border-bottom: 1px solid black; padding: 10px 0;">
	<div style="float: left">
		
		<a href="index.php">HOMEPAGE</a> |
		<a href="players.php">PLAYERS</a> |
        <a href="teams.php">TEAMS</a> |
        <a href="matches.php">MATCHES</a> |
        <a href="articles.php">ARTICLES</a>
		
	</div>
    <div style="float: right">
        Signed in as <span class="green"><?= $string = preg_replace('/@[^@]*/', '', $current_user['email']); ?></span>
        <a href="logout.php">Sign out</a>
    </div>
</div>