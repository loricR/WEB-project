<?php

if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}

include("connexion-base.php");
include_once("initialize.php");
include_once("helpz/functions.php");

// Vérification de la modification du pseudo
    if (!empty($_POST['pseudo'])) {
        $pseudo = $_POST['pseudo'];
        $id_utilisateur = $_SESSION["id"];
        //On met à jour le pseudo dans la bdd
        $query = $pdo->prepare("UPDATE utilisateur SET pseudo = ? WHERE id_utilisateur = ?");
        $query->execute([$pseudo, $id_utilisateur]);
        $_SESSION['login'] = $pseudo; // Mise à jour du pseudo en session
    }
    
    // Vérification de la modification du mot de passe
    if (!empty($_POST['mdp']) && !empty($_POST['nouveau_mdp']) && !empty($_POST['nouveau_mdp2'])) {
        $nouveau_mdp = $_POST['nouveau_mdp'];
        $nouveau_mdp2 = $_POST['nouveau_mdp2'];
        $id_utilisateur = $_SESSION['id'];
        //On récupère le mot de passe actuel dans la bdd
        $query = $pdo->prepare("SELECT count(nom) as mdp_count FROM utilisateur WHERE id_utilisateur = ? and mdp = PASSWORD(?)");
        $query->execute(array($id_utilisateur, $_POST['mdp']));
        $result = $query->fetch(); // On récupère le résultat de la requête
        $mdp = $result['mdp_count']; 
        //echo $mdp_hash;

        // Vérification de la concordance du mot de passe actuel
        if ($mdp >= 1) {
            // Vérification de la concordance des nouveaux mots de passe
            if ($nouveau_mdp == $nouveau_mdp2) {
                // On hash le nouveau mot de passe avant de le stocker dans la base de données
                $query = $pdo->prepare("UPDATE utilisateur SET mdp = PASSWORD(?) WHERE id_utilisateur = ?");
                $query->execute([$nouveau_mdp, $id_utilisateur]);
                echo "Mot de passe modifié avec succès.";
            } else {
                echo "Les nouveaux mots de passe ne correspondent pas.";
            }
        } else {
            echo "Mot de passe actuel incorrect.";
        }
    }
    
    if(isset($_FILES["avatar"]["name"]) && !empty($_FILES["avatar"]["name"])) {
        // Vérifie si c'est une image
        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check !== false) {

            $imgDir = "images/post";
            $infoFile = pathinfo($_FILES["imgPresentation"]["name"]);
            $extension = $infoFile["extension"];
            $lienImgSansExt = $imgDir . "/" . $id;
            $lienImg = $imgDir . "/" . $id . "." . $extension;    //Le nom de l'image est l'id du post pour être sûr qu'il n'y ai pas 2 fois le même nom de fichier
            
            if($lienASuppr = glob($lienImgSansExt.".*")) {  //On cherche si un fichier a déjà le nom de l'id du post
                unlink($lienASuppr[0]); //On supprime le fichier qui a le même nom
                //echo 'Fichier supprimé : '.$lienASuppr[0].'';
            }

            // Déplace l'image dans le répertoire
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $lienImg)) {
                // MAJ de la photo de profil dans la bdd
                $stmt = $pdo->prepare('UPDATE utilisateur SET avatar = ? WHERE id_utilisateur = ?');
                $stmt->execute([$lienImg, $_SESSION['id']]);

            } else {
                echo 'Une erreur est survenue lors de l\'upload de l\'image.';
            }
        } else {
            echo 'Le fichier uploadé doit être une image.';
        }
    }

    //redirige vers le profil
    header('Location: profil.php');
?>