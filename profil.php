<?php

include_once("initialize.php");
include("connexion-base.php");
include_once("helpz/functions.php");
include_once(__ROOT__."/PageParts/header.php");
include_once(__ROOT__."/PageParts/menu-bar.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profil du blog</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<header>
		<h1>Profil du blog</h1>
	</header>

	<main>
		<section class="profil">
			<h2>Informations de profil</h2>
			<form action="modifier_profil.php" method="POST" enctype="multipart/form-data">
				<label for="pseudo">Pseudo :</label>
				<input type="text" name="pseudo" value="Pseudo actuel"><br><br>

				<label for="mdp">Mot de passe :</label>
				<input type="password" name="mdp" value=""><br><br>

				<label for="avatar">Avatar :</label>
				<input type="file" name="avatar" accept=".jpg, .jpeg, .png"><br><br>

				<button type="submit">Modifier</button>
			</form>
		</section>
	</main>
</body>
</html>