<?php

include_once("initialize.php");
include("connexion-base.php");
include_once("helpz/functions.php");
include_once(__ROOT__."/PageParts/header.php");
include_once(__ROOT__."/PageParts/menu-bar.php");

?>
	<main>
		<section class="profil">
			<h1>Informations de profil</h1>
			<form id="form-modif-profil" action="modifier-profil.php" method="POST" enctype="multipart/form-data">
				<label for="pseudo"><?php echo "Pseudo : $_SESSION[login]"; ?></label>
				<input id="input-modif-pseudo" type="text" name="pseudo"><br><br>
				<label for="mdp">Confirmer mot de passe actuel:</label>
				<input id="input-mdpOld" type="password" name="mdp" value=""><br><br>
				<label for="nouveau_mdp">Nouveau mot de passe :</label>
				<input id="input-mdpNew" type="password" name="nouveau_mdp" value=""><br><br>
				<label for="nouveau_mdp2">Confirmer nouveau mot de passe :</label>
				<input id="input-mdpNew2" type="password" name="nouveau_mdp2" value=""><br><br>
            	<label for="avatar">Changer Avatar :</label>
				<input id="input-img" name="avatar" type="file" accept="image/*" /><br><br>

				<input type="submit" value="Modifier" />
			</form>
			<div><ul id="retour-modifProfil"></ul></div>
		</section>
	</main>
</body>
</html>