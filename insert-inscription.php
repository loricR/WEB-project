<?php
//session_start(); // Si on utilise les sessions, important au début de la page (ou dans un include)
//$existe = 'a';
//$mail = 'a';
//$nom = 'a';
//$prenom = 'a';
//$mdp = 'a';
//$sql = 'a';


if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["pseudo"]) && isset($_POST["mdp-confirm"]))
{
    $existe=true;
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
        $mail=true;

    }
    else
    {
        $mail = 'Le champ email est obligatoire.';
    }


    if(!empty($_POST['mdp']))
    {
        if(preg_match( '~[A-Z]~', $_POST["mdp"]) && preg_match( '~[a-z]~', $_POST["mdp"]) && preg_match( '~\d~', $_POST["mdp"]) && (strlen( $_POST["mdp"]) > 7))
		{
			if(!empty($_POST['mdp-confirm']))
			{
				if($_POST['mdp-confirm'] == $_POST['mdp'])
				{
					$mdp=true;
				}
				else
				{
					$mdp='Le mot de passe doit être le même que sa confirmation.';
				}
			}
			else
			{
				$mdp='Veuillez confirmer le mot de passe.';
			}
		}
        else
		{
			$mdp='Le mot de passe doit contenir au moins 8 caractères avec au moins un chiffre, une majuscule, une minuscule.';
		}

    }
    else
    {
        $mdp='Le champ mot de passe est obligatoire.';
    }


    if(!empty($_POST['prenom']))
    {
        $prenom=true;
    }
    else
    {
        $prenom='Le champ prenom est obligatoire.';
    }


    if(!empty($_POST['nom']))
    {
        $nom=true;
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
                $pseudo=true;
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

if($existe==true && $mail==true && $mdp==true && $prenom==true && $nom==true && $pseudo==true)
{

    $sql=true;
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
//echo json_encode(array('controle' => array('existe' => $existe, 'sql' => 'test'), 'formulaire' => array('mail' => $mail, 'pseudo' => $pseudo, 'mdp' => $mdp, 'prenom' => $prenom, 'nom' => $nom)));
//echo json_encode(array('existe' => $existe, 'liste' => array(array('element'=>'mail','valeur' => $mail), array('element'=>'mdp','valeur' => $mdp))));
?>