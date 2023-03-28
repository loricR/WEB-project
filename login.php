<?php

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
                    $login='Problème serveur, veuillez réessayer plus tard';
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
    $existe='Des valeurs ne sont pas envoyées';
}


if($existe===true && $login===true && $mdp===true)
{
    $sql=true;
    //$_SESSION['login'] = $_POST['login'];
    //$_SESSION['id'] = $id;
    //$_SESSION['admin'] = $admin;
    setcookie("login", $_POST['login'], time() + 24*3600);
}
else
{
    $sql='Des valeurs ne sont pas bonnes';
}

echo json_encode(array('existe' => $existe, 'sql' => $sql, 'login' => $login, 'mdp' => $mdp));
?>