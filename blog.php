<?php
include("connexion-base.php");
include ("initialize.php");
include (__ROOT__."/helpz/functions.php");
include (__ROOT__."/PageParts/header.php");
include (__ROOT__."/PageParts/menu-bar.php");
//$login = CheckLogin();
//Try to get user for ID used as GET parameter
$blogOwnerName = "";
$isMyOwnBlog = false;

if ( isset($_GET["userID"]) ){

    if ( isset($_GET["userID"]) && $_GET["userID"] == $_COOKIE["id"] ){
        $isMyOwnBlog = true;
        $blogOwnerName = $_COOKIE["login"];
    }
    else {
        $req = $pdo->prepare("SELECT `pseudo` FROM `utilisateur` WHERE `id_utilisateur` =?");
        $req->execute(array($_GET["userID"]));
        $result = $req->fetch();
        
        if ( mysqli_num_rows($result) != 0 ){ $blogOwnerName = $result;}
    }
    
    if ($blogOwnerName != ""){
        if ($isMyOwnBlog){
            echo "<h1>Ceci est mon blog à moi, ".$blogOwnerName." !</h1>";
        }
        else {
            echo "<h1>Bienvenue sur le blog de ".$blogOwnerName."</h1>";
        }

        DisplayPostsPage( $id , $blogOwnerName, $isMyOwnBlog);
    }
    else {
        echo "<h1>Erreur! Cette ID ne correspond à aucun utilisateur actif!</h1>";
    }
}
else {
  echo "<h1> Connexion failed,".$_GET["id"]."</h1>";
}
?>