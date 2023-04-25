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

//$login = CheckLogin();
//Try to get user for ID used as GET parameter
$blogOwnerName = "";
$isMyOwnBlog = false;

if ( isset($_GET["userID"]) ){

    if ( isset($_GET["userID"]) && $_GET["userID"] == $_SESSION["id"] ){
        $isMyOwnBlog = true;
        $blogOwnerName = $_SESSION["login"];
    }
    else {
        include("connexion-base.php");
        $req = $pdo->prepare("SELECT `pseudo` FROM `utilisateur` WHERE `id_utilisateur` =?");
        $req->execute(array($_GET["userID"]));
        $result = $req->fetchAll();
        if ( isset($result[0]["pseudo"]) ){ // On vérifie si le résultat est non vide
            $blogOwnerName = $result[0]["pseudo"];
        }
    }

    if ($blogOwnerName != ""){
        if ($isMyOwnBlog){
            echo "<h1>Ceci est mon blog à moi, ".$blogOwnerName." !</h1>";
        }
        else {
            echo "<h1>Bienvenue sur le blog de ".$blogOwnerName."</h1>";
        }
        echo '<div id="list-post">';
        DisplayBlog($_GET["userID"], $isMyOwnBlog, 0);  //On affiche le blog de l'utilisateur qui correspond au lien
        echo '</div>';

        echo '<form id="form-load-blog">
                    <input type="hidden" name="id-blog" value="'.$_GET["userID"].'" />
                    <input type="hidden" name="isMyBlog" value="'.$isMyOwnBlog.'" />
                  </form>';
		echo '<div id="encore-blog"><button id="btn-encore-blog" class="hidden">Charger plus de posts</button></div>';
    }
    else {
        echo "<h1>Erreur! Cette ID ne correspond à aucun utilisateur actif!</h1>";
    }
}
else {
  echo "<h1> Connexion failed,".$blogOwnerName."</h1>";
}
?>