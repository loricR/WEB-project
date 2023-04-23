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
			$reqComm = $pdo->prepare("SELECT count(id_post) AS nbCommentaire FROM `commentaire` WHERE `id_post` =?");
			$reqComm->execute(array($donnee["id_post"]));
			$resultCount = $reqComm->fetch();

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
			if (isset($_SESSION["login"]) && $donnee["pseudoPost"] == $_SESSION["login"])
			{
				echo '
                            <div class="modifier">
                                <form action="editPost.php" method="GET">
                                    <input type="hidden" name="postID" value="'.$donnee["id_post"].'">
                                    <button type="submit">Modifier/effacer</button>
                                </form>
                            </div>';
				if($resultCount["nbCommentaire"] === 1)
				{
					echo '<button id="btn-affiche-commentaire'.$donnee["id_post"].'" onclick="commentaire('.$donnee["id_post"].')">Voir les '.$resultCount["nbCommentaire"].' commentaires</button>';
				}
				else
				{
					echo '<button id="btn-affiche-commentaire'.$donnee["id_post"].'" onclick="commentaire('.$donnee["id_post"].')">Voir le commentaire</button>';
				}
                echo '<div id="affichage-commentaire'.$donnee["id_post"].'"></div>'; //Pour afficher les commentaires en javascript
			}
			else if(isset($_SESSION["login"]) && $donnee["pseudoPost"] != $_SESSION["login"] || !isset($_SESSION["login"])){
				echo '
                            <div class="autheur">par '.$donnee["pseudoPost"].'</div>
                            ';

				if($resultCount["nbCommentaire"] === 1)
				{
					echo '<button id="btn-affiche-commentaire'.$donnee["id_post"].'" onclick="commentaire('.$donnee["id_post"].')">Voir le commentaire</button>';
				}
				else
				{
					echo '<button id="btn-affiche-commentaire'.$donnee["id_post"].'" onclick="commentaire('.$donnee["id_post"].')">Voir les '.$resultCount["nbCommentaire"].' commentaires</button>';
				}
                echo '<div id="affichage-commentaire'.$donnee["id_post"].'"></div>'; //Pour afficher les commentaires en javascript
				if(isset($_SESSION["id"]))
				{
					echo '<div id="commentaire'.$donnee["id_post"].'" class="hidden">
                                <form id="form-commentaire'.$donnee["id_post"].'" action"commenter.php" method="POST">
                                    <label for="commentaire">Votre commentaire :</label>
                                    <textarea id="text-commentaire'.$donnee["id_post"].'" name="commentaire" placeholder="Tapez votre commentaire ici..."></textarea>
                                    <input type="hidden" name="id_post" value="'.$donnee["id_post"].'">
                                    <input type="submit" value="Envoyer" />
                                </form>
                            </div>';
					echo '<button id="btn-commenter'.$donnee["id_post"].'"  onclick="clickCommentaire('.$donnee["id_post"].')">Commenter</button>';
					echo '<button id="annuler-commenter'.$donnee["id_post"].'" class="hidden" onclick="clickAnnulerCommenter('.$donnee["id_post"].')">Annuler</button>';
				}
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