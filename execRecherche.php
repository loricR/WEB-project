<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}
include_once("helpz/functions.php");

if(isset($_POST["pseudo"]) && isset($_POST["titre"]) && isset($_POST["nbClick"]))
{
	$nbAfficheOnce = 10;
	$offset = $_POST["nbClick"]*$nbAfficheOnce;

	if($_POST["nbClick"] <= 0)
	{
		try
		{
			include("connexion-base.php");

			//Avec cette requête sql, si le pseudo et/ou le titre sont vide elle fonctionnera, elle retournera juste tous les post (correspondant uniquement au pseudo ou au titre)
			//$req = $pdo->prepare("SELECT post.id_post, utilisateur.pseudo AS pseudoPost FROM post INNER JOIN utilisateur ON utilisateur.id_utilisateur = post.id_utilisateur WHERE pseudo LIKE ? AND titre LIKE ?");
			//$req->execute(array("%".$_POST["pseudo"]."%", "%".$_POST["titre"]."%"));

			$req = $pdo->prepare("SELECT post.id_post FROM post INNER JOIN utilisateur ON utilisateur.id_utilisateur = post.id_utilisateur WHERE pseudo LIKE \"%\"?\"%\" AND titre LIKE \"%\"?\"%\"");
			$req->execute(array("%".$_POST["pseudo"]."%", "%".$_POST["titre"]."%"));
			$req->execute();

			$nbResult = $req->rowCount();
			if($nbResult > 1)
			{
				echo '<p>' . $nbResult . ' posts trouvés</p>';
			}
			else if($nbResult === 1)
			{
				echo '<p>1 post trouvé</p>';
			}
			else
			{
				echo '<p>Aucun post ne correspond à la recherche</p>';
			}

			$nbAffiche = 0;
			while($nbAffiche < $nbAfficheOnce && $donnee=$req->fetch())	//On affiche les post ligne par ligne
			{
				$nbAffiche++;
				DisplayPost($donnee["id_post"]);
			}
		}
		catch(PDOException $e)
		{
			echo $e;
		}
	}
	else
	{
		try
		{
			include("connexion-base.php");

			$req = $pdo->prepare("SELECT post.id_post FROM post INNER JOIN utilisateur ON utilisateur.id_utilisateur = post.id_utilisateur WHERE pseudo LIKE \"%\"?\"%\" AND titre LIKE \"%\"?\"%\" LIMIT ? OFFSET ?");
			$req->bindParam(1, $_POST["pseudo"], PDO::PARAM_STR);
			$req->bindParam(2, $_POST["titre"], PDO::PARAM_STR);
			$req->bindParam(3, $nbAfficheOnce, PDO::PARAM_INT);
			$req->bindParam(4, $offset, PDO::PARAM_INT);
			$req->execute();

			while($donnee=$req->fetch())	//On affiche les post ligne par ligne
			{
				DisplayPost($donnee["id_post"]);
			}
		}
		catch(PDOException $e)
		{
			echo $e;
		}
	}
}
?>