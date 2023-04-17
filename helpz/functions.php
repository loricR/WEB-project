<?php
// Function to display a page with 10 posts for a blog
//--------------------------------------------------------------------------------
function DisplayPostsPage($blogID, $ownerName, $isMyBlog){
    include("connexion-base.php");
    $req = $pdo->prepare("SELECT * FROM `post` WHERE `id_utilisateur` =? ORDER BY date_post DESC LIMIT 10");
    $req->execute(array($blogID));
    $result = $req->fetchAll();
    if( $req->rowCount() != 0 ){

        if ($isMyBlog){
        ?>

        <form action="editPost.php" method="POST">
            <input type="hidden" name="newPost" value="1">
            <button type="submit">Ajouter un nouveau post!</button>
        </form>

        <?php    
        }

        foreach( $result as $row ){

            $timestamp = strtotime($row["date_post"]);
            echo '
            <div class="blogPost">
                <div class="postTitle">';

            if ($isMyBlog){

                echo '
                <div class="postModify">
                    <form action="editPost.php" method="GET">
                        <input type="hidden" name="postID" value="'.$row["id_post"].'">
                        <button type="submit">Modifier/effacer</button>
                    </form>
                </div>';
            }
            else {
                echo '
                <div class="postAuthor">par '.$ownerName.'</div>
                ';
            }

            echo '
                <h3>•'.$row["titre"].'</h3>
                <p>dernière modification le '.date("d/m/y à h:i:s", $timestamp ).'
            </div>
            ';

           

            echo'
            <p class="postContent">'.$row["contenu"].'</p>
            </div>
            ';
        }
    }
    else {
        echo '
        <p>Il n\'y a pas de post dans ce blog.</p>';

        if ($isMyBlog){
        ?>
            <form action="editPost.php" method="POST">
                <input type="hidden" name="newPost" value="1">
                <button type="submit">Ajouter un premier post!</button>
            </form>
        <?php
        }
    }
}


// Function to check login. returns an array with 2 booleans
// Boolean 1 = is login successful, Boolean 2 = was login attempted
//--------------------------------------------------------------------------------
function CheckLogin(){
    global $conn, $username, $userID;

    $error = NULL; 
    $loginSuccessful = false;

    //Données reçues via formulaire?
	if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
		$username = SecurizeString_ForSQL($_POST["pseudo"]);
		$password = md5($_POST["mdp"]);
		$loginAttempted = true;
	}
	//Données via le cookie?
	elseif ( isset( $_COOKIE["pseudo"] ) && isset( $_COOKIE["mdp"] ) ) {
		$username = $_COOKIE["pseudo"];
		$password = $_COOKIE["mdp"];
		$loginAttempted = true;
	}
	else {
		$loginAttempted = false;
	}

    //Si un login a été tenté, on interroge la BDD
    if ($loginAttempted){
        $query = "SELECT * FROM login WHERE pseudo = '".$username."' AND mdp ='".$password."'";
        $result = $conn->query($query);

        if ( $result ){
            $row = $result->fetch_assoc();
            $userID = $row["id_utilisateur"];
            $loginSuccessful = true;
        }
        else {
            $error = "Ce couple login/mot de passe n'existe pas. Créez un Compte";
        }
    }

    return array($loginSuccessful, $loginAttempted, $error, $userID);
}

//Function to clean up an user input for safety reasons
//--------------------------------------------------------------------------------
function SecurizeString_ForSQL($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// Function to get current URL, without file name
//--------------------------------------------------------------------------------
function GetUrl() {
    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url .= dirname($_SERVER["REQUEST_URI"]);
    return $url;
}

?>