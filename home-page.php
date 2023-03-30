<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Blog</title>
        <link rel="stylesheet" href="styles/styles.css" />
  	    <script type="text/javascript" src="scripts/script.js"></script>
    </head>
<body>

<?php
	echo "bonjour ".$_COOKIE["login"];
?>

<h1> Mon Profil </h1>
<input type="button" value="Nouveau Post" onclick="window.location.href='nouveau-post.php'">
<input type="button" value="Mes Posts" onclick="window.location.href='show-posts-by-id.php'">
<div class="posts">
	<?php
		include("connexion-base.php");
		$req = $pdo->prepare("SELECT * FROM post WHERE id_utilisateur=?");
		$req->execute(array($_COOKIE["id"]));
		while ($donnee=$req->fetch())
		{
			echo "<div class='post'>";
			echo "<h2>".$donnee['titre']."</h2>";
			echo "<p>".$donnee['contenu']."</p>";
			echo "<p>".$donnee['date']."</p>";
			echo "</div>";
		}
	?>
</body>
</html>