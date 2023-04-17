<?php

include("connexion-base.php");
include ("initialize.php");
include ("helpz/functions.php");

$loginStatus = CheckLogin();

// Die Formulare, die den Benutzer hierher bringen, haben versteckte Felder, um zu sagen, ob wir hier sind, um hinzuzufügen oder zu bearbeiten...
if( isset($_POST["action"]) ){

    if ( $_POST["action"] == "edit"){

        if ( isset($_POST["titre"]) && isset($_POST["contenu"])){
            $query = "UPDATE `post` SET 
                    `titre` = '".SecurizeString_ForSQL($_POST["titre"])."',  
                    `contenu` = '".SecurizeString_ForSQL($_POST["contenu"])."' 
                    WHERE `id_post` = ".$_POST["postID"];
        }
    }
    elseif ( $_POST["action"] == "new"){

        if ( isset($_POST["titre"]) && isset($_POST["contenu"])){
            $query = "INSERT INTO `post` (titre, contenu, id_utilisateur) VALUES            
                    ('".SecurizeString_ForSQL($_POST["titre"])."', '".SecurizeString_ForSQL($_POST["contenu"])."', '".$_COOKIE["id"]."')";
           
            $req = $pdo->prepare("INSERT INTO `post` (titre, contenu, id_utilisateur) VALUES (?,?,?)");
            $req->execute(array($_POST["titre"],$_POST["contenu"],$_COOKIE["id"]));
            
        }
    }
    elseif ($_POST["action"] == "delete"){
        $query = "DELETE FROM `post` WHERE `id_post` = ".$_POST["postID"];
    }

    if (isset($query)){
        echo $query;
        $result = $pdo->query($query);

        $redirect = "Location:".GetURL()."/blog.php?userID=".$_COOKIE['id'];
        //echo "Post Erfolgreich - Weiterleitung zu blog.php".$redirect;
        header($redirect);
    }
}

?>