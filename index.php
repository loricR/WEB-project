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
        <button id="close-login-btn" class="close-popup">&times;</button>
        <div class="form">
            <h2>Formulaire de connexion</h2>

            <?php include_once(__ROOT__."/PageParts/connexion.php"); ?>

            <a id="show-register-link" href="#">Pas de compte?</a>
        </div>
    </div>

<!-- INSCRIPTION -->

    <div id="popup-register" class="popup">
        <button id="close-register-btn" class="close-popup">&times;</button>
        <div class="form">
            <h2>Formulaire d'inscription</h2>

            <?php include_once(__ROOT__."/PageParts/inscription.php"); ?>

            <a id="show-login-link" href="#">Déjà un compte?</a>
        </div>
    </div>
</body>
</html>
<?php
include_once("initialize.php");
include("connexion-base.php");
include_once("helpz/functions.php");
include_once(__ROOT__."/PageParts/header.php");
include_once(__ROOT__."/PageParts/menu-bar.php");
include("connexion-base.php");

// Sélection de trois utilisateurs aléatoires
$req_utilisateurs = $pdo->query("SELECT id_utilisateur FROM utilisateur ORDER BY RAND() LIMIT 3");
$result_utilisateurs = $req_utilisateurs->fetchAll();

// Sélection de trois posts aléatoires pour ces trois utilisateurs
$posts = array();
foreach ($result_utilisateurs as $row_utilisateur) {
    $id_utilisateur = $row_utilisateur["id_utilisateur"];
    $req_posts = $pdo->query("SELECT id_post, id_utilisateur, titre, contenu, imgPresentation, date_post FROM post WHERE id_utilisateur = $id_utilisateur ORDER BY RAND() LIMIT 1");
    $result_posts = $req_posts->fetchAll();
    if (count($result_posts) > 0) {
        $posts[] = $result_posts[0];
    }
}
// Affichage des résultats
if (count($posts) > 0) {
    foreach ($posts as $row) {
        DisplayPost($row["id_post"], $row["id_utilisateur"], $row["titre"], $row["contenu"], $row["imgPresentation"], $row["date_post"]);
    }
} else {
    echo '<p class="warning"> Aucun post n\'existe dans le système pour l\'instant!</p>';
}
?>
