<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}

include("connexion-base.php");
include ("initialize.php");
include ("helpz/functions.php");

$loginStatus = CheckLogin();
$reqSuccess = false;

if( isset($_POST["action"])){
    if ($_POST["action"] == "edit"){
        if (isset($_POST["titre"]) && isset($_POST["contenu"])){
            $req = $pdo->prepare("UPDATE post SET titre = ?, contenu = ?, date_post = CURRENT_TIMESTAMP WHERE id_post = ?");
            $reqSuccess = $req->execute(array($_POST["titre"],$_POST["contenu"], $_POST["postID"])); //reqSuccess true si requete à fonctionnée
        }
    }
    elseif ($_POST["action"] == "new"){
        if (isset($_POST["titre"]) && isset($_POST["contenu"])){
            $req = $pdo->prepare("INSERT INTO `post` (titre, contenu, id_utilisateur) VALUES (?,?,?)");
            $reqSuccess = $req->execute(array($_POST["titre"],$_POST["contenu"],$_SESSION["id"]));   //reqSuccess true si requete à fonctionnée           
        }
    }
    elseif ($_POST["action"] == "delete"){
        $req = $pdo->prepare("DELETE FROM `post` WHERE `id_post` = ?");
        $reqSuccess = $req->execute(array($_POST["postID"]));   //reqSuccess true si requete à fonctionnée
    }

    if ($reqSuccess){
        $redirect = "Location:".GetURL()."/blog.php?userID=".$_SESSION['id'];
        header($redirect);
    }
}
?>