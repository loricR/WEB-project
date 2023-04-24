<?php
include("connexion-base.php");
include_once("initialize.php");
include_once(__ROOT__."/helpz/functions.php");
include_once(__ROOT__."/PageParts/header.php");
include_once(__ROOT__."/PageParts/menu-bar.php");



if ( isset($_POST["newPost"]) && $_POST["newPost"] == 1 ){
?>

    <form id="form-newPost" action="./processPost.php" method="POST" encrypt="multipart/form-data">
        <div class="formbutton">Création d'un nouveau post</div>
		<div>
            <input type="hidden" name="action" value="new">
            <label for="titre">Titre :</label>
            <input autofocus type="text" name="titre">
        </div>
        <div>
            <label for="imgPresentation">Image de présentation :</label>
			<input id="input-img" name="imgPresentation" type="file" accept="image/*" />
        </div>
        <div>
            <label for="contenu">Message :</label>
            <textarea name="contenu" placeholder="Tapez votre texte ici..."></textarea>
        </div>
        <div class="formbutton">
            <input type="submit" value="Ajouter ce post à mon blog" />
        </div>
    </form>

<?php
}
//Otherwise, we are in "edit" mode. Then, try to get post for ID used as GET parameter
elseif ( isset($_GET["postID"]) ){

    include("connexion-base.php");

    $query = 'SELECT * FROM `post` WHERE `ID_post` ='.$_GET["postID"];
    $req = $pdo->prepare("SELECT * FROM `post` WHERE `ID_post` =?");
    $req->execute(array($_GET["postID"]));
    $data = $req->fetch();
        
    if ( $req->rowCount() > 0 ){ 
?>

        <form id="form-editPost" action="./processPost.php" method="POST" encrypt="multipart/form-data">
            <div class="formbutton">Modification d'un post passé</div>
            <div>
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="postID" value="<?php echo $data["id_post"];?>">
                <label for="titre">Titre :</label>
                <input autofocus type="text" name="titre" value="<?php echo $data["titre"];?>">
            </div>
			<div>
				<label for="imgPresentation">Image de présentation :</label>
				<input id="input-img" name="imgPresentation" type="file" accept="image/*" />
			</div>
            <div>
                <label for="contenu">Message :</label>
                <textarea name="contenu"><?php echo $data["contenu"];?></textarea>
            </div>
            <div class="formbutton">
                <input type="submit" value="Modifier le post" />
            </div>
        </form>
        <form id="form-supprPost" action="./processPost.php" method="POST">
            <div class="formbutton">Cliquez le bouton ci-dessous pour effacer le post</div>
            <div>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="postID" value="<?php echo $data["id_post"];?>">
            </div>
            <div class="formbutton">
                <input type="submit" value="Supprimer le post" />
            </div>
        </form>

    <?php
    }
    else {
        echo "<h1>Erreur! Cette ID ne correspond à aucun post!</h1>";
    }
}

?>


