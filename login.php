<?php
session_start();    // Si on utilise les sessions, important au début de la page (ou dans un include)

if(isset($_POST['login']) && isset($_POST['mdp']))
{
    $exist='ok';
    $login='';
    $mdp='';
    if (!empty($_POST['login']))
    {
        if (!empty($_POST['mdp']))
        {
            try
                {
                    include("connexion-base.php");

                    $req = $pdo->prepare("SELECT id_utilisateur, count('email') AS nombre FROM utilisateur WHERE email=? AND mdp=PASSWORD(?)");
                    $req->execute(array($_POST["login"], $_POST["mdp"]));
                    $donnee=$req->fetch();

                    if ($donnee['nombre'] >= 1)
                    {
                        $login='ok';
                        $mdp='ok';
                        $id=$donnee['id_utilisateur'];
                        include("connexion-base.php");
                        $req = $pdo->prepare("SELECT administrateur FROM utilisateur WHERE id_utilisateur=?");
                        $req->execute(array($id));
                        $donnee=$req->fetch();
                        $admin = $donnee['administrateur'];
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
        $login='veuillez remplir le champ Email';
    }

}
else
{
    $sql='Des valeurs ne sont pas bonnes';
}


if($exist=='ok' && $login=='ok' && $mdp=='ok')
{
    $sql='ok';
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['id'] = $id;
    $_SESSION['admin'] = $admin;
}
else
{
    $sql='Des valeurs ne sont pas bonnes';
}

echo json_encode(array('exist' => $exist, 'sql' => $sql, 'login' => $login, 'mdp' => $mdp));
?>