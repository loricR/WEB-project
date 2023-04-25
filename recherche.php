<?php
	if(session_status() != PHP_SESSION_ACTIVE)  //On vérifie si la session existe déjà
	{
		session_start();
	}

	include_once("initialize.php");
	include("connexion-base.php");
	include_once("helpz/functions.php");
	include_once(__ROOT__."/PageParts/header.php");
	include_once(__ROOT__."/PageParts/menu-bar.php");
	include_once(__ROOT__."/PageParts/connexion.php");
	include_once(__ROOT__."/PageParts/inscription.php");

?>

<h1>Rechercher un post</h1>

<div id="recherche-page">
	<form id="form-recherche" method="POST" action="execRecherche.php">
		<label for="pseudo">
			Utilisateur :
			<input id="recherche-pseudo" class="input-recherche" name="pseudo" type="text" />
		</label>
		<label for="titre">
			Titre :
			<input id="recherche-titre" class="input-recherche" name="titre" type="text" />
		</label>
		<input type="submit" value="Rechercher" />
	</form>
	<div id="resultat-recherche"></div>
	<div id="encore-recherche"><button id="btn-encore-recherche"class="hidden">Charger plus de résultats</button></div>
</div>