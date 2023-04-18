<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}

if(isset($_POST['login']) && isset($_POST['mdp']))
{
    $existe=true;
    $login='';   //On définie les variables vides avant le test
    $mdp='';
    if (!empty($_POST['login']))
    {
        if (!empty($_POST['mdp']))
        {
            try
                {
                    include("connexion-base.php");

                    $req = $pdo->prepare("SELECT id_utilisateur, count('pseudo') AS nombre FROM utilisateur WHERE pseudo=? AND mdp=PASSWORD(?)");
                    $req->execute(array($_POST["login"], $_POST["mdp"]));
                    $donnee=$req->fetch();

                    if ($donnee['nombre'] >= 1)
                    {
                        $login=true;
                        $mdp=true;
                        $id=$donnee['id_utilisateur'];
                        //include("connexion-base.php");
                        //$req = $pdo->prepare("SELECT administrateur FROM utilisateur WHERE id_utilisateur=?");
                        //$req->execute(array($id));
                        //$donnee=$req->fetch();
                        //$admin = $donnee['administrateur'];
                    }
                    else
                    {
                        $login='Email ou mot de passe incorrect';
                    }
                }
                catch(PDOException $e)
                {
	                $sql=$e;
                    $login='Probl�me serveur, veuillez r�essayer plus tard';
                }
        }
        else
        {
            $mdp='veuillez remplir le champ mot de passe';
        }
    }
    else
    {
        $login='veuillez remplir le champ pseudo';
    }

}
else
{
    $existe='Des valeurs ne sont pas envoy�es';
}


if($existe===true && $login===true && $mdp===true)
{
    $sql=true;
    include("initialize.php");
    include(__ROOT__."/connexion-base.php");
	$req = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE pseudo=?");
    $req->execute(array($_POST['login']));
    $donnee = $req->fetch();
    $id = $donnee['id_utilisateur'];
    //Afficher l'id : 
    //echo $id;
    $_SESSION['id'] = $id;
    $_SESSION['login'] = $_POST['login'];
    setcookie("login", $_SESSION["login"], time() + 24*3600); //cookies enregistrés pour 24h
    setcookie("id", $_SESSION['id'], time() + 24*3600); //cookies enregistrés pour 24h"])
}
else
{
    $sql='Des valeurs ne sont pas bonnes';
}

echo json_encode(array('existe' => $existe, 'sql' => $sql, 'login' => $login, 'mdp' => $mdp));
?>