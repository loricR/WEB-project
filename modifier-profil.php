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
        $mdp = md5($_POST['mdp']);
        $nouveau_mdp = $_POST['nouveau_mdp'];
        $nouveau_mdp2 = $_POST['nouveau_mdp2'];
        $id_utilisateur = $_SESSION['id'];
        //On récupère le mot de passe actuel dans la bdd
        $query = $pdo->prepare("SELECT mdp FROM utilisateur WHERE id_utilisateur = ?");
        $query->execute([$id_utilisateur]);
        $result = $query->fetch();
        $mdp_hash = $result['mdp'];
        
        // Vérification de la concordance du mot de passe actuel
        if ($mdp == $mdp_hash) {
            
            // Vérification de la concordance des nouveaux mots de passe
            if ($nouveau_mdp == $nouveau_mdp2) {
                $query = $pdo->prepare("UPDATE utilisateur SET mdp = ? WHERE id_utilisateur = ?");
                $query->execute([md5($result['mdp']), $id_utilisateur]);
            } else {
                echo "Les nouveaux mots de passe ne correspondent pas.";
            }
        }
    }
    
    if(isset($_FILES["avatar"]["name"]) && !empty($_FILES["avatar"]["name"])) {
        // Vérifie si c'est une image
        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check !== false) {
            // Créer un nom unique pour l'image et l'ajoute à la bdd
            $filename = uniqid() . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $filepath = 'images/' . $filename;
            
            // Déplace l'image dans le répertoire
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $filepath)) {
                // MAJ de la photo de profil dans la bdd
                $stmt = $pdo->prepare('UPDATE utilisateur SET avatar = ? WHERE id_utilisateur = ?');
                $stmt->execute([$filepath, $_SESSION['id']]);

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