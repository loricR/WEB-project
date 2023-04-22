<?php
if(session_status() != PHP_SESSION_ACTIVE)	//On vérifie si la session existe déjà
{
	session_start();
}

if(isset($_POST["pseudo"]) && isset($_POST["titre"]))
{
	try
	{
		include("connexion-base.php");

		//Avec cette requête sql, si le pseudo et/ou le titre sont vide elle fonctionnera, elle retournera juste tous les post (correspondant uniquement au pseudo ou au titre)
		$req = $pdo->prepare("SELECT post.*, utilisateur.pseudo AS pseudoPost FROM post INNER JOIN utilisateur ON utilisateur.id_utilisateur = post.id_utilisateur WHERE pseudo LIKE ? AND titre LIKE ?");
		$req->execute(array("%".$_POST["pseudo"]."%", "%".$_POST["titre"]."%"));

		$nbResult = $req->rowCount();
		if($nbResult > 0)
		{
			echo '<p>' . $nbResult . ' posts trouvés</p>';
		}
		else
		{
			echo '<p>Aucun post ne correspond à la recherche</p>';
		}

		while($donnee=$req->fetch())	//On affiche les post ligne par ligne
		{
			$timestamp = strtotime($donnee["date_post"]);
            echo '
            <section class="articles">
                <div class="article">
                    <div class="left">
                        <img src="'.$donnee["imgPresentation"].'" alt"image jeu">
                    </div>

                    <div class="right">
                        <p class="date">dernière modification le '.date("d/m/y à H:i:s", $timestamp ).'
                        <h3 class = "title">•'.$donnee["titre"].'</h3>
                        <p class="contenu">'.$donnee["contenu"].'</p>

                        ';
			if ($donnee["pseudoPost"] == $_SESSION["login"])
			{
				echo '
                            <div class="modifier">
                                <form action="editPost.php" method="GET">
                                    <input type="hidden" name="postID" value="'.$donnee["id_post"].'">
                                    <button type="submit">Modifier/effacer</button>
                                </form>
                            </div>';
			}
			else {
				echo '
                            <div class="autheur">par '.$donnee["pseudoPost"].'</div>
                            ';
			}
			echo '
                    </div>
                </div>
            </section>
            ';
		}
	}
	catch(PDOException $e)
	{
		$sql=$e;
	}
}
?>