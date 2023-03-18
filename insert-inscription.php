<?php
//session_start(); // Si on utilise les sessions, important au début de la page (ou dans un include)
//$existe = 'a';
//$mail = 'a';
//$nom = 'a';
//$prenom = 'a';
//$mdp = 'a';
//$sql = 'a';


if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["pseudo"]))
{
    $existe='ok';
    if(!empty($_POST['email']))
    {
        /*try
        {
            include("connexion-base.php");
            $req = $pdo->prepare("SELECT count('email') AS nombre FROM utilisateur WHERE email=?");
            $req->execute(array($_POST['email']));
            $donnee=$req->fetch();
            if ($donnee['nombre'] >= 1)
            {
                $mail="L'email existe déjà.";
            }
            else
            {
                $mail='ok';
            }
        }
        catch(PDOException $e)
        {
	        $sql=$e;
            $mail='Problème serveur, veuillez réessayer plus tard';
        }*/
        $mail='ok';

    }
    else
    {
        $mail = 'Le champ email est obligatoire.';
        //$erreur='Des valeurs sont vides';
    }


    if(!empty($_POST['mdp']))
    {
        $mdp='ok';
    }
    else
    {
        $mdp='Le champ mot de passe est obligatoire.';
    }


    if(!empty($_POST['prenom']))
    {
        $prenom='ok';
    }
    else
    {
        $prenom='Le champ prenom est obligatoire.';
    }


    if(!empty($_POST['nom']))
    {
        $nom='ok';
    }
    else
    {
        $nom='Le champ nom est obligatoire.';
    }

    if(!empty($_POST['pseudo']))
    {
        try
        {
            include("connexion-base.php");

            $req = $pdo->prepare("SELECT count('pseudo') AS nombre FROM utilisateur WHERE pseudo=?");
            $req->execute(array($_POST['pseudo']));
            $donnee=$req->fetch();
            if ($donnee['nombre'] >= 1)
            {
                $pseudo="Ce pseudo existe déjà.";
            }
            else
            {
                $pseudo='ok';
            }
        }
        catch(PDOException $e)
        {
	        $sql=$e;
            $pseudo='Problème serveur, veuillez réessayer plus tard';
        }
    }
    else
    {
        $pseudo='Le champ nom est obligatoire.';
    }
}
else
{
    $existe = 'Des valeurs ne sont pas envoyées';
}

if($existe=='ok' && $mail=='ok' && $mdp=='ok' && $prenom=='ok' && $nom=='ok' && $pseudo=='ok')
{

    $sql='ok';
    try
    {
        include("connexion-base.php");

        $req = $pdo->prepare("INSERT INTO utilisateur (prenom, nom, email, pseudo, mdp) VALUES (?,?,?,?,PASSWORD(?))");
        $req->execute(array($_POST["prenom"],$_POST["nom"],$_POST["email"],$_POST["pseudo"],$_POST["mdp"]));

        //$req = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email=?");
        //$req->execute(array($_POST['email']));
        //$donnee = $req->fetch();
        //$id = $donnee['id_utilisateur'];
        //$_SESSION['id'] = $id;
    }
    catch(PDOException $e)
    {
	    $sql=$e;
    }
}
else
{
    $sql='Des valeurs ne sont pas bonnes';
}

echo json_encode(array('existe' => $existe, 'mail' => $mail, 'pseudo' => $pseudo, 'mdp' => $mdp, 'prenom' => $prenom, 'nom' => $nom, 'sql' => $sql));
?>