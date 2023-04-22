<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Blog - connexion</title>
        <link rel="stylesheet" href="styles/styles.css" />
		<link rel="stylesheet" href="styles/menu.css" />
        <link rel="stylesheet" href="styles/popup.css" />
  	    <script type="text/javascript" src="scripts/script.js"></script>
        <script type="text/javascript" src="scripts/popup.js"></script>
    </head>
<body>
	<?php
        include_once("initialize.php");
        include_once(__ROOT__."/PageParts/menu-bar.php");
    ?>

<!-- CONNEXION -->

    <div id="popup-login" class="popup">
		<button id="close-login-btn" class="close-popup" onclick='hidePopup("popup-login")'>&times;</button>
        <div class="form">
            <h2>Formulaire de connexion</h2>

            <?php include_once(__ROOT__."/PageParts/connexion.php"); ?>

			<a id="show-register-link" href="#" onclick='showPopup("popup-register")'>Pas de compte?</a>
        </div>
    </div>

<!-- INSCRIPTION -->

    <div id="popup-register" class="popup">
		<button id="close-register-btn" class="close-popup" onclick='hidePopup("popup-register")'>&times;</button>
        <div class="form">
            <h2>Formulaire d'inscription</h2>

            <?php include_once(__ROOT__."/PageParts/inscription.php"); ?>

            <a id="show-login-link" href="#" onclick='showPopup("popup-login")'>Déjà un compte?</a>
        </div>
    </div>
</body>
</html>